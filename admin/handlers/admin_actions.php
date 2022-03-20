<?php 
	include 'connect.php';
	include 'functions.php';

		$name = trim($_POST['red-form-name']);
		$category = trim($_POST['red-form-category']);
		$room_count = trim($_POST['red-form-room_count']);
		$description = trim($_POST['red-form-desc']);
		$price = trim($_POST['red-form-price']);
		$photo = trim($_POST['red-form-img']);

	# редактирование номера;
	if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['button-redact'])) {

		# получаю данные для записи;
		$id_room = $_SESSION['room_id'];
		
		/*------- преобразую данные в нужный формат ------*/
		# name;
		if ($room_name === ''){
			$room_name = $_SESSION['room_name'];
		}
		# category_id;
		$category_id = '';
		if ($category === 'Стандарт'){
			$category_id = 1;
		}elseif($category === 'Эконом'){
			$category_id = 2;
		}elseif($category === 'Люкс'){
			$category_id = 3;
		}elseif ($category === '' || $category === 'Категория не указана'){
			$category_id = $_SESSION['category_id'];
		}
		# room_count;
		if ($room_count === ''){
			$room_count = $_SESSION['room_count'];
		}
		# description;
		if ($description === '') {
			$description = $_SESSION['room_description'];
		}
		#price;
		if ($price === ''){
			$price = $_SESSION['room_price'];
		}
		#photo;
		if ($photo === ''){
			$photo = $_SESSION['room_price'];
		}else{
			$photo = 'images/rooms/' . $photo;
		}

		$post = [
			'name' => $name,
			'category_id' => $category_id,
			'room_count' => $room_count,
			'description' => $description,
			'price' => $price,
			'photo' => $photo
		];

		update('rooms', 'id_room', $id_room, $post);
		header('location: index.php?page=rooms');
	}


	# удаление номера;
	if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['button-delete'])) {

		# получаю данные для записи;
		$id_room = $_SESSION['room_id'];

		delete('rooms', 'id_room', $id_room);
		header('location: index.php?page=rooms');
	}

	if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['button-add'])) {
		if ($room_name === ''){
			$room_name = 'Не указано';
		}
		# category_id;
		$category_id = '';
		if ($category === 'Стандарт'){
			$category_id = 1;
		}elseif($category === 'Эконом'){
			$category_id = 2;
		}elseif($category === 'Люкс'){
			$category_id = 3;
		}elseif ($category === '' || $category === 'Категория не указана'){
			$category_id = 1;
		}
		# room_count;
		if ($room_count === ''){
			$room_count = 1;
		}
		# description;
		if ($description === '') {
			$description = 'Не указано';
		}
		#price;
		if ($price === ''){
			$price = 0;
		}
		#photo;
		if ($photo === ''){
			$photo = 'Не указано';
		}else{
			$photo = 'images/rooms/' . $photo;
		}

		$post = [
			'name' => $name,
			'category_id' => $category_id,
			'room_count' => $room_count,
			'description' => $description,
			'status_id' => 1,
			'price' => $price,
			'photo' => $photo
		];

		$id_room = insert('rooms', $post);

		# создание сессии для пользователя;
		$room = select_one('rooms', ['id_room' => $id_room]);
		room_create($room);
		header('location: index.php?page=rooms');
	}
?>
