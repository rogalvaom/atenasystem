<?php
spl_autoload_register(function ($className) {
    $projectRoot = dirname(__DIR__);

    $baseDirs = [
        $projectRoot . '/core/lib/',     
    ];

    foreach ($baseDirs as $baseDir) {
        $file = $baseDir . $className . '.php';

        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    throw new Exception("Classe '{$className}' não encontrada no autoload.");
});
