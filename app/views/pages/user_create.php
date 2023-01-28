<h2>Creat new user</h2>

<form class="w3-container" action="<?= url('user', 'store') ?>" method="post" autocomplete="new-password">
    <div class="w3-panel">
        <label for="login">Login</label>
        <input class="w3-input w3-border w3-animate-input" type="text" name="login" id="login" required autofocus/>
        <label for="pass">Password</label>
        <input class="w3-input w3-border w3-animate-input" type="password" name="pass" id="pass" required/>
    </div>
    <div class="w3-panel">
        <input class="w3-button w3-green w3-round" type="submit" value="Create"/>
    </div>
</form>

<div class="w3-container">
    <div class="w3-panel">
        <?php if (count($errors) > 0) : ?>
            User registration is not possible:
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif;?>
    </div>
</div>

<div class="w3-container">
    <div class="w3-panel">
        <a class="w3-button w3-blue w3-round" href="<?= url('user', 'index')?>">Back</a>
    </div>
</div>



