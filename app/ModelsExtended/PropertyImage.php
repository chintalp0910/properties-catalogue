<?php

namespace App\ModelsExtended;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class PropertyImage extends \App\Models\PropertyImage
{
    protected $appends = ["image_url"];

    public static function storageHandler(): Filesystem
    {
        return Storage::disk('properties');
    }

    public function getImageUrlAttribute()
    {
        return self::storageHandler()->url($this->image);
    }
}