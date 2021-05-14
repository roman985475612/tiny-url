<?php

use core\DB;

spl_autoload_register();

$db = new DB(
    host: 'localhost',
    user: 'root',
    pass: 'root',
    db: 'db_tinyurl'
);

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_SESSION['short'])) {
        $short = $_SESSION['short'];
        unset($_SESSION['short']);
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $url = $short = '';

    $url = $_POST['url'];
    $url = trim($url);
    $url = stripslashes($url);
    $url = htmlspecialchars($url);
    
    if (empty($result = $db->find('url', $url))) {
        $short = hash('crc32', $url);

        $db->insert(
            url: $url,
            short: $short
        );
    } else {
        $short = $result['short'];
    }

    $_SESSION['short'] = $short;

    header('Location: /');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.2/css/bulma.min.css">
    <title>Tiny URL</title>
</head>
<body>
    <div class="container">
        <section class="hero is-success">
            <div class="hero-body">
                <p class="title">Tiny URL</p>
                <p class="subtitle">Сервис коротких ссылок</p>
            </div>
        </section>

        <section class="section">
            <?php if (!empty($short)): ?>
            <div class="columns is-mobile is-centered">
                <div class="column is-half">
                    <div class="notification is-primary is-light">
                        <button class="delete"></button>
                        <h3 class="title is-4">Ваша ссылка:</h3>
                        <a class="subtitle is-4" href="//<?= $_SERVER['HTTP_HOST'] . '/' . $short ?>"><?= $_SERVER['HTTP_HOST'] . '/' . $short ?></a>
                    </div>
                </div>
            </div>
            <?php endif ?>

            <div class="columns is-mobile is-centered">
                <div class="column is-half">
                    <form action="" method="POST" class="box">
                        <div class="field">
                            <label class="label">URL</label>
                            <div class="control">
                                <input name="url" class="input" type="text" placeholder="Введите URL">
                            </div>
                        </div>

                        <div class="field is-grouped">
                            <div class="control">
                                <button class="button is-link">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            (document.querySelectorAll('.notification .delete') || []).forEach(($delete) => {
                const $notification = $delete.parentNode;

                $delete.addEventListener('click', () => {
                $notification.parentNode.removeChild($notification);
                });
            });
        });
    </script>
</body>
</html>