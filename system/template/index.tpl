<!-- WordOfTheDay Index Template -->
	<body class="noselect">
		
		<?php include_once './system/template/nav.tpl'; ?>
		
		<div class="container">
			<div class="dictionary">
				<h1><?=ucfirst($this->word);?></h1>
				<div class="spacer"></div>
				<div class="finetic"><?=$this->phonetic;?></div>
					<div class="speaker"><img src="./assets/img/speaker.png" class="speaker-img" onclick="playAudio();" alt="Plays audio pronunciation"/></div>
				<div class="type"><?=$this->type;?></div>
				<div class="title">Definition</div>
				<div class="spacer small"></div>
				<p><?=$this->definition;?></p>
				<div class="title">Context</div>
				<div class="spacer small"></div>
				<p class="italic"><?=$this->example;?></p>
			</div>
		</div>
		
		<?php include_once './system/template/footer.tpl'; ?>
		
		<?php include_once './system/template/overlay.tpl'; ?>
		
	</body>
</html>