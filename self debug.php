<?php

ini_set('memory_limit', '1024M');
if(!is_dir('files')){mkdir('files');}
if(!file_exists('madeline.php')){copy('https://phar.madelineproto.xyz/madeline.php', 'madeline.php');}
if(!file_exists('online.txt')){file_put_contents('online.txt','off');}
include 'madeline.php';
$settings = [];
$settings['logger']['max_size'] = 5*1024*1024;
$MadelineProto = new \danog\MadelineProto\API('Code_Compiler.madeline', $settings);
$MadelineProto->start();
if(file_get_contents('online.txt') == 'on'){
$MadelineProto->account->updateStatus(['offline' => false]);}
function closeConnection($message = 'Is Runinng...@Code_Compiler:) '){if (php_sapi_name() === 'cli' || isset($GLOBALS['exited'])) {return;}
  @ob_end_clean();
  header('Connection: close');
  ignore_user_abort(true);
  ob_start();
  echo '<html><body><h1 style="margin-top:50px; text-align:center; color:white; text-shadow:1px 1px 15px black;">'.$message.'</h1></body</html>';
  $size = ob_get_length();
  header("Content-Length: $size");
  header('Content-Type: text/html');
  $GLOBALS['exited'] = true;}
function shutdown_function($lock){
  $a = fsockopen((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] ? 'tls' : 'tcp').'://'.$_SERVER['SERVER_NAME'], $_SERVER['SERVER_PORT']);
  fwrite($a, $_SERVER['REQUEST_METHOD'].' '.$_SERVER['REQUEST_URI'].' '.$_SERVER['SERVER_PROTOCOL']."\r\n".'Host: '.$_SERVER['SERVER_NAME']."\r\n\r\n");
  flock($lock, LOCK_UN);
  fclose($lock);}
if (!file_exists('bot.lock')) {touch('bot.lock');}
$lock = fopen('bot.lock', 'r+');
$try = 1;
$locked = false;
while (!$locked) {
$locked = flock($lock, LOCK_EX | LOCK_NB);
if (!$locked) {
closeConnection();
if ($try++ >= 30) {exit;}sleep(1);}}
if(!file_exists('data.json')){
 file_put_contents('data.json', '{"power":"on","adminStep":"","typing":"off","echo":"off","markread":"off","poker":"off","enemies":[],"answering":[]}');}
class EventHandler extends \danog\MadelineProto\EventHandler{
public function __construct($MadelineProto){parent::__construct($MadelineProto);}
public function onUpdateSomethingElse($update){
if (isset($update['_'])){
if ($update['_'] == 'updateNewMessage'){onUpdateNewMessage($update);}
else if ($update['_'] == 'updateNewChannelMessage'){onUpdateNewChannelMessage($update);}}}
public function onUpdateNewChannelMessage($update)
{
 yield $this->onUpdateNewMessage($update);
}
public function onUpdateNewMessage($update){
$from_id = isset($update['message']['from_id']) ? $update['message']['from_id']:'';
  try {
 if(isset($update['message']['message'])){
 $text = $update['message']['message'];
 $msg_id = $update['message']['id'];
 $message = isset($update['message']) ? $update['message']:'';
 $this = $this;
 $me = yield $this->get_self();
 
 $chID = yield $this->get_info($update);
 $peer = $chID['bot_api_id'];
 $type3 = $chID['type'];
 @$data = json_decode(file_get_contents("data.json"), true);
 $step = $data['adminStep'];
 $ADEFI=613932350;
 if($from_id ==$ADEFI){
 if($text == '/exit;'){
  exit;
 }
   if(preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text)){
     preg_match("/^[\/\#\!]?(bot) (on|off)$/i", $text, $m);
     $data['power'] = $m[2];
     file_put_contents("data.json", json_encode($data));
     $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ʙᴏᴛ ɴᴏᴡ ɪꜱ $m[2]"]);
   }
   if(preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $text)){
     preg_match("/^[\/\#\!]?(poker) (on|off)$/i", $text, $m);
     $data['poker'] = $m[2];
     file_put_contents("data.json", json_encode($data));
     $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴘᴏᴋᴇʀ ɴᴏᴡ ɪꜱ $m[2]"]);
   }
   if(preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text)){
  preg_match("/^[\/\#\!]?(online) (on|off)$/i", $text, $m);
  file_put_contents('online.txt', $m[2]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴏɴʟɪɴᴇ ᴍᴏᴅᴇ ɴᴏᴡ ɪꜱ $m[2]"]);
   }
   
 	if ($text == 'time' or $text=='ساعت'  or $text=='تایم') {
	    date_default_timezone_set('Asia/Tehran');
	yield $this->messages->sendMessage(['peer' => $peer, 'message' => ';)']);
	for ($i=1; $i <= 5; $i++){
	yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => date('H:i:s')]);
	yield $this->sleep(1);
	}
	}
	
if($text=='رقص مربع'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '💦💦💦💦💦💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
💜💙🧡❤️💛💚🤍🤎💝
🧡💛💚💝❤️💖🤍💙🤍💜🖤🤎❤️💙🤍💝🤍💛🤎🤍💖💛🧡💙💛🖤🤎💛💝💚🤍💙💜💛🧡💛💖💚🤍🤎💚💛💖💛💙💚💙💛💜🧡💖💚🧡💝❤️🤎💖❤️💛💚❤️💚🤎🧡💚💖🧡💛❤️🤍💛🤍💙🤍💛💜
']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
❤️🤎💖❤️💛💚❤️💚🤎💜💙🧡❤️💛💚🤍🤎💝💖💚🤍🤎💚💛💖💛❤️🤎💖❤️💛💚❤️💚🤎💜💙🧡❤️💛💚🤍🤎💝❤️🤎💖❤️💛💚❤️💚🤎💜💙🧡❤️💛💚🤍🤎💝💖💚🤍🤎💚💛💖💛💜💙🧡❤️💛💚🤍🤎💝
']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
❤️🖤❤️🖤❤️🖤❤️🖤❤️🖤❤️🖤❤️🤎💚❤️💚💛❤️💛❤️💚❤️💛❤️🧡🤎💛🤎💚🤎💚🤎💚🤎💚🤍🤎🤍🖤🤍🤍🖤💛🖤💛🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🧡💜💛💜💛💜💛💚💙💚💙💚💜💚💙💚💜💚💙💚💜💚💙💚💜💚💙💚💜💚💙💚
']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
❤️💚🤍💛🧡❤️💜💙🖤🤎🧡💛🤍🖤🤍💛🧡🧡💚💙🤍💛🖤🧡💛🤍💙💛🧡💛💜💚💛💙🧡❤️🧡💜🤍💙🤍💚💜❤️🤎🤎❤️🤎💛💚❤️🤍❤️🤍🤎💛💙💜🤍🤎🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤❤️🧡💚💜🤍💙🤍🖤💙🖤🧡
']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🖤❤️🧡🤎💚🤍💙🤍💜💛💚💙🤍💛💜💛💚💙🤍💛🧡💚💜🤍🤍💙💚💛🧡💛💜🤍🤍🤍🤍🤍💙💜💝❤️💜💚💙❤️💜🤎💖💚🤍💙💚💜🧡💛🤍💙🤍💚🖤🧡🖤🤍💚💛💚❤️🤍🤎💚🧡🖤💚💙🤍🖤💚💙🤍🖤💛💚💚💜🤍🤍💙🧡💚💚💙💛🧡🧡💙🧡💛💚💙
']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤🤍🖤
']);
}	
if($text=='pary' or $text=='پری'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '♨️😐pari ‼️ Arad 😐♨️']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂__________________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂________________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂______________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂_____________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂___________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂_________🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂______🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂____🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Arad🚶🏻‍♂_ 🚶‍♀pari']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🔱‼️Kos nane pari‼️🔱']);
}	
if($text=='ماشین' or $text=='car'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '🏓🚶🏻‍♂              🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂             🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂            🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂          🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂         🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂       🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂      🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂     🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂    🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂   🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂  🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🏓🚶🏻‍♂ 🏎']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🔱‼️Boom‼️🔱']);
}

