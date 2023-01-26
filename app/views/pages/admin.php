<form action="<?= url('admin', 'login')?>" method="post">
    <label for="login">Login:</label>
    <input type="text" name="login" id="login" autofocus/>
    <label for="pass">Password</label>
    <input type="password" name="pass" id="pass"/>
    <input type="submit" value="Log In"/>
</form>