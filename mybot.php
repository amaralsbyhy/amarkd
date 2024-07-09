<?php

include_once 'texts.php';
/*
include_once 'functions.php';
$app_code = 'tg';
$country_ISO = 'RU';
$op_ID = 74455458;
$webSite = '5sim.biz';
	$extra       = "{$app_code}_{$country_ISO}_{$op_ID}_{$webSite}";
	$next_button  = ['get-code_','cancel-order_'];
	$next_info       = ['get-code_'=>$extra,'cancel-order_'=>$extra];
	$keyboard      = make_buttons($buttons_buy,'H','','',$next_button,$next_info);
print_r($keyboard);
exit;
*/

$admin    = strtoupper($manger);
$s_user   = strtoupper($username);


if($admin == "@{$s_user}" || in_array("@{$s_user}",$otherMangers)){
	include_once 'control.php';
	return false;
}

if(!is_dir('database')){
	mkdir('database');
}

if(!file_exists('database/members.json')){
	touch('database/members.json');
	file_put_contents('database/members.json','{}');
}

$members      = json_decode(file_get_contents('database/members.json'),1);

if(!array_key_exists($from_id,$members)){
	if(preg_match("/^\/start ([A-Z][A-Z0-9]{11})$/",$text,$revral)){
		$inviter_hash      = $revral[1];
		$text                      = '/start';
		if(array_key_exists($inviter_hash,$Emails['invites'])){
			$inviter            = $Emails['invites'][$inviter_hash]['email'];
			$members[$from_id]     = $inviter;
			file_put_contents('database/members.json',json_encode($members));
		} else {
			$members[$from_id]     = null;
			file_put_contents('database/members.json',json_encode($members));
		}
	} else {
		$members[$from_id]     = null;
		file_put_contents('database/members.json',json_encode($members));
	}
}

if(preg_match("/^\/start ([A-Z][A-Z0-9]{11})$/",$text)){
	$text                      = '/start';
}

if($text){
	include_once 'files_helper/system.php';
	$connecter      = new OS_jello();
	$myChannel    = $connecter->getJoin();
	if($myChannel == true && $myChannel != '@YemenDevs'){
		if($bot->getChatMember([
		'chat_id'=>$myChannel,
		'user_id'=>$from_id
		])->result->status == 'left'){
			include_once 'functions.php';
			$zaer            = ['Home'=>$continueTo];
			$keyboard   = make_buttons($zaer,'V');
			$bot->sendMessage([
			'chat_id'=>$chat_id,
			'text'=>str_replace(['++CHANNEL++','++TGNAME++'],[$myChannel,"[{$first_name}](tg://user?id={$chat_id})"],$pleaseJoin),
			'parse_mode'=>'MarkDown',
			'reply_to_message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			exit;
		}
	}
}

if($data){
	include_once 'files_helper/system.php';
	$connecter      = new OS_jello();
	$myChannel    = $connecter->getJoin();
	if($myChannel == true && $myChannel != '@YemenDevs'){
		if($bot->getChatMember([
		'chat_id'=>$myChannel,
		'user_id'=>$from_id
		])->result->status == 'left'){
			include_once 'functions.php';
			$zaer            = [$data=>$continueTo];
			$keyboard   = make_buttons($zaer,'V');
			$bot->editMessageText([
			'chat_id'=>$chat_id,
			'text'=>str_replace(['++CHANNEL++','++TGNAME++'],[$myChannel,"[{$first_name}](tg://user?id={$chat_id})"],$pleaseJoin),
			'parse_mode'=>'MarkDown',
			'message_id'=>$message_id,
			'reply_markup'=>json_encode($keyboard)
			]);
			exit;
		}
	}
}

if($text == '/start'){
	##include_once 'functions.php';
	#include_once 'Jello_vars.php';
	/*
	include_once 'files_helper/users_info.php';
	$xx     = $Home['accounts'][$chat_id]['email'];
	$cx     = new user_config($xx);
	$bx     = $cx->getBalance();
	$sx      = $cx->getSoldBalance();
	$rrx     = str_replace(['++EMAIL++ ','++BALANCE++','++SALE++','++ID++','++CHANNEL++'],[$xx,$bx,$sx,$chat_id,''],$posts_text['menu_start']);
	*/
	include_once 'files_helper/system.php';
	$connecter      = new OS_jello();
	$myChannel    = $connecter->getJoin();
	$Abutton            = [];
	$Abutton['inline_keyboard'][0][] = ['text'=>$start_buttons['signup'],'callback_data'=>'signup'];
	$Abutton['inline_keyboard'][1][] = ['text'=>$start_buttons['privacy'],'callback_data'=>'privacy'];
	$Abutton['inline_keyboard'][1][] = ['text'=>$start_buttons['login'],'callback_data'=>'login'];
	$Abutton['inline_keyboard'][2][] = ['text'=>$start_buttons['newUsers'],'callback_data'=>'newUsers'];
	$Abutton['inline_keyboard'][3][] = ['text'=>$start_buttons['recently'],'callback_data'=>'recently'];
	$Abutton['inline_keyboard'][3][] = ['text'=>$start_buttons["https://t.me/{$manger}"],'url'=>str_replace('@','',"https://t.me/{$manger}")];
	$Abutton['inline_keyboard'][4][] = ['text'=>$start_buttons['learning'],'callback_data'=>'learning'];
	$Abutton['inline_keyboard'][4][] = ['text'=>$start_buttons['botChannel'],'url'=>str_replace('@','',"https://t.me/{$myChannel}")];
	$Abutton['inline_keyboard'][5][] = ['text'=>$start_buttons['help'],'callback_data'=>'help'];
	
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++TGNAME++',"[{$first_name}](tg://user?id={$chat_id})",$textStart),
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($Abutton)
	]);
	exit;
}

if($data == 'home' || $data == 'Home'){
	include_once 'files_helper/system.php';
	$connecter      = new OS_jello();
	$myChannel    = $connecter->getJoin();
	$Abutton            = [];
	$Abutton['inline_keyboard'][0][] = ['text'=>$start_buttons['signup'],'callback_data'=>'signup'];
	$Abutton['inline_keyboard'][1][] = ['text'=>$start_buttons['privacy'],'callback_data'=>'privacy'];
	$Abutton['inline_keyboard'][1][] = ['text'=>$start_buttons['login'],'callback_data'=>'login'];
	$Abutton['inline_keyboard'][2][] = ['text'=>$start_buttons['newUsers'],'callback_data'=>'newUsers'];
	$Abutton['inline_keyboard'][3][] = ['text'=>$start_buttons['recently'],'callback_data'=>'recently'];
	$Abutton['inline_keyboard'][3][] = ['text'=>$start_buttons["https://t.me/{$manger}"],'url'=>str_replace('@','',"https://t.me/{$manger}")];
	$Abutton['inline_keyboard'][4][] = ['text'=>$start_buttons['learning'],'callback_data'=>'learning'];
	$Abutton['inline_keyboard'][4][] = ['text'=>$start_buttons['botChannel'],'url'=>str_replace('@','',"https://t.me/{$myChannel}")];
	$Abutton['inline_keyboard'][5][] = ['text'=>$start_buttons['help'],'callback_data'=>'help'];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++TGNAME++',"[{$first_name}](tg://user?id={$chat_id})",$textStart),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($Abutton)
	]);
	exit;
}

