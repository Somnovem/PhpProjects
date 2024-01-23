<?php

namespace App\Http\Controllers\Base;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Services\Interfaces\EntityServiceInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BaseResourceController extends Controller
{
    protected function __construct()
    {
    }

    protected EntityServiceInterface $entityService;

    public function index(Request $request)
    {
        $per_page = $request->input('per_page', 2);
        $page = $request->input('page', 1);
        return $this->entityService->index($page, $per_page);
    }

    public function store(Request $request)
    {
        return $this->entityService->store($request);
    }

    public function show(int $id)
    {
        return $this->entityService->show($id);
    }

    public function update(Request $request, Model $entity)
    {
        return $this->entityService->update($entity);
    }

    public function destroy(int $id)
    {
        $this->entityService->destroy($id);
        return response()->json([], 204);
    }



}
