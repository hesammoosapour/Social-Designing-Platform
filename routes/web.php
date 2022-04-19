<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

//Route::get('/', function () {
//    return Inertia::render('welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('dashboard',function (){
//    return redirect()->route('panel');
//})->name('dashboard');

require __DIR__.'/auth.php';


Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => '.', 'uses' => 'HomeController@index']);


    Route::get('panel', ['as' => 'panel', 'uses' => 'HomeController@panel'])
        ->middleware(['auth', 'verified']);

    Route::group(['middleware'=>['auth']], function (){

        Route::group(['middleware'=>['role:Admin']], function (){

//            Route::post('design/newPost','AdminController@newPost');

            Route::get('create-post', ['as' => 'create-post', 'uses' => 'AdminController@createPost']);

            Route::get('post/{id}/new', ['as' => 'post.{id}.new',
                'uses' => 'AdminController@newPost']);
            Route::post('post/{id}/new', ['as' => 'post.{id}.new',
                'uses' => 'AdminController@storePost']);


        });

        Route::group(['middleware'=>['role:Designer|Admin']], function (){

            Route::get('{uuid}/change-privacy','HomeController@changePrivacy')
                ->name('{uuid}.change-privacy');

            Route::get('customers', ['as' => 'customers', 'uses' => 'HomeController@customers']);

            Route::post('create-customer', ['as' => 'create-customer', 'uses' => 'HomeController@createCustomer']);
        });

    });
//    end auth
    Route::get('{designer_id}/photos','HomeController@photos')->name('{designer_id}.photos');

    Route::post('customer-login','HomeController@customerLogin');

    Route::get('search', ['as' => 'search', 'uses' => 'HomeController@search']);

});



