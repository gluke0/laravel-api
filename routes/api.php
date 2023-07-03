<?php

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TechnologyController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/projects', [ProjectController::class, 'index']);

// new route to show a single prj baseon on the slug
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

// retrieval and display of categories when a GET request is made to that URL
Route::get('/categories', [CategoryController::class, 'index']);

// retries all the technologies used in prjs in order to filter them 
Route::get('/technologies', [TechnologyController::class, 'index']);

