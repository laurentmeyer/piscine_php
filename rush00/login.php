<?php

include("auth.php");
session_start();
date_default_timezone_set("Europe/Paris");


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if (($login = $_POST['login']) == NULL
		|| ($passwd = $_POST['passwd']) == NULL
		|| !auth($login, $passwd))
	{
		$_SESSION['loggued_on_user'] = "";
		$errorlog = "1";
	}
	else
	{
			$_SESSION['loggued_on_user'] = $login;
			header("Location: index.php");
	}
	
}
?>
<html>
	<header>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css"/>
	</header>
<body>
	<div id = "header">
		<h1><a href ="index.php" id="minishop">Mini-shop</a></h1>
		<div id = "menu1">
			<div class = "menu2"><a href="index.php">Acceuil</a></div>
			<div class = "menu2"><a href="create.php">Register</a></div>
			<div class = "menu3"><?php echo '<a href="cart.php">Mon panier('
			.get_products_number_cart($_COOKIE['cart']).')</a>';?></div>
		</div>
	</div>
	<div id = "centerlogin">
		<div id="loginwindow">
		<form id="formlogin" action= "login.php" method="post">
			<p>Identifiant:</p><br><input type="text" name="login"  />
			<br />
			<p>Mot de passe:</p><br><input type="password" name="passwd" />
			<br />
			<br />
			<input type="submit" name="submit" value= "OK">
		</form>
	</div>
	<?php
		if ($errorlog == "1")
			echo '<p class="error">Error</p>';
		?>
	</div>
</body>
</html>
