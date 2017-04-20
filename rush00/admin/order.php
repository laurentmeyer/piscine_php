<?php
include ('../auth.php');
session_start();
if (!is_admin($_SESSION['loggued_on_user']))
{
    header("Location: ../login.php");
    return ;
}
$order = get_order($_GET['id']);
$date = date("j M Y", $order[date]);
$html = <<<HTML
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="../css/style2.css"/>
<a href="../index.php">Retour au shop</a>  || <a href="index.php">Accueil de l'admin</a>
<h1>Commande numéro $_GET[id]</h1>
Date: $date
<br />
Login: $order[login]
<br />
Montant: $order[total] euros (c'est pas beaucoup)
<br />

HTML;
echo $html;

$html = <<<HTML
<h3>Détail de la commande</h3>
<table class="admintable">
<tr>
<th>Produit</th>
<th>Quantité</th>
</tr>
HTML;
echo $html;

$cart = unserialize($order['cart']);
foreach ($cart as $product => $quantity)
{
$html = <<<HTML
<tr>
<td>$product</td>
<td>$quantity</td>
</tr>
HTML;
	echo $html;
}
echo '</table>';

?>
