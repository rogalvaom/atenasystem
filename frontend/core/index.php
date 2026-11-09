<?php
    require('autoload.php');
    require(__DIR__ . '/../vendor/autoload.php');
    include_once(__DIR__ . '/../env.php');
    include_once(__DIR__ . '/../routes/web.php');

    if (!session_start()) {
        session_start();
    }

    if (empty($_ENV['TIMEZONE'])) {
        echo "Configure a timezone no ENV";
        exit;    
    }

    $_SERVER['PROJECT_ROOT'] = realpath(__DIR__ . '/..');
    
    date_default_timezone_set($_ENV['TIMEZONE']);

    $Router = new Router();
    $Router->runWeb($web);
?>