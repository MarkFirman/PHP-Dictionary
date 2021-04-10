<?php
/***********************************************************************
 * # @Author Mark Firman
 * # @Project WordOfTheDay
 * # @Date 15/11/2018
 * # @Email info@markfirman.co.uk
 * # @Last Modified 15/11/2018
 *
 */
 
class twitter_bot {
	
	private $api_key;
	private $api_secret;
	private $access_token;
	private $access_token_secret;
	private $connection;
	
	/* Called on initialisation - connects to the API and stores the connection properties */
	function __construct($key, $secret, $token, $token_secret){
		$this->api_key = $key;
		$this->api_secret = $secret;
		$this->access_token = $token;
		$this->access_token_secret = $token_secret;
		$this->connection = $this->oauth();
		return $connection;
	}

	/* Authenticates the connection to the API */
	function oauth(){
		require_once("oauth.class.php");
        $con = new TwitterOAuth($this->api_key, $this->api_secret, $this->access_token, $this->access_token_secret);
        return $con;
	}
	
	/* Sends/posts a status update/tweet to the account */
	function tweet($text){
		$this->connection->post('statuses/update', array ('status' => $text));
		return $status;
	}
}
?>