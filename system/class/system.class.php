<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */
class Engine {
	
	/* Oxford dictionary API app and authentication keys */
	protected $oxford_api_key= "YOUR APP KEY";
	protected $oxford_api_id = "YOUR APP ID";
	private $oxford_lang = "en-gb";
	
	/* Footer icon URLs */
	private $twitter_link = "http://www.twitter.com/VocabExtender";
	private $github_link = "https://github.com/MarkFirman/WordOfTheDay";
	private $opaque_link = "http://www.markfirman.co.uk";

	/* Class Variables */
	private $word; 
	private $search_query; /* Holds the current search query */
	private $page; /* Holds the current page */
	
	private $css; /* Holds dynamic CSS */
	
	/* Objects from classes */
	private $dictionary; /* Container for the dictionary class */
	private $database; /* Container for the database class */
	private $template; /* Container for the template class */
	private $wotd; /* container for the word of the day class */
	
	///=====================================================================================
	/// Called when this class is initialised
	///=====================================================================================
	function __construct(){
		
		/* Include the neccessary classes */
		include_once './system/class/template.class.php';
		include_once './system/class/dictionary.class.php';
		include_once './system/class/database.class.php';
		include_once './system/class/wotd.class.php';
		
		/* Initiate the database class */
		$this->database = new Database();
		
		/* Initiate the dictionary class */
		$this->dictionary = new Dictionary($this->oxford_api_id, $this->oxford_api_key, $this->oxford_lang);
		
		/* Initiate the template class */
		$this->template = new Template();
		
		/* Initiate the WOTD class */
		$this->wotd = new WOTD();
		
		/* Handle GET / POST requests */
		$this->handleGetPost();
		
		/* Determine and set dynamic CSS */
		$this->css = "<style>body { background-color: ".$this->wotd->background_colour."; }
			.search_button:hover { background-color: ".$this->wotd->background_colour."; }
			". $this->wotd->determineFontSize($this->word) ."
			footer { background-color: ".$this->wotd->background_colour."; } </style>";
		
		/* Set the template variables */
		$this->setTemplateVariables();
		
	}
	
	///=====================================================================================
	/// handleGetPost() : processes any GET or POST requests
	/// Note: 
	///=====================================================================================
	function handleGetPost(){
		
		/* Handle GET requests */
		if(isset($_GET['page'])){
			$this->page = html_entity_decode(htmlspecialchars(strip_tags($_GET['page'])));
		} else {
			$this->page = null;
		}
	
		/* Handle POST requests */
		if(isset($_POST['search']) && isset($_POST['page'])){
			 $this->search_query = html_entity_decode(htmlspecialchars(strip_tags($_POST['search'])));
			 $this->page = html_entity_decode(htmlspecialchars(strip_tags($_POST['page'])));
		} else {
			$this->search_query = "Error";
		}
	}
	
