<?php

use core\DB;

spl_autoload_register();

$db = new DB(
    host: 'localhost',
    user: 'root',
    pass: 'root',
    db: 'db_tinyurl'
);

if (isset($_POST["url"])) { 

    $url = $short = '';

    $url = $_POST['url'];
    $url = trim($url);
    $url = stripslashes($url);
    $url = htmlspecialchars($url);

    if (substr($url, 0, 4) !== 'http') {
        $url = '//' . $url;
    }

    if (empty($result = $db->find('url', $url))) {
        $short = hash('crc32', $url);

        $db->insert(
            url: $url,
            short: $short
        );
    } else {
        $short = $result['short'];
    }

    echo json_encode(['short' => $short]);
}