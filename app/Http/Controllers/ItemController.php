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
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $item = new Item();
        $item = $item->create($request->all());
        if ($request->has('categories')) {
            $categories = explode(',', $request->input('categories'));

            try {
                $item->categories()->sync($categories);
            }
            catch(\Exception $e) {
                return response()->json('Not found categories', 400);
            }
        }
        return response()->json('Item create', 201);
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json('Item not found', 400);
        }
        $validator = \Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $item->update($request->all());
        if ($request->has('categories')) {
            $categories = explode(',', $request->input('categories'));
            try {
                $item->categories()->sync($categories);
            }
            catch(\Exception $e) {
                return response()->json('Not found categories', 400);
            }
        } else {
            $item->categories()->detach();
        }
        return response()->json('Item update', 200);
    }

    public function delete(Request $request, $id)
    {
        $item = Item::find($id);
        if (is_null($item)) {
            return response()->json('Item not found', 400);
        }
        $item->delete();

        return response()->json('Item delete', 204);
    }
}
