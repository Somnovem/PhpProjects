<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoTagRequest;
use App\Models\PhotoTag;
use App\Services\CacheService;
use App\Services\Interfaces\EntityServiceInterface;
use App\Services\PhotoTagService;
use Illuminate\Http\Request;

class PhotoTagController extends Controller
{

    private EntityServiceInterface $photoTagService;
    public function __construct(
        PhotoTagService $photoTagService)
    {

        $this->photoTagService = new CacheService($photoTagService,
            'photo_tags_', 'photo_tag_id',
            env('CACHE_PHOTO_ALL_TTL', 30), env('CACHE_PHOTO_ID_TTL', 30));
    }


    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $per_page = $request->input('per_page',2);
        $page = $request->input('page',1);

        return $this->photoTagService->index($per_page,$page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoTagRequest $request)
    {
        return $this->photoTagService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->photoTagService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoTagRequest $request, PhotoTag $model)
    {
        return $this->photoTagService->update($request, $model);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->photoTagService->destroy($id);
        return response()->json([], 204);
    }
}
