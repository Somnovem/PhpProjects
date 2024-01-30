<?php

namespace App\Services;

use App\Models\PhotoTag;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PhotoTagService implements EntityServiceInterface
{
    function index(int $page, int $per_page): LengthAwarePaginator
    {
        $tags = PhotoTag::paginate($per_page, ['*'], 'page', $page);
        return $tags;
    }

    function store(Request $request) : Model
    {
        $photoTag = new PhotoTag($request->all());
        try {
            $photoTag->save();
        }
        catch (\Exception $e){
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        return $photoTag;

    }

    function show(int $id): Model
    {
        $photo = PhotoTag::where('id', '=', $id)
            ->with('photos')->first();
        return $photo;
    }

    public function update(Request $request, Model $entity): bool
    {
        try {
            $entity->update([
                'name' => $request->input('name'),
                'slug' => $request->input('slug'),
            ]);
            Cache::flush('photo_page*');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        return $entity->update();
    }

    public function destroy(int $id): void
    {
        try {
            $photoTag = PhotoTag::findOrFail($id);
            $photoTag->delete();
        }
        catch (\Exception $e){
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        Cache::flush('photo_page*');
    }
}
