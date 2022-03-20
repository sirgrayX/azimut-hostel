<?php
	# задание параметров для конструктора;
	$driver = 'mysql';
	$host = 'localhost';
	$database = 'hostel';
	$user = 'root';
	$password = '';
	$charset = 'utf8';
	$options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC];

	# обработка исключений при подключении к базе данных;
	try{
		$link = new PDO(
			"$driver:host=$host;dbname=$database;charset=$charset",
			$user, $password, $options
		);
	}catch (PDOException $e){
		die("Ошибка подключения к базе данных");
	}

	# запрос на вывод всех номеров;
	$sql = $link->query("SELECT * FROM `rooms`");
?>