<form action="<?= url('user', 'login')?>" method="post" >
    <label for="login">Login:</label>
    <input type="text" name="login" autofocus/>
    <label for="pass">Password</label>
    <input type="password" name="pass"/>
    <input type="submit" value="Log In"/>
</form>