<?php

namespace core;

class Router
{
    public function __construct()
    {
        $request = $_SERVER['REQUEST_URI'];    

        if ($request == '/' || $request == '/index.php') {
            new \controllers\MainController;
        } elseif ($request == '/form.php') {
            new \controllers\FormController;
        } else {
            new \controllers\RedirectController;
        }
    }
}