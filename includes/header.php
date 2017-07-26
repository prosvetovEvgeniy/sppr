
  <!-- Окно входа-->
  <div class="modal fade" id="loginModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content text-center">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="text" name="username" class="form-control" placeholder="Логин" required>
            <input type="password" name="password" class="form-control" placeholder="Пароль" required>
            <div class="form-group">
              <button type="submit" name="log_in" class="btn login-btn btn-default waves-effect waves-light">Войти в аккаунт<i class="icon-head"></i></button>
            </div>
          </form><!-- <form> -->
        </div><!-- .modal-content -->
      </div><!-- .modal-dialog -->
  </div><!-- .modal.fade -->
	
  <!-- Окно регистрации-->
	<div class="modal fade" id="signUpModal" tabindex="-1" role="dialog">
      <div class="modal-dialog">
        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <div class="modal-content text-center">
          <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <input type="text" class="form-control" name="login" placeholder="Введите ваш логин" required>
            <input type="email" class="form-control" name="email" placeholder="Введите ваш email" required>
            <input type="password" class="form-control" name="password1" placeholder="Введите ваш пароль" required>
            <input type="password" class="form-control" name="password2" placeholder="Введите пароль еще раз" required>
            <div class="form-group">
              <button type="submit" name="register" class="btn login-btn btn-default waves-effect waves-light">Зарегистрироваться<i class="icon-head"></i></button>
            </div>
          </form><!-- <form> -->
        </div><!-- .modal-content -->
      </div><!-- .modal-dialog -->
   </div><!-- .modal.fade -->


	<header class="navbar navbar-sticky navbar-fullwidth">
      
      <!-- Toolbar -->
      <div class="topbar">
        <div class="container">
          <a href="index.php" class="site-logo">
            <img src="design/img/logo.png" alt="Nucleus">
          </a><!-- .site-logo -->

          <!-- Mobile Menu Toggle -->
          <div class="nav-toggle"><span></span></div>
          <?php 
            if(empty($_SESSION['username']))
            {
          ?>
          <div class="toolbar">
            <a href="registration.php" class="text-sm" data-toggle="" data-target="">Зарегистрироваться</a>
            <a href="login.php" class="btn btn-sm btn-default btn-icon-right waves-effect waves-light" data-toggle="" data-target="">Войти <i class="icon-head"></i></a>
          </div><!-- .toolbar -->
          <?php } 
            else {
          ?>
          <div class="toolbar">
            <a href="account.php?user_id=<?php echo $_SESSION['user_id']; ?>" id="onMyPage" class="text-sm">Перейти в личный кабинет</a>
            <a href="exit.php" class="btn btn-sm btn-default btn-icon-right waves-effect waves-light">Выйти(<?php echo $_SESSION['username'] ?>) <i class="icon-head"></i></a>
            <!-- <a href="shopping-cart.html" class="cart-btn"><i class="icon-bag"></i></a> -->
          </div><!-- .toolbar -->
          <?php  } ?>
        </div><!-- .container -->
      </div><!-- .topbar -->

      <!-- Main Navigation -->
      <div class="container">
        <nav class="main-navigation">
          <ul class="menu">
            <li class="current-menu-item menu-item-has-children">
              <a href="/index.php">Главная</a>
            </li>

            <li class="menu-item-has-children">
              <a href="#">Методы</a>
              <ul class="sub-menu"> 
        <?php
          $methods = mysqli_query($connection, 'SELECT * FROM `methods` ORDER BY `id`');
        ?>
        <?php
          while($method = mysqli_fetch_assoc($methods)){
        ?>
                <li><a href="experiment.php?id=<?php echo $method['id'];?>"><?php echo $method['methodName'];?></a></li>
        <?php } ?>
              </ul>
            </li>
            <li class="menu-item-has-children">
              <a href="#">Справка</a>
              <ul class="sub-menu"> 
				<?php
					$methods = mysqli_query($connection, 'SELECT * FROM `methods` ORDER BY `id`');
				?>
				<?php
					while($method = mysqli_fetch_assoc($methods)){
				?>
                <li><a href="help.php?name=<?php echo $method['filter_ref'];?>"><?php echo $method['methodName'];?></a></li>
				<?php } ?>
				<li><a href="help.php">Литература</a></li></a></li>
              </ul>
            </li>
            <li class="menu-item-has-children">
              <a href="<?php echo $config['vk']?>" target="_blank">Мы в контакте</a>
            </li>
            
          </ul><!-- .menu -->
        </nav><!-- .main-navigation -->
      </div><!-- .container -->
      <div class="social-bar mobile-socials">
        <a href="#" class="sb-skype">
          <i class="fa fa-skype"></i>
        </a>
        <a href="#" class="sb-facebook">
          <i class="fa fa-facebook"></i>
        </a>
        <a href="#" class="sb-twitter">
          <i class="fa fa-twitter"></i>
        </a>
      </div>
    </header><!-- .navbar -->