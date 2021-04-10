<?php

include_once './system/class/database.class.php';
$database = new Database();

// select 10 different words and get their definitions and database ID
$query = $database->query("SELECT id, word, definition FROM dictionary ORDER BY RAND() LIMIT 10");
$result = $database->resultset();

// Array holds slide results from database
$slide = array (
	array("ID","WORD","DEFINITION")
);

// Select 20 random definitions where the database ID not equal to any from the above
$query = $database->query("SELECT definition FROM dictionary WHERE id NOT IN(:slide0,:slide1,:slide2,:slide3,:slide4,:slide5,:slide6,:slide7,:slide8,:slide9) AND definition <> '' ORDER BY RAND() LIMIT 31 ");

// Save database result into slide array and bind ID to above query, as not to use that words definition
$counter = 0;
foreach($result as $row){

	$slide[$counter][0] = $row["id"];
	$slide[$counter][1] = $row["word"];
	$slide[$counter][2] = $row["definition"];
	
	$database->bind("slide".$counter, $slide[$counter][0]);
	$counter++;
}

// Holds a list of definitions with no association to the quiz words
$definition = array ();

// Get the result of definitons with no association from the DB
$result = $database->resultset();

// Save the result of no definition to the definition array
foreach($result as $row){
	array_push($definition, $row["definition"]);
}

?>







