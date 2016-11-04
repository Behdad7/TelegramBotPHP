<?php

include("Telegram.php");
$telegram = new Telegram('258123864:AAGf0QayDyTslQ1-V5d3hb49nD3y0C1b424');
$chat_id = $telegram->ChatID();
$content = array('chat_id' => $chat_id, 'text' => "Test");
$telegram->sendMessage($content);
