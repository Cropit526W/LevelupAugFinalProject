<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
        <link rel="stylesheet" href="/css/admin_main.css">
        <link rel="stylesheet" href="/css/admin.css">
    </head>
    <body>
        <header>
            <h2>Admin panel</h2>
            <?php if(!empty($_SESSION['authorized'])){ ?>
                <a href="<?= \app\core\Route::url('login', 'logout'); ?>">Log out</a>
            <?php } ?>
        </header>
        <main>
            <?php include_once self::getPagePath() ?>
        </main>
<!--        <script src="/js/createNewUser.js"></script>-->
        <script src="/js/sendFormWithoutSubmit.js"></script>
    </body>
</html>