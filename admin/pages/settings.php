<main>
    <div class="container-fluid">
        <h1 class="mt-4">Application Settings</h1>
           
		    <div class="card mb-4">
                <div class="card-body">Manage application wide settings including web preferences, META and SEO</div>
            </div>
		   
        <div class="row">
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-cog mr-1"></i>Website Preferences</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="websiteURL">Website base URL</label>
								<input type="text" class="form-control" id="websiteurl" aria-describedby="websiteurl" placeholder="The website URL">
								<small id="websiteurlhelp" class="form-text text-muted">Do not include the trailing slash, a valid URL might be: <i>https://mydictionary.co.uk</i>. Entering an incorrect value here could cause the application to stop working.</small>
							</div>
						
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
			
			<div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-cog mr-1"></i>Website META and SEO</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="websitetitle">Website Title</label>
								<input type="text" class="form-control" id="websitetitle" aria-describedby="websitetitle" placeholder="The website title">
								<small id="websiteurlhelp" class="form-text text-muted">This is the text that appears between the <i>&lt;title&gt;</i> tags</small>
							</div>
							
							<div class="form-group">
								<label for="websitedescription">Website Description</label>
								<input type="text" class="form-control" id="websitedescription" aria-describedby="websitedescription" placeholder="Enter a META description">
								<small id="websitedescriptionhelp" class="form-text text-muted">This should be a snippet of up to about 155 characters that summarizes the website. Search engines use the meta desription in search results.</small>
							</div>
							
							<div class="form-group">
								<label for="websitekeywords">Meta Keywords</label>
								<input type="text" class="form-control" id="websitekeywords" aria-describedby="websitekeywords" placeholder="Enter META keywords">
								<small id="websitekeywordshelp" class="form-text text-muted">Seperate all keywords by a comma. eg; <i>dictionary, word, learning, education</i></small>
							</div>
							
							
							<div class="form-group">
								<label for="websiteauthor">Meta Author</label>
								<input type="text" class="form-control" id="websiteauthor" aria-describedby="websiteauthor" placeholder="Enter the Authors name">
								<small id="websiteauthorhelp" class="form-text text-muted">The author of the web application</i></small>
							</div>
							
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
		</div>
	</div>
</main>