<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemCollection;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Services\ItemService;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ItemController extends Controller
{

    protected $itemService;

    public function __construct(ItemService $itemService)
    {

        $this->itemService = $itemService;
    }

    /**
     * @OA\GET(
     *      path="/api/item",
     *      operationId="itemIdex",
     *      tags={"ITEM"},
     *      summary="取得所有列表",
     *      security={{"bearer_token":{}}},
     *      description="取得所有Item",
     *      @OA\Response(
     *          response=200,
     *          description="請求成功",
     *          content={
     *              @OA\MediaType(
     *              mediaType="application/json",
     *                  example=
     *                  {
     *                      {
     *                             "id": 1,
     *                             "name": "第一本書",
     *                             "description": "這本書內容寫著關於第一本書的東西",
     *                             "introduction": "無數人總是喜歡看書",
     *                             "quantity": 50,
     *                             "price": 350,
     *                             "user_id": 1,
     *                             "image": {
     *                                 "main": "/storage/item/v0Vl3XDnXcvS62dOKayKc2WIRsSXT5Oyt7RH5tsx.jpg",
     *                                 "other_image": {
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     }
     *                                 }
     *                             }
     *                      },
     *                       {
     *                             "id": 2,
     *                             "name": "第二本書",
     *                             "description": "這本書內容寫著關於第一本書的東西",
     *                             "introduction": "無數人總是喜歡看書",
     *                             "quantity": 50,
     *                             "price": 330,
     *                             "user_id": 2,
     *                             "image": {
     *                                 "main": "/storage/item/v0Vl3XDnXcvS62dOKayKc2WIRsSXT5Oyt7RH5tsx.jpg",
     *                                 "other_image": {
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                 }
     *                             }
     *                      },
     *                  }
     *              )
     *          }
     *      )
     * )
     */

    public function index()
    {
        $item = Item::get();

        return response(ItemCollection::make($item), Response::HTTP_OK);
    }

    /**
     * @OA\GET(
     *      path="/api/item/{id}",
     *      operationId="itemShow",
     *      tags={"ITEM"},
     *      summary="取得單一資料",
     *      security={{"bearer_token":{}}},
     *      description="取得單一資料",
     *      @OA\Parameter(
     *          name="id",
     *          description="資料id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="請求成功",
     *          content={
     *              @OA\MediaType(
     *              mediaType="application/json",
     *                  example=
     *                  {
     *                      {
     *                             "id": 1,
     *                             "name": "第一本書",
     *                             "description": "這本書內容寫著關於第一本書的東西",
     *                             "introduction": "無數人總是喜歡看書",
     *                             "quantity": 50,
     *                             "price": 350,
     *                             "user_id": 1,
     *                             "image": {
     *                                 "main": "/storage/item/v0Vl3XDnXcvS62dOKayKc2WIRsSXT5Oyt7RH5tsx.jpg",
     *                                 "other_image": {
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     },
     *                                     {
     *                                         "img_path": "storage/item/SqCRkw29Ea3K9eIaONwv1aTNXScZZoir6gwcB9o7.jpg"
     *                                     }
     *                                 }
     *                             }
     *                      },
     *                  }
     *              )
     *          }
     *      )
     * )
     */

    public function show(Item $item)
    {
        return response(ItemResource::make($item), Response::HTTP_OK);
    }

     /**
     * @OA\POST(
     *      path="/api/item/store",
     *      operationId="itemStore",
     *      tags={"ITEM"},
     *      summary="上傳新項目",
     *      description="如果需要上傳新項目, 請使用此API",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="name",
     *          description="書名",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="書本描述",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="introduction",
     *          description="書本簡介",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="數量",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="價格",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="user_id",
     *          description="上架者id",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="image",
     *          description="書本圖片",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="second_img",
     *          description="其他圖片",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="請求成功",
     *          content={
     *              @OA\MediaType(
     *              mediaType="application/json",
     *                  example=
     *                  {
     *                      "message": "Success !",
     *                      "data": {
     *                          "id": 14,
     *                          "name": "測試",
     *                          "description": "這是一個測試的東西",
     *                          "introduction": "這是介紹",
     *                          "quantity": 132,
     *                          "price": 123,
     *                          "user_id": 1,
     *                          "image": {
     *                              "main": "storage/item/T5YHlfr5Ln3Xi7oh74NwNbtI4HvYTa5jeNHPS67t.gif",
     *                              "other_image": {
     *                                  {
     *                                      "img_path": "storage/item/wudzfzG3UjYaEk8H7WHlxcXFNYu6bTxJ3QicYnsU.gif"
     *                                  },
     *                                  {
     *                                      "img_path": "storage/item/wudzfzG3UjYaEk8H7WHlxcXFNYu6bTxJ3QicYnsU.gif"
     *                                  }
     *                              }
     *                          }
     *                      }
     *                  }
     *              )
     *          }
     *      )
     * )
     */

    public function store(Request $request)
    {
        $this->itemService->store($request);
        return response($this->itemService->status, Response::HTTP_CREATED);
    }

     /**
     * @OA\POST(
     *      path="/api/item/update/{id}",
     *      operationId="itemUpdate",
     *      tags={"ITEM"},
     *      summary="更新指定項目",
     *      description="如果需要更新項目, 請使用此API<br>更新成功後會返回",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="name",
     *          description="書名",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="description",
     *          description="書本描述",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="introduction",
     *          description="書本簡介",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="quantity",
     *          description="數量",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="price",
     *          description="價格",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="image",
     *          description="書本圖片",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="second_img",
     *          description="其他圖片",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="請求成功",
     *          content={
     *              @OA\MediaType(
     *              mediaType="application/json",
     *                  example=
     *                  {
     *                      "message": "Update Success !",
     *                      "data": {
     *                          "id": 1,
     *                          "name": "測試",
     *                          "description": "這是一個測試的東西",
     *                          "introduction": "這是介紹",
     *                          "quantity": 132,
     *                          "price": 123,
     *                          "user_id": 1,
     *                          "image": {
     *                              "main": "storage/item/T5YHlfr5Ln3Xi7oh74NwNbtI4HvYTa5jeNHPS67t.gif",
     *                              "other_image": {
     *                                  {
     *                                      "img_path": "storage/item/wudzfzG3UjYaEk8H7WHlxcXFNYu6bTxJ3QicYnsU.gif"
     *                                  },
     *                                  {
     *                                      "img_path": "storage/item/wudzfzG3UjYaEk8H7WHlxcXFNYu6bTxJ3QicYnsU.gif"
     *                                  }
     *                              }
     *                          }
     *                      }
     *                  }
     *              )
     *          }
     *      )
     * )
     */

    public function update(Request $request, $id)
    {
        $this->itemService->update($request, $id);

        return response($this->itemService->status, Response::HTTP_CREATED);

    }

     /**
     * @OA\POST(
     *      path="/api/item/delete/{id}",
     *      operationId="itemDelete",
     *      tags={"ITEM"},
     *      summary="刪除單一資料",
     *      description="刪除單一資料",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *          name="id",
     *          description="資料id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="請求成功",
     *          content={
     *              @OA\MediaType(
     *              mediaType="application/json",
     *                  example=
     *                  {
     *                      {
     *                          "message": "Delete Success !"
     *                      }
     *                  }
     *              )
     *          }
     *      )
     * )
     */
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
