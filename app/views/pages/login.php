<form class="w3-container" action="<?= url('login', 'login') ?>" method="post">
    <div class="w3-panel">
        <?php if (!empty($_GET['error'])) { ?>
            <div>
            <?php if ($_GET['error'] === '1') { ?>
                Введён неверный пароль
            <?php } else if ($_GET['error'] === '2') { ?>
                Введён неверный логин
            <?php } ?>
            </div>
        <?php } ?>
        <label for="login">Login:</label>
        <input class="w3-input w3-border w3-animate-input" type="text" name="login" id="login" required autofocus/>
        <label for="pass">Password</label>
        <input class="w3-input w3-border w3-animate-input" type="password" name="pass" id="pass" required/>
    </div>
    <div class="w3-panel">
        <input class="w3-button w3-green w3-round" type="submit" value="Log In"/>
    </div>
</form>