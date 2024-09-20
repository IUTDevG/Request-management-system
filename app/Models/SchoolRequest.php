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
                    'request_code' => $model->request_code,
                    'owner' => $user->name . ' ' . $user->firstname,
                    'status' => $model->status,
                    'department' => $department->name,
                    'creation_date' => $model->created_at->format('Y-m-d H:i:s'),
                ])
                ->log("The request has been created by {$user->name} with the code {$model->request_code}");
        });
        static::updated(function ($model) {
            if ($model->isDirty('assigned_to') && $model->isDirty('status') !== $model->getOriginal('status')) {
                $previousAssignee = $model->getOriginal('assigned_to') ? User::withRoleInDepartment($model->department_id, $model->getOriginal('assigned_to')) : 'None';
                $prevRole = RoleType::tryFrom($previousAssignee->getRole())?->label() ?? $previousAssignee->getRole();
                $resRole = $model->assigned_to;
                $resRole = RoleType::tryFrom($resRole)?->label() ?? $resRole;
                $status = $model->status;
                $department = Department::find($model->department_id);
                activity('request')
                    ->performedOn($model)
                    ->by($previousAssignee)
                    ->event('updated')
                    ->withProperties([
                        'old_assignee' => User::withRoleInDepartment($model->department_id, $model->getOriginal('assigned_to'))->getRole() ?? 'None',
                        'new_assignee' => $model->assigned_to,
                        'status' => $model->status,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                    ])
                    ->log("The request has been assigned to {$resRole} by {$prevRole}, and the status has been updated to {$status}.");
            } elseif ($model->isDirty('assigned_to')) {
                $resRole = $model->assigned_to;
                $resRole = RoleType::tryFrom($resRole)?->label() ?? $resRole;
                $previousAssignee = $model->getOriginal('assigned_to') ? User::withRoleInDepartment($model->department_id, $model->getOriginal('assigned_to')) : 'None';
                $prevRole = RoleType::tryFrom($previousAssignee->getRole())?->label() ?? $previousAssignee->getRole();
                $department = Department::find($model->department_id);
                activity('request')
                    ->performedOn($model)
                    ->by($previousAssignee)
                    ->withProperties([
                        'old_assignee' => User::withRoleInDepartment($model->department_id, $model->getOriginal('assigned_to'))->getRole() ?? 'None',
                        'new_assignee' => $model->assigned_to,
                        'department' => $department->name,
                        'owner' => $model->user->name,
                        'request_code' => $model->request_code,
                        'title' => $model->title,
                        'status' => $model->status,
                    ])
                    ->event('updated')
                    ->log("The request as been assigned to {$resRole} by {$prevRole}.");
            }

            if ($model->isDirty('status')) {
                $department = Department::find($model->department_id);
                $status = SchoolRequestStatus::tryFrom($model->status)->label();
                activity('request')
                    ->performedOn($model)
                    ->by(Auth::user())
                    ->event('updated')
                    ->withProperties([
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

    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->logOnly(['status', 'has_been_assigned_to.name'])
    //         ->logOnlyDirty()
    //         ->dontSubmitEmptyLogs()
    //         ->setDescriptionForEvent(function (string $eventName) {
    //             /*   if ($eventName === 'created') {
    //                 $user = $this->user;
    //                 return "This request has been created by {$user->name}.";
    //             } elseif ($eventName === 'updated' && $this->isDirty('assigned_to') && $this->isDirty('status')) {
    //                 $previousAssignee = $this->getOriginal('assigned_to')
    //                     ? User::find($this->getOriginal('assigned_to'))->getRole()
    //                     : 'None';
    //                 $resRole = $this->has_been_assigned_to->getRole();
    //                 $resRole = RoleType::tryFrom($resRole)?->label() ?? $resRole;
    //                 $status = $this->status;
    //                 return "This request has been assigned to {$resRole} by {$previousAssignee}, and the status has been updated to {$status}.";
    //             } elseif ($eventName === 'updated' && $this->isDirty('status')) {
    //                 return "The status of the has been updated to status {$this->status}.";
    //             } elseif ($eventName === 'updated' && $this->isDirty('assigned_to')) {
    //                 $previousAssignee = $this->getOriginal('assigned_to')
    //                     ? User::find($this->getOriginal('assigned_to'))->getRole()
    //                     : 'None';
    //                 $resRole = $this->has_been_assigned_to->getRole();
    //                 $resRole = RoleType::tryFrom($resRole)?->label() ?? $resRole;
    //                 return "This request has been assigned to {$resRole} by {$previousAssignee}.";
    //             }
    //            */
    //             return "This request has been {$eventName}.";
    //         })
    //         ->dontLogIfAttributesChangedOnly(['updated_at']);
    // }

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
