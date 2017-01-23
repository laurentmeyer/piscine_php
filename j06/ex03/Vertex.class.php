<?php

require_once 'Color.class.php';

class Vertex {

	public static $verbose = False;

	private $_x;
	private $_y;
	private $_z;
	private $_w;
	private $_color;

	public static function doc () {	return ( PHP_EOL . file_get_contents( './' . get_called_class() . '.doc.txt' ) ); }

	public function getX () { return ( $this->_x ); }
	public function getY () { return ( $this->_y ); }
	public function getZ () { return ( $this->_z ); }
	public function getW () { return ( $this->_w ); }
	public function getColor () { return ( $this->_color ); }
	public function setX ( $x ) { $this->_x = $x; }
	public function setY ( $y ) { $this->_y = $y; }
	public function setZ ( $z ) { $this->_z = $z; }
	public function setW ( $w ) { $this->_w = $w; }
	public function setColor ( $color ) {
		if ( is_a( $color, 'Color' ) ) { $this->_color = $color; return (True) ; } 
		else {
			if ( self::$verbose ) {
				print ( 'Error setting ' . get_called_class() .
					' color, argument must be of class Color.' . PHP_EOL );
			}
			return (0);
		}
	}

	public function __construct( array $kwargs ) {
		if (!array_key_exists( 'x', $kwargs )
			|| !array_key_exists( 'y', $kwargs )
			|| !array_key_exists( 'z', $kwargs ) ) {
				if ( self::$verbose )
					print ( 'Error constructing ' . get_called_class() . PHP_EOL );
				return ;
			}
		$this->setX( $kwargs['x'] );
		$this->setY( $kwargs['y'] );
		$this->setZ( $kwargs['z'] );
		$this->setW( array_key_exists( 'w', $kwargs ) ? $kwargs['w'] : 1 );
		if (!array_key_exists( 'color', $kwargs ) || !$this->setColor( $kwargs['color'] ))
			$this->setColor( new Color( array( 'rgb' => (255 << 16) + (255 << 8) + 255 ) ) );
		if ( self::$verbose )
			print ( $this . ' constructed' . PHP_EOL );
	}

	public function __destruct () {
		if ( self::$verbose )
			print ( $this . ' destructed' . PHP_EOL );
	}

	public function __toString () {
		if ( self::$verbose )
			return ( sprintf ( "Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f, %s )",
				$this->_x, $this->_y, $this->_z, $this->_w, $this->_color ) );
		return ( sprintf ( "Vertex( x: %.2f, y: %.2f, z:%.2f, w:%.2f )",
			$this->_x, $this->_y, $this->_z, $this->_w ) );
	}

}

?>