if($data == 'signup' || $Status[$chat_id]['status'] == 'captcha'){
	include_once 'signup.php';
	exit;
}

if($data == 'login' || preg_match("/login\#(.+)/",$data) || $Status[$chat_id]['status'] == 'login' || $Status[$chat_id]['status'] == 'verfiry'){
	include_once 'login.php';
	exit;
}

if($data == 'recently'){
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



if(array_key_exists($data,$text_home_v)){
	include_once 'functions.php';
	include_once 'files_helper/system.php';
	$connecter      = new OS_jello();
	$myChannel    = $connecter->getJoin();
	$want      = str_replace('++CH++',$myChannel,$text_home_v[$data]);
	$keyboard     = make_buttons(['home'=>$back_home['back_']]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$want,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	if($data == 'support_contact'){
		$Status[$chat_id]['status']       = 'supportCMD';
		$timed_db->setData($Status);
	}
	exit;
}
if($data && !array_key_exists($chat_id,$Home['accounts'])){
	if(!array_key_exists($data,$start_buttons)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$signup_texts['setup_befor'],
		'show_alert'=>true,
		]);
		exit;
	}
}

if($Home['accounts'][$chat_id]['email'] == null){
	if(!array_key_exists($data,$start_buttons)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$signup_texts['setup_befor'],
		'show_alert'=>true,
		]);
		exit;
	}
}
### عند الضغط على زر الرجوع
## on click back button

#if(preg_match("/^back\_/",$data)){
if($data == 'back_'){
	include_once 'functions.php';
	include_once 'files_helper/users_info.php';
	$xx     = $Home['accounts'][$chat_id]['email'];
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

if(is_array($Home['wakeel'][$Home['accounts'][$chat_id]['email']])){
	include_once 'agents.php';
}


## عند الضغط على أحد ازرار القائمة الرئيسية
## on click any menu list button

if($data == 'all_shows'){
	include_once 'files_helper/numbers_handle.php';
	if(!is_array($NUMBERS['numbers']["showes"]['wa'])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$foundition_texts['noShows'],
		'show_alert'=>true,
		]);
		exit;
	}
	$kanko = [];
	foreach($NUMBERS['numbers']["showes"]['wa'] as $k=>$v){
		foreach ($v as $x=>$y){
			$kanko["buyShowss_{$k}_{$x}"]          = $add_apps['wa'];
			$kanko["buyShowes_{$k}_{$x}"]        = $y.' P';
			$kanko["buyShow3s_{$k}_{$x}"]          = $countries_names[$k];
		}
	}
	include_once 'functions.php';
	$keyboard     = make_buttons(array_merge($kanko,$back_home),'V{0}H{3}');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text[$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}
if(array_key_exists($data,$home_buttons)){
	include_once 'functions.php';
	include_once 'Jello_vars.php';
	if(array_key_exists($data,$H2_buttons)){
		if(in_array($data,['my_recent','cards_store'])){
			$method      = 'H';
		} else {
			$method      = 'V';
		}
		$keyboard     = make_buttons($H2_buttons[$data],$method);
	}
	$mail          = $Home['accounts'][$chat_id]['email'];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>data_push($mail,$posts_text[$data],$data),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
}


### عند الضغط على أحد ازرار التطبيقات
## on click some button apps
/*
$data = 'next_select_country_tg_90';
include 'dbControl.php';
include 'functions.php';
include 'texts.php';
*/
if($data == 'support_contact'){
	$timed_db         = new database('timed_store.json');
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$text_home_v[$data],
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard),
	'parse_mode'=>"MarkDown",
	]);
	$Status[$chat_id]['status']       = 'supportCMD';
	$timed_db->setData($Status);
	exit;
}

if($message->forward_date && $Status[$chat_id]['status'] == 'supportCMD'){
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'reply_to_message_id'=>$message_id,
	'parse_mode'=>'MarkDown',
	'text'=>$text_home_v['supportFWD'],
	]);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

if($message && $Status[$chat_id]['status'] == 'supportCMD'){
	$jelloMSG  = $bot->forwardMessage([
	'chat_id'=>$IDcontrol,
	'from_chat_id'=>$chat_id,
	'message_id'=>$message_id,
	])->result->message_id;
	$Tawasol['MSGs'][$jelloMSG] = [
		'chat_id'=>$chat_id,
		'reply_to_message_id'=>$message_id,
	];
	$bot->sendMessage(
	array_merge($Tawasol['MSGs'][$jelloMSG],[
	'text'=>$text_home_v['supportCMD'],'parse_mode'=>'MarkDown']
	));
	$tw_database->setData($Tawasol);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

$alv     = false;
$aln     = false;

if($chat_id ==5502198644){
	if($data){
$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$data,
		'show_alert'=>true,
		]);
		}}
		
if(preg_match("/^[a-zA-Z\_]*(select\_country)\_(\w+)\_(\w+)/",$data,$info_c)){
	$data     = $info_c[1].'#'.$info_c[2];
	$next_page = $info_c[3];
	if($next_page >= 30){
		$to_page       = $info_c[3] + 30;
		$from_move = $info_c[3];
		$alv                 = true;
		$last_page     = $info_c[3] - 30;
		if($to_page >= count($countries_names)){
			$aln                 = 'No';
			$baqi               = count($countries_names) - $info_c[3];
		}
	}
}

if (array_key_exists($data,$reace_show) || array_key_exists($data,$reace_pro)){
	include_once 'functions.php';
	$app_code     = preg_replace("/^select_[a-zA-Z0-9]+\#/","",$data);
	$data               = preg_replace("/\#.+/","",$data);
	
	include_once 'files_helper/get_numbers.php';
	$countries      = get_numbers($app_code);
	
	if (!is_array($countries[1])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$no_con['noAdded'],
		'show_alert'=>true,
		]);
		exit();
	}
	
	if (0 >= count($countries[1])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$no_con['noAdded'],
		'show_alert'=>true,
		]);
		exit();
	}
	
	$newCoun  = [];
	$ppc = 0;
	$fcc = '';
	foreach($countries[1] as $val=>$keyf){
		$ppc = 0;
		$fcc = $val;
		print($val);
		echo "\n";
		$checkIt          = get_numbers($app_code,$val);
		
		include_once 'files_helper/control_site.php';
		
		foreach($checkIt[1] as $key=>$value){
			$ppc    = $value;
		}
		
		if(0>=$ppc){
			continue;
		}
		
		$newCoun[$val]     = $countries_names[$val]." | {$ppc} ₽";
	}
	
	  /// Panel view
	#$next_page     = $to_page ?? 30;   /// Next page countries
	#$gbk                 = $next_page - 30;
	#$first_line        = ['text'=>$extra_buttons['search_'],'data'=>"search_{$app_code}_{$gbk}"];
	#$last_line         = ['reace_show'=>$extra_buttons['back_'],'home'=>'🔙 Home'];
	$last_line         = ['text'=>$extra_buttons['back_'],'data'=>'reace_show'];
	/*
	if($alv == true){
		$countries      = array_merge(get_countries_view($next_page-30,30),array_slice($extra_buttons,2));  #Count countries 
		$next_button  = ['next_','first_'];
		$next_info       = ['next_'=>"{$data}_{$app_code}_{$next_page}",'first_'=>"{$data}_{$app_code}_{$last_page}"];
	} else {
		$countries      = array_merge(get_countries_view($next_page-30,30),array_slice($extra_buttons,2,1));  #Count countries 
		$next_button  = ['next_'];
		$next_info       = ['next_'=>"{$data}_{$app_code}_{$next_page}"];
	}
	if($aln == 'No'){
		$countries      = array_merge(get_countries_view($next_page-30,$baqi-1),array_slice($extra_buttons,3));  #Count countries 
		$next_button  = ['first_'];
		$next_info       = ['first_'=>"{$data}_{$app_code}_{$last_page}"];
	}
	*/
	
	$rouhi             = $newCoun[$fcc];
	unset($newCoun[$fcc]);
	$method         = "V{0}H{2}";
	$last_line         = ['text'=>$extra_buttons['back_'],'data'=>'reace_show'];
	$keyboard       = make_buttons($newCoun,$method,$home_user_buttons[$data]."_{$app_code}_", '','','',['text'=>$rouhi, 'data'=>$home_user_buttons[$data]."_{$app_code}_{$fcc}"],$last_line);
	
	
	##$keyboard     = make_buttons($newCoun,$method,'','','','','',$last_line);
	
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++APPNAME++',$apps_code_name[$app_code],$posts_text[$data]),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
}
	

