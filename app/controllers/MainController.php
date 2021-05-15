<?php

namespace controllers;

class MainController
{
    public function __construct()
    {
        require_once APP_ROOT .'/views/main.php';
    }
}