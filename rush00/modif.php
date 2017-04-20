<?php
session_start();
include 'auth.php';
date_default_timezone_set("Europe/Paris");
if (!$_SESSION['loggued_on_user']) {
	header("Location: login.php");
	return ;
} else {
	$user = $_SESSION['loggued_on_user'];
}
$modif = $_POST['modifier'];
$oldpw = $_POST['oldpw'];
$newpw = $_POST['newpw'];
if ($_POST['type'] == 'delete')
{
	if (!is_admin($_SESSION['loggued_on_user']))
	{
		delete_user($_SESSION['loggued_on_user']);
		$_SESSION['loggued_on_user'] = "";
		header("Location: index.php");
		return ;
	}
	else
	{
		$error = "admin";
	}
}
if ($_POST['type'] == 'modify')
{
	if (modif_user($_SESSION['loggued_on_user'], $oldpw, $newpw, 0) == FALSE)
	{
		$error = "modify";
	}
	else
	{
		modif_user($_SESSION['loggued_on_user'], $oldpw, $newpw, 0);
		header("Location: index.php");
		return ;
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
			<div class = "menu2">
				<?php
					if ($_SESSION['loggued_on_user'])
						echo '<a href="logout.php">Log-out</a>';
					else
						echo '<a href="login.php">Login</a>';
				?>
			</div>
				<?php
				if ($user == "Se connecter")
				{
					echo '<div class = "menu2"><a>
					 <a href="create.php">Register</a>
					</a></div>';
				}
				if ($_SESSION['loggued_on_user'] && is_admin($user))
				{
					echo '<div class = "menu2"><a href="admin/">Admin</a></div>';
				}
			?>
			<div class = "menu3"><?php 
			echo '<a href="cart.php">Mon panier('
			.get_products_number_cart($_COOKIE['cart']).')</a>';?></div>
		</div>
	</div>
	<div id = "centerpanier">
	    <div id ="delaccount">
	        <form action= "modif.php" method="post">
	        	<input type="hidden" name="type" value="delete"/>
				<input  class="ajouter" type="submit" name="del" value="Supprimer mon compte">
			</form>
	    </div>
	    <div id="modifpasswd">
	        <form id ="creatacount" action= "modif.php" method="post">
				<label>Ancien mot de passe:<br/><input type="password" name="oldpw"/></label><br/>
				<label>Nouveau mot de passe:<br/><input type="password" name="newpw"/></label><br/>
				<input type="hidden" name="type" value="modify"/>
				<input id= "btnregister"type="submit" name = "modifier" value="Modifier"/>
			</form>
			<?php
			if ($error == 'modify')
				echo '<div class="error"><a>invalid mdp</a></div>';
			if ($error == 'admin')
				echo '<div class="error"><a>Oups vous etes un admin</a></div>';
			?>
	    </div>
	</div>
</body>
</html>
