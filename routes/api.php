<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Iot\IotLogController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* 회원로그인 관련 */
Route::post('/login/phone/checkPhoneNo', [UserController::class, 'checkPhoneNo']);
Route::post('/login/phone/checkPhoneAuth', [UserController::class, 'checkPhoneAuth']);
Route::post('/loginok', [LoginController::class, 'userLogin']);
Route::any('/userlogout', [LoginController::class, 'userlogout']);

/* 회원가입관련 */
Route::any('/join/checkDupPhone', [UserController::class, 'checkDupPhone']);
Route::any('/join/checkDupEmail', [UserController::class, 'checkDupEmail']);
Route::any('/join/checkDupNickName', [UserController::class, 'checkDupNickName']);
Route::any('/join/regist', [UserController::class, 'regist']);

/* IOT 로그관련 */
Route::any('/iotlog', [IotLogController::class, 'input']);
Route::any('/iotlog/form', [IotLogController::class, 'form']);


// Route::middleware(['auth:sanctum'])->group(function () {
//     Route::any('/users',function (Request $request){
//         return 1;
//         return $request->user();
//     });
// });
Route::middleware('auth:sanctum')->any('/user2', function (Request $request) {
    return response(1);
    return $request->user();
});