if($text=='ساک' or $text=='suck'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '👄💦💦💦💦💦💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄💧💧💧💧💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄💧💧💧💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄💧💧💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄💧💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '👄']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🩸Bomm🩸']);
}

if($text=='جق' or $text=='jegh'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '💦💦💦💦💦💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💦💦💦💦💦💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💦💦💧💧💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💦💧💧💦💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💦💧']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💦']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🩸Bomm🩸']);
}
if($text=='زنبور' or $text=='vizviz'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌  ‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌ ‌   ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌‌ ‌ ‌ ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌ ‌ ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌   ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌  ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂   ‌ ‌ ‌  ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂     ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂ ‌   ‌ ‌‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂ ‌   ‌ ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂    ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂‌   ‌‌‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂  ‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🚶🏻‍♂‌🐝']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => 'Bomm❗️']);
}

if($text=='موتور' or $text=='motor'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '🧲__________________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲_______________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲______________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲____________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲___________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲__________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲_________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲________🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲______🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲_____🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲___🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲__🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🧲_🛵']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '💥']);

yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '🔥']);
}

if ($text == 'تاریخ شمسی') {
include 'jdf.php';
$fasl = jdate('f');
$month_name= jdate('F');
$day_name= jdate('l');
$tarikh = jdate('y/n/j');
$hour = jdate('H:i:s - a');
$animal = jdate('q');
yield $this->messages->sendMessage(['peer' => $peer, 'message' => "امروز  >( $day_name ) |$tarikh|<

ساعت : $hour

نام ماه : $month_name

نام فصل : $fasl

نام حیوان امسال : $animal"]);}

if($text=='kir' or $text=='کیر'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '
😂         😂
😂       😂
😂     😂
😂   😂
😂😂
😂   😂
😂      😂
😂        😂
😂          😂
😂            😂']);
yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂
😂
😂
😂
😂
😂
😂
😂
😂
😂']);
yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂😂😂
😂             😂
😂               😂
😂             😂
😂         😂
😂      😂
😂         😂
😂            😂
😂               😂
😂                  😂']);
yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂         😂
😂       😂
😂     😂
😂   😂
😂😂
😂   😂
😂      😂
😂        😂
😂          😂
😂            😂

😂
😂
😂
😂
😂
😂
😂
😂
😂
😂

😂😂😂
😂             😂
😂               😂
😂             😂
😂         😂
😂      😂
😂         😂
😂            😂
😂               😂
😂                  😂']);
}
 if($text=='bk' or $text=='بکیرم'){
yield $this->messages->sendMessage(['peer' => $peer, 'message' => '
😂😂😂
😂         😂
😂           😂
😂        😂
😂😂😂
😂         😂
😂           😂
😂           😂
😂        😂
😂😂😂']);
yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂         😂
😂       😂
😂     😂
😂   😂
😂😂
😂   😂
😂      😂
😂        😂
😂          😂
😂            😂']);
yield $this->messages->editMessage(['peer' => $peer, 'id' => $msg_id +1, 'message' => '
😂😂😂          😂         😂
😂         😂      😂       😂
😂           😂    😂     😂
😂        😂       😂   😂
😂😂😂          😂😂
😂         😂      😂   😂
😂           😂    😂      😂
😂           😂    😂        😂
😂        😂       😂          😂
😂😂😂          😂            😂']);
    
}
if ($text == 'تاریخ میلادی') {
date_default_timezone_set('UTC');
$rooz = date("l"); 
$tarikh = date("Y/m/d"); 
$mah = date("F"); 
$hour = date('H:i:s - A');
yield $this->messages->sendMessage(['peer' => $peer, 'message' => "today ( $rooz ) >|$tarikh|<

month name🌙: $mah

time⌚️: $hour"]);
} 
if ($text == "شمارش فا" ){
$fohshFA = [
  "لال شو دیگه نوچه","مادرتو میگام اف بشی","کیرم کون مادرت","کیرم کص مص مادرت بالا","کیرم تو چشو چال مادرت","کون مادرتو میگام بالا","بیناموس  خسته شدی؟","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","نبینم خسته بشی بیناموس","ننتو میکنم","کیرم کون مادرت 😂😂😂😂😂😂😂","صلف تو کصننت بالا","بیناموس بالا باش بهت میگم","کیر تو مادرت","کص مص مادرتو بلیسم؟","کص مادرتو چنگ بزنم؟","به خدا کصننت بالا ","مادرتو میگام ","کیرم کون مادرت بیناموس","مادرجنده بالا باش","بیناموس تا کی میخای سطحت گح باشه","اپدیت شو بیناموس خز بود","ای تورک خر بالا ببینم","و اما تو بیناموس چموش","تو یکیو مادرتو میکنم","کیرم تو ناموصت ","کیر تو ننت","ریش روحانی تو ننت","کیر تو مادرت😂😂😂","کص مادرتو مجر بدم","صلف تو ننت","بات تو ننت ","مامانتو میکنم بالا","وای این تورک خرو","سطحشو نگا","تایپ کن بیناموس","خشاب؟","کیرم کون مادرت بالا","بیناموس نبینم خسته بشی","مادرتو بگام؟","گح تو سطحت شرفت رف","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","بیناموس شرفتو نابود کردم یه کاری کن","وای کیرم تو سطحت","بیناموس روانی شدی","روانیت کردما","مادرتو کردم کاری کن","تایپ تو ننت","بیپدر بالا باش","و اما تو لر خر","ننتو میکنم بالا باش","کیرم لب مادرت بالا😂😂😂","چطوره بزنم نصلتو گح کنم","داری تظاهر میکنی ارومی ولی مادرتو کوص کردم","مادرتو کردم بیغیرت","هرزه","وای خدای من اینو نگا","کیر تو کصننت","ننتو بلیسم","منو نگا بیناموس","کیر تو ننت بسه دیگه","خسته شدی؟","ننتو میکنم خسته بشی","وای دلم کون مادرت بگام","اف شو احمق","بیشرف اف شو بهت میگم","مامان جنده اف شو","کص مامانت اف شو","کص لش وا ول کن اینجوری بگو؟","ای بیناموس چموش","خارکوصته ای ها","مامانتو میکنم اف نشی","گح تو ننت","سطح یه گح صفتو","گح کردم تو نصلتا","چه رویی داری بیناموس","ناموستو کردم","رو کص مادرت کیر کنم؟😂😂😂","نوچه بالا","کیرم تو ناموصتاا😂😂","یا مادرتو میگام یا اف میشی","لالشو دیگه","مامانتو کردم بیغیرت","و اما مادر جندت","تو یکی زیر باش","اف شو","خارتو کوص میکنم","کوصناموصد","ناموص کونی","خارکصته ی بۍ غیرت","شرم کن بیناموس","مامانتو کرد ","ای مادرجنده","بیغیرت","کیرتو ناموصت","بیناموس نمیخای اف بشی؟","ای خارکوصته","لالشو دیگه","همه کس کونی","حرامزاده","مادرتو میکنم","بیناموس","کصشر","اف شو مادرکوصته","خارکصته کجایی","ننتو کردم کاری نمیکنی؟","کیرتو مادرت لال","کیرتو ننت بسه","کیرتو شرفت","مادرتو میگام بالا","نمیزارم فرار کن مادرتو میگام","و اما تو کیرم کون مادرت میخای در بری داش","تورک خر","گوه ممبر بالا","گوه ترین ممبر جمهوری اسلامی یالا بالا بینم کیرم کون مادرت","شاگرد تا نزدم مادرتو بگام اف شو👽","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","کیر اندره تو کوس مادرت😂😂","کوسمادرت","بیا برو کوس مادرت گلم","این گوهو بن کنین","کیرم تو ناموست","بیا برو کوس مادرت گلم","کیرم تو مادرت","گوه تو مادرت😂😂","این گوهو","کیرم کوس موس مادرت","کیرم کون مادرت","این گوهو بن کنین","کیرم کون مادرتون","ننه سگو نگا","کیرم لب مادرت","کیرم تو پدرت گلم","کیرم کون مادر امیر نوچه","نوچه","کسننت😂😂","سلاخی کنم مادرتو😂😂😂","کوس مادرت بخورم","کیر برو بکس بیناموسا تو کسننت👽👽","کیر ممبران اکیپ بیناموسا تو کس ننت ☠️☠️","مادرتو میخورم","کیرم کون مادرتون😂😂😂😂","مادرتو😂😂😂","مادرت جندس آیا😂","کیر اق امیر نوچه تو مادرت","کیر برو بکس اهریمن تو کوس مادرت","کیر میلاد لور ابر کسلیس ممبر تل تو کوس مادرت😂😂😂😂","کیر میلاد لور ابر کسلیس ممبر تل تو کوس مادرت😂😂😂😂","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","بکل نوچه","نبینم بخای فرار کنی","مادرتو گاییدم","کیرم لب مادرت🥶","کوس مادرت بگام😱","ننت بخورم😴","کس ننه رو نگا","منو تو ننمون جندس داش","بیناموس شده در سال ۱۳۹۹ بیا نوچم شو کیرم کون مادرت با این سطح گوهت","خون کوس مادرتو میدم ارین نوچه بخوره یالا بالا","مایه ننگ و سر افکندگی ممبران گپ یالا بالا","کوس مادرتو میخورم مشکل؟!","مادرتو بکنم چیکار میکنی👽👽","کیر سینا گابریل عاشق تو کوس ننت👽👽","کیر اراد کورد تو کوس مادرت","مادرت جنده شده👻","کیرم تو ناموست🦷","کیرم لب مادرت🔞","مادرتو بخورم♨️♨️","آندره ممبرک دیل کن","۱","۲","۳","۴","۵","۶","۷","۸","۹","۱۰","اندره رو نگا","چقد اندره ای تو کیرم کون مادرت","نوچه تکساتو نمیخونم ادامه نده بتایپ","کیر تو مادرت"
  ];
  foreach($fohshEN as $fEN ){
  $this->messages->sendMessage(['peer' => $peer, 'message' => $fEN,]);
}}
if ($text == "شمارش ان" ){
$fohshFA = [
  "MADAR SAG BALA BASH","MADAR GAV BALA BASH","MADAR KHAR BALA BASH","MADAR KHAZ BALA BASH","MADAR HEYVUN BALA BASH","MADAR GORAZ BALA BASH","MADAR KROKODIL BALA BASH","MADAR SHOTOR BALA BASH","MADAR SHOTOR MORGH BALA BASH","MIKHAY TIZ BEGAMET HALA BEBI KHHKHKHKHK SORAATI NANATO MIKONAM","CHIYE KOS MEMBER BABT TAZE BARAT PC KHRIDE BI NAMOS MEMBER?","NANE MOKH AZAD NANE SHAM PAYNI NANE AROS MADAR KENTAKI PEDAR HALAZONI KIR MEMBERAK TIZ BASH YALA  TIZZZZZ😂","","FEK KONAM NANE NANATI NAGAIIDAM KE ENGHAD SHAKHHI????????????????????????????????????HEN NANE GANGANDE PEDAR LASHI","KIRAM TU KUNE NNT BALA BASH KIRAM TU DAHANE MADARET BALA BASH","to yatimi enghad to pv man daso pa mizani koskesh member man doroste nanato ye zaman mikardam vali toro beh kiramam nemigiram","KHARETO BE GA MIDAM BALA BASH","1","2","3","","4","5","6","7","8","9","10","1","2","3","4","5","6","7","8","9","10","1","2","3","4","5","6","7","8","9","10","1","2","3","4","5","6","7","8","9","10","NABINAM DIGE GOHE EZAFE BOKHORIA","KOS NANAT GAYIDE SHOD BINAMUS!!! SHOT SHODI BINAMUS!BYE","1","2","3","4","5","6","7","8","9","10"
	];
	foreach($fohshFA as $fFA ){
  $this->messages->sendMessage(['peer' => $peer, 'message' => $fFA,]);
}}

 if ($text == 'ping' or $text == '/ping' or $text == 'ربات' or $text == ' زبات' or $text == 'رباا' or $text == 'bot' or $text == 'Bot') {
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "🔱♨️b̷o̷t̷ i̷s̷ o̷n̷🔱♨️"]);
  }
  if ($text == 'load' or $text == '/load') {
$load = sys_getloadavg();
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "sᴇʀᴠᴇʀ ᴘɪɴɢ : $load[0]", 'parse_mode' => 'MarkDown']);
  }
  if ($text == 'number' or $text == 'شمارش') {
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "１"]);
sleep(0.5);
 $this->messages->sendMessage(['peer' => $peer, 'message' => "２",'id' => $msg_id +1]);
  sleep(0.5);
 $this->messages->sendMessage(['peer' => $peer, 'message' => "３",'id' => $msg_id +1]);
sleep(0.5);
 $this->messages->sendMessage(['peer' => $peer, 'message' => "４",'id' => $msg_id +1]);
sleep(0.5);
 $this->messages->sendMessage(['peer' => $peer, 'message' => "５",'id' => $msg_id +1]);
sleep(0.5);
$this->messages->sendMessage(['peer' => $peer, 'message' => "６",'id' => $msg_id +1]);
sleep(0.5);
$this->messages->sendMessage(['peer' => $peer, 'message' => "７",'id' => $msg_id +1]);
sleep(0.5);
$this->messages->sendMessage(['peer' => $peer, 'message' => "８",'id' => $msg_id +1]);
sleep(0.5);
$this->messages->sendMessage(['peer' => $peer, 'message' => "９",'id' => $msg_id +1]);
sleep(0.5);
$this->messages->sendMessage(['peer' => $peer, 'message' => "１０",'id' => $msg_id +1]);
}
  if($text == "for"){
foreach(range(1,480) as $t){
sleep(0);
$rand = rand(1,480);
yield $this->messages->forwardMessages(['from_peer' => "@fosh_namosii", 'to_peer' => $peer, 'id' => [$rand], ]);
}
}

 if(preg_match("/^[\/\#\!]?(setanswer) (.*)$/i", $text)){
$ip = trim(str_replace("/setanswer ","",$text));
$ip = explode("|",$ip."|||||");
$txxt = trim($ip[0]);
$answeer = trim($ip[1]);
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ɴᴇᴡ ᴡᴏʀᴅ ᴀᴅᴅᴇᴅ ᴛᴏ ʏᴏᴜʀ ᴀɴꜱᴡᴇʀ ʟɪꜱᴛ🏻"]);
}else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴡᴏʀᴅ ᴀʟʀᴇᴀᴅʏ ᴇxɪꜱᴛꜱ"]);
}
}
if(preg_match("/^[\/\#\!]?(php) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(php) (.*)$/i", $text, $a);
if(strpos($a[2], '$this') === false and strpos($a[2], '$this') === false){
$OutPut = eval("$a[2]");
$this->messages->sendMessage(['peer' => $peer, 'message' => "`🔻 $OutPut`", 'parse_mode'=>'markdown']);
}
}

if(preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(upload) (.*)$/i", $text, $a);
$oldtime = time();
$link = $a[2];
$ch = curl_init($link);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, TRUE);
curl_setopt($ch, CURLOPT_NOBODY, TRUE);
$data = curl_exec($ch);
$size1 = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD); curl_close($ch);
$size = round($size1/1024/1024,1);
if($size <= 200.9){
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '🌵 Please Wait...
💡 FileSize : '.$size.'MB']);
$path = parse_url($link, PHP_URL_PATH);
$filename = basename($path);
copy($link, "files/$filename");
yield $this->messages->sendMedia([
 'peer' => $peer,
 'media' => [
 '_' => 'inputMediaUploadedDocument',
 'file' => "files/$filename",
 'attributes' => [['_' => 'documentAttributeFilename',
 'file_name' => "$filename"]]],
 'message' => "🔖 Name : $filename
💠 [Your File !]($link)
💡 Size : ".$size.'MB',
 'parse_mode' => 'Markdown'
]);
$t=time()-$oldtime;
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "✅ ᴜᴘʟᴏᴀᴅᴇᴅ ($t".'s)']);
unlink("files/$filename");
} else {
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => '⚠️ خطا : حجم فایل بیشتر از 200 مگ است!']);
}
}
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $text);
$txxt = $text[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜᴇ ᴡᴏʀᴅ ᴡᴀꜱ ʀᴇᴍᴏᴠᴇᴅ ꜰʀᴏᴍ ᴛʜᴇ ᴀɴꜱᴡᴇʀ ʟɪꜱᴛ👌🏻"]);
}else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴡᴏʀᴅ ɪꜱ ᴍɪꜱꜱɪɴɢ ɪɴ ᴛʜᴇ ᴀɴꜱᴡᴇʀ ʟɪꜱᴛ :/"]);
 }
}
if($text == '/id' or $text == 'id'){
  if (isset($message['reply_to_msg_id'])) {
   if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
 $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => 'ʏᴏᴜʀɪᴅ : '.$messag, 'parse_mode' => 'markdown']);
} else {
	if($type3 == 'user'){
 $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ʏᴏᴜʀɪᴅ : `$peer`", 'parse_mode' => 'markdown']);
}}} else {
  $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ɢʀᴏᴜᴘɪᴅ : `$peer`", 'parse_mode' => 'markdown']);
}
}

