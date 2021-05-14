<?php
$request = $_SERVER['REQUEST_URI'];
$request = trim($request, '/');    

if ($request) {
    spl_autoload_register();

    $db = new \core\DB(
        host: 'localhost',
        user: 'root',
        pass: 'root',
        db: 'db_tinyurl'
    );
    
    if (!empty($result = $db->find('short', $request))) {
        $redirectUrl = $result['url'];
        if (substr($redirectUrl, 0, 4) !== 'http') {
            $redirectUrl .= '//';
        }

        header("Location: " . $redirectUrl);
        exit();
    } else {
        header("Location: /");
    }
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
            <div id="notify" class="columns is-mobile is-centered is-hidden">
                <div class="column is-half">
                    <div class="notification is-primary is-light">
                        <button class="delete"></button>
                        <h3 class="title is-4">Ваша ссылка:</h3>
                        <a id="link" target="_blank" class="subtitle is-4"></a>
                    </div>
                </div>
            </div>

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

    <script src="/js/main.js"></script>
</body>
</html>