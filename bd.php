<?php



$host = "localhost"; // Хост (лучше оставить таким)
$BDuser = "user7436_bot"; // Имя пользователя базы данных
$BDname = "user7436_bot";  // Имя базы данных
$BDpass = "botbot";   // Пароль от пользователя базы данных (пароль от базы)
$bd = new mysqli($host, $BDuser, $BDpass, $BDname);
$bd -> query("SET NAMES 'utf8'");














?>