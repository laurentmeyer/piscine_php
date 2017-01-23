<?php
require_once('../../class/User.class.php');
$user = new User(array('login' => $_POST['user'], 'passwd' => $_POST['password'], 'register' => 'ON'));

header("Content-Type: application/json");
$id = $user->get('_id');

if(!isset($id))
    $id = 0;

echo('{ "id" : "' . $id . '" }');