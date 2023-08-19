<?php
require_once (__DIR__ . '/config.php');
require_once (__DIR__ . '/router.php');
require_once (__DIR__ . '/database.php');
require_once (__DIR__ . '/models/orm.php');
$router = new Router();
$router->run();
?>