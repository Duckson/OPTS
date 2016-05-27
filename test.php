<?php
session_start();
date_default_timezone_set("UTC");

$root = $_SERVER['DOCUMENT_ROOT'] . "/OPTS/";
require($root . 'core/AbstractPage.php');
require($root . 'model/DB.php');
require($root . 'model/Config.php');
spl_autoload_register('\Config::Loader');

$joins = [
    ['student_app_link', ['student_app_link.student_id', 'students.id']],
    ['applications', ['student_app_link.app_id', 'applications.id']],
    ['contracts', ['contracts.id', 'applications.contract_id']],
    ['companies', ['companies.id', 'contracts.company_id']]
];
$table = new \model\Table((\Config::get()->db), 'students', $joins);

var_dump($table->select('*', [0 => ['students.id', 1, '=']]));

