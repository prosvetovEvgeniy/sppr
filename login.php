<?php
require "includes/config.php";
session_start();

    if(isset($_POST['log_in'])){
        $login = mysqli_real_escape_string($connection, trim($_POST['username']));
        $password = mysqli_real_escape_string($connection, trim($_POST['password']));
        $query = "SELECT `id`, `login` FROM `users` WHERE `login` = '$login' AND `password` = SHA('$password')";
        $data = mysqli_query($connection, $query);

        if(mysqli_num_rows($data) == 1){

            $row = mysqli_fetch_assoc($data);

            $_SESSION['user_id'] = $row['id'];
            $_SESSION['username'] = $row['login'];

            $home_url = '/index.php';
            header('location: ' . $home_url);
        }
        else {
            $error = "Ошибка: не правильный логин или пароль";
        }
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Nucleus | Checkout</title>
    <!--SEO Meta Tags-->
    <meta name="description" content="Nucleus Multi-Purpose Technology Template" />
    <meta name="keywords" content="multipurpose, technology, business, corporate, hosting, web, startup, app showcase, mobile, blog, portfolio, landing, shortcodes, html5, css3, jquery, js, gallery, slider, touch, creative" />
    <meta name="author" content="8Guild" />
    <!--Mobile Specific Meta Tag-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!--Favicon-->
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- All Theme Styles including Bootstrap, FontAwesome, etc. compiled from styles.scss-->
    <link href="design/css/styles.css" rel="stylesheet" media="screen">
    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
    <!--Modernizr / Detectizr-->
    <script src="design/js/vendor/modernizr.custom.js"></script>
    <script src="design/js/vendor/detectizr.min.js"></script>
</head>
<body>
    <div class="modal-dialog">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content text-center">
            <form method="post" action="<?php echo 'login.php';?>">
                <input type="text" name="username" class="form-control" placeholder="Логин" required>
                <input type="password" name="password" class="form-control" placeholder="Пароль" required>
                <h6 style="color:#ff3304;""><?php if(isset($error)) echo $error; ?></h6>
                <div class="form-group">
                    <button type="submit" name="log_in" class="btn login-btn btn-default waves-effect waves-light">Войти в аккаунт<i class="icon-head"></i></button>
                </div>
                <div class="space-bottom-2x">
                    <a href="index.php" class="btn btn-sm btn-ghost btn-primary waves-effect waves-light btn-icon-right">На главную<i class="icon-download"></i></a>
                </div>
            </form><!-- <form> -->
        </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
</body>
</html>
