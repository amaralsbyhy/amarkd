<?php
/*
$next     = ['s_a_s'=>'s_a_a','s_a_a'=>'s_a_m',
	's_a_m'=>'s_a_c','s2_a_m'=>'s_a_c',
	's_a_c'=>'s_a_r'];

echo array_search('s_a_c',$next);
exit;
*/
/*
include 'texts.php';
include 'functions.php';
include 'variables.php';
*/

##$data = 'back_5sim.biz_tt_all_HN';
#$data = 'next_vak-sms.com_tt_all';

##print_r(make_buttons($ow_panel['home_buttons'],'V{1}H{2}'));
##exit;

include_once 'functions.php';
#include_once 'texts.php';
#$data = 'delCountry';
/*
if($text == '/start'){
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts']['start'],
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	#'reply_markup'=>json_encode(make_buttons($ow_panel['home_buttons'],'H'))
	]);
}
*/

$ZAbutton            = [];
$ZAbutton['inline_keyboard'][0][] = ['text'=>$ow_panel['home_buttons']['delCountry'],'callback_data'=>'delCountry'];
$ZAbutton['inline_keyboard'][0][] = ['text'=>$ow_panel['home_buttons']['addCountry'],'callback_data'=>'addCountry'];
$ZAbutton['inline_keyboard'][1][] = ['text'=>$ow_panel['home_buttons']['delRand'],'callback_data'=>'delRand'];
$ZAbutton['inline_keyboard'][1][] = ['text'=>$ow_panel['home_buttons']['addRand'],'callback_data'=>'addRand'];
$ZAbutton['inline_keyboard'][2][] = ['text'=>$ow_panel['home_buttons']['delBalance'],'callback_data'=>'delBalance'];
$ZAbutton['inline_keyboard'][2][] = ['text'=>$ow_panel['home_buttons']['addBalance'],'callback_data'=>'addBalance'];
$ZAbutton['inline_keyboard'][3][] = ['text'=>$ow_panel['home_buttons']['delInvite'],'callback_data'=>'delInvite'];
$ZAbutton['inline_keyboard'][3][] = ['text'=>$ow_panel['home_buttons']['setInvite'],'callback_data'=>'setInvite'];
$ZAbutton['inline_keyboard'][4][] = ['text'=>$ow_panel['home_buttons']['status'],'callback_data'=>'status'];
$ZAbutton['inline_keyboard'][5][] = ['text'=>$ow_panel['home_buttons']['delJoin'],'callback_data'=>'delJoin'];
$ZAbutton['inline_keyboard'][5][] = ['text'=>$ow_panel['home_buttons']['setJoin'],'callback_data'=>'setJoin'];
$ZAbutton['inline_keyboard'][6][] = ['text'=>$ow_panel['home_buttons']['delABan'],'callback_data'=>'delABan'];
$ZAbutton['inline_keyboard'][6][] = ['text'=>$ow_panel['home_buttons']['unbanU'],'callback_data'=>'unbanU'];
$ZAbutton['inline_keyboard'][7][] = ['text'=>$ow_panel['home_buttons']['setKeys'],'callback_data'=>'setKeys'];
$ZAbutton['inline_keyboard'][8][] = ['text'=>$ow_panel['home_buttons']['delCard'],'callback_data'=>'delCard'];
$ZAbutton['inline_keyboard'][8][] = ['text'=>$ow_panel['home_buttons']['addCard'],'callback_data'=>'addCard'];
$ZAbutton['inline_keyboard'][9][] = ['text'=>$ow_panel['home_buttons']['viewUM'],'callback_data'=>'viewUM'];
$ZAbutton['inline_keyboard'][10][] = ['text'=>$ow_panel['home_buttons']['cMembers'],'callback_data'=>'cMembers'];
$ZAbutton['inline_keyboard'][10][] = ['text'=>$ow_panel['home_buttons']['postAll'],'callback_data'=>'postAll'];
$ZAbutton['inline_keyboard'][11][] = ['text'=>$ow_panel['home_buttons']['delInvestor'],'callback_data'=>'delInvestor'];
$ZAbutton['inline_keyboard'][11][] = ['text'=>$ow_panel['home_buttons']['addInvestor'],'callback_data'=>'addInvestor'];

