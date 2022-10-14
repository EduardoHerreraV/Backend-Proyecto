<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\Catalogs\DegreeController;
use App\Http\Controllers\ConexionApiController;
use App\Http\Controllers\API\CatalogsController;

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
Route::group(['middleware' => ['cors']], function () {
    //Rutas a las que se permitirá acceso

Route::post('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => ['auth:api']], function () {
    Route::get('findUser',[ConexionApiController::class, 'read']);
    Route::get('getUserInfo', [AuthController::class,'userInfo']);
    Route::get('admin/catalogs', [CatalogsController::class, 'index']);


    Route::resource('user',UserController::class);
    Route::resource('degree', DegreeController::class);

});
});
