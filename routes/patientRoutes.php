<?php


// Patient routes
Route::group(['namespace' => 'Patient'],function(){

	// Change paient profile photo
	Route::POST('/patient/photo', 'PatientController@photo');
	// Change patient data from profile
	Route::PATCH('/patient/update', 'PatientController@update')->name('patient.profile');
	// Change patient password
	Route::PATCH('/patient/password/update', 'PatientController@password')->name('patient.password.update');

	// patient login routes
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');   
	// patient logout route
	Route::post('logout', 'Auth\LoginController@logout')->name('logout');

	// patient reset password routs (not working yet)
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::get('/profile', 'PatientController@index')->name('profile');
	Route::get('/home', 'HomeController@home')->name('home');
	Route::get('/contact_us', 'HomeController@contact')->name('contact_us');



    Route::get('/reservations/create', 'ReservationController@get')->name('reservations.create');
    Route::post('/reservations/create', 'ReservationController@store');

    Route::get('/reservations/history', 'ReservationController@history')->name('Reservations.history');

    Route::get('/reservations/update/{reservation}', 'ReservationController@edit')->name('reservations.update');

	Route::PATCH('/reservations/update/{reservation}', 'ReservationController@update');

	Route::get('/compose', 'EmailsController@view')->name('send.email');
	Route::POST('/compose', 'EmailsController@send');


	Route::DELETE('/reservations/history/{reservation}', 'ReservationController@destroy')->name('user.reservation.delete');

	// View Invoices
	Route::get('/invoice/view', 'InvoicesController@view')->name('patient.invoice.view');

	// View details of an invoice
	Route::get('/invoice/view/{invoice}', 'InvoicesController@show')->name('patient.invoice.show');


	// patient file route
	Route::get('/file', 'FileController@index')->name('file');
});