<?php

namespace App\Http\Services\Interfaces;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

interface EntitySeviceInterface
{

    function index(int $page, int $per_page) : LengthAwarePaginator;

    function show(int $id) : Model;
}
