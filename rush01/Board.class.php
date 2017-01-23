<?php

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

require_once("Battleship.class.php");
require_once("Player.class.php");


class Board {

	const LINES = 150;
	const COLUMNS = 100;
	const OBSTACLE = "O";

	public static $verbose = False;

	private $_players = array();

	private function _current_board () {
		$allelements = array();
		$board = array();

		///////////////////////////////////////////////
		// RAJOUTER LES OBSTACLES DANS UN PREMIER TEMPS 
		///////////////////////////////////////////////
		foreach ( $this->_players as $playerindex => $player )
			foreach ( $player->getBattleships() as $index => $ship ) {
					$allelements[] = $ship;
			}

		foreach ( $allelements as $piece )
			foreach ( $piece->current_position() as $linenumber => $linearray )
				foreach ( $linearray as $colnumber => $colcontent ) {
				$board[$linenumber][$colnumber] = $piece;
			}

		return ( $board );

	}

	private function _current_board_except ( Battleship $bs ) {
		$allbutone = array();
		$board = array();

		///////////////////////////////////////////////
		// RAJOUTER LES OBSTACLES DANS UN PREMIER TEMPS 
		///////////////////////////////////////////////
		foreach ( $this->_players as $playerindex => $player )
			foreach ( $player->getBattleships() as $index => $ship ) {
				if ( !empty ( $ship ) && $ship !== $bs )
					$allbutone[] = $ship;
			}

		foreach ( $allbutone as $piece )
			foreach ( $piece->current_position() as $linenumber => $linearray )
				foreach ( $linearray as $colnumber => $colcontent ) {
				$board[$linenumber][$colnumber] = $piece;
			}

		return ( $board );
	}

	public function attribute_player ( Player $player ) {
		$this->_players[] = $player;
		$player->setBoard( $this );
	}

	public function make_move( Battleship $bs, array $newpos ) {
		$board = $this->_current_board_except( $bs );
		$destroyed = False;
		$collisions = array();
		$return = Battleship::MOVE ;


		foreach ( $newpos as $linenumber => $linecontent )
			foreach ( $linecontent as $colnumber => $colcontent ) {
				if ( $linenumber >= self::LINES || $linenumber < 0
					|| $colnumber >= self::COLUMNS || $colnumber < 0)
					$destroyed = True;
				if ( array_key_exists( $linenumber, $board )
					&&  array_key_exists( $colnumber , $board[$linenumber] ) )
				{
					if ( is_a ( ( $elt = $board[$linenumber][$colnumber] ), "Obstacle" )
						$destroyed = True;
					if ( is_a ( ( $elt = $board[$linenumber][$colnumber] ), "Battleship" )
						&& !in_array( $elt, $collisions ) )
						$collisions[] = $elt;
				}
			}

		if ( $destroyed ) {
			print ( ' VAISSEAU DETRUIT ! ' . PHP_EOL );
			$bs->destroy() ;
			$return = Battleship::DESTRUCTION ;
		}

		if ( !empty( $collisions ) ) {
			print ( ' COLLISION ! ' . PHP_EOL );
			if ( $destroyed == False )
				$collisions[] = $bs;

			//gerer les collisions sur chaque vaisseau

			if ( $destroyed == False )
				$return = Battleship::COLLISION ;
		}

		if ( $destroyed == False && empty( $collisions ) )
			print ( ' LE MOUVEMENT EST ACCEPTE ' . PHP_EOL );


		return ( $return );

	}

	private function _getPlayers () {
		return ( $this->_players );
	}

	private function active_ships () {
		$ret = array();
		foreach ( $this->_getPlayers() as $player )
			foreach ( $player->getBattleships() as $bs )
				$ret[] = $bs;
		// var_dump( $ret );
		return ( $ret );
	}

	public function __construct ( ) {
		if ( self::$verbose )
			print ( 'New board created with ' . count( $this->_players ) . ' players.' . PHP_EOL );
	}

}

?>
