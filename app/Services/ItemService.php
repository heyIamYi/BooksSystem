<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;

class ItemService extends BaseService
{
    public function store(Request $request)
    {
        if ($request->hasfile('image')) {
            $img_path = $this->uploadFile($request->image);
        } else {
            $img_path = null;
        }

        $item = Item::create([
            'name' => $request->name,
            'image' => $img_path,
            'description' => $request->description,
            'introduction' => $request->introduction,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'user_id' => $request->user_id,
        ]);


        // 次要圖片處理
        if ($request->hasfile('second_img')) {
            foreach ($request->second_img as $element) {

                $second_img = $this->uploadFile($element);

                Image::create([
                    'img_path' => $second_img,
                    'item_id' => $item->id,
                ]);
            }
        }

        // 次要圖片處理
        if ($request->hasfile('second_img')) {
            foreach ($request->second_img as $element) {

                $second_img = $this->uploadFile($element);

                Image::create([
                    'img_path' => $second_img,
                    'item_id' => $item->id,
                ]);
            }
        }

        $other = Image::where('item_id', $item->id)->get();
        $getNew = Item::where('id', $item->id)->first();
        $response = ItemResource::make($getNew);
        if ($item && $other) {
            $this->status = [
                'message' => 'Success !',
                'data' => $response
            ];
        } else {
            $this->status = ['message' => 'Fail !'];
        };
    }

    public function update($request, $id)
    {
        $item = Item::find($id);

        if ($request->hasfile('image')) {

            $this->deleteFile($item->image);

            $img_path = $this->uploadFile($request->image);

            $item->image = $img_path;

        }

        if ($request->hasfile('second_img')) {
            foreach ($request->second_img as $element) {

                $second_img = $this->uploadFile($element);

                Image::create([
                    'img_path' => $second_img,
                    'item_id' => $item->id,
                ]);
            }
        }

        if ($request->quantity) {
            $item->quantity = $request->quantity;
        } else {
            $item->quantity = $item->quantity;
        }

        if ($request->price) {
            $item->price = $request->price;
        } else {
            $item->price = $item->price;
        }

        $item->name = $request->name;
        $item->description = $request->description;
        $item->introduction = $request->introduction;

        $item->save();


        $other = Image::where('item_id', $item->id)->get();
        $getItem = Item::where('id', $item->id)->first();
        $response = ItemResource::make($getItem);
        if ($item && $other) {
            $this->status = [
                'message' => 'Update Success !',
                'data' => $response
            ];
        } else {
            $this->status = ['message' => 'Update Fail !'];
        };
    }

    public function destroy($id)
    {
        $item = Item::find($id);
        $images = Image::where('item_id', $id)->get();

        // 刪除主要圖片
        $this->deleteFile($item->image);

        // 刪除次要圖片
        foreach ($images as $img) {
            $this->deleteFile($img->img_path);
            $img->delete();
        }

        $item->delete();

        $this->status = ['message' => 'Delete Success !'];
    }

    public function deleteSecondImage($id)
    {
        $image = Image::where('id', $id)->get();
        foreach ($image as $img) {
            $this->deleteFile($img->img_path);
            $img->delete();
        }
        $this->status = ['message' => 'Success !'];
    }
}
