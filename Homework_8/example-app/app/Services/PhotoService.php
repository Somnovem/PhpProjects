<?php

namespace App\Services;

use App\Events\UserUploadPhotoEvent;
use App\Jobs\PreloadUploadedPhotoJob;
use App\Models\Photo;
use App\Notifications\UserUploadPhotoNotification;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoService implements EntityServiceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        $photos = Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
        return $photos;
    }

    function store(Request $request) : Model
    {
        $photo = new Photo($request->all());
        $file = $request->file('photo');
        $filename = time() . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/photos',$filename);
        $photo->storage_path = $filePath;
        $photo->url = url(Storage::url($filePath));
        $photo->user_id = $request->user()->id;
        try {
            $photo->save();
            //event(new UserUploadPhotoEvent($photo));
            UserUploadPhotoEvent::dispatch($photo);
            PreloadUploadedPhotoJob::dispatch($filePath);
            $request->user()->notify(new UserUploadPhotoNotification());
        }
        catch (\Exception $e){
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }

        return $photo;

    }

    function show(int $id): Model
    {
        $photo = Photo::where('id', '=', $id)
            ->with('category', 'tags')->first();
        return $photo;
    }

    public function update(Request $request, Model $entity): bool
    {
        try {
            $entity->update([
                'name' => $request->input('name'),
                'category_id' => $request->input('category_id'),
            ]);
            $entity->tags()->detach();
            if ($request->has('tags')) {
                $entity->tags()->attach($request->input('tags'));
            }
            Cache::flush('photo_page*');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        return $entity->update();
    }

    public function destroy(int $id): void
    {
        $photo = Photo::findOrFail($id);
        $photo->tags()->detach();
        $photo->delete();
        Cache::flush('photo_page*');
    }
}
