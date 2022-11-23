<?php

use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('layouts.app');
// });

// Auth::routes(['verify' => true]);
Auth::routes();

// HOME
Route::get('/', 'HomeController@index')->name('home');
// programs
Route::get('/programs', 'ProgramController@index')->name('programs');
Route::get('/programs/{slug}', 'ProgramController@view')->name('programs.view');
// announcements
Route::get('/announcements', 'AnnouncementController@index')->name('announcements');
Route::get('/announcements/{slug}', 'AnnouncementController@view')->name('announcements.view');
// about
Route::get('/about', 'AboutController@index')->name('about');

// DASHBOARD
Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

// logout using get http method
Route::get('/logout', 'Auth\LogoutController@logout')->name('logout2');

// Flush current session
Route::get('/flush-session', 'Auth\LogoutController@flushSession')->name('flushSession');


// ACCOUNTS
// Route::prefix('accounts')->group(function() {
Route::group(['prefix' => 'accounts'], function() {
    Route::get('/', 'AccountsController@index');
    Route::post('/', 'AccountsController@store');
    Route::match(['put','patch'], '/update-profile', 'AccountsController@updateProfile');
    Route::match(['put','patch'], '/update-password', 'AccountsController@updatePassword');
    Route::match(['put','patch'], '/update-principal-assignment', 'AccountsController@updatePrincipalAssignment');
    Route::match(['delete'], '/delete', 'AccountsController@delete');
});



/**
 *
 */
Route::get('{any}', 'DashboardController@index')->where('any', '.*');
