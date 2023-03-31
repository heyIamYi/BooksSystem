<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ItemService;
use App\Http\Resources\ItemResource;
use App\Http\Resources\ItemCollection;
use Illuminate\Support\Facades\Http;

class ItemController extends Controller
{

    protected $itemService;

    public function __construct(ItemService $itemService)
    {

        $this->itemService = $itemService;
    }

    public function index()
    {
        $item = Item::get();

        return response(ItemCollection::make($item), Response::HTTP_OK);
    }

    public function store(Request $request)
    {
        $this->itemService->store($request);
        return response($this->itemService->status, Response::HTTP_CREATED);
    }

    public function show(Item $item)
    {
        return response(ItemResource::make($item), Response::HTTP_OK);
    }

    public function update(Request $request, $id)
    {
       $this->itemService->update($request, $id);
    }

    public function destroy($id)
    {
        $this->itemService->destroy($id);
        return response($this->itemService->status);
    }

    public function deleteSecondImage($id)
    {
        $this->itemService->deleteSecondImage($id);
        return response($this->itemService->status);
    }
}
