<?php

namespace App\ModelsExtended;

use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends \App\Models\News
{
    use HasSlug;

    protected $appends = ["image_url"];

    /**
     * @param int $id
     * @return News
     */
    public static function getById(int $id)
    {
        return self::find($id);
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('seourl');
    }

    public static function storageHandler(): Filesystem
    {
        return Storage::disk('news');
    }

    public function getImageUrlAttribute()
    {
        return self::storageHandler()->url($this->image);
    }
}
