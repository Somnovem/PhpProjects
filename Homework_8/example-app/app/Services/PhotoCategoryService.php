<?php

namespace App\Services;

use App\Models\PhotoCategoryModel;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PhotoCategoryService implements EntityServiceInterface
{
    function index(int $page, int $per_page): LengthAwarePaginator
    {
        $categories = PhotoCategoryModel::with('photos')->paginate($per_page, ['*'], 'page', $page);
        return $categories;
    }

    function store(Request $request) : Model
    {
        $category = new PhotoCategoryModel($request->all());
        try {
            $category->save();
        }
        catch (\Exception $e){
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        return $category;

    }

    function show(int $id): Model
    {
        $category = PhotoCategoryModel::where('id', '=', $id)
            ->with('photos')->first();
        return $category;
    }

    public function update(Request $request, Model $entity): bool
    {
        try {
            $entity->update([
                'name' => $request->input('name')
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
            $category = PhotoCategoryModel::findOrFail($id);
            if($category->id != "1") $category->delete();
        }
        catch (\Exception $e){
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }
        Cache::flush('photo_page*');
    }
}