if (array_key_exists($data,$reace_rand)){
	include_once 'functions.php';
	$app_code     = preg_replace("/^select_[a-zA-Z0-9]+\#/","",$data);
	$data               = preg_replace("/\#.+/","",$data);
	
	#$countries       = get_countries_view(0,100);
	include_once 'files_helper/get_numbers.php';
	
	$countries      = get_numbers($app_code);
	if (!is_array($countries[1])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$no_con['noAdded'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	if (0 >= count($countries[1])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$no_con['noAdded'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	$Price     = substr($app_code,2,2);
	$price      = $Price;
	include_once 'files_helper/users_info.php';
	$cnn      = new user_config($Home['accounts'][$chat_id]['email']);
	$Balance = $cnn->getBalance();
	if($price > $Balance){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_BALANCE'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	$CounCou   = '';
	$Handle        = [];
	$webweb      = '';
	$opreag        = '';
	
	if($countries[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems[$checkIt[1]],
		'show_alert'=>true,
		]);
		exit;
	}
	foreach ($countries[1] as $country_ISO=>$c){
		echo "Country -- {$country_ISO}\n";
		$checkIt          = get_numbers($app_code,$country_ISO);
		
		
		
		# $command    = $home_user_buttons[$data];
		# $inserted       = array_slice($text_buy,0,3);
		# $x                    = 0;
		
		
		include_once 'files_helper/control_site.php';
		
		foreach($checkIt[1] as $key=>$value){
			echo "Server -- {$key}\n";
			$pex          = explode('#',$key);
			$webSite   = $pex[0];
			$operator  = $pex[1];
			
			$connect        = get_aclass($webSite);
			if($connect == false){
				continue;
			}
			
			$get_number       = $connect->getNumber(substr($app_code,0,2),$country_ISO,$operator);
			if(!is_array($get_number)){
				continue;
			}
			
			if($get_number[0] == false){
				continue;
			}
			
			if($get_number[0] == true){
				$Handle        = $get_number[1];
				$CouCou       = $country_ISO;
				$opreag         = 'done';
				$webweb       = $webSite;
				break;
			}
		
			if($opreag == 'done'){
				break;
			}
		}
	}
	
	$country_ISO    = $CouCou;
	$webSite            = $webweb;
	
	if ($opreag == 'done'){
		$price            = $Price;
		$Number       = $Handle['PHONE'];
		if(!preg_match("/^\+/",$Number)){
			$Number    = '+'.$Number;
		}
		$op_ID            = $Handle['ID'];
		$country         = $countries_names[$country_ISO];
		$app_name    = $apps_code_name[$app_code];
	
		$respi    = ['++P++','++IDT++','++NUMBER++','++CODE++','++AN++'];
		$resbi    = [$price,$op_ID,$Number,'*.....*',$add_apps[substr($app_code,0,2)]];
		$respo   = str_replace($respi,$resbi,$text_buy['buy']);
	
		$cnn->delBalance($price);
		include_once 'functions.php';
		$extra       = "{$app_code}_{$country_ISO}_{$op_ID}_{$webSite}_{$price}_{$Number}";
		#$next_button  = ['get-code_','cancel-order_'];
		#$next_info       = ['get-code_'=>$op_ID,'cancel-order_'=>$op_ID];
		#$keyboard      = make_buttons($buttons_buy,'H','','',$next_button,$next_info);
		$ICX    = [];
		if(substr($app_code,0,2) == 'wa'){
			$ICX["https://wa.me/{$Number}"]  = $buttons_buy['view_on'];
		}
	
		$notice_t    = ['++N++','++C++','++CC++','++APP++','++B++','++ID++','++P++','++M++','++S++'];
		$notice_v    = [$Number,$country,$country_ISO,$app_name,$cnn->getBalance(),$chat_id,$price,$Home['accounts'][$chat_id]['email'],$webSite];
		$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['buy']);
		$bot->sendMessage([
		'chat_id'=>$buyBanID,
		'text'=>$notice_f,
		]);
	
		$ICX["get-code_{$op_ID}"]                  = $buttons_buy['refresh'];
		$ICX["cancel-order_{$op_ID}"]           = $buttons_buy['cancel'];
		$ICX["cancel-orders_{$op_ID}"]         = $buttons_buy['back'];
		$keyboard      = make_buttons($ICX,'V');
		$bot->editMessageText([
		'chat_id'=>$chat_id,
		'text'=>$respo,
		'parse_mode'=>'MarkDown',
		'message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard)
		]);
		$Status['buying'][$chat_id][$op_ID]       = [
		'extra'=>$extra,
		'data'=>$data,
		'price'=>$price,
		'mode'=>'all',
		'time'=>time(),
		];
		$timed_db->setData($Status);
		exit;
	}
	
	$keyboard      = make_buttons($bkkkkk,'V');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$Numbts,
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}
			

if(array_key_exists($data,$apps_buttons) || array_key_exists($data,$reace_rand) || array_key_exists($data,$reace_pro) || array_key_exists($data,$reace_show)){
	include_once 'functions.php';
	$app_code     = preg_replace("/^select_[a-zA-Z0-9]+\#/","",$data);
	$data               = preg_replace("/\#.+/","",$data);
	$method         = "V{0}H{3}";  /// Panel view
	$next_page     = $to_page ?? 30;   /// Next page countries
	$gbk                 = $next_page - 30;
	$first_line        = ['text'=>$extra_buttons['search_'],'data'=>"search_{$app_code}_{$gbk}"];
	$last_line         = ['text'=>$extra_buttons['back_'],'data'=>array_search($data,$home_user_buttons)];
	if($alv == true){
		$countries      = array_merge(get_countries_view($next_page-30,30),array_slice($extra_buttons,2));  #Count countries 
		$next_button  = ['next_','first_'];
		$next_info       = ['next_'=>"{$data}_{$app_code}_{$next_page}",'first_'=>"{$data}_{$app_code}_{$last_page}"];
	} else {
		$countries      = array_merge(get_countries_view($next_page-30,30),array_slice($extra_buttons,2,1));  #Count countries 
		$next_button  = ['next_'];
		$next_info       = ['next_'=>"{$data}_{$app_code}_{$next_page}"];
	}
	if($aln == 'No'){
		$countries      = array_merge(get_countries_view($next_page-30,$baqi-1),array_slice($extra_buttons,3));  #Count countries 
		$next_button  = ['first_'];
		$next_info       = ['first_'=>"{$data}_{$app_code}_{$last_page}"];
	}
	$keyboard       = make_buttons($countries,$method,$home_user_buttons[$data]."_{$app_code}_",'',$next_button,$next_info,$first_line,$last_line);
	#print_r($keyboard);
	#exit;
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++APPNAME++',$apps_code_name[$app_code],$posts_text[$data]),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
}

if(preg_match("/^search\_([^\_]+)\_?(\w+)?/",$data,$rat)){
	include_once 'functions.php';
	$app_code     = $rat[1];
	$page_no       = $rat[2] ?? 0;
	$keyboard     = make_buttons(["select_country_{$app_code}_{$page_no}"=>$hanf_buttons['back_']]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text['search'],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']       = 'search';
	$Status[$chat_id]['app_search']       = $app_code;
	$timed_db->setData($Status);
	exit;
}

if($text && $Status[$chat_id]['status'] == 'search'){
	include_once 'functions.php';
	if(15 >= strlen($text)){
		$app_code  = $Status[$chat_id]['app_search'];
		$search    = preg_grep("/".$text."/",$countries_names);
		if(count($search) >= 1){
			$data               = 'select_country';
			$last_line         = ['text'=>$extra_buttons['back_'],'data'=>array_search($data,$home_user_buttons)];
			$method         = "V{0}H{3}";  /// Panel view
			$keyboard       = make_buttons(array_merge(array_slice($search,0,3),["select_country_{$app_code}_30"=>$hanf_buttons['back_']]),$method,$home_user_buttons[$data]."_{$app_code}_",'','','','',$last_line);
			$response       = str_replace('++COUNT++',count($search),$posts_text['found']);
		} else {
			$keyboard       = make_buttons(["select_country_{$app_code}_30"=>$hanf_buttons['back_']]);
			$response       = $posts_text['notfound'];
		}
	} else {
		$keyboard       = make_buttons(["select_country_{$app_code}_30"=>$hanf_buttons['back_']]);
		$response       = $posts_text['errorsearch'];
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>'MarkDown',
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

#$randoms = array_merge($reace_show,$reace_pro,

if(preg_match("/^select\_server\_(\w+)\_(\w+)/",$data,$info)){
	$app_code     = $info[1];
	$country         = $info[2];
	include_once 'functions.php';
	$data               = 'select_server';
	include_once 'files_helper/get_numbers.php';
	$checkIt          = get_numbers($app_code,$country);
	if($checkIt[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems[$checkIt[1]],
		'show_alert'=>true,
		]);
		exit;
	}
	$command    = $home_user_buttons[$data];
	$inserted       = array_slice($text_buy,0,3);
	$x                    = 0;
	foreach($checkIt[1] as $key=>$value){
		$x++;
		$inserted["{$command}_{$app_code}_{$country}_{$key}@c"]  = "✅";
		$inserted["{$command}_{$app_code}_{$country}_{$key}@p"]  = $value;
		$inserted["{$command}_{$app_code}_{$country}_{$key}@n"]  = "{$sercet}{$x}";
	}
	$inserted[array_search($data,$home_user_buttons)."#{$app_code}"]  = $extra_buttons['back_'];
	$method        = 'V{0}H{3}';
	$last_line         = ['text'=>$extra_buttons['back_'],'data'=>array_search($data,$home_user_buttons)];
	$keyboard     = make_buttons($inserted,$method,'','','','','',$last_line);
	##print_r($keyboard);
	##exit;
	$repIt           = ['++APPNAME++','++COUNTRY++'];
	$viaIt            = [$apps_code_name[$app_code],$countries_names[$country]];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>str_replace($repIt,$viaIt,$posts_text[$data]),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard),
	]);
	exit;
}

if(preg_match("/^buyShow.s_(\w+)_((.+)#(.+))$/",$data,$dConfig)){
	$app_code       = 'wa';
	$country_ISO         = $dConfig[1];
	$serverClient          = $dConfig[2];
	$webSite                 = $dConfig[3];
	$operator                = $dConfig[4];
	include_once 'files_helper/get_numbers.php';
	$get_info            = get_numbers2($app_code,$country_ISO,$serverClient);
	if(!is_array($get_info)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	if($get_info[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	$price       = $get_info[1];
	### make all each 
	include_once 'files_helper/users_info.php';
	$cnn      = new user_config($Home['accounts'][$chat_id]['email']);
	$Balance = $cnn->getBalance();
	if($price > $Balance){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_BALANCE'],
		'show_alert'=>true,
		]);
		exit;
	}
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	$get_number       = $connect->getNumber($app_code,$country_ISO,$operator);
	if(!is_array($get_number)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_SERVICE'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($get_number[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_NUMBERS'],
		'show_alert'=>true,
		]);
		exit;
	}
	$Handle        = $get_number[1];
	$Number       = $Handle['PHONE'];
	if(!preg_match("/^\+/",$Number)){
		$Number    = '+'.$Number;
	}
	$op_ID            = $Handle['ID'];
	$country         = $countries_names[$country_ISO];
	$app_name    = $apps_code_name[$app_code];
	
	$respi    = ['++P++','++IDT++','++NUMBER++','++CODE++'];
	$resbi    = [$price,$op_ID,$Number,'*.....*'];
	$respo   = str_replace($respi,$resbi,$text_buy['buy']);
	
	$cnn->delBalance($price);
	include_once 'functions.php';
	$extra       = "{$app_code}_{$country_ISO}_{$op_ID}_{$webSite}_{$price}_{$Number}";
	#$next_button  = ['get-code_','cancel-order_'];
	#$next_info       = ['get-code_'=>$op_ID,'cancel-order_'=>$op_ID];
	#$keyboard      = make_buttons($buttons_buy,'H','','',$next_button,$next_info);
	$ICX    = [];
	$ICX["https://wa.me/{$Number}"]  = $buttons_buy['view_on'];
	$ICX["get-code_{$op_ID}"]                  = $buttons_buy['refresh'];
	$ICX["cancel-order_{$op_ID}"]           = $buttons_buy['cancel'];
	$ICX["cancel-orders_{$op_ID}"]         = $buttons_buy['back'];
	$keyboard      = make_buttons($ICX,'V');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status['buying'][$chat_id][$op_ID]       = [
	'extra'=>$extra,
	'data'=>$data,
	'price'=>$price,
	'mode'=>'all',
	'time'=>time(),
	];
	$timed_db->setData($Status);
	exit;
}

