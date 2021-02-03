<?php

// Admin routes
Route::group(['namespace' => 'Admin'],function(){
	// Get Admin Home page
	Route::get('/admin/home', 'HomeController@index')->name('admin.home');

	// Get Admin Profile page
	Route::get('/admin/profile', 'ProfileController@index')->name('admin.profile');
	// Update Admin Profile Picture
	Route::PATCH('/admin/profile/update', 'ProfileController@updatePicture')->name('admin.update.photo');
	// Change admin data from profile
	Route::PATCH('/admin/update', 'ProfileController@update')->name('admin.profile.update');
	// Change admin password
	Route::PATCH('/admin/password/update', 'ProfileController@password')->name('admin.password.update');

	// get admin login page
	Route::GET('admin/login','Auth\LoginController@showLoginForm')->name('admin.login');
	// login with admin
	Route::POST('admin/login','Auth\LoginController@login');
	Route::post('admin/logout', 'Auth\LoginController@logout')->name('admin.logout');
	// send email for admin to change password
	Route::POST('admin-password/email','Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
	// show page of admin to write his email to change password
	Route::GET('admin-password/reset','Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
	// reset admin password
	Route::POST('admin-password/reset','Auth\ResetPasswordController@reset');
	// get page where admin reset password
	Route::GET('admin-password/reset/{token}','Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
	
	//add a new patient
	Route::get('/admin/patient/add', 'PatientsController@add')->name('admin.patient.add');
	Route::post('/admin/patient/add', 'PatientsController@store');
	
	// update patient's info
	Route::get('/admin/patient/update/{patient}','PatientsController@edit')->name('admin.patient.updatepatient');
	Route::PATCH('/admin/patient/update/{patient}', 'PatientsController@update');

	// view all patients
	Route::get('/admin/patient/view', 'PatientsController@index')->name('admin.patient.view');
	
	// activate or deactivate patient account
    Route::PATCH('/admin/patient/update/status/{patient}','PatientsController@change_status')->name('admin.patient.update.status');

    // delete patient account
    Route::DELETE('/admin/patient/delete/{patient}','PatientsController@destroy')->name('admin.patient.delete');


	// search on patients in database by mail
	Route::GET('/admin/patient/search', 'PatientsController@search');
 
	// view pateint file
	Route::get('/admin/patient/file/{patient}', 'FileController@index')->name('admin.patient.file');
	
	// print pateint file
	Route::get('/admin/patient/printfile/{patient}', 'FileController@print')->name('admin.patient.printfile');

	// add pateint file
	Route::get('/admin/patient/addfile/{patient}', 'FileController@edit_add')->name('admin.patient.addfile');
	Route::PATCH('/admin/patient/addfile/{patient}', 'FileController@add');

	// update pateint file
	Route::post('/admin/patient/updatefile/{patient}', 'FileController@edit_update')->name('admin.patient.updatefile');
	Route::PATCH('/admin/patient/updatefile/{patient}', 'FileController@update');

	// delete patient file
    Route::DELETE('/admin/patient/deletefile/{patient}','FileController@destroy')->name('admin.patient.deletefile');

    // add new nurse 
	Route::get('/admin/nurse/add', 'NursesController@add')->name('admin.nurse.add');
	Route::post('/admin/nurse/add', 'NursesController@store');

	// View Nurses
	Route::get('/admin/nurse/view', 'NursesController@view')->name('admin.nurse.view');
	// update nurse's info
	Route::get('/admin/nurse/update/{nurse}', 'NursesController@edit')->name('admin.nurse.update');
	Route::PATCH('/admin/nurse/update/{nurse}', 'NursesController@update');
	Route::PATCH('/admin/nurse/status/{nurse}', 'NursesController@status')->name('admin.nurse.status');
	// Delete nurse
	Route::DELETE('/admin/nurse/delete/{nurse}','NursesController@destroy')->name('admin.nurse.delete');	


	//add a new admin
	Route::get('/admin/admin/add', 'AdminsController@add')->name('admin.admin.add');
	Route::post('/admin/admin/add', 'AdminsController@store');

	// View Admins
	Route::get('/admin/admin/view', 'AdminsController@view')->name('admin.admin.view');

	// update another admin's info
	Route::get('/admin/admin/update/{admin}', 'AdminsController@edit')->name('admin.admin.update');
	Route::PATCH('/admin/admin/update/{admin}', 'AdminsController@update');	
	Route::PATCH('/admin/admin/status/{admin}', 'AdminsController@status')->name('admin.admin.status');
	// Delete Another admin
	Route::DELETE('/admin/admin/delete/{admin}','AdminsController@destroy')->name('admin.admin.delete');

	//add a new clinic
	Route::get('/admin/clinic/add', 'ClinicsController@add')->name('admin.clinic.add');
	Route::post('/admin/clinic/add', 'ClinicsController@store');

	// View Clinics
	Route::get('/admin/clinic/view', 'ClinicsController@view')->name('admin.clinic.view');
	// Delete clinic
	Route::DELETE('/admin/clinic/delete/{clinic}','ClinicsController@destroy')->name('admin.clinic.delete');
	// update clinics's info
	Route::get('/admin/clinic/update/{clinic}', 'ClinicsController@edit')->name('admin.clinic.update');
	Route::PATCH('/admin/clinic/update/{clinic}', 'ClinicsController@update');


	// add new worker 
	Route::get('/admin/worker/add', 'WorkersController@add')->name('admin.worker.add');
	Route::post('/admin/worker/add', 'WorkersController@store');

	// View workers
	Route::get('/admin/worker/view', 'WorkersController@view')->name('admin.worker.view');
	// update worker's info
	Route::get('/admin/worker/update/{worker}', 'WorkersController@edit')->name('admin.worker.update');
	Route::PATCH('/admin/worker/update/{worker}', 'WorkersController@update');
	// Delete worker
	Route::DELETE('/admin/worker/delete/{worker}','WorkersController@destroy')->name('admin.worker.delete');


	// add new category 
	Route::get('/admin/category/add', 'CategoriesController@add')->name('admin.category.add');
	Route::post('/admin/category/add', 'CategoriesController@store');

	// View Categories
	Route::get('/admin/category/view', 'CategoriesController@view')->name('admin.category.view');
	// update category's info
	Route::get('/admin/category/update/{category}', 'CategoriesController@edit')->name('admin.category.update');
	Route::PATCH('/admin/category/update/{category}', 'CategoriesController@update');
	// Delete category
	Route::DELETE('/admin/category/delete/{category}','CategoriesController@destroy')->name('admin.category.delete');


	// add new material 
	Route::get('/admin/material/add', 'MaterialsController@add')->name('admin.material.add');
	Route::post('/admin/material/add', 'MaterialsController@store');

	// View Materials
	Route::get('/admin/material/view', 'MaterialsController@view')->name('admin.material.view');
	// update material's info
	Route::get('/admin/material/update/{material}', 'MaterialsController@edit')->name('admin.material.update');
	Route::PATCH('/admin/material/update/{material}', 'MaterialsController@update');
	// Delete material
	Route::DELETE('/admin/material/delete/{material}','MaterialsController@destroy')->name('admin.material.delete');
	// Use material
	Route::get('/admin/material/decrease/{material}','MaterialsController@decrease');
	Route::PATCH('/admin/material/decrease/{material}', 'MaterialsController@decrease')->name('admin.material.use');

    // Admin emails patients view
	Route::get('/admin/patient/email/{patient?}', 'EmailsController@create')->name('admin.patient.email');
	Route::POST('/admin/patient/email', 'EmailsController@store');
	Route::POST('/admin/emails/mark', 'EmailsController@mark')->name('admin.emails.mark');
	Route::get('/admin/inbox/', 'EmailsController@index')->name('admin.inbox');
	Route::get('/admin/emails/{email}', 'EmailsController@show')->name('admin.email.show');
	Route::DELETE('/admin/emails/delete', 'EmailsController@destroy')->name('admin.email.delete');

	// add new invoice 
	Route::get('/admin/invoice/add', 'InvoicesController@add')->name('admin.invoice.add');
	Route::post('/admin/invoice/add', 'InvoicesController@store');

	// View Invoices
	Route::get('/admin/invoice/view', 'InvoicesController@view')->name('admin.invoice.view');
	// update invoice's info
	Route::get('/admin/invoice/update/{invoice}', 'InvoicesController@edit')->name('admin.invoice.update');
	Route::PATCH('/admin/invoice/update/{invoice}', 'InvoicesController@update');
	// Delete invoice
	Route::DELETE('/admin/invoice/delete/{invoice}','InvoicesController@destroy')->name('admin.invoice.delete');
	// View details of an invoice
	Route::get('/admin/invoice/view/{invoice}', 'InvoicesController@show')->name('admin.invoice.show');

	// mark notification as read
	Route::get('admin/notification/mark/{notification}','NotificationsController@mark');
	Route::PATCH('admin/notification/mark/{notification}','NotificationsController@mark')->name('admin.notification.mark');

	// view notifications 
	Route::get('admin/notification/view','NotificationsController@index')->name('admin.notification.view');

	// Delete notification
	Route::DELETE('/admin/notification/delete/{notification}','NotificationsController@destroy')->name('admin.notification.delete');
	
//timeline for reservations

	Route::get('/admin/patient/reservations', 'ReservationsController@get')->name('admin.reservations');
// admin searches for a date
	Route::post('/admin/patient/reservations', 'ReservationsController@search');

// admin view admins' working times 
	Route::get('admin/admin/times','AdminsController@view_times')->name('admin.admin.times');

// admin view nurses' working times 
	Route::get('admin/nurse/times','NursesController@view_times')->name('admin.nurse.times');

// admin view statistics
	Route::get('admin/statistics', 'HomeController@statistics')->name('admin.statistics');

});