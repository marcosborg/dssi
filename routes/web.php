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

    // Stock
    Route::delete('stocks/destroy', 'StockController@massDestroy')->name('stocks.massDestroy');
    Route::post('stocks/parse-csv-import', 'StockController@parseCsvImport')->name('stocks.parseCsvImport');
    Route::post('stocks/process-csv-import', 'StockController@processCsvImport')->name('stocks.processCsvImport');
    Route::resource('stocks', 'StockController');

    // Crash Plan
    Route::delete('crash-plans/destroy', 'CrashPlanController@massDestroy')->name('crash-plans.massDestroy');
    Route::post('crash-plans/parse-csv-import', 'CrashPlanController@parseCsvImport')->name('crash-plans.parseCsvImport');
    Route::post('crash-plans/process-csv-import', 'CrashPlanController@processCsvImport')->name('crash-plans.processCsvImport');
    Route::resource('crash-plans', 'CrashPlanController');

    // K Seven Security
    Route::delete('k-seven-securities/destroy', 'KSevenSecurityController@massDestroy')->name('k-seven-securities.massDestroy');
    Route::post('k-seven-securities/parse-csv-import', 'KSevenSecurityController@parseCsvImport')->name('k-seven-securities.parseCsvImport');
    Route::post('k-seven-securities/process-csv-import', 'KSevenSecurityController@processCsvImport')->name('k-seven-securities.processCsvImport');
    Route::resource('k-seven-securities', 'KSevenSecurityController');

    // Mail Store
    Route::delete('mail-stores/destroy', 'MailStoreController@massDestroy')->name('mail-stores.massDestroy');
    Route::post('mail-stores/parse-csv-import', 'MailStoreController@parseCsvImport')->name('mail-stores.parseCsvImport');
    Route::post('mail-stores/process-csv-import', 'MailStoreController@processCsvImport')->name('mail-stores.processCsvImport');
    Route::resource('mail-stores', 'MailStoreController');

    // Own Cloud
    Route::delete('own-clouds/destroy', 'OwnCloudController@massDestroy')->name('own-clouds.massDestroy');
    Route::post('own-clouds/parse-csv-import', 'OwnCloudController@parseCsvImport')->name('own-clouds.parseCsvImport');
    Route::post('own-clouds/process-csv-import', 'OwnCloudController@processCsvImport')->name('own-clouds.processCsvImport');
    Route::resource('own-clouds', 'OwnCloudController');

    // Titan Hq
    Route::delete('titan-hqs/destroy', 'TitanHqController@massDestroy')->name('titan-hqs.massDestroy');
    Route::post('titan-hqs/parse-csv-import', 'TitanHqController@parseCsvImport')->name('titan-hqs.parseCsvImport');
    Route::post('titan-hqs/process-csv-import', 'TitanHqController@processCsvImport')->name('titan-hqs.processCsvImport');
    Route::resource('titan-hqs', 'TitanHqController');

    // Ubiquiti
    Route::delete('ubiquitis/destroy', 'UbiquitiController@massDestroy')->name('ubiquitis.massDestroy');
    Route::post('ubiquitis/parse-csv-import', 'UbiquitiController@parseCsvImport')->name('ubiquitis.parseCsvImport');
    Route::post('ubiquitis/process-csv-import', 'UbiquitiController@processCsvImport')->name('ubiquitis.processCsvImport');
    Route::resource('ubiquitis', 'UbiquitiController');

    // Wasabi
    Route::delete('wasabis/destroy', 'WasabiController@massDestroy')->name('wasabis.massDestroy');
    Route::post('wasabis/parse-csv-import', 'WasabiController@parseCsvImport')->name('wasabis.parseCsvImport');
    Route::post('wasabis/process-csv-import', 'WasabiController@processCsvImport')->name('wasabis.processCsvImport');
    Route::resource('wasabis', 'WasabiController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::post('products/media', 'ProductController@storeMedia')->name('products.storeMedia');
    Route::post('products/ckmedia', 'ProductController@storeCKEditorImages')->name('products.storeCKEditorImages');
    Route::post('products/parse-csv-import', 'ProductController@parseCsvImport')->name('products.parseCsvImport');
    Route::post('products/process-csv-import', 'ProductController@processCsvImport')->name('products.processCsvImport');
    Route::resource('products', 'ProductController');
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
