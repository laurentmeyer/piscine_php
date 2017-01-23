<?php
session_start();
include ("db_selects.php");
include ("db_describes.php");
$msg = NULL;
if ($_SESSION['loggued_on_user'] == 'admin') {
  $user = $_SESSION['loggued_on_user'];
} else {
  header("refresh:3; url=index.php");
  $_SESSION['loggued_on_user'] = "";
  $msg = "Vous n'avez pas le droit d'etre ici...";
}
$list_user = "lol";
$list_categorie = select_all_categories();
$list_products= select_all_products();
$action = array("Ajouter_un_produit" => "Ajouter_un_produit",
          "Modifier_un_produit" => "Modifier_un_produit",
          "Supprimer_un_produit" => "Supprimer_un_produit",
          "Ajouter_une_categorie" => "Ajouter_une_categorie",
          "Modifier_une_categorie" => "Modifier_une_categorie",
          "Supprimer_une_categorie" => "Supprimer_une_categorie",
          "Modifier_un_utilisateur" => "Modifier_un_utilisateur",
          "Supprimer_un_utilisateur" =>"Supprimer_un_utilisateur");
if ($msg) {
  echo "<h1 style='color:red' align='center'>".$msg."</h1>";
}
if ($_GET['action']) {
  $get_action = $_GET['action'];
}
if ($_GET['action2']) {
  $get_action2 = $_GET['action2'];
  $content = array("lol");
  $prod = select_product($_GET['action2']);
}
if ($get_action == 'Ajouter_un_produit' || $get_action == 'Modifier_un_produit' || $get_action == 'Ajouter_une_categorie' || $get_action == 'Modifier_une_categorie') {
  $type = 'text';
}
if ($get_action == 'Supprimer_un_produit' || $get_action == 'Supprimer_une_categorie' || $get_action == 'Supprimer_un_utilisateur') {
  $type = 'checkbox';
}
if ($get_action == 'Ajouter_un_produit' || $get_action == 'Modifier_un_produit' || $get_action == 'get_prod') {
  $table_fields = table_fields('Products');
}
else if ($get_action == 'Ajouter_une_categorie' || $get_action == 'Modifier_une_categorie' || $get_action == 'get_cat') {
  $table_fields = table_fields('Categories');
}
else if ($get_action == 'Supprimer_un_utilisateur' || $get_action == 'Modifier_un_utilisateur') {
  $table_fields = table_fields('Users');
}
$submit = $_GET['submit'];
?>
<html>
  <head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' href='stylesheet.css'>
  </head>
  <body>
    <div class='logo'>
      <img src='img/home-supermarket.gif'>
    </div>
    <div class='menu'>
      <div class='categorie'>
        <form action='admin.php'>
          Categorie :
          <select name="action">
            <?php
            foreach ($action as $elem => $value) {
              if ($value == $get_action) {
                echo "<option class='text' value=".$value." selected>".$elem."</option>";
              }else {
                echo "<option class='text' value=".$value.">".$elem."</option>";
              }
            }
            ?>
          </select>
          <select name="action2">
            <?php
              if ($_GET['action'] == 'Modifier_un_produit' || $_GET['action'] == 'Supprimer_un_produit') {
                foreach ($list_products as $elem) {
                  if ($elem['name'] == $get_action2) {
                    echo "<option class='text' value=".$elem['name']." selected>".$elem['name']."</option>";
                  } else {
                    echo "<option class='text' value=".$elem['name'].">".$elem['name']."</option>";
                  }
                }
              }
              else if ($_GET['action'] == 'Modifier_une_categorie' || $_GET['action'] == 'Supprimer_une_categorie') {
                foreach ($list_categorie as $elem) {
                  if ($elem['name'] == $get_action2) {
                    echo "<option class='text' value=".$elem['name']." selected>".$elem['name']."</option>";
                  } else {
                    echo "<option class='text' value=".$elem['name'].">".$elem['name']."</option>";
                  }
                }
              }
            ?>
          </select>
          <input type='submit' name='submit' value='Valider'/>
          <?php echo $_POST['categorie']; ?>
        </form>
      </div>
      <div class='login'>
        <a href='logout.php'>Se deconnecter</a>
      </div>
    </div>
    <div>
    <?php
      if ($get_action == 'Ajouter_un_produit') {
        foreach ($table_fields as $elem => $value) {
          echo "<form action='admin.php' class='action' method='post'>"
              .$value." : <input type='".$type."' name='".$value."' required size='100'>*
              <br><br>";
        }
        echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
      }
      else if ($get_action == 'Modifier_un_produit' && $get_action2) {
          if (($row = mysqli_fetch_assoc($prod)) != NULL) {
            foreach ($row as $elem => $value) {
              if ($elem == 'id') {
                echo "<form action='admin.php' class='action' method='post'>"
                    .$elem." : <input type='".$type."' name='".$elem."' value='".$value."'required disabled='disabled' size='100'>*
                    <br><br>";
              } else {
                echo "<form action='admin.php' class='action' method='post'>"
                    .$elem." : <input type='".$type."' name='".$elem."' value='".$value."'required size='100'>*
                    <br><br>";
              }
            }
            echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
         }
       }
       else if ($get_action == 'Ajouter_une_categorie') {
         foreach ($table_fields as $elem) {
               if ($elem == 'id') {
               } else {
                 echo "<form action='admin.php' class='action' method='post'>"
                     .$elem." : <input type='".$type."' name='".$elem."'required size='100'>*
                     <br><br>";
               }
             }
          echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
       }
       else if ($get_action == 'Modifier_une_categorie' && $get_action2) {
           foreach ($table_fields as $elem => $value) {
                 if ($elem == 'id') {
                 } else {
                   echo "<form action='admin.php' class='action' method='post'>"
                       .$value." : <input type='".$type."' name='".$value."' required  size='100'>*
                       <br><br>";
                 }
         }
         echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
      }
      else if ($get_action == 'Supprimer_un_produit' && $get_action2) {
          echo "<form action='admin.php' method='post'>";
          echo "<div class='msg_delete'>Valider suppression : <input type='".$type."' name='id'></div>";
          echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
          echo "</form>";
      }
      else if ($get_action == 'Supprimer_une_categorie' && $get_action2) {
          echo "<form action='category_delete.php' method='post'>";
          echo "<div class='msg_delete'>Valider suppression : <input type='".$type."' name='id' value='3'></div>";
          echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
          echo "</form>";
      }
      else if ($get_action == 'Supprimer_un_utilisateur') {
          echo "<form action='user_delete.php' method='post'>";
          echo "<div class='msg_delete'>Valider suppression : <input type='".$type."' name='id'></div>";
          echo "<div align='center'><input type='submit' name='submit' value='Valider'/></div></form>";
          echo "</form>";
      }
      ?>
    </div>
  </body>
</html>
