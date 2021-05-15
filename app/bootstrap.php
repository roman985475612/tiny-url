<?php

require_once 'config/config.php';

spl_autoload_register(function ($className) {
    require_once __NAMESPACE__ . $className . '.php';
});
