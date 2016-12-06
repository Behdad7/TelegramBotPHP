 
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
	if ($text == "/start" || $text == "🖱 منوی اصلی") {
		if ($telegram->messageFromGroup()) {
			$reply = "Chat Group";
		} else {
			$reply = " لطفا اگر توانایی و تخصص دارید به عنوان 🕵 پاسخگو میشوم(/rega) در اٍبن سینا ثبت نام کنید. در غیر این صورت  🙋 سوال دارم(/haveq) را انتخاب کنید. ";
		}
	        // Create option for the custom keyboard. Array of array string
	        $option = array( array("🙋 سوال دارم", "🕵 پاسخگو میشوم"), array("📃 راهنمای", "💻 پنل کاربری") );
	        // Get the keyboard
		$keyb = $telegram->buildKeyBoard($option, $onetime=true, $resize=true, $selective=true);
		$content = array('chat_id' => $chat_id,'parse_mode'=>'HTML', 'reply_markup' => $keyb, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	else if ($text == "🕵 پاسخگو میشوم" || $text == "/rega") {
	     $reply = "<b>مدارک مورد نیاز</b> \n1.تصویر مدرک تحصیلی یا حوزوی مرتبط\n2.شماره شبا جهت واریز مبلغ کارکرد\n3.شماره تماس متصل به تلگرام\n4.پذیرش تعهد نامه کاری "; 
		// Build the reply array
	    $content = array('chat_id' => $chat_id,'parse_mode'=>'HTML', 'text' => $reply);
	    $telegram->sendMessage($content);
		
		$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","sinareghoghogh","")),
				array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","sinaregtahsili","")),
				array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","sinaregcom","")),
				array($telegram->buildInlineKeyboardButton("آشپزی","","sinaregchef","")),
				array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","sinareghealt","")),
				array($telegram->buildInlineKeyboardButton("معلم پایه تا ششم","","sinaregteacher","")),
				array($telegram->buildInlineKeyboardButton("مکانیک", "","sinaregmachine","")),
				array($telegram->buildInlineKeyboardButton("برق و الکنترونیک","","sinaregelectronic","")),
				array($telegram->buildInlineKeyboardButton("ریاضی","","sinaregmath","")),
				array($telegram->buildInlineKeyboardButton("فیزیک","","sinaregphysic","")),
				array($telegram->buildInlineKeyboardButton("شیمی","","sinaregchemistry","")),
				array($telegram->buildInlineKeyboardButton("کشاورزی","","sinaregagri","")));
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
	
	else if ($text == "🙋 سوال دارم" || $text == "/haveq") {
	    /* Send the Catania's coordinate
	    $content = array('chat_id' => $chat_id, 'latitude' => "37.5", 'longitude' => "15.1" );
	    $telegram->sendLocation($content);*/
		
				$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","sinaQAhoghogh","")),
				array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","sinaQAtahsili","")),
				array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","sinaQAcom","")),
				array($telegram->buildInlineKeyboardButton("آشپزی","","sinaQAchef","")),
				array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","sinaQAhealt","")),
				array($telegram->buildInlineKeyboardButton("معلم پایه تا ششم","","sinaQAteacher","")),
			        array($telegram->buildInlineKeyboardButton("بیشتر..","",$callback_data="more",""))  );
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "از لیست زیر لطفاً رسته ای که به سوال شما نزدیکتر می باشد را انتخاب کنید");
		$telegram->sendMessage($content);
	}
	
	else if ($text == "💻 پنل کاربری" ) {

		$reply = " لطفا اگر توانایی و تخصص دارید به عنوان 🕵 پاسخگو میشوم(/rega) در اٍبن سینا ثبت نام کنید. در غیر این صورت  🙋 سوال دارم(/haveq) را انتخاب کنید. ";
	
		// Create option for the custom keyboard. Array of array string
		$option = array( array("🖱 منوی اصلی", "❌ لغو ارتباط فعلی"));
		// Get the keyboard
		$keyb = $telegram->buildKeyBoard($option, $onetime=true, $resize=true, $selective=true);
		$content = array('chat_id' => $chat_id,'parse_mode'=>'HTML', 'reply_markup' => $keyb, 'text' => $reply);
		$telegram->sendMessage($content);
	}
	
	else if ($text == "❌ لغو ارتباط فعلی" || $text == "/laghv") {
		$post = [
				'idUser' => $chat_id

			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://ibnsina.srv.parperook.ir/laghv.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$server_output = curl_exec ($ch);
			curl_close ($ch);
	
	}
	else {
		/*$option = array(array($telegram->buildInlineKeyboardButton("ادامه میدهم", "","beconteniue",""),$telegram->buildInlineKeyboardButton("پایان و ثبت شود","","saveend","")) );
		$keyb = $telegram->buildInlineKeyBoard($option);
		$content = array('chat_id' => $chat_id, 'reply_markup' => $keyb, 'text' => "سوال شما ثبت گردید در صورت ادامه روی ادامه میدهم کلیک کنید در غیرین صورت پایان و ثبت شود را انتخاب کنید");
		$telegram->sendMessage($content);*/
		
			
			$post = [
				'idUser' => $chat_id

			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://ibnsina.srv.parperook.ir/send_msg.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			
			$server_output = curl_exec ($ch);
			curl_close ($ch);
 
			$content = array('chat_id' => $server_output, 'text' => $text  );
			$telegram->sendMessage($content);

		/*	if (strpos( $server_output,"id_sina")){
	
			$json = $server_output;
			$result = var_dump(json_decode($json, true));
			$obj = json_decode( $server_output);

			$content = array('chat_id' => '233135729', 'text' =>  "1ایدی کاربر\n" );
			$telegram->sendMessage($content);
			
			if (strpos( $server_output,"id_sina")){

						$content = array('chat_id' => $server_output['Items']['id'], 'text' => $server_output->Items."ایدی سینا \n " . $chat_id . $server_output );
						$telegram->sendMessage($content);
				}			
				else{
					
						$content = array('chat_id' => '233135729', 'text' =>$server_output['Items']['id'] . "2ایدی کاربر\n'" . $server_output." ' " . $obj  );
						$telegram->sendMessage($content);
					
					
				}
		
	}*/

}	 
}
	
	if ($callback_query !== null && $callback_query != "") {
		
		if ($callback_query['data']=="more"){

			//$testEdit = $telegram->editMessageText(array('chat_id' =>$telegram->Callback_ChatID(), 'text' => "از لیست زیر لطفاً موضوع که به سوال شما نزدیکتر می باشد را انتخاب کنید #2", 'message_id'=> $callback_query["message"]["message_id"]));

			$option = array(array($telegram->buildInlineKeyboardButton("مکانیک", "","sinaQAmachine","")),
			array($telegram->buildInlineKeyboardButton("برق و الکنترونیک","","sinaQAelectronic","")),
			array($telegram->buildInlineKeyboardButton("ریاضی","","sinaQAmath","")),
			array($telegram->buildInlineKeyboardButton("فیزیک","","sinaQAphysic","")),
			array($telegram->buildInlineKeyboardButton("شیمی","","sinaQAchemistry","")),
			array($telegram->buildInlineKeyboardButton("کشاورزی","","sinaQAagri","")),
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

			$option = array(array($telegram->buildInlineKeyboardButton("مشاوره حقوقی", "","sinaQAhoghogh","")),
			array($telegram->buildInlineKeyboardButton("مشاوره کمک آموزشی","","sinaQAtahsili","")),
			array($telegram->buildInlineKeyboardButton("مهندسی کامپیوتر","","sinaQAcom","")),
			array($telegram->buildInlineKeyboardButton("آشپزی","","sinaQAchef","")),
			array($telegram->buildInlineKeyboardButton("بهداشت و درمان","","sinaQAhealt","")),
			array($telegram->buildInlineKeyboardButton("معلم پایه تا ششم","","sinaQAteacher","")),
			array($telegram->buildInlineKeyboardButton("بیشتر..","",$callback_data="more",""))  );
			
			$keyb = $telegram->buildInlineKeyBoard($option);

			$testEdit = $telegram->editMessageReplyMarkup(array('chat_id' =>$telegram->Callback_ChatID(),'message_id'=> $callback_query["message"]["message_id"] , 'reply_markup' => $keyb));

		}
		
		if (strpos($callback_query['data'],"reg")){
			
			$post = [
				'idUser' =>  $telegram->Callback_ChatID(),
				'Cat' => $callback_query['data'],
				'first_name' =>  $callback_query['from']['first_name']
			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://ibnsina.srv.parperook.ir/addsina.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec ($ch);
			curl_close ($ch);
				
			$content = array('chat_id' => $telegram->Callback_ChatID(), 'text' =>"" . $server_output  .$callback_query['from']['first_name'] );
			$telegram->sendMessage($content);
			
		}
		
		
		if (strpos($callback_query['data'],"inaQA") ){
			
			$post = [
				'idUser' =>  $telegram->Callback_ChatID(),
				'Cat' =>substr( $callback_query['data'],6),
				'first_name' =>  $callback_query['from']['first_name']
			];
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,"http://ibnsina.srv.parperook.ir/get_sina.php");
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post); 
			// receive server response ...
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec ($ch);
			curl_close ($ch);

			$content = array('chat_id' => $telegram->Callback_ChatID(), 'text' => $server_output  );
			$telegram->sendMessage($content);

		}

		//$content = array('callback_query_id' => $telegram->Callback_ID(), 'text' => $reply, 'show_alert' => true);
		//$telegram->answerCallbackQuery($content);   
	}

?>