if($text == '/start'){
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++DN++',$first_name,$ow_panel['texts']['startAM']),
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($ZAbutton)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if($data == 'back_'){
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++DN++',$first_name,$ow_panel['texts']['startAM']),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($ZAbutton)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}



if($data == 'status'){
	include_once 'functions.php';
	include_once 'files_helper/system.php';
	$emails_db       = new database('emails.json');
	$Emails              = $emails_db->fetch_data();
	$Bconnect        = new OS_jello('GENERAL');
	$allG        = count($Emails['emails']);
	$RR          = $Bconnect->onReady('READY');
	$CC          = $Bconnect->onReady('CARDS');
	$SS          = $Bconnect->onReady('SALE');
	$EE          = $Bconnect->onReady('BALANCE') - $SS;
	$NN         = $Bconnect->onReady('FULL');
	$FF           = $Bconnect->onReady('FOLLOW');
	$MM         = $Bconnect->onReady('CHARGE');
	
	$res2    = [$allG,$RR,$CC,$SS,$EE,$NN,$FF,$MM];
	$res       = ['++U++','++R++','++C++','++S++','++B++','++N++','++F++','++M++'];
	$resua   = str_replace($res,$res2,$text_home_v[$data]);
	
	$keyboard     = make_buttons(['home'=>$back_home['back_']]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$resua,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if(array_key_exists($data,$ow_panel['control_buttons'])){
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts'][$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($text && ($Status[$chat_id]['status'] == 'addBalance' || $Status[$chat_id]['status'] == 'delBalance')){
	$keyboard     = make_buttons($back_home);
	if($Status[$chat_id]['mail'] != null){
		if(preg_match("/^\d+$/",$text)){
			$mail    = $Status[$chat_id]['mail'];
			include_once 'files_helper/users_info.php';
			$connect     = new user_config($mail);
			include_once 'files_helper/system.php';
			if($Status[$chat_id]['status'] == 'addBalance'){
				$connect->addBalance($text);
				$Bconnect        = new OS_jello('GENERAL');
				$Bconnect->onReady('CHARGE',1);
				$Bconnect->onReady('BALANCE',$text);
			} else {
				$connect->delBalance($text);
			}
			
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$ow_panel['responses']['done'.$Status[$chat_id]['status']],
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			unset($Status[$chat_id]);
			$timed_db->setData($Status);
		} else {
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$ow_panel['errors']['no_nu'],
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
		}
		exit;
	}
	if(preg_match("/^([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+$/",$text)){
		include_once 'files_helper/users_info.php';
		$connect     = new user_config($text);
		if($connect != true){
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$ow_panel['errors']['mail_not'],
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			unset($Status[$chat_id]['status']);
			$timed_db->setData($Status);
			exit;
		}
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$ow_panel['responses'][$Status[$chat_id]['status']],
		'parse_mode'=>'MarkDown',
		'reply_to_message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard)
		]);
		#$Status[$chat_id]['status']    = $data;
		$Status[$chat_id]['mail']        = $text;
		$timed_db->setData($Status);
		exit;
	} else {
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$ow_panel['errors']['no_mail'],
		'parse_mode'=>'MarkDown',
		'reply_to_message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard)
		]);
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
		exit;
	}
}

