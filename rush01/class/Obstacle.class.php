<?php

ini_set('display_errors', 1);

class Obstacle extends Piece
{
    public static $verbose;

    public function arrayify()
    {
        return  array(
            'originX' => $this->_originx,
            'originY' => $this->_originY,
            'v_squares' => $this->_vertical,
            'h_squares' => $this->_horizontal, );
    }

    public function __construct(array $kwargs)
    {
        $this->_horizontal = $kwargs['horizontal'];
        $this->_vertical = $kwargs['vertical'];
        $this->_originx = $kwargs['originx'];
        $this->_originy = $kwargs['originy'];
        if (self::$verbose) {
            print  $this;
        }
    }

    public static function doc()
    {
        echo file_get_contents('Obstacle.doc.txt');
    }
}
