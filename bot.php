<?php
$token = "649942651:AAFp6N8kdrr3ycCjvomt0LPSGX2odsrGIyk"; //наш токен от telegram bot -а
$chatid = "630116922"; //ИД чата telegrm
$mess = ""; //сообщение
if (isset($_POST['done'])&&isset($_POST['message'])){ 

$mess = $_POST['message'];

$tbot = file_get_contents("https://api.telegram.org/bot".$token."/sendMessage?chat_id=".$chatid."&text=".urlencode($mess));

}














?>
<form method="POST" action="">
	<input type="text" name="message">
	<input type="submit" name="done" value="done">
</form>