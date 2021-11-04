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
// Rotta che gestisce la homepagevisibile agli utenti 
Route::get('/', 'HomeController@index')->name('index');

// serie di rotte che gestisconotutto il meccanismo di autenticazione
Auth::routes();

// rotte che gestiscono il backoffice 
// Route::get('/admin', 'HomeController@index')->name('admin');
Route::middleware('auth')->prefix('admin')->namespace('Admin')->name('admin')
    ->group(function() {
        // pagina di atterraggio dopo il login(con il prefix, l'url è /admin⁄)
        Route::get('/', 'HomeController@index')->name('home');
    });
