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

require "bd.php";
$resu = $bd -> query("SELECT `num` FROM `pic` WHERE `name`='botya'");
$num = vivodPar($resu);
if($num >= 100){$num = 0;}

$image = $array[$num];
echo $image;

$num++;
$bd ->query("UPDATE `pic` SET `num` = '".$num."' WHERE `pic`.`name` = 'botya';");
$bd ->close();
$html ->clear();









function vivodPar($resu){

    while(($row = $resu->fetch_assoc()) != false){

        //echo $row["login"];
        //echo "<br />";
        return $row["num"];
        
    }
}
?>