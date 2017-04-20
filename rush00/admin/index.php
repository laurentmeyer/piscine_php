<?php

include ('../auth.php');
session_start();
if (!is_admin($_SESSION['loggued_on_user']))
{
    header("Location: ../login.php");
    return ;
}
$html = <<<HTML
<body>
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="../css/style2.css"/>
<a href="../index.php">Retour au shop</a>  || <a href="index.php">Accueil de l'admin</a>
<h1>Le super admin sans CSS ouais ouais</h1>
<a href="products.php">Editer les produits</a>
<br />
<br />
<a href="categories.php">Editer les categories</a>
<br />
<br />
<a href="users.php">Editer les utilisateurs</a>
<br />
<br />
<a href="orders.php">Afficher les commandes</a>
</body>
HTML;
echo $html;
?>
