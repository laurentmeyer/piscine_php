<?php
session_start();
include ("db_selects.php");
if ($_SESSION['loggued_on_user']) {
  $user = $_SESSION['loggued_on_user'];
} else {
  $user = "Se connecter";
}
if ($_GET['add_elem']) {
  $_SESSION['cart'][$_GET['add_elem']] += 1;
}
$categorie = select_all_categories();
?>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="stylesheet.css">
</head>
<body>
  <div class="logo">
    <img src="img/home-supermarket.gif">
  </div>
  <div class="menu">
    <div class="categorie">
      <form action="index.php">
        Categorie :
        <select name="categorie">
          <?php
          while (($row = mysqli_fetch_assoc($categorie)) != NULL) {
            echo "<option class='text' value=".$row['id'].">".$row['name']."</option>";
          }
          ?>
        </select>
        <input type="submit" name="submit" value="Valider"/>
      </form>
    </div>
    <div class="cart">
      <a href="panier.php" name="login">Panier <?php echo "(0)"; ?></a>
    </div>
    <div class="login">
      <?php
      if ($user == "Se connecter") {
        echo "<form action='login.php' name='index.php' method='post' autocomplete='off'>
    			Identifiant: <input type='text' name='login'/>
    			Mot de passe: <input type='password' name='passwd'/>
    			<input type='submit' name='submit' value='Connecter'/>
    		</form><a href='create.html' name='create'>Creer un compte</a>";
      }else{
        echo "<a href='modif.html' name='login'>Modifier son compte ".$user."</a>
      <a href='logout.php' name='logout'>Se deconnecter</a>";
      }
      ?>
    </div>
  </div>
  <div>
    <?php
    $array = select_all_products();
    while (($row = mysqli_fetch_assoc($array)) != NULL) {
      echo "<div class='product'>
              <div name='".$row['name']."'><img class='picture' src=\"".$row['img_path']."\" name='".$row['name']."'></div>
              <div class='name' name='".$row['name']."'>".$row['name']."</div>
              <div class='def' name='".$row['name']."'>".$row['description']."</div>
              <div><form action='index.php'><button class='add_cart' type='submit' name='add_elem' value='".$row['id']."'>Ajouter au panier</button></form></div>
              <div class='price' name='".$row['name']."'>".$row['price']."</div>
            </div>";
    }
    ?>
  </div>
</body>
</html>
