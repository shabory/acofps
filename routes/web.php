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
    Route::post('users/media', 'UsersController@storeMedia')->name('users.storeMedia');
    Route::post('users/ckmedia', 'UsersController@storeCKEditorImages')->name('users.storeCKEditorImages');
    Route::resource('users', 'UsersController');

    // Country
    Route::delete('countries/destroy', 'CountryController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountryController');

    // City
    Route::delete('cities/destroy', 'CityController@massDestroy')->name('cities.massDestroy');
    Route::resource('cities', 'CityController');

    // Article
    Route::delete('articles/destroy', 'ArticleController@massDestroy')->name('articles.massDestroy');
    Route::post('articles/media', 'ArticleController@storeMedia')->name('articles.storeMedia');
    Route::post('articles/ckmedia', 'ArticleController@storeCKEditorImages')->name('articles.storeCKEditorImages');
    Route::resource('articles', 'ArticleController');

    // Auther
    Route::delete('authers/destroy', 'AutherController@massDestroy')->name('authers.massDestroy');
    Route::post('authers/media', 'AutherController@storeMedia')->name('authers.storeMedia');
    Route::post('authers/ckmedia', 'AutherController@storeCKEditorImages')->name('authers.storeCKEditorImages');
    Route::resource('authers', 'AutherController');

    // Thread
    Route::delete('threads/destroy', 'ThreadController@massDestroy')->name('threads.massDestroy');
    Route::post('threads/media', 'ThreadController@storeMedia')->name('threads.storeMedia');
    Route::post('threads/ckmedia', 'ThreadController@storeCKEditorImages')->name('threads.storeCKEditorImages');
    Route::resource('threads', 'ThreadController');

    // Forum Category
    Route::delete('forum-categories/destroy', 'ForumCategoryController@massDestroy')->name('forum-categories.massDestroy');
    Route::resource('forum-categories', 'ForumCategoryController');

    // Forum Comments
    Route::delete('forum-comments/destroy', 'ForumCommentsController@massDestroy')->name('forum-comments.massDestroy');
    Route::post('forum-comments/media', 'ForumCommentsController@storeMedia')->name('forum-comments.storeMedia');
    Route::post('forum-comments/ckmedia', 'ForumCommentsController@storeCKEditorImages')->name('forum-comments.storeCKEditorImages');
    Route::resource('forum-comments', 'ForumCommentsController');

    // Courses
    Route::delete('courses/destroy', 'CoursesController@massDestroy')->name('courses.massDestroy');
    Route::post('courses/media', 'CoursesController@storeMedia')->name('courses.storeMedia');
    Route::post('courses/ckmedia', 'CoursesController@storeCKEditorImages')->name('courses.storeCKEditorImages');
    Route::resource('courses', 'CoursesController');

    // Specialization
    Route::delete('specializations/destroy', 'SpecializationController@massDestroy')->name('specializations.massDestroy');
    Route::post('specializations/media', 'SpecializationController@storeMedia')->name('specializations.storeMedia');
    Route::post('specializations/ckmedia', 'SpecializationController@storeCKEditorImages')->name('specializations.storeCKEditorImages');
    Route::resource('specializations', 'SpecializationController');

    // Diploma
    Route::delete('diplomas/destroy', 'DiplomaController@massDestroy')->name('diplomas.massDestroy');
    Route::post('diplomas/media', 'DiplomaController@storeMedia')->name('diplomas.storeMedia');
    Route::post('diplomas/ckmedia', 'DiplomaController@storeCKEditorImages')->name('diplomas.storeCKEditorImages');
    Route::resource('diplomas', 'DiplomaController');

    // Lessons
    Route::delete('lessons/destroy', 'LessonsController@massDestroy')->name('lessons.massDestroy');
    Route::post('lessons/media', 'LessonsController@storeMedia')->name('lessons.storeMedia');
    Route::post('lessons/ckmedia', 'LessonsController@storeCKEditorImages')->name('lessons.storeCKEditorImages');
    Route::resource('lessons', 'LessonsController');

    // Zoom
    Route::delete('zooms/destroy', 'ZoomController@massDestroy')->name('zooms.massDestroy');
    Route::resource('zooms', 'ZoomController');

    // Invoice
    Route::delete('invoices/destroy', 'InvoiceController@massDestroy')->name('invoices.massDestroy');
    Route::resource('invoices', 'InvoiceController');

    // Order
    Route::delete('orders/destroy', 'OrderController@massDestroy')->name('orders.massDestroy');
    Route::resource('orders', 'OrderController');

    // Certificate
    Route::delete('certificates/destroy', 'CertificateController@massDestroy')->name('certificates.massDestroy');
    Route::resource('certificates', 'CertificateController');
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
