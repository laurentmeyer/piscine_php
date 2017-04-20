<?php

include('auth.php');
session_start();
if ($_SESSION['loggued_on_user']) {
	$user = $_SESSION['loggued_on_user'];
} else {
	$user = "Se connecter";
}
if ($_GET['panier'] == 'Ajouter'
    && ($productname = $_GET['productname']))
    setcookie('cart', add_to_cart($_COOKIE['cart'], $productname), time() + 30 * 24 * 3600);
if ($_GET['panier'] == 'Ajouter')    
    header('Location: ' . $_SERVER['HTTP_REFERER']);
if ($_GET['retire'] == 'Retirer')
{
		$name = $_GET['product'];
	    setcookie('cart', remove_from_cart($_COOKIE['cart'], $name),time() + 30 * 24 * 3600);
	     header('Location: ' . $_SERVER['HTTP_REFERER']);
}
$contenu = get_products_in_cart($_COOKIE['cart']);
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
		</div>
	</div>
	    <div id = "centerpanier">
	        <div id="titlepanier">
	           <p>Mon Panier</p>
	           <hr id = "barre" />
	               <?php
	               if (empty($contenu) == FALSE)
	               {
	                    foreach ($contenu as $value)
	                    {
                          echo '<h3>'.$value['name'].' ('.$value['price'].' $)</h3>';
                          echo '<h3>'."x ".$value['quantity'].'</h3>';
                          echo "<br>";
                          echo  '<form action="cart.php" method="get">
                          <input type="hidden" name="product" value="'.$value['name'].'" />
                          <input class="ajouter" type="submit" name="retire" value="Retirer">
                          </form>';
	                    }
	                    $total = get_total_cart($_COOKIE['cart']);
	                    echo '<h3>Prix total: '.$total.' $</h3>';
	               }
	               else
	               {
	                   echo '<h3>Votre Panier est vide</h3>';
	               }
	               ?>
	           <hr id = "barre" />
	           <?php
	                if (empty($contenu) == FALSE)
	                {
	                    echo '<form action= "validate.php">
	                    <input class="ajouter" type="submit" name="panier" value="Finaliser ma commande">
	                    </form>';
	                }
	           ?>
	    </div>
	</div>
	</div>
</body>
</html>
