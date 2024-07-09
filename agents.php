<?php

if($text == '/view'){
	include_once 'functions.php';
	$keyboard       = make_buttons($agents_texts['buttons']);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$agents_texts['menu'],
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if($data == 'menuAgent'){
	include_once 'functions.php';
	$keyboard       = make_buttons($agents_texts['buttons']);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$agents_texts['menu'],
	'parse_mode'=>"MarkDown",
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if(array_key_exists($data,$agents_texts['buttons'])){
	include_once 'functions.php';
	$keyboard       = make_buttons($agents_texts['home_agent']);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$agents_texts['responses'][$data],
	'parse_mode'=>"MarkDown",
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($text && array_key_exists($Status[$chat_id]['status'],$agents_texts['buttons'])){
	include_once 'functions.php';
	$keyboard       = make_buttons($agents_texts['home_agent']);
	$home_db         = new database('home.json');
	$Home               = $home_db->fetch_data();
	$myMail             = $Home['accounts'][$chat_id]['email'];
	if($Status[$chat_id]['status'] == 'dis_balance'){
		if($Home['wakeel'][$myMail]['users'][$text] != null){
			$set_data             = $agents_texts['sessions'][$Status[$chat_id]['status']];
			$response            = $agents_texts['responses'][$set_data];
			$Status[$chat_id]    = [
				'user_mail'=>$text,
				'status'=>$set_data,
			];
			$timed_db->setData($Status);
		} else {
			$s_data        = $Status[$chat_id]['status'];
			$response    = $agents_texts['errors'][$s_data];
			unset($Status[$chat_id]);
			$timed_db->setData($Status);
		}
	} else {
		$set_data             = $agents_texts['sessions'][$Status[$chat_id]['status']];
		$response            = $agents_texts['responses'][$set_data];
		$Status[$chat_id]    = [
			'user_mail'=>$text,
			'status'=>$set_data,
		];
		$timed_db->setData($Status);
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if($text && array_key_exists($Status[$chat_id]['status'],$agents_texts['responses'])){
	include_once 'functions.php';
	$keyboard       = make_buttons($agents_texts['home_agent']);
	$home_db         = new database('home.json');
	$Home               = $home_db->fetch_data();
	$myMail             = $Home['accounts'][$chat_id]['email'];
	$ownered           = false;
	if(!preg_match("/^[0-9\.]+$/",$text)){
		## please send Number
		exit;
	}
	$u_mail           = $Status[$chat_id]['user_mail'];
	include_once 'files_helper/users_info.php';
	$connect_a         = new user_config($myMail);
	if($Status[$chat_id]['status'] == 'set_add'){
		if($connect_a->getBalance() >= $text){
			$connect_a->delBalance($text);
			$connect_u        = new user_config($u_mail);
			$connect_u->addBalance($text);
			$ownered          = $connect_u->getOwner();
			$Home['wakeel'][$myMail]['users'][$u_mail]['added']     = $Home['wakeel'][$myMail]['users'][$u_mail]['added'] != null ? $Home['wakeel'][$myMail]['users'][$u_mail]['added'] + $text : $text;
			unset($Status[$chat_id]);
			$timed_db->setData($Status);
			$home_db->setData($Home);
			$response            = str_replace(['++PC++','++UR++'],[$text,$u_mail],$agents_texts['success']['Add_balance']);
			$respad                 = str_replace(['++PC++','++UR++'],[$text,$myMail],$agents_texts['success']['add_to_user']);
		} else {
			$response             = $agents_texts['errors']['Add_balance'];
		}
	} else {
		$connect_u        = new user_config($u_mail);
		$connect_u->delBalance($text);
		$ownered          = $connect_u->getOwner();
		$Home['wakeel'][$myMail]['users'][$u_mail]['dissed']     = $Home['wakeel'][$myMail]['users'][$u_mail]['dissed'] != null ? $Home['wakeel'][$myMail]['users'][$u_mail]['dissed'] + $text : $text;
		unset($Status[$chat_id]);
		$timed_db->setData($Status);
		$home_db->setData($Home);
		$response            = str_replace(['++PC++','++UR++'],[$text,$u_mail],$agents_texts['success']['dis_balance']);
		$respad                 = str_replace(['++PC++','++UR++'],[$text,$myMail],$agents_texts['success']['dis_to_user']);
	}
	include_once 'files_helper/system.php';
	$Bconnect        = new OS_jello('GENERAL');
	$Bconnect->onReady('CHARGE',1);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	if($ownered == true){
		$bot->sendMessage([
		'chat_id'=>$ownered,
		'parse_mode'=>"MarkDown",
		'text'=>$respad,
		]);
	}
	exit;
}
?>