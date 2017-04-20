<?php
include ('../auth.php');
session_start();
if (!is_admin($_SESSION['loggued_on_user']))
{
    header("Location: ../login.php");
    return ;
}
$html = <<<HTML
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="../css/style2.css"/>
<a href="../index.php">Retour au shop</a>  || <a href="index.php">Accueil de l'admin</a>
<h1>Edition des produits</h1>
<table class="admintable">
<tr>
<th>Nom</th>
<th>Editer</th>
<th>Supprimer</th>
</tr>
HTML;
echo $html;

$products = get_all_products();
foreach ($products as $p)
{
$html = <<<HTML
<tr>
<td>
    $p[name]
</td>
<td>
<form action= "product.php">
	<input type="hidden" name="name" value="$p[name]" />
	<input type="submit" value="Editer">
</form>
</td>
<td>
<form action= "../admin_actions.php" method="post">
	<input type="hidden" name="name" value="$p[name]" />
	<input type="hidden" name="action" value="delete_product" />
	<input type="submit" value="Supprimer">
</form>
</td>
</tr>
HTML;
	echo $html;
}
echo '</table>';

?>