if(preg_match("/^trybuyNumber_(\w+)_(\w+)_((.+)#(.+))@.$/",$data,$dConfig)){
$plant = 0;
for($xn=0;10>$xn;$xn++){
	$app_code             = $dConfig[1];
	$country_ISO         = $dConfig[2];
	$serverClient          = $dConfig[3];
	$webSite                 = $dConfig[4];
	$operator                = $dConfig[5];
	
	include_once 'files_helper/get_numbers.php';
	$get_info            = get_numbers($app_code,$country_ISO,$serverClient);
	if(!is_array($get_info)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		continue;
	}
	
	if($get_info[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		continue;
	}
	
	$price       = $get_info[1];
	### make all each 
	include_once 'files_helper/users_info.php';
	$cnn      = new user_config($Home['accounts'][$chat_id]['email']);
	$Balance = $cnn->getBalance();
	if($price > $Balance){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_BALANCE'],
		'show_alert'=>true,
		]);
		continue;
	}
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		continue;
	}
	$get_number       = $connect->getNumber(substr($app_code,0,2),$country_ISO,$operator);
	if(!is_array($get_number)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_SERVICE'],
		'show_alert'=>true,
		]);
		continue;
	}
	if($get_number[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_NUMBERS'],
		'show_alert'=>true,
		]);
		/*
		$keyboard     = make_buttons("try{$data}"=>'Try 10x');
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>'No Numbers !',
		'reply_markup'=>json_encode($keyboard)
		*/
		continue;
	}
	
	$Handle        = $get_number[1];
	$Number       = $Handle['PHONE'];
	if(!preg_match("/^\+/",$Number)){
		$Number    = '+'.$Number;
	}
	$op_ID            = $Handle['ID'];
	$country         = $countries_names[$country_ISO];
	$app_name    = $apps_code_name[$app_code];
	
	$respi    = ['++P++','++IDT++','++NUMBER++','++CODE++','++AN++'];
	$resbi    = [$price,$op_ID,$Number,'*.....*',$add_apps[$app_code]];
	$respo   = str_replace($respi,$resbi,$text_buy['buy']);
	
	$cnn->delBalance($price);
	include_once 'functions.php';
	$extra       = "{$app_code}_{$country_ISO}_{$op_ID}_{$webSite}_{$price}_{$Number}";
	#$next_button  = ['get-code_','cancel-order_'];
	#$next_info       = ['get-code_'=>$op_ID,'cancel-order_'=>$op_ID];
	#$keyboard      = make_buttons($buttons_buy,'H','','',$next_button,$next_info);
	$ICX    = [];
	if($app_code == 'wa'){
		$ICX["https://wa.me/{$Number}"]  = $buttons_buy['view_on'];
	}
	
	$notice_t    = ['++N++','++C++','++CC++','++APP++','++B++','++ID++','++P++','++M++','++S++'];
	$notice_v    = [$Number,$country,$country_ISO,$app_name,$cnn->getBalance(),$chat_id,$price,$Home['accounts'][$chat_id]['email'],$webSite];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['buy']);
	$bot->sendMessage([
	'chat_id'=>$buyBanID,
	'text'=>$notice_f,
	]);
	
	$ICX["get-code_{$op_ID}"]                  = $buttons_buy['refresh'];
	$ICX["cancel-order_{$op_ID}"]           = $buttons_buy['cancel'];
	$ICX["cancel-orders_{$op_ID}"]         = $buttons_buy['back'];
	$keyboard      = make_buttons($ICX,'V');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status['buying'][$chat_id][$op_ID]       = [
	'extra'=>$extra,
	'data'=>$data,
	'price'=>$price,
	'mode'=>'all',
	'time'=>time(),
	];
	$timed_db->setData($Status);
	$plant = 1;
	break;
	exit;
}
if ($plant == false){
	$keyboard     = make_buttons("{$data}"=>'Try 10x again');
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>'No Numbers ops !',
	'reply_markup'=>json_encode($keyboard)
	]);
	exit();
}
}

