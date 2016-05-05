<?php

use App\Contact;
use App\Http\Controllers\ContactController;
use Illuminate\Http\Request;
/**
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('users', function()
{
    return 'Users!';
});



/**
* Show Contact Dashboard
**/
Route::get('/', function () {
   return view('welcome');
});

Route::post('auth/prelogin', 'Auth\AuthController@preLogin');

/**
*
**/
Route::get('/home', 'HomeController@index');
Route::get('/contacts','ContactController@index');
Route::post('/contact','ContactController@store');
Route::delete('/contact/{contact}','ContactController@destroy');
Route::post('/contact/{contact}/edit','ContactController@edit'); 
Route::post('/contact/search','ContactController@search');  
Route::post('/contact/{contact}/addADetail','ContactController@addADetail'); 


Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
Route::post('auth/{provider}', 'Auth\AuthController@redirectToProvider');
//Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

Route::get('auth/callback/{provider}', 'Auth\AuthController@handleProviderCallback');


Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
//Route::get('auth/github/callback', 'Auth\AuthController@handleProviderCallback');


Route::auth();


Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');

Route::auth();

Route::get('/home', 'HomeController@index');
