<?php

if (!defined('APP_ROOT')) {
    define('APP_ROOT', dirname(__DIR__));
}

spl_autoload_register(function ($classe) {
    $prefixo = 'App\\';

    if (strpos($classe, $prefixo) !== 0) {
        return;
    }

    $relativo = substr($classe, strlen($prefixo));
    $arquivo = APP_ROOT . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $relativo) . '.php';

    if (file_exists($arquivo)) {
        require_once $arquivo;
    }
});

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
