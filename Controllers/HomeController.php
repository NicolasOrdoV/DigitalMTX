<?php

/**
 * Controlador Principal
 */
class HomeController
{
	public function index()
	{
		if (!isset($_SESSION['user'])) {
			require "Views/Layout.php";
			require "Views/Home.php";
			require "Views/footer.php";
			require "views/Scripts.php";
		}else{
			header('Location: ?controller=person&method=template');
		}
	}
}