if($text && ($Status[$chat_id]['status'] == 'addCard' || $Status[$chat_id]['status'] == 'delCard')){
	$keyboard     = make_buttons($back_home);
	if($Status[$chat_id]['status'] == 'addCard'){
		if(!preg_match("/^[0-9\.]+$/",$text)){
			$resp              = $ow_panel['errors']['nu_not'];
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$resp,
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			exit;
		}
	} else {
		if(!preg_match("/^[A-Z][A-Z0-9]+$/",$text)){
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$ow_panel['errors']['card_not'],
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			exit;
		}
	}
	include_once 'files_helper/system.php';
	$connect      = new OS_jello('CARDS');
	if($Status[$chat_id]['status'] == 'addCard'){
		$card             = $connect->addCard($text);
		$Bconnect        = new OS_jello('GENERAL');
		$Bconnect->onReady('BALANCE',$text);
		$resp              = str_replace(['++PRICE++','++CARD++'],[$text,$card],$ow_panel['responses']['doneaddCard']);
	} else {
		$card             = $connect->delCard($text);
		if($card != false){
			$resp              = str_replace(['++PRICE++','++CARD++'],[$card['price'],$text],$ow_panel['responses']['donedelCard']);
		} else {
			$resp              = $ow_panel['errors']['no_card'];
		}
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$resp,
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

if($data == 'setKeys'){
	include_once "files_helper/system.php";
	$connect        = new OS_jello('API_KEYs');
	$sitesArray     = [];
	$getKey            = '';
	$site_balance  = '';
	$cConnect        = '';
	foreach($names_sites as $dt=>$tx){
		$getKey      = $connect->getApiKey($dt);
		if($getKey == 'None' || $getKey != true){
			$site_balance     = 'None';
		} else {
			include_once "files_helper/control_site.php";
			$cConnect         = get_aclass($dt);
			$site_balance    = $cConnect->getBalance()[1];
			#$bot->sendMessage([
			#'chat_id'=>$chat_id,
			#'text'=>$site_balance,
			#]);
		}
		$sitesArray['inline_keyboard'][] = [['text'=>"{$tx} « {$site_balance} »",'callback_data'=>"setApiFor_{$dt}"]];
	}
	$sitesArray['inline_keyboard'][]      = [['text'=>$back_home['back_'],'callback_data'=>'back_']];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts'][$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($sitesArray)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if(preg_match("/^setApiFor\_(.+)$/",$data,$infP)){
	$theSite     = $infP[1];
	$sitesArray = [];
	$sitesArray['inline_keyboard'][]      = [['text'=>$back_home['back_'],'callback_data'=>'setKeys']];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts']['setApiFor'].$theSite,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($sitesArray)
	]);
	$Status[$chat_id]   = [
		'status'=>'setApiKey',
		'site'=>$theSite,
	];
	$timed_db->setData($Status);
	exit;
}

