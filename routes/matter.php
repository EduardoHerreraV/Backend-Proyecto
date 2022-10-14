<?php

use App\Http\Controllers\Admin\Catalogs\MatterController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('matter', MatterController::class);

}); 