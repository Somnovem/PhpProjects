<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBookRequest;
use App\Http\Requests\UpdateBookRequest;

use App\Models\Book;
use Illuminate\Http\JsonResponse;

class BookController extends Controller
{
    private function handleException(\Exception $e): JsonResponse
    {
        return response()->json(['error' => $e->getMessage()], 500);
    }

    public function index(): \Illuminate\Database\Eloquent\Collection
    {
        return Book::all();
    }

    public function show(Book $book): Book
    {
        return $book;
    }

    public function store(CreateBookRequest $request): Book|string
    {
        try {
            $book = $request->getClassFromRequest();
            $book->save();
            return $book;
        }
        catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function update(UpdateBookRequest $request, Book $book): Book|string
    {
        try {
            return $request->updateModel($book);
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }

    public function destroy(Book $book): string
    {
        try {
            $book->delete();
            return 'Book deleted.';
        } catch (\Exception $e) {
            return $this->handleException($e);
        }
    }
}
