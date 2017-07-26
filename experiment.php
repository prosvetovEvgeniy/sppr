<?php
require "includes/config.php";
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

<body class="<?php echo $config['preloader'];?>">

  <div id="preloader" data-spinner="<?php echo $config['preloader_spinner'];?>" data-screenbg="#fff"></div>

    <?php include "includes/header.php" ?>

	<?php
		$methods = mysqli_query($connection, "SELECT * FROM `methods` WHERE `id` = " . (int) $_GET['id']);
		$method = mysqli_fetch_assoc($methods);
	?>
	
    <section class="page-title">
      <div class="container">
        <h3 class="block-title text-center"><?php 
			if($method['methodName'] == 'Метод анализа иерархий'){
				echo 'Метод анализа иерархии';
				echo '<small><span class="text-default"></span>Для решения задачи необходимы следующие входные данные: </small>';
			}
			else if($method['methodName'] == 'Принятие решений в условиях неопределенности'){
				echo 'Метод принятие решений в условиях неопределенности';
				echo '<small><span class="text-default"></span>Для решения задачи необходимы следующие входные данные: </small>';
			}
			else if($method['methodName'] == 'Принятие решений в условиях риска'){
				echo 'Метод принятие решений в условиях риска';
				echo '<small><span class="text-default"></span>Для решения задачи необходимы следующие входные данные: </small>';
			}
			else{
				echo 'Метод еще не реализован';
				echo '<img class="block-center space-top-2x" src="design/img/404.png" alt="404">';
			}
		?>
		
		</h3>
		
      </div>
    </section><!-- .page-title -->

    <!-- Content -->
    <section class="container">
	<?php
	  if($method['methodName'] == 'Метод анализа иерархий'){
	?>
	
	  <form id="mah" action="/experiment.php?id=<?php echo $_GET['id']; ?>" method="post" class="checkout-form">
			<textarea class="form-control space-bottom-2x text-center" id="purpose_area" name="purpose_area" rows="1" placeholder="Цель:"></textarea>
			<div class="first-step">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Критерии</th>
							</tr>
						  </thead>
						  <tbody id="tbody-criterians">
							<tr>
							  <th scope="row">1</th>
							  <td class="td-no-padding"><input name="criterian_0" required placeholder="Критерий1" class="form-control input-no-margin" placeholder="Критерий 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">2</th>
							  <td class="td-no-padding"><input name="criterian_1" required placeholder="Критерий2" class="form-control input-no-margin" placeholder="Критерий 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button type="button" id="minus-criterian" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button  type="button" id="plus-criterian" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Альтернативы</th>
							</tr>
						  </thead>
						  <tbody id="tbody-alternatives">
							<tr>
							  <th scope="row">1</th>
							  <td class="td-no-padding"><input name="alternative_0" required placeholder="Альтернатива1" class="form-control input-no-margin" placeholder="Альтернатива 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">2</th>
							  <td class="td-no-padding"><input name="alternative_1" required placeholder="Альтернатива2" class="form-control input-no-margin" placeholder="Альтернатива 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="minus-alternative" type="button" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="plus-alternative" type="button" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
					 <button type="button" id="build-comparisons" class="btn  btn-block btn-ghost btn-default waves-effect waves-light">Построить матрицу сравнений</button> <br><br><br> 
					</div>
				</div>
		</div>
		<div class="second-step"></div>
		<div class="third-step"></div>
		<div class="last-step"></div>
		<div>
		</form>
	<?php } 
		else if($method['methodName'] == 'Принятие решений в условиях неопределенности'){
	?>
	<!-- ----------------------Принятие решений в условиях неопределенности------------------------>
	<!-- ----------------------Принятие решений в условиях неопределенности------------------------>
	<!-- ----------------------Принятие решений в условиях неопределенности------------------------>
		<form id="matrixMethod" action="/experiment.php?id=<?php echo $_GET['id']; ?>" method="post" class="checkout-form">
			<textarea class="form-control space-bottom-2x text-center" name="purpose_area_matrix_method" id="purpose_area_matrix_method" rows="1" placeholder="Цель:"></textarea>
			<div class="first-step">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Альтернативы</th>
							</tr>
						  </thead>
						  <tbody id="tbody-alternatives-matrix-method">
							<tr>
							  <th scope="row">A1</th>
							  <td class="td-no-padding"><input name="alternative_0" required placeholder="Альтернатива1" class="form-control input-no-margin" placeholder="Альтернатива 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">A2</th>
							  <td class="td-no-padding"><input name="alternative_1" required placeholder="Альтернатива2"class="form-control input-no-margin" placeholder="Альтернатива 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button type="button" id="minus-alternative-matrix-method" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button  type="button" id="plus-alternative-matrix-method" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Варианты внешних условий</th>
							</tr>
						  </thead>
						  <tbody id="tbody-conditions-matrix-method">
							<tr>
							  <th scope="row">B1</th>
							  <td class="td-no-padding"><input name="criterian_0" required placeholder="Условие1" class="form-control input-no-margin" placeholder="Условие 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">B2</th>
							  <td class="td-no-padding"><input name="criterian_1" required placeholder="Условие2" class="form-control input-no-margin" placeholder="Условие 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="minus-condition-matrix-method" type="button" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="plus-condition-matrix-method" type="button" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
					 <button type="button" id="build-matrix-method" class="btn  btn-block btn-ghost btn-default waves-effect waves-light">Построить матрицу полезности</button> <br><br><br> 
					</div>
				</div>
		</div>
		<div class="second-step"></div>
		<div class="third-step"></div>
		<div class="last-step"></div>
		<div>
		</form>
	<?php } 
		else if($method['methodName'] == 'Принятие решений в условиях риска'){ 
	?>
		<!-- ----------------------Принятие решений в условиях риска------------------------>
		<!-- ----------------------Принятие решений в условиях риска------------------------>
		<!-- ----------------------Принятие решений в условиях риска------------------------>
		<form id="risk-method" action="/experiment.php?id=<?php echo $_GET['id']; ?>" method="post" class="checkout-form">
			<textarea class="form-control space-bottom-2x text-center" name="purpose_area_risk_method" id="purpose_area_risk_method" rows="1" placeholder="Цель:"></textarea>
			<div class="first-step">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Альтернативы</th>
							</tr>
						  </thead>
						  <tbody id="tbody-alternatives-risk-method">
							<tr>
							  <th scope="row">1</th>
							  <td class="td-no-padding"><input name="alternative_0" required placeholder="Альтернатива1" class="form-control input-no-margin" placeholder="Альтернатива 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">2</th>
							  <td class="td-no-padding"><input name="alternative_1" required placeholder="Альтернатива2" class="form-control input-no-margin" placeholder="Альтернатива 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button type="button" id="minus-alternative-risk-method" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button  type="button" id="plus-alternative-risk-method" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12">
						<div class="table-responsive space-bottom-1x">
						<table class="table-responsive">
						  <thead>
							<tr>
							  <th>#</th>
							  <th>Варианты внешних условий</th>
							</tr>
						  </thead>
						  <tbody id="tbody-states-risk-method">
							<tr>
							  <th scope="row">1</th>
							  <td class="td-no-padding"><input name="criterian_0" required placeholder="Состояние1" class="form-control input-no-margin" placeholder="Условие 1"></input></td>
							</tr>
							<tr>
							  <th scope="row">2</th>
							  <td class="td-no-padding"><input name="criterian_1" required placeholder="Состояние2" class="form-control input-no-margin" placeholder="Условие 2"></input></td>
							</tr>
						  </tbody>
						</table>
						</div><!-- .table-responsive.space-bottom-2x -->
						<div class="row">
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="minus-state-risk-method" type="button" class="btn btn-sm btn-danger waves-effect">-</button>
							</div>
							<div class="col-lg-2 col-md-2 col-sm-2">
							 <button id="plus-state-risk-method" type="button" class="btn btn-sm btn-primary waves-effect">+</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 col-md-12">
					 <button type="button" id="build-risk-method" class="btn  btn-block btn-ghost btn-default waves-effect waves-light">Построить матрицу полезности</button> <br><br><br> 
					</div>
				</div>
		</div>
		<div class="second-step"></div>
		<div class="third-step"></div>
		<div class="last-step"></div>
		<div>
		</form>
	<?php } ?>
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
