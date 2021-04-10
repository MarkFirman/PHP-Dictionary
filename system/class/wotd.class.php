<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2020
 *
 */
class WOTD {
	
	public $background_colour; /* Holds the CSS colour. Derived from the day number of the current date */
	public $todays_date;
	private $day_number; /* Holds the current day number ie 1-31 */
	
	/* Initial setup */
	function __construct(){
		
		/* Set Variables */
		$this->day_number = $this->getDayNumber();
		$this->background_colour = $this->getBackgroundColour();
		$this->todays_date = $this->getTodayDate();
	}
	
	///=====================================================================================
	/// getBackgroundColour() : returns a css hex colour code
	/// Note: the returned colour changes depending on the current day
	///=====================================================================================
	function getBackgroundColour(){
		/* Array of 31 different colours */
		$color_array = array("#E10600", "#FC4C02","#29C0E7","#DA0039","#FFAD00","#FF6D00","#FFC700","#FFEC2D","#FFBC00","#73C92D","#97D700","#269F2A","#005A28","#00CFB4","#00B0A5","#29C0E7","#00A3E1","#0084CD","#00ADE6","#303AB2","#006EC1","#0047BB","#06038D","#330072","#C800A1","#A438A8","#7F35B2","#4D49BE","#C724B1","#E63888","#FF82DB","#E10600");
		/* Returns a random colour, based on the current day of the month */
		return $color_array[$this->day_number];
	}
	
	///=====================================================================================
	/// getDayNumber() : Returns the current day number ie 11/Dec/2018
	/// Note: if the date has a leading 0, it is removed ie 07 = 7
	///=====================================================================================
	function getDayNumber(){
		if(substr(date("d",strtotime(date('d-m-Y'))), 0, 1) == 0){
			return substr(date("d",strtotime(date('d-m-Y'))), 1, 1);
		} else {
			return date("d",strtotime(date('d-m-Y')));
		}
	}
	
	///=====================================================================================
	/// getTodayDate() : returns the current date
	/// Note: the format returned is 10th Jan 2020
	///=====================================================================================
	function getTodayDate(){
		/* Get the date prefix - var $n = st, nd, rd, th */
		switch($this->day_number){
			case 1:
			case 21:
			case 31:
				$n = "st";
			break;
			case 2:
			case 22:
				$n = "nd";
			break;
			case 3:
			case 23:
				$n = "rd";
			break;
			default:
				$n = "th";
			break;
		}
		/* Returns the current date in format: 1st Jan. 2018 */
		return $this->day_number.$n." ".substr(date("F", strtotime(date("Y/m/d"))), 0, 3).". ".date("Y", strtotime(date("Y/m/d")));
	}
	
	///=====================================================================================
	/// makeWordStrong() : takes a string ($string) and places <strong> tags around all 
	///					   instances of a word ($word) within
	/// @param $string   : a string that should contain $word
	/// @param $word     : the word the place <strong> tags around
	///=====================================================================================
	function makeWordStrong($string, $word){
		if (strpos($string, strtolower($word)) !== false) {
			$words = explode(strtolower($word), $string);
			$new_string = "";
			
			for($i = 0; $i < count($words); $i++){
				if($i == (count($words) -1)) { $new_string .= $words[$i]; } else { $new_string .= $words[$i]." <strong>".strtolower($word)."</strong>"; }
			}
			return $new_string;
		} else {
			return $string;
		}
	}
	
	///=====================================================================================
	/// determineFontSize() : 
	///=====================================================================================
	function determineFontSize($word){
		$word_length = strlen($word);
		switch($word_length){
			case 0:
			case 1:
			case 2:
			case 3:
			case 4:
			case 5:
			case 6:
			case 7:
			case 8:
			case 9:
				$font_size_css = "h1 { 	font-size: 76pt; } .finetic { font-size: 26pt; }";
			break;
			case 10:
			case 11:
			case 12:
			case 13:
			case 14:
			case 15:
			case 16:
				$font_size_css = "h1 { 	font-size: 76pt; } .finetic { font-size: 26pt; }";
			break;
			case 40:
			case 41:
			case 42:
			case 43:
			case 44:
			case 45:
			case 46:
			case 47:
			case 48:
			case 49:
			case 50:
				$font_size_css = "h1 { 	font-size: 26pt; } .finetic { font-size: 14pt; }";
			break;
			default:
				$font_size_css = "h1 { 	font-size: 36pt; }";
			break;
		}
		return $font_size_css;
	}
	
	///=====================================================================================
	/// replaceSpaces() : replace all instances of a space with an underscore
	/// Note: Neccessary for words with spaces, otherwise an error is returned from the API
	///=====================================================================================
	function replaceSpaces($word){
		return str_replace(' ', '_', $word);
	}
	
}
?>