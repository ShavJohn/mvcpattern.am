<?php

session_start();

ini_set('display_error', 1);
error_reporting(E_ALL);

//Includes all system files

define('ROOT', dirname(__FILE__));

require_once(ROOT . '/components/Router.php');
require_once(ROOT . '/components/Autoload.php');
require_once(ROOT . '/components/Db.php');

//Call Router

$router = new Router();
$router->run();

