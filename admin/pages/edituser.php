<?php

/* Check that a valid USER ID has been sent */
if(isset($_GET["value"])){
	$userId = $_GET["value"];
}

/* Query the database for the */
$database->query("SELECT id, username, email FROM `users` WHERE id = :id");
$database->bind(":id", $userId);
$database->execute();


foreach($database->resultset() as $row){
		$id = $row['id'];
		$username = $row['username'];
		$email = $row['email'];
}



?>
<main>
	<div class="container-fluid">
		<h1 class="mt-4">Edit User</h1>
		
		
			<div class="card mb-4">
                            <div class="card-body">You are editing user with ID <?=$id;?> </div>
                        </div>
		
		<div class="row">

            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-users mr-1"></i>Users Details</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" id="username" value="<?=$username;?>" aria-describedby="twitterusername" placeholder="Enter Twitter Bots Username">
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Email</label>
								<input type="text" class="form-control" id="useremail" value="<?=$email;?>" aria-describedby="twitterusername" placeholder="Enter Twitter Bots Username">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="userpassword" aria-describedby="twitterpassword" placeholder="Enter a new Password">
							</div>
							
							<small id="urlhelp" class="form-text text-muted"></a></small>
							<br/>
							
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
		</div>
	</div>
</main>