<?php
Route::get('/', function () { return redirect('/admin/home'); });

// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login')->name('auth.login');
$this->post('logout', 'Auth\LoginController@logout')->name('auth.logout');

// Change Password Routes...
$this->get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
$this->patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

// Password Reset Routes...
$this->get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');
$this->post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.reset');
$this->get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
$this->post('password/reset', 'Auth\ResetPasswordController@reset')->name('auth.password.reset');

    Route::group(['middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/home', 'HomeController@index');
    Route::resource('roles', 'Admin\RolesController');
    Route::post('roles_mass_destroy', ['uses' => 'Admin\RolesController@massDestroy', 'as' => 'roles.mass_destroy']);
    Route::resource('schools', 'Admin\SchoolsController');
    Route::post('schools_mass_destroy', ['uses' => 'Admin\SchoolsController@massDestroy', 'as' => 'schools.mass_destroy']);
    
    Route::resource('users', 'Admin\UsersController');
    Route::post('users_mass_destroy', ['uses' => 'Admin\UsersController@massDestroy', 'as' => 'users.mass_destroy']);
    Route::resource('students', 'Admin\StudentsController');
    Route::post('students_mass_destroy', ['uses' => 'Admin\StudentsController@massDestroy', 'as' => 'students.mass_destroy']);
    Route::post('students_restore/{id}', ['uses' => 'Admin\StudentsController@restore', 'as' => 'students.restore']);
    Route::delete('students_perma_del/{id}', ['uses' => 'Admin\StudentsController@perma_del', 'as' => 'students.perma_del']);
    Route::resource('streams', 'Admin\StreamsController');
    Route::post('streams_mass_destroy', ['uses' => 'Admin\StreamsController@massDestroy', 'as' => 'streams.mass_destroy']);
    Route::post('streams_restore/{id}', ['uses' => 'Admin\StreamsController@restore', 'as' => 'streams.restore']);
    Route::delete('streams_perma_del/{id}', ['uses' => 'Admin\StreamsController@perma_del', 'as' => 'streams.perma_del']);
    Route::resource('subjects', 'Admin\SubjectsController');
    Route::post('subjects_mass_destroy', ['uses' => 'Admin\SubjectsController@massDestroy', 'as' => 'subjects.mass_destroy']);
    Route::post('subjects_restore/{id}', ['uses' => 'Admin\SubjectsController@restore', 'as' => 'subjects.restore']);
    Route::delete('subjects_perma_del/{id}', ['uses' => 'Admin\SubjectsController@perma_del', 'as' => 'subjects.perma_del']);
    Route::resource('marks', 'Admin\MarksController');
    Route::post('marks_mass_destroy', ['uses' => 'Admin\MarksController@massDestroy', 'as' => 'marks.mass_destroy']);
    Route::post('marks_restore/{id}', ['uses' => 'Admin\MarksController@restore', 'as' => 'marks.restore']);
    Route::delete('marks_perma_del/{id}', ['uses' => 'Admin\MarksController@perma_del', 'as' => 'marks.perma_del']);
 
});
