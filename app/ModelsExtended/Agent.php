<?php

namespace App\ModelsExtended;

use App\ModelsExtended\Interfaces\IHasFolderStoragePathModelInterface;
use App\ModelsExtended\Interfaces\IHasImageRelativeUrlInterface;
use App\ModelsExtended\Traits\HasImageUrlSavingModelTrait;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class Agent extends \App\Models\Agent implements IHasImageRelativeUrlInterface, IHasFolderStoragePathModelInterface
{
    use HasImageUrlSavingModelTrait;

    protected $appends = ["image_url"];

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

    public function getFolderStorageRelativePath(): string
    {
        return "agents/" . strval( $this->id );
    }
}