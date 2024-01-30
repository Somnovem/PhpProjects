<?php

namespace App\Http\Controllers;

use App\Events\UserUploadPhotoEvent;
use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Jobs\PreloadUploadedPhotoJob;
use App\Models\Photo;
use App\Notifications\UserUploadPhotoNotification;
use App\Services\CacheService;
use App\Services\Interfaces\EntityServiceInterface;
use App\Services\PhotoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    private EntityServiceInterface $photoService;
    public function __construct(
        PhotoService $photoService)
    {
        // $this->photoService = $photoService;
        $this->photoService = new CacheService($photoService,
            'photo_pages_', 'photo_id',
            env('CACHE_PHOTO_ALL_TTL', 30), env('CACHE_PHOTO_ID_TTL', 30));
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page',2);
        $page = $request->input('page',1);

        return $this->photoService->index($per_page,$page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoRequest $request)
    {
        return $this->photoService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->photoService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoRequest $request, Photo $photo)
    {
        return $this->photoService->update($request, $photo);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->photoService->destroy($id);
        return response()->json([], 204);
    }


}
