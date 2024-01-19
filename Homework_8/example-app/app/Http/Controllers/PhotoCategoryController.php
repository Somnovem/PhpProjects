<?php

namespace App\Http\Controllers;

use App\Models\PhotoCategoryModel;
use Illuminate\Http\Request;
use App\Http\Requests\Photo\CreatePhotoCategoryRequest;
use Illuminate\Support\Facades\Log;

class PhotoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PhotoCategoryModel::with('photos')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoCategoryRequest $request)
    {
        try {
            $photoCategory = $request->getModelFromRequest();
            $photoCategory->save();
            return $photoCategory;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $cat = PhotoCategoryModel::where('id', '=', $id)
            ->with('photos')->get();
        //dd ($cat);
        return $cat;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoCategoryRequest $request, PhotoCategoryModel $model)
    {
        $modelToUpdate = PhotoCategoryModel::find($request->input('id'));
        if (!$modelToUpdate) {
            return response()->json(['error' => 'Model not found'], 404);
        }
        $modelToUpdate->update([
            'name' => $request->input('name')
        ]);
        return $modelToUpdate;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PhotoCategoryModel $photoCategory)
    {
        if($photoCategory->id != "1")$photoCategory->delete();
        return response()->json([], 204);
    }
}
