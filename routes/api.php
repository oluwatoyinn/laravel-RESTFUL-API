<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('ambassadors','AmbassadorController');





















// //list ambassador
// Route::get('ambassadors','AmbassadorController@index');
// //get single amssador
// Route::get('ambassador/{id}','AmbassadorController@show');
// //create new ambassador
// Route::post('ambassador','AmbassadorController@store');
// //Update ambassadro
// Route::put('ambassador/{id}','AmbassadorController@store');
// //Delete ambassador
// Route::delete('ambassador/{id}','AmbassadorController@destroy');




