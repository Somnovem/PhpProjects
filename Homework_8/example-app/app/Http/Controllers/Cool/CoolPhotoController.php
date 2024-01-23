<?php

namespace App\Http\Controllers\Cool;

use App\Http\Controllers\Base\BaseResourceController;
use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Services\CacheService;
use App\Services\PhotoService;

class CoolPhotoController extends BaseResourceController
{
    public function __construct(PhotoService $photoService)
    {
        parent::__construct();
        // $this->entityService = $photoService;
        $this->entityService = new CacheService($photoService,
            'photo_pages_', 'photo_id_',
            env('CACHE_PHOTO_ALL_TTL', 30), env('CACHE_PHOTO_ID', 30));
    }
}
