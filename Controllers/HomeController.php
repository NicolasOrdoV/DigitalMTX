<?php

/**
 * Controlador Principal
 */
class HomeController
{
	public function index()
	{
		if (isset($_SESSION['user'])) {
			header('Location: ?controller=person&method=template');
		}else{
			header('Location: ?controller=login');
		}
	}
}