if(isset($message['reply_to_msg_id'])){
if($text == 'unblock' or $text == '/unblock' or $text == '!unblock'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $this->contacts->unblock(['id' => $messag]);
  $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴜɴʙʟᴏᴄᴋᴇᴅ!"]);
  } else {
  	if($type3 == 'user'){
yield $this->contacts->unblock(['id' => $peer]); $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴜɴʙʟᴏᴄᴋᴇᴅ!"]);
}
}
}

if($text == 'block' or $text == '/block' or $text == '!block'){
if($type3 == 'supergroup' or $type3 == 'chat'){
  $gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gms = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gms['messages'][0]['from_id'];
  yield $this->contacts->block(['id' => $messag]);
  $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ʙʟᴏᴄᴋᴇᴅ!"]);
  } else {
 	if($type3 == 'user'){
yield $this->contacts->block(['id' => $peer]); $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ʙʟᴏᴄᴋᴇᴅ!"]);
}
}
}

if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
$gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(!in_array($messag, $data['enemies'])){
    $data['enemies'][] = $messag;
    file_put_contents("data.json", json_encode($data));
    yield $this->contacts->block(['id' => $messag]);
    $this->messages->sendMessage(['peer' => $peer, 'message' => "$messag ɪꜱ ɴᴏᴡ ɪɴ ᴇɴᴇᴍʏ ʟɪꜱᴛ"]);
  } else {
    $this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴜꜱᴇʀ ᴡᴀꜱ ɪɴ ᴇɴᴇᴍʏʟɪꜱᴛ"]);
  }
}
if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
$gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$msg_id]]);
  $messag1 = $gmsg['messages'][0]['reply_to_msg_id'];
  $gmsg = yield $this->channels->getMessages(['channel' => $peer, 'id' => [$messag1]]);
  $messag = $gmsg['messages'][0]['from_id'];
  if(in_array($messag, $data['enemies'])){
    $k = array_search($messag, $data['enemies']);
    unset($data['enemies'][$k]);
    file_put_contents("data.json", json_encode($data));
    yield $this->contacts->unblock(['id' => $messag]);
    $this->messages->sendMessage(['peer' => $peer, 'message' => "$messag ᴅᴇʟᴇᴛᴇᴅ ꜰʀᴏᴍ ᴇɴᴇᴍʏ ʟɪꜱᴛ"]);
  } else{
    $this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴜꜱᴇʀ ᴡᴀꜱɴ'ᴛ ɪɴ ᴇɴᴇᴍʏʟɪꜱᴛ"]);
  }
 }
}

