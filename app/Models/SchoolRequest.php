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

class SchoolRequest extends Model implements HasMedia
{
    use HasFactory,LogsActivity,InteractsWithMedia;


    protected $fillable = [
        'title','request_code','description','status','matricule',
        'level_id','department_id','user_id'
    ];

    protected static function boot():void
    {
        parent::boot();
        static::creating(function ($model) {
            $model->request_code= self::generateUniqueRequestCode();
        });
    }
    public  function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->setDescriptionForEvent(fn(string $eventName) => "This school request has been {$eventName}")
            ->dontLogIfAttributesChangedOnly(['status','updated_at']);
    }



    //generate unique request code for school_request

    protected static function generateUniqueRequestCode():string
    {
        return Str::random(15);
    }
//    defining media collections for SchoolRequest
    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('school-request')
            ->useDisk('private')
            ->acceptsMimeTypes(['application/pdf',]);
    }
}