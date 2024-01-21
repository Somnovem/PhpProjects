<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Photo::with('category','tags')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreatePhotoRequest $request)
    {
        try {
            $photo = $request->getModelFromRequest();

            $file = $request->file('photo');
            $filename = time() . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/photos',$filename);
            $photo->url = url(Storage::url($filePath));

            $photo->category()->associate($request->input('category_id'));
            $photo->save();

            if ($request->has('tags')){
                $photo->tags()->attach($request->input('tags'));
            }
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
        try{
            return Photo::where('id', '=', $id)
                ->with('category', 'tags')->get();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreatePhotoRequest $request, Photo $photo)
    {
        try {
            $photo->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
            ]);

            // Detach existing tags
            $photo->tags()->detach();

            // Attach new tags
            if ($request->has('tags')) {
                $photo->tags()->attach($request->input('tags'));
            }

            return $photo;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $photo = Photo::findOrFail($id);
        $photo->tags()->detach();
        $photo->delete();
        return response()->json([], 204);
    }


}
