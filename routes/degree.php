<?php

use App\Http\Controllers\Admin\Catalogs\DegreeController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api']], function () {

    Route::resource('degree', DegreeController::class);

}); 