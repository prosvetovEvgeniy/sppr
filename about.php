<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Nucleus | About Us</title>

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
    

    <!-- Modal -->
   

    <!-- Navbar -->
    <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
    <?php include "includes/header.php" ?>

    <!-- Page Title -->
    <!--Add modifier class : "pt-fullwidth" to stretch page title and make it occupy 100% of the page width. -->
    <section class="page-title">
      <div class="container">
        <div class="inner">
          <div class="column">
            
          </div><!-- .column -->
          <div class="column">
            
          </div><!-- .column -->
        </div>
      </div>
    </section><!-- .page-title -->

    <!-- Team Type 1 -->
    <section class="container padding-bottom-3x">
      <h2 class="block-title text-center">
        Разработчики
        
      </h2>
      <div class="row padding-top">
        <!-- Teammate -->
        <div class="col-lg-6 col-sm-12">
          <div class="teammate-1 text-center">
            <div class="thumbnail">
              <div class="flipper">
                <div class="front">
                  <img src="design/img/about/me.jpg" alt="Team">
                </div>
                <div class="back">
                  <p class="padding-top">Студент Сибирского Аэрокосмического Университета.</p>
                </div>
              </div>
            </div>
            <h3 class="teammate-name">Просветов Евгений</h3>
            <p>Разработчик и Тестировщик</p>
          </div>
        </div>
        <!-- Teammate -->
        <div class="col-lg-6 col-sm-12">
          <div class="teammate-1 text-center">
            <div class="thumbnail">
              <div class="flipper">
                <div class="front">
                  <img src="design/img/about/morgunova.jpg" alt="Team">
                </div>
                <div class="back">
                  <p class="padding-top">Доцент кафедры информатики и вычислительной техники.</p>
                </div>
              </div>
            </div>
            <h3 class="teammate-name">Моргунова Ольга Николаевна</h3>
            <p>Javascript-специалист</p>
          </div>
        </div>
        <!-- Teammate -->
       
      </div><!-- .row -->
    </section><!-- .container -->

    <!-- Logo Carousel -->
    

    <!-- Counters (Animated Digits) -->
    

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <!-- Footer -->
    <?php include "includes/footer.php" ?>
  </div><!-- .page-wrapper -->
	<?php include "includes/scripts.php" ?>

</body><!-- <body> -->

</html>
