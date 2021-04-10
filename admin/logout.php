<?php
/***********************************************************************************************
* Project : MyDictionary.co.uk
* Author  : Mark Firman - www.markfirman.co.uk
* Date	  : 19/02/2020
* logout.php - This page will destroy any open sessions and logout the user before redirecting to the login page
************************************************************************************************

	/* Get the current session */
	session_start();

	/* Reset any session variables */
	$_SESSION = array();
	
	/* Destroy any open sessions */
	session_destroy();
	
	/* Redirect to the login page */
	header('location: login.php');
	
?>