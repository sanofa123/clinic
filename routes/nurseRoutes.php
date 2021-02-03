<?php
// Nurse routes
Route::group(['namespace' => 'Nurse'],function(){
	// Get Nurse Home page
	Route::get('/nurse/home', 'HomeController@index')->name('nurse.home');
//timeline for reservations
	Route::get('/nurse/patient/reservations', 'ReservationsController@get')->name('nurse.reservations');
// nurse searches for a date
	Route::post('/nurse/patient/reservations', 'ReservationsController@search');

//nurse confirms areservation
	Route::get('/nurse/patient/reservations/{reservation_id}', 'ReservationsController@confirm')->name('reservations.confirm');

//nurse rejects areservation

   Route::PATCH('/nurse/patient/reservations/{reservation}', 'ReservationsController@reject')->name('reservation.delete');


	// Get Admin Home page
	Route::get('/nurse/profile', 'ProfileController@index')->name('nurse.profile');
	// Update Admin Profile Picture
	Route::post('/nurse/profile/update', 'ProfileController@updatePicture')->name('nurse.update.photo');
	// Change nurse data from profile
	Route::PATCH('/nurse/update', 'ProfileController@update')->name('nurse.profile.update');
	// Change nurse password
	Route::PATCH('/nurse/password/update', 'ProfileController@password')->name('nurse.password.update');


	// add new patient routes
	Route::get('/nurse/patient/add', 'PatientsController@add')->name('nurse.patient.add');
	Route::post('/nurse/patient/add', 'PatientsController@store');

  //  patient update page

	Route::get('/nurse/patient/update/{patient}','PatientsController@edit')->name('nurse.patient.update');
	
	  //  nurse updates patient account info
	Route::PATCH('/nurse/patient/update/{patient}', 'PatientsController@update');
	// get all patients table
	Route::get('/nurse/patient/view', 'PatientsController@index')->name('nurse.patient.view');

  //  nurse updates patient status 

    Route::PATCH('/nurse/patient/status/{patient}','PatientsController@change_status')->name('nurse.patient.update.status');

  //  nurse updates patient attendance for a reservation

   Route::PATCH('/nurse/reservations/{reservation}','ReservationsController@change_attendance')->name('nurse.reservations.update.attendance');

//  nurse deletes patient account
	Route::DELETE('/nurse/patient/table/{patient}','PatientsController@destroy')->name('nurse.patient.delete');
	
	// view pateint file
	Route::get('/nurse/patient/file/{patient}', 'FileController@index')->name('nurse.patient.file');
	
	// print pateint file
	Route::get('/nurse/patient/printfile/{patient}', 'FileController@print')->name('nurse.patient.printfile');

	// delete patient file
    Route::DELETE('/nurse/patient/deletefile/{patient}','FileController@destroy')->name('nurse.patient.deletefile');


	// get nurse login page
	Route::GET('nurse/login','Auth\LoginController@showLoginForm')->name('nurse.login');
	// login with nurse
	Route::POST('nurse/login','Auth\LoginController@login');
	Route::post('nurse/logout', 'Auth\LoginController@logout')->name('nurse.logout');
	// send email for nurse to change password
	Route::POST('nurse-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('nurse.password.email');
	// show page of nurse to write his email to change password
	Route::GET('nurse-password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('nurse.password.request');
	// reset nurse password
	Route::POST('nurse-password/reset','Auth\ResetPasswordController@reset');
	// get page where nurse reset password
	Route::GET('nurse-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('nurse.password.reset');

	// add new invoice 
	Route::get('/nurse/invoice/add', 'InvoicesController@add')->name('nurse.invoice.add');
	Route::post('/nurse/invoice/add', 'InvoicesController@store');

	// View Invoices
	Route::get('/nurse/invoice/view', 'InvoicesController@view')->name('nurse.invoice.view');
	// update invoice's info
	Route::get('/nurse/invoice/update/{invoice}', 'InvoicesController@edit')->name('nurse.invoice.update');
	Route::PATCH('/nurse/invoice/update/{invoice}', 'InvoicesController@update');
	// Delete invoice
	Route::DELETE('/nurse/invoice/delete/{invoice}','InvoicesController@destroy')->name('nurse.invoice.delete');
	// View details of an invoice
	Route::get('/nurse/invoice/view/{invoice}', 'InvoicesController@show')->name('nurse.invoice.show');

	// nurse view admins' working times 
	Route::get('nurse/admin/times','AdminsController@view_times')->name('nurse.admin.times');

// nurse view nurses' working times 
	Route::get('nurse/nurse/times','NursesController@view_times')->name('nurse.nurse.times');
});