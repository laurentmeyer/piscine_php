<?php

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

class Player {

	public static $verbose = False;

	//private $_faction;
	private $_board;
	private $_playerName;
	private $_battleships = array();


	public function attribute_battleship ( Battleship $bs ) {
		$this->_battleships[] = $bs;
		$bs->setPlayer( $this );
	}

	public function setBoard( Board $board ) { $this->_board = $board ; }
	public function getBoard () { return ( $this->_board ) ; }
	public function getBattleships () {
		return ( $this->_battleships );
	}

	public function destroyBattleship ( Battleship $bs ) {
		foreach ( $this->_battleships as $index => $ship )
			if ( $ship === $bs )
				unset ( $index );
	}

	public function __construct ( array $kwargs ) {
		$this->_playerName = $kwargs['name'];
		if ( self::$verbose )
			print ( 'Player ' . $this->_playerName . ' constructed.' . PHP_EOL );
		return ;
	}
}

?>
