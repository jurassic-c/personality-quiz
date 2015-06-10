<?php

define('APP_ROOT',__DIR__);

require __DIR__.'/vendor/autoload.php';
Mustache_Autoloader::register();
require __DIR__.'/lib/app.php';

$app = new App();

$page = $_GET['p'];

$app->process($page);
echo $app->content();