<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <title>Document</title>
    </head>
    <body>
        <header><h1><a href="/">Final project</a></h1></header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="<?= url('task', 'index') ?>">Tasks</a></li>
            </ul>
        </nav>
    <main>
        <?php include_once self::getPagePath() ?>
    </main>
    </body>
</html>