<?php

session_start();
include('data.php');
date_default_timezone_set("Europe/Paris");

$error = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if ($_POST['submit'] !="M'inscrire"
		|| ($passwd = $_POST['passwd']) == NULL
		|| ($passwd = $_POST['passwdconf']) == NULL
		|| ($login  = $_POST['login']) == NULL)
	{
		$error = 1;
	}

	if ($_POST['submit'] =="OK" &&  ($passwd = $_POST['passwd']) != NULL &&  ($passwd2 = $_POST['passwd2']) != NULL && ($login  = $_POST['login']) != NULL)
	{
		if ($passwd != $passwd2)
		{
			$error = 2;
		}
		else
		{
			if (create_user($login, $passwd, 0) == FALSE)
			{
				$error = 3;
			}
			else
				header('Location: index.php');
		}
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
			<div class = "menu2"><a>
				<?php
				if ($_SESSION['loggued_on_user'])
					echo "Log-out";
				else
					echo '<a href="login.php">Login</a>';
				?>
			</a></div>
				<?php
				if ($user == "Se connecter")
				{
					echo '<div class = "menu2"><a>
					 <a href="create.php">Register</a>
					</a></div>';
				}
				?>
				<div class = "menu3"><?php echo '<a href="cart.php">Mon panier('
			.get_products_number_cart($_COOKIE['cart']).')</a>';?></div>
		</div>
	</div>
	    <div id = "centerpanier">
	    	<h2 id="titlecreate">Création de compte</h2>
	        <form id ="creatacount"action= "create.php" method="post">
				<label>Pseudo:<br/><input type="text" name="login"/></label><br/>
				<label>Mot de passe:<br/><input type="password" name="passwd"/></label><br/>
				<label>Confirmation du mot de passe:<br/><input type="password" name="passwd2"/></label><br/>
				<input id= "btnregister"type="submit" name = "submit" value="OK"/>
			</form>
			<?php
			if ($error == 1)
				echo '<div class="error"><a>Champs vide</a></div>';
			if ($error == 2)
				echo '<div class="error"><a>Mot de passe invalide</a></div>';
			if ($error == 3)
				echo '<div class="error"><a>Login déla utilisé</a></div>';
			?>
	    </div>
	</div>
	</div>
</html>