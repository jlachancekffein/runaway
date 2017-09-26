<?php

Route::auth();

Route::get('login', 'PagesController@login')->name('login');
Route::get('login/facebook', 'Auth\FacebookAuthController@redirectToProvider')->name('facebookLogin');
Route::get('login/facebook/callback', 'Auth\FacebookAuthController@handleProviderCallback')->name('facebookLoginCallback');
Route::get('login/google', 'Auth\GoogleAuthController@redirectToProvider')->name('googleLogin');
Route::get('login/google/callback', 'Auth\GoogleAuthController@handleProviderCallback')->name('googleLoginCallback');
Route::get('/register', 'PagesController@register');


Route::group(['prefix' => 'account', 'namespace' => 'Account', 'middleware' => 'auth'], function() {
    Route::get('/question/{questionId}', 'QuestionsController@edit');
    Route::post('/question/{questionId}', 'QuestionsController@update');
    Route::get('/images/photo.jpg', 'QuestionsController@outputPhoto');
    Route::get('/change-password', 'UsersController@changePassword');
    Route::post('/change-password', 'UsersController@updatePassword');

    Route::group(['middleware' => 'completeProfile'], function () {
        Route::get('/profile', 'UsersController@profile')->name('profile');
        Route::put('/profile', 'UsersController@update');
        Route::get('/address-book', 'UsersController@addressBook');
        Route::post('/address-book', 'UsersController@updateAddressBook');

        Route::get('/kit-request', 'KitRequestsController@form');
        Route::post('/kit-request', 'KitRequestsController@store');

        Route::get('/kits', 'KitsController@index');
        Route::get('/kits/{id}', 'KitsController@show');
        Route::post('/kits/{id}', 'KitsController@storeCart');

        Route::get('/checkout/payment', 'CheckoutController@payment');
        Route::post('/checkout/payment', 'CheckoutController@charge');
        Route::get('/checkout/success', 'CheckoutController@success');
    });
});


Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'admin'], function() {
    Route::get('/orders', 'OrdersController@index');
    Route::get('/orders/create', 'OrdersController@create');
    Route::post('/orders', 'OrdersController@store');
    Route::get('/orders/{id}/edit', 'OrdersController@edit');
    Route::put('/orders/{id}', 'OrdersController@update');
    Route::delete('/orders/{id}', 'OrdersController@destroy');

    Route::get('/customers', 'CustomersController@index');
    Route::get('/customers/search', 'CustomersController@search');

    Route::get('/articles/{section}', 'ArticlesController@index')->name('articles.index');
    Route::get('/articles/{section}/create', 'ArticlesController@create');
    Route::post('/articles/{section}/upload', 'ArticlesController@upload');
    Route::post('/articles/{section}', 'ArticlesController@store')->name('articles.store');
    Route::get('/articles/{section}/{id}', 'ArticlesController@edit');
    Route::put('/articles/{section}/{id}', 'ArticlesController@update')->name('articles.update');
    Route::get('/articles/destroy/{section}/{id}', 'ArticlesController@destroy')->name('articles.destroy');

    Route::get('/kits', 'KitsController@index');
    Route::get('/kits/create', 'KitsController@create');
    Route::get('/kits/create/request/{kitRequestId}', 'KitsController@createWithKitRequest');
    Route::get('/kits/create/customer/{customerId}', 'KitsController@createWithCustomer');
    Route::post('/kits/create', 'KitsController@store');
    Route::get('/kits/{kitId}', 'KitsController@edit');
    Route::put('/kits/{kitId}', 'KitsController@update');
    Route::post('/delete-kit/{kitId}', 'KitsController@deleteKit');
    
    Route::get('/transactions', 'TransactionsController@index');
    
    Route::get('/client/{clientId}', 'ClientController@index');
    Route::get('/images/photo-{clientId}.jpg', 'ClientController@outputPhoto');

    Route::get('/taxes', 'TaxesController@index');
    Route::post('/taxes/save', 'TaxesController@saveAll');

    Route::get('/orders/post_canada/export.csv', 'ExportOrdersController@exportPaidOrdersForPostCanada');
});


Route::get('/blog', 'ArticlesListController@blogIndex');
Route::get('/lookbook', 'ArticlesListController@lookbookIndex');
Route::get('/blog/{slug}', 'ShowArticleController@show');
Route::get('/lookbook/{slug}', 'ShowArticleController@show');
Route::post('/contact', 'ContactController@sendMessage');
Route::get('/', 'PagesController@home');
Route::get('/{slug}', 'PagesController@slug');