<?php

namespace controllers;

class RedirectController
{
    public function __construct()
    {
        $request = trim($_SERVER['REQUEST_URI'], '/');

        $db = new \core\DB;
            
        $result = $db->find('short', $request);

        if (!empty($result)) {
            if (substr($result['url'], 0, 4) !== 'http') {
                $redirectUrl = '//' . $result['url'];
            } else {
                $redirectUrl = $result['url'];
            }
        } else {
            $redirectUrl = '/';
        }

        header("Location: " . $redirectUrl);
        
        exit();
    }
}