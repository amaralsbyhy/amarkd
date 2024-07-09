<?php

#$Emails                = [];
$Emails                = $emails_db->fetch_data();

$Emails['emails'] = [];
$Emails['invites'] = [];
$Emails['wallets'] = [];
#include 'texts.php';

function make_email(){
	global $Emails;
	$range       = range(0,6);
	$qwerty     = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	$hashMail = array_merge($qwerty,[0,1,2,3,4,5,6,7,8,9]);
	$email        = $qwerty[array_rand($qwerty,1)];
	foreach($range as $y){
		$email    .= $hashMail[array_rand($hashMail,1)];
	}
	$Mail           = strtolower("{$email}@super.net");
	if(!array_key_exists($Mail,$Emails['emails'])){
		return $Mail;
	} else {
		return make_email();
	}
}

##echo make_email();


function make_password(){
	$range        = range(0,5);
	$rand_pw   = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','0','1','2','3','4','5','6','7','8','9'];
	$password = '';
	foreach($range as $y){
		$password      .= $rand_pw[array_rand($rand_pw,1)];
	}
	return $password;
}

function make_invite_hash(){
	global $Emails;
	$range       = range(0,10);
	$qwerty     = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	
	$hash_invite        = array_merge($qwerty,[0,1,2,3,4,5,6,7,8,9]);
	$invite_hash        = $qwerty[array_rand($qwerty,1)];
	foreach($range as $y){
		$invite_hash    .= $hash_invite[array_rand($hash_invite,1)];
	}

	if(!array_key_exists($invite_hash,$Emails['invites'])){
		return $invite_hash;
	} else {
		return make_invite_hash();
	}
}

function make_wallet_hash(){
	global $Emails;
	$range       = range(0,30);
	$qwerty     = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
	
	$hash_wallet        = array_merge($qwerty,[0,1,2,3,4,5,6,7,8,9]);
	$wallet_hash        = $qwerty[array_rand($qwerty,1)];
	foreach($range as $y){
		$wallet_hash    .= $hash_wallet[array_rand($hash_wallet,1)];
	}

	if(!array_key_exists($wallet_hash,$Emails['wallets'])){
		return $wallet_hash;
	} else {
		return make_wallet_hash();
	}
}

##echo make_wallet_hash();

function make_buttons($buttons_array,$method='horizone',$extra_df='',$extra_dl='',$exceptK='',$exceptV='',$first_line='',$last_line=''){
	if(is_array($buttons_array)){
		$preg_text          = "/^V\{(\d+)\}H\{(\d+)\}$/";
		$result                 = [];
		if(preg_match($preg_text,$method,$search)){
			$result      = $search;
		} else if($method == 'horizone' || $method == 'H'){
			$result           = [0,0,count($buttons_array)];
		} else if($method == 'vertical' || $method == 'V'){
			$result           = [0,count($buttons_array),0];
		}
		$height          = 0;
		$width           = 0;
		$extra            = 0;
		$tableN         = 0;
		$keyboard    = [];
		
		foreach($buttons_array as $data_k => $text){
			$data          = $extra_df.$data_k.$extra_dl;
			if($tableN == 0 && is_array($first_line)){
				$keyboard['inline_keyboard'][0][] = ['text'=>$first_line['text'],'callback_data'=>$first_line['data']];
				$tableN++;
				$keyboard['inline_keyboard'][$tableN][] = ['text'=>$text,'callback_data'=>$data];
				$width++;
				$extra++;
				continue;
			}
			if(is_array($exceptK) && is_array($exceptV)){
				if(in_array($data_k,$exceptK)){
					$data     = $data_k.$exceptV[$data_k];
				}
			}
			$vMode      = $result[1];
			$hMode      = $result[2];
			if($vMode > $height){
				if(preg_match("/^https\:\/\//",$data_k)){
					$keyboard['inline_keyboard'][$tableN][] = ['text'=>$text,'url'=>$data];
				} else {
					$keyboard['inline_keyboard'][$tableN][] = ['text'=>$text,'callback_data'=>$data];
				}
				$height++;
				$tableN++;
				continue;
			}
			if(preg_match("/^https\:\/\//",$data_k)){
				$keyboard['inline_keyboard'][$tableN][] = ['text'=>$text,'url'=>$data];
			} else {
				$keyboard['inline_keyboard'][$tableN][] = ['text'=>$text,'callback_data'=>$data];
			}
			$width++;
			$extra++;
			if($hMode > 3 and $extra >= 2){
				$tableN++;
				$extra      = 0;
			}
			if($width >= $hMode){
				if($extra != 0){
					$tableN++;
				}
				$height     = 0;
				$width       = 0;
			}
		}
		if(is_array($first_line)){
			if ($last_line['data'] == 'reace_show'){
				if (count($buttons_array) % 2 == 0){
					echo 'yes';
				} else {
					$tableN++;
				}
			}
			$keyboard['inline_keyboard'][$tableN][] = ['text'=>$last_line['text'],'callback_data'=>$last_line['data']];
		}
		return $keyboard;
	}
}


function get_countries_view($from=0,$to=30){
	global $countries_names;
	return array_slice($countries_names,$from,$to);
}

function getVakC(){
	$response = [];
	global $countries_names;
	include_once 'files_helper/vak-sms_servers.php';
	foreach ($operators as $key=>$v){
		$bk    = strtoupper($key);
		$response[$bk]     = $countries_names[$bk];
	}
	return $response;
}
 
function get_time_accent(){
	$dDate  = date('Y-n-j');
	$nTime  = date('h:i:s');
	$mDay   = date('H') >= 12 ? 'PM' : 'AM';
	return [$dDate,$nTime,$mDay];
}
##echo json_encode(make_buttons($home_buttons,'V{1}H{4}'));


# solveIt([2,2,1,4],[]);
function solveIt($lines,$all){
	$ruj    = 0;
	$keyboard    = [];
	$data = '';
	$text = '';
	foreach($lines as $cx=>$x){
		for($z=0;$x>$z;$z++){
			foreach($all as $d=>$t){
				$data = $d;
				$text = $t;
				unset($all[$d]);
				break;
			}
			if($data != true){
				break;
			}
			$keyboard['inline_keybord'][$ruj][]   = ['text'=>$text,'callback_data'=>"{$data}"];
			$data = false;
			$text  = false;
		}
		$ruj++;
	}
	return $keyboard;
}
	

?>