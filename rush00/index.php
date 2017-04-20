<?php
session_start();
if ($_SESSION['loggued_on_user']) {
	$user = $_SESSION['loggued_on_user'];
} else {
	$user = "Se connecter";
}
include 'auth.php';
$categories_products = get_table('categories_products');
$categories = get_all_categories();
if (!$select)
	$select = "";
?>
<html>
<head>
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="css/style.css"/>
	<title>Mini-shop</title>
</head>
<body>
	<div id = "categories">
		<div id = "fondcategories"><h2>Categories</h2></div>
		<?php
		foreach ($categories as $key)
			echo '<a class = "selectcat" href="index.php?select='.$key['name'].'"><p>'.$key['name'];'</p></a>';
		?>
	</div>
	<div id = "header">
		<h1><a href ="index.php" id="minishop">Mini-shop</a></h1>
		<div id = "menu1">
			<?php
					if ($user == $_SESSION['loggued_on_user'])
						echo '<div class = "menu2"><a href="modif.php">My Account</a></div>';
			?>
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
						echo '<div class = "menu2"><a href="create.php">Register</a></div>';
				?>
			<div class = "menu3"><?php echo '<a href="cart.php">Mon panier('
			.get_products_number_cart($_COOKIE['cart']).')</a>';?></div>
			<?php
				if ($_SESSION['loggued_on_user'] && is_admin($user))
				{
					echo '<div class = "menu2"><a href="admin/">Admin</a></div>';
				}
			?>
		</div>
	</div>
	<div id = "center">
		<?php
		$products = products_of_category($_GET['select']);
		foreach($products as $c)
			echo 
			'<div class = "item"><div class = "item_bis">
			<img class ="imgprod" src= "'.$c[img_path].'"></img>
			<p>'.$c['name'].' '.$c['price'].' $</p>
			<form action= "cart.php?addproduct='.$c['name'].'">
				<input type="hidden" name="productname" value="'.$c['name'].'" />
				<input  class="ajouter" type="submit" name="panier" value="Ajouter">
			</form>
			</div>
			</div>';
		?>
	</div>
</body>
</html>
