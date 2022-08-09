<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Address
    Route::apiResource('addresses', 'AddressApiController');

    // Vendor
    Route::apiResource('vendors', 'VendorApiController');

    // Brand
    Route::apiResource('brands', 'BrandApiController');

    // Contact
    Route::apiResource('contacts', 'ContactApiController');

    // Engine
    Route::apiResource('engines', 'EngineApiController');

    // Note
    Route::post('notes/media', 'NoteApiController@storeMedia')->name('notes.storeMedia');
    Route::apiResource('notes', 'NoteApiController');

    // Prelude Number
    Route::apiResource('prelude-numbers', 'PreludeNumberApiController');

    // Product
    Route::apiResource('products', 'ProductApiController');

    // Service
    Route::apiResource('services', 'ServiceApiController');

    // Vendor Number
    Route::apiResource('vendor-numbers', 'VendorNumberApiController');

    // Assets History
    Route::apiResource('assets-histories', 'AssetsHistoryApiController', ['except' => ['store', 'show', 'update', 'destroy']]);

    // Warranty
    Route::post('warranties/media', 'WarrantyApiController@storeMedia')->name('warranties.storeMedia');
    Route::apiResource('warranties', 'WarrantyApiController');
});
