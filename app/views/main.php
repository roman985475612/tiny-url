<?php require_once APP_ROOT . '/views/header.php' ?>

<div class="container">
        <section class="hero is-link">
            <div class="hero-body">
                <p class="title"><?= APP_NAME ?></p>
                <p class="subtitle">Сервис коротких ссылок</p>
            </div>
        </section>

        <section class="section">
            <div id="notify" class="columns is-mobile is-centered is-hidden">
                <div class="column is-half">
                    <div class="notification is-link is-light">
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

<?php require_once APP_ROOT . '/views/footer.php' ?>