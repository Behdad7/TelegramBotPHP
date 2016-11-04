 
<?php
/**
 * Telegram Bot example.
 * @author Gabriele Grillo <gabry.grillo@alice.it>
 */
include("Telegram.php");
// Set the bot TOKEN
$bot_id = "258123864:AAGf0QayDyTslQ1-V5d3hb49nD3y0C1b424";
// Instances the class
$telegram = new Telegram($bot_id);
/* If you need to manually take some parameters
*  $result = $telegram->getData();
*  $text = $result["message"] ["text"];
*  $chat_id = $result["message"] ["chat"]["id"];
*/
// Take text and chat_id from the message
$text = $telegram->Text();
$chat_id = $telegram->ChatID();
// Check if the text is a command
if(!is_null($text) && !is_null($chat_id)){
	if ($text == "/test") {
		if ($telegram->messageFromGroup()) {
			$reply = "Chat Group";
		} else {
			$reply = "لطفا اگر تمایل دارید به عنوان پاسخ دهنده در بوت ثبت نام کنید. در غیر این صورت سوال دارم را انتخاب کنید.";
		}
	        // Create option for the custom keyboard. Array of array string
	        $option = array( array("سوال دارم", "پاسخگو میشوم"), array("راهنمای", "ارتباط با ما") );
	        // Get the keyboard
		$keyb = $telegram->buildKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	if ($text == "پاسخگو میشوم") {
	    $reply = "Check me on GitHub: https://github.com/Eleirbag89/TelegramBotPHP";
	    // Build the reply array
	    $content = array('chat_id' => $chat_id, 'text' => $reply);
	    $telegram->sendMessage($content);
	}
	
	if ($text == "/img") {
	    // Load a local file to upload. If is already on Telegram's Servers just pass the resource id
	    $img = curl_file_create('test.png','image/png'); 
	    $content = array('chat_id' => $chat_id, 'photo' => $img );
	    $telegram->sendPhoto($content);
	    //Download the file just sended
	    $file_id = $message["photo"][0]["file_id"];
	    $file = $telegram->getFile($file_id);
	    $telegram->downloadFile($file["file_path"], "./test_download.png");
	}
	
	if ($text == "/where") {
	    // Send the Catania's coordinate
	    $content = array('chat_id' => $chat_id, 'latitude' => "37.5", 'longitude' => "15.1" );
	    $telegram->sendLocation($content);
		
		$option = array( array( $telegram->buildInlineKeyboardButton("Test", $url="http://google.it"), $telegram->buildInlineKeyboardButton($text="Test2","","Callback","") ) );
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "Welcome to Bot !");
		$telegram->sendMessage($content);
	}
}
?>
