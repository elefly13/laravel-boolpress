<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
// Rotta che gestisce la homepagevisibile agli utenti 
Route::get('/', 'HomeController@index')->name('index');


// rotta che gestisce i post dell'utente generico 
// Route::resource('/posts', 'PostController');
 Route::get('guest/posts', 'PostController@index')->name('posts.index');
 Route::get('guest/posts/{slug}', 'PostController@show')->name('posts.show');

 Route::get('/vue/posts', 'HomeController@listPostApi')->name('list-post-api');

 Route::get('guest/contact', 'HomeController@contact')->name('contacts');
 Route::post('guest/contact', 'HomeController@handleContactForm')->name('contacts.send');
 Route::get('/thank-you', 'HomeController@thankYou')->name('contacts.thank-you');



// serie di rotte che gestisconotutto il meccanismo di autenticazione
Auth::routes();

// rotte che gestiscono il backoffice 
// Route::get('/admin', 'HomeController@index')->name('admin');
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin.')
    ->group(function() {
        // pagina di atterraggio dopo il login(con il prefix, l'url è /admin⁄)
        Route::get('/', 'HomeController@index')->name('index');
        // Route::get('/posts', 'PostController@index')->name('posts.index');
        // Route::get('/posts/create', 'PostController@create')->name('posts.create');
        // Route::post('/posts', 'PostController@store')->name('posts.store');
        // Route::get('/posts/{post}', 'PostController@show')->name('posts.show');
        // Route::get('/posts/{post}/edit', 'PostController@edit')->name('posts.edit');
        // Route::post('/posts/{post}', 'PostController@update')->name('posts.update');
        // Route::delete('/posts/{post}', 'PostController@destroy')->name('posts.destroy');
        Route::resource('/posts', 'PostController');
        Route::resource('/categories', 'CategoryController');
        // rotta per la pagina profilo 
        Route::get('/profile', 'HomeController@profile')->name('profile');
        Route::post('/generate-token', 'HomeController@generateToken')->name('generate-token');
    });

    
