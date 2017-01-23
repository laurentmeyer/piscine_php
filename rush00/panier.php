<?php
session_start();
include ("db_selects.php");
if ($_SESSION['loggued_on_user']) {
  $user = $_SESSION['loggued_on_user'];
} else {
  $user = "Se connecter";
}
if ($_GET['del_elem']) {
  $_SESSION['cart'][$_GET['del_elem']] -= 1;
}
$list_products= select_all_products();
?>
<html>
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
      <a href="index.php" name="retour">Retour au site</a>
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
    foreach ($_SESSION['cart'] as $key => $value) {
      echo "<div class='product'>
              <div name='".$row['name']."'><img class='picture' src=\"".$row['img_path']."\" name='".$row['name']."'></div>
              <div class='name' name='".$row['name']."'>".$row['name']."</div>
              <div class='def' name='".$row['name']."'>".$row['description']."</div>
              <div><form action='panier.php'><button class='add_cart' type='submit' name='del_elem' value='".$row['id']."'>Supprimer au panier</button></form></div>
              <div class='price' name='".$row['name']."'>".$row['price']."</div>
            </div>";
    }
    ?>
  </div>
  <div class='price'>
    <?php
    // $tab1 = array("id" => "lol", "name" => "xD", "price" => 5);
    // $tab2 = array("id" => "lol", "name" => "xD", "price" => 7);
    // $array_cart = array($tab1, $tab2);
    if ($_SESSION['cart']) {
      foreach ($_SESSION['cart'] as $elem) {
        foreach ($list_products as $value) {
          if ($elem == $value['id']) {
            echo "<div name='lol'> ".$elem." </div>";
          }
        }
      }
    }
    //   foreach ($_SESSION['cart'] as $value) {
    //     $sum += $value['price'];
    //   }
    //   echo $sum;
    ?>
  </div>
</body>
</html>
