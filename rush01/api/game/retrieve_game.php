<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/class/Player.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Battleship.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Board.class.php';
require_once $_SERVER['DOCUMENT_ROOT'].'/class/Obstacle.class.php';

    $foldername = $_SERVER['DOCUMENT_ROOT'].'/data/games/';
    $filename = $foldername.'test_game';

    $str = file_get_contents($filename);
    $board = unserialize($str);

   header('Content-Type: application/json');
    echo json_encode($board->arrayify(), JSON_FORCE_OBJECT);
