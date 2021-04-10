<main>
	<div class="container-fluid">
		<h1 class="mt-4">Twitter Bot</h1>
		
			<div class="card mb-4">
                            <div class="card-body">Use this section to setup/amend the twitter bots account details. To view twitter bot statistics, please visit the <a href="./index.php?page=stats">statistics</a> page.</div>
                        </div>
		<div class="row">

			<!-- Twitter Bot Account Details Form -->
            <div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fab fa-twitter mr-1"></i>Twitter bot account details</div>
                    <div class="card-body">
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Username</label>
								<input type="text" class="form-control" id="twitterusername" aria-describedby="twitterusername" placeholder="Enter Twitter Bots Username">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="twitterpassword" aria-describedby="twitterpassword" placeholder="Enter Twitter Bots Password">
							</div>
							
							<small id="urlhelp" class="form-text text-muted">If you do not have a twitter account, you can get one from <a href="http://www.twitter.com">here</a></small>
							<br/>
							
							<div class="form-group">
								<label for="TwitterAppKey">App Key</label>
								<input type="text" class="form-control" id="twitterkey" aria-describedby="twitterkey" placeholder="Enter Twitter App Key">
							</div>
							<div class="form-group">
								<label for="TwitterAppSecret">App Secret</label>
								<input type="text" class="form-control" id="twittersecret" aria-describedby="twittersecret" placeholder="Enter Twitter App Secret">
							</div>
							
							<small id="urlhelp" class="form-text text-muted">If you do not have access to the twitter api, please go <a href="https://developer.twitter.com/en/docs/basics/getting-started">here</a></small>
							<br/>
							
							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
			
			<!-- Twitter Bot Auto Tweet Cron Job Form -->
			<div class="col-xl-6">
                <div class="card mb-4">
                    <div class="card-header"><i class="fas fa-clock mr-1"></i>Twitter bot auto tweeter</div>
                    <div class="card-body">
						<form>
					
							<div class="form-group">
								<label for="autotweeter">Enable Auto-Tweeter?</label>
								&nbsp;<input type="checkbox" id="autotweeter" aria-describedby="autotweeter">
								<small id="urlhelp" class="form-text text-muted">NOTE: In order to enable the auto-tweeter, you need to have access to Cron Jobs on your webserver.</small>
							</div>
							
							<div class="form-group">
								<label for="TwitterAppSecret">Tweet Wording</label>
								<textarea type="text" class="form-control" id="twittersecret" aria-describedby="twittersecret" placeholder="Enter Twitter App Secret">[LINK=http://www.mydictionary.co.uk/%word%]%word[/LINK] - %short_definition%</textarea>
								<small id="urlhelp" class="form-text text-muted">Valid placeholders; %word% | %short_definition% | %type% | [LINK=URL]Text[/LINK]</small>
							<br/>
							</div>

							<button type="submit" class="btn btn-primary">Save</button>
						</form>			
					</div>
                </div>
            </div>
			
			
			
		</div>
	</div>
</main>