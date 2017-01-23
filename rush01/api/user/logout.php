<?php
require_once('../../class/User.class.php');
session_start();
$_SESSION['user']->delog_user();