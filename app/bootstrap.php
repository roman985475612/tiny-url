<?php

require_once 'config/config.php';

spl_autoload_register(function ($className) {
    $path = __NAMESPACE__ . $className . '.php';
    $path = str_replace("\\", "/", $path);
    require_once $path;
});
