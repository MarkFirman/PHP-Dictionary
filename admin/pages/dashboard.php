      <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Dashboard</h1>

                        <div class="row">
						
							<!-- Number of total words -->
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
									<?php 
										/* Total number of words in dictionary */
										$database->query("SELECT COUNT(word) as cword FROM dictionary");
										$database->execute();
										foreach($database->resultset() as $row){
											echo $row['cword'];
										} ?> Total Words</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="index.php?page=words">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
							<!-- Number of times Quiz game played -->
							<div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">52 Gameplays</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="index.php?page=stats">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
                            <!-- Number of Words with missing attributes -->
							<div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">2 Words with missing attributes</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="index.php?page=missingattributes">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
							<!-- Number of Words Tweeted by Bot -->
							<div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">365 Words Tweeted</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="index.php?page=twitterbot">View Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
							
                        </div>
						
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-search mr-1"></i>Top 20 Searched Words</div>
                            <div class="card-body">
                               
							   <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Word</th>
												<th>Date Searched</th>
												<th>Total Number of Searches</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Word</th>
												<th>Date Searched</th>
												<th>Total Number of Searches</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
										
										<?php
											// Send the SQL query to the database
											$database->query("SELECT COUNT(word) as cword, word, date from `word_searches` group by word order by cword asc LIMIT 20");
											$database->execute();
											
											// Iterate each user
											foreach($database->resultset() as $row){
												echo "<tr>";
												echo "<th>".$row['word']."</th>";
												echo "<th>".$row['date']."</th>";
												echo "<th>".$row['cword']."</th>";
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