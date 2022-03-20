<?php
	session_start();
	require 'templates/header.php';
?>

<div id="container">
	<?php
		# подключаем базу данных к сайту
		require('connect.php');

		if (!isset($_SESSION['sql'])) {
			$_SESSION['sql'] = "SELECT * FROM rooms";
		}

		$sql_text = $_SESSION['sql'];
		$sql = $link->query($sql_text);

		$page = $_GET['page'];

		if(!isset($page)) {
			if(isset($_SESSION['id_admin'])){
				require 'templates/admin_profile.php';
			}else{
				require 'templates/admin_auth_form.php';
			}
		} elseif($page == 'index') {
			if (isset($_SESSION['id_admin'])) {
				require 'templates/admin_profile.php';
			}else{
				require 'templates/admin_auth_form.php';
			}
		}elseif ($page == 'admin_auth') {
			require 'templates/admin_auth_form.php';
		} elseif ($page == 'rooms') {
			require 'templates/rooms.php';
		}elseif($page == 'single') {
			$id_room = $_GET['id_room']; # id_room получаем со страницы rooms.php;
			$room = []; # передаем в пустой массив вытянутые из БД данные о номере;
			foreach ($sql as $single) {
				if($single['id_room'] == $id_room){
					$room = $single;
					break;
				}
			}
			require('templates/single.php');
			# выборка номеров по категории;
		}elseif($page == 'room_cat'){
			$id_cat = $_GET['id_cat']; # получаем id_cat со страницы rooms.php;

			if($id_cat == 0){
				$_SESSION['sql'] = "SELECT * FROM `rooms`";
			}else{
				$_SESSION['sql'] = "SELECT * FROM `rooms` WHERE `category_id` = $id_cat";
			}
			$sql_text = $_SESSION['sql'];
			$sql = $link->query($sql_text);
			require('templates/rooms.php');


		# сортировка всех номеров по одному из критериев;
		}elseif($page == 'room_sort'){
			$sort_id = $_GET['sort_id'];

			if($sort_id == 1){
				if (str_word_count($sql_text) > 4) {
					$sql_text.=" AND `room_count` = 1";
				}else{
					$sql_text.=" WHERE `room_count` = 1";
				}
			}elseif($sort_id == 2){
				if (str_word_count($sql_text) > 4) {
					$sql_text.=" AND `room_count` = 2";
				}else{
					$sql_text.=" WHERE `room_count` = 2";
				}
			}elseif($sort_id == 3){
				$sql_text .= " ORDER BY price ASC";
			}else{
				$sql_text.=" ORDER BY price DESC";
			}
			$sql = $link->query($sql_text);
			require('templates/rooms.php');
		}elseif($page == 'logout'){
			require 'handlers/logout.php';
		}elseif ($page == 'admin_profile') {
			require 'templates/admin_profile.php';
		}elseif ($page == 'show_guests'){
			$sql_text = "SELECT * FROM `users`";
			$sql = $link->query($sql_text);
			require('templates/admin_profile.php');
		}
	?>
</div>


<?php
	require 'templates/footer.php';
?>
