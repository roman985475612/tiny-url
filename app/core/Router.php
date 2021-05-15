<?php

namespace core;

class Router
{
    public function __construct()
    {
        $url = trim($_SERVER['REQUEST_URI'], '/');
        $method = $_SERVER['REQUEST_METHOD'];    

        if ($url == '' || $url == 'index.php') {
            new \controllers\MainController;
        } elseif ($method == 'POST' && $url == 'form') {
            new \controllers\FormController;
        } else {
            new \controllers\RedirectController;
        }
    }
}