<?php
session_start();
date_default_timezone_set("UTC");

/*$root = $_SERVER['DOCUMENT_ROOT'] . "/OPTS/";
require($root . 'core/AbstractPage.php');
require($root . 'core/AddingPage.php');
require($root . 'model/Post.php');
require($root . 'model/Config.php');
spl_autoload_register('Post::Loader');
$class_name = $_GET['page'];
$page = new $class_name();

try {                                                        
    $page->run();                               
} catch (Exception $e) {
    $err_page = new Error($e);
    $err_page->run();
}*/

$root = $_SERVER['DOCUMENT_ROOT'] . "/OPTS/";
require($root . 'core/AbstractPage.php');
require($root . 'model/Post.php');
require($root . 'model/Config.php');
spl_autoload_register('\Post::Loader');

$route = isset($_GET['page'])?explode('/',$_GET['page']):['DefaultController','login']; // если не передана страница, считаем что передано default/index
if(count($route)<2) $route[]='login'; // если передано, но не разделилось на 2 части, то считаем что вторая часть index
list($class_name,$method_name) = $route; // раскладываем элементы массива по переменным

$page_namespace = 'pages\\';
$full_class_name = $page_namespace.$class_name;
$page = new $full_class_name(); // файл класса у нас подгрузится автолоадером
try{
    $page->run($method_name);
}catch(Exception $e){
    $err_page = new ErrorPage($e);
    $err_page->run();
}
