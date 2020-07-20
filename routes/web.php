<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'FrontHomeController@index')->name('front.home');


Auth::routes();

Route::get('/backend', 'HomeController@index')->name('home')->middleware('role');
Route::get('setcurrency/{currency}', function ($currency) {
    \Session::put('currency', $currency);
    return redirect()->back();
})->name('setcurrency');
Route::get('/cart', 'FrontHomeController@cart')->name('front.cart');
Route::get('/history', 'FrontHomeController@history')->name('front.history')->middleware('auth');

Route::get('/removefromcart/{product}', 'FrontHomeController@removeFromcart')->name('front.removefromcart');
Route::get('/addtocart/{product}', 'FrontHomeController@addTocart')->name('front.addtocart');

Route::get('/checkout', 'FrontHomeController@checkout')->name('front.checkout');
Route::post('/saveorder', 'FrontHomeController@saveorder')->name('front.saveorder');

Route::middleware('auth', 'role')->prefix('backend')->group(function () {
    Route::resource('product', 'ProductController');

    Route::get('/rates', 'HomeController@rates')->name('rates');
    Route::get('/setadmin/{user}', 'HomeController@setadmin')->name('setadmin');
    Route::get('/addtocart/{product}', 'HomeController@addToCart')->name('home.addtocart');
    Route::get('/cart', 'HomeController@cart')->name('home.cart');


    Route::resource('category', 'CategoryController');
});
