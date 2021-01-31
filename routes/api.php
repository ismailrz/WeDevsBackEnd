<?php

use Illuminate\Http\Request;

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


Route::get('/get-products','ProductController@get_products');
Route::get('/get-edit-product/{productId}','ProductController@get_edit_product');
Route::post('/create-product','ProductController@create_product');
Route::put('/update-product','ProductController@update_product');
Route::delete('/delete-product/{productId}','ProductController@delete_product');
// Route::group([
//     'middleware' => ['api', 'cors'],
//     'namespace' => $this->namespace,
//     'prefix' => 'api',
// ], function ($router) {
//      //Add you routes here, for example:
//         Route::apiget('/get-products','ProductController@get_products');
//         Route::apipost('/create-product','ProductController@create_product');
//     //  Route::apiResource('/posts','PostController');
// });

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
