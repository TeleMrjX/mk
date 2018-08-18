<?php
ini_set('error_reporting', 'E_ALL');
// BOT TOKEN INFORMATION
// Edit and set your BOT TOKEN
$botToken = "< ENTER YOUR TOKEN >";
$webSite = "https://api.telegram.org/bot" . $botToken;

// EXTRACTING DATA FROM JSON | DO NOT EDIT IF YOU DON'T KNOW JSON !
$update = file_get_contents("php://input");
$update = json_decode($update, TRUE);
$chatId = $update["message"]["chat"]["id"];
$message = $update["message"]["text"];
$lastmessageid = $update["message"]["message_id"];
$firstname = $update["message"]["from"]["first_name"];
$lastname = $update["message"]["from"]["last_name"];
$usernameWAT = $update["message"]["from"]["username"];
$usernameget ="@".$update["message"]["from"]["username"];
$callbackdata=$update['callback_query']['data'];


// ADMIN INFO
// EDIT THIS PART WITH YOUR TELEGRAM ID :)
$admin_id = '132322823';
$admin_name = 'MOHSEN';
$admin_phone = '+989036951341';
$admin_about = "ABOUT ME";

// All Keybord of This bot
$keyboard_client=  array(
		              'keyboard' => array(
                                      array("درباره ی من",'درباره ی این ربات'),
                                      array(array('text' => 'ارسال شماره' , 'request_contact' => true),
                                            array('text' => 'ارسال مکان'  , 'request_location' => true)),
                                      array("توسعه دهنده","درخواست شماره کاربر")
		             ),'one_time_keyboard'=>true,'resize_keyboard'=>true);
$keyboard_client= json_encode($keyboard_client);
$keyboard_phone_request=  array(
		              'keyboard' => array(
                                      array(array('text' => 'بله' , 'request_contact'=>true),array('text' => 'خیر')),
		             ),'one_time_keyboard'=>true,'resize_keyboard'=>true);
$keyboard_phone_request= json_encode($keyboard_phone_request);
$keyboard_phone_request_c = array('inline_keyboard' => array(
                                                    array( array('text' => 'چت مستقیم با کاربر' , 'url' => 'https://t.me/'.$usernameWAT )),
                                                    array( array('text' => 'قبول درخواست' , 'callback_data' => 'phone_request_c,'.$chatId)),
                                                    array( array('text' => 'رد درخواست' , 'callback_data' => 'phone_request_s,'.$chatId)),
                                                  ));
$keyboard_phone_request_c=json_encode($keyboard_phone_request_c);
$keyboard_admin_w = array('inline_keyboard' => array(
                                                    array( array('text' => 'گزینه ای برای نمایش وجود ندارد.' ,'url' => 'https://t.me/')),
                                                  ));
$keyboard_admin_w=json_encode($keyboard_admin_w);
$keyboard_admin = array('inline_keyboard' => array(
                                                    array( array('text' => 'چت مستقیم با کاربر' , 'url' => 'https://t.me/'.$usernameWAT )),
                                                    array( array('text' => 'درخواست شماره' , 'callback_data' => 'phone_request_a,'.$chatId)),
                                                  ));
$keyboard_admin=json_encode($keyboard_admin);

