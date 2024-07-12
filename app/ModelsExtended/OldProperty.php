<?php

namespace App\ModelsExtended;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;

class OldProperty extends \App\Models\OldProperty
{
    protected $appends = ["image_url"];

    public static function storageHandler(): Filesystem
    {
        return Storage::disk('property_gallery');
    }

    public function getImageUrlAttribute()
    {
        return self::storageHandler()->url($this->image);
    }
}