<?php
	include 'connect.php';
	include 'functions.php';

	$msg = '';

	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['button-log'])) {
		$adminname = trim($_POST['admin_name']);
		$password = trim($_POST['password']);

		tt(password_hash($password, PASSWORD_DEFAULT));


		if ($adminname === '' || $password === '') {
			$msg = "Не все поля заполнены";
		}else{
			$admin = select_one('admin', ['adminname' => $adminname]);
			if ($admin && password_verify($password, $admin['password'])) {
				admin_login($admin);
			}else{
				$msg = "Неверный логин или пароль!";
			}
		}

	}else{
		$adminname = '';
	}
?>