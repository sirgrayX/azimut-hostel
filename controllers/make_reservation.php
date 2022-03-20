<?php
    include 'functions.php';
    include 'connect.php';
    $msg = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST' &&  isset($_POST['button-reserv'])) {

        # данные, собранные из формы;
        $day = $_POST['day'];
        $month = $_POST['month'];
        $dayscount = $_POST['dayscount'];
        $room_price = $_SESSION['room_price'];
        $room_id = $_SESSION['room_id'];


        # данные из формы, но уже преобразованные;
        $date_create_reserv = date_create($month . '-' . $day);
        $date_diff = $date_create_reserv;
        

        # проверка, авторизован ли пользователь;
        if (!isset($_SESSION['id_user'])){
            header('location: ../../index.php?page=login');
            $msg = "Пожалуйста, авторизуйтесь!";
        }else{
            # данные, которые необходимо внести в БД;
            $user_id = $_SESSION['id_user'];
            $room_id = $room_id;
            $checkin = date_format($date_create_reserv, 'Y-m-d');
            $checkout = date_format(date_modify($date_diff, "$dayscount days"), 'Y-m-d');
            $cost = $dayscount * $room_price;

            # формирую массив для записи;
            $post = [
                'user_id' => $user_id,
                'room_id' => $room_id,
                'checkin' => $checkin,
                'checkout' => $checkout,
                'cost' => $cost
            ];

        /*  tt($post);
            exit(); */

            # номер транзакции на всякий случай;
            $id_transaction = insert('transactions', $post);
            header('location: ../../index.php?page=profile');
            exit(); 
        }
    }
?>