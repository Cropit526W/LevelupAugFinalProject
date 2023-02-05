<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="/css/main.css">
        <script "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <header>
                <h1><a href="/">BULLETIN BOARD</a></h1>
                <?php if (isset($_SESSION['authorized'])):?>
                    <div class="w3-bar w3-green">
                        <a href="<?= url('ads', 'index')?>" class="w3-bar-item w3-button">All Ads</a>
                        <a href="<?= url('ads', 'create')?>" class="w3-bar-item w3-button">New Ad</a>
                        <a href="<?= url('user', 'index')?>" class="w3-bar-item w3-button">Users</a>
                        <a href="<?= url('login', 'logout')?>" class="w3-bar-item w3-button"><i class="fa fa-sign-out"></i></a>
                    </div>
                <?php endif;?>
        </header>
    <main>
        <?php include_once self::getPagePath() ?>
    </main>
        <script src="/js/sliderForPhotoOnIndex.js"></script>
    </body>
</html>