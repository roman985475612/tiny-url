<?php

namespace controllers;

class FormController
{
    public function __construct()
    {
        if (isset($_POST["url"])) { 
        
            $url = $short = '';
        
            $url = $_POST['url'];
            $url = trim($url);
            $url = stripslashes($url);
            $url = htmlspecialchars($url);

            $db = new \core\DB;
            
            if (empty($result = $db->find('url', $url))) {
                $short = hash('crc32', $url);
        
                $db->insert(
                    url: $url,
                    short: $short
                );
            } else {
                $short = $result['short'];
            }
        
            echo json_encode([
                'short' => $short,
                'url' => $url,
            ]);
        }
    }
}