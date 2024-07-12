<?php

namespace App\ModelsExtended\Traits;

use Illuminate\Support\Facades\File;

trait PropertyLocalImageRelativeTrait
{
    /**
     * @return string
     */
    public static function getDefaultNoImageFullUrl(): string
    {
        return asset('assets/front/images/propery_image.png');
    }

    /**
     * @return bool
     */
    public function imageExists(): bool
    {
        return $this->image_relative_url && File::exists($this->getImageLocalPath());
    }

    /**
     * @return string
     */
    public function getImageCompleteRelativePath(): string
    {
        return 'property_image/' . $this->image_relative_url ;
    }

    /**
     * @return string
     */
    public function getImageLocalPath(): string
    {
        return public_path($this->getImageCompleteRelativePath());
    }

    /**
     * @return string
     */
    public function getFullUrlOrDefaultUrl(): string
    {
        return $this->imageExists() ?  asset($this->getImageCompleteRelativePath() ) : self::getDefaultNoImageFullUrl();
    }
}