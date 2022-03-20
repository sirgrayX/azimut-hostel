<?php
	session_start();
	require('connect.php');

	# функция для тестового вывода передаваемых/получаемых данных;
	function tt($value){
		echo '<pre>';
		print_r($value);
		echo '</pre>';
	}

	# проверка выполнения запроса к базе данных;
	function database_check_error($query){
		$errInfo = $query->errorInfo();
		if ($errInfo[0] !== PDO::ERR_NONE) {
			echo $errInfo[2];
			exit();
		}
		return true;
	}

	# функция для запроса всех записей из таблицы;
	function select_all($table, $params = []){
		global $link;
		$sql_text = "SELECT * FROM $table";

		if (!empty($params)){
			$i = 0;
			foreach ($params as $key => $value) {
				if (!is_numeric($value)) {
					$value = "'".$value."'";
				}

				if ($i === 0) {
					$sql_text .= " WHERE $key = $value";
				}else{
					$sql_text .= " AND $key = $value";
				}
				$i++;
			}
		}

		
		$query = $link->prepare($sql_text);
		$query->execute();
		database_check_error($query);
		return $query->fetchAll();
	}

	# функция для запроса на получение одной строки из таблицы;
	function select_one($table, $params = []){
		global $link;
		$sql_text = "SELECT * FROM $table";

		if (!empty($params)){
			$i = 0;
			foreach ($params as $key => $value) {
				if (!is_numeric($value)) {
					$value = "'".$value."'";
				}

				if ($i === 0) {
					$sql_text .= " WHERE $key = $value";
				}else{
					$sql_text .= " AND $key = $value";
				}
				$i++;
			}
		}

		$sql_text = $sql_text . " LIMIT 1";		
		$query = $link->prepare($sql_text);
		$query->execute();
		database_check_error($query);
		return $query->fetch();
	}

	# функция для записи в таблицу базы данных;
	function insert($table, $params){
		global $link;

		$i = 0;
		$col = '';
		$mask = '';
		foreach ($params as $key => $value) {
			if ($i === 0){
				$col .= "$key";
				$mask .= "'" . "$value" . "'";
			}else{
				$col .= ", $key";
				$mask .= ", '" . "$value" . "'";
			}
			
			$i++;
		}

		$sql_text = "INSERT INTO $table ($col) VALUES ($mask)";
		$query = $link->prepare($sql_text);
		$query->execute();
		database_check_error($query);
		return $link->lastInsertId();
	}

	# функция обновления записи в таблице;
	function update($table, $id_table, $id, $params){
		global $link;

		$i = 0;
		$str = '';
		foreach ($params as $key => $value) {
			if ($i === 0){
				if (!is_numeric($value)) {
					$str.= $key. " = '".$value."'";
				}else{
					$str.= $key. " = ".$value;
				}	
			}else{
				if (!is_numeric($value)){
					$str .= ", " . $key . " = '". $value . "'";
				}else{
					$str .= ", " . $key . " = ". $value;
				}
			}
			
			$i++;
		}

		$sql_text = "UPDATE $table SET $str WHERE $id_table = $id";
		$query = $link->prepare($sql_text);
		$query->execute();
		database_check_error($query);
	}


	# функция удаления записи в таблице;
	function delete($table, $id_table, $id){
		global $link;
		$sql_text = "DELETE FROM $table WHERE $id_table = $id";
		$query = $link->prepare($sql_text);
		$query->execute();
		database_check_error($query);
	}

	function admin_login($user_params = []){
		$_SESSION['id_admin'] = $user_params['id_admin'];
		$_SESSION['adminname'] = $user_params['adminname'];
		header('location: index.php?page=admin_profile');
	}

	function dateFormat($date, $is_time = false){
		# получаем значение даты и времени;
		list($day, $time) = explode(' ', $date);
		switch( $day ){
			# если дата совпадает с сегодняшней;
			case date('Y-m-d'):
				$result = 'сегодня';
           	    break;
           	#если дата совпадает со вчерашней;
           	case date( 'Y-m-d', mktime(0, 0, 0, date("m")  , date("d")-1, date("Y")) ):
         	    $result = 'вчера';
           	    break;

           	default:
           	{
           	# разделяем отображение даты на составляющие;
           		list($y, $m, $d)  = explode('-', $day);
           		$month_str = array(
           			'января', 'февраля', 'марта',
           			'апреля', 'мая', 'июня',
           			'июля', 'августа', 'сентября',
           			'октября', 'ноября', 'декабря'
           		);

           		$month_int = array(
           			'01', '02', '03',
           			'04', '05', '06',
           			'07', '08', '09',
           			'10', '11', '12'
           		);
 
             	# замена числового обозначения месяца на словесное (склоненное в падеже)
             	$m = str_replace($month_int, $month_str, $m);
             	// Формирование окончательного результата;
             	$result = $d.' '.$m.' '.$y;
            }
        }

        if ($is_time){
        	# получаем отдельные составляющие времени;
        	# без учета секунд;
     		list($h, $m, $s)  = explode(':', $time);
     		$result .= ' в '.$h.':'.$m;
     	}
     	return $result;
    }
?>