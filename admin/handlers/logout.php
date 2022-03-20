<?php
	session_start();

	unset($_SESSION['id_admin']);
	unset($_SESSION['adminname']);
	
	header('location: index.php?page=admin_auth'); 
	session_destroy();
?>

