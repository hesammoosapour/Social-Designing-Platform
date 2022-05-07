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

//test
//Route::get('test',function (){
//    return view('test');
//});

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => '.', 'uses' => 'HomeController@index']);


    Route::get('panel', ['as' => 'panel', 'uses' => 'HomeController@panel'])
        ->middleware(['auth', 'verified']);

    Route::group(['middleware'=>['auth']], function (){

        //Admin
        Route::group(['middleware'=>['role:Admin']], function (){

            Route::get('{uuid}/change-privacy','HomeController@changePrivacy')
                ->name('{uuid}.change-privacy');

            //            Route::post('design/newPost','AdminController@newPost');

            Route::get('create-post', ['as' => 'create-post', 'uses' => 'AdminController@createPost']);

            Route::get('/post/{id}/new', ['as' => 'post.{id}.new',
                'uses' => 'AdminController@newPost']);
            Route::post('/post/{id}/new', ['as' => 'post.{id}.new',
                'uses' => 'AdminController@storePost']);

            Route::get('admin', ['as' => 'admin', 'uses' => 'AdminController@index']);

            Route::get('admin/users', ['as' => 'admin.users', 'uses' => 'AdminController@users']);

            Route::get('admin/{username}', ['as' => 'admin.{username}', 'uses' => 'AdminController@userEdit']);

            Route::patch('admin/{username}/update', ['as' => 'admin.{username}.update', 'uses' => 'AdminController@userUpdate']);


        });

//        Designer|Admin
        Route::group(['middleware'=>['role:Designer|Admin']], function (){


            Route::get('customers', ['as' => 'customers', 'uses' => 'HomeController@customers']);

            Route::post('create-customer', ['as' => 'create-customer', 'uses' => 'HomeController@createCustomer']);
        });

        //subscriber
        //todo verified to comment/like

        Route::post('post-comment', ['as' => 'post-comment', 'uses' => 'CommentsController@store']);
        Route::post('like-the-post', ['as' => 'like-the-post', 'uses' => 'DesignerController@likeThePost']);

    });
//    end auth

    //todo guest ?

    Route::get('{username}','HomeController@profile')->name('{username}');

    Route::post('customer-login','HomeController@customerLogin');

    Route::get('search', ['as' => 'search', 'uses' => 'HomeController@search']);

    //maybe later uuid
    Route::get('post/{id}', ['as' => 'post.{id}', 'uses' => 'HomeController@post']);

    Route::get('get-post-content/{post_id}','AjaxController@getPostContent');

});
//end web