if(preg_match("/^buyNumber_(\w+)_(\w+)_((.+)#(.+))@.$/",$data,$dConfig)){
	/*$bot->answerCallBackQuery([
	'callback_query_id'=>$update->callback_query->id,
	'text'=>'Work!',
	'show_alert'=>true,
	]);*/
	$app_code             = $dConfig[1];
	$country_ISO         = $dConfig[2];
	$serverClient          = $dConfig[3];
	$webSite                 = $dConfig[4];
	$operator                = $dConfig[5];
	
	include_once 'files_helper/get_numbers.php';
	$get_info            = get_numbers($app_code,$country_ISO,$serverClient);
	if(!is_array($get_info)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	if($get_info[0] != true){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	$price       = $get_info[1];
	### make all each 
	include_once 'files_helper/users_info.php';
	$cnn      = new user_config($Home['accounts'][$chat_id]['email']);
	$Balance = $cnn->getBalance();
	if($price > $Balance){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_BALANCE'],
		'show_alert'=>true,
		]);
		exit;
	}
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	$get_number       = $connect->getNumber(substr($app_code,0,2),$country_ISO,$operator);
	if(!is_array($get_number)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_SERVICE'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($get_number[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_NUMBERS'],
		'show_alert'=>true,
		]);
		
		$keyboard     = make_buttons("try{$data}"=>'Try 10x');
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>'No Numbers !',
		'reply_markup'=>json_encode($keyboard)
		exit;
	}
	
	$Handle        = $get_number[1];
	$Number       = $Handle['PHONE'];
	if(!preg_match("/^\+/",$Number)){
		$Number    = '+'.$Number;
	}
	$op_ID            = $Handle['ID'];
	$country         = $countries_names[$country_ISO];
	$app_name    = $apps_code_name[$app_code];
	
	$respi    = ['++P++','++IDT++','++NUMBER++','++CODE++','++AN++'];
	$resbi    = [$price,$op_ID,$Number,'*.....*',$add_apps[$app_code]];
	$respo   = str_replace($respi,$resbi,$text_buy['buy']);
	
	$cnn->delBalance($price);
	include_once 'functions.php';
	$extra       = "{$app_code}_{$country_ISO}_{$op_ID}_{$webSite}_{$price}_{$Number}";
	#$next_button  = ['get-code_','cancel-order_'];
	#$next_info       = ['get-code_'=>$op_ID,'cancel-order_'=>$op_ID];
	#$keyboard      = make_buttons($buttons_buy,'H','','',$next_button,$next_info);
	$ICX    = [];
	if($app_code == 'wa'){
		$ICX["https://wa.me/{$Number}"]  = $buttons_buy['view_on'];
	}
	
	$notice_t    = ['++N++','++C++','++CC++','++APP++','++B++','++ID++','++P++','++M++','++S++'];
	$notice_v    = [$Number,$country,$country_ISO,$app_name,$cnn->getBalance(),$chat_id,$price,$Home['accounts'][$chat_id]['email'],$webSite];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['buy']);
	$bot->sendMessage([
	'chat_id'=>$buyBanID,
	'text'=>$notice_f,
	]);
	
	$ICX["get-code_{$op_ID}"]                  = $buttons_buy['refresh'];
	$ICX["cancel-order_{$op_ID}"]           = $buttons_buy['cancel'];
	$ICX["cancel-orders_{$op_ID}"]         = $buttons_buy['back'];
	$keyboard      = make_buttons($ICX,'V');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status['buying'][$chat_id][$op_ID]       = [
	'extra'=>$extra,
	'data'=>$data,
	'price'=>$price,
	'mode'=>'all',
	'time'=>time(),
	];
	$timed_db->setData($Status);
	exit;
}

