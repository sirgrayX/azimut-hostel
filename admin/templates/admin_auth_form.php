<?php
	include 'handlers/admin_auth.php';
?>

<!---------- НАЧАЛО формы авторизации ----------------->
<form class="row justify-content-center" method="post" action="index.php?page=admin_auth">
	<h2>Авторизация</h2>

	<div class="mb-3 col-12 col-md-4 err"><p><?=$msg?></p></div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="registrationInputEmail1" class="form-label">Login</label>
		<input type="text" class="form-control" id="formGroupRegistrationInput"  name="admin_name" value="<?=$adminname?>">
	</div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="loginInputPassword1" class="form-label">Пароль</label>
		<input type="password" class="form-control" id="loginInputPassword1" name="password">
	</div>
	<div class="w-100"></div>


	<div class="mb-3 col-12 col-md-4">
		<button type="submit" class="btn btn-primary" name="button-log">Войти</button>
	</div>
</form>
<!------------------- КОНЕЦ формы авторизации -------------------->
