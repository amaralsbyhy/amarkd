<?php

##include 'functions.php';
if($data){
	if($Home['accounts'][$chat_id]['registed'] != null){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$signup_texts['Have_Account'],
		'show_alert'=>true,
		]);
		$signed_email        = $Home['accounts'][$chat_id]['email'];
		exit;
	} else {
		$bot->deleteMessage([
		'chat_id'=>$chat_id,
		#'text'=>$signup_texts['captcha_text'],
		#'parse_mode'=>'MarkDown',
		'message_id'=>$message_id
		]);
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'parse_mode'=>'MarkDown',
		'text'=>$signup_texts['message_cp'],
		'reply_markup'=>json_encode(['resize_keyboard'=>false,'keyboard'=>[[['text'=>$signup_texts['Human'],'request_contact'=>true]],]])
		]);
		$Status[$chat_id]['status']       = 'captcha';
		$timed_db->setData($Status);
		exit;
	}
}
#echo '8999999';
if($contact){
	include_once 'functions.php';
	if($contact->user_id == $chat_id){
		$my_email            = make_email();
		$my_password    = make_password();
		$my_invite_hash  = make_invite_hash();
		$my_wallet_hash = make_wallet_hash();
		$emails_db       = new database('emails.json');
		$Emails              = $emails_db->fetch_data();
		$Emails['emails'][$my_email]     = [
			'password'=>md5($my_password),
			'owner'=>$chat_id,
			'hash_invite'=>$my_invite_hash,
			'wallet'=>$my_wallet_hash,
			'balance'=>0,
			'sold_balance'=>0,
			'invites'=>[],
			'numbers'=>[
				'bought'=>[],
				'ready'=>[],
				'shows'=>[]
			],
			'cards'=>[],
			'try'=>0
		];
		
		$Emails['invites'][$my_invite_hash]['email']    = $my_email;
		$Emails['wallets'][$my_wallet_hash]['email']  = $my_email;
		
		$emails_db->setData($Emails);
		$Home['accounts'][$chat_id]['email']   = $my_email;
		$Home['accounts'][$chat_id]['registed']   = $my_email;
		$home_db->setData($Home);
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
		
		$tuser         = $from->username == true ? '@'.$from->username : $notfounfs;
		$notice_t    = ['++M++','++PW++','++ID++','++NAME++','++N++','++U++'];
		$notice_v    = [$my_email,$my_password,$chat_id,$first_name,'+'.$contact->phone_number,$tuser];
		$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['signup']);
		$bot->sendMessage([
		'chat_id'=>$cardsID,
		'text'=>$notice_f,
		]);
	
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>'✅',
		'reply_to_message_id'=>$message_id,
		'reply_markup'=>json_encode(['remove_keyboard'=>true])
		]);
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>str_replace(['++MAIL++','++PASSWORD++'],[$my_email,$my_password],$signup_texts['done_signup']),
		'parse_mode'=>'MarkDown',
		'reply_markup'=>json_encode([ 
		'remove_keyboard'=>true,
		'inline_keyboard'=>[
		[['text'=>$start_buttons['login'],'callback_data'=>"login#{$my_email}"]],
		[['text'=>$extra_buttons['back_'],'callback_data'=>"home"]],
		]
		])
		]);
		$members      = json_decode(file_get_contents('database/members.json'),1);
		if($members[$chat_id] != null){
			
			
			include_once 'files_helper/system.php';
			$inviter         = $members[$chat_id];
			$connect      = new OS_jello();
			$invite_b       = $connect->getInviteBalance();
			if($invite_b > 0){
				
				if(array_key_exists($inviter,$Emails['emails'])){
					
					include_once 'files_helper/users_info.php';
					$connecting       = new user_config($inviter);
					
					$connecting->addBalance($invite_b);
					$connecting->addInvite($my_email);
					$owner                 = $connecting->getOwner();
					
					$respo        = str_replace(['++INV++','++NM++'],[$invite_b,"[{$first_name}](tg://user?id={$from_id})"],$reved);
					$members[$from_id]     = null;
					file_put_contents('database/members.json',json_encode($members));
					$bot->sendMessage([
					'chat_id'=>$owner,
					'text'=>$respo,
					]);
				}
			}
		}
		exit;
	} else {
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$signup_texts['captcha_error'],
		'parse_mode'=>'MarkDown',
		'reply_to_message_id'=>$message_id
		]);
		exit;
	}
}

?>