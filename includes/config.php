<?php
session_start();
$config = array(
	'preloader' => 'is-preloader preloading', //is-preloader preloading
	'preloader_spinner' => 'spinner2',
	'email' => 'nucleus@mail.ru',
	'telephone' => '+79131841102',
	'vk' => 'https://vk.com/feed',
	'db' => array(
			'server' => 'localhost',
			'username' => 'root',
			'password' => '',
			'name' => 'sppr'
		)
	);
require "db.php";
?>