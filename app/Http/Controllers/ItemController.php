<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        return response()->json($items, 200);
    }
    public function create(Request $request)
    {
        $item = new Item();
        $item = $item->create($request->all());
        if ($request->has('categories')) {
            $categories = explode(',', $request->input('categories'));
            $item->categories()->sync($categories);
        }
        return response()->json($item, 201);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json('Item not found', 400);
        }
        $item->update($request->all());
        if ($request->has('categories')) {
            $categories = explode(',', $request->input('categories'));
            $item->categories()->sync($categories);
        } else {
            $item->categories()->detach();
        }
        return response()->json($item, 200);
    }

    public function delete(Request $request, $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json('Item not found', 400);
        }
        $item->delete();

        return response()->json(null, 204);
    }
}
