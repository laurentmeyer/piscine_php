<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';

class Vector {

	public static $verbose = False;

	private $_x;
	private $_y;
	private $_z;
	private $_w;

	public static function doc () {	return ( PHP_EOL . file_get_contents( './' . get_called_class() . '.doc.txt' ) ); }

	public function getX () { return ( $this->_x ) ; }
	public function getY () { return ( $this->_y ) ; }
	public function getZ () { return ( $this->_z ) ; }
	public function getW () { return ( $this->_w ) ; }

	public function magnitude () {
		return ( sqrt( pow( $this->getX(), 2 )
			+ pow( $this->getY(), 2 )
			+ pow( $this->getZ(), 2 )
			+ pow( $this->getW(), 2 ) ) ) ;
	}

	public function normalize () {
		if ( ( $norm  = $this->magnitude() ) == 1 )
			return ( clone $this ) ;
		else
		{
			return ( new self ( array( 'dest' => new Vertex ( array(
				'x' => $this->getX() / $norm,
				'y' => $this->getY() / $norm,
				'z' => $this->getZ() / $norm,
				'w' => $this->getW() / $norm ) ) ) ) );
		}
	}

	public function add ( Vector $rhs ) {
		return ( new self ( array ( 'dest' => new Vertex ( array (
			'x' => $this->getX() + $rhs->getX(),
			'y' => $this->getY() + $rhs->getY(),
			'z' => $this->getZ() + $rhs->getZ(),
			'w' => $this->getW() + $rhs->getW() ) ) ) ) ) ;
	}

	public function sub ( Vector $rhs ) {
		return ( new self ( array ( 'dest' => new Vertex ( array (
			'x' => $this->getX() - $rhs->getX(),
			'y' => $this->getY() - $rhs->getY(),
			'z' => $this->getZ() - $rhs->getZ(),
			'w' => $this->getW() - $rhs->getW() ) ) ) ) ) ;
	}

	public function opposite () {
		return ( new self ( array ( 'dest' => new Vertex ( array (
			'x' => - $this->getX(),
			'y' => - $this->getY(),
			'z' => - $this->getZ(),
			'w' => - $this->getW() ) ) ) ) ) ;
	}

	public function scalarProduct ( $k ) {
		return ( new self ( array ( 'dest' => new Vertex ( array (
			'x' => $k * $this->getX(),
			'y' => $k * $this->getY(),
			'z' => $k * $this->getZ(),
			'w' => $k * $this->getW() ) ) ) ) ) ;
	}

	public function dotProduct ( Vector $rhs ) {
		return ( $this->getX() * $rhs->getX()
			+ $this->getY() * $rhs->getY()
			+ $this->getZ() * $rhs->getZ()
			+ $this->getW() * $rhs->getW() ) ;
	}

	public function cos ( Vector $rhs ) {
		return ( $this->dotProduct( $rhs )
			/ ( $this->magnitude() * $rhs->magnitude() ) ) ;
	}

	public function crossProduct ( Vector $rhs ) {
		return ( new self ( array ( 'dest' => new Vertex ( array (
			'x' => $this->getY() * $rhs->getZ() - $rhs->getY() * $this->getZ(),
			'y' => $this->getZ() * $rhs->getX() - $rhs->getZ() * $this->getX(),
			'z' => $this->getX() * $rhs->getY() - $rhs->getX() * $this->getY() ) ) ) ) ) ;
	}

	public function __construct( array $kwargs ) {
		if (!array_key_exists( 'dest', $kwargs ) || !is_a( $kwargs['dest'], 'Vertex' ) ) {
			if ( self::$verbose )
				print ( 'Error constructing ' . get_called_class() . PHP_EOL );
			return ;
		}
		if ( !array_key_exists( 'orig', $kwargs ) || !is_a( $kwargs['orig'], 'Vertex' ) ) {
			$kwargs['orig'] = new Vertex ( array ('x' => 0, 'y' => 0, 'z' => 0, 'w' => 1 ) ) ;
		} 
		$this->_x = $kwargs['dest']->getX() - $kwargs['orig']->getX();
		$this->_y = $kwargs['dest']->getY() - $kwargs['orig']->getY();
		$this->_z = $kwargs['dest']->getZ() - $kwargs['orig']->getZ();
		$this->_w = $kwargs['dest']->getW() - $kwargs['orig']->getW();

		if ( self::$verbose )
			print ( $this . ' constructed' . PHP_EOL );
	}

	public function __destruct () {
		if ( self::$verbose )
			print ( $this . ' destructed' . PHP_EOL );
	}

	public function __toString () {
		if ( self::$verbose )
			return ( sprintf ( "Vector( x: %.2f, y: %.2f, z:%.2f, w:%.2f)",
				$this->_x, $this->_y, $this->_z, $this->_w) );
	}
}

?>
