<form class="w3-container" action="<?= url('admin', 'login')?>" method="post">
    <div class="w3-panel">
        <label for="login">Login:</label>
        <input class="w3-input w3-border w3-animate-input" type="text" name="login" id="login" required autofocus/>
        <label for="pass">Password</label>
        <input class="w3-input w3-border w3-animate-input" type="password" name="pass" id="pass" required/>
    </div>
    <div class="w3-panel">
        <input class="w3-button w3-green w3-round" type="submit" value="Log In"/>
    </div>
</form>