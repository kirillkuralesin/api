<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function itemsForCategory(Request $request, $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Category not found', 400);
        }
        $items = $category->items;
        return response()->json($items, 200);
    }
    public function create(Request $request)
    {
        $category = new Category();
        $category = $category->create($request->all());

        return response()->json($category, 201);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Category not found', 400);
        }
        $category->update($request->all());

        return response()->json($category, 200);
    }

    public function delete(Request $request, $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Category not found', 400);
        }
        $category->delete();

        return response()->json(null, 204);
    }
}
