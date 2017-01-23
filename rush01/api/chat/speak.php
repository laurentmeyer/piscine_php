<?php
require_once($_SERVER['DOCUMENT_ROOT']."/class/User.class.php");
session_start();
date_default_timezone_set('Europe/Paris');

$_SESSION['user']->send_message($_POST['msg']);
