<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::POST('livewire/message/{name}', '\Livewire\Controllers\HttpConnectionHandler');

Route::group(
    ['prefix' =>LaravelLocalization::setLocale(),'middleware' =>
        [ 'localeSessionRedirect', 'localizationRedirect','localeViewPath','auth' ]],function(){


    ////////////Admin//////////////////
        Route::group(['as'=>'admin.','prefix'=>'admin'],function (){
            Route::get('/', 'HomeController@index')->name('home');



            ///////////////////////////Grades////////////////////
            Route::group(['as'=>'grades.','prefix'=>'grades','namespace'=>'Grades'],function (){
                Route::get('/', 'GradeController@index')->name('index');
                Route::post('store', 'GradeController@store')->name('store');
                Route::PATCH('update', 'GradeController@update')->name('update');
                Route::post('delete', 'GradeController@destroy')->name('delete');
            });
            ///////////////////////////Classroom////////////////////
            Route::group(['as'=>'classroom.','prefix'=>'classroom','namespace'=>'Classroom'],function (){
                Route::get('/', 'ClassroomController@index')->name('index');
                Route::post('store', 'ClassroomController@store')->name('store');
                Route::PATCH('update', 'ClassroomController@update')->name('update');
                Route::post('delete', 'ClassroomController@destroy')->name('delete');
                Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');
                Route::post('filter', 'ClassroomController@Filter_Classes')->name('filter');
            });
            /////////////////////////////////////Section/////////////////////////////////////////////////////

            Route::group(['as'=>'section.','prefix'=>'section','namespace'=>'Sections'],function (){
                Route::get('/', 'SectionController@index')->name('index');
                Route::post('store', 'SectionController@store')->name('store');
                Route::PATCH('update', 'SectionController@update')->name('update');
                Route::post('delete', 'SectionController@destroy')->name('delete');
                Route::get('classes/{id}', 'SectionController@classrooms');

            });



            Route::group(['as'=>'parent.','prefix'=>'parent'],function (){
                Route::view('/', 'livewire.show_form')->name('create');



            });

        });

    });


