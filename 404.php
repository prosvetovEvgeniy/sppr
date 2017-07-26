<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Nucleus | 404</title>

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

  <!--Modernizr / Detectizr-->
  <script src="design/js/vendor/modernizr.custom.js"></script>
  <script src="design/js/vendor/detectizr.min.js"></script>
</head>

<!-- Body -->
<!-- "is-preloader preloading" is a helper classes if preloader is enabled. -->
<body class="<?php echo $config['preloader'];?>">

  <!-- Preloader -->
  <!--
      Data API:
      data-spinner - Options: 'spinner1', 'spinner2', 'spinner3', 'spinner4', 'spinner5', 'spinner6', 'spinner7'
      data-screenbg - Screen background color. Hex, RGB or RGBA colors
   -->
  <div id="preloader" data-spinner="<?php echo $config['preloader_spinner'];?>" data-screenbg="#fff"></div>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Social Bar -->
    <!-- Change modifier class to ".bar-fixed-left" to position social bar on the left side of the page. -->
    <div class="social-bar bar-fixed-right">
      <a href="#" class="sb-skype">
        <i class="fa fa-skype"></i>
      </a>
      <a href="#" class="sb-facebook">
        <i class="fa fa-facebook"></i>
      </a>
      <a href="#" class="sb-twitter">
        <i class="fa fa-twitter"></i>
      </a>
    </div><!-- .social-bar -->

    <!-- Container -->
    <div class="container text-center padding-top-3x">
      <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1">
          <h2 class="text-thin space-top">404 Страница не найдена</h2>
          <a href="index.php" class="btn btn-default waves-effect waves-light">Вернуться на главную</a>
          <img class="block-center space-top-2x" src="design/img/404.png" alt="404">
        </div>
      </div><!-- .row -->
    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i>
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>

  </div><!-- .page-wrapper -->

  <!-- JavaScript (jQuery) libraries, plugins and custom scripts -->
  <?php include "includes/scripts.php" ?>

</body><!-- <body> -->

</html>
