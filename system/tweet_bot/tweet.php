<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */

 /* Turn off error reporting */
 error_reporting(0);
 
 /* Get the HTTP headers */
 $user = $_SERVER['Username'];
 $pass = $_SERVER['Password'];
 
/* Ensure the HTTP headers have the correct authentication*/
/* Include the database and twitter class */
require_once '../class/database.class.php';
require_once 'twitter.class.php';
	
	/* Inititate the database class */
	$database = new Database();
	/* Get the word of the day from the database */
	$word = $database->getWord()['word'];
	
	/* Create tweet template */
	$url = "https://mydictionary.co.uk/";
	$tweet = "Word of the day: ".$word." - ".$url;
	
	/* Initiate the twitter class */
	$twitter = new twitter_bot("TWITTER APP ID", "TWIITER APP KEY", "SEC", "SEC");
	
	/* Send tweet to twitter */
	$twitter->tweet($tweet);

?>