if(preg_match("/get\-code\_(.+)/",$data,$hConfig)){
	if(!is_array($Status['buying'][$chat_id])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if(!array_key_exists($hConfig[1],$Status['buying'][$chat_id])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($Status['buying'][$chat_id][$hConfig[1]]['extra'] == null){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}/*
	$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>'works',
		'show_alert'=>true,
		]);*/
	$Hip       = $Status['buying'][$chat_id][$hConfig[1]]['extra'];
	$modeH = $Status['buying'][$chat_id][$hConfig[1]]['mode'];
	$tm          = $Status['buying'][$chat_id][$hConfig[1]]['time'];
	if(($hete = (int)time() - (int)$tm) >= 1200){
		if($tm > 144456654){
			$bot->answerCallBackQuery([
			'callback_query_id'=>$update->callback_query->id,
			'text'=>$problems['NO_TIME'],
			'show_alert'=>true,
			]);
			exit;
		}
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	preg_match("/([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_(.+)/",$Hip,$dConfig);
	$webSite                = $dConfig[4];
	$op_ID                    = $dConfig[3];
	$app_code             = $dConfig[1];
	$country_ISO         = $dConfig[2];
	$Number                 = $dConfig[6];
	$Price                       = $dConfig[5];
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	$get_code      = $connect->getCode($op_ID);
	if(!is_array($get_code)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($get_code[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_CODE'],
		'show_alert'=>false,
		]);
		exit;
	}
	
	$country         = $countries_names[$country_ISO];
	$app_name    = $apps_code_name[$app_code];
	
	
	$code_verfiy        = $get_code[1]['CODE'];
	/*
	$bot->answerCallBackQuery([
	'callback_query_id'=>$update->callback_query->id,
	'text'=>'Code :- '.$code_verfiy,
	'show_alert'=>true,
	]);
	#exit;
	*/
	
	$respi    = ['++APP++','++COUNTRY++','++NUMBER++','++CODE++'];
	$resbi    = [$app_name,$country,$Number,$code_verfiy];
	$respo   = str_replace($respi,$resbi,$text_buy['coded']);
	
	include_once 'files_helper/users_info.php';
	$cnn      = new user_config($Home['accounts'][$chat_id]['email']);

	if($modeH == 'all'){
		$cnn->addNewNumber($Number,$code_verfiy,$app_code);
	} else if($modeH == 'show'){
		$cnn->addShowNumber($Number,$code_verfiy,$app_code);
	}
	$cnn->delBalance($Price,'Jello');
	include_once 'files_helper/system.php';
	$Bconnect        = new OS_jello('GENERAL');
	$Bconnect->onReady('SALE',$Price);
	$Bconnect->onReady('FULL',1);
	include_once 'functions.php';
	$DDZ       = [];
	$op_ID    = $hConfig[1];
	
	$notice_t    = ['++N++','++C++','++CC++','++APP++','++B++','++ID++','++P++','++M++','++S++','++CODE++'];
	$notice_v    = [$Number,$country,$country_ISO,$app_name,$cnn->getBalance(),$chat_id,$Price,$Home['accounts'][$chat_id]['email'],$webSite,$code_verfiy];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['full']);
	$bot->sendMessage([
	'chat_id'=>$fullID,
	'text'=>$notice_f,
	]);
	
	$subn      = substr($Number,0,5);
	$xcn        = strlen($Number) - 5;
	$poin       = '';
	for($xc=0;$xcn>$xc;$xc++){
		$poin .= '*';
	}
	
	$fnum   = $subn.$poin;
	$bot->sendMessage([
	'chat_id'=>$fullID2,
	'text'=>"Full request
Number :- {$fnum}
Code :- {$code_verfiy}
Country :- {$country}
Service :- {$app_name}
Price :- {$Price}"]);
	$DDZ["tryGetCode#{$op_ID}"]        = $success_buttns["tryGetCode"];
	$DDZ["finishID#{$op_ID}"]               = $success_buttns["finishID"];
	$DDZ["back_"]                                     = $try_nus['back_'];
	
	$keyboard       = make_buttons($DDZ,'V');
	
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status['buying'][$chat_id][$hConfig[1]]['code']  = $code_verfiy;
	unset($Status['buying'][$chat_id][$hConfig[1]]['price']);
	$timed_db->setData($Status);
	exit;
}

if(preg_match("/^tryGetCode\#(.+)$/",$data,$configs)){
	$op_ID        =  $configs[1];
	if(!is_array($Status['buying'][$chat_id])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if(!array_key_exists($op_ID,$Status['buying'][$chat_id])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($Status['buying'][$chat_id][$op_ID]['extra'] == null){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	$Hip       = $Status['buying'][$chat_id][$op_ID]['extra'];
	$modeH = $Status['buying'][$chat_id][$op_ID]['mode'];
	$tm          = $Status['buying'][$chat_id][$op_ID]['time'];
	if(($hete = (int)time() - (int)$tm) >= 1200){
		if($tm > 144456654){
			$bot->answerCallBackQuery([
			'callback_query_id'=>$update->callback_query->id,
			'text'=>$problems['NO_TIME'],
			'show_alert'=>true,
			]);
			exit;
		}
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	preg_match("/([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_(.+)/",$Hip,$dConfig);
	$webSite                = $dConfig[4];
	$op_ID                    = $dConfig[3];
	$app_code             = $dConfig[1];
	$country_ISO         = $dConfig[2];
	$Number                 = $dConfig[6];
	$Price                       = $dConfig[5];
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	$get_code      = $connect->getCode($op_ID);
	if(!is_array($get_code)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if($get_code[0] == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_CODE'],
		'show_alert'=>false,
		]);
		exit;
	}
	$code_verfiy        = $get_code[1]['CODE'];
	$pCode                 = $Status['buying'][$chat_id][$op_ID]['code'];
	if($code_verfiy == $pCode){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_CODE'],
		'show_alert'=>false,
		]);
		exit;
	}
	$respo     =  str_replace(['++N++','++C++'],[$Number,$code_verfiy],$problems['RESENDED']);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respo,
	'parse_mode'=>'MarkDown',
	]);
	$Status['buying'][$chat_id][$op_ID]['code']  = $code_verfiy;
	$timed_db->setData($Status);
	exit;
}
if(preg_match("/cancel\-orders?\_(.+)/",$data,$hConfig)){
	if(!is_array($Status['buying'][$chat_id])){
		exit;
	}
	if(!array_key_exists($hConfig[1],$Status['buying'][$chat_id])){
		exit;
	}
	if($Status['buying'][$chat_id][$hConfig[1]]['extra'] == null){
		exit;
	}
	
	$Hip       = $Status['buying'][$chat_id][$hConfig[1]]['extra'];
	$iDT        = $Status['buying'][$chat_id][$hConfig[1]]['data'];
	$modeH = $Status['buying'][$chat_id][$hConfig[1]]['mode'];
	$Price      = $Status['buying'][$chat_id][$hConfig[1]]['price'] ?? 0;
	$tm          = $Status['buying'][$chat_id][$hConfig[1]]['time'];
	$rom        = 60;
	if(($hete = (int)time() - (int)$tm) >= 1200){
		if($tm > 144456654){
			$bot->answerCallBackQuery([
			'callback_query_id'=>$update->callback_query->id,
			'text'=>$problems['NO_TIME'],
			'show_alert'=>true,
			]);
			exit;
		}
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	preg_match("/([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_([^\_]+)\_(.+)/",$Hip,$dConfig);
	$webSite                = $dConfig[4];
	if($webSite == 'fastpva.com'){
		if($rom > ((int)time() - (int)$tm)){
			$ramk = ((int)time() - (int)$tm);
			$bot->answerCallBackQuery([
			'callback_query_id'=>$update->callback_query->id,
			'text'=>str_replace('++S++',$rom - $ramk,$problems['WAIT']),
			'show_alert'=>true,
			]);
			exit;
		}
	}
	$op_ID                    = $dConfig[3];
	$app_code             = $dConfig[1];
	$country_ISO         = $dConfig[2];
	$Number                 = $dConfig[6];
	#$Price                       = $dConfig[5];
	
	include_once 'files_helper/control_site.php';
	$connect        = get_aclass($webSite);
	if($connect == false){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	$get_code      = $connect->cancelNumber($op_ID);
	if(!is_array($get_code)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_DATA'],
		'show_alert'=>true,
		]);
		exit;
	}
	if(($hete = (int)time() - (int)$tm)){
		$xz     = 1200;
		if($xz > $hete){
			if($get_code[0] == false){
				$bot->answerCallBackQuery([
				'callback_query_id'=>$update->callback_query->id,
				'text'=>$problems['NO_CANCEL'],
				'show_alert'=>true,
				]);
				exit;
			} else {
				include_once 'files_helper/users_info.php';
				$cnn      = new user_config($Home['accounts'][$chat_id]['email']);
				$cnn->addBalance($Price);
				$rapid        = "\n".str_replace('++P++',$Price,$problems['NO_RESTRICTE']);
			}
		} else {
			$uss     = ['++S++','++P++','++TGNAME++','++MAIL++','++N++'];
			$uff       = [$webSite,$Price,"[{$first_name}](tg://user?id={$from_id})",$Home['accounts'][$chat_id]['email'],$Number];
			$cont    = str_replace($uss,$uff,$problems['CHECK']);
			$bot->sendMessage([
			'chat_id'=>$IDcontrol,
			'text'=>$cont,
			]);
			$rapid        = "\n".str_replace('++P++',$Price,$problems['NO_RETURN']);
		}
	}
	
	$country         = $countries_names[$country_ISO];
	$app_name    = $apps_code_name[$app_code];
	/*
	$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>'No_Problems_!?',
		'show_alert'=>true,
		]);
		*/
		#exit;
	
	#$code_verfiy        = $get_code[1]['CODE'];
	
	#$respi    = ['++APP++','++COUNTRY++','++NUMBER++','++CODE++'];
	#$resbi    = [$app_name,$country,$Number,'×××××'];
	include_once 'functions.php';
	
	$getTime    = get_time_accent();
	$tDate         = $getTime[1]." ".$posts_text['time'][$getTime[2]];
	$nDate        = $getTime[0];
	$respi          = ['++NUMBER++','++DATE++','++TIME++'];
	$resbi          = [$Number,$nDate,$tDate];
	$respo         = str_replace($respi,$resbi,$text_buy['cancel']);
	$ICX             = [];
	$ICX["{$iDT}"]  = str_replace('++P++',$Price,$try_nus['try_buy']);
	
	$notice_t    = ['++N++','++C++','++CC++','++APP++','++B++','++ID++','++P++','++M++','++S++'];
	$notice_v    = [$Number,$country,$country_ISO,$app_name,$cnn->getBalance(),$chat_id,$Price,$Home['accounts'][$chat_id]['email'],$webSite];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['ban']);
	$bot->sendMessage([
	'chat_id'=>$buyBanID,
	'text'=>$notice_f,
	]);
	
	if($modeH != 'show'){
		$ICX["select_server_{$app_code}_{$country_ISO}"]  = str_replace('++APP++',$apps_code_name[$app_code],$try_nus['to_back']);
	} else {
		$ICX["all_shows"]           = $home_buttons['all_shows'];
	}
	$ICX["select_app"]     = $try_nus['select_app'];
	$ICX["back_"]     = $try_nus['back_'];
	$keyboard          = make_buttons($ICX,'V');
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respo.$rapid,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status['buying'][$chat_id][$hConfig[1]]);
	$timed_db->setData($Status);
	exit;
}

if($data == 'change_password'){
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text[$data],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}
if($text && $Status[$chat_id]['status'] == 'change_password'){
	include_once 'functions.php';
	if(!preg_match("/^[a-zA-Z0-9]{6,12}$/",$text)){
		$min        = 6;
		$max       = 12;
		if($min > strlen(trim($text))){
			$erN       = 'pw_short';
		} else if(strlen(trim($text)) > $max){
			$erN       = 'pw_tall';
		} else {
			$erN       = 'pw_bad';
		}
		
		$keyboard       = make_buttons($back_home);
		$bot->sendMessage([
		'chat_id'=>$chat_id,
		'text'=>$posts_text['errors'][$erN],
		'parse_mode'=>'MarkDown',
		'reply_to_message_id'=>$message_id,
		'reply_markup'=>json_encode($keyboard)
		]);
		unset($Status[$chat_id]['status']);
		$timed_db->setData($Status);
		exit;
	}
	
	$tuser         = $from->username == true ? '@'.$from->username : $notfounfs;
	$notice_t    = ['++M++','++PW++','++ID++','++NAME++','++U++'];
	$notice_v    = [$Home['accounts'][$chat_id]['email'],$text,$chat_id,$first_name,$tuser];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['changePW']);
	$bot->sendMessage([
	'chat_id'=>$cardsID,
	'text'=>$notice_f,
	]);
		
	#$new_password    = make_password();
	include_once 'files_helper/users_info.php';
	$connect_pw          = new user_config($Home['accounts'][$chat_id]['email']);
	$connect_pw->setPassword($text);
	$keyboard       = make_buttons($back_home);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>str_replace('++PW++',$text,$posts_text['change_password2']),
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]['status']);
	$timed_db->setData($Status);
	exit;
}

