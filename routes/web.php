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

Auth::routes();

Route::get('/access_denied', function () {
    return view('access_denied'); // 'access_denied.blade.php' in resources/views
});
Route::get('/suspend', function () {
    return view('suspend'); // 'access_denied.blade.php' in resources/views
});
Route::get('/', 'HomeController@index')->name('home');
Route::resource('home', HomeController::class);
Route::middleware('auth')->group(
    function () {
        Route::group(
            ['middleware' => ['CheckUserSuspend']],
            function () {
                Route::get('/admin', "HomeController@GetApplicants");
                Route::post('application_status', 'HomeController@SetStatus')->name('application_status');

                Route::group(['middleware' => ['checkUserType:2']], function () {

                    // Routes that require user type = 2
                    Route::get('/reports', "HomeController@Reports");
                    Route::resource('users', 'UserController');
                    Route::post('susspend', 'UserController@susspend')->name('susspend');
                });
            }
        );
    }
);
