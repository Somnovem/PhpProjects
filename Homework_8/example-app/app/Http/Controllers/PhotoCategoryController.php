<?php

namespace App\Http\Controllers;

use App\Models\PhotoCategoryModel;
use App\Services\CacheService;
use App\Services\Interfaces\EntityServiceInterface;
use App\Services\PhotoCategoryService;
use Illuminate\Http\Request;
use App\Http\Requests\Photo\CreatePhotoCategoryRequest;
use Illuminate\Support\Facades\Log;

class PhotoCategoryController extends Controller
{

    private EntityServiceInterface $photoCategoryService;
    public function __construct(
        PhotoCategoryService $photoCategoryService)
    {

        $this->photoCategoryService = new CacheService($photoCategoryService,
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

        return $this->photoCategoryService->index($per_page,$page);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoCategoryRequest $request)
    {
        return $this->photoCategoryService->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->photoCategoryService->show($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoCategoryRequest $request, PhotoCategoryModel $model)
    {
        return $this->photoCategoryService->update($request, $model);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $this->photoCategoryService->destroy($id);
        return response()->json([], 204);
    }
}
