<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{

    public function index()
    {
        $item = Item::get();

        return response(['item' => $item], Response::HTTP_OK);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {

        // // 圖片處理
        // $path = Storage::disk('local')->put(
        //     'public/item',
        //     $request->image
        // );

        // $path = str_replace('public', 'storage', $path);

        // dd($request);
        $item = Item::create([
            'name' => $request->name,
            // 'image' => '/' . $path,
            'image' => '/',
            'description' => $request->description,
            'introduction' => $request->introduction,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'user_id' => $request->user_id,
        ]);

        return response($item, Response::HTTP_CREATED);
    }

    public function show(Item $item)
    {
        //
    }

    public function edit(Item $item)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);

        if ($request->hasfile('image')) {
            $path = '/';
            $item->image = $path;
        }

       $item->name = $request->name;
       $item->description = $request->description;
       $item->introduction = $request->introduction;
       $item->quantity = $request->quantity;
       $item->price = $request->price;
       $item->user_id = $request->user_id;

       $item->save();

    }

    public function destroy($id)
    {
        $item = Item::find($id);

        // $target = str_replace('/storage', 'public', $item->image);
        // Storage::disk('local')->delete($target);
        $item->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
