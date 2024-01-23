<?php

namespace App\Services;

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
        info(' С сущностью работает сервис');
        $photos = Photo::with('category')->paginate($per_page, ['*'], 'page', $page);
        return $photos;
    }

    function store(Request $request) : Model
    {
        $photo = new Photo($request->all());
        $user_id = $request->user()->id;

        // Получаем файл из запроса
        $file = $request->file('photo');
        // Генерируем уникальное имя для файла
        $filename = time() . '_' . $file->getClientOriginalName();

        // Получите путь к файлу
        $filePath = $file->storeAs('public/photos', $filename);
        // Получите URL файла
        $fileUrl = url(Storage::url($filePath));

        // Сохраняем URL в базе
        $photo->url = $fileUrl;

        // Уведомим пользователя о том, что его фото загружено
        $request->user()->notify(new UserUploadPhotoNotification());

        try {
            $photo->save();
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '::' . __METHOD__, (array)$e->getMessage());
        }

        return $photo;
    }

    function show(int $id): Model
    {
        info(' С сущностью работает сервис');
        $photo = Photo::where('id', '=', $id)
            ->with('category', 'tags')->first();
        return $photo;
    }

    public function update(Model $entity): bool
    {
        return $entity->update();
    }

    public function destroy(int $id): void
    {
        $photo = Photo::findOrFail($id);
        $photo->tags()->detach();
        $photo->delete();
    }
}