if($data == 'ready_numbers'){
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$$posts_text['add_follow'],
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode(make_buttons($start_buttons,'V{0}H{2}'))
	]);
	exit;
}

if($data == 'logout'){
	include_once 'functions.php';
	$new_password    = make_password();
	include_once 'files_helper/users_info.php';
	$MyMail                  = $Home['accounts'][$chat_id]['email'];
	$connect_pw          = new user_config($MyMail);
	$connect_pw->setPassword($new_password);
	$connect_pw->setOwner('');
	$respa         = str_replace(['++MAIL++','++PW++'],[$MyMail,$new_password],$posts_text[$data]);
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>'MarkDown',
	]);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$textStart,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode(make_buttons($start_buttons,'V{0}H{2}'))
	]);
	$Home['accounts'][$chat_id]['email']     = null;
	$home_db->setData($Home);
	exit;
}

if(preg_match("/^cardu?\_([0-9]{2,3})\_([0-9\.]{2,5})P$/",$data,$info_c)){
	$dis_b     = $info_c[2];
	$card_b   = $info_c[1];
	$comfirm_buttons["Yes_{$data}"] = $comfirm_buttons["Yes_"];
	$comfirm_buttons["cards_store"] = $back_home['back_'];
	unset($comfirm_buttons["Yes_"]);
	include_once 'functions.php';
	$mButtons      = make_buttons($comfirm_buttons,'V{0}H{2}');
	$response       = str_replace(['++P++','++B++'],[$dis_b,$card_b],$posts_text['confirmBuyCard']);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$response,
	'parse_mode'=>"MarkDown",
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($mButtons),
	]);
	exit;
}
	
