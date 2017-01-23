<?php

class Color {

	public static $verbose = False;

	public $red;
	public $green;
	public $blue;

	public static function doc () {
		return ( PHP_EOL . file_get_contents( './' . get_called_class() . '.doc.txt' ) );
	}

	public function add ( self $rhs ) {
		$red = $this->red + $rhs->red;
		$green = $this->green + $rhs->green;
		$blue = $this->blue + $rhs->blue;
		return ( new self ( array( 'red' => $red, 'green' => $green, 'blue' => $blue ) ) );
	}

	public function sub ( self $rhs ) {
		$red = $this->red - $rhs->red;
		$green = $this->green - $rhs->green;
		$blue = $this->blue - $rhs->blue;
		return ( new self ( array( 'red' => $red, 'green' => $green, 'blue' => $blue ) ) );
	}

	public function mult ( $f ) {
		$red = $this->red * f;
		$green = $this->green * f;
		$blue = $this->blue * f;
		return ( new self ( array( 'red' => $red, 'green' => $green, 'blue' => $blue ) ) );
	}

	private function _decompose ( $rgb ) {
		$rgb = intval( $rgb );
		$this->blue = $rgb & 255;
		$rgb = $rgb >> 8;
		$this->green = $rgb & 255;
		$rgb = $rgb >> 8;
		$this->red = $rgb & 255;
	}

	public function __construct( array $kwargs ) {
		if ( array_key_exists( 'rgb', $kwargs ) )
			$this->_decompose ( $kwargs['rgb'] );
		else if ( array_key_exists( 'red', $kwargs )
			&& array_key_exists( 'green', $kwargs )
			&& array_key_exists( 'blue', $kwargs )) {
				$this->red = intval( $kwargs['red'] );
				$this->green = ( $kwargs['green'] );
				$this->blue = ( $kwargs['blue'] );
			}
		if ( self::$verbose )
			print ( $this . ' constructed.' . PHP_EOL );
	}

	public function __destruct () {
		if ( self::$verbose )
			print ( $this . ' destructed.' . PHP_EOL );
	}

	public function __toString () {
		return ( sprintf ( "Color( red: %3d, green: %3d, blue %3d )", $this->red, $this->green, $this->blue ) );
	}

}

?>
