<?php

ini_set('display_errors', 1);

require_once("Player.class.php");

class Game {

	public static $verbose = False;

	private $_players = array();

	public function getPlayers () {
		return ( $this->_players );
	}

	public function __construct ( array $kwargs ) {
		$this->_players = $kwargs['players'];
		if ( self::$verbose )
			print ( 'New game created with ' . count( $this->_players ) . ' players.' . PHP_EOL );
	}

}

?>
