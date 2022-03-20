<?php
	include 'controllers/users.php';
?>

<!---------- НАЧАЛО формы авторизации ----------------->
<form class="row justify-content-center" method="post" action="index.php?page=login">
	<h2>Авторизация</h2>

	<div class="mb-3 col-12 col-md-4 err"><p><?=$msg?></p></div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="registrationInputEmail1" class="form-label">Email</label>
		<input type="email" class="form-control" id="registrationInputEmail1" aria-describedby="emailHelp" placeholder="s.bulganin@bk.ru" name="user_email" value="<?=$user_email?>">
	</div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="loginInputPassword1" class="form-label">Пароль</label>
		<input type="password" class="form-control" id="loginInputPassword1" name="password">
	</div>
	<div class="w-100"></div>


	<div class="mb-3 col-12 col-md-4">
		<button type="submit" class="btn btn-primary" name="button-log">Войти</button>
		<a href="index.php?page=registration">Регистрация</a>
	</div>
</form>
<!------------------- КОНЕЦ формы авторизации -------------------->

