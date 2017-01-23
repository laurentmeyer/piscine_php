<?php

ini_set('display_errors', 1);

abstract class Piece
{
    const BUSY = 1;

    protected $_vertical;
    protected $_horizontal;
    protected $_originx;
    protected $_originy;

    protected function _getOriginX()
    {
        return  $this->_originx;
    }

    protected function _getOriginY()
    {
        return  $this->_originy;
    }

    protected function _getHorizontal()
    {
        return  $this->_horizontal;
    }

    protected function _getVertical()
    {
        return  $this->_vertical;
    }

    protected function _setOriginX($originx)
    {
        $this->_originx = $originx;
    }

    protected function _setOriginY($originy)
    {
        $this->_originy = $originy;
    }

    protected function _setHorizontal($horizontal)
    {
        $this->_horizontal = $horizontal;
    }

    protected function _setVertical($vertical)
    {
        $this->_vertical = $vertical;
    }

    protected function which_squares($x, $y, $h, $v)
    {
        $array = array();
        foreach (range($x, $x + $v - 1) as $line) {
            foreach (range($y, $y + $h - 1) as $col) {
                $array[$line][$col] = self::BUSY;
            }
        }

        return  $array;
    }

    public function current_position()
    {
        return
                $this->which_squares(
                    $this->_getOriginX(),
                    $this->_getOriginY(),
                    $this->_getHorizontal(),
                    $this->_getVertical());
    }

    public function __toString()
    {
        print_r($this->current_position());

        return  '';
    }

    public static function doc()
    {
        echo file_get_contents('Piece.doc.txt');
    }
}
