<?php

	$output = json_decode(file_get_contents('php://input'), TRUE);
	$chat_id = $output['message']['chat']['id'];
	$first_name = $output['message']['chat']['first_name'];
	$message = $output['message']['text'];
    $username = $output['message']['from']['username'];
	$preload_text = '';
	  
        if(!empty($output['callback_query'])){

             $chat_id = $output['callback_query']['message']['chat']['id'];
             $first_name = $output['callback_query']['from']['first_name'];
             $message = $output['callback_query']['data'];
             $username = $output['message']['from']['username'];
          }

            require "bd.php";
            $bd->query("INSERT INTO `users` (`id`, `name`, `username`, `chatID`, `botmsg`, `usmsg`, `search`) VALUES (NULL, '".$first_name."', '".$username."', '".$chat_id."', 'null', '".$message."', 'cat');");
            $bd->close();



switch ($message) {


        case "/start":

        $preload_text = $first_name . ', ты щас быканул или мне показалосб?';
        $keyboard = [
    'inline_keyboard' => [
        [
            ['text' => 'hello', 'callback_data' => '/hello'],
            ['text' => 'search', 'callback_data' => '/search'],
            ['text' => 'pic (double pls)', 'callback_data' => '/pic']
        ]
    ]
];
        $encodedKeyboard = json_encode($keyboard);
        message1($preload_text, $chat_id, $encodedKeyboard);
        require "bd.php";
        $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->query("UPDATE `users` SET `botmsg` = '".$preload_text."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->close();
        break;

	case "/hello":

		$preload_text = $first_name . ', я сосал меня ебали';
		message($preload_text, $chat_id);
        require "bd.php";
        $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->query("UPDATE `users` SET `botmsg` = '".$preload_text."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->close();
		break;

        case '/search':
        $preload_text = 'Введите запрос по которому хотели бы получить картинку';
        message($preload_text, $chat_id);
        require "bd.php";
        $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->query("UPDATE `users` SET `botmsg` = '".$preload_text."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->close();
            break;


		case '/pic':
        require "bd.php";
        $result = $bd -> query("SELECT `search` FROM `users` WHERE `users`.`chatID` = ".$chat_id);
        $link = vivod12($result); 
		$te = 'https://images.search.yahoo.com/search/images;_ylt=A0geK.fwxUhdLcoAsj1XNyoA;_ylu=X3oDMTB0N2Noc21lBGNvbG8DYmYxBHBvcwMxBHZ0aWQDBHNlYwNwaXZz?p='.$link.'&fr2=piv-web&fr=yfp-t';
		require_once("parser.php");
		imageS($image, $chat_id);
        $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->query("UPDATE `users` SET `botmsg` = 'img' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->close();
		break;




	
	default:
        require "bd.php";
        $result_setMSG = $bd -> query("SELECT `usmsg` FROM `users` WHERE `users`.`chatID` = ".$chat_id);
        $usmsg = vivod1($result_setMSG);
        $bd->close();



            switch ($usmsg) {
                case '/search':



            require "bd.php";
            $bd->query("UPDATE `users` SET `search` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
            $preload_text = 'параметры поиска установлены! введите /pic (два раза, соре за баг) для получения картинки';
            message($preload_text, $chat_id);
            $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
            $bd->query("UPDATE `users` SET `botmsg` = '".$preload_text."' WHERE `users`.`chatID` = ".$chat_id.";");
             $bd->close();



                    break;
                
                default:



        require "bd.php"; 
        $preload_text = $first_name . ', я получил ваше сообщение!';
        message($preload_text, $chat_id);      
        $bd->query("UPDATE `users` SET `usmsg` = '".$message."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->query("UPDATE `users` SET `botmsg` = '".$preload_text."' WHERE `users`.`chatID` = ".$chat_id.";");
        $bd->close();



                    break;
            }
        
        
		break;
}





















function imageS($image, $id) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.'649942651:AAFp6N8kdrr3ycCjvomt0LPSGX2odsrGIyk'.'/sendPhoto',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $id,
                'photo' => $image,
            ),
            CURLOPT_PROXY => '31.220.51.173:80',
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
        )
    );
    curl_exec($ch);
}


function message1($message, $id, $encodedKeyboard) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.'649942651:AAFp6N8kdrr3ycCjvomt0LPSGX2odsrGIyk'.'/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $id,
                'text' => $message,
                'reply_markup' => $encodedKeyboard,
            ),
            CURLOPT_PROXY => '31.220.51.173:80',
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
        )
    );
    curl_exec($ch);
}


function message($message, $id) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.'649942651:AAFp6N8kdrr3ycCjvomt0LPSGX2odsrGIyk'.'/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $id,
                'text' => $message,
            ),
            CURLOPT_PROXY => '31.220.51.173:80',
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
        )
    );
    curl_exec($ch);
}

function button($keyboard, $id) {
    $ch = curl_init();
    curl_setopt_array(
        $ch,
        array(
            CURLOPT_URL => 'https://api.telegram.org/bot'.'649942651:AAFp6N8kdrr3ycCjvomt0LPSGX2odsrGIyk'.'/sendMessage',
            CURLOPT_POST => TRUE,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 10,
            CURLOPT_POSTFIELDS => array(
                'chat_id' => $id,
                'reply_markup' => json_encode($keyboard),
            ),
            CURLOPT_PROXY => '31.220.51.173:80',
            CURLOPT_PROXYTYPE => CURLPROXY_HTTP,
            CURLOPT_PROXYAUTH => CURLAUTH_BASIC,
        )
    );
    curl_exec($ch);
}

function vivod1($result_set){

    while(($row = $result_set->fetch_assoc()) != false){

        //echo $row["login"];
        //echo "<br />";
        return $row["usmsg"];
        
    }
}

function vivod12($result){

    while(($row = $result->fetch_assoc()) != false){

        //echo $row["login"];
        //echo "<br />";
        return $row["search"];
        
    }
}












?>
<!--  <form method="POST" action="">
	<input type="text" name="message">
	<input type="submit" name="done" value="done">
</form>  -->