<?php

class RegularEx{
	
	public const CIPHERING             = 'AES-128-CTR';
	public const ENCRIPTION_VI     = '1234567891011175';
	##public const ENCRIPTION_VI     = '1234567890987654';
	
	
	public $tokenBot           = "/^[0-9]{5,15}:[a-zA-Z0-9\_\+\-]{20,}$/";
	public $ID                        = "/^[0-9]{7,12}$/";
	public $phoneNumber  = "/^\+[0-9]{6,18}$/";
	public $encripted64       = "/^[a-zA-Z0-9]{5,}\={1,3}$/";
	public $encriptedAES    = "/^[a-zA-Z0-9\/\+\-\_\\]{2,}\={0,3}$/";
	public $email                   = "/^([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+$/";
	
	public $cTokenBot           = "/([0-9]{5,15}:[a-zA-Z0-9\_\+\-]{20,})/";
	public $cID                         = "/([0-9]{7,12})/";
	public $cPhoneNumber  = "/(\+[0-9]{6,18})/";
	public $cEncripted64       = "/([a-zA-Z0-9]{5,}\={1,3})/";
	public $cEncriptedAES    = "/([a-zA-Z0-9\/\+\-\_\\]{2,}\={1,3})/";
	public $cEmail                   = "/(([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+)/";
	
	public function is_email($email,$opreat='CHECK'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->email,$email)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cEmail,$email,$result)){
				$response      = ['true',$result[1]];
			}
			break;
		}
		return $response;
	}
	
	public function is_token($tokenBot,$opreat='CHECK'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->tokenBot,$tokenBot)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cTokenBot,$tokenBot,$result)){
				$response      = ['true',$result[1]];
			}
			break;
		}
		return $response;
	}
	
	public function is_id($ID,$opreat='CHECK'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->ID,$ID)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cID,$ID,$result)){
				$response      = ['true',$result[1]];
			}
			break;
		}
		return $response;
	}
	
	public function is_phone_number($phoneNumber,$opreat='CHECK'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->phoneNumber,$phoneNumber)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cPhoneNumber,$phoneNumber,$result)){
				$response      = ['true',$result[1]];
			}
			break;
		}
		return $response;
	}
	
	public function is_base64($encripted64,$opreat='CHECK'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->encripted64,$encripted64)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cEncripted64,$encripted64,$result)){
				$response      = ['true',$result[1]];
			}
			break;
			case 'BUILD':
			$response      = ['false'];
			if(($this64  = base64_encode($encripted64))){
				$response      = ['true',$this64];
			}
			break;
			case 'CRUSH':
			$response      = ['false'];
			if(($thisTEXT  = base64_decode($encripted64))){
				$response      = ['true',$thisTEXT];
			}
			break;
		}
		return $response;
	}
	
	public function is_AES($encriptedAES,$opreat='CHECK',$hash_key='THIS_CODED_BY-JELLO://_ENG-JELLO_ALKHALEDI'){
		$response      = false;
		switch ($opreat){
			case 'CHECK':
			if(preg_match($this->encriptedAES,$encriptedAES)){
				$response      = true;
			}
			break;
			case 'GET':
			$response      = ['false'];
			if(preg_match($this->cEncriptedAES,$encriptedAES,$result)){
				$response      = ['true',$result[1]];
			}
			break;
			case 'BUILD':
			$response      = ['false'];
			if(($encrypted = openssl_encrypt($encriptedAES,self::CIPHERING,$hash_key,0,self::ENCRIPTION_VI))){
				$response      = ['true',$encrypted];
			}
			break;
			case 'CRUSH':
			$response      = ['false'];
			if(($decrypted = openssl_decrypt($encriptedAES,self::CIPHERING,$hash_key,0,self::ENCRIPTION_VI))){
				$response      = ['true',$decrypted];
			}
			break;
		}
		return $response;
	}
	
	
}

$RE         = new RegularEx();
##print_r($RE->is_AES('TU8A43TS','BUILD'));
#$print_r($rt->is_email('t Ajmal@gmail.com ytf','GET'));
	


?>