<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

/**
 * @OA\OpenApi(
 *  @OA\Info(
 *      title="Simple-Project API",
 *      version="1.0.0",
 *      description="這是一份針對專案呈現而撰寫的swagger文件<br>",
 *      @OA\Contact(
 *          email="verysimplesetting@gmail.com"
 *      )
 *  ),
 *  @OA\Server(
 *      description="主機",
 *      url="https://coladog.space/"
 *  ),
 * )
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function csrf()
    {
        return csrf_token();
    }

    /**
     * @OA\POST(
     *      path="/api/login",
     *      operationId="Login",
     *      tags={"驗證相關"},
     *      summary="登入",
     *      description="登入使用者, 並取得token, <br>得到的token要放入header的Authorization參數 ex Bearer空格<回傳token><br><br>測試信箱: test@fackmail.com<br>信箱密碼: 123456<br>",
     *      @OA\Parameter(
     *          name="email",
     *          description="信箱",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="string"
     *          )
     *      ),
     *      @OA\Parameter(
     *          name="password",
     *          description="密碼",
     *          required=true,
     *          in="path",
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
     *                      {
     *                          "token": "eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzk4MGQ2NzcyMjk1MTVmNTAyZTJiM2E0ZGYxODkxNDBmNmNiNjYwOWY1NGE5NWNiYjg3YzcxODBhNDc1ODZmYTU3MDU1ZWRmMjg4OGRlZTUiLCJpYXQiOjE2ODExMzA0MTYuMzI3NzksIm5iZiI6MTY4MTEzMDQxNi4zMjc3OTMsImV4cCI6MTY5Njk0MTYxNi4xNzAwMjMsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.j3MKynxeXeLKIsLiSxxW0WFKUZbb_O_rgufbUXW80k670Cjocf-Nb4TGrjcZlFWwYBUaQH4E4_qot09KNBB3Sk5uUz3RdSP7PcfI7hJ245NoqWwZCasFULcUsjIC12HkJRHuWsThGwivhFiYiLJbG6Bt3uO40lDeOSaVdClu7bTcbea6xovAib42bq83epsI2185tT9eEkT929Q_EV8y3BMpjQiQP_QSbPiXteyl3Ss2LQA2mlvzz9D50pTazO6bq2JOrJZzwTGgwr23kkDo6MyXWuvKt-b6G62jD1e4vp9TRbtBZwMqLZIRQgPLB6cw9JGTtUr8sLSaMimW08CqHwZf9bPuENmBWb4Vuw59SCr9rRqVUvJjWnvrjFil2OCB9xDF76_bH5Tt3ISbkgQurD18TtNOd1tK5CwLQXnAzf2Clwa0SlthnHOD6fjrDjXMq3YqLrwWBTbhQ2xFCNkqW8jD2N6--m1R82XZyjQgmxNDTMxmQicdVIzC3vxTDK7NjWO6vWuYPQE2NblhjiC8Ktfu0ddA51VbNCZMyDro5AwgDycHKNqURrFLh7hsfCayPUMfESKYIkX97c-BJGEDsrCs-9602fk6Ym4UWMMApYWPWXKSALiklBX0h5GOYn4OmUbFlJBNvH_5le_DwVSPSZQpJxcXLBEPl0sIDnsyZa0"
     *                      }
     *              )
     *          }
     *       ),
     *      )
     * )
     */

    public function login(Request $request)
    {
        $input = $request->all();
        $vallidation = Validator::make($input, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($vallidation->fails()) {
            return response()->json(['error' => $vallidation->errors()], 422);
        }

        if (Auth::attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::user();
            $token = $user->createToken('UserToken')->accessToken;

            return response()->json(['token' => $token]);
        }
    }
}
