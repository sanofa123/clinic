<?php

namespace App;

use Illuminate\Support\Facades\Route;
/**
* 
*/
class Navigation
{
	public static function setActive($route = null)
	{
		return (Route::currentRouteName() == $route)? 'active': '';
	}
}