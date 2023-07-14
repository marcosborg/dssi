<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::post('users/parse-csv-import', 'UsersController@parseCsvImport')->name('users.parseCsvImport');
    Route::post('users/process-csv-import', 'UsersController@processCsvImport')->name('users.processCsvImport');
    Route::resource('users', 'UsersController');

    // Manufacturer
    Route::delete('manufacturers/destroy', 'ManufacturerController@massDestroy')->name('manufacturers.massDestroy');
    Route::post('manufacturers/media', 'ManufacturerController@storeMedia')->name('manufacturers.storeMedia');
    Route::post('manufacturers/ckmedia', 'ManufacturerController@storeCKEditorImages')->name('manufacturers.storeCKEditorImages');
    Route::post('manufacturers/parse-csv-import', 'ManufacturerController@parseCsvImport')->name('manufacturers.parseCsvImport');
    Route::post('manufacturers/process-csv-import', 'ManufacturerController@processCsvImport')->name('manufacturers.processCsvImport');
    Route::resource('manufacturers', 'ManufacturerController');

    // Solution
    Route::delete('solutions/destroy', 'SolutionController@massDestroy')->name('solutions.massDestroy');
    Route::post('solutions/media', 'SolutionController@storeMedia')->name('solutions.storeMedia');
    Route::post('solutions/ckmedia', 'SolutionController@storeCKEditorImages')->name('solutions.storeCKEditorImages');
    Route::post('solutions/parse-csv-import', 'SolutionController@parseCsvImport')->name('solutions.parseCsvImport');
    Route::post('solutions/process-csv-import', 'SolutionController@processCsvImport')->name('solutions.processCsvImport');
    Route::resource('solutions', 'SolutionController');

    // Category
    Route::delete('categories/destroy', 'CategoryController@massDestroy')->name('categories.massDestroy');
    Route::post('categories/media', 'CategoryController@storeMedia')->name('categories.storeMedia');
    Route::post('categories/ckmedia', 'CategoryController@storeCKEditorImages')->name('categories.storeCKEditorImages');
    Route::resource('categories', 'CategoryController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');

    // Sophos
    Route::delete('sophos/destroy', 'SophosController@massDestroy')->name('sophos.massDestroy');
    Route::post('sophos/parse-csv-import', 'SophosController@parseCsvImport')->name('sophos.parseCsvImport');
    Route::post('sophos/process-csv-import', 'SophosController@processCsvImport')->name('sophos.processCsvImport');
    Route::resource('sophos', 'SophosController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
