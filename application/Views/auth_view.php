<form class="form-signin"  method="post" action="/AdminPanel/Auth">
	<h2 class="form-signin-heading">Авторизация</h2>
	<?if(isset($data['error'])):?>
	<div class="help-block with-errors">
		Ошибка: <?=$data['error']?>
	</div>
<?endif;?>
	
	<label for="inputLogin" class="sr-only">Имя пользователя:</label>
	<input type="text" id="inputLogin" name="login" class="form-control" placeholder="Имя пользователя" required autofocus>
	<label for="inputPassword" class="sr-only">Пароль:</label>
	<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Пароль" required>
	<button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>