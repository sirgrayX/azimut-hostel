<?php
	session_start();

	unset($_SESSION['id_user']);
	unset($_SESSION['user_surname']);
	unset($_SESSION['user_name']);
	unset($_SESSION['user_email']);
	unset($_SESSION['created']);

	unset($_SESSION['room_price']);
    unset($_SESSION['room_id']);
    unset($_SESSION['room_photo']);
    unset($_SESSION['room_name']); 
    unset($_SESSION['room_description']);
	
	header('location: ../../index.php?page=index'); 
	session_destroy();
?>
