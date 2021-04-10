<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */
 
	/* Set error reporitng */
	error_reporting(E_ALL);
	
	/* Set the timezone */
	date_default_timezone_set("Europe/London");

	/* Set definitions */
	DEFINE("ROOT", "./");
	DEFINE("ROOT_CLASS", ROOT."system/class/");
	
	/* Include files */
	include_once ROOT_CLASS."system.class.php";
	
	/* Initiate the system */
	$system = new Engine();
	$system->getDisplay();
	
?>