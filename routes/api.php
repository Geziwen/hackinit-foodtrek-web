<?php

use Illuminate\Http\Request;
use App\Distributor;
use App\Product;
use App\Http\Resources\Distributor as DistributorResource;
use App\Http\Resources\Product as ProductResource;

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

Route::prefix('transaction/{transaction}')->group(function () {

    Route::post('confirm', 'TransactionController@confirm');

    Route::post('request', 'TransactionController@request');

    Route::post('receive', 'TransactionController@receive');

});

Route::prefix('product')->group(function () {

    Route::post('', 'ProductController@plant');

    Route::post('{product}/harvest', 'ProductController@harvest');

    Route::get('{product}', function ($id) {
        return new ProductResource(Product::find($id));
    });

});

Route::prefix('distributor/{distributor}')->group(function () {

    Route::get('', function ($id) {
        return new DistributorResource(Distributor::find($id));
    });

});

Route::get('distributors', function () {
    return DistributorResource::collection(Distributor::all());
});


