<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

require_once("class/Player.class.php");
require_once("class/Battleship.class.php");
require_once("class/Board.class.php");
require_once("class/Obstacle.class.php");

//Board::$verbose = True;
//Player::$verbose = True;
//Battleship::$verbose = True;

$p1 = new Player ( array ( 'name' => 'Laurent' ) );
$p2 = new Player ( array ( 'name' => 'Francois' ) );

//$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 0, 'originy' => 10, 'direction' => "E" ) ) ; // DESTRUCTION
//$b1 = new Battleship ( array ( 'horizontal' => 4, 'vertical' => 1, 'originx' => 40, 'originy' => 10, 'direction' => "E" ) ) ; // MOVE
//$b1 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 4, 'originx' => 31, 'originy' => 21, 'direction' => "N" ) ) ;// COLLISION
$b1 = new Battleship ( array ( 'horizontal' => 5, 'vertical' => 1, 'originx' => 31, 'originy' => 20, 'direction' => "E" ) ) ; // COLLISION ON ROTATE
$b2 = new Battleship ( array ( 'horizontal' => 5, 'vertical' => 1, 'originx' => 50, 'originy' => 20, 'direction' => "E" ) ) ;
$o1 = new Obstacle ( array ( 'horizontal' => 2, 'vertical' => 8, 'originx' => 10, 'originy' => 10 ) ) ;
$o2 = new Obstacle ( array ( 'horizontal' => 5, 'vertical' => 4, 'originx' => 50, 'originy' => 40 ) ) ;
$b3 = new Battleship ( array ( 'horizontal' => 1, 'vertical' => 1, 'originx' => 12, 'originy' => 9, 'direction' => "W" , '') ) ; // DESTRUCTION

$p1->attribute_battleship( $b1 );
$p2->attribute_battleship( $b2 );
$p2->attribute_battleship( $b3 );


$board = new Board ();
$board->attribute_player( $p1 );
$board->attribute_player( $p2 );
$board->attribute_obstacle( $o1 );
$board->attribute_obstacle( $o2 );

//$b1->move_ahead();
$b1->rotate( "left" );
//$b3->move_ahead();
//$b3->move_ahead();
$b3->move_ahead();











$boardstate = $board->get_board_state();

echo '<html><body>' . PHP_EOL ;
echo '<table style="width:100%">' . PHP_EOL ;
foreach ( range( 1, Board::LINES ) as $line ) {
	echo '<tr>' . PHP_EOL ;
	foreach ( range( 1, Board::COLUMNS ) as $col ) {
		echo '<td>' ;
		if ( array_key_exists( $line, $boardstate )
				&& array_key_exists( $col, $boardstate[$line] ) ) {
			if ( $boardstate[$line][$col]['piece'] == "battleship" ) {
				echo 'a';
			} else if ( $boardstate[$line][$col]['piece'] == "obstacle" ) {
				echo 'O';
			}
		} else {
			echo ' ';
		}
		echo '</td>' . PHP_EOL ;
	}
	echo '</tr>' . PHP_EOL ;
}
echo '</table>' . PHP_EOL ;
echo '</body></html>' . PHP_EOL;

?>
