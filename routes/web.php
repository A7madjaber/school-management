<?php

use Illuminate\Support\Facades\Route;


Auth::routes();

//Route::group(
//    [
//        'prefix' =>LaravelLocalization::setLocale(),
//        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
//    ], function(){
//
//        Route::get('/dashboard', 'HomeController@index')->name('home');
//        Route::get('/grades', 'HomeController@index')->name('grades');
//
//
//});