if(preg_match("/^[\/\#\!]?(answerlist)$/i", $text)){
if(count($data['answering']) > 0){
$txxxt = "ʟɪꜱᴛ ᴏꜰ ᴀɴꜱᴡᴇʀꜱ :
";
$counter = 1;
foreach($data['answering'] as $k => $ans){
$txxxt .= "$counter: $k => $ans \n";
$counter++;
}
$this->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
}else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜᴇʀᴇ ɪꜱ ɴᴏ ᴀɴꜱᴡᴇʀ!"]);
  }
 }

if($text == 'help' or $text == 'راهنما' or $text == 'Help'){
$load = sys_getloadavg();
$mem_using = round(memory_get_usage() / 1024 / 1024,1);
$this->messages->sendMessage(['peer' => $peer, 'message' => "
🚧 راهنمای سلف  🇹🇯-ᴀʀᴀ🇹🇯 🚧
× × × × × × × × × × × ×
🔱♨️ 🔥 Powered By : @Ashmy_1 🔥 قدرت گرفته از  🔱♨️
× × × × × × × × × × × × 
🔱♨️بخش مدیریت اکانت ✨ ✯🔱♨️

/bot on یا off
🔱♨️• خاموش و روشن کردن ربات🔱♨️

ping    ربات
🔱♨️• دریافت وضعیت ربات🔱♨️

load
🔱♨️ دریافت سرعت سرور 🔱♨️


online on یا off
🔱♨️• روشن و خاموش کردن حالت همیشه انلاین🔱♨️

typing on یا off
🔱♨️• روشن و خاموش کردن حالت تایپینگ بعد از هر پیام🔱♨️

markread on یا off
🔱♨️• روشن و خاموش کردن حالت خوانده شدن پیام ها🔱♨️

poker on یا  off
🔱♨️ روشن ⸙ خاموش کردن حالت پوکر 🔱♨️

🔱♨️🔱♨️ابزار کاربردی و سرگرمی 💫  ༒🔱♨️🔱♨️
ماشین یا car 
🔱♨️ماشین ب سمت بمب میره و بوووم میترکه♨️🔱♨️ 
 
موتور  یا  motor 
🔱♨️ اهنربا موتورو ب سمت خودش میکشه 🔱♨️ 
 
 
بکیرم یا bk  
🔱♨️دریافت  کلمه ی bk با ایموجی (😂)🔱♨️ 
 
 
کیر یا kir 
🔱♨️دریافت کلمه ی کیر با اموجی  ( 😂😡 ) 🔱♨️ 
 
 
wiki (text)
🔱♨️جستجو در ویکی پدیا🔱♨️

/weather اسم شهر
🔱♨️• آب و هوای منطقه🔱♨️

/music [TEXT]
🔱♨️• موزیک درخواستی🔱♨️

/info [@username]
🔱♨️• دریافت اطلاعات کاربر🔱♨️

gpinfo
🔱♨️• دریافت اطلاعات گروه🔱♨️

/sessions
🔱♨️• دریافت بازنشست های فعال اکانت🔱♨️

/save [REPLAY]
🔱♨️• سیو کردن پیام و محتوا  در پیوی خود ربات🔱♨️

/id [reply]
🔱♨️• دریافت ایدی عددی کابر🔱♨️

pic (text)
🔱♨️جستجوی عکس ✨🔱♨️
gif (text)
🔱♨️جستجوی گیف 🔱♨️

/joke
🔱♨️جک بصورت رندوم 🔱♨️

like (text)
🔱♨️ساخت متن لایک دار🔱♨️

search (text)
🔱♨️بجا کلمه text کلمه ی مورد نظر رو بزارین ربات میگرده پیامو پیدا میکنه میفرسته براتون🔱♨️
🔱♨️مناسب برا سرچ تو گروه و پیوی🔱♨️


⚜️⚜️          ⚜️⚜️ 
زنبور یا vizviz 
🔱♨️ زنبور میفته دمبال طرف 😂🔱♨️ 

⚜️⚜️          ⚜️⚜️ 


بخش زمان ⭐️♨️ 
 
 
time  
یا 
ساعت 
🔱♨️دریافت ساعت🔱♨️ 
 
تاریخ شمسی 
🔱♨️دریافت تاریخ شمسی 🔱♨️ 
 
تاریخ میلادی  
🔱♨️دریافت تاریخ میلادی🔱♨️ 
 
 
᳇᳇ @Ashmy_1   ᳇᳇ 
 

🔱♨️ ابزار مقابله با دشمن 💥 ⸙🔱♨️ 
/setenemy [userid]  or ⪻replay⪼
🔱♨️ • تنظیم دشمن با استفاده از ایدی عددی  و ریپلی 🔱♨️ 

/delenemy [userid] 
🔱♨️ • حذف دشمن با استفاده از ایدی عددی یا ریپلی🔱♨️ 

clean enemylist
🔱♨️ • پاک کردن لیست دشمنان 🔱♨️

flood  [NUMBER] [TEXT] 
 🔱♨️ •  اسپم پیام در یک متن 🔱♨️ 
 
 شمارش
 🔱♨️شمارش از یک تا ده🔱♨️ 

spam  [NUMBER] [TEXT] 
🔱♨️•  اسپم بصورت پیام های مکرر🔱♨️  
 
for 
??♨️فروارد رگباری فش🔱♨️ 
 
شمارش فا  
🔱♨️ ارسال فش فارسی و شمارش 🔱♨️ 
 
شمارش ان  
🔱♨️ارسل فش انگلیسی و شمارش🔱♨️ 
 
⚜️⚜️          ⚜️⚜️ 


flood [NUMBER] [TEXT]
 🔱♨️ •  اسپم پیام در یک متن 🔱♨️

بشمار 
شمارش از یک تا ده
spam [NUMBER] [TEXT]
🔱♨️•  اسپم بصورت پیام های مکرر🔱♨️ 

🔱♨️🍃 #بخش_تنظیم_جواب_سریع :🔱♨️

/setanswer TEXT|ANSWER
🔱♨️• افزودن جواب سریع (متن اول متن دریافتی از اشخاص متن دوم جواب 😐✨)🔱♨️
🔱♨️ مصال  🔱♨️
🔱♨️ سلام|علیک 🔱♨️

/delanswer [TEXT]
🔱♨️ • حذف جواب سریع 🔱♨️

/clean answers
🔱♨️ • حذف همه جواب سریع ها 🔱♨️

/answerlist
🔱♨️ • لیست همه جواب سریع ها 🔱♨️ 

× × × × × × × × × × × ×
🔱♨️🔥 Powered By :  ᳇   @Ashmy_1   ᳇🔥 قدرت گرفته از🔱♨️
Aradw kurd bot self @Ashmy_1
× × × × × × × × × × × × 

∞∞∞∞∞∞∞∞∞∞∞
⚜️⚜️          ⚜️⚜️ 
➣ ᴘɪɴɢ ᴀɴᴅ ʟᴏᴀᴅ ɢᴜɪᴅᴇ

ᴀᴍᴏᴜɴᴛ ᴏꜰ ʀᴀᴍ ɪɴ ᴜꜱᴇ : $mem_using ᴍʙ
ᴘɪɴɢ ʟᴏᴀᴅᴇᴅ ꜱᴇʀᴠᴇʀ : $load[0]
",
'parse_mode' => 'markdown']);
}
if(preg_match("/^[\/\#\!]?(save)$/i", $text) && isset($message['reply_to_msg_id'])){
$me = yield $this->get_self();
$me_id = $me['id'];
yield $this->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $me_id, 'id' => [$message['reply_to_msg_id']]]);
      $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "🔱♨️> ꜱᴀᴠᴇᴅ🔱♨️"]);
     }
 if(preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(typing) (on|off)$/i", $text, $m);
$data['typing'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴛʏᴘɪɴɢ ɴᴏᴡ ɪꜱ $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(echo) (on|off)$/i", $text, $m);
$data['echo'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴇᴄʜᴏ ɴᴏᴡ ɪꜱ $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text)){
preg_match("/^[\/\#\!]?(markread) (on|off)$/i", $text, $m);
$data['markread'] = $m[2];
file_put_contents("data.json", json_encode($data));
      $this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴍᴀʀᴋʀᴇᴀᴅ ɴᴏᴡ ɪꜱ $m[2]"]);
     }
 if(preg_match("/^[\/\#\!]?(info) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(info) (.*)$/i", $text, $m);
$mee = yield $this->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_status = $me['status']['_'];
$me_bio = $mee['full']['about'];
$me_common = $mee['full']['common_chats_count'];
$me_name = $me['first_name'];
$me_uname = $me['username'];
$mes = "ɪᴅ : $me_id \nɴᴀᴍᴇ: $me_name \nᴜꜱᴇʀɴᴀᴍᴇ: @$me_uname \nꜱᴛᴀᴛᴜꜱ: $me_status \nʙɪᴏ: $me_bio \nᴄᴏᴍᴍᴏɴ ɢʀᴏᴜᴘꜱ ᴄᴏᴜɴᴛ: $me_common";
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => $mes]);
     }
 if(preg_match("/^[\/\#\!]?(block) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(block) (.*)$/i", $text, $m);
yield $this->contacts->block(['id' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ʙʟᴏᴄᴋᴇᴅ!"]);
     }
 if(preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(unblock) (.*)$/i", $text, $m);
yield $this->contacts->unblock(['id' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴜɴʙʟᴏᴄᴋᴇᴅ!"]);
     }
 if(preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(checkusername) (@.*)$/i", $text, $m);
$check = yield $this->account->checkUsername(['username' => str_replace("@", "", $m[2])]);
if($check == false){
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴇxɪꜱᴛꜱ!"]);
} else{
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ꜰʀᴇᴇ!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setfirstname) (.*)$/i", $text, $m);
yield $this->account->updateProfile(['first_name' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴅᴏɴᴇ!"]);
     }
 if(preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setlastname) (.*)$/i", $text, $m);
yield $this->account->updateProfile(['last_name' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴅᴏɴᴇ!"]);
     }
 if(preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setbio) (.*)$/i", $text, $m);
yield $this->account->updateProfile(['about' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴅᴏɴᴇ!"]);
     }
 if(preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setusername) (.*)$/i", $text, $m);
yield $this->account->updateUsername(['username' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴅᴏɴᴇ!"]);
     }
 if(preg_match("/^[\/\#\!]?(join) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(join) (.*)$/i", $text, $m);
yield $this->channels->joinChannel(['channel' => $m[2]]);
$this->messages->editMessage(['peer' => $peer,'id' => $msg_id,'message' => "ᴊᴏɪɴᴇᴅ!"]);
     }
if(preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text)){
preg_match("/^[\/\#\!]?(add2all) (@.*)$/i", $text, $m);
$dialogs = yield $this->get_dialogs();
foreach ($dialogs as $peeer) {
$peer_info = yield $this->get_info($peeer);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
  yield $this->channels->inviteToChannel(['channel' => $peeer, 'users' => [$m[2]]]);
}
}
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴀᴅᴅᴇᴅ ᴛᴏ ᴀʟʟ ꜱᴜᴘᴇʀɢʀᴏᴜᴘꜱ"]);
     }
 if(preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(newanswer) (.*) \|\|\| (.*)$/i", $text, $m);
$txxt = $m[2];
$answeer = $m[3];
if(!isset($data['answering'][$txxt])){
$data['answering'][$txxt] = $answeer;
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ɴᴇᴡ ᴡᴏʀᴅ ᴀᴅᴅᴇᴅ ᴛᴏ ᴀɴꜱᴡᴇʀʟɪꜱᴛ"]);
} else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴡᴏʀᴅ ᴡᴀꜱ ɪɴ ᴀɴꜱᴡᴇʀʟɪꜱᴛ"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delanswer) (.*)$/i", $text, $m);
$txxt = $m[2];
if(isset($data['answering'][$txxt])){
unset($data['answering'][$txxt]);
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴡᴏʀᴅ ᴅᴇʟᴇᴛᴇᴅ ꜰʀᴏᴍ ᴀɴꜱᴡᴇʀʟɪꜱᴛ"]);
} else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴡᴏʀᴅ ᴡᴀꜱɴ'ᴛ ɪɴ ᴀɴꜱᴡᴇʀʟɪꜱᴛ"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean answers)$/i", $text)){
$data['answering'] = [];
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴀɴꜱᴡᴇʀʟɪꜱᴛ ɪꜱ ɴᴏᴡ ᴇᴍᴘᴛʏ!"]);
     }
 if(preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(setenemy) (.*)$/i", $text, $m);
$mee = yield $this->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(!in_array($me_id, $data['enemies'])){
$data['enemies'][] = $me_id;
file_put_contents("data.json", json_encode($data));
yield $this->contacts->block(['id' => $m[2]]);
$this->messages->sendMessage(['peer' => $peer, 'message' => "$me_name ɪꜱ ɴᴏᴡ ɪɴ ᴇɴᴇᴍʏ ʟɪꜱᴛ"]);
} else {
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴜꜱᴇʀ ᴡᴀꜱ ɪɴ ᴇɴᴇᴍʏʟɪꜱᴛ"]);
}
     }
 if(preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(delenemy) (.*)$/i", $text, $m);
$mee = yield $this->get_full_info($m[2]);
$me = $mee['User'];
$me_id = $me['id'];
$me_name = $me['first_name'];
if(in_array($me_id, $data['enemies'])){
$k = array_search($me_id, $data['enemies']);
unset($data['enemies'][$k]);
file_put_contents("data.json", json_encode($data));
yield $this->contacts->unblock(['id' => $m[2]]);
$this->messages->sendMessage(['peer' => $peer, 'message' => "$me_name ᴅᴇʟᴇᴛᴇᴅ ꜰʀᴏᴍ ᴇɴᴇᴍʏ ʟɪꜱᴛ"]);
} else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴛʜɪꜱ ᴜꜱᴇʀ ᴡᴀꜱɴ'ᴛ ɪɴ ᴇɴᴇᴍʏʟɪꜱᴛ"]);
}
     }
 if(preg_match("/^[\/\#\!]?(clean enemylist)$/i", $text)){
$data['enemies'] = [];
file_put_contents("data.json", json_encode($data));
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴇɴᴇᴍʏʟɪꜱᴛ ɪꜱ ɴᴏᴡ ᴇᴍᴘᴛʏ!"]);
     }
 if(preg_match("/^[\/\#\!]?(enemylist)$/i", $text)){
if(count($data['enemies']) > 0){
$txxxt = "ᴇɴᴇᴍʏʟɪꜱᴛ :
";
$counter = 1;
foreach($data['enemies'] as $ene){
  $mee = yield $this->get_full_info($ene);
  $me = $mee['User'];
  $me_name = $me['first_name'];
  $txxxt .= "$counter: $me_name \n";
  $counter++;
}
$this->messages->sendMessage(['peer' => $peer, 'message' => $txxxt]);
} else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ɴᴏ ᴇɴᴇᴍʏ!"]);
}
     }
 if(preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text) && $update['_'] == "updateNewChannelMessage"){
preg_match("/^[\/\#\!]?(inv) (@.*)$/i", $text, $m);
$peer_info = yield $this->get_info($message['to_id']);
$peer_type = $peer_info['type'];
if($peer_type == "supergroup"){
yield $this->channels->inviteToChannel(['channel' => $message['to_id'], 'users' => [$m[2]]]);
} else{
$this->messages->sendMessage(['peer' => $peer, 'message' => "ᴊᴜꜱᴛ ꜱᴜᴘᴇʀɢʀᴏᴜᴘꜱ"]);
}
     }
   
     
 if(preg_match("/^[\/\#\!]?(leave)$/i", $text)){
 	$this->messages->sendMessage(['peer' => $peer, 'message' => "Leave"]);
yield $this->channels->leaveChannel(['channel' => $message['to_id']]);
     }
 if(preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(flood) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
$spm = "";
for($i=1; $i <= $count; $i++){
$spm .= " $txt \n";
}
$this->messages->sendMessage(['peer' => $peer, 'message' => $spm]);
     }
 if(preg_match("/^[\/\#\!]?(spam) ([0-9]+) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(spam) ([0-9]+) (.*)$/i", $text, $m);
$count = $m[2];
$txt = $m[3];
for($i=1; $i <= $count; $i++){
$this->messages->sendMessage(['peer' => $peer, 'message' => " $txt "]);
}
     }
 if(preg_match("/^[\/\#\!]?(music) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(music) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@melobot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(wiki) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@wiki", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(youtube) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@uVidBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(pic) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@pic", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(gif) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@gif", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(google) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(google) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@GoogleDEBot", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][rand(0, count($messages_BotResults['results']))]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(joke)$/i", $text)){
preg_match("/^[\/\#\!]?(joke)$/i", $text, $m);
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(aasab)$/i", $text)){
preg_match("/^[\/\#\!]?(aasab)$/i", $text, $m);
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@function_robot", 'peer' => $peer, 'query' => '', 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][1]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(like) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(like) (.*)$/i", $text, $m);
$mu = $m[2];
$messages_BotResults = yield $this->messages->getInlineBotResults(['bot' => "@like", 'peer' => $peer, 'query' => $mu, 'offset' => '0']);
$query_id = $messages_BotResults['query_id'];
$query_res_id = $messages_BotResults['results'][0]['id'];
yield $this->messages->sendInlineBotResult(['silent' => true, 'background' => false, 'clear_draft' => true, 'peer' => $peer, 'reply_to_msg_id' => $message['id'], 'query_id' => $query_id, 'id' => "$query_res_id"]);
     }
 if(preg_match("/^[\/\#\!]?(search) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(search) (.*)$/i", $text, $m);
$q = $m[2];
$res_search = yield $this->messages->search(['peer' => $peer, 'q' => $q, 'filter' => ['_' => 'inputMessagesFilterEmpty'], 'min_date' => 0, 'max_date' => time(), 'offset_id' => 0, 'add_offset' => 0, 'limit' => 50, 'max_id' => $message['id'], 'min_id' => 1]);
$texts_count = count($res_search['messages']);
$users_count = count($res_search['users']);
$this->messages->sendMessage(['peer' => $peer, 'message' => "Msgs Found: $texts_count \nFrom Users Count: $users_count"]);
foreach($res_search['messages'] as $text){
$textid = $text['id'];
yield $this->messages->forwardMessages(['from_peer' => $text, 'to_peer' => $peer, 'id' => [$textid]]);
 }
}
 else if(preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text)){
preg_match("/^[\/\#\!]?(weather) (.*)$/i", $text, $m);
$query = $m[2];
$url = json_decode(file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".$query."&appid=eedbc05ba060c787ab0614cad1f2e12b&units=metric"), true);
$city = $url["name"];
$deg = $url["main"]["temp"];
$type1 = $url["weather"][0]["main"];
if($type1 == "Clear"){
		$tpp = 'آفتابی☀';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Clouds"){
		$tpp = 'ابری ☁☁';
		file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Rain"){
		 $tpp = 'بارانی ☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Thunderstorm"){
		$tpp = 'طوفانی ☔☔☔☔';
file_put_contents('type.txt',$tpp);
	}
	elseif($type1 == "Mist"){
		$tpp = 'مه 💨';
file_put_contents('type.txt',$tpp);
	}
  if($city != ''){
$ziro = file_get_contents('type.txt');
  $txt = "دمای شهر $city هم اکنون $deg درجه سانتی گراد می باشد

شرایط فعلی آب و هوا: $ziro";
$this->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
unlink('type.txt');
}else{
 $txt = "⚠️شهر مورد نظر شما يافت نشد";
$this->messages->sendMessage(['peer' => $peer, 'message' => $txt]);
 }
}
  else if(preg_match("/^[\/\#\!]?(sessions)$/i", $text)){
$authorizations = yield $this->account->getAuthorizations();
$txxt="";
foreach($authorizations['authorizations'] as $authorization){
$txxt .="
هش: ".$authorization['hash']."
مدل دستگاه: ".$authorization['device_model']."
سیستم عامل: ".$authorization['platform']."
ورژن سیستم: ".$authorization['system_version']."
api_id: ".$authorization['api_id']."
app_name: ".$authorization['app_name']."
نسخه برنامه: ".$authorization['app_version']."
تاریخ ایجاد: ".date("Y-m-d H:i:s",$authorization['date_active'])."
تاریخ فعال: ".date("Y-m-d H:i:s",$authorization['date_active'])."
آی‌پی: ".$authorization['ip']."
کشور: ".$authorization['country']."
منطقه: ".$authorization['region']."

====================";
}
$this->messages->sendMessage(['peer' => $peer, 'message' => $txxt]);
     }
 if(preg_match("/^[\/\#\!]?(gpinfo)$/i", $text)){
$peer_inf = yield $this->get_full_info($message['to_id']);
$peer_info = $peer_inf['Chat'];
$peer_id = $peer_info['id'];
$peer_title = $peer_info['title'];
$peer_type = $peer_inf['type'];
$peer_count = $peer_inf['full']['participants_count'];
$des = $peer_inf['full']['about'];
$mes = "ID: $peer_id \nTitle: $peer_title \nType: $peer_type \nMembers Count: $peer_count \nBio: $des";
$this->messages->sendMessage(['peer' => $peer, 'message' => $mes]);
     }
   }
 if($data['power'] == "on"){
   if ($from_id !=$ADEFI) {
   if($message && $data['typing'] == "on" && $update['_'] == "updateNewChannelMessage"){
$sendMessageTypingAction = ['_' => 'sendMessageTypingAction'];
yield $this->messages->setTyping(['peer' => $peer, 'action' => $sendMessageTypingAction]);
     }
     if($message && $data['echo'] == "on"){
yield $this->messages->forwardMessages(['from_peer' => $peer, 'to_peer' => $peer, 'id' => [$message['id']]]);
     }
     if($message && $data['markread'] == "on"){
if(intval($peer) < 0){
yield $this->channels->readHistory(['channel' => $peer, 'max_id' => $message['id']]);
yield $this->channels->readMessageContents(['channel' => $peer, 'id' => [$message['id']] ]);
} else{
yield $this->messages->readHistory(['peer' => $peer, 'max_id' => $message['id']]);
}
     }
     if(strpos($text, '😐') !== false and $data['poker'] == "on"){
$this->messages->sendMessage(['peer' => $peer, 'message' => '😐', 'reply_to_msg_id' => $message['id']]);
     }
  $fohsh = [
  "کیرم کون مادرت😂😂😂😂","بالا باش کیرم کص مادرت😂😂😂","مادرتو میگام نوچه جون بالا😂😂😂","اب خارکصته تند تند تایپ کن ببینم","مادرتو میگام بخای فرار کنی","لال شو دیگه نوچه","مادرتو میگام اف بشی","کیرم کون مادرت","کیرم کص مص مادرت بالا","کیرم تو چشو چال مادرت","کون مادرتو میگام بالا","بیناموس  خسته شدی؟","نبینم خسته بشی بیناموس","ننتو میکنم","کیرم کون مادرت 😂😂😂😂😂😂😂","صلف تو کصننت بالا","بیناموس بالا باش بهت میگم","کیر تو مادرت","کص مص مادرتو بلیسم؟","کص مادرتو چنگ بزنم؟","به خدا کصننت بالا ","مادرتو میگام ","کیرم کون مادرت بیناموس","مادرجنده بالا باش","بیناموس تا کی میخای سطحت گح باشه","اپدیت شو بیناموس خز بود","ای تورک خر بالا ببینم","و اما تو بیناموس چموش","تو یکیو مادرتو میکنم","کیرم تو ناموصت ","کیر تو ننت","ریش روحانی تو ننت","کیر تو مادرت😂😂😂","کص مادرتو مجر بدم","صلف تو ننت","بات تو ننت ","مامانتو میکنم بالا","وای این تورک خرو","سطحشو نگا","تایپ کن بیناموس","خشاب؟","کیرم کون مادرت بالا","بیناموس نبینم خسته بشی","مادرتو بگام؟","گح تو سطحت شرفت رف","بیناموس شرفتو نابود کردم یه کاری کن","وای کیرم تو سطحت","بیناموس روانی شدی","روانیت کردما","مادرتو کردم کاری کن","تایپ تو ننت","بیپدر بالا باش","و اما تو لر خر","ننتو میکنم بالا باش","کیرم لب مادرت بالا😂😂😂","چطوره بزنم نصلتو گح کنم","داری تظاهر میکنی ارومی ولی مادرتو کوص کردم","مادرتو کردم بیغیرت","هرزه","وای خدای من اینو نگا","کیر تو کصننت","ننتو بلیسم","منو نگا بیناموس","کیر تو ننت بسه دیگه","خسته شدی؟","ننتو میکنم خسته بشی","وای دلم کون مادرت بگام","اف شو احمق","بیشرف اف شو بهت میگم","مامان جنده اف شو","کص مامانت اف شو","کص لش وا ول کن اینجوری بگو؟","ای بیناموس چموش","خارکوصته ای ها","مامانتو میکنم اف نشی","گح تو ننت","سطح یه گح صفتو","گح کردم تو نصلتا","چه رویی داری بیناموس","ناموستو کردم","رو کص مادرت کیر کنم؟😂😂😂","نوچه بالا","کیرم تو ناموصتاا😂😂","یا مادرتو میگام یا اف میشی","لالشو دیگه","بیناموس","مادرکصته","ناموص کصده","وای بدو ببینم میرسی","کیرم کون مادرت چیکار میکنی اخه","خارکصته بالا دیگه عه","کیرم کصمادرت😂😂😂","کیرم کون ناموصد😂😂😂","بیناموس من خودم خسته شدم توچی؟","ای شرف ندار","مامانتو کردم بیغیرت","و اما مادر جندت","تو یکی زیر باش","اف شو","خارتو کوص میکنم","کوصناموصد","ناموص کونی","خارکصته ی بۍ غیرت","شرم کن بیناموس","مامانتو کرد ","ای مادرجنده","بیغیرت","کیرتو ناموصت","بیناموس نمیخای اف بشی؟","ای خارکوصته","لالشو دیگه","همه کس کونی","حرامزاده","مادرتو میکنم","بیناموس","کصشر","اف شو مادرکوصته","خارکصته کجایی","ننتو کردم کاری نمیکنی؟","کیرتو مادرت لال","کیرتو ننت بسه","کیرتو شرفت","مادرتو میگام بالا","نمیزارم فرار کن مادرتو میگام","و اما تو کیرم کون مادرت میخای در بری داش","تورک خر","گوه ممبر بالا","گوه ترین ممبر جمهوری اسلامی یالا بالا بینم کیرم کون مادرت","شاگرد تا نزدم مادرتو بگام اف شو👽","کیر اندره تو کوس مادرت😂😂","کوسمادرت","بیا برو کوس مادرت گلم","این گوهو بن کنین","کیرم تو ناموست","بیا برو کوس مادرت گلم","کیرم تو مادرت","گوه تو مادرت😂😂","این گوهو","کیرم کوس موس مادرت","کیرم کون مادرت","این گوهو بن کنین","کیرم کون مادرتون","ننه سگو نگا","کیرم لب مادرت","کیرم تو پدرت گلم","کیرم کون مادر امیر نوچه","نوچه","کسننت😂😂","سلاخی کنم مادرتو😂😂😂","کوس مادرت بخورم","کیر برو بکس بیناموسا تو کسننت👽👽","کیر ممبران اکیپ بیناموسا تو کس ننت ☠️☠️","مادرتو میخورم","کیرم کون مادرتون😂😂😂😂","مادرتو😂😂😂","مادرت جندس آیا😂","کیر اق امیر نوچه تو مادرت","کیر برو بکس اهریمن تو کوس مادرت","کیر میلاد لور ابر کسلیس ممبر تل تو کوس مادرت😂😂😂😂","کیر میلاد لور ابر کسلیس ممبر تل تو کوس مادرت😂😂😂😂","بکل نوچه","نبینم بخای فرار کنی","مادرتو گاییدم","کیرم لب مادرت🥶","کوس مادرت بگام😱","ننت بخورم😴","کس ننه رو نگا","منو تو ننمون جندس داش","بیناموس شده در سال ۱۳۹۹ بیا نوچم شو کیرم کون مادرت با این سطح گوهت","خون کوس مادرتو میدم ارین نوچه بخوره یالا بالا","مایه ننگ و سر افکندگی ممبران گپ یالا بالا","کوس مادرتو میخورم مشکل؟!","مادرتو بکنم چیکار میکنی👽👽","کیر سینا گابریل عاشق تو کوس ننت👽👽","کیر اراد کورد تو کوس مادرت","مادرت جنده شده👻","کیرم تو ناموست🦷","کیرم لب مادرت🔞","مادرتو بخورم♨️♨️","آندره ممبرک دیل کن","اندره رو نگا","چقد اندره ای تو کیرم کون مادرت","نوچه تکساتو نمیخونم ادامه نده بتایپ","کیر تو مادرت"
  ];
if(in_array($from_id, $data['enemies'])){
  $f = $fohsh[rand(0, count($fohsh)-1)];
  $this->messages->sendMessage(['peer' => $peer, 'message' => $f, 'reply_to_msg_id' => $msg_id]);
}
if(isset($data['answering'][$text])){
  $this->messages->sendMessage(['peer' => $peer, 'message' => $data['answering'][$text] , 'reply_to_msg_id' => $msg_id]);
}}}}
}catch(\Exception $e){}	catch(\danog\MadelineProto\RPCErrorException $e){}
}
}
register_shutdown_function('shutdown_function', $lock);
closeConnection();
$MadelineProto->async(true);
$MadelineProto->loop(function () use ($MadelineProto) {
  yield $MadelineProto->setEventHandler('\EventHandler');
});
$MadelineProto->loop();
?>
