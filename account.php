<?php
require "includes/config.php";
?>
<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <title>Nucleus | Multi-Purpose Technology Template</title>

  <!--SEO Meta Tags-->
  <meta name="description" content="Nucleus Multi-Purpose Technology Template" />
  <meta name="keywords" content="multipurpose, technology, business, corporate, hosting, web, startup, app showcase, mobile, blog, portfolio, landing, shortcodes, html5, css3, jquery, js, gallery, slider, touch, creative" />
  <meta name="author" content="8Guild" />

  <!--Mobile Specific Meta Tag-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

  <!--Favicon-->
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
  <link rel="icon" href="favicon.ico" type="image/x-icon">

  <!-- Vendor Styles -->
  <link href="design/masterslider/style/masterslider.css" rel="stylesheet" media="screen">

  <!-- All Theme Styles including Bootstrap, FontAwesome, etc. compiled from styles.scss-->
  <link href="design/css/styles.css" rel="stylesheet" media="screen">


  <!--Modernizr / Detectizr-->
  <script src="design/js/vendor/modernizr.custom.js"></script>
  <script src="design/js/vendor/detectizr.min.js"></script>
</head>

<body class="<?php echo $config['preloader'];?>">
  

  <div id="preloader" data-spinner="<?php echo $config['preloader_spinner'];?>" data-screenbg="#fff"></div>

  <!-- Page Wrapper -->
  <div class="page-wrapper">

    <!-- Navbar -->
    <!-- Add class ".navbar-sticky" to make navbar stuck when it hits the top of the page. Another modifier class is: "navbar-fullwidth" to stretch navbar and make it occupy 100% of the page width. The screen width at which navbar collapses can be controlled through the variable "$nav-collapse" in sass/variables.scss -->
    <?php include "includes/header.php" ?>


    <section class="page-title">
     
        <h3 class="block-title text-center">Список решенных задач</h3>
     
    </section><!-- .page-title -->

    <!-- Content -->
    <div class="container">
      <section class="grid isotope-grid col-2">
        <div class="gutter-sizer"></div>
        <div class="grid-sizer"></div>
    <?php
        $experiments = mysqli_query($connection, "SELECT * FROM `experiments` WHERE `user_id` = " . (int) $_GET['user_id']);
        while($experiment = mysqli_fetch_assoc($experiments))
        {
    ?>

        <div class="grid-item">
          <article class="post-item">
            <div class="post-body">
              <a href="#" class="post-title">
                <h3><?php echo $experiment['experimentName']; ?></h3>
              </a>
              <p>
                <?php
                  $query = "SELECT `methodName` FROM `methods` WHERE `id`={$experiment['method_id']}";
                  $data = mysqli_query($connection, $query);

                  if(mysqli_num_rows($data) == 1){
                    $type = mysqli_fetch_assoc($data);
                    echo "Метод: " . $type['methodName'];
                  }
                ?>
              </p>
              <a href="story.php?experiment_id=<?php echo $experiment['id'];?>&methodName=<?php echo $type['methodName'];?>">Открыть</a>
            </div><!-- .post-body -->
          </article><!-- .post-item -->
        </div><!-- .grid-item -->

      <?php } ?>

    </div><!-- .container -->

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <?php include "includes/footer.php" ?>
    
  </div><!-- .page-wrapper -->
  <?php include "includes/scripts.php" ?>

</body><!-- <body> -->

</html>
