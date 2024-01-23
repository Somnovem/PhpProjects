<?php

namespace App\Services\Interfaces;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface EntityServiceInterface
{

    /**
     * Получение всех записей сущности
     * @param int $page
     * @param int $per_page
     * @return LengthAwarePaginator
     */
    function index(int $page, int $per_page)  : LengthAwarePaginator;

    /**
     * Получение 1 записи из базы данных
     * @param int $id
     * @return Model
     */
    function show(int $id) : Model;

    /**
     * Сохраняет модель
     * @param Request $request
     * @param Model $model
     * @return Model
     */
    function store(Request $request) : Model;

    /**
     * Обновление сущности
     * @param Model $entity
     * @return bool
     */
    public function update(Model $entity) : bool;

    /**
     * Удаление сущности
     * @param int $id
     * @return void
     */
    public function destroy(int $id) : void;


}
