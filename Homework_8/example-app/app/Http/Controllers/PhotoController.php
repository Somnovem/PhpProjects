<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::with('category')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoRequest $request)
    {
        try {
            $photo = $request->getModelFromRequest();
            $photo->save();
            return $photo;
        } catch (\Exception $e) {
            return  $e->getMessage();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        $photo = Photo::where('id', '=', $id)->with('category')->get();
        return $photo;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoRequest $request, Photo $photo)
    {
        $photo->update([
            'name' => $request->input('name'),
            'category_id' => $request->input('category_id'),
        ]);
        return $photo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photo $photo)
    {
        $photo->delete();
        return response()->json([], 204);
    }


}
