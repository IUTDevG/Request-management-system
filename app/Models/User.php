<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Filament\Panel;
use App\Enums\RoleType;
use Illuminate\Support\Facades\DB;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use PhpOption\None;

class User extends Authenticatable implements FilamentUser,HasMedia
{
    use HasFactory, Notifiable,HasRoles,InteractsWithMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'firstName',
        'username',
        'email',
        'password',
        'avatar',
        'avatar_type',
        'phone_number',
        'matricule',
        'google_profile',
        'last_login_at',
        'last_login_ip',
        'is_activated',
        'facebook_id',
        'google_id',
        'github_id',
    ];

    public function google(): ?string
    {
        return $this->google_profile;
    }

    public function getFullnameAttribute() : string {
        return $this->name.' '.$this->firstName;
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'is_activated' => 'boolean',
            'password' => 'hashed',
            'settings' => 'array'
        ];
    }


    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $appends = [
        'fullname'
    ];

    public function canAccessPanel(Panel $panel): bool
    {
        if($panel->getId() === 'dashboard'){
            return $this->hasRole(RoleType::ACADEMIC_MANAGER) || $this->hasRole(RoleType::DEPUTY_DIRECTOR) || $this->hasRole(RoleType::SCHOOLING) || $this->hasRole(RoleType::SECRETARY_DIRECTOR ) || $this->hasRole(RoleType::DIRECTOR);
        }
        elseif($panel->getId() === 'admin'){
            return $this->hasRole(RoleType::COMPUTER_CELL);
        }
    }

    public function hasDepartment():bool{
        return DB::table('model_has_roles')
        ->where('model_id', $this->id)
        ->where('model_type', get_class($this))
        ->whereNotNull('department_id')
        ->exists();
    }
    // public function getRol

    public function getDepartment()
    {
        if($this->hasDepartment()){
            // dd('test');
            $result = DB::select('SELECT department_id from model_has_roles WHERE model_id = ? ',[$this->id]);
            $result  = DB::table('model_has_roles')
            ->where('model_id', $this->id)
            ->where('model_type', get_class($this))
            ->value('department_id');
                return (Department::where('id', $result)->first());
        }
        return null;
    }

    public function assignRoleWithDepartment(array $roleName, int $departmentId = null): void
    {
        // Assigner le rôle à l'utilisateur
        $roles = Role::query()->whereIn('name', $roleName)->get();
        $this->syncRoles($roles);

        // Vérifier si le département existe, si un departmentId est fourni
        if ($departmentId !== null) {
            $departmentExists = Department::where('id', $departmentId)->exists();
            if (!$departmentExists) {
                throw new \RuntimeException("Department with ID {$departmentId} does not exist.");
            }
        }

        // Mettre à jour la table model_has_roles avec le department_id
        foreach ($roles as $role) {
            DB::table('model_has_roles')
                ->where('model_id', $this->id)
                ->where('role_id', $role->id)
                ->update(['department_id' => $departmentId]);
        }
    }
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('avatar')
            ->useDisk('private')
            ->singleFile();
    }
}
