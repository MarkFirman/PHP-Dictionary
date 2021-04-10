<?php

/* Check that a valid USER ID has been sent */
if(isset($_GET["word"])){
	$word = $_GET["word"];
}

/* Query the database for the word */
$database->query("SELECT id, word, language, definition, audio, phonetic, short_definition, example, origin, type, date FROM `dictionary` WHERE word = :word");
$database->bind(":word", $word);
$database->execute();

foreach($database->resultset() as $row){
		$id = $row['id'];
		$language = $row['language'];
		$defintion = $row['definition'];
		$audio = $row['audio'];
		$phonetic  = $row['phonetic'];
		$sdefinition = $row['short_definition'];
		$example = $row['example'];
		$origin = $row['origin'];
		$type = $row['type'];
		$date = $row['date'];
}

?>


<main>
	<div class="container-fluid">
		<h1 class="mt-4">Edit Word</h1>


			<div class="card mb-4">
                            <div class="card-body">You are editing the word: <?=$word;?> </div>
                        </div>

		<div class="row">

            <div class="col-xl-12">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-book mr-1"></i>Edit Word</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Word</label>
								<input type="text" class="form-control" id="newword" aria-describedby="newword" placeholder="Enter the new word">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Language</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Short Definition</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Long Definition</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Example</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Origin</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Type</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Date</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Phonetic</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Audio URL</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<br/>
					
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
		</div>
	</div>
</main>