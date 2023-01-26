<h2>Here we're creating new users</h2>
<h3>Here will be a form, where new users must be creating</h3>
<h3>And here will be a table with all users, where must be username, and action 'delete user'</h3>

<li class="form">Click to create new user<i class="fa fa-angle-down pull-right"></i></li>
<form action="" method="post" class="dropdown-form">
    <ul>
        <label for="login">Login</label>
        <li><input type="text" name="login"/></li>
        <label for="pass">Password</label>
        <li><input type="password" name="pass"/></li>
        <li><input type="submit" value="Create"/></li>
    </ul>
</form>
<a href="<?= url('user', 'index')?>">Back</a>