	///=====================================================================================
	/// setTemplateVariables() : Sets the variables that can be used within the template files
	/// Note: variables within the template files can be called using: $this->twitter_link;
	///=====================================================================================
	function setTemplateVariables(){
		
		// Set global template variables
		// These are variables that are used on most pages
		
		/* Set Footer Icon URLs */
		$this->template->twitter_link = $this->twitter_link;
		$this->template->github_link = $this->github_link;
		$this->template->opaque_link = $this->opaque_link;
		
		/* Set todays date STRING */
		$this->template->todays_date = $this->wotd->todays_date;
		
		/* Set dynamic CSS for inclusion */
		$this->template->color_css = $this->css;
		
		//
		//
		
		// Set template variables relevant to current page only
		switch($this->page){

			case "search":
			null:
			default:
			
				/* Gets the word of the day data from the Oxford API */
				/* Initiates a new request*/
				if($this->dictionary->newRequest( $this->wotd->replaceSpaces( ( $this->page == "search" ? $this->search_query : $this->database->getWord()['word'] ) ) ) == null){
					
					// If the request was invalid the below code is called
					// Set template variables to show error
					$this->template->word = "Error";
					$this->template->phonetic = "(ˈɛrə)";
					$this->template->type = "noun";
					$this->template->definition = "A problem occured.";
					$this->template->example = "We use the <a href='www.oxforddictionaries.com' target='_blank'>Oxford</a> English dictionary to find words - unfortunately we could not locate any entries matching <strong>".substr($this->search_query, 0, 22)."</strong>.";
					$this->template->audio_url = "./assets/audio/error.mp3";
					$this->template->audio_script = "<script>var aAudio = new Audio('".$this->template->audio_url."'); function playAudio(){ if(aAudio.duration > 0 && !aAudio.paused){  } else { aAudio.play(); } }</script>";	
					return;
				}
				
				
				/* Set the search query variable */
				$this->template->word = $this->dictionary->word;
				/* Set the current $word var */
				$this->word = $this->dictionary->word;
				/* Set the Phonetic */
				$this->template->phonetic = $this->dictionary->phonetic;
				/* Set the word definition */
				$this->template->definition = ucfirst($this->dictionary->definition);
				/* Set the example (context) */
				$this->template->example = ucfirst( $this->wotd->makeWordStrong( ($this->dictionary->example == null ? "<i>Oops</i> - an example sentence for ".$this->dictionary->word." could not be found." : $this->dictionary->example), $this->word ) );
				/* Set the word type */
				$this->template->type = $this->dictionary->type;
				/* Set the Audio URL */
				$this->template->audio_url = ($this->dictionary->audioURL != null)? $this->dictionary->audioURL : "./assets/audio/error.mp3";
				/* Set the Audio JAVASCRIPT */
				$this->template->audio_script = "<script>var aAudio = new Audio('".$this->template->audio_url."'); function playAudio(){ if(aAudio.duration > 0 && !aAudio.paused){  } else { aAudio.play(); } }</script>";	
				
				if($this->page == "search"){
						
						if($this->dictionary->type != null && $this->dictionary->definition != null && $this->dictionary->phonetic != null){

							/* Check if the searched word appears in the dictionary already, if not, add it */
							$this->database->query("SELECT id FROM dictionary WHERE word = :word");
							$this->database->bind("word", $this->search_query);
							$result = $this->database->single();
							if($this->database->rowCount() == 0){
								
								/* Insert the new word into the database */
								$this->database->query("INSERT INTO dictionary (word, language, definition, audio, phonetic, short_definition, example, origin, type) VALUES (:word, 'en-gb', :def, :audio, :phonetic, :sdef, :example, :origin, :type)");
								$this->database->bind("word", $this->dictionary->word);
								$this->database->bind("def", ($this->dictionary->definition == null ? "" : $this->dictionary->definition ));
								$this->database->bind("audio", ($this->dictionary->audioURL == null ? "" : $this->dictionary->audioURL ));
								$this->database->bind("phonetic", ($this->dictionary->phonetic == null ? "" : $this->dictionary->phonetic ));
								$this->database->bind("sdef", ($this->dictionary->shortDefinition == null ? "" : $this->dictionary->shortDefinition ));
								$this->database->bind("example", ($this->dictionary->example == null ? "" : $this->dictionary->example));
								$this->database->bind("origin", ($this->dictionary->etymology == null ? "" : $this->dictionary->etymology ));
								$this->database->bind("type", ($this->dictionary->type == null ? "" : $this->dictionary->type ));
								$this->database->execute();
							}
						}
					}
			
			break;
			
		}
		
	}
	
	///=====================================================================================
	/// getDisplay() : renders the webpage
	/// Note: 
	///=====================================================================================
	function getDisplay(){
		/* Determine page to render */
		
			switch($this->page){
				
				case "game":
					/* Render the game template */
					echo $this->template->render('game.tpl');
				break;
				case "search":
				default:
					/* Render the index page */
					echo $this->template->render('index.tpl');
				break;
			}
		
	}
	
}
?>