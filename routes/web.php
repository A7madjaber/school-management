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



Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return redirect()->route('admin.home');
});
