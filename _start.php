<?php
ob_start();
session_start();
require 'vendor/autoload.php';
use Illuminate\Database\Capsule\Manager as Capsule;
use Philo\Blade\Blade;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

$databasemanagar = new Capsule;
$databasemanagar->setEventDispatcher(new Dispatcher(new Container));
$databasemanagar->setAsGlobal();
$databasemanagar->bootEloquent();

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$template = new Blade($views, $cache);

$version = 1.1;