if(preg_match("/^Yes_cardu?\_([0-9]{2,3})\_([0-9\.]{2,5})P$/",$data,$info_c)){
	$dis_b     = $info_c[2];
	$card_b   = $info_c[1];
	if($card_b >= $dis_b){
		exit;
	}
	$MyMail        = $Home['accounts'][$chat_id]['email'];
	include_once 'files_helper/users_info.php';
	$connect_b          = new user_config($MyMail);
	if($dis_b > $connect_b->getBalance()){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$problems['NO_BALANCE'],
		'show_alert'=>true,
		]);
		exit;
	}
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text['loading']['buyCard'],
	'parse_mode'=>"MarkDown",
	'message_id'=>$message_id,
	]);
	$connect_b->delBalance($dis_b);
	$connect_b->addingCard($text);
	
	
	
	include_once 'files_helper/system.php';
	$Aconnect        = new OS_jello('CARDS');
	$card                  = $Aconnect->addCard($card_b,$MyMail);
	$Bconnect        = new OS_jello('GENERAL');
	$Bconnect->onReady('CARDS',1);
	$respa                = str_replace(['++B++','++C++'],[$card_b,$card],$posts_text['doneBuoghtCard']);
	
	$notice_t    = ['++M++','++B++','++ID++','++CN++','++CP++','++P++'];
	$notice_v    = [$MyMail,$connect_b->getBalance(),$chat_id,$card,$card_b,$dis_b];
	$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['buyCard']);
	$bot->sendMessage([
	'chat_id'=>$cardsID,
	'text'=>$notice_f,
	]);
	
	$Abutton            = [];
	$Abutton['inline_keyboard'][0][] = ['text'=>$bought_Buttons['cards_store'],'callback_data'=>'cards_store'];
	$Abutton['inline_keyboard'][1][] = ['text'=>str_replace('++P++',$card_b,$bought_Buttons['try_cards_']),'callback_data'=>str_replace('Yes_','',$data)];
	$Abutton['inline_keyboard'][2][] = ['text'=>$back_home['back_'],'callback_data'=>'back_'];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$respa,
	'parse_mode'=>'MarkDown',
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($Abutton)
	]);
	exit;
}

if($data == 'favourites'){
	$home_db         = new database('home.json');
	$Home               = $home_db->fetch_data();
	if(!is_array($Home['wakeel'])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$foundition_texts['noAgents'],
		'show_alert'=>true,
		]);
		exit;
	}
	$awn     = 1;
	if($awn > count($Home['wakeel'])){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$foundition_texts['noAgents'],
		'show_alert'=>true,
		]);
		exit;
	}
	
	include_once 'files_helper/users_info.php';
	$agents           = $Home['wakeel'];
	$agName        = '';
	$agentsArray = [];
	$logurl             = '';
	$agUser           = '';
	$connect         = '';
	$ownered        = '';
	foreach($agents as $agMail=>$agInfo){
		$connect     = new user_config($agMail);
		$ownered    = $connect->getOwner();
		if($ownered != true){
			continue;
		}
		$infoD     = $bot->getChatMember([
			'chat_id'=>$ownered,
			'user_id'=>$ownered,
		]);
		if($infoD->result != false){
			if($infoD->result->user->username != false){
				$agName     = $infoD->result->user->first_name;
				$agUser        = $infoD->result->user->username;
			} else {
				continue;
			}
		} else {
			continue;
		}
		$logurl         = "https://t.me/{$agUser}";
		$agentsArray['inline_keyboard'][] = [['text'=>$agName,'url'=>$logurl],['text'=>$agMail,'url'=>$logurl]];
	}
	if($awn > count($agentsArray)){
		$bot->answerCallBackQuery([
		'callback_query_id'=>$update->callback_query->id,
		'text'=>$foundition_texts['noAgents'],
		'show_alert'=>true,
		]);
		exit;
	}
	$agentsArray['inline_keyboard'][]      = [['text'=>$back_home['back_'],'callback_data'=>'back_']];
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text[$data],
	'parse_mode'=>"MarkDown",
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($agentsArray)
	]);
	exit;
}
	
	

if($data == 'input_card'){
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$posts_text[$data],
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	$Status[$chat_id]['status']    = $data;
	$timed_db->setData($Status);
	exit;
}

if($text && $Status[$chat_id]['status'] == 'input_card'){
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	if(preg_match("/^[A-Z][A-Z0-9]{20}$/",$text)){
		include_once 'files_helper/system.php';
		$connect      = new OS_jello('CARDS');
		$card             = $connect->getCard($text);
		if($card != false){
			$price         = $card['price'];
			$myEmail   = $Home['accounts'][$chat_id]['email'];
			include_once 'files_helper/users_info.php';
			$connectS     = new user_config($myEmail);
			$Balance        = $connectS->getBalance();
			#$connectS->addBalance($price);
			#$connect->delCard($text);
	
	
			$comfirm_buttons["Yes_{$text}"] = $comfirm_buttons["Yes_"];
			$comfirm_buttons["add_balance"] = $back_home['back_'];
			unset($comfirm_buttons["Yes_"]);
			$keyboard      = make_buttons($comfirm_buttons,'V{0}H{2}');
			$resp         = str_replace(['++C++','++P++','++BALANCE++'],[$text,$price,$Balance],$posts_text['confirmChargeCard']);
		} else {
			$resp        = $resp_other['used_card'];
		}
	}
	else {
		$resp        = $resp_other['used_card'];
	}
	$bot->sendMessage([
	'chat_id'=>$chat_id,
	'text'=>$resp,
	'parse_mode'=>"MarkDown",
	'reply_to_message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	unset($Status[$chat_id]);
	$timed_db->setData($Status);
	exit;
}

if(preg_match("/^Yes_(.+)$/",$data,$infoText)){
	$text       = $infoText[1];
	include_once 'functions.php';
	$keyboard       = make_buttons($back_home);
	if(preg_match("/^[A-Z][A-Z0-9]{20}$/",$text)){
		include_once 'files_helper/system.php';
		$connect      = new OS_jello('CARDS');
		$card             = $connect->getCard($text);
		if($card != false){
			$price         = $card['price'];
			$cOwner    = $card['owner'];
			$myEmail   = $Home['accounts'][$chat_id]['email'];
			include_once 'files_helper/users_info.php';
			$connectS     = new user_config($myEmail);
			$Balance        = $connectS->getBalance();
			$connectS->addBalance($price);
			$connect->delCard($text);
			
			$notice_t    = ['++CHM++','++B++','++ID++','++C++','++OM++','++P++'];
			$notice_v    = [$myEmail,$connectS->getBalance(),$chat_id,$text,$cOwner,$price];
			$notice_f     = str_replace($notice_t,$notice_v,$notices_texts['chargeCard']);
			$bot->sendMessage([
			'chat_id'=>$cardsID,
			'text'=>$notice_f,
			]);
			
			$resp         = str_replace(['++P++','++BALANCE++'],[$price,$Balance+$price],$posts_text['doneChargedCard']);
			if($cOwner != 'Admin' && $cOwner != false){
				$connectO  = new user_config($cOwner);
				$mCard       = $connectO->getOwner();
				$resala        = str_replace(['++P++','++C++','++CHARGERNAME++'],[$price,$text,"[{$first_name}](tg://user?id={$chat_id})"],$posts_text['doneChargedCard2']);
				$bot->sendMessage([
				'chat_id'=>$mCard,
				'text'=>$resala,
				'parse_mode'=>"MarkDown",
				]);
			}
		} else {
			$resp        = $resp_other['used_card'];
		}
	}
	else {
		exit;
	}
	$bot->editMessageText([
	'chat_id'=>$chat_id,
	'text'=>$resp,
	'message_id'=>$message_id,
	'reply_markup'=>json_encode($keyboard)
	]);
	exit;
}





?>