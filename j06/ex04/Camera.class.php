<?php

require_once 'Color.class.php';
require_once 'Vertex.class.php';
require_once 'Vector.class.php';
require_once 'Matrix.class.php';

ini_set('display_errors', 1);

class Camera {

	public static $verbose = False;

	private $_Origine;
	private $_tT;
	private $_tR;
	private $_viewMatrix;
	private $_Proj;

	public static function doc () {	return ( PHP_EOL . file_get_contents( './' . get_called_class() . '.doc.txt' ) ); }

	public function watchVertex( Vertex $worldVertex ) {
		$tmp = new Vector ( array ( 'dest' => $this->_Proj->mult( $worldVertex ) ) ) ;
		return ( new Vertex ( array ( 'x' => intval(2 * $tmp->getX() - 1), 'y' => intval(2 * $tmp->getY() - 1), 'z' => 0 ) ) );
	}

	public function __construct( array $kwargs ) {

		if ( ( !( array_key_exists( 'origin', $kwargs )
			&& array_key_exists( 'orientation', $kwargs )
			&& array_key_exists( 'fov', $kwargs )
			&& array_key_exists( 'near', $kwargs )
			&& array_key_exists( 'far', $kwargs ) )

			|| !( array_key_exists( 'origin', $kwargs )
			&& array_key_exists( 'orientation', $kwargs )
			&& array_key_exists( 'width', $kwargs )
			&& array_key_exists( 'height', $kwargs )
			&& array_key_exists( 'fov', $kwargs )
			&& array_key_exists( 'near', $kwargs )
			&& array_key_exists( 'far', $kwargs ) ) )

			|| ( array_key_exists( 'width', $kwargs )
			&& array_key_exists( 'ratio', $kwargs ) ) )
		{
			if ( self::$verbose )
				echo "Must provide arguments with eithe ratio or width and heigth\n";
			return ;
		}

		$this->_Origine = $kwargs['origin'];
		$init = new Vector ( array ( 'dest' => $this->_Origine ) );
		$this->_tT = new Matrix ( array ( 'preset' => Matrix::TRANSLATION , 'vtc' => $init->opposite() ) );
		$this->_tR = $kwargs['orientation']->diagonalSymmetry();
		$this->_viewMatrix = $this->_tR->mult( $this->_tT );
		$ratio = array_key_exists( 'ratio', $kwargs ) ? $kwargs['origin']
			: $kwargs['width'] / $kwargs['height'];
		$this->_Proj = new Matrix ( array ( 'preset' => Matrix::PROJECTION ,
			'fov' => $kwargs['fov'],
			'ratio' => $ratio,
			'near' => $kwargs['near'],
			'far' => $kwargs['far']	) );
		if ( self::$verbose )
			print ( 'Camera instance constructed' . PHP_EOL );
	}

	public function __destruct () {
		if ( self::$verbose )
			print ( 'Camera instance destructed' . PHP_EOL );
	}

	public function __toString () {
		if ( self::$verbose )
		{
			return ('Camera(' . PHP_EOL
				. '+ _Origine:' . PHP_EOL
				. $this->_Origine . PHP_EOL
				. '+ _tT: ' . PHP_EOL
				. $this->_tT . PHP_EOL
				. '+ _tR:' . PHP_EOL
				. $this->_tR . PHP_EOL
				. '+ _tR->mult( _tT ):' . PHP_EOL
				. $this->_viewMatrix . PHP_EOL
				. '+ _Proj:' . PHP_EOL
				. $this->_Proj . PHP_EOL . ')' ) ;
		}
	}
}

?>
