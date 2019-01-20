<?php
	session_start();
	if(isset($_SESSION["admin"])){
		header("location: crud.php");
	};
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<title>Вход</title>
		<?php
			require_once("functions/auth.php");
		?>
	</head>

	<body>
		<div id="signBox">
			<h1 align="center">Админка</h1>

			<form method="POST" action="">
				<label>Логин:</label><input value="<?php if(isset($_POST['log'])) echo $_POST['log']; ?>" placeholder="Логин" class="text" type="login" name="log"></br>
				<label>Пароль:</label><input placeholder="Пароль" class="text" name="pass" type="password"></br>
				<input value="Войти" class="submit" name="signin" type="submit">
			</form>
			<div id="error"><?php if(isset($error)) echo $error; ?></div>
		</div>
	</body>
</html>