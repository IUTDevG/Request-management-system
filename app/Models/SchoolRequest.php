<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Database\Eloquent\SoftDeletes;

class SchoolRequest extends Model implements HasMedia
{
    use HasFactory, LogsActivity, InteractsWithMedia, SoftDeletes;


    protected $fillable = [
        'title', 'request_code', 'description', 'status', 'matricule',
        'level_id', 'department_id', 'user_id', 'assigned_to'
    ];

    public function has_been_assigned_to()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

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
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This school request has been {$eventName}")
            ->dontLogIfAttributesChangedOnly(['status', 'updated_at']);
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
