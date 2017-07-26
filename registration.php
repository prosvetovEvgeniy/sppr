<?php
require "includes/config.php";

if(isset($_POST['register'])){
    $login = mysqli_real_escape_string($connection, trim($_POST['login']));
    $email = mysqli_real_escape_string($connection, trim($_POST['email']));
    $password1 = mysqli_real_escape_string($connection, trim($_POST['password1']));
    $password2 = mysqli_real_escape_string($connection, trim($_POST['password2']));

    if($password1 == $password2){
        $query = "SELECT * FROM `users` WHERE login = '$login'";
        $data = mysqli_query($connection, $query);

        if(mysqli_num_rows($data) == 0){
            $query = "INSERT INTO `users` (login, password, email) VALUES ('$login', SHA('$password1'), '$email')";
            mysqli_query($connection, $query);

            $home_url = '/index.php';
            header('location: ' . $home_url);
        }
        else{
            $error = "Ошибка: логин уже существует";
        }
    }
}

if(isset($_POST['home'])){
    $home_url = '/index.php';
    header('location: ' . $home_url);
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

<div class="modal-dialog text-center">
    <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <div class="modal-content text-center">
        <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="text" class="form-control" name="login" placeholder="Введите ваш логин" required>
            <input type="email" class="form-control" name="email" placeholder="Введите ваш email" required>
            <input type="password" class="form-control" name="password1" placeholder="Введите ваш пароль" required>
            <input type="password" class="form-control" name="password2" placeholder="Введите пароль еще раз" required>
            <h6 style="color:#ff3304;""><?php if(isset($error)) echo $error; ?></h6>
            <div class="form-group">
                <button type="submit" name="register" class="btn login-btn btn-default waves-effect waves-light">Зарегистрироваться<i class="icon-head"></i></button>
            </div>
            <div class="space-bottom-2x">
                <a href="index.php" class="btn btn-sm btn-ghost btn-primary waves-effect waves-light btn-icon-right">На главную<i class="icon-download"></i></a>
            </div>
        </form><!-- <form> -->

    </div><!-- .modal-content -->
    <p><?php echo $a; ?></p>
</div><!-- .modal-dialog -->
</body>
</html>
