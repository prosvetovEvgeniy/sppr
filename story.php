<?php
require "includes/config.php";
?>
<?php 
    $json_alt_name = 0;
    $json_weight_value = 0;
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


  <div class="page-wrapper">

    <?php include "includes/header.php" ?>



    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content text-center">
          <p>Вы уверены, что хотите удалить задачу?</p>
          <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
              <button type="button" data-toggle="modal" data-target="#deleteModal" style="width: 100%;" class="btn btn-sm btn-danger waves-effect">Нет</button>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
              <button type="button"  data-toggle="modal" data-target="#deleteModal" id="delete-task" style="width: 100%;" class="btn btn-sm btn-primary waves-effect">Да</button>
            </div>
          </div>
        </div><!-- .modal-content -->
      </div><!-- .modal-dialog -->
  </div><!-- .modal.fade -->

    <?php 
    //получаем все записи из таблицы эксперименты
      $query = "SELECT * FROM `experiments` WHERE `id`={$_GET['experiment_id']}";
      $data = mysqli_query($connection, $query);

      if(mysqli_num_rows($data) == 1){
        $experiment = mysqli_fetch_assoc($data);
        //присваиваем значения переменным, чтобы не пользоваться ассоциативным массивом
        $experiment_id = $experiment['id'];
        $experiment_name = $experiment['experimentName'];
        $experiment_method_id = $experiment['method_id'];
        $experiment_user_id = $experiment['user_id'];
        $method_name = $_GET['methodName'];
      }
      else{
        echo "Ошибка";
        exit();
      }
    ?>
    <section class="page-title">
      <div class="container">
        <h4 class="text-center"><span class="blue-text">Задача </span>: <?php echo $experiment_name?></h4>
        <h5 class="block-title text-center"><span class="blue-text">Метод </span>: 
          <?php echo $method_name?></h5>
      </div>
    </section><!-- .page-title -->

    <!-- Content -->
    <div class="container">

     <?php 
      if($method_name == 'Метод анализа иерархий'){
     ?>
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
              <tbody>
              <?php 
                //получаем записи из таблицы критерии
                $query = "SELECT `criterionName` FROM `criterions` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);

                $i = 0;
                //проходимся по всем критериям и выводим их на экран
                while($criterion = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $criterion['criterionName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
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
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT `аlternativeName` FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($alternative = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $alternative['аlternativeName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th>Альтернативы</th>
                <th>Результирующий вес</th>
              </tr>
              </thead>
              <tbody>
              <?php 
                //получаем записи из таблицы результаты МАИ и выводим их на экран
                $query = "SELECT * FROM `result_mah` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);

                $i = 0;
                $alt_name = array(); //массив со значением альтернатив передается в javascript для создания диаграммы
                $weight_value = array(); //массив со значением весов передается в javascript для создания диаграммы

                while($result = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['alternative_name']?>"   class="form-control input-no-margin"></input></td>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['weight_value']?>"   class="form-control input-no-margin text-center"></input></td>
                  <?php
                    array_push($alt_name, $result['alternative_name']);
                    array_push($weight_value, $result['weight_value']);
                  ?>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
        </div>
        <div class="col-lg-6 col-md-12 col-sm-12">
          <div id="diagram" style="width: 100%; height: 300px;">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
          <button type="button" id="back" style="width: 100%;" class="btn btn-ghost btn-danger waves-effect waves-light">Назад</button>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6">
          <button type="button" id="new-task" style="width: 100%;" class="btn btn-ghost btn-primary waves-effect waves-light">Решить другую задачу</button>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <button type="button"  data-toggle="modal" data-target="#deleteModal" id="delete" style="width: 100%;" class="btn btn-danger waves-effect waves-light">Удалить</button>
        </div>
      </div>
      <?php
        //переводим массивы в формат json для передачи их в javascript
        $json_alt_name = json_encode($alt_name);
        $json_weight_value = json_encode($weight_value);
      ?>
     <?php } 
      elseif ($method_name == 'Принятие решений в условиях неопределенности') {
     ?>
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
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT `аlternativeName` FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($alternative = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo "A" . $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $alternative['аlternativeName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
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
              <tbody>
              <?php 
                //получаем записи из таблицы критерии
                $query = "SELECT `criterionName` FROM `criterions` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);

                $i = 0;
                //проходимся по всем критериям и выводим их на экран
                while($criterion = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo "B" . $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $criterion['criterionName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <?php
                //получаем количество альтернатив
                $query = "SELECT `id` FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $amount_alt = mysqli_num_rows($data);
                
                //получаем количество внешних условий(критериев)
                $query = "SELECT `id` FROM `criterions` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $amount_cr = mysqli_num_rows($data);

              ?>
              <tr>
                <th>#</th>
                <?php 
                  for($i = 0; $i < $amount_cr; $i++) {
                    echo "<th>B" . ($i+1) . "</th>";
                  }
                ?>

              </tr>
              </thead>
              <tbody>
                <?php 
                  $query = "SELECT `value` FROM `utility_matrix` WHERE `experiment_id`={$experiment_id}";
                  $data = mysqli_query($connection, $query);
                  
                  $utility_arr = array(); //здесь хранятся значения полученные из таблицы utility_matrix 
                  //заполняем массив данными из таблицы
                  while($matrix = mysqli_fetch_assoc($data)){
                    array_push($utility_arr, $matrix['value']);
                  }
                  
                  $utility_matrix = array(); //матрица полезности
                  $k = 0; //индекс для массива(не матрицы) в котором хранятся данные из таблицы utility_matrix

                  for($i = 0; $i < $amount_alt; $i++){
                    $utility_matrix[$i] = array();

                    for($j = 0; $j < $amount_cr; $j++){
                        $utility_matrix[$i][$j] = $utility_arr[$k];
                        $k++;
                    }
                  }
                ?>
                <?php
                for($i = 0; $i < $amount_alt; $i++){
                ?>
                <tr>
                  <th scope="row"><?php echo "A" . ($i+1); ?></th>
                  <?php 
                  for($j = 0; $j < $amount_cr; $j++){
                  ?>
                    <td class="td-no-padding"><input readonly value="<?php echo $utility_matrix[$i][$j]; ?>" class="form-control input-no-margin"></input></td>
                  <?php } ?>
                </tr>
                <?php }?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
          <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th>Расчет по</th>
                <th>Оптимальная альтернатива</th>
              </tr>
              </thead>
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT `criterion_name`, `alternative_name` FROM `result_matrix_method` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($result = mysqli_fetch_assoc($data)){
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['criterion_name']?>"   class="form-control input-no-margin text-center"></input></td>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['alternative_name']?>"   class="form-control input-no-margin text-center"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
          <button type="button" id="back" style="width: 100%;" class="btn btn-ghost btn-danger waves-effect waves-light">Назад</button>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6">
          <button type="button" id="new-task" style="width: 100%;" class="btn btn-ghost btn-primary waves-effect waves-light">Решить другую задачу</button>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <button type="button"  data-toggle="modal" data-target="#deleteModal" id="delete" style="width: 100%;" class="btn btn-danger waves-effect waves-light">Удалить</button>
        </div>
      </div>
     <?php } 
        elseif($method_name == 'Принятие решений в условиях риска')
        {
     ?>
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
              <tbody>
              <?php 
                $list_alternatives = array(); //здесь хранятся названия всех альтернатив
                //получаем записи из таблицы альтернатив
                $query = "SELECT `аlternativeName` FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($alternative = mysqli_fetch_assoc($data)){
                  $i++;
                  array_push($list_alternatives, $alternative['аlternativeName']);//запоминаем название альтернативы
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $alternative['аlternativeName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
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
              <tbody>
              <?php 
                $list_criterions = array(); //здесь хранятся названия всех альтернатив
                //получаем записи из таблицы критерии
                $query = "SELECT `criterionName` FROM `criterions` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);

                $i = 0;
                //проходимся по всем критериям и выводим их на экран
                while($criterion = mysqli_fetch_assoc($data)){
                  array_push($list_criterions, $criterion['criterionName']);//запоминаем название 
                  $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $criterion['criterionName']?>"   class="form-control input-no-margin"></input></td>
                </tr>
              <?php } ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <?php
                //получаем количество альтернатив
                $query = "SELECT `id` FROM `аlternatives` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $amount_alt = mysqli_num_rows($data);
                
                //получаем количество внешних условий(критериев)
                $query = "SELECT `id` FROM `criterions` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $amount_cr = mysqli_num_rows($data);

              ?>
              <tr>
                <th>#</th>
                <?php 
                  //выводим шапку таблицы
                  for($i = 0; $i < $amount_cr; $i++) {
                    echo "<th>" . $list_criterions[$i] . "</th>";
                  }

                  $query = "SELECT `value` FROM `probabilities` WHERE `experiment_id`={$experiment_id}";
                  $data = mysqli_query($connection, $query);
                  echo "<tr>";
                  echo "<th class='text-center' scope='row'>P</th>";
                  while($p = mysqli_fetch_assoc($data))
                  {
                ?>
                  <td class="td-no-padding"><input readonly value="<?php echo $p['value']; ?>" class="form-control input-no-margin text-center"></input></td>
                  <?php } ?>
                </tr>
              </tr>
              </thead>
              <tbody>
                <?php 
                  $query = "SELECT `value` FROM `utility_matrix` WHERE `experiment_id`={$experiment_id}";
                  $data = mysqli_query($connection, $query);
                  
                  $utility_arr = array(); //здесь хранятся значения полученные из таблицы utility_matrix 
                  //заполняем массив данными из таблицы
                  while($matrix = mysqli_fetch_assoc($data)){
                    array_push($utility_arr, $matrix['value']);
                  }
                  
                  $utility_matrix = array(); //матрица полезности
                  $k = 0; //индекс для массива(не матрицы) в котором хранятся данные из таблицы utility_matrix

                  for($i = 0; $i < $amount_alt; $i++){
                    $utility_matrix[$i] = array();

                    for($j = 0; $j < $amount_cr; $j++){
                        $utility_matrix[$i][$j] = $utility_arr[$k];
                        $k++;
                    }
                  }
                ?>
                <?php
                for($i = 0; $i < $amount_alt; $i++){
                ?>
                <tr>
                  <th class="text-center" scope="row"><?php echo $list_alternatives[$i]; ?></th>
                  <?php 
                  for($j = 0; $j < $amount_cr; $j++){
                  ?>
                    <td class="td-no-padding"><input readonly value="<?php echo $utility_matrix[$i][$j]; ?>" class="form-control input-no-margin text-center"></input></td>
                  <?php } ?>
                </tr>
                <?php }?>

              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th style="background-color: rgba(255,0,0,0.4)">Высокий уровень риска</th>
              </tr>
              </thead>
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT * FROM `result_risk_method` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($result = mysqli_fetch_assoc($data)){
                  if($result['identifier'] == 'высокий риск')
                  {
                    $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['alternative_name']?>"   class="form-control input-no-margin text-center"></input></td>
                </tr>
              <?php }
                }
               ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th style="background-color: rgba(0,0,255,0.4)">Средний уровень риска</th>
              </tr>
              </thead>
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT * FROM `result_risk_method` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($result = mysqli_fetch_assoc($data)){
                  if($result['identifier'] == 'средний риск')
                  {
                    $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['alternative_name']?>"   class="form-control input-no-margin text-center"></input></td>
                </tr>
              <?php }
                }
               ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
          <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="table-responsive space-bottom-1x">
            <table class="table-responsive">
              <thead>
              <tr>
                <th>#</th>
                <th style="background-color: rgba(0,255,0,0.4)">Низкий уровень риска</th>
              </tr>
              </thead>
              <tbody>
              <?php 
                //получаем записи из таблицы альтернатив
                $query = "SELECT * FROM `result_risk_method` WHERE `experiment_id`={$experiment_id}";
                $data = mysqli_query($connection, $query);
                $i = 0;
                //проходимся по всем альтернативам и выводим их на экран
                while($result = mysqli_fetch_assoc($data)){
                  if($result['identifier'] == 'низкий риск')
                  {
                    $i++;
              ?>
                <tr>
                  <th scope="row"><?php echo $i; ?></th>
                  <td class="td-no-padding"><input readonly value="<?php echo $result['alternative_name']?>"   class="form-control input-no-margin text-center"></input></td>
                </tr>
              <?php }
                }
               ?>
              </tbody>
            </table>
            </div><!-- .table-responsive.space-bottom-2x -->
          </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-3">
          <button type="button" id="back" style="width: 100%;" class="btn btn-ghost btn-danger waves-effect waves-light">Назад</button>
        </div>
        <div class="col-lg-7 col-md-7 col-sm-6">
          <button type="button" id="new-task" style="width: 100%;" class="btn btn-ghost btn-primary waves-effect waves-light">Решить другую задачу</button>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-3">
          <button type="button"  data-toggle="modal" data-target="#deleteModal" id="delete" style="width: 100%;" class="btn btn-danger waves-effect waves-light">Удалить</button>
        </div>
      </div>
     <?php }?>
    </div><!-- .container -->



























    <!-- Scroll To Top Button -->
    <a href="#" class="scroll-to-top-btn">
      <i class="icon-arrow-up"></i> 
    </a><!-- .scroll-to-top-btn -->

    <?php include "includes/footer.php" ?>
    
  </div><!-- .page-wrapper -->
  <?php include "includes/scripts.php" ?>

  <script type="text/javascript">
    $(document).ready(function () {

      var method_name = "<?php echo $method_name?>";
      if(method_name == "Метод анализа иерархий"){
        //получаем массивы со значениями альтернатив и весов
        var altenatives_val = <?php echo $json_alt_name;?>; 
        var total = <?php echo $json_weight_value; ?>;

        var associative_arr = [];
        //заполняем ассоциативный массив, который будет передан в chart
        for(var i = 0; i < altenatives_val.length; i++){
          associative_arr[i] = {};
          associative_arr[i].altName = altenatives_val[i];
          associative_arr[i].value = total[i];
        } 
        //строим диаграмму
        var chart = AmCharts.makeChart( "diagram", {
        "type": "pie",
        "theme": "light",
        "dataProvider": associative_arr,
        "valueField": "value",
        "titleField": "altName",
        "outlineAlpha": 0.4,
        "depth3D": 15,
        "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
        "angle": 30,
        "export": {
        "enabled": false
        }
      } );
      }
    });
    $('body').on('click', '#back', function(){
      var user_id = <?php echo $_SESSION['user_id']; ?>;
      $(location).attr('href',"account.php?user_id=" + user_id);
    });
    $('body').on('click', '#new-task', function(){
      var id = <?php echo $experiment_method_id; ?>;
      $(location).attr('href',"experiment.php?id=" + id);
    });
    $('body').on('click', '#delete-task', function(){
      
        var exp_id = <?php echo $experiment_id; ?>;
        var method_name = '<?php echo $method_name; ?>';
        var msg = "delete_task=0&getCookie=0&experiment_id=" + exp_id + "&method_name=" + method_name;
        
        //отправляем файлу handler php данные, а также ожидаем от него куки с id пользователя
        $.ajax({
              type: 'POST',
              url: 'handler.php',
              data: msg,
              success: function(data) {
                $(location).attr('href',"account.php?user_id=" + data);
                //console.log(data);
              },
              error:  function(xhr, str){
              console.log('Возникла ошибка: ' + xhr.responseCode);
              }
          });
    });
  </script>
</body><!-- <body> -->

</html>
