<?php
use App\Category;
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});*/
// Route::get('/write', function () {
//     return view('summernote');
// });
// 
// REDIRECT
// 
Route::post('profile/{id}/update','UserController@profile_update')->where('id', '[0-9]+');
Route::get('expertiseToAuthor','NotesController@expertiseToAuthor');

Route::get('authorToExpertise','NotesController@authorToExpertise');

Route::get('profile/{id}','UserController@profile')->where('id', '[0-9]+');
Route::auth();
// write post
Route::get('/write', 'UserController@write');
// go to dashboard
Route::get('/', 'NotesController@index');
// store post
Route::post('insert', 'NotesController@insert');
//not to be used unless master controller // under construction
Route::get('/terminator', 'NotesController@viewMyPosts');
// edit post form
Route::get('edit/{slug}','NotesController@edit');
//display one post
Route::get('/{slug}',['as' => 'post', 'uses' => 'NotesController@show'])->where('slug', '[A-Za-z0-9-_]+');
//display draft
Route::get('draft/{slug}',['as' => 'post', 'uses' => 'NotesController@draft'])->where('slug', '[A-Za-z0-9-_]+');

//display all posts of a certain author
Route::get('user/{id}/posts','NotesController@user_posts')->where('id', '[0-9]+');

//display all posts of current user
Route::get('user/myPosts','UserController@myPosts');
//delete
Route::get('delete/{id}','UserController@destroy');

//show drafts of user
Route::get('user/drafts','UnpublishedController@drafts');

//display all posts that are still pending
Route::get('user/pendingPosts','UnpublishedController@pendingPosts');

//wish it were used
//Route::get('user/drop','UnpublishedController@drop');

//display user's pending
Route::get('user/myPendingPosts','UnpublishedController@myPendingIndex');

 // Route::get('/', function(){
 // 	$categories = Category::all();
 // 	return view('welcome')->withCategories($categories);
 // });
 
// show drafts of logged user
Route::post('update','NotesController@update');

	//display all posts of a certain category
Route::get('category/{slug}','CategoryController@category_post')->where('slug', '[A-Za-z0-9-_]+');

