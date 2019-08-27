<?php

Route::post('register', 'Auth\UserController@register');
Route::post('login', 'Auth\UserController@login');


Route::get('classifieds', 'Pages\ClassifiedsController@index');
Route::get('classifieds-pro', 'Pages\ClassifiedsController@indexPro');
Route::get('categories', 'Categories\CategoryController@index');
Route::get('advertisement/{id}', 'Pages\ClassifiedsController@view');
Route::get('classifieds-city/{city}', 'Pages\ClassifiedsController@classifiedsInCity');

Route::get('profile/{id}', 'Profile\UserController@user');

// reviews
Route::prefix('reviews')->group(function (){
    Route::get('user/{id}', 'Profile\UserController@reviewsUser');
});
Route::group(['prefix' => 'auth'], function () {

    Route::group(['middleware' => 'auth:api'], function () {

        // logged

        Route::get('logout', 'Auth\UserController@logout');
        Route::get('user', 'User\UserController@user');

        // rating
        Route::prefix('rating')->group(function (){
            Route::post('set-ad', 'Reviews\ReviewsController@setRatingAd');
            Route::post('set-user', 'Reviews\ReviewsController@setRatingUser');
        });

        //activated account && logged
        Route::group(['middleware' => 'activated'], function (){

            Route::prefix('follow')->group(function () {
                Route::post('ad', 'Follows\FollowController@setFollowAd');
                Route::post('user', 'Follows\FollowController@setFollowUser');
            });

            Route::prefix('account')->group(function () {
                Route::prefix('observed')->group(function (){
                    Route::get('ads', 'Follows\FollowController@classifieds');
                    Route::get('users', 'Follows\FollowController@users');
                });
                Route::prefix('classifieds')->group(function (){
                    Route::get('index', 'User\ClassifiedsController@index');
                    Route::get('archive', 'Archives\ClassifiedsController@index');
                    Route::post('move-ad', 'Archives\ClassifiedsController@moveArchive');
                });
                Route::apiResource('advertisement', 'Pages\ClassifiedsController');
                //Route::get('classifieds', 'User\ClassifiedsController@index');
                //Route::post('create-ad', 'Pages\ClassifiedsController@store');
                //Route::delete('delete-ad/{advertisement}', 'Pages\ClassifiedsController@destroy');
                //Route::post('move-ad/{id}', 'Pages\ClassifiedsController@moveToArchive');
                //Route::get('classifieds-archive', 'User\ClassifiedsController@classifiedsArchive');
                Route::patch('remove-archive/{id}', 'Pages\ClassifiedsController@removeFromArchive');

                Route::prefix('settings')->group(function () {
                    Route::post('basic', 'User\SettingsController@updateBasicData');
                    Route::post('contact', 'User\SettingsController@updateContactUser');
                    Route::post('contact-company', 'User\SettingsController@updateContactCompany');
                });

                Route::prefix('message')->group(function () {
                    Route::post('send', 'Messages\MessagesController@store');
                });
            });

        });
    });
});
