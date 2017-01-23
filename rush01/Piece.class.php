<?php

ini_set('display_errors', 1);

class Piece {

	const BUSY = 1;

	protected $_vertical;
	protected $_horizontal;
	protected $_originx;
	protected $_originy;

	protected function which_squares ( $x, $y, $h, $v ) {
		$array = array();
		foreach ( range( $x, $x + $v - 1 ) as $line )
			foreach ( range( $y, $y + $h - 1 ) as $col )
				$array[$line][$col] = self::BUSY;
		return ( $array );
	}

}

?>