if($text && $Status[$chat_id]['status'] == 'setApiKey'){
	$site     = $Status[$chat_id]['site'];
	include_once "files_helper/system.php";
	$connect        = new OS_jello('API_KEYs');
	$connect->setApiKey($site,$text);
	$keyboard     = make_buttons($back_home);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['responses']['doneAddKey'].$text,
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if($data == 'setJoin'){
	include_once "files_helper/system.php";
	$connect         = new OS_jello();
	$chNow           = $connect->getJoin();
	if($chNow == true && $chNow != '@YemenDevs'){
		$response          = $ow_panel['texts'][$data]."\n".str_replace('++JOIN++',$chNow,$ow_panel['responses'][$data]);
	} else {
		$response          = $ow_panel['texts'][$data];
	}
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$response,
	#'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($Status[$chat_id]['status'] == 'setJoin'){
	if(preg_match("/^@[a-zA-Z0-9\_]+$/",$text)){
		$response        = str_replace('++JOIN++',$text,$ow_panel['responses']['doneAdded']);
		include_once "files_helper/system.php";
		$connect         = new OS_jello();
		$connect->setJoin($text);
	} else {
		$response       = $ow_panel['errors']['setJoin'];
	}
	$keyboard     = make_buttons($back_home);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$response,
	#'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

if($data == 'setInvite'){
	include_once "files_helper/system.php";
	$connect            = new OS_jello();
	$bNow                = $connect->getInviteBalance();
	$response          = str_replace('++INV++',$bNow,$ow_panel['texts'][$data]);
	$keyboard           = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($Status[$chat_id]['status'] == 'setInvite' && $text){
	if(preg_match("/^[0-9\.]+$/",$text)){
		include_once "files_helper/system.php";
		$connect         = new OS_jello();
		$lastInv            = $connect->getInviteBalance();
		if($lastInv > $text){
			$response         = str_replace('++INV++',$text,$ow_panel['responses']['doneDown']);
			$connect->setInviteBalance($text);
		} else if($text > $lastInv){
			$response         = str_replace('++INV++',$text,$ow_panel['responses']['doneUp']);
			$connect->setInviteBalance($text);
		} else {
			$response         = $ow_panel['responses']['doneCase'];
		}
	} else {
		$response         = $ow_panel['errors']['nu_not'];
	}
	$keyboard     = make_buttons($back_home);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

if($data == 'delInvite'){
	include_once "files_helper/system.php";
	$connect         = new OS_jello();
	$bNow             = $connect->getInviteBalance();
	if($bNow > 0){
		$response          = $ow_panel['texts'][$data];
		$connect->setInviteBalance('0');
	} else {
		$response          = $ow_panel['errors'][$data];
	}
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}
$members      = json_decode(file_get_contents('database/members.json'),1);

if($data == 'cMembers'){
	$keyboard = [];
	$keyboard['inline_keyboard'][0][]  = ['text'=>$extra_buttons['back_'],'callback_data'=>"back_"];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++ CM++',count($members),$posts_texts['cAll']),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = 'sendPost';
	$timed_db->setData($Status);
	exit;
}

if($data == 'postAll'){
	$keyboard = [];
	$keyboard['inline_keyboard'][0][]  = ['text'=>$extra_buttons['back_'],'callback_data'=>"back_"];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++CM++',count($members),$posts_texts['sendPost']),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = 'sendPost';
	$timed_db->setData($Status);
	exit;
}

if($data == 'delJoin'){
	include_once "files_helper/system.php";
	$connect         = new OS_jello();
	$chNow           = $connect->getJoin();
	if($chNow == true && $chNow != '@YemenDevs'){
		$response          = $ow_panel['texts'][$data];
		$connect->setJoin('@YemenDevs');
	} else {
		$response          = $ow_panel['errors'][$data];
	}
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if(in_array($data,['addInvestor','delInvestor'])){
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts'][$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($text){
	if(in_array($Status[$chat_id]['status'],['addInvestor','delInvestor'])){
		$emails_db       = new database('emails.json');
		$Emails              = $emails_db->fetch_data();
		$home_db         = new database('home.json');
		$Home               = $home_db->fetch_data();
		if(preg_match("/^([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+$/",$text)){
			if($Status[$chat_id]['status'] == 'addInvestor'){
				if($Home['wakeel'][$text] == null){
					if(is_array($Emails['emails'][$text])){
						$Home['wakeel'][$text]  = [
							'time'=>time(),
							'name'=>'ABC'
						];
						$home_db->setData($Home);
						$respo = $ow_panel['responses']['addInvestor'];
					} else {
						$respo = $ow_panel['errors']['mail_not'];
					}
				} else {
					$respo = $ow_panel['errors']['addInvestor'];
				}
			} else {
				if($Home['wakeel'][$text] != null){
					unset($Home['wakeel'][$text]);
					$home_db->setData($Home);
					$respo = $ow_panel['responses']['delInvestor'];
				} else {
					$respo = $ow_panel['errors']['delInvestor'];
				}
			}
		} else {
			$respo = $ow_panel['errors']['no_mail'];
		}
		$keyboard     = make_buttons($back_home);
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$respo,
		'parse_mode'=>'MarkDown',
		'reply_to_message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard)
		]);
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
		exit;
	}
}

/*
'delABan'=>'حذف حساب ⛔️',
		'unbanU'=>'إلغاء حظر مستخدم ☄️',
		'viewUM'=>'كشف مستخدم او حساب 👀=',
*/

if(in_array($data,['delABan','unbanU','viewUM'])){
	$keyboard     = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts'][$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}


if($text && in_array($Status[$chat_id]['status'],['delABan','unbanU','viewUM'])){
	$yesS                 = $Status[$chat_id]['status'];
	$emails_db       = new database('emails.json');
	$Emails              = $emails_db->fetch_data();
	$home_db         = new database('home.json');
	$Home               = $home_db->fetch_data();
	if(preg_match("/^[0-9]{7,13}$/",$text)){
		if(($owen  = $Home['accounts'][$text]['email']) != null){
			if($Emails['emails'][$owen] != null){
				$wMail     = $owen;
				$owner    = $text ?? 'logouted';
				$erN       = 0;
			} else {
				$erN    = 1;
			}
		} else {
			$erN     = 2;
		}
	}
	else if(preg_match("/^([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)*@([a-zA-Z0-9_])+(\.[a-zA-Z0-9_]+)+$/",$text)){
		if($Emails['emails'][$text] != null){
			$wMail     = $text;
			$owner     = $Emails['emails'][$text]['owner'] ?? 'logouted';
			$erN          = 0;
		} else {
			$erN       = 1;
		}
	} else {
		$erN       = 3;
	}
	
	$nbv     = [];
	$respa     = $text_error['controls'][$erN];
	if($erN == 0){
		if($yesS == 'delABan'){
			$nbv        = [
				"PERM#{$wMail}"=>"❌ {$wMail}",
				"FERM#{$owner}"=>"❌ {$owner}",
			];
		} else if($yesS == 'unbanU'){
			#$respa     = "###";
			$nbv        = [
				"ALLOW#{$owner}"=>"✅ {$owner}",
			];
		} else {
			#$respa   = "###";
			$nbv        = [
				"VIEW#{$wMail}"=>"✅ {$wMail}",
			];
		}
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
	} else {
		#$respa  = $ddd[$erN]; ####
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'reply_markup'=>json_encode(make_buttons(array_merge($nbv,$back_home))),
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	]);
	exit;
}

if(preg_match("/^PERM\#(.+)$/",$data,$inf)){
	$emails_db       = new database('emails.json');
	$Emails              = $emails_db->fetch_data();
	$home_db         = new database('home.json');
	$Home               = $home_db->fetch_data();
	$eM                     = $inf[1];
	$oU                      = $Emails['emails'][$eM]['owner'];
	if($Emails['emails'][$eM] != null){
		unset($Emails['emails'][$eM]);
		unset($Home['accounts'][$oU]);
		$emails_db->setData($Emails);
		$home_db->setData($Home);
		#$awq    = file_get_contents('bads.txt');
		file_put_contents('bads.txt',"{$oU}\n",FILE_APPEND);
		$erN     = 6;
	} else {
		$erN     = 1;
	}
	$respa     = $text_error['controls'][$erN];
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	]);
	exit;
}

if(preg_match("/^FERM\#(.+)$/",$data,$inf)){
	$oU              = $inf[1];
	$awq           = file_get_contents('bads.txt');
	if(!in_array($oU,explode("\n",$awq))){
		file_put_contents('bads.txt',"{$oU}\n",FILE_APPEND);
		$erN   = 7;
	} else {
		$erN   = 4;
	}
	$respa     = $text_error['controls'][$erN];
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	]);
	exit;
}

