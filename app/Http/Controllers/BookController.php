<?php

namespace App\Http\Controllers;

use App\Http\Requests\Books\StoreBookRequest;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        //return Book::all();
        return Book::with('author', 'partner')->get();
    }

    public function show(Book $book)
    {
        return [
            'title' => $book->title,
            'author' => $book->author->name . ' ' . $book->author->last_name,
            'categories' => $book->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,
                ];
            }),
        ];
    }

    public function store(StoreBookRequest $request)
    {
        Book::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'partner_id' => $request->partner_id,
            'author_id' => $request->author_id,
        ])->categories()->attach($request->categories);

        return response()->json(['message' => 'Libro registrado']);
    }

    public function update(Request $request, Book $book)
    {
        $book->update([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'partner_id' => $request->partner_id,
            'author_id' => $request->author_id,
        ]);

        $book->categories()->sync($request->categories);

        return response()->json(['message' => 'Libro actualizado']);
    }

    public function destroy(Book $book)
    {
        $book->categories()->detach();
        
        $book->delete();

        return response()->json(['message' => 'Libro eliminado']);
    }
}
