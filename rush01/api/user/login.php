<?php
require_once '../../class/User.class.php';
session_start();
header("Content-Type: application/json");
if (isset($_SESSION['user']) && $_SESSION['user'] instanceof User)
{
  echo '{ "id" : "'.$_SESSION['user']->connect_user() .'"}';
}
else if (!isset($_POST))
{
    echo '{ "id" : "0" }';
}
else
{
    $user = new User(array('login' => $_POST['user'], 'passwd' => $_POST['password']));
    echo '{ "id" : "'.$user->connect_user() .'" }';
}