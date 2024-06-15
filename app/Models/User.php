<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable,HasRoles;

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
}
