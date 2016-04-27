<?php

$root = $_SERVER['DOCUMENT_ROOT'] . "/OPTS/";
require($root . 'model/Config.php');

$file = file_get_contents($root . 'OPTS.sql');
$sql = Config::get()->db;
$sql->query($file);
$error = $sql->error;
var_dump($error);
