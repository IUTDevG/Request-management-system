<?php

namespace App\Models;

use App\Enums\RoleType;
use App\Enums\SchoolRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SchoolRequest extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, SoftDeletes;


    protected $fillable = [
        'title',
        'request_code',
        'description',
        'status',
        'matricule',
        'level_id',
        'department_id',
        'user_id',
        'assigned_to'
    ];

    // public function has_been_assigned_to()
    // {
    //     return $this->belongsTo(User::class, 'assigned_to');
    // }

    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->request_code = self::generateUniqueRequestCode();
        });
        static::created(function ($model) {
            $user = $model->user;
            $department = Department::find($model->department_id);
            activity('request')
                ->performedOn($model)
                ->event('created')
                ->causedBy($user)
                ->withProperties([
                    'title' => $model->title,
                    'new_assignee' => RoleType::SECRETARY_DIRECTOR->value,
                    'request_code' => $model->request_code,
                    'owner' => $user->name . ' ' . $user->firstname,
                    'status' => $model->status,
                    'department' => $department->name,
                    'creation_date' => $model->created_at->format('Y-m-d H:i:s'),
                ])
                ->log("The request has been created by {$user->name} with the code {$model->request_code}");
        });
        static::updated(function ($model) {
            $user = User::find(Auth::user()->id);
            //case if the assigned_to and the status is also updated
            if ($model->isDirty('assigned_to') && $model->isDirty('status') !== $model->getOriginal('status')) {
                $resRole = $model->assigned_to;
                Log::info(1);
                $resRole = RoleType::tryFrom($resRole)?->label() ?? $resRole;
                $status = $model->status;
                $department = Department::find($model->department_id);
                activity('request')
                    ->performedOn($model)
                    ->by($user)
                    ->event('updated')
                    ->withProperties([
                        'old_assignee' => $user->getRole(),
                        'new_assignee' => $model->assigned_to,
                        'status' => $model->status,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                    ])
                    ->log("The request has been assigned to {$resRole} by {$user->getRole()}, and the status has been updated to {$status}.");
            } elseif ($model->isDirty('assigned_to') && $model->isDirty('status') == $model->getOriginal('status')) {
                //case if the assigned_to is update but not the status
                $resRole = $model->assigned_to;
                $resRole = RoleType::tryFrom($resRole)?->value ?? $resRole;
                $department = Department::find($model->department_id);
                Log::info(2);
                activity('request')
                    ->performedOn($model)
                    ->by($user)
                    ->withProperties([
                        'old_assignee' => $user->getRole(),
                        'new_assignee' => $model->assigned_to,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                        'status' => $model->status,
                    ])
                    ->event('updated')
                    ->log("The request as been assigned to {$resRole} by {$user->getRole()}.");
            } elseif ($model->isDirty('status') && $model->isDirty('assigned_to') == $model->getOriginal('assigned_to')) {
                //case if the status is update but not the assigned_to
                $department = Department::find($model->department_id);
                $status = SchoolRequestStatus::tryFrom($model->status)->value;
                Log::info(3);
                activity('request')
                    ->performedOn($model)
                    ->by($user)
                    ->event('updated')
                    ->withProperties([
                        'old_assignee' => $user->getRole(),
                        'status' => $model->status,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                    ])
                    ->log("The request is in status {$status}");
            } elseif ($model->getOriginal('status') == SchoolRequestStatus::Draft->value) {
                //case if the status is update from draft to submitted
                $status = SchoolRequestStatus::tryFrom($model->status)->value;
                $department = Department::find($model->department_id);
                activity('request')
                    ->performedOn($model)
                    ->by($user)
                    ->event('updated')
                    ->withProperties([
                        'old_assignee' => $user->getRole(),
                        'new_assignee' => RoleType::SECRETARY_DIRECTOR->value,
                        'status' => $model->status,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                    ])
                    ->log("The request is in status {$status}");
            }
        });
    }

    public function getRouteKeyName()
    {
        return 'request_code';
    }

    //generate unique request code for school_request

    protected static function generateUniqueRequestCode(): string
    {
        do {
            $request_code = Str::random(15);
        } while (SchoolRequest::where('request_code', $request_code)->exists());
        return $request_code;
    }

    //    defining media collections for SchoolRequest
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('school-request')
            ->useDisk('private')
            ->acceptsMimeTypes(['application/pdf', 'image/jpeg', 'image/png', 'image/jpg', 'image/webp', 'image/heic', 'image/heic-sequence']);
    }
}
