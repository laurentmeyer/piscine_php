<?php

class UnholyFactory {

	private $_absorbed = array();

	public function absorb( $fighter ) {

		if ( !is_a( $fighter, "Fighter" ) )
		   	print ( '(Factory can\'t absorb this, it\'s not a fighter)' . PHP_EOL );
		else if ( array_key_exists ( sprintf ( '%s', $fighter ), $this->_absorbed ) )
			print ( '(Factory already absorbed a fighter of type ' . $fighter . ')' . PHP_EOL );
		else {
			$this->_absorbed[ sprintf ( '%s', $fighter ) ] = $fighter;
			print ( '(Factory absorbed a fighter of type ' . $fighter . ')' . PHP_EOL );
		}

	}

	public function fabricate( $fighter ) {
		if ( !array_key_exists ( $fighter, $this->_absorbed ) ) {
		   	print ( '(Factory hasn\'t absorbed any fighter of type ' . $fighter . ')' . PHP_EOL );
			return NULL;
		} else {
		   	print ( '(Factory fabricates a fighter of type ' . $fighter . ')' . PHP_EOL );
			return ( clone $this->_absorbed[ $fighter ] ) ;
		}
	}
}

?>
