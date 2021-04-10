<?php
/**********************************************************************************
* Project : MyDictionary.co.uk
* Author  : Mark Firman - www.markfirman.co.uk
* Date	  : 19/02/2020
* errors.php - This page will show any login errors back to the user
* *********************************************************************************

	/* Check if atleast 1 error has been reported */
	if (count($errors) > 0) {

		/* HTML */
		echo '<div class="error">';

		/* Loop over each error */
		foreach ($errors as $error){

			/* Show the error */
			echo $error;
		}
	
		/* HTML */
		echo '</div>';
	}
    
?>
