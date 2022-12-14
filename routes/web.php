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
// Route::get('/programs', 'ProgramController@index')->name('programs');
Route::get('/programs/{slug}', 'ProgramController@view')->name('programs.view');
// announcements
Route::get('/announcements', 'AnnouncementController@index')->name('announcements');
Route::get('/announcements/{slug}', 'AnnouncementController@view')->name('announcements.view');
// about
Route::get('/about', 'AboutController@index')->name('about');

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


///////////////////////////////////////////////////////////////////////////////////
// ADMIN
Route::group(['prefix'=>'admin','middleware'=>'user_admin'], function(){
    // Route::get('/admin/dashboard','DashboardController@admin');
});

//Classes
Route::group(['prefix'=>'enrollment'], function(){
    Route::get('/getEnrollments','EnrollmentController@getEnrollments');
    Route::post('/confirm','EnrollmentController@confirm');
});

//Classes
Route::group(['prefix'=>'classes'], function(){
    Route::get('/getClasses','ClassController@getClasses');
    Route::post('/saveClass','ClassController@saveClass');
});

//School Years
Route::group(['prefix'=>'sys'], function(){
    Route::get('/getSchoolYears','SyController@getSchoolYears');
    Route::post('/saveSchoolYear','SyController@saveSchoolYear');
    Route::post('/toggleSYStatus','SyController@toggleSYStatus');
    Route::get('/getActiveSchoolYear','SyController@getActiveSchoolYear');
});

//Teachers
Route::group(['prefix'=>'teachers'], function(){
    Route::get('/getTeachers','TeacherController@getTeachers');
    Route::post('/saveTeacher','TeacherController@saveTeacher');
});

//LEARNING PROGRAMS
Route::group(['prefix'=>'learning-programs'], function(){
    Route::get('/getPrograms','ProgramController@getPrograms');
    Route::post('/saveProgram','ProgramController@saveProgram');
    Route::post('/deleteProgram','ProgramController@deleteProgram');
});

//LEARNING CENTERS
Route::group(['prefix'=>'clc'], function(){
    Route::get('/getClcs','ClcController@getClcs');
    Route::post('/saveClc','ClcController@saveClc');
    Route::post('/deleteClc','ClcController@deleteClc');
});
//////////////////////////////////////////////////////////////////////////////////


// STUDENT
Route::group(['prefix'=>'student','middleware'=>'user_student'], function(){
    // Route::get('/student/dashboard','DashboardController@student');
    Route::group(['prefix'=>'programs'], function(){
        Route::get('/getPrograms','ProgramController@getPrograms');
    });
    Route::group(['prefix'=>'profile'], function(){
        Route::post('/updateProfile','ProfileController@updateProfile');
        Route::get('/getProfile','ProfileController@getProfile');
    });
    Route::group(['prefix'=>'classes'], function(){
        Route::get('/all','StudentClassController@all');
        Route::post('/enroll','StudentClassController@enroll');
        Route::post('/cancelRequest','StudentClassController@cancelRequest');
    });
});


/**
 *
 */
Route::get('{any}', 'DashboardController@index')->where('any', '.*');
