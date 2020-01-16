<?php
// Route::get('/', function () {
//     return view('welcome');
// });
//Backend Routes
Route::get('/add/product', 'ProductController@addproduct');
Route::post('/add/product/insert', 'ProductController@addproductinsert');
Route::get('/delete/product/{product_id}', 'ProductController@deleteproduct');
Route::get('/edit/product/{product_id}', 'ProductController@editproduct');
Route::post('/edit/product/insert', 'ProductController@editproductinsert');
Route::get('/restore/product/{product_id}', 'ProductController@restoreproduct');
Route::get('/force/delete/product/{product_id}', 'ProductController@forcedeleteproduct');
Route::get('/add/category/view', 'CategoryController@addcategoryview');
Route::post('/add/category/insert', 'CategoryController@addcategoryinsert');
Route::get('/contact/message/view', 'HomeController@contactmessageview');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//Frontend Routes
Route::get('/', 'FrontendController@index');
Route::get('/product/details/{product_id}', 'FrontendController@productdetails');
Route::get('/category/wise/product/{category_id}','FrontendController@categorywiseproduct');
Route::get('/contact', 'FrontendController@contact');
Route::post('/contact/insert', 'FrontendController@contactinsert');
