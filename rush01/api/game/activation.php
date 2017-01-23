<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

session_start ();

header("Content-Type: application/json");

require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Player.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Activation.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Battleship.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Board.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Obstacle.class.php' );

$game = $_SESSION['game'];
$foldername = $_SERVER['DOCUMENT_ROOT'] . "/data/games/";
//$filename = $foldername . "test_game";
$filename = $foldername . $game;


$str = file_get_contents($filename);
$board = unserialize( $str );

if ( $_SERVER['REQUEST_METHOD'] == 'POST'
            && $_POST['action'] == 'new' ) ) {
    if ( $board->getActivation() != NULL ) {
        $board->setActivation( NULL );
    }
    $action = array ( 'action' => 'choose_ship' );
    if ( !is_a( ($player = $board->whoseTurn() ), "Player" ) ) {
        //geme finisher
    }
    $action['player'] = $player->getPlayername();
    $bs = $player->getUnactivatedBattleships();
    //renvoyer cles valeurs
    $action['battleships'] = $player->getUnactivatedBattleships();
    $json = array( 'board' => $board->arrayify() , 'activation' => $action );
    echo json_encode( $json, JSON_FORCE_OBJECT );
    return ;
}

else if ( $_SERVER['REQUEST_METHOD'] == 'POST'
            && $_POST['action'] == 'select' ) ) {
                
    $action = array ( 'action' => 'choose_ship' );
    $player = $_SESSION['user'];
    $bs = $player->getActiveships()[$_POST['ship_id']];
    $board->setActivation( $bs );
    
    $activation = $board->getActivation();
    $action['player'] => $player;
    $action['options'] == $activation->listPossibleActions();
    $json = array( 'board' => $board->arrayify() , 'activation' => $action );
    echo json_encode( $json, JSON_FORCE_OBJECT );
    return ;
}
     const ORDER = 'order';
    const MOVEMENT = 'movement';
    const FIRE = 'fire';
    
else if ( $_SERVER['REQUEST_METHOD'] == 'POST'
            && $_POST['action'] == 'set' ) ) {




$activation = $board->getActivation();
$battleship = $activation->getBattleship();

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'new') {
    $_SESSION['game'] = $_POST

if ( $_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['action'] == 'whichaction') {
    $actionsarray = $activation->listPossibleActions();
    echo json_encode( $actionsarray, JSON_FORCE_OBJECT );
    return ;
}


 
file_put_contents($filename, $str);
?>