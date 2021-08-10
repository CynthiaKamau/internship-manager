<?php

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

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/test', function () {
//     return view('welcome');
// });

Route::get('/signup', 'RegisterController@create')->name('signup');

Route::post('/signup', 'RegisterController@store')->name('signup');

Auth::routes(['verify'=>true]);


Route::group(['middleware' => ['auth','verified']], function () {

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/data', 'HomeController@data')->name('data');

    Route::post('/filtered_data', 'HomeController@filtered_data')->name('filtered_data');

    Route::get('/components', function(){
        return view('components');
    })->name('components');


    Route::resource('users', 'UserController');

    Route::get('/profile/{user}', 'UserController@profile')->name('profile.edit');

    Route::post('/profile/{user}', 'UserController@profileUpdate')->name('profile.update');

    Route::resource('roles', 'RoleController')->except('show');

    Route::resource('permissions', 'PermissionController')->except(['show','destroy','update']);

    Route::resource('category', 'CategoryController')->except('show');

    Route::resource('department', 'DepartmentController')->except('show');

    Route::resource('checkins', 'CheckinController')->except('show');

    Route::resource('students', 'StudentInternshipController')->except('show');

    Route::resource('internships', 'InternshipController');

    Route::resource('facility_department', 'FacilityDepartmentController')->except('show');

    Route::post('/get_facility_departments', 'DataController@get_departments')->name('get_facility_department');

    Route::post('/sub_counties', 'DataController@get_sub_counties')->name('sub_counties');

    Route::post('/facilities', 'DataController@get_facilities')->name('get_facilities');

    Route::post('/get_dashboard_sub_counties', 'DataController@get_dashboard_sub_counties')->name('get_dashboard_sub_counties');

    Route::post('/get_dashboard_facilities', 'DataController@get_dashboard_facilities')->name('get_dashboard_facilities');

    // Route::get('/facility_department/{facility_departmemt}/create', 'FacilityDepartmentController@create')->name('facility_department.create');

    // Route::put('/facility_department/{facility_department}/edit', 'FacilityDepartmentController@update')->name('facility_department.update');

    Route::resource('post', 'PostController');

    Route::get('/activity-log', 'SettingController@activity')->name('activity-log.index');

    Route::get('/settings', 'SettingController@index')->name('settings.index');

    Route::post('/settings', 'SettingController@update')->name('settings.update');


    Route::get('media', function (){
        return view('media.index');
    })->name('media.index');
});