// IF For special actions
  if (strstr($callbackdata,"phone_request_a") == true)
  {
    $Client_phone_id = explode(',',$callbackdata,2);
    sendMessagewithkeyboard($Client_phone_id[1] , "کاربر " . $admin_name . "درخواست شماره ی شما را دارد. آیا شما می خواهید شماره ی خود را ارسال کنید؟" , $keyboard_phone_request);
	}
  else if (strstr($callbackdata,"phone_request_c") == true)
  {

    $Client_phone_id = explode(',',$callbackdata,2);
    sendMessagewithkeyboard($Client_phone_id[1] , 'درخواست شما برای شماره ی ادمین پذیرفته شد.' . "\n".
                                                  'Number : ' . $admin_phone . "\n\n" . 'Dev. by M O H S E N');
    sendMessagewithkeyboard($admin_id , 'درخواست با موفقیت انجام شد.' , $keyboard_admin_w );
  }
  else if (strstr($callbackdata,"phone_request_s") == true)
  {

    $Client_phone_id = explode(',',$callbackdata,2);
    sendMessagewithkeyboard($Client_phone_id[1],' درخواست شماری شما رد شد.', $keyboard_client);
    sendMessagewithkeyboard($admin_id , 'شما درخواست را کنسل کردید.' , $keyboard_admin_w);
  }
  else {

// Switch of message action
  switch ($message) {
    case '/start':
      {
        sendMessagewithkeyboard( $admin_id , 'فرد جدیدی با مشخصات زیر وارد ربات شد'. "\n" .
                    '-----------------------------------'."\n".
                    'First name : ' . $firstname . "\n" .
                    'Lsst name : ' .  $lastname . "\n" .
                    'Chat ID : ' . $chatId . "\n" .
                    'Username : ' . $usernameget ."\n" .
                    '-----------------------------------'."\n".
                    'Dev. by M O H S E N' , $keyboard_admin);
        sendMessagewithkeyboard($chatId , "سلام از این لحظه هر پیامی ارسال کنی به طور مستقیم برای " . $admin_name . " ارسال خواهد شد.در ضمن برای راحتی از کیبور زیر نیز در هر زمان می توانید استفاده کنید." , $keyboard_client);
        break;
      }
    case 'test':
      {
        sendMessagewithkeyboard($chatId , 'TEST IS OK' , $keyboard_start);
        break;
      }
    case 'درباره ی من':
      {
        sendMessagewithkeyboard($chatId , $admin_about ,$keyboard_client);
        break;
      }
    case 'درباره ی این ربات':
      {
        sendMessagewithkeyboard($chatId , "For more information can see LINK:\n\n".'https://github.com/mohsenmottaghi/Telegram-Nashenas-Havig' ,$keyboard_client);
        break;
      }
    case 'درخواست شماره کاربر':
      {
        sendMessagewithkeyboard($admin_id,'کاربر ' . $usernameget . ' درخواست شمار ی شما را دارد .آیا:',$keyboard_phone_request_c);
        sendMessagewithkeyboard($chatId , 'درخواست با موفقیت ارسال شد', $keyboard_client);
        break;
      }
    case 'secret':
      {
        sendMessage($chatId , "Hi :)\nYour chat ID is:\n\n".$chatId."\n\nDev. by M O H S E N");
        break;
      }
    case 'خیر':
      {
        sendMessagewithkeyboard($chatId , 'درخواست رد شد.' , $keyboard_client);
        sendMessagewithkeyboard($admin_id , 'کاربر ' . $usernameget . ' درخواست شماره ی شما را رد کرد ' ,$keyboard_admin);
        break;
      }
    case 'توسعه دهنده':
      {
        sendMessage($chatId , "Hi :)\nmy name is Mohsen , you can find me on\n\n".
                              "Twitter:\n".'https://twitter.com/motmohsen'."\n".
                              "Instagram:\n".'https://instagram.com/mohsenmottaghi_'
                              "GitHub:\n".'https://github.com/mohsenmottaghi/Telegram-Nashenas-Havig');
        break;
      }
		default:
      {
        if ($chatId == $admin_id)
          {
            sendMessage($chatId , 'دستور شما قابل پردازش نمی باشد!');
          }
        else
          {
						sendMessagewithkeyboard( $admin_id , 'یک پیام جدید دارید'. "\n" .
		                    '-----------------------------------'."\n".
		                    'First name : ' . $firstname . "\n" .
		                    'Lsst name : ' .  $lastname . "\n" .
		                    'Chat ID : ' . $chatId . "\n" .
		                    'Username : ' . $usernameget ."\n" .
		                    '-----------------------------------'."\n".
		                    'Dev. by M O H S E N' , $keyboard_admin);
            forwardMessage($admin_id,$chatId,$lastmessageid);
            sendMessagewithkeyboard($chatId ,'پیام شما با موفقیت ارسال شد.', $keyboard_client);
          }
        break;
      }
	}
}
/////
// FUNCTIONS | DO NOT EDIT IF YOU DON'T KNOW PHP !
/////
// Send Simple message Function
function sendMessage($chatId, $message)
{
 $url = $GLOBALS['webSite'] . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($message);
 file_get_contents($url);
}
// Send Message With Keybord Function
function sendMessagewithkeyboard($chatId, $message,$keyboard)
{
 $url = $GLOBALS['webSite'] . "/sendMessage?chat_id=" . $chatId . "&text=" . urlencode($message)."&reply_markup=".$keyboard;
 file_get_contents($url);
}
// Forward Message Function
function forwardMessage ($chatId,$tochatid,$lastmessageid)
{
$url = $GLOBALS['webSite'] . '/forwardMessage?chat_id='.$chatId.'&from_chat_id='.$tochatid.'&message_id='.$lastmessageid;
file_get_contents($url);
}
/*
      BE HAPPY
      MOHSEN
*/
?>
