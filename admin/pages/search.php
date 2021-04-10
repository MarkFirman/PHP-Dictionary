<?php

/* Check if a valid search has been initialised */
if(isset($_POST["searchtext"])){
	$search = $_POST["searchtext"];
}


?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Search Results</h1>

						<div class="card mb-4">
                            <div class="card-body">Use this section to view search results</div>
                        </div>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-search mr-1"></i>Results for <?php echo $search; ?></div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Word</th>
                                                <th>Language</th>
                                                <th>Definition</th>
												<th>Short Definition</th>
												<th>Phonetic</th>
												<th>Example</th>
												<th>Origin</th>
												<th>Type</th>
												<th>Audio</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>ID</th>
                                                <th>Word</th>
                                                <th>Language</th>
                                                <th>Definition</th>
												<th>Short Definition</th>
												<th>Phonetic</th>
												<th>Example</th>
												<th>Origin</th>
												<th>Type</th>
												<th>Audio</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
										
										<?php
											// Send the SQL query to the database
											$database->query("SELECT id, word, language, definition, audio, phonetic, short_definition, example, origin, type FROM `dictionary` WHERE word = :word");
											$database->bind(":word", $_POST["searchtext"]);
											$database->execute();
											
											// Iterate each user
											foreach($database->resultset() as $row){
												echo "<tr>";
												echo "<th>".$row['id']."</th>";
												echo "<th><a href='index.php?page=editword&word=".$row['word']."'>".$row['word']."</a></th>";
												echo "<th>".$row['language']."</th>";
												echo "<th>".$row['definition']."</th>";
												echo "<th>".$row['short_definition']."</th>";
												echo "<th>".$row['phonetic']."</th>";
												echo "<th>".$row['example']."</th>";
												echo "<th>".$row['origin']."</th>";
												echo "<th>".$row['type']."</th>";
												echo "<th>".$row['audio']."</th>";
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