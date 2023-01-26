<h2>Creat new user</h2>

<form class="w3-container" action="<?= url('user', 'store') ?>" method="post">
        <div class="w3-panel">
            <label for="login">Login</label>
            <input class="w3-input w3-border w3-animate-input" type="text" name="login" id="login"/>
            <label for="pass">Password</label>
            <input class="w3-input w3-border w3-animate-input" type="password" name="pass" id="pass"/>
        </div>
        <div class="w3-panel">
            <input class="w3-button w3-green w3-round" type="submit" value="Create"/>
        </div>
</form>
<a href="<?= url('user', 'index')?>">Back</a>



