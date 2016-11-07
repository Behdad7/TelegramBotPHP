 
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
$callback_query = $telegram->Callback_Query();
// Check if the text is a command
if(!is_null($text) && !is_null($chat_id)){
	if ($text == "/start") {
		if ($telegram->messageFromGroup()) {
			$reply = "Chat Group";
		} else {
			$reply = "` لطفا اگر توانایی و تخصص دارید به عنوان 🕵 پاسخگو میشوم در ابن سینا ثبت نام کنید. در غیر این صورت  🙋 سوال دارم را انتخاب کنید.`";
		}
	        // Create option for the custom keyboard. Array of array string
	        $option = array( array("🙋 سوال دارم", "🕵 پاسخگو میشوم"), array("📃 راهنمای", "👥 ارتباط با ما") );
	        // Get the keyboard
		$keyb = $telegram->buildKeyBoard($option);
		$content = array('chat_id' => $chat_id,'parse_mode'=>'Markdown', 'reply_markup' => $keyb, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	else if ($text == "🕵 پاسخگو میشوم") {
	     $reply = "*مدارک مورد نیاز* \n_1.تصویر مدرک تحصیلی یا حوزوی مرتبط\n2.شماره شبا جهت واریز مبلغ کارکرد\n3.شماره تماس متصل به تلگرام\n4.پذیرش تعهد نامه کاری_"; 
		// Build the reply array
	    $content = array('chat_id' => $chat_id,'parse_mode'=>'Markdown', 'text' => $reply);
	    $telegram->sendMessage($content);
		
		$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","reghoghogh","")),
				array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","regtahsili","")),
				array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","regcom","")),
				array($telegram->buildInlineKeyboardButton("آشپزی","","regchef","")),
				array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","reghealt","")),
				array($telegram->buildInlineKeyboardButton("معلم پایه تا شیشم","","regteacher","")),
				array($telegram->buildInlineKeyboardButton("مکانیک", "","regmachine","")),
				array($telegram->buildInlineKeyboardButton("برق و الکنترونیک","","regelectronic","")),
				array($telegram->buildInlineKeyboardButton("ریاضی","","regmath","")),
				array($telegram->buildInlineKeyboardButton("فیزیک","","regphysic","")),
				array($telegram->buildInlineKeyboardButton("شیمی","","regchemistry","")),
				array($telegram->buildInlineKeyboardButton("کشاورزی","","regagri","")));
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "از لیست زیر لطفاً رسته ای که به توانایی شما نزدیکتر می باشد را انتخاب کنید");
		$telegram->sendMessage($content);
		
		
		
		
		
		
	}
	
	else if ($text == "/img") {
	    // Load a local file to upload. If is already on Telegram's Servers just pass the resource id
	    $img = curl_file_create('test.png','image/png'); 
	    $content = array('chat_id' => $chat_id, 'photo' => $img );
	    $telegram->sendPhoto($content);
	    //Download the file just sended
	    $file_id = $message["photo"][0]["file_id"];
	    $file = $telegram->getFile($file_id);
	    $telegram->downloadFile($file["file_path"], "./test_download.png");
	}
	
	else if ($text == "🙋 سوال دارم") {
	    /* Send the Catania's coordinate
	    $content = array('chat_id' => $chat_id, 'latitude' => "37.5", 'longitude' => "15.1" );
	    $telegram->sendLocation($content);*/
		
				$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","hoghogh","")),
				array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","tahsili","")),
				array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","com","")),
				array($telegram->buildInlineKeyboardButton("آشپزی","","chef","")),
				array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","healt","")),
				array($telegram->buildInlineKeyboardButton("معلم پایه تا شیشم","","teacher","")),
			        array($telegram->buildInlineKeyboardButton("..بیشتر","",$callback_data="more",""))  );
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "از لیست زیر لطفاً رسته ای که به سوال شما نزدیکتر می باشد را انتخاب کنید");
		$telegram->sendMessage($content);
	}
	
	else {
		$option = array(array($telegram->buildInlineKeyboardButton("ادامه میدهم", "","beconteniue",""),$telegram->buildInlineKeyboardButton("پایان و ثبت شود","","saveend","")) );
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "سوال شما ثبت گردید در صورت ادامه روی ادامه میدهم کلیک کنید در غیرین صورت پایان و ثبت شود را انتخاب کنید");
		$telegram->sendMessage($content);
	}
 
	

}	 
	
	if ($callback_query !== null && $callback_query != "") {
		
		if ($callback_query['data']=="more"){

			//$testEdit = $telegram->editMessageText(array('chat_id' =>$telegram->Callback_ChatID(), 'text' => "از لیست زیر لطفاً موضوع که به سوال شما نزدیکتر می باشد را انتخاب کنید #2", 'message_id'=> $callback_query["message"]["message_id"]));

			$option = array(array($telegram->buildInlineKeyboardButton("مکانیک", "","machine","")),
			array($telegram->buildInlineKeyboardButton("برق و الکنترونیک","","electronic","")),
			array($telegram->buildInlineKeyboardButton("ریاضی","","math","")),
			array($telegram->buildInlineKeyboardButton("فیزیک","","physic","")),
			array($telegram->buildInlineKeyboardButton("شیمی","","chemistry","")),
			array($telegram->buildInlineKeyboardButton("کشاورزی","","agri","")),
			array($telegram->buildInlineKeyboardButton("◀ برگشت ","","back",""))  );
			$keyb = $telegram->buildInlineKeyBoard($option);

			$testEdit = $telegram->editMessageReplyMarkup(array('chat_id' =>$telegram->Callback_ChatID(),'message_id'=> $callback_query["message"]["message_id"] , 'reply_markup' => $keyb));

			/*$reply = "Callback data value: ".json_encode($telegram->Callback_Query());
			$reply = $reply . json_encode($testEdit);
			$content = array('chat_id' => $telegram->Callback_ChatID(), 'text' =>$reply );
			$telegram->sendMessage($content);*/
		}
		if ($callback_query['data']=="back"){

			//$testEdit = $telegram->editMessageText(array('chat_id' =>$telegram->Callback_ChatID(), 'text' => "از لیست زیر لطفاً موضوع که به سوال شما نزدیکتر می باشد را انتخاب کنید #1", 'message_id'=> $callback_query["message"]["message_id"]));

			$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","hoghogh","")),
			array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","tahsili","")),
			array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","com","")),
			array($telegram->buildInlineKeyboardButton("آشپزی","","chef","")),
			array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","healt","")),
			array($telegram->buildInlineKeyboardButton("معلم پایه تا شیشم","","teacher","")),
			array($telegram->buildInlineKeyboardButton("..بیشتر","",$callback_data="more",""))  );
			
			$keyb = $telegram->buildInlineKeyBoard($option);

			$testEdit = $telegram->editMessageReplyMarkup(array('chat_id' =>$telegram->Callback_ChatID(),'message_id'=> $callback_query["message"]["message_id"] , 'reply_markup' => $keyb));

		}
		
		if ($callback_query['data']=="com"){
			
			$content = array('chat_id' => $telegram->Callback_ChatID(), 'text' =>"لطفاً سوال خود را تایپ کنید یا بوسیله ویز اقدام به ضبط کنید" );
			$telegram->sendMessage($content);
			
			
			
			
			
		}
		
		$content = array('callback_query_id' => $telegram->Callback_ID(), 'text' => $reply, 'show_alert' => true);
		$telegram->answerCallbackQuery($content);   
	}

?>
