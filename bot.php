<?php

	$output = json_decode(file_get_contents('php://input'), TRUE);
	$chat_id = $output['message']['chat']['id'];
	$first_name = $output['message']['chat']['first_name'];
	$message = $output['message']['text'];

	$preload_text = '';
	


switch ($message) {
	case "/hello":

		$preload_text = $first_name . ', я сосал меня ебали';
		message($preload_text, $chat_id);

		break;

		case '/pic':

		$te = 'https://images.search.yahoo.com/search/images?fr=yfp-t&p=anime&fr2=p%3As%2Cv%3Ai&.bcrumb=HjL1RLVuhVI&save=0&guccounter=1';
		require_once("parser.php");
		imageS($imgHENT, $chat_id);
		
		break;

		case '/hent':

		$te = 'https://images.search.yahoo.com/search/images?fr=yfp-t&p=hentai&fr2=p%3As%2Cv%3Ai&.bcrumb=HjL1RLVuhVI&save=0';
		require_once("parser.php");
		imageS($imgHENT, $chat_id);
		
		break;
	
	default:

		$preload_text = $first_name . ', я получил ваше сообщение!';
		message($preload_text, $chat_id);

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





?>
<!--  <form method="POST" action="">
	<input type="text" name="message">
	<input type="submit" name="done" value="done">
</form>  -->