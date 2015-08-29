<?php
include('_start.php');

$databasemanagar->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'panelo',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

$debug = false;

include('_load.php');
