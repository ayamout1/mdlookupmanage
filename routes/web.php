<?php
Route::redirect('/', '/login');

Route::redirect('/home', '/admin/mainfilter/index');

Route::get('sendbasicemail','MailController@basic_email');
Route::get('sendhtmlemail','MailController@html_email');
Route::get('sendattachmentemail','MailController@attachment_email');
Auth::routes(['register' => True]);

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
    Route::resource('users', 'UsersController');

    // Vendor Lookup
    Route::controller(\App\Http\Controllers\Admin\MainfilterController::class)->group(function () {
        Route::get('mainfilter/index', [\App\Http\Controllers\Admin\MainfilterController::class, 'index'])->name('mainfilter.index');
        Route::get('mainfilter/reportprelude', [\App\Http\Controllers\Admin\MainfilterController::class, 'reportprelude'])->name('mainfilter.reportprelude');
        Route::get('mainfilter/reportvendornumbers', [\App\Http\Controllers\Admin\MainfilterController::class, 'reportvendornumbers'])->name('mainfilter.reportvendornumbers');
        Route::get('mainfilter/listvp', [\App\Http\Controllers\Admin\MainfilterController::class, 'listvp'])->name('mainfilter.listvp');
        Route::post('mainfilter/getVendors', [\App\Http\Controllers\Admin\MainfilterController::class, 'getVendors'])->name('mainfilter.getVendors');
    });



    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Task Status
    Route::delete('task-statuses/destroy', 'TaskStatusController@massDestroy')->name('task-statuses.massDestroy');
    Route::resource('task-statuses', 'TaskStatusController');

    // Task Tag
    Route::delete('task-tags/destroy', 'TaskTagController@massDestroy')->name('task-tags.massDestroy');
    Route::resource('task-tags', 'TaskTagController');

    // Task
    Route::delete('tasks/destroy', 'TaskController@massDestroy')->name('tasks.massDestroy');
    Route::post('tasks/media', 'TaskController@storeMedia')->name('tasks.storeMedia');
    Route::post('tasks/ckmedia', 'TaskController@storeCKEditorImages')->name('tasks.storeCKEditorImages');
    Route::resource('tasks', 'TaskController');

    // Tasks Calendar
    Route::resource('tasks-calendars', 'TasksCalendarController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // User Alerts
    Route::delete('user-alerts/destroy', 'UserAlertsController@massDestroy')->name('user-alerts.massDestroy');
    Route::get('user-alerts/read', 'UserAlertsController@read');
    Route::resource('user-alerts', 'UserAlertsController', ['except' => ['edit', 'update']]);

    // Address

    Route::delete('addresses/destroy', 'AddressController@massDestroy')->name('addresses.massDestroy');
    Route::post('addresses/ajaxstore', [\App\Http\Controllers\Admin\AddressController::class, 'ajaxstore'])->name('addresses.ajaxstore');
    Route::resource('addresses', 'AddressController');



// Vendor Assign Engine Product Brand Service

    Route::controller(\App\Http\Controllers\Admin\VendorController::class)->group(function () {
        Route::post('vendors/supdate', [\App\Http\Controllers\Admin\VendorController::class, 'supdate'])->name('vendors.supdate');
        Route::post('vendors/s/assign/la', [\App\Http\Controllers\Admin\VendorController::class, 'assignsla'])->name('vendors.s.assign.la');
        Route::post('vendors/s/assign/de', [\App\Http\Controllers\Admin\VendorController::class, 'assignsde'])->name('vendors.s.assign.de');
        Route::post('vendors/forms/address-form',[\App\Http\Controllers\Admin\VendorController::class, 'addressform'])->name('vendorsaddress');

    });

    // Vendor
    Route::delete('vendors/destroy', 'VendorController@massDestroy')->name('vendors.massDestroy');
    Route::resource('vendors', 'VendorController');

    // Brand
    Route::delete('brands/destroy', 'BrandController@massDestroy')->name('brands.massDestroy');
    Route::resource('brands', 'BrandController');


    //email tester

    // Contact
    Route::delete('contacts/destroy', 'ContactController@massDestroy')->name('contacts.massDestroy');
    Route::post('contacts/ajaxstore', [\App\Http\Controllers\Admin\ContactController::class, 'ajaxstore'])->name('contacts.ajaxstore');
    Route::get('contacts/{id}/editfront/', [\App\Http\Controllers\Admin\ContactController::class, 'editfront'])->name('contacts.editfront');
    Route::resource('contacts', 'ContactController');

    // Engine
    Route::delete('engines/destroy', 'EngineController@massDestroy')->name('engines.massDestroy');
    Route::resource('engines', 'EngineController');

    // Note
    Route::delete('notes/destroy', 'NoteController@massDestroy')->name('notes.massDestroy');
    Route::post('notes/media', 'NoteController@storeMedia')->name('notes.storeMedia');
    Route::post('notes/ckmedia', 'NoteController@storeCKEditorImages')->name('notes.storeCKEditorImages');
    Route::resource('notes', 'NoteController');

    // Prelude Number
    Route::delete('prelude-numbers/destroy', 'PreludeNumberController@massDestroy')->name('prelude-numbers.massDestroy');
    Route::resource('prelude-numbers', 'PreludeNumberController');

    // Product
    Route::delete('products/destroy', 'ProductController@massDestroy')->name('products.massDestroy');
    Route::resource('products', 'ProductController');

    // Service
    Route::delete('services/destroy', 'ServiceController@massDestroy')->name('services.massDestroy');
    Route::resource('services', 'ServiceController');

    // Vendor Number
    Route::delete('vendor-numbers/destroy', 'VendorNumberController@massDestroy')->name('vendor-numbers.massDestroy');
    Route::resource('vendor-numbers', 'VendorNumberController');

    // Asset Category
    Route::delete('asset-categories/destroy', 'AssetCategoryController@massDestroy')->name('asset-categories.massDestroy');
    Route::resource('asset-categories', 'AssetCategoryController');

    // Asset Location
    Route::delete('asset-locations/destroy', 'AssetLocationController@massDestroy')->name('asset-locations.massDestroy');
    Route::resource('asset-locations', 'AssetLocationController');

    // Asset Status
    Route::delete('asset-statuses/destroy', 'AssetStatusController@massDestroy')->name('asset-statuses.massDestroy');
    Route::resource('asset-statuses', 'AssetStatusController');

    // Asset
    Route::delete('assets/destroy', 'AssetController@massDestroy')->name('assets.massDestroy');
    Route::post('assets/media', 'AssetController@storeMedia')->name('assets.storeMedia');
    Route::post('assets/ckmedia', 'AssetController@storeCKEditorImages')->name('assets.storeCKEditorImages');
    Route::resource('assets', 'AssetController');

    // Assets History
    Route::resource('assets-histories', 'AssetsHistoryController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Warranty
    Route::delete('warranties/destroy', 'WarrantyController@massDestroy')->name('warranties.massDestroy');
    Route::post('warranties/media', 'WarrantyController@storeMedia')->name('warranties.storeMedia');
    Route::post('warranties/ckmedia', 'WarrantyController@storeCKEditorImages')->name('warranties.storeCKEditorImages');
    Route::resource('warranties', 'WarrantyController');
//Vendor Lookup
   //


    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
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
