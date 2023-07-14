<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Users
    Route::apiResource('users', 'UsersApiController');

    // Manufacturer
    Route::post('manufacturers/media', 'ManufacturerApiController@storeMedia')->name('manufacturers.storeMedia');
    Route::apiResource('manufacturers', 'ManufacturerApiController');

    // Solution
    Route::post('solutions/media', 'SolutionApiController@storeMedia')->name('solutions.storeMedia');
    Route::apiResource('solutions', 'SolutionApiController');

    // Product
    Route::post('products/media', 'ProductApiController@storeMedia')->name('products.storeMedia');
    Route::apiResource('products', 'ProductApiController');

    // Sophos
    Route::apiResource('sophos', 'SophosApiController');
});