if(preg_match("/^ALLOW\#(.+)$/",$data,$inf)){
	$oU              = $inf[1];
	$awq           = file_get_contents('bads.txt');
	if(in_array($oU,explode("\n",$awq))){
		file_put_contents('bads.txt',str_replace("{$oU}\n",'',$awq));
		$erN   = 8;
	} else {
		$erN   = 5;
	}
	$respa     = $text_error['controls'][$erN];
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	]);
	exit;
}

if(preg_match("/^VIEW\#(.+)$/",$data,$inf)){
	$emails_db       = new database('emails.json');
	$Emails              = $emails_db->fetch_data();
	$eM                     = $inf[1];
	if($Emails['emails'][$eM] != null){
		include_once 'Jello_vars.php';
		$respa       = data_push($eM,$posts_text['my_recent'],'my_recent');
	} else {
		$respa     = $text_error['controls'][1];
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	]);
	exit;
}

if(array_key_exists($data,$ow_panel['home_buttons']) && $data != 'delCountry'){
	if(in_array($data,['s_a_s','s_a_p','s_a_m'])){
		$method      = 'V{1}H{2}';
	} else if(in_array($data,['s_a_m','s2_a_m'])){
		$method      = 'V{0}H{3}';
	} else {
		$method      = 'V';
	}
	$keyboard     = make_buttons($ow_panel['adding_buttons'][$data],$method);
	#print_r($keyboard);
	#exit;
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$ow_panel['texts'][$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

$next     = ['addCountry'=>'s_a_s','s_a_s'=>'s_a_a','s_a_a'=>'s_a_m',
	's_a_m'=>'s_a_c','s2_a_m'=>'s_a_c',
	's_a_c'=>'s_a_r'];
$backd     = ['addCountry','s_a_s','s_a_a','s_a_m','s_a_c','s_a_c'];

if(preg_match("/^(back)\_(.+)/",$data,$rest)){
	$parent = explode('_',$rest[2]);
	$data    = $backd[count($parent)-1];
	#$data    = array_search($rest[2],$next);
	$dBack  = array_slice($parent,0,count($parent) -1);
	#$data     = preg_replace("/^(back)\_([a-zAZ0-9\_]+)\_/",$data,'_'.array_search($data1,$next);
	$data    .= '_'.join('_',$dBack);
}

if(preg_match("/^((next)\_(.+))|((first)\_(.+))/",$data)){
	$data     = str_replace(['next_','first_'],['s2_a_m_','s_a_m_'],$data);
}

///echo $data;

if(preg_match("/^(s\_a\_s)\_([a-zA-Z0-9\.\-]+)$/",$data,$result) || preg_match("/^(s\_a\_a)\_([a-zA-Z0-9\.\-]+)\_(\w+)$/",$data,$result) || preg_match("/^(s2?\_a\_m)\_([a-zA-Z0-9\.\-]+)\_(\w+)\_(\w+)$/",$data,$result) || preg_match("/^(s\_a\_c)\_([a-zA-Z0-9\.\-]+)\_([^\_]+)\_([^\_]+)\_(\w+)$/",$data,$result) || preg_match("/^(s\_a\_r)\_([a-zA-Z0-9\.\-]+)\_(\w+)\_(\w+)\_(\w+)\#(.+)$/",$data,$result)){
	$data     = $result[1];
	$resp     = array_slice($result,2);
	$rBack   = array_search($data,$next);
}


	
	

if(array_key_exists($data,$ow_panel['adding_buttons'])){
	$first_line    = '';
	if(in_array($data,['s_a_s','s_a_a','s_a_c','addCountry'])){
		$method      = 'V{1}H{2}';
	} else if(in_array($data,['s_a_m','s2_a_m'])){
		$method      = 'V{0}H{3}';
		#$first_line    = ['text'=>$extra_buttons['search_'],'data'=>'search_'.join('_',$resp)];
	} else {
		$method      = 'V';
	}
	
	$extra             = '_'.join('_',$resp) ?? '';
	if($data != 's_a_c'){
		$artic      = str_replace('++APPNAME++',$apps_code_name[$resp[1]],$ow_panel['texts'][$data]);
		$keyboard     = make_buttons($ow_panel['adding_buttons'][$data],$method,$next[$data].$extra.'_','',['back_','first_','next_'],['back_'=>join('_',$resp),'first_'=>join('_',$resp),'next_'=>join('_',$resp)],$first_line);
	}
	if($data == 's_a_m'){
		if($resp[0] == 'vak-sms.com'){
			$keyboard     = make_buttons(array_merge(getVakC(),$back_home),$method,$next[$data].$extra.'_','',['back_'],['back_'=>join('_',$resp)],$first_line);
		}
	}
	if($data == 's_a_c'){
		$method    = 'V{0}H{2}';
		#include_once 'files_helper/control_site.php';
		include_once 'files_helper/servers.php';
		$artic      = str_replace(['++APPNAME++','++COUNTRY++','++SITE++'],[$apps_code_name[$resp[1]],$countries_names[$resp[3]],$resp[0]],$ow_panel['texts'][$data]);
		$keyboard     = make_buttons(array_merge(get_servers($resp[0],$resp[1],$resp[3]),$back_home),$method,"s_a_r{$extra}#",'',['back_'],['back_'=>join('_',$resp)]);
	}
	##print_r(get_servers($resp));
	#print_r($keyboard);
	#exit;
	if($data == 's_a_r'){
		include_once 'files_helper/check_add_data.php';
		if(check_CASC($resp) == 'used'){
			$bot->answerCallBackQuery([
			'callback_query_id'=>$update->callback_query->id,
			'text'=>$text_error['already'],
			'show_alert'=>true,
			]);
			exit;
		}
		include_once 'files_helper/servers.php';
		$fetchPrices        = get_servers($resp[0],$resp[1],$resp[3]);
		$infoPrice             = $fetchPrices[str_replace('Jello','',$resp[4])];
		$myPrice               = '';
		if(preg_match("/([^\|]+)\s?\|\s?(.+)/",$infoPrice,$dent)){
			$myPrice      = $dent[1].'₽';
		} else if(preg_match("/([^X]+)\s?\|\s?(.+)/",$infoPrice,$dent)){
			$myPrice      = $dent[1].'₽';
		} else {
			$myPrice       = $infoPrice;
		}
		$artic      = str_replace(['++APPNAME++','++COUNTRY++','++SITE++','++PRICE++'],[$apps_code_name[$resp[1]],$countries_names[$resp[3]],$resp[0],$myPrice],$ow_panel['texts'][$data]);
		$Status[$chat_id]['status']    = 'setPrice';
		$Status[$chat_id]['colomn']  = $resp;
		$timed_db->setData($Status);
	}
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$artic,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

/*
$text = 70;
$chat_id = 80;
$Status[$chat_id]['colomn'] = ['sms.com','tg','all','YE','default_4'];
$Status[$chat_id]['status']    = 'setPrice';
*/


if(preg_match("/^\d+(\.?\d+)?$/",$text)){
	/*
	$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>'..'
			]);
	*/
	if($Status[$chat_id]['status']    == 'setPrice'){
		
		$d_added     = $Status[$chat_id]['colomn'];
		$site     = $d_added[0];
		$app     = $d_added[1];
		$mode  = $modes_buttons[$d_added[2]];
		$modes = $d_added[2];
		$country = $d_added[3];
		$server    = str_replace('Jello','',$d_added[4]);
		/*
		$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>str_replace(['++COUNTRY++','++APPNAME++','++PRICE++','++SITE++'],[$aCountry,$apps_code_name[$app],$text,$site],$ow_panel['texts']['done_saved_add']),
			]); */
		#$saveCLI    = "{$site}#{$server}";
		include_once 'files_helper/numbers_control.php';
		#$ >> [countries][$app][$country]
		#$ >> [countries][$app][$country][$saveCLI]  = $text;
		if(($resAdd = ADD_NUMBER($site,$app,$country,$server,$text,$modes))){
			/* if($resAdd == 'already'){
				$bot->answerCallBackQuery([
				'callback_query_id'=>$update->callback_query->id,
				'text'=>$text_error[$resAdd],
				'show_alert'=>true
				]);
				exit;
			} */
			$Status[$chat_id] = null;
			$timed_db->setData($Status);
			$aCountry       = $countries_names[$country];
			$text_will     = str_replace(['++COUNTRY++','++APPNAME++','++PRICE++','++SITE++'],[$aCountry,$apps_code_name[$app],$text,$site],$ow_panel['texts']['done_saved_add']);
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$text_will,
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			]);
		} else {
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>$text_error['add'],
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			]);
		}
		exit;
	}
}

