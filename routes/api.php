<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\APITaskController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InitiativeController;
use App\Http\Controllers\ConexionApiController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\API\CatalogsController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\TaskAsigmentController;
use App\Http\Controllers\APITaskAssignmentConnection;
use App\Http\Controllers\StatusTaskController;
use App\Models\Employee;

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
    Route::get('getTasksByRFC',[APITaskAssignmentConnection::class, 'getTasksByRFC']);
    Route::get('findUser',[ConexionApiController::class, 'read']);
    Route::get('test',[APITaskAssignmentConnection::class, 'getTasksByRFC']);
    Route::get('getUserInfo', [AuthController::class,'userInfo']);
    Route::get('admin/catalogs', [CatalogsController::class, 'index']);

    //Task
    // Route::post('task', [TaskController::class, 'store']);
    // Route::get('task', [TaskController::class, 'index']);
    // Route::get('task/{id}/edit', [TaskController::class, 'edit']);
    // Route::put('task/{id}', [TaskController::class, 'update']);
    // Route::delete('task/{id}', [TaskController::class, 'destroy']);
    Route::get('unasignated-tasks', [TaskController::class, 'getUnasignatedTasks']);
    Route::resource('task',TaskController::class);

    //Task Assignment
    Route::get('task-assignments', [TaskAsigmentController::class, 'index']);

    //Status Task
    // Route::post('task-status', [StatusTaskController::class, 'store']);
    // Route::get('task-status/{id}/status', [StatusTaskController::class, 'edit']);
    Route::post('task-status', [StatusTaskController::class, 'store']);
    Route::get('task-status/{id}/status', [StatusTaskController::class, 'edit']);
    Route::get('task-status/{id}', [StatusTaskController::class, 'getStatus'] );

    //Project
    // Route::post('initiative-project', [ProjectInitiativeController::class, 'store']);
    // Route::get('initiative-project', [ProjectInitiativeController::class, 'index']);
    // Route::put('initiative-project/{id}', [ProjectInitiativeController::class, 'update']);
    // Route::delete('initiative-project/{id}', [ProjectInitiativeController::class, 'destroy']);
    // Route::get('initiative-project/{id}/edit', [ProjectInitiativeController::class, 'edit']);
    Route::resource('project',ProjectController::class);

    //Initiative
    // Route::post('initiative', [InitiativeController::class, 'store']);
    // Route::get('initiative', [InitiativeController::class, 'index']);
    // Route::get('initiative/{id}/edit', [InitiativeController::class, 'edit']);
    // Route::put('initiative/{id}', [InitiativeController::class, 'update']);
    // Route::delete('initiative/{id}', [InitiativeController::class, 'destroy']);
    Route::resource('initiative',InitiativeController::class);
    Route::delete('repository/{id}', [InitiativeController::class, 'destroyRepository']);
    Route::delete('knowledge/{id}', [InitiativeController::class, 'destroyKnowledge']);
    Route::get('unasignated-technologies', [InitiativeController::class, 'getTecnology']);

    //Employee
    Route::get('employees', [EmployeeController::class, 'index']);
    Route::post('employees', [EmployeeController::class, 'store']);
    Route::get('search-by-rfc', [EmployeeController::class, 'searchByRFC']);
    Route::get('check-psp-existence', [EmployeeController::class, 'checkPSPExistence']);
    Route::get('employees', [EmployeeController::class, 'getTask']);

    //API
    Route::get('m-data-task',[ProjectController::class, 'modalDataTask']);
    Route::post('task-assignments',[APITaskController::class, 'listTask']);
    Route::post('update-task-assignments', [APITaskController::class, 'update']);
});
});
