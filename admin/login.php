<?php 
/**********************************************************************************
* Project : MyDictionary.co.uk
* Author  : Mark Firman - www.markfirman.co.uk
* Date	  : 19/02/2020
* login.php - This page allows users to login to the dashboard
* *********************************************************************************

/* Include the header.php page
 * - Required to load HTML header information
 * - Also loads access to the database */
include_once("header.php");

/* Initialise Login Variables */
$username = "";
$email    = "";
$errors = array();

/* Attempt to perform a user login, if the $_POST session has been sent */
if (isset($_POST['login_user'])) {
	
	/* Get the POST username and password */
	$username = $_POST['username'];
	$password = $_POST['password'];
	
	/* Check that the username and password are not null */
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	/* Check that no errors were generated */
	if (count($errors) == 0) {
		
		/* MD5 Hash the users password */
		$password = md5($password);
		
		/* Perform the login query */
		$database->query("SELECT * FROM `users` WHERE `username` = :username AND `password` = :password");
		$database->bind(":username", $username);
		$database->bind(":password", $password);
		$database->execute();
		
		/* Get the database result and check that a match could be found */
		if ($database->rowCount() == 1) {
			
			/* Set the login session details */
			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			$_SESSION['id'] = "24061994";
			
			/* Redirect to the dashboard */
			header('location: index.php');
			
		}else {
			
			/* Return a failed login error message */
			array_push($errors, "Wrong username/password combination");		
		}
	}
}
?>

<body class="bg-dark">
	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">MyDictionary.co.uk - Login</div>
			<div class="card-body">
				<!-- Login Form -->
				<form method="post" action="login.php">

				  <?php /* Include the errors.php file 
						 * This will show any login errors back to the user
						 */ include('errors.php'); ?>

					<!-- Username Input -->
					<div class="form-group">
						<label for="exampleInputEmail1">Username</label>
						<input class="form-control" type="text" name="username">
					</div>

					<!-- Password Input -->
					<div class="form-group">
						<label for="exampleInputPassword1">Password</label>
						<input class="form-control" type="password" name="password">
					</div>

					<!-- Remember Me -->
					<div class="form-group">
						<div class="form-check">
							<label class="form-check-label">
							<input class="form-check-input" type="checkbox"> Remember Password</label>
						</div>
					</div>
		
					<!-- Login Button -->
					<button type="submit" class="btn btn-primary btn-block" name="login_user">Login</button>

				</form>
				<!-- End Login Form -->
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
</body>
</html>