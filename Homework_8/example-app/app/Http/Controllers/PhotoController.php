<?php

namespace App\Http\Controllers;

use App\Http\Requests\Photo\CreatePhotoRequest;
use App\Http\Services\Interfaces\EntitySeviceInterface;
use App\Http\Services\PhotoService;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    private EntitySeviceInterface $photoSevice;
    public function __construct(
        private PhotoService $photoService)
    {

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
        try {
            Log::debug($request->user());
            $photo = $request->getModelFromRequest();
            $file = $request->file('photo');
            $filename = time() . $file->getClientOriginalName();
            $filePath = $file->storeAs('public/photos',$filename);
            $photo->url = url(Storage::url($filePath));
            $photo->user_id = $request->user()->id;
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
        return $this->photoService->show($id);
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
            Cache::forget('photo_id_'.$photo->id);
            Cache::flush('photo_page*');
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
        Cache::forget('photo_id_'.$photo->id);
        Cache::flush('photo_page*');
        $photo->tags()->detach();
        $photo->delete();
        return response()->json([], 204);
    }


}
