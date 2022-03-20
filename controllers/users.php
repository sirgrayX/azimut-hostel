<?php

	# подключаю файлы с настройками базы и функций для запросов;
	include 'connect.php';
	include 'functions.php';

	$msg = '';

	# код для формы регистрации;
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-reg'])) {
		
		# данные из формы
		$user_surname = trim($_POST['user_surname']);
		$user_name = trim($_POST['user_name']);
		$user_email = trim($_POST['user_email']);
		$password = trim($_POST['password']);
		$password_confirm = trim($_POST['password_confirm']);
	

		# проверка на пустые поля;
		if ($user_surname === '' || $user_name === '' ||
			$user_email === '' || $password === '' ||$password_confirm === '') {
			$msg = "Не все поля заполнены!";
		# если же поля заполнены, но неправильно;
		}elseif (preg_match('/[А-Яа-я ]{2,}/u', $user_surname) == 0) {
			$msg = "Фамилия должна быть более двух символов!";
		}elseif (preg_match('/[А-Яа-я ]{2,}/u', $user_name) == 0) {
			$msg = "Имя должно быть более двух символов!";
		}elseif (preg_match('/^[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i', $user_email) == 0) {
			$msg = "Некорректный адрес почты!";
		}elseif (preg_match('/[A-Za-z0-9]{5,}/', $password) == 0) {
			$msg = "Пароль должен содержать не менее 5 латинских символов или цифр";
		}elseif ($password !== $password_confirm){
			$msg = "Пароли не совпадают!";
		}else{

			# проверка на наличие в базе уже зарегистрированного пользователя;
			$isexist = select_one('users', ['user_email' => $user_email]);
			if ($isexist['user_email'] === $user_email) {
				$msg = "Пользователь с такой почтой уже зарегистрирован!";
			}else{
				#дата регистрации пользователя на сайте;
				$created = date('Y-m-d');
				# хэширую пароль;
				$password = password_hash($password, PASSWORD_DEFAULT);


				# подготавливаю ассоциативный массив для insert;
				$post = [
					'user_name' => $user_name,
					'user_surname' => $user_surname,
					'user_email' => $user_email,
					'password' => $password,
					'created' => $created
				];

				$id_user = insert('users', $post);

				# создание сессии для пользователя;
				$user = select_one('users', ['id_user' => $id_user]);
				user_auth($user);
			}
		}
	}else{
		# переменные хранятся для метода GET,
		# чтобы при перезагрузке страницы не сбрасывались эти поля;
		$user_surname = '';
		$user_name = '';
		$user_email = '';
	}



	# код для формы авторизации;
	if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button-log'])){

		# данные с формы авторизации;
		$user_email = trim($_POST['user_email']);
		$password = trim($_POST['password']);


		# проверка введенных данных;
		if ($user_email === '' || $password === '') {
			$msg = "Не все поля заполнены!";
		}else{
			$isexist = select_one('users', ['user_email' => $user_email]);
			if ($isexist && password_verify($password, $isexist['password'])) {
				user_auth($isexist);
			}else{
				$msg = "Почта или пароль введены неверно!";
			}
		}
	}else{
		$user_email = '';
	}
	
?>