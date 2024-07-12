<?php

namespace App\ModelsExtended\Traits;

use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Indicate that this model can save relative image url.
 */
trait HasImageUrlSavingModelTrait
{
    public function getImageUrlAttribute(): ?string
    {
        return $this->image_relative_url? Storage::disk()->url($this->image_relative_url) : null;
    }

    /**
     * Get traceable file name
     *
     * @param UploadedFile $file
     * @param IHasFolderStoragePathModelInterface $modelBase
     * @param string $containerName
     * @return string
     */
    public static function generateImageRelativePath(UploadedFile $file, IHasFolderStoragePathModelInterface $modelBase, string $containerName = "pictures" ): string
    {
        return  self::generateImageRelativePathWithFileName( $file->hashName(), $modelBase, $containerName );
    }

    /**
     * Get traceable file name
     *
     * @param string $fileName
     * @param IHasFolderStoragePathModelInterface $modelBase
     * @param string $containerName
     * @return string
     */
    public static function generateImageRelativePathWithFileName(string $fileName, IHasFolderStoragePathModelInterface $modelBase, string $containerName = "pictures"): string
    {
        return sprintf("%s/%s/%s",$modelBase->getFolderStorageRelativePath(), $containerName, $fileName);
    }


    /**
     * @param UploadedFile|null $file
     * @return string|null
     */
    public function saveImageOnCloud(?UploadedFile $file): ?string
    {
        if( !$file ) return null;

        $image_relative_url = self::generateImageRelativePath( $file,  $this );
        Storage::disk('public-uploads')->put( $image_relative_url, $file->getContent() );
        return $image_relative_url;
    }
}
