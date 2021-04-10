<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2020
 *
 */
class Template {
	
	/* Variables */
	// Holds the path to the template files - this is set at runtime
	private $path="./system/template/";
	public $properties; // Holds the template properties - set at runtime
	
	///=====================================================================================
	/// CONSTRUCTOR
	///=====================================================================================
	public function __construct(){
		$this->properties = array();
	}
	
	///=====================================================================================
	/// Renders template files
	///=====================================================================================
	public function render($filename){
		ob_start();
		if(file_exists($this->path.$filename)){
			include_once $this->path.'header.tpl';
			include_once $this->path.$filename;
		} else throw new TemplateNotFoundException();
		return ob_get_clean();
	}

	///=====================================================================================
	/// __SET : sets template variables
	///=====================================================================================
	public function __set($k, $v){
		$this->properties[$k] = $v;
	}

	///=====================================================================================
	/// __GET template variables
	///=====================================================================================
	public function __get($k){
		return $this->properties[$k];
	}
}
?>