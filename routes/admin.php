<?php

Route::prefix('/admin')->group(function(){

    Route::get('/',                                         'Admin\DashboardController@getDashboard')->name('dashboard');

    //Module Users
    Route::get('/users/{status}',                           'Admin\UserController@getUsers')->name('user_list');
    Route::get('/user/{id}/edit',                           'Admin\UserController@getUserEdit')->name('users_edit');
    Route::get('/user/{id}/banned',                         'Admin\UserController@getUserBanned')->name('users_banned');
    Route::get('/user/{id}/permissions',                    'Admin\UserController@getUserPermissions')->name('users_permissions');
    Route::post('/user/{id}/permissions',                   'Admin\UserController@postUserPermissions')->name('users_permissions');

    //Module Products
    Route::get('/products',                                 'Admin\ProductsController@getHome')->name('products');
    Route::get('/product/add',                              'Admin\ProductsController@getProductAdd')->name('products_add');
    Route::post('/product/add',                             'Admin\ProductsController@postProductAdd')->name('products_add');
    Route::get('/product/{id}/edit',                        'Admin\ProductsController@getProductEdit')->name('products_edit');
    Route::post('/product/{id}/edit',                       'Admin\ProductsController@postProductEdit')->name('products_edit');
    Route::get('/product/{id}/delete',                      'Admin\ProductsController@getProductDelete')->name('products_delete');
    Route::post('/product/{id}/gallery/add',                'Admin\ProductsController@postProductGalleryAdd')->name('product_gallery_add');
    Route::get('/product/{id}/gallery/{gid}/delete',        'Admin\ProductsController@getProductGalleryDelete')->name('product_gallery_delete');

    //Module Categories
    Route::get('/categories/{module}',                      'Admin\CategoriesController@getHome')->name('categories');
    Route::post('/category/add',                            'Admin\CategoriesController@postCategoryAdd')->name('categories_add');
    Route::get('/category/{id}/edit',                       'Admin\CategoriesController@getCategoryEdit')->name('categories_edit');
    Route::post('/category/{id}/edit',                      'Admin\CategoriesController@postCategoryEdit')->name('categories_edit');
    Route::get('/category/{id}/delete',                     'Admin\CategoriesController@getCategoryDelete')->name('categories_delete');



});
