<?php

include('data.php');
session_start();
if (!validate_cart($_COOKIE['cart'], $_SESSION['loggued_on_user']))
{
    header('Location: login.php');
    return ;
}
else
{
    setcookie('cart', serialize(array()), time() - 30);
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
			<div class = "menu2"><a>Acount</a></div>
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
		</div>
	</div>
	    <div id = "centerpanier">
	        <h2>Votre commande a été validée, Merci</h2>
	        <form action= "index.php">
	           <input class="retour" type="submit" name="retour" value="Retourner sur la page d'accueil">
	       </form>
	    </div>
	</div>
	</div>
</html>
