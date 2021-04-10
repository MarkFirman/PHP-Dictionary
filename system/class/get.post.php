<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */

	///=====================================================================================
	/// GET requests for admin panel
	///=====================================================================================
	if(isset($_GET['page'])){
		$page = html_entity_decode($_GET['page']);
	} else {
		$page = null;
	}
	
	///=====================================================================================
	/// POST requests for admin panel
	///=====================================================================================
	if(isset($_POST['search']) && isset($_POST['page'])){
		 $search_query = html_entity_decode($_POST['search']);
		 $page = html_entity_decode($_POST['page']);
	} else {
		$search_query = null;
	}
?>