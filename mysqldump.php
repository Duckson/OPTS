<?php

$dbhost   = "localhost";
$dbuser   = "root";
$dbpwd    = "root";
$dbname   = "practice";
$dumpfile = "OPTS.sql";

exec("e:/Coding/MAMP/bin/mysql/bin/mysqldump --opt --host=$dbhost --user=$dbuser --password=$dbpwd $dbname > $dumpfile");

