<?php


date_default_timezone_set('Asia/Aden');

include_once 'regEx.php';
include_once "dbControl.php";

include_once 'info.php';

$myURL    = $_SERVER['SERVER_NAME'].$_SERVER['SCRIPT_NAME'];
$url            = "https://api.telegram.org/bot{$bot_API_KEY}/setWebHook?url={$myURL}";

file_get_contents($url);

include_once "telegram_bot.php";
/*
if(preg_match("/^\{/",$argv[1])){
	$update                       = json_decode($argv[1]) ?? [];
}
*/

$update = json_decode(file_get_contents('php://input'));

if($update != null){
	include_once 'variables.php';
	include_once 'mybot.php';
	exit;
}
exit;



?>