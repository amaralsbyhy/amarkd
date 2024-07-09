<?php

if($data == 'login'){
	include_once 'functions.php';
	if($Home['accounts'][$chat_id]['email'] != null){
		$ourMail      = $Home['accounts'][$chat_id]['email'];
		$zaer            = ["login#{$ourMail}"=>$ourMail,"Home"=>$back_home['back_']];
		$keyboard   = make_buttons($zaer,'V');
		$bot->editMessageText([
		'chat_id'=>$chat_id,
		'text'=>$signup_texts['Have_Mail'], #lohTex
		'parse_mode'=>'MarkDown',
		'message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard),
		]);
		exit;
	}
	else {
		$zaer            = ["Home"=>$back_home['back_']];
		$keyboard   = make_buttons($zaer,'V');
		$bot->editMessageText([
		'chat_id'=>$chat_id,
		'text'=>$signup_texts['send_mail'], #lohTex
		'parse_mode'=>'MarkDown',
		'message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard),
		]);
		$Status[$chat_id]['status']       = 'login';
		$timed_db->setData($Status);
		exit;
	}
}

if(preg_match("/login\#(.+)/",$data,$conf)){
	include_once 'functions.php';
	$inputed       = $conf[1];
	#$connect      = new user_config($chat_id);
	if($Home['accounts'][$chat_id]['email'] == $inputed){
		include_once 'functions.php';
		include_once 'files_helper/users_info.php';
		$xx     = $inputed;
		$cx     = new user_config($xx);
		$bx     = $cx->getBalance();
		$sx      = $cx->getSoldBalance();
		$rrx     = str_replace(['++EMAIL++','++BALANCE++','++SALE++','++ID++','++CHANNEL++'],[$xx,$bx,$sx,$chat_id,''],$posts_text['menu_start']);
		$bot->editMessageText([
		'chat_id'=>$chat_id,
		'text'=>$rrx,
		'parse_mode'=>'MarkDown',
		'message_id'=>$message_id,
		'reply_markup'=>json_encode(make_buttons($home_buttons,'V{1}H{4}'))
		]);
		exit;
	}
	else {
		## البيانات قديمة
		exit;
	}
}


if($Status[$chat_id]['status'] == 'login'){
	if(preg_match("/^([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+$/",$text,$conf)){
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$signup_texts['send_password'],
		'reply_to_message_id'=>$message_id,
		'parse_mode'=>'MarkDown',
		]);
		$Status[$chat_id]['email']    = $conf[0];
		$Status[$chat_id]['status']   = 'verfiry';
		$timed_db->setData($Status);
		exit;
	}
	else {
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$signup_texts['error_mail'],
		'reply_to_message_id'=>$message_id,
		'parse_mode'=>'MarkDown',
		]);
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
		exit;
	}
}

if(preg_match("/^([a-zA-Z0-9]{6})$/",$text,$conf)){
	if($Status[$chat_id]['status'] == 'verfiry'){
		#preg_match("/([^@]+)@(.+)/",$mail,$coom);
		$mail     = $Status[$chat_id]['email'];
		include_once 'files_helper/users_info.php';
		$connect     = new user_config($mail);
		$password  = $connect->getPassword();
		if($password != false && $password == md5($conf[1])){
			
			$old_owner    = $connect->getOwner();
			
			### ارسل رسالة للقديم بانتهاء الجلسة
			///// here/////
			$connect->setOwner($chat_id);
			
			
			$Home['accounts'][$chat_id]['email']    = $mail;
			if($old_owner != false){
				$Home['accounts'][$old_owner]['email']    = null;
			}
			$home_db->setData($Home);
			### تحويل للقائمة الرئيسية
			
			include_once 'functions.php';
			#include_once 'files_helper/users_info.php';
			$xx     = $mail;
			$cx     = new user_config($xx);
			$bx     = $cx->getBalance();
			$sx      = $cx->getSoldBalance();
			$rrx     = str_replace(['++EMAIL++','++BALANCE++','++SALE++','++ID++','++CHANNEL++'],[$xx,$bx,$sx,$chat_id,''],$posts_text['menu_start']);
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$rrx,
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode(make_buttons($home_buttons,'V{1}H{4}'))
			]);
			unset($Status[$chat_id]);
			$timed_db->setData($Status);
			exit;
		}
		else {
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$signup_texts['login_error'],
			'reply_to_message_id'=>$message_id,
			'parse_mode'=>'MarkDown',
			]);
			unset($Status[$chat_id]);
			$timed_db->setData($Status);
			exit;
		}
	}
}
			

?>