<?php
session_start();
date_default_timezone_set("UTC");

$root = $_SERVER['DOCUMENT_ROOT'] . "/OPTS/";
require($root . 'core/AbstractPage.php');
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
}
