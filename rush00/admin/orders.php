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
<h1>Affichage des commandes</h1>
<h3>Afficher une commande</h3>
<table class="admintable">
<tr>
<th>Login</th>
<th>Date</th>
<th>Montant</th>
<th>Action</th>
</tr>
HTML;
echo $html;

$orders = get_all_orders();
foreach ($orders as $id => $o)
{
$date = date("j M Y", $o[date]);
$html = <<<HTML
<tr>
<td>$o[login]</td>
<td>$date</td>
<td>$o[total]</td>
<td>
<form action= "order.php">
	<input type="hidden" name="id" value="$id" />
	<input type="submit" value="Voir">
</form>
</td>
</tr>
HTML;
	echo $html;
}
echo '</table>';

?>
