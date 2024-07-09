<?php


function data_push($mail,$text,$data){
	global $bot;
	if($data == 'invite_users'){
		include_once 'files_helper/users_info.php';
		$connect     = new user_config($mail);
		$Hash          = $connect->getHashCode();
		$myUser     = $bot->getMe()->result->username;
		include_once 'files_helper/system.php';
		$setup         = new OS_jello();
		$invite          = $setup->getInviteBalance();
		return str_replace(['++HASHMAIL++','++UBOT++','++INVITE++'],[$Hash,$myUser,$invite],$text);
	} else if($data == 'add_balance'){
		include_once 'files_helper/users_info.php';
		$connect     = new user_config($mail);
		$Wallet          = $connect->getWallet();
		global $admin;
		return str_replace(['++HASHKEYWALLET++','++ADMINUSER++'],[$Wallet,"[{$admin}]"],$text);
	} else if($data == 'my_recent'){
		include_once 'files_helper/users_info.php';
		$connect     = new user_config($mail);
		$Balance     = $connect->getBalance();
		$Sold            = $connect->getSoldBalance();
		$Full              = count($connect->getAnother('numbers')['bought']) ?? 0;
		$Shows         = count($connect->getAnother('numbers')['shows']) ?? 0;
		$Ready          = count($connect->getAnother('numbers')['ready']) ?? 0;
		$Cards           = count($connect->getAnother('cards')) ?? 0;
		$Try                 = $connect->getAnother('try') ?? 0;
		
		$truth_text       = ['++FULL++','++CARDSBOUGHT++','++READYBOUGHT++','++BALANCE++','++SALE++','++TRY++'];
		$rep_text          = [$Full+$Shows,$Cards,$Ready,$Balance,$Sold,$Try];
		return str_replace($truth_text,$rep_text,$text);
	} else {
		return $text;
	}
}
		
		

function  INSERT_DATA($text,$opreat,$id=null){
	global $emails_db;
	global $Home;
	
	if($opreat == 'fast'){
		return str_replace('++NBOT++',$Home['my_info']['bot_name'],$text);
	}
	#global $users_db;
	$Emails                        = [];
	$Emails                        = $emails_db->fetch_data();
	
	#$Emails['accounts']   = [];
	
	#$Users             = $Emails['emails'][$Home['accounts'][$id]['email']]
	#$Users             = [];
	#$Users[$id]     = [];
	$user                = $Emails['emails'][$Home['accounts'][$id]['email']];
	switch ($opreat){
		case 'Menu':
		$nbot        = $Home['my_info']['bot_name'];
		$channel  = $Home['my_info']['channel'];
		$email       = $Home['accounts'][$id]['email'];
		$balance   = $user['balance'];
		$sale          = $user['sold_balance'];
		
		$truth_text        = ['++NBOT++','++EMAIL++','++BALANCE++','++SALE++','++ID++','++CHANNEL++'];
		$placed_text     = [$nbot,$email,$balance,$sale,$id,$channel];
		
		$replaced      = str_replace($truth_text,$placed_text,$text);
		break;
		
		case 'select_server':
		global $countries_names;
		global $apps_code_name;
		## $id     = ['any_text','WA','RU'];
		$truth_text       = ['++COUNTRY++','++APPNAME++'];
		$placed_text    = [$countries_names[$id[2]],$apps_code_name[$id[1]]];
		
		$replaced      = str_replace($truth_text,$placed_text,$text);
		break;
		
		case 'invite_users':
		
		$ubot        = $Home['my_info']['bot_username'];
		$invite       = $Home['my_info']['balance_invite'];
		$hMail       = $user['hash_invite'];
		
		$truth_text       = ['++INVITE++','++UBOT++','++HASHMAIL++'];
		$placed_text   = [$invite,$ubot,$hMail];
		
		$replaced      = str_replace($truth_text,$placed_text,$text);
		break;
		
		case 'my_recent':
		
		$cards       = count($user['cards']);
		$ready       = count($user['numbers']['ready']);
		$full            = count($user['numbers']['bought']) + count($user['numbers']['shows']) + $ready;
		$balance   = $user['balance'];
		$sale          = $user['sold_balance'];
		$try             = $user['try'];
		
		$truth_text       = ['++FULL++','++CARDSBOUGHT++','++READYBOUGHT++','++BALANCE++','++SALE++','++TRY++'];
		$placed_text   = [$full,$cards,$ready,$balance,$sale,$try];
		
		$replaced      = str_replace($truth_text,$placed_text,$text);
		break;
		
		case 'add_balance':
		
		$owner_user    = $Home['my_info']['admin_username'];
		$wallet               = $user['wallet'];
		
		$truth_text       = ['++ADMINUSER++','++HASHKEYWALLET++'];
		$placed_text   = [$owner_user,$wallet];
		
		$replaced      = str_replace($truth_text,$placed_text,$text);
		break;
		
		### other exceptions
		
	}
	return $replaced;
}

/*
class INSERT_DATA {
	public function insert_data($text){
		$DBH                 = $this->db_handle;
		if($this->info != null){
			$id                  = $this->info->id;
			$balance       = $this->db_info[$id]['balance'];
			$email            = $this->db_info[$
		$truth_text        = $this->truth_text;
		$placed_text     = [$DBH->name_bot,$DBH


$tes = "👨‍✈️ ⁞ أهلا بك في القائمة الرئيسية. 🏡\n👨‍✈️ ⁞ هذه تفاصيل حسابك في بوت ++NBOT++. ⬇️\n\n📧 ⁞ إيميلك: ++EMAIL++ 🌚🌙.\n💰 ⁞ رصيدك: ₽ ++BALANCE++🌻🙂.\n💸 ⁞ عدد الروبل المصروف : ++SALE++ 💰\n🆔 ⁞ الأيدي: ++ID++\n☑️ ⁞ قناة البوت الرسمية: ++CHANNEL++\n🎬 ⁞ قم بالتحكم بالبوت الأن عبر الضعط على الأزرار.";

echo INSERT_DATA($tes,'Menu',"700");
*/


?>