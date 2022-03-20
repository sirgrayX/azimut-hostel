<!------------ НАЧАЛО ФОРМЫ РЕГИСТРАЦИИ --------------------->
<?php
	include 'controllers/users.php';
?>


<form class="row justify-content-center" method="post" action="index.php?page=registration">
	<h2>Форма регистрации</h2>

	<div class="mb-3 col-12 col-md-4 err"><p><?=$msg?></p></div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="formGroupRegistrationInput" class="form-label">Фамилия</label>
		<input type="text" class="form-control" id="formGroupRegistrationInput" placeholder="Булганин" name="user_surname" value="<?=$user_surname?>">
	</div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="formGroupRegistrationInput2" class="form-label">Имя</label>
		<input type="text" class="form-control" id="formGroupRegistrationInput2" placeholder="Сергей" name="user_name" value="<?=$user_name?>">
	</div>
	<div class="w-100"></div>
	

	<div class="mb-3 col-12 col-md-4">
		<label for="registrationInputEmail1" class="form-label">Email</label>
		<input type="email" class="form-control" id="registrationInputEmail1" aria-describedby="emailHelp" placeholder="s.bulganin@bk.ru" name="user_email" value="<?=$user_email?>">
	</div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="registrationInputPassword1" class="form-label">Пароль</label>
		<input type="password" class="form-control" id="registrationInputPassword1" name="password">
	</div>
	<div class="w-100"></div>

	<div class="mb-3 col-12 col-md-4">
		<label for="registrationInputPassword2" class="form-label">Повторите пароль</label>
		<input type="password" class="form-control" id="registrationInputPassword2" name="password_confirm">
	</div>
	<div class="w-100"></div>


	<div class="mb-3 col-12 col-md-4">
		<button type="submit" class="btn btn-primary" name="button-reg">Регистрация</button>
		<a href="index.php?page=login">Войти</a>
	</div>
</form>

<!------------ КОНЕЦ ФОРМЫ РЕГИСТРАЦИИ ---------------------->

