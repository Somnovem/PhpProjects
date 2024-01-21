<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoTagRequest;
use App\Models\PhotoTag;

class PhotoTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PhotoTag::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoTagRequest $request)
    {
        try {
            $photoTag = $request->getModelFromRequest();
            $photoTag->save();
            return $photoTag;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return PhotoTag::where('id','=',$id)
            ->with('photos')->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoTagRequest $request, PhotoTag $model)
    {
        try {
            $model->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);
            return $model;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $photoTag = PhotoTag::findOrFail($id);
            $photoTag->delete();
            return response()->json([], 204);
        }
        catch (\Exception $e){
            return $e->getMessage();
        }
    }
}
