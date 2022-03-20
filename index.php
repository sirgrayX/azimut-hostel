<?php
	session_start();
	# подключаем шапку сайта
	require("templates/header.php");
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
		
		if (!isset($page)) {
			require('templates/main.php');
		}elseif($page == 'index'){
			require('templates/main.php');
			# переход на страницу каталога номеров;
		}elseif($page == 'rooms') {
			require('templates/rooms.php');
			# переход на страницу выбранного номера;
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

			# переход на страницу авторизации для неавторизованного
			# пользователя;
		}elseif($page == 'login') {
			require('templates/login.php');
		}elseif($page == 'registration') {
			require('templates/registration.php');
		}elseif ($page == 'logout') {
			require('controllers/logout.php');
		}elseif($page=='profile'){
			require('templates/profile.php');
		}elseif($page == 'transact'){
			$id_transact = $_GET['id_transaction'];
			$transaction = [];

			$sql_history = $link->query("SELECT * FROM `transactions`, `rooms` WHERE `transactions`.user_id = '$id_user' AND `transactions`.room_id = `rooms`.id_room ORDER BY STR_TO_DATE(`transactions`.checkin, '%Y-%m-%d') DESC");

			foreach ($sql_history as $record) {
				if($record['id_transaction'] == $id_transact){
					$transaction = $record;
					break;
				}
			}
			require('templates/profile.php');
		}
	?>
</div>


<?php
	# подключаем подвал сайта
	require('templates/footer.php'); 
?>