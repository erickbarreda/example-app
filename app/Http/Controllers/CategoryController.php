<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return Category::all();
    }

    public function show(Category $category)
    {
        return $category;
    }

    public function store(Request $request)
    {
        Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Categoría registrada']);
    }

    public function update(Request $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return response()->json(['message' => 'Categoría actualizada']);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json(['message' => 'Categoría eliminada']);
    }
}
