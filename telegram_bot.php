<?php

class bot{
	public $APIKEY;
	public const URL         = 'https://api.telegram.org/'.__class__;
	
	function sendMessage($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function forwardMessage($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function deleteMessage($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function copyMessage($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function editMessageText($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function editMessageMedia($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	public function getChatMember($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function sendContact($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function getMe($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	function answerCallBackQuery($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	
	
	function sendThisCurl($opreat,$data=[]){
		$curlStart   = curl_init();
		curl_setopt($curlStart,CURLOPT_URL,self::URL."/".$opreat);
		curl_setopt($curlStart,CURLOPT_RETURNTRANSFER,true);
		curl_setopt($curlStart,CURLOPT_POSTFIELDS,$data);
		$result    = curl_exec($curlStart);
		if(!curl_error($result)){
			return json_decode($result);
		}
	}
	
	function sendChatAction($data=[]){
		return json_decode(file_get_contents(self::URL.$this->APIKEY.'/'.__FUNCTION__.'?'.http_build_query($data)));
	}
	
	public function __construct($API_KEY){
		$this->APIKEY    = $API_KEY;
	}
	
}

$bot                     = new bot($bot_API_KEY);


/*
if(($UP  = file_get_contents('php://input'))){
	if(($api_key  = $_GET['hash_token'])){
		if($RE->is_token($api_key)){
			$bot_API_KEY   = $api_key;
			$update              = json_decode($UP);
			$bot                     = new bot($bot_API_KEY);
		} else {
			$update           = null;
			header('location:google.com');
			exit;
		}
	} else {
		$update           = null;
		header('location:403');
		exit;
	}
} else {
	$update           = null;
}

*/




?>