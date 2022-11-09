<?php

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

 Route::get('/', function () {
    
    return view('welcome');
}); 

// Route::get('/home','HomeController@index');


Route::get('/table', function(){
    return view('table');
});
Route::get('/data_table', function(){
    return view('datatable');
});

/*mulai disini yg udh mulai pake db*/
Auth::routes();
Route::get('/home', 'PostController@index')->name('home');
Route::post('/post_data', 'PostController@store_data');
Route::post('/addlike','LikesController@addlikes');
Route::get('/addcomment/{id}','CommentsController@addcomments');
Route::post('/postcomment','CommentsController@doComments');
Route::get('/accountpage','AccountController@index');
Route::post('/accountpage/update','AccountController@doUpdate');
Route::post('/follow','FollowersController@doFollow');
Route::post('/updatenotif','PostController@updateNotif')->name("updatenotif");
Route::get('/notiflist','PostController@listNotif');
/* Route::get('/registers','AuthController@index');
Route::post('/signup','AuthController@signup');

Route::get('/login',function(){
    return view('login');
});
 */



//Route::get('/home', 'HomeController@index')->name('home');
