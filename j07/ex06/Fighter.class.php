<?php

abstract class Fighter {

	private $_fighter_type;

	abstract public function fight( $target ) ;

	public function __construct( $str ) {
		$this->_fighter_type = $str ;
	}

	public function __toString () {
		return ( $this->_fighter_type );
	}
}


?>
