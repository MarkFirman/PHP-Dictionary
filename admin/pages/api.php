<main>
	<div class="container-fluid">
		<h1 class="mt-4">Oxford API</h1>
		<div class="card mb-4">
            <div class="card-body">Use this section to configure the Oxford API.</div>
        </div>
		<div class="row">

            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-spell-check mr-1"></i>Oxford API credentials</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Base URL</label>
								<input type="apiurl" class="form-control" id="apiurl" aria-describedby="emailHelp" placeholder="Enter the API base URL">
								<small id="urlhelp" class="form-text text-muted">(https://od-api.oxforddictionaries.com/api/v2)</small>
							</div>
							<div class="form-group">
								<label for="exampleInputEmail1">Application Key</label>
								<input type="apikey" class="form-control" id="apikey" aria-describedby="apiKey" placeholder="Enter Oxford Application Key">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Application Secret</label>
								<input type="apisecret" class="form-control" id="apisecret" aria-describedby="apiSecret" placeholder="Enter Oxford Application Secret">
							</div>
							
							<small id="urlhelp" class="form-text text-muted">If you do not have API credentials, you can get them from <a href="https://developer.oxforddictionaries.com/?tag=#plans">here</a></small>
							<br/>
							
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
		</div>
	</div>
</main>