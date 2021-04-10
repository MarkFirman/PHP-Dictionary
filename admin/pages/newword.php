<main>
	<div class="container-fluid">
		<h1 class="mt-4">New Word</h1>
		<div class="card mb-4">
                            <div class="card-body">Use this section to add new words to the dictionary. You can manually add a new word <b><i>or</i></b> you can use the API Scraper to automatically pull the data for the selected word. </div>
        </div>
		<div class="row">

            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-book mr-1"></i>Manually add a new word</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Word</label>
								<input type="text" class="form-control" id="newword" aria-describedby="newword" placeholder="Enter the new word">
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
								<label for="exampleInputPassword1">Phonetic</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Origin</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Example</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Type</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<div class="form-group">
								<label for="exampleInputPassword1">Audio</label>
								<input type="text" class="form-control" id="newshortdefinition" aria-describedby="newshortdefinition" placeholder="Enter a short definition">
							</div>
							
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
			
			
			            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-spell-check mr-1"></i>Scrape a new word from the Oxford API</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Word</label>
								<input type="text" class="form-control" id="newword" aria-describedby="newword" placeholder="Enter the new word">
							</div>
							<small id="websiteauthorhelp" class="form-text text-muted">The scraper will pull attempt to pull the word data (definition, origin etc) from the Oxford API.</i></small></br>
							<button type="submit" class="btn btn-primary">Scrape</button>
						</form>			
					</div>
                </div>
            </div>
			
		</div>
	</div>
</main>