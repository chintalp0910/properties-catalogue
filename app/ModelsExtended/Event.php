<?php

namespace App\ModelsExtended;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class Event extends \App\Models\Event
{
    protected $appends = ["image_url"];

    public static function storageHandler(): Filesystem
    {
        return Storage::disk('events');
    }

    public function getImageUrlAttribute()
    {
        return self::storageHandler()->url($this->image);
    }
}