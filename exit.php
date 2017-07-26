<?php
session_start();
unset($_SESSION['user_id']);
unset($_SESSION['login']);
session_destroy();

$home_url = 'http://' . $_SERVER['HTTP_HOST'];
	header('Location: ' . $home_url);

?>