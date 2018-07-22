<?php

use Illuminate\Http\Request;
use App\Distributor;
use App\Product;
use App\Food;
use App\Http\Resources\Food as FoodResource;
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
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::post('login', 'Auth\LoginController@ApiLogin');
Route::post('login', function (Request $request) {

    if (auth()->attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
        // Authentication passed...
        $user = auth()->user();
        $user->api_token = str_random(60);
        $user->save();
        return $user;
    }

    return response()->json([
        'error' => 'Unauthenticated user',
        'code' => 401,
    ], 401);
});

Route::middleware('auth:api')->post('logout', function (Request $request) {

    if (auth()->user()) {
        $user = auth()->user();
        $user->api_token = null; // clear api token
        $user->save();

        return response()->json([
            'message' => 'Thank you for using our application',
        ]);
    }

    return response()->json([
        'error' => 'Unable to logout user',
        'code' => 401,
    ], 401);
});

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

Route::get('foods', function () {
    return FoodResource::collection(Food::all());
});

Route::middleware('auth:api')->get('test', function() {
    return Auth::guard('api')->user();
});

