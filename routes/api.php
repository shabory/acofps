<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::post('users/media', 'UsersApiController@storeMedia')->name('users.storeMedia');
    Route::apiResource('users', 'UsersApiController');

    // Country
    Route::apiResource('countries', 'CountryApiController');

    // City
    Route::apiResource('cities', 'CityApiController');

    // Article
    Route::post('articles/media', 'ArticleApiController@storeMedia')->name('articles.storeMedia');
    Route::apiResource('articles', 'ArticleApiController');

    // Auther
    Route::post('authers/media', 'AutherApiController@storeMedia')->name('authers.storeMedia');
    Route::apiResource('authers', 'AutherApiController');

    // Thread
    Route::post('threads/media', 'ThreadApiController@storeMedia')->name('threads.storeMedia');
    Route::apiResource('threads', 'ThreadApiController');

    // Forum Category
    Route::apiResource('forum-categories', 'ForumCategoryApiController');

    // Forum Comments
    Route::post('forum-comments/media', 'ForumCommentsApiController@storeMedia')->name('forum-comments.storeMedia');
    Route::apiResource('forum-comments', 'ForumCommentsApiController');

    // Courses
    Route::post('courses/media', 'CoursesApiController@storeMedia')->name('courses.storeMedia');
    Route::apiResource('courses', 'CoursesApiController');

    // Specialization
    Route::post('specializations/media', 'SpecializationApiController@storeMedia')->name('specializations.storeMedia');
    Route::apiResource('specializations', 'SpecializationApiController');

    // Diploma
    Route::post('diplomas/media', 'DiplomaApiController@storeMedia')->name('diplomas.storeMedia');
    Route::apiResource('diplomas', 'DiplomaApiController');

    // Lessons
    Route::post('lessons/media', 'LessonsApiController@storeMedia')->name('lessons.storeMedia');
    Route::apiResource('lessons', 'LessonsApiController');

    // Zoom
    Route::apiResource('zooms', 'ZoomApiController');

    // Invoice
    Route::apiResource('invoices', 'InvoiceApiController');

    // Order
    Route::apiResource('orders', 'OrderApiController');

    // Certificate
    Route::apiResource('certificates', 'CertificateApiController');
});
