<main>
    <div class="container-fluid">
        <h1 class="mt-4">Manage Users</h1>

						<div class="card mb-4">
                            <div class="card-body">Use this section to manage existing administrative users. Click <a href="./index.php?page=newuser">here</a> to add a new user.</div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-users mr-1"></i>Current Users</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Email</th>
                                                <th>Password</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
										
										<?php
											// Send the SQL query to the database
											$database->query("SELECT id, username, email, password FROM `users`");
											$database->execute();
											
											// Iterate each user
											foreach($database->resultset() as $row){
												echo "<tr>";
												echo "<th>".$row['id']."</th>";
												echo "<th><a href='index.php?page=edituser&value=".$row['id']."'>".$row['username']."</a></th>";
												echo "<th>".$row['email']."</th>";
												echo "<th>".$row['password']."</th>";
												echo "</tr>";
											}
										?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
	</div>
</main>