<?php
include('../auth.php');
session_start();
if (!is_admin($_SESSION['loggued_on_user']))
{
    header("Location: ../login.php");
    return ;
}
$html = <<<HTML
<link rel="stylesheet" media="screen" type="text/css" title="Design" href="../css/style2.css"/>
<a href="../index.php">Retour au shop</a>  || <a href="index.php">Accueil de l'admin</a>
<h1>Edition des categories</h1>
<h3>Ajouter une categorie</h3>
<form action="../admin_actions.php" method="post">
	Nouvelle categorie : <input type="text" name="name" value="">
	<br />
	<input type="hidden" name="action" value="create_category" />
	<input type="submit" name="submit" value="OK"/>
</form>
<h3>Supprimer une categorie</h3>
<table class="admintable">
<tr>
<th>Nom</th>
<th>Action</th>
</tr>
HTML;
echo $html;

$categories = get_all_categories();
foreach ($categories as $c)
{
$html = <<<HTML
<tr>
<td>
    $c[name]
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="name" value="$c[name]" />
	<input type="hidden" name="action" value="delete_category" />
	<input type="submit" name="submit" value="Supprimer"/>
</form>
    
</td>
</tr>
HTML;
	echo $html;
}

?>
