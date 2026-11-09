<?php
    require('autoload.php');
    require(__DIR__ . '/../vendor/autoload.php');
    include_once(__DIR__ . '/../env.php');
    include_once(__DIR__ . '/../routes/api.php');

    if (!session_start()) {
        session_start();
    }

    // SETAR HORARIO DO SERVIDOR
    if (empty($_ENV['TIMEZONE'])) {
        echo "Configure a timezone no ENV";
        exit;    
    }

    $_SERVER['PROJECT_ROOT'] = realpath(__DIR__ . '/..');
    
    date_default_timezone_set($_ENV['TIMEZONE']);

    $Router = new Router();
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Origin: http://localhost");
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: GET,POST,PUT,DELETE,OPTIONS");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    $Router->runApi($api);
?>