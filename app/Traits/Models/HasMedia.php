<?php

namespace App\Traits\Models;

use App\Models\Media;
use App\Traits\Support\ResolveMedia;

trait HasMedia
{
    use ResolveMedia;

    private $file, $storage, $file_path, $media;

    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }

    public function images()
    {
        return $this->morphMany(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_IMAGE);
    }

    public function image()
    {
        return $this->morphOne(Media::class, 'mediable')
            ->where('collection_name', Media::COLLECTION_IMAGE);
    }
}
