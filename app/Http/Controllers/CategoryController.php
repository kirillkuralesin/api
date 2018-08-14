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
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:categories|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = new Category();
        $category->create($request->all());

        return response()->json('Category create', 201);
    }

    public function update(Request $request, $id)
    {
        $validator = \Validator::make($request->all(), [
            'name' => 'required|unique:categories,id,' . $id . '|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Category not found', 400);
        }
        $category->update($request->all());

        return response()->json('Category update', 200);
    }

    public function delete(Request $request, $id)
    {
        $category = Category::find($id);
        if (is_null($category)) {
            return response()->json('Category not found', 400);
        }
        $category->delete();

        return response()->json('Category delete', 204);
    }
}
