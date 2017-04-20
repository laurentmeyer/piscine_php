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
<h1>Edition des utilisateurs</h1>
<h3>Supprimer un utilisateur</h3>
<table class="admintable">
<tr>
<th>Login</th>
<th>Supprimer</th>
<th>Admin</th>
</tr>
HTML;
echo $html;

$users = get_all_users();
foreach ($users as $u)
{
    if ($u['login'] == $_SESSION['loggued_on_user'])
    {
$html = <<<HTML
<tr>
<td>
    $u[login]
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="submit" name="submit" value="Supprimer" disabled />
</form>
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="submit" name="submit" value="Enlever admin" disabled />
</form>
</td>
</tr>
HTML;
	echo $html;
    }
    else if ($u['admin'] && ($u['login'] != $_SESSION['loggued_on_user']))
    {
$html = <<<HTML
<tr>
<td>
    $u[login]
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="login" value="$u[login]" />
	<input type="hidden" name="action" value="delete_user" />
	<input type="submit" name="submit" value="Supprimer"/>
</form>
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="login" value="$u[login]" />
	<input type="hidden" name="action" value="remove_admin" />
	<input type="submit" name="submit" value="Enlever admin"/>
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
    $u[login]
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="login" value="$u[login]" />
	<input type="hidden" name="action" value="delete_user" />
	<input type="submit" name="submit" value="Supprimer"/>
</form>
</td>
<td>
<form action="../admin_actions.php" method="post">
	<input type="hidden" name="login" value="$u[login]" />
	<input type="hidden" name="action" value="make_admin" />
	<input type="submit" name="submit" value="Mettre admin"/>
</form>
</td>
</tr>
HTML;
	echo $html;
    }
}
echo '</table>';

?>
