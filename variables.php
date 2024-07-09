<?php

#include 'dbControl.php';

/*
if(preg_match("/^\{/",$argv[1])){
	$update                       = json_decode($argv[1]) ?? [];
}
*/

/*
$update = json_decode(file_get_contents('php://input'));
*/
if(isset($update->message) || isset($update->callback_query)){
	$message      = $update->message;
	$text                = $message->text ?? false;
	$data               = $update->callback_query->data;
	$from              = $message->from ?? $update->callback_query->from;
	$chat               = $message->chat ?? $update->callback_query->message->chat;
	$message_id = $message->message_id ?? $update->callback_query->message->message_id;
	$from_id          = $from->id;
	$chat_id           = $chat->id;
	$first_name     = $from->first_name;
	$last_name      = $from->last_name ?? false;
	$username       = $from->username ?? false;
	$type                 = $chat->type;
	$contact           = $message->contact ?? false;
	$caption           = $message->caption ?? null;
	$reply            = $message->reply_to_message ?? false;
}

$home_db         = new database('home.json');
$timed_db         = new database('timed_store.json');
$users_db         = new database('users_info.json');
$emails_db       = new database('emails.json');
$tw_database    = new database('support.json');
#$Home  = [];
#$Status = [];

$Home               = $home_db->fetch_data();
if(!is_array($Home['accounts'])){
	$Home['accounts']      = [];
}
$Emails              = $emails_db->fetch_data();

if(!is_array($Emails['invites'])){
	$Emails['invites']          = [];
}
$Status              = $timed_db->fetch_data();
$Tawasol            = $tw_database->fetch_data();

if(in_array(strtoupper("@{$username}"),$otherMangers)){
	$manger       = strtoupper("@{$username}");
}

/*
$Emails['emails']['ep@jello.net'] = [
'balance'=>100,
'sold_balance'=>200
];

$emails_db->setData($Emails);
*/

/*
$id = 700;

$Home['my_info']['bot_name'] = 'Jello ys';
$Home['my_info']['channel']    = '@phpxx';
$Home['accounts'][$id]['email'] = 'ep@jello.net';

$home_db->setData($Home);
*/

?>