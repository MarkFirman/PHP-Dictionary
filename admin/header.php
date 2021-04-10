<?php
/**********************************************************************************
* Project : MyDictionary.co.uk
* Author  : Mark Firman - www.markfirman.co.uk
* Date	  : 19/02/2020
* header.php - This page will initialise the HTML headers for the administrator page
*			 - and also initialises a new instance of the database connection
* *********************************************************************************

/* Get the current session */
session_start();

/* Include the database class so that we can make and receive database calls */
include_once("../system/class/database.class.php");

/* Initialise the database connection */
$database = new Database();

?>

<!DOCTYPE html>
<html lang="en">
    <head>
	
		<!-- Meta information -->
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="My Dictionary Administrator Panel" />
        <meta name="author" content="Mark Firman" />
		
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="../assets/css/favicon-180.png"/>
        
		<!-- Page Title -->
		<title>My Dictionary Admin Panel</title>
		
		<!-- Include stylesheets and JS -->
        <link href="../assets/css/admin.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" crossorigin="anonymous"></script>
		
    </head>