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



// Route::group(['middleware' =>'auth:api'], function(){
    
// });
Route::apiResource('ambassadors','AmbassadorController');
Route::apiResource('guarantors', 'AmbassadorGuarantorController');


Route::post('register', 'JWTAuthController@register');
Route::post('login', 'JWTAuthController@login');
Route::post('logout', 'JWTAuthController@logout');
Route::post('refresh', 'JWTAuthController@refresh');
Route::get('profile', 'JWTAuthController@profile');




















//Update ambassador
// Route::put('ambassadors/{id}','AmbassadorController@update');




// Route::apiResource('ambassadors','AmbassadorController',['except'=>['update']]);


// //list ambassador
// Route::get('ambassadors','AmbassadorController@index');
// //get single amssador
// Route::get('ambassador/{id}','AmbassadorController@show');
// //create new ambassador
// Route::post('ambassador','AmbassadorController@store');
// //Update ambassadro
// Route::put('ambassador/{id}','AmbassadorController@update');
// //Delete ambassador
// Route::delete('ambassador/{id}','AmbassadorController@destroy');























