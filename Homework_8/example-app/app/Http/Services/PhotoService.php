<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\EntitySeviceInterface;
use App\Models\Photo;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class PhotoService implements EntitySeviceInterface
{

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        //$photos =  Photo::with('category','tags')->paginate($per_page);
        $cache_key = 'photo_page' . $page . 'per_page' . $per_page;
        $photos = Cache::remember($cache_key, env('CACHE_PHOTO_ALL_TTL')
            , function () use($per_page, $page) {
                return Photo::with('category','tags')->paginate($per_page, ['*'], 'page', $page);
            });

        return $photos;
    }

    function show(int $id): Model
    {
//        try{
//            $photo = Cache::remember('photo_id_', env('CACHE_PHOTO_ALL_TTL')
//                , function () use($id) {
//                    return Photo::where('id', '=', $id)
//                        ->with('category', 'tags')->first();
//                });
//            return $photo;
//        } catch (\Exception $e) {
//            return $e->getMessage();
//        }

        try{
            return Photo::where('id', '=', $id)
                ->with('category', 'tags')->first();
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
