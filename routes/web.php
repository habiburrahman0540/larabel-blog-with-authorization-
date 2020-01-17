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

use App\category;
use Illuminate\Support\Facades\Route;


Route::get('/', 'HomeController@index')->name('mainhome');
Route::get('post/{slug}', 'PostController@details')->name('post.details');
Route::get('posts', 'PostController@index')->name('post.index');
Route::get('/category/{slug}', 'PostController@postByCategory')->name('category.posts');
Route::get('/tag/{slug}', 'PostController@postByTag')->name('tag.posts');
Route::get('/search','SearchController@search')->name('search');
Route::get('profile/{username}','AuthorController@profile')->name('author.post.profile');



Route::post('subscriber','Author\SubscriberController@store')->name('subscriber.store');
Auth::routes();
route::group(['middleware'=>['auth']],
function(){
Route::post('favorite/{post}/add','FavoriteController@add')->name('post.favorite');
Route::post('comment/{post}','CommentController@store')->name('comment.store');


}

);
Route::group([
    'as' => 'admin.',
'prefix'=> 'admin',
'namespace'=>'Admin',
'middleware' =>['auth','admin']
],function(){
    Route::get('dashboard','DashboardController@index')->name('dashboard');
    Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateprofile')->name('profile.update');
    Route::put('password-update','SettingsController@updatepassword')->name('password.update');
    Route::get('profile','SettingsController@profile')->name('profile');
    Route::resource('tag','TagController');
    Route::resource('category','categoryController');
    Route::resource('post','PostController');
    Route::resource('footer','footerController');
    Route::get('author/post','PostController@authorpost')->name('post.authorpost');
    Route::get('pending/post','PostController@pending')->name('post.pending');
    Route::put('post/{id}/approve','PostController@approval')->name('post.approve');
    Route::put('post/{id}/unapprove','PostController@unapproval')->name('post.unapprove');
    Route::get('/subscriber','SubscriberController@index')->name('subscriber.index');
    Route::delete('/subscriber/{subscriber}','SubscriberController@destroy')->name('subscriber.destroy');
    Route::get('/favorite','FavoriteController@index')->name('favorite.index');
    Route::get('/comment','CommentController@index')->name('comment.index');
    Route::delete('comment/{id}','CommentController@destroy')->name('comment.destroy');
    Route::get('author','AuthorsController@index')->name('author.index');
    Route::delete('author/{id}','AuthorsController@destroy')->name('author.destroy');
});

Route::group(
    [
        'as' => 'author.',
        'prefix'=>'author',
        'namespace' => 'Author',
        'middleware' => ['auth','author']
    ],function(){
        Route::get('dashboard','DashboardController@index')->name('dashboard');
        Route::resource('post','PostController');
        Route::get('settings','SettingsController@index')->name('settings');
    Route::put('profile-update','SettingsController@updateprofile')->name('profile.update');
    Route::put('password-update','SettingsController@updatepassword')->name('password.update');
    Route::get('profile','SettingsController@profile')->name('profile');
    Route::get('/favorite','FavoriteController@index')->name('favorite.index');
    Route::get('/comment','CommentController@index')->name('comment.index');
    Route::delete('comment/{id}','CommentController@destroy')->name('comment.destroy');
    }
);
View::composer('layouts.frontend.partial.footer',function($view){
$categories = App\category::all();
$view->with('categories',$categories);

});
