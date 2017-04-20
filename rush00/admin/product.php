<?php
include ('../auth.php');
session_start();
if (!is_admin($_SESSION['loggued_on_user']))
{
    header("Location: ../login.php");
    return ;
}
if (!($product = get_product_details($_GET['name'])))
{
    header("HTTP/1.0 404 Not Found");
    return ;
}

$html = <<<HTML
<a href="../index.php">Retour au shop</a>  || <a href="index.php">Accueil de l'admin</a>
<h1>$product[name]</h1>
HTML;
echo $html;

$html = <<<HTML
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="../css/style2.css"/>
<h3>Edition du produit</h3>
<form action="../admin_actions.php" method="post">
	Nouveau nom : <input type="text" name="name" value="$product[name]">
	<br />
	Nouvelle image : <input type="text" name="img_path" value="$product[img_path]">
	<br />
	Nouvelle description : <input type="text" name="description" value="$product[description]">
	<br />
	Nouveau prix : <input type="text" name="price" value="$product[price]">
	<br />
	<input type="hidden" name="oldname" value="$product[name]" />
	<input type="hidden" name="action" value="edit_product" />
	<input type="submit" name="submit" value="OK"/>
</form>
HTML;
echo $html;

$table_head = <<<HTML
<h3>Changement des categories</h3>
<table class="admintable">
<tr>
<th>Catégorie</th>
<th>Appartient</th>
<th>Action</th>
</tr>
HTML;
echo $table_head;

$categories = get_all_categories();
foreach ($categories as $c)
{
    if (category_has_product($c['name'], $product['name']))
    {
$html = <<<HTML
<tr>
<td>
    $c[name]
</td>
<td>Oui</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="product" value="$product[name]" />
	<input type="hidden" name="action" value="remove_from_category" />
	<input type="hidden" name="category" value="$c[name]" />
	<input type="submit" value="Remove">
</form>
    
</td>
</tr>
HTML;
        echo $html;
    }
    else
    {
$html = <<<HTML
<tr>
<td>
    $c[name]
</td>
<td>Non</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="product" value="$product[name]" />
	<input type="hidden" name="action" value="add_to_category" />
	<input type="hidden" name="category" value="$c[name]" />
	<input type="submit" value="Add">
</form>
    
</td>
</tr>
HTML;
        echo $html;
    }
}
echo '</table>';

?>