if($data == 'delCountry'){
	#include_once 'functions.php';
	$method = 'H';
	$keyboard      = make_buttons($ow_panel['delete_buttons'][$data],$method);
	#print($ow_panel['texts'][$data]);
	/*
	$bot->answerCallBackQuery([
	'callback_query_id'=>$update->callback_query->id,
	'text'=>'X',
	'show_alert'=>true,
	]);
	*/
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>'Hello',
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if(array_key_exists($data,$apps_code_name)){
	$APP      = $data;
	$RRX      = [];
	$RRX["DELER#{$APP}"]      = $modes_buttons['all'];
	$RRX["DELEM#{$APP}"]      = $modes_buttons['shows'];
	$RRX["delCountry"]               = $back_home['back_'];
	$keyboard      = make_buttons($RRX,'V');
	$reText    = $ow_panel['texts']['d_a_m'];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$reText,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}
if(preg_match("/^(DELE.)\#(.+)$/",$data,$inf)){
	$reText    = $ow_panel['texts']['d_a_a'];
	include_once 'files_helper/get_numbers.php';
	switch ($inf[1]){
		case 'DELER':
		$rule_cd    = get_numbers($inf[2]);
		$nData       = 'del-from';
		break;
		case 'DELEM':
		$rule_cd    = get_numbers2($inf[2]);
		$nData       = 'del-frum';
		break;
	}
	if($rule_cd[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$rule_cd[1],
		'show_alert'=>true,
		]);
		exit;
	}
	$next    = false;
	if(count($rule_cd[1]) >= 90){
		$next = 90;
	}
	include_once 'files_helper/make_countries_buttons.php';
	$keyboard      = make_countries_buttons("{$nData}_".$inf[2].'_',$rule_cd[1],$next);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++APPNAME++',$apps_code_name[$inf[2]],$reText),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if(preg_match("/^(del\-fr.m)\_([^\_]+)\_(\w+)/",$data,$resp)){
	$reText    = $ow_panel['texts']['d_a_c'];
	$app         = $resp[2];
	$country   = $resp[3];
	include_once 'files_helper/get_numbers.php';
	switch ($resp[1]){
		case 'del-from':
		$rule_cd    = get_numbers($app,$country);
		$nData       = 'del-this';
		break;
		case 'del-frum':
		$rule_cd    = get_numbers2($app,$country);
		$nData       = 'del-thes';
		break;
	}
	
	if($rule_cd[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$rule_cd[1],
		'show_alert'=>true,
		]);
		exit;
	}
	$bot->answerCallBackQuery([
	'callback_query_id'=>$update->callback_query->id,
	'text'=>'it is work ',
	'show_alert'=>true,
	]);
	include_once 'files_helper/make_servercli_buttons.php';
	$keyboard    = make_servercli_buttons("{$nData}_{$app}_{$country}_",$rule_cd[1]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace(['++APPNAME++','++COUNTRY++'],[$apps_code_name[$app],$countries_names[$country]],$reText),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}

