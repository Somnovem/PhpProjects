<?php

namespace App\Services;

use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class CacheService implements EntityServiceInterface
{
    /**
     * Создает декаратор кеширования
     * Принимает сервис работы с сущностью и имена для кеша
     * @param EntityServiceInterface $entityService
     * @param $cachePrefixMany
     * @param $cachePrefixById
     */
    public function __construct(
        private EntityServiceInterface $entityService,
        private string $cachePrefixMany,
        private string $cachePrefixById,
        private int $cacheManyTTL = 30,
        private int $cacheByIdTTL = 30
    )
    {
    }

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        info(' работает Кеш');
        $entities = Cache::remember($this->cachePrefixMany . $page . 'per_page' . $per_page, $this->cacheManyTTL
            , function  () use ($per_page, $page) {
                return $this->entityService->index($page, $per_page);
            });
        return $entities;
    }

    function show(int $id): Model
    {
        info(' работает Кеш');
        $entity = Cache::remember($this->cachePrefixById . $id, $this->cacheByIdTTL,
            function  () use ($id) {
                return $this->entityService->show($id);
            });
        return $entity;
    }

    public function update(Model $entity): bool
    {
        Cache::forget($this->cachePrefixById . $entity->id);
        return $this->entityService->update($entity);
    }

    public function destroy(int $id): void
    {
        Cache::forget($this->cachePrefixById . $id);
        $this->entityService->destroy($id);
    }

    function store(Request $request): Model
    {
        return $this->entityService->store($request);
    }
}
