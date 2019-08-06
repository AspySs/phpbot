<?php
//подключили библиотеку
require_once 'simple_html_dom.php';
$html = file_get_html($te);
$array = array();
$i = 0;
foreach($html->find('img') as $element) { //выборка всех тегов img на странице
        $array[$i] = $element->src; // построчный вывод содержания всех найденных атрибутов src
        $i++;
}


$host = "localhost"; // Хост (лучше оставить таким)

$BDuser = "user7436_bot"; // Имя пользователя базы данных

$BDname = "user7436_bot";  // Имя базы данных

$BDpass = "botbot";   // Пароль от пользователя базы данных (пароль от базы)


$bd = new mysqli($host, $BDuser, $BDpass, $BDname);
$bd -> query("SET NAMES 'utf8'");
$result_set = $bd -> query("SELECT `num` FROM `pic` WHERE `name`='botya'");
$num = vivod($result_set);
if($num >= 70){$num = 0;}


$imgHENT = $array[$num];


$num++;
$bd ->query("UPDATE `pic` SET `num` = '".$num."' WHERE `pic`.`name` = 'botya';");
$bd ->close();
$html ->clear();









function vivod($result_set){

    while(($row = $result_set->fetch_assoc()) != false){

        //echo $row["login"];
        //echo "<br />";
        return $row["num"];
        
    }
}
?>