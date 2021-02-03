<?php

use App\Http\Controllers\Patient\HomeController;

Route::get('/die', [HomeController::class, 'home']);

// get home page route (it must be added to controller later)
// Route::get('/', 'Patient\HomeController@home');

// Route::get('/', [HomeController::class, 'home']);


// patient routes
include 'patientRoutes.php';


// admin routes
include 'adminRoutes.php';

// Nurse routes
include 'nurseRoutes.php';