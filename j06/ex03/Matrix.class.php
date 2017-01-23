<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';
require_once 'Vector.class.php';

date_default_timezone_set(UTC);
ini_set('display_errors', 1);

class Matrix {

	public static $verbose = False;

	const IDENTITY = 1;
	const SCALE = 2;
	const RX = 3;
	const RY = 4;
	const RZ = 5;
	const TRANSLATION = 6;
	const PROJECTION = 7;

	private $_m11 = 0.0;
	private $_m12 = 0.0;
	private $_m13 = 0.0;
	private $_m14 = 0.0;
	private $_m21 = 0.0;
	private $_m22 = 0.0;
	private $_m23 = 0.0;
	private $_m24 = 0.0;
	private $_m31 = 0.0;
	private $_m32 = 0.0;
	private $_m33 = 0.0;
	private $_m34 = 0.0;
	private $_m41 = 0.0;
	private $_m42 = 0.0;
	private $_m43 = 0.0;
	private $_m44 = 0.0;

	private function _getRowX () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m11, 'y' => $this->_m12, 'z' => $this->_m13, 'w' => $this->_m14 + 1 ) ) ) ) ) ; }
	private function _getRowY () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m21, 'y' => $this->_m22, 'z' => $this->_m23, 'w' => $this->_m24 + 1 ) ) ) ) ) ; }
	private function _getRowZ () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m31, 'y' => $this->_m32, 'z' => $this->_m33, 'w' => $this->_m34 + 1 ) ) ) ) ) ; }
	private function _getRowW () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m41, 'y' => $this->_m42, 'z' => $this->_m43, 'w' => $this->_m44 + 1 ) ) ) ) ) ; }
	private function _getColX () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m11, 'y' => $this->_m21, 'z' => $this->_m31, 'w' => $this->_m41 + 1 ) ) ) ) ) ; }
	private function _getColY () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m12, 'y' => $this->_m22, 'z' => $this->_m32, 'w' => $this->_m42 + 1 ) ) ) ) ) ; }
	private function _getColZ () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m13, 'y' => $this->_m23, 'z' => $this->_m33, 'w' => $this->_m43 + 1 ) ) ) ) ) ; }
	private function _getColW () { return ( new Vector ( array ( 'dest' => new Vertex ( array ( 'x' => $this->_m14, 'y' => $this->_m24, 'z' => $this->_m34, 'w' => $this->_m44 + 1 ) ) ) ) ) ; }

	public static function doc () {	return ( PHP_EOL . file_get_contents( './' . get_called_class() . '.doc.txt' ) ); }

	public function diagonalSymmetry ( ) {
		$res = clone $this;
		$res->_m11 = $this->_m11;
		$res->_m12 = $this->_m21;
		$res->_m13 = $this->_m31;
		$res->_m14 = $this->_m41;
		$res->_m21 = $this->_m12;
		$res->_m22 = $this->_m22;
		$res->_m23 = $this->_m32;
		$res->_m24 = $this->_m42;
		$res->_m31 = $this->_m13;
		$res->_m32 = $this->_m23;
		$res->_m33 = $this->_m33;
		$res->_m34 = $this->_m43;
		$res->_m41 = $this->_m14;
		$res->_m42 = $this->_m24;
		$res->_m43 = $this->_m34;
		$res->_m44 = $this->_m44;
		return ($res);
	}

	public function mult ( Matrix $rhs ) {
		$res = clone $rhs;
		$res->_m11 = $this->_getRowX()->dotProduct( $rhs->_getColX() ) ;
		$res->_m12 = $this->_getRowX()->dotProduct( $rhs->_getColY() ) ;
		$res->_m13 = $this->_getRowX()->dotProduct( $rhs->_getColZ() ) ;
		$res->_m14 = $this->_getRowX()->dotProduct( $rhs->_getColW() ) ;
		$res->_m21 = $this->_getRowY()->dotProduct( $rhs->_getColX() ) ;
		$res->_m22 = $this->_getRowY()->dotProduct( $rhs->_getColY() ) ;
		$res->_m23 = $this->_getRowY()->dotProduct( $rhs->_getColZ() ) ;
		$res->_m24 = $this->_getRowY()->dotProduct( $rhs->_getColW() ) ;
		$res->_m31 = $this->_getRowZ()->dotProduct( $rhs->_getColX() ) ;
		$res->_m32 = $this->_getRowZ()->dotProduct( $rhs->_getColY() ) ;
		$res->_m33 = $this->_getRowZ()->dotProduct( $rhs->_getColZ() ) ;
		$res->_m34 = $this->_getRowZ()->dotProduct( $rhs->_getColW() ) ;
		$res->_m41 = $this->_getRowW()->dotProduct( $rhs->_getColX() ) ;
		$res->_m42 = $this->_getRowW()->dotProduct( $rhs->_getColY() ) ;
		$res->_m43 = $this->_getRowW()->dotProduct( $rhs->_getColZ() ) ;
		$res->_m44 = $this->_getRowW()->dotProduct( $rhs->_getColW() ) ;
		return ($res);
	}

	public function transformVertex ( Vertex $vtx ) {
		$vect = new Vector ( array ( 'dest' => $vtx, 'orig' => new Vertex ( array ( 'x' => 0, 'y' => 0, 'z' => 0, 'w' => 0 ) ) ) );
		return ( new Vertex ( array (
			'x' => $this->_getRowX()->dotProduct( $vect ),
			'y' => $this->_getRowY()->dotProduct( $vect ),
			'z' => $this->_getRowZ()->dotProduct( $vect ),
			'w' => $this->_getRowW()->dotProduct( $vect ) ) ) );
	}

	public function __construct( array $kwargs ) {

		if ( !array_key_exists( 'preset', $kwargs ) ) {
			if ( self::$verbose )
				echo "Must provide preset argument\n";
			return ;
		}

		if ( $kwargs['preset'] == self::IDENTITY ) {
			$this->_m11 = 1.0;
			$this->_m22 = 1.0;
			$this->_m33 = 1.0;
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix IDENTITY instance constructed' . PHP_EOL );
			return ;
		}
		
		if ( $kwargs['preset'] == self::SCALE) {
			if ( !array_key_exists ( 'scale', $kwargs ) ) {
				if ( self::$verbose )
					print ( 'Mandatory argument \'scale\' missing.' . PHP_EOL );
				return ;
			}
			$this->_m11 = floatval ( $kwargs['scale'] );
			$this->_m22 = floatval ( $kwargs['scale'] );
			$this->_m33 = floatval ( $kwargs['scale'] );
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix SCALE instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( $kwargs['preset'] == self::RX ) {
			if ( !array_key_exists ( 'angle', $kwargs ) ) {
				if ( self::$verbose )
					print ( 'Mandatory argument \'angle\' missing.' . PHP_EOL );
				return ;
			}
			$this->_m11 = 1.0;
			$this->_m22 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m23 = -sin ( floatval ( $kwargs['angle'] ) );
			$this->_m32 = sin ( floatval ( $kwargs['angle'] ) );
			$this->_m33 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix Ox ROTATION preset instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( $kwargs['preset'] == self::RY ) {
			if ( !array_key_exists ( 'angle', $kwargs ) ) {
				if ( self::$verbose )
					print ( 'Mandatory argument \'angle\' missing.' . PHP_EOL );
				return ;
			}
			$this->_m11 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m13 = sin ( floatval ( $kwargs['angle'] ) );
			$this->_m22 = 1.0;
			$this->_m31 = -sin ( floatval ( $kwargs['angle'] ) );
			$this->_m33 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix Oy ROTATION preset instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( $kwargs['preset'] == self::RZ ) {
			if ( !array_key_exists ( 'angle', $kwargs ) ) {
				if ( self::$verbose )
					print ( 'Mandatory argument \'angle\' missing.' . PHP_EOL );
				return ;
			}
			$this->_m11 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m12 = -sin ( floatval ( $kwargs['angle'] ) );
			$this->_m21 = sin ( floatval ( $kwargs['angle'] ) );
			$this->_m22 = cos ( floatval ( $kwargs['angle'] ) );
			$this->_m33 = 1.0;
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix Oy ROTATION preset instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( $kwargs['preset'] == self::TRANSLATION ) {
			if ( !array_key_exists ( 'vtc', $kwargs )
				|| !is_a ( $kwargs['vtc'], 'Vector' ) ) {
					if ( self::$verbose )
						print ( 'Mandatory argument \'Vector\' of class Vector missing.' . PHP_EOL );
					return ;
				}
			$this->_m11 = 1.0;
			$this->_m22 = 1.0;
			$this->_m33 = 1.0;
			$this->_m14 = $kwargs['vtc']->getX();
			$this->_m24 = $kwargs['vtc']->getY();
			$this->_m34 = $kwargs['vtc']->getZ();
			$this->_m44 = 1.0;
			if ( self::$verbose )
				print ( 'Matrix TRANSLATION preset instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( $kwargs['preset'] == self::PROJECTION ) {
			if ( !array_key_exists ( 'fov', $kwargs )
				|| !array_key_exists ( 'ratio', $kwargs )
				|| !array_key_exists ( 'near', $kwargs )
				|| !array_key_exists ( 'far', $kwargs ) ) {
					if ( self::$verbose )
						print ( 'Mandatory arguments: \'fov\', \'ratio\', \'near\', \'far\'.' . PHP_EOL );
					return ;
				}
			$n = $kwargs['near'];
			$f = $kwargs['far'];
			$scale = $n * tan ( $kwargs['fov'] * pi() / 180 * 0.5 );
			$r = $kwargs['ratio'] * $scale;
			$l = - $r;
			$t = $scale;
			$b = - $t;

			$this->_m11 = 2 * $n / ( $r - $l );
			$this->_m22 = 2 * $n / ( $t - $b );
			$this->_m13 = ( $r + $l ) / ( $r - $l );
			$this->_m23 = ( $t + $b ) / ( $t - $b );
			$this->_m33 = - ( $f + $n ) / ( $f - $n );
			$this->_m43 = -1.0;
			$this->_m34 = -2 * $f * $n  / ( $f - $n );
			if ( self::$verbose )
				print ( 'Matrix PROJECTION preset instance constructed' . PHP_EOL );
			return ;
		} 	

		if ( self::$verbose )
			echo "Unknown preset\n";
	}

	public function __destruct () {
		if ( self::$verbose )
			print ( 'Matrix instance destructed' . PHP_EOL );
	}

	public function __toString () {
			return ( sprintf ( 'M | vtcX | vtcY | vtcZ | vtxO' . PHP_EOL
			. '-----------------------------' . PHP_EOL
			. 'x | %1.2f | %1.2f | %1.2f | %1.2f' . PHP_EOL
			. 'y | %1.2f | %1.2f | %1.2f | %1.2f' . PHP_EOL
			. 'z | %1.2f | %1.2f | %1.2f | %1.2f' . PHP_EOL
			. 'w | %1.2f | %1.2f | %1.2f | %1.2f' . PHP_EOL,
			$this->_m11, $this->_m12, $this->_m13, $this->_m14,
			$this->_m21, $this->_m22, $this->_m23, $this->_m24,
			$this->_m31, $this->_m32, $this->_m33, $this->_m34,
			$this->_m41, $this->_m42, $this->_m43, $this->_m44 ) );
	}
}

?>
