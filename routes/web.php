<?php

use App\Http\Controllers\AboutusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CatalogController;
use App\Http\Controllers\CatalogController as ControllersCatalogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController as ControllersCommentController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', [MainController::class, 'index']);
Route::get('search', [MainController::class, 'search']); // Search
Route::get('search-ajax', [MainController::class, 'searchAjax']); // Search AJAX

//Catalog ----------------------
Route::get('cat/{category:slug}', [ControllersCatalogController::class, 'showCategory']);
Route::any('cat/filters', [ControllersCatalogController::class, 'filter']);
Route::any('cat/reset/filters', [ControllersCatalogController::class, 'resetFilter']);
Route::get('catalogs', [ControllersCatalogController::class, 'index']);
Route::get('catalogs-men', [ControllersCatalogController::class, 'men']);
Route::get('catalog/readMore/{catalog}', [ControllersCatalogController::class, 'showProduct']);
Route::get('catalog/readMore', [ControllersCatalogController::class, 'product']);

//About US ---------------------
Route::get('aboutUs', [AboutusController::class, 'index']);

//Contacts ---------------------
Route::get('contacts', [MainController::class, 'contacts']);

//Mailing ----------------------
Route::post('send-mail', [MainController::class, 'sendMail']);
/* Mailing list */
Route::any('mailingAddToDb', [MainController::class, 'mailingAddToDb']);
//Route::get('mailing', [MainController::class, 'mailing']);

//Cart -------------------------
Route::any('cart/{id}', [CartController::class, 'addToCart']); 
Route::post('start-chekout', [CartController::class, 'start_chekout']); 
Route::post('buys/{buy}', [CartController::class, 'buys_delete']); 
Route::get('end-chekout', [CartController::class, 'end_chekout']); 
Route::post('liqpay/callback', [LiqPay::class, 'liqpayCallback'])->name('liqpayCallback');
Route::post('carts/quantity', [CartController::class, 'quantity']);
Route::post('carts/update', [ControllersCatalogController::class, 'cartUpdates']);

Route::resource('comments', ControllersCommentController::class);
Route::resource('categories', CategoryController::class);
/* Route::resource('catalogs', CatalogController::class); */

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::resource('carts', CartController::class);

    //History ----------------------
    Route::any('history', [CartController::class, 'history']); //history buy
});

Route::group(['prefix' => 'laravel-filemanager', 'middleware' => ['web', 'auth']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

//Admin ------------------------
Route::group(['prefix'=>'admin', 'middleware'=>['auth', 'admin']], function(){
    Route::get('/', [DashboardController::class, 'index']);
    Route::get('email', [EmailController::class, 'index']);
    Route::any('email/chat', [EmailController::class, 'answerEmail']);
    Route::get('email/{email}', [EmailController::class, 'seeAllEmails']);
    Route::resource('catalogs', CatalogController::class);
    Route::resource('comments', CommentController::class);

});