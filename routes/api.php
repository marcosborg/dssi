<?php

Route::apiResource('solutions', 'Api\V1\Admin\SolutionApiController');
Route::apiResource('products', 'Api\V1\Admin\ProductApiController');
Route::get('product/{product_id}', 'Api\V1\Admin\ProductApiController@product');
Route::apiResource('manufacturers', 'Api\V1\Admin\ManufacturerApiController');
Route::post('filter', 'Api\V1\Admin\ProductApiController@filter');
Route::post('search', 'Api\V1\Admin\ProductApiController@search');
Route::apiResource('countries', 'Api\V1\Admin\CountryApiController');

Route::post('register', 'Api\AuthController@register');
Route::post('login', 'Api\AuthController@login');
Route::middleware('auth:sanctum')->get('user', 'Api\AuthController@user');

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Manufacturer
    Route::post('manufacturers/media', 'ManufacturerApiController@storeMedia')->name('manufacturers.storeMedia');
    Route::apiResource('manufacturers', 'ManufacturerApiController');

    // Solution
    Route::post('solutions/media', 'SolutionApiController@storeMedia')->name('solutions.storeMedia');
    Route::apiResource('solutions', 'SolutionApiController');

    // Stock
    Route::apiResource('stocks', 'StockApiController');

    // Crash Plan
    Route::apiResource('crash-plans', 'CrashPlanApiController');

    // K Seven Security
    Route::apiResource('k-seven-securities', 'KSevenSecurityApiController');

    // Mail Store
    Route::apiResource('mail-stores', 'MailStoreApiController');

    // Own Cloud
    Route::apiResource('own-clouds', 'OwnCloudApiController');

    // Titan Hq
    Route::apiResource('titan-hqs', 'TitanHqApiController');

    // Ubiquiti
    Route::apiResource('ubiquitis', 'UbiquitiApiController');

    // Wasabi
    Route::apiResource('wasabis', 'WasabiApiController');

    // Nakivo
    Route::apiResource('nakivos', 'NakivoApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Company
    Route::apiResource('companies', 'CompanyApiController');

    // Country
    Route::apiResource('countries', 'CountryApiController');

    // Chat
    Route::apiResource('chats', 'ChatApiController');
});