if(preg_match("/^(del\-th.s)\_([^\_]+)\_([^\_]+)\_(.+)/",$data,$resp)){
	$reText    = $ow_panel['texts']['d_a_s'];
	$app         = $resp[2];
	$country   = $resp[3];
	$serverCLI = $resp[4];
	include_once 'files_helper/get_numbers.php';
	switch ($resp[1]){
		case 'del-this':
		$rule_cd    = get_numbers($app,$country,$serverCLI);
		$nData       = 'all';
		break;
		case 'del-thes':
		$rule_cd    = get_numbers2($app,$country,$serverCLI);
		$nData       = 'shows';
		break;
	}
	if($rule_cd[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$rule_cd[1],
		'show_alert'=>true,
		]);
		exit;
	}
	$exp_cli     = explode('#',$serverCLI);
	include 'files_helper/del_numbers.php';
	switch ($nData){
		case 'all';
		del_numbers($app,$country,$serverCLI);
		break;
		case 'shows':
		del_showes($app,$country,$serverCLI);
		break;
	}
	$keyboard = [];
	$keyboard['inline_keyboard'][0][]  = ['text'=>$extra_buttons['back_'],'callback_data'=>"back_"];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace(['++COUNTRY++','++APPNAME++','++SITE++','++CLI++','++PRICE++'],[$countries_names[$country],$apps_code_name[$app],$exp_cli[0],$exp_cli[1],$rule_cd[1]],$reText),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}





