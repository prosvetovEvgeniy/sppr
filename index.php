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
<!--      -->
<body class="<?php echo $config['preloader'];?>">
  
  <div id="preloader" data-spinner="<?php echo $config['preloader_spinner'];?>" data-screenbg="#fff"></div>

  <!-- Page Wrapper -->
  <div class="page-wrapper">
 
<?php include "includes/header.php" ?>
	
	
    <!-- Demos -->
    <section class="container padding-top-3x padding-bottom-3x" id="demos">
      <h2 class="block-title text-center">
        Выберите один из следующих методов
      </h2>

      <!-- Filters -->
	  <?php
			$methods = mysqli_query($connection, "SELECT * FROM `methods` ORDER BY `id`");
			$flag = true; //чтобы 'Остальное выводилось только 1 раз'
	  ?>
      <div class="text-center padding-top">
        <ul class="nav-filters space-bottom-2x text-center">
          <li class="active"><a href="#" data-filter="*">Все</a></li>
		  <?php
			while(($method = mysqli_fetch_assoc($methods)) && $flag){
			if($method['abbreviation'] == 'Остальное'){
				$flag = false;
			}
		  ?>
          <li><a href="#" data-filter=".<?php echo $method['abbreviation'];?>"><?php echo $method['abbreviation'];?></a></li>
		  <?php } ?>
        </ul><!-- .nav-filters -->
      </div>
      
      <!-- Portfolio Grid -->
      <div class="grid isotope-grid col-3 filter-grid">
        <div class="grid-sizer"></div>
        <div class="gutter-sizer"></div>

        <!-- Portfolio Item -->
		<?php
			$methods = mysqli_query($connection, 'SELECT * FROM `methods` ORDER BY `id`');
		?>
		<?php
			while($method = mysqli_fetch_assoc($methods)){
		?>
			<div class="grid-item <?php echo $method['abbreviation'];?>">
			  <a href="experiment.php?id=<?php echo $method['id'];?>" class="portfolio-item">
				<div class="thumbnail waves-effect waves-light">
				  <img src="<?php echo $method['image'];?>" alt="<?php echo $method['methodName']; ?>">
				</div>
				<h3 class="portfolio-title"><?php echo $method['methodName']; ?></h3>
			  </a>
			</div><!-- .grid-item.apps -->
		<?php } ?>
      </div><!-- .isotope-masonry-grid -->
    </section><!-- .container -->

   

    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->
	<?php include "includes/footer.php" ?>
  </div><!-- .page-wrapper -->
	<?php include "includes/scripts.php" ?>
</body><!-- <body> -->

</html>
