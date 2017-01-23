<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

session_start ();

require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Player.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Battleship.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Board.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Obstacle.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Weapon.class.php' );
require_once( $_SERVER["DOCUMENT_ROOT"] . '/class/Activation.class.php' );

//Board::$verbose = True; //
//Player::$verbose = True;
//Battleship::$verbose = True;

$p1 = new Player ( array ( 'name' => 'Laurent', 'team' => 1 ) );
$p2 = new Player ( array ( 'name' => 'Francois', 'team' => 1 ) );
$p3 = new Player ( array ( 'name' => 'Lenaic', 'team' => 2 ) );
$p4 = new Player ( array ( 'name' => 'Manu', 'team' => 2 ) );

$w1 = array('name' => 'lance', 'charges' => 0, 'sr' => 30, 'mr' => 50, 'lr' => 70, 'shape' => 'line');
$w2 = array('name' => 'spray', 'charges' => 3, 'sr' => 10, 'mr' => 20, 'lr' => 30, 'shape' => 'trapez');
$w3 = array('name' => 'missile', 'charges' => 0, 'sr' => 7, 'mr' => 14, 'lr' => 21, 'shape' => 'circle');
$w4 = array('name' => 'stoi', 'charges' => 7, 'sr' => 20, 'mr' => 30, 'lr' => 40, 'shape' => 'oval');

$s1 = array(new Weapon($w1), new Weapon($w3));
$s2 = array(new Weapon($w3));
$s3 = array(new Weapon($w2), new Weapon($w4), new Weapon($w1));
$s4 = array(new Weapon($w2), new Weapon($w4), new Weapon($w1));
$s5 = array(new Weapon($w1), new Weapon($w3));

//$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 0, 'originy' => 10, 'direction' => "E" ) ) ; // DESTRUCTION
//$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 40, 'originy' => 10, 'direction' => "E" ) ) ; // MOVE
//$b1 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 4, 'originx' => 31, 'originy' => 21, 'direction' => "N" ) ) ; // COLLISION
$b1 = new Battleship ( array ( 'horizontal' => 5, 'vertical' => 1, 'originx' => 31, 'originy' => 20, 'direction' => "E" , 'weapons' => $s1) ) ; // COLLISION ON ROTATE
$b2 = new Battleship ( array ( 'horizontal' => 5, 'vertical' => 1, 'originx' => 50, 'originy' => 20, 'direction' => "E" , 'weapons' => $s2) ) ;
$o1 = new Obstacle ( array ( 'horizontal' => 2, 'vertical' => 8, 'originx' => 10, 'originy' => 10 ) ) ;
$o2 = new Obstacle ( array ( 'horizontal' => 5, 'vertical' => 4, 'originx' => 50, 'originy' => 40 ) ) ;
$b3 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 1, 'originx' => 12, 'originy' => 9, 'direction' => "W" , 'weapons' => $s3) ) ; // DESTRUCTION
$b4 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 1, 'originx' => 40, 'originy' => 25, 'direction' => "S" , 'weapons' => $s3) ) ; // DESTRUCTION
$b5 = new Battleship ( array ( 'horizontal' => 6, 'vertical' => 3, 'originx' => 60, 'originy' => 25, 'direction' => "N" , 'weapons' => $s3) ) ; // DESTRUCTION

$p1->attribute_battleship( $b1 );
$p2->attribute_battleship( $b2 );
$p2->attribute_battleship( $b3 );
$p3->attribute_battleship( $b4 );
$p3->attribute_battleship( $b5 );


$board = new Board ();
$board->attribute_player( $p1 );
$board->attribute_player( $p2 );
$board->attribute_player( $p3 );
$board->attribute_player( $p4 );
$board->attribute_obstacle( $o1 );
$board->attribute_obstacle( $o2 );
$p1->setState('CANPLAY');

$lol = new Activation($b1);

echo "debut<br>";
var_dump($lol->listPossibleActions);
echo "fin<br>";

// echo PHP_EOL . $board->whoseTurn() . PHP_EOL;

// $foldername = $_SERVER['DOCUMENT_ROOT'] . "/data/games/";
// $filename = $foldername . "test_game";

/*if (!file_exists($filename)) {
	if (!file_exists($foldername))
		mkdir($foldername);
} 
	$str = serialize( $board );
    file_put_contents($filename, $str);*/

//header("Content-Type: application/json");
//echo json_encode( $board->arrayify (), JSON_FORCE_OBJECT );














////$b1->move_ahead();
//$b1->rotate( "left" );
////$b3->move_ahead();
////$b3->move_ahead();
//$b3->move_ahead();

//$boardstate = $board->get_board_state();
//
//echo '<html><body>' . PHP_EOL ;
//echo '<table style="width:100%">' . PHP_EOL ;
//foreach ( range( 1, Board::LINES ) as $line ) {
//	echo '<tr>' . PHP_EOL ;
//	foreach ( range( 1, Board::COLUMNS ) as $col ) {
//		echo '<td>' ;
//		if ( array_key_exists( $line, $boardstate )
//				&& array_key_exists( $col, $boardstate[$line] ) ) {
//			if ( $boardstate[$line][$col]['piece'] == "battleship" ) {
//				echo 'a';
//			} else if ( $boardstate[$line][$col]['piece'] == "obstacle" ) {
//				echo 'O';
//			}
//		} else {
//			echo ' ';
//		}
//		echo '</td>' . PHP_EOL ;
//	}
//	echo '</tr>' . PHP_EOL ;
//}
//echo '</table>' . PHP_EOL ;
//echo '</body></html>' . PHP_EOL;

?>