<!-- WordOfTheDay Game Template -->
	<body class="noselect">
		<header>
			<div class="search">
				<img src="./assets/img/close.png" alt="Close game button" class="game-close-img" id="close_game" onclick="exitGame();" />
			</div>
			<div class="game_counter" id="counter">
				1 of 10
			</div>
			<div class="timer" id="timer">
				<img src="./assets/img/timer/timer_30.png" alt="Countdown timer" id="timer_img" class="timer_image" /> <div class="timer_text" id="timer_txt">30</div>
			</div>
			
			<div class="menu" id="home_icon">
				<div class="menu-item">
					<a href="./">Home</a>
				</div>
				<div class="menu-item">
					<a href="./?page=game">Quiz</a>
				</div>
			</div>
			
			
		
		</header>
		<div class="container">
		
			<!-- START PAGE -->
			<div class="game_start_page" id="game_start_page">
				<div class="game_sp_title">1 Word, 3 Definitions, 30 Seconds</div>
				<div class="game_sp_tagline">You are presented with 10 random words, choose the correct definition in the time limit to earn a point.</div>
				<div class="game_sp_button" onclick="prepareGame();">Start Quiz</div>
			</div>
			<!-- END START PAGE -->
			
			<!-- RESULT PAGE -->
			<div class="result_page" id="results_page">
				<div class="score" id="endresult">0/10</div>
				<div class="spacer_center"></div>
				<div class="share_result_container">
					<div class="share_result_header">Share result</div>
					<a href="https://www.facebook.com/sharer/sharer.php?u=https://mydictionary.co.uk/?page=game" target="_blank"><img src="./assets/img/share_facebook.png" class="rp_fb_img" /></a>
					<a href="http://twitter.com/share?text=Quiz Game&url=https://mydictionary.co.uk/?page=game" target="_blank"><img src="./assets/img/share_twitter.png" class="rp_tw_img" /></a>
				</div>
			</div>
			<!--END RESULT PAGE -->
		
			<!-- GAME -->
			<div class="dictionary_game" id="dictionary_game">
				<div class="header_text">Define:</div>
				
				<?php
				
					$defCounter = 0;
				
					/* Loop over each slide and output HTML */
					/* This will create the quiz slides */
					for($i = 0; $i < count($slide); $i++){
						
						/* We do not want the correct answer to always be in the same sort order, so lets randomise this */
						$correctAnswer = rand(1, 3);
						
						/* Output HTML slide */
						echo '
						
							<!-- SLIDE '.$i.' -->
							<div class="game_slide_container" id="question_'.($i + 1).'">
							
							<div class="game_word" id="game_word">
								<h1>'.ucfirst($slide[$i][1]).'</h1>
							</div>
							<div class="spacer"></div>
								<div class="answer_container">
								';
								
								for($j = 1; $j <= 3; $j++){
								
									echo '
									
									<div class="game_answerbox" onclick="choose_answer(1);">'.($correctAnswer == $j ? $slide[$i][2] : $definition[$defCounter + $j] ).'
										<img src="" id="'.($correctAnswer == $j ? "y_answer" : "x_answer").'" class="answerbox_no_result" />
									</div>
									
									';
								}
								
								$defCounter = $defCounter + 3;
									
							echo '
								</div>
							</div>
							<!-- END SLIDE '.$i.' -->
						';
					}
				?>
				
				
				
		
				
				
				<!-- SLIDE DOTS -->
				<div class="game_pagination dotstyle-fillup">
					<li class="dot"><a>1</a></li>
					<li class="dot"><a>2</a></li>
					<li class="dot"><a>3</a></li>
					<li class="dot"><a>4</a></li>
					<li class="dot"><a>5</a></li>
					<li class="dot"><a>6</a></li>
					<li class="dot"><a>7</a></li>
					<li class="dot"><a>8</a></li>
					<li class="dot"><a>9</a></li>
					<li class="dot"><a>10</a></li>
				</div>
				<!-- END SLIDE DOTS -->
			
			</div>
			<!-- END GAME -->
		</div>
		<footer>
			<div class="icons">
				<a href="<?=$this->twitter_link;?>" target="_blank">
					<img src="./assets/img/twitter.png" class="twitter-icon" alt="" />
				</a>
				<a href="<?=$this->github_link;?>" target="_blank">
					<img src="./assets/img/github.png" class="github-icon" alt="" />
				</a>
				<a href="<?=$this->opaque_link;?>" target="_blank">
					<img src="./assets/img/opaque.png" class="opaque-icon" alt="" />
				</a>
			</div>
			<div class="date"><?=$this->todays_date;?></div> 

		</footer>
		<script>
			/* Variables */
			var slideIndex = 1; // Index of the slide currently in view
			var correctAnswers = 0; // Current correct answers
			var timeLeft = 30; // Time per question
			var maxTimeLeft = 30;
			var difficulty = 0; // difficulty 0 = easy, 1 = medium, 2 = hard
			
			var timer;
			
			/* Resets the game variables */
			function resetGame(){
				
				clearTimeout(timer);
				
				document.getElementById("counter").innerHTML = "1 of 10";
				document.getElementById("timer_txt").innerHTML = maxTimeLeft;
				slideIndex = 1;
				correctAnswers = 0;
				timeLeft = maxTimeLeft;
				difficulty = 0;
				
				var slides = document.getElementsByClassName("game_slide_container");
				var dots = document.getElementsByClassName("dot");
				
				for(let item of slides){
					item.style.display = "none";
					item.className = item.className.replace(" slide_left", "");
				}
				for(let item of dots){
					item.className = item.className.replace(" current", "");
				}
				
				slides[0].style.display = "block";
				dots[0].className += " current";
				
				var reset_incorrect_answer = document.querySelectorAll('.answerbox_incorrect');
				var reset_correct_answer = document.querySelectorAll('.answerbox_correct');
				
				for(let item of reset_incorrect_answer){
					item.className = item.className.replace("answerbox_incorrect", "answerbox_no_result");
				}
				
				for(let item of reset_correct_answer){
					item.className = item.className.replace("answerbox_correct", "answerbox_no_result");
				}
				
			}
			
			/* Called when the user clicks ready to play game */
			function prepareGame(){
				
				/* Hide the result page */
				document.getElementById("results_page").style.display = "none";
				
				/* Hide the start game page */
				document.getElementById("game_start_page").style.display = "none";
				document.getElementById("home_icon").style.display = "none";
				
				/* Show the game page */
				document.getElementById("dictionary_game").style.display = "block";
				
				/* load the game timer and counter */
				document.getElementById("counter").style.display = "inline";
				document.getElementById("timer").style.display = "inline";
				document.getElementById("close_game").style.display = "inline";
				
				
				/* Start the game */
				startGame();
			
			}
			
			/* Handles the game timer */
			function gameTimer(){
				if(timeLeft == 1){
					clearTimeout(timer);
					timeLeft = 30;
					document.getElementById("timer_txt").style = "font-size: 14pt;padding-left: 11px;padding-top: 1px;";
					gotoSlide(slideIndex + 1);
				} else {
					
					timeLeft--;
					if(timeLeft <= 9){
						document.getElementById("timer_txt").style = "font-size: 15pt;padding-left: 15px;padding-top: 0px;";
					} else if (timeLeft <= 19){
						document.getElementById("timer_txt").style = "font-size: 14pt;padding-left: 10px;padding-top: 1px;";
					}
					
					document.getElementById("timer_txt").innerHTML = timeLeft;
					document.getElementById("timer_img").src = "./assets/img/timer/timer_" + timeLeft + ".png";
				}
				
			}
			
			/* Forces the current slide out of view and shows a new slide based on its index as specified by n */
			function gotoSlide(n){
				slideIndex = n;
				if(slideIndex < 11){
					showSlides(slideIndex);
					timer = setInterval(gameTimer, 1000);
				} else {
					showResultsPage();
				}
			}
			
			/* Shows the results page */
			function showResultsPage(){
			
				/* Hide the start*/
				document.getElementById("game_start_page").style.display = "none";
				document.getElementById("home_icon").style.display = "none";
				
				/* Hide the game page */
				document.getElementById("dictionary_game").style.display = "none";
				
				/* Hide the game timer and counter */
				document.getElementById("counter").style.display = "none";
				document.getElementById("timer").style.display = "none";
				document.getElementById("close_game").style.display = "none";
				
				/* Show the results page */
				document.getElementById("results_page").style.display = "block";
				
				/* Show number of correct answers */
				document.getElementById("endresult").innerHTML = correctAnswers + "/10";
				
				/* Show the menu UI */
				document.getElementById("home_icon").style.display = "block";
			}

			/* Called to start the game */
			function startGame(){
			
				timer = setInterval(gameTimer, 1000);
			
				var slides = document.getElementsByClassName("game_slide_container");
				var dots = document.getElementsByClassName("dot");
				slides[0].style.display = "block";
				dots[0].className += " current";
			}

			/* Shows a slide based on its index specified by n */
			function showSlides(n) {
			
				/* Get all possible slides and dots as a HTMLCollection */
				var slides = document.getElementsByClassName("game_slide_container");
				var dots = document.getElementsByClassName("dot");
				
				/* Hide the current slide by transistioning left and setting display = none */
				slides[n-2].className += " slide_left";
				dots[n-2].className = dots[n-2].className.replace(" current", "");
				
				/* Begin showing the next slide by transitioning left from the right */
				setTimeout(function(){ 
				
					/* Make slide sit on the right (so that we can transistion it into view from the right) */
					slides[n-2].style.display = "none";
					slides[n-1].style.marginLeft = "1000px";
					slides[n-1].style.display = "block";
					
					/* Update the current question counter */
					document.getElementById("counter").innerHTML = n + " of 10";
					
					/* Update the timer */
					document.getElementById("timer_txt").innerHTML = "30";
					document.getElementById("timer_img").src = "./assets/img/timer/timer_" + timeLeft + ".png";
					
						setTimeout(function() {
						
							/* Transition the new slide into view */
							slides[n-1].style.marginLeft = "0px";
							
						}, 300)
						
						/* Update the currently selected dot */
						dots[n-1].className += " current";
				}, 300)
				
			}

			/* Hides a game slide */
			function hideSlide(n){
				var slides = document.getElementsByClassName("game_slide_container");
				slides[n-2].style.display = "none";
			}

			/* Exits the game back to the start page */
			function exitGame(){
			
				/* Show start page */
				document.getElementById("game_start_page").style.display = "block";
				document.getElementById("home_icon").style.display = "block";
				
				/* Hide the game page */
				document.getElementById("dictionary_game").style.display = "none";
				
				/* Hide the game timer and counter */
				document.getElementById("counter").style.display = "none";
				document.getElementById("timer").style.display = "none";
				document.getElementById("close_game").style.display = "none";
				
				/* Reset the game */
				resetGame();
			}
			
			/* Redirects back to homepage */
			function goHome(){
				window.location.href = "?page=index";
			}
			
			/* Called when the users chooses an answer */
			function choose_answer(n){
				
				/* Stop the game timer as an answer has been choosen */
				clearTimeout(timer);
				document.getElementById("timer_txt").style = "font-size: 14pt;padding-left: 11px;padding-top: 1px;";
				timeLeft = 30;
				
				/* Gets all possible answers as HTMLCollection (unfortunetly includes all possible answers of all questions) */
				var list = document.querySelectorAll('.answerbox_no_result');
				
				/* Determine if the answer selected was correct */
				if(list[n-1].id == "y_answer"){ correctAnswers++; }
				
					/* Iterate over the possible answers */
					for(let answers of list){
						/* Ensure only the current questions answers are marked by checking that the answer element is a child of the current question */
						if(document.getElementById("question_" + slideIndex).contains(answers)){
						
							/* Shows the incorrect answers */
							if(answers.id == "x_answer"){ 
								answers.src = "./assets/img/incorrect_answer.png";
								answers.className = "answerbox_incorrect";
							} 
							
							/* Shows the correct answers */
							if(answers.id == "y_answer"){ 
								answers.src = "./assets/img/answer_correct_icon.png";
								answers.className = "answerbox_correct";
							}
						}
					}
				/* Forces the next slide into view after the results have been shown for x seconds */
				setTimeout(function(){
					gotoSlide(slideIndex + 1);
				}, 1000);	
			}
			
		</script>
	</body>
</html>