if($message->forward_date && $Status[$chat_id]['status'] == 'sendPost'){
	foreach($members as $fromid => $xx){
		$bot->forwardMessage([
		'chat_id'=>$fromid,
		'from_chat_id'=>$chat_id,
		'message_id'=>$message_id,
		]);
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'reply_to_message_id'=>$message_id,
	'parse_mode'=>'MarkDown',
	'text'=>str_replace(['++CM++'],[count($members)],$posts_texts['forPost']),
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}


if($message && $Status[$chat_id]['status'] == 'sendPost'){
	foreach($members as $fromid => $xx){
		$bot->copyMessage([
		'chat_id'=>$fromid,
		'from_chat_id'=>$chat_id,
		'message_id'=>$message_id,
		]);
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'reply_to_message_id'=>$message_id,
	'parse_mode'=>'MarkDown',
	'text'=>str_replace(['++CM++'],[count($members)],$posts_texts['donePost']),
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if($reply){
	$tw_database    = new database('database/support.json');
	$Tawasol            = $tw_database->fetch_data();
	if(($handM = $Tawasol[$reply->message_id])){
		$bot->copyMessage(
		array_merge($Tawasol['MSGs'][$handM],[
		'message_id'=>$message_id,
		'from_chat_id'=>$chat_id,
		]));
	}
}

?>