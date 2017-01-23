<?php

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

require_once("Piece.class.php");
require_once("Board.class.php");

class Battleship extends Piece {

	const MOVE = 1;
	const DESTRUCTION = 0;
	const COLLISION = -1;

	public static $verbose = False;

	private $_player;
	private $_activated = False;
	private $_direction = "N";
	private $_name = "Honorable Duty";
	private $_pp = 10;
	private $_speed = 15;
	private $_manoeuvre = 4;
	private $_shield = 0;
	private $_weapons = array();
	private $_idle = True;

	public function getOriginX() { return ( $this->_originx ) ; }
	public function getOriginY() { return ( $this->_originy ) ; }
	public function getHorizontal() { return ( $this->_horizontal ) ; }
	public function getVerical() { return ( $this->_vertical ) ; }
	public function getPlayer() { return ( $this->_player ) ; }
	public function setPlayer( Player $player ) { $this->_player = $player ; }
	public function destroy() { $this->_player->destroyBattleship( $this ) ; }

	public function current_position() {
		return (
			$this->which_squares( $this->getOriginX(),
			$this->getOriginY(),
			$this->getHorizontal(),
			$this->getVerical() ) ) ;
	}

	public function move_ahead () {
		$down_offset = 0;
		$right_offset = 0;

		if ( $this->_direction == "N" || $this->_direction == "S" )
			$down_offset = $this->_direction == "N" ? 1 : -1;
		else if ( $this->_direction == "E" || $this->_direction == "W" )
			$right_offset = $this->_direction == "E" ? 1 : -1;

		$new_position = $this->which_squares(
			$this->getOriginX() - $down_offset,
			$this->getOriginY() + $right_offset,
			$this->getHorizontal(),
			$this->getVerical() );

		$this->getPlayer()->getBoard()->make_move( $this, $new_position );

	}

	public function __construct ( array $kwargs ) {
		$this->_horizontal = $kwargs['horizontal'];
		$this->_vertical = $kwargs['vertical'];
		$this->_originx = $kwargs['originx'];
		$this->_originy = $kwargs['originy'];
		$this->_direction = $kwargs['direction'];
				if ( self::$verbose )
					print ( $this );
	}

	public function __toString () {
		if ( self::$verbose )
			print_r ( $this->current_position() ) ;
		return ("");


	}

}

?>
