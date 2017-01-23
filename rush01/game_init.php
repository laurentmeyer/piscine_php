<?php

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

require_once("Player.class.php");
require_once("Battleship.class.php");
require_once("Board.class.php");

//Board::$verbose = True;
//Player::$verbose = True;
//Battleship::$verbose = True;

$p1 = new Player ( array ( 'name' => 'Laurent' ) );
$p2 = new Player ( array ( 'name' => 'Francois' ) );

$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 0, 'originy' => 80, 'direction' => "N" ) ) ;
//$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 60, 'originy' => 80, 'direction' => "N" ) ) ;
//$b1 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 4, 'originx' => 31, 'originy' => 21, 'direction' => "N" ) ) ;
$b2 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 30, 'originy' => 20, 'direction' => "S" ) ) ;

$p1->attribute_battleship( $b1 );
$p2->attribute_battleship( $b2 );


$board = new Board ();
$board->attribute_player( $p1 );
$board->attribute_player( $p2 );

$b1->move_ahead();

?>
