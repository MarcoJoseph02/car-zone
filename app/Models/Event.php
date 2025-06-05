<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia; 
use Spatie\MediaLibrary\InteractsWithMedia; 

class Event extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    protected $fillable = [
        'event_name',
        // 'image',
        'event_date',
        'event_time',
        'event_location',
        'event_description',
        'event_status',
        'content',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('event_image');//->useDisk('public'); // Store images in the public disk
    }
}