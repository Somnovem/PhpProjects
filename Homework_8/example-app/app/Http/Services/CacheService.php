<?php

namespace App\Http\Services;

use App\Http\Services\Interfaces\EntitySeviceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CacheService implements EntitySeviceInterface
{
    public function __construct(private EntitySeviceInterface $entitySevice,
                                private string $cachePrefixMany,
                                private int $cacheManyTTL,
                                private string $cachePrefixById,
                                private ?int $cacheByIdTTL = null)
    {

    }

    function index(int $page, int $per_page): LengthAwarePaginator
    {
        return $this->entitySevice->index($page,$per_page);
    }

    function show(int $id): Model
    {
        return $this->entityService->show($id);
    }
}
