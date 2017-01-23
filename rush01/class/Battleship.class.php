<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

require_once 'Piece.class.php';
require_once 'Board.class.php';
require_once 'Weapon.class.php';

class Battleship extends Piece
{
    const MOVE = 1;
    const DESTRUCTION = 0;
    const COLLISION = -1;

    public static $verbose = false;

	private $_name;
    private $_player;
    private $_activated = false;
    private $_direction;
    private $_pp;
    private $_hp;
    private $_speed;
    private $_manoeuvre;
    private $_shield = 0;
    private $_weapons = array();
    private $_idle = true;

    public function getPlayer()
    {
        return  $this->_player;
    }

    private function _getActivated()
    {
        return  $this->_activated;
    }
    public function setActivated( $a )
    {
        $this->_activated = $a;
    }

    public function getPp()
    {
        return  $this->_pp;
    }

    public function getSpeed()
    {
        return  $this->_speed;
    }
	public function getName()
	{
		return $this->_name;
	}
    public function getManoeuvre()
    {
        return  $this->_manoeuvre;
    }

    public function getShield()
    {
        return  $this->_shield;
    }

    public function getWeapons()
    {
        return  $this->_weapons;
    }

    public function getIdle()
    {
        return  $this->_idle;
    }

    public function setPlayer(Player $player)
    {
        $this->_player = $player;
    }

    private function _setDirection($direction)
    {
        $this->_direction = $direction;
    }

    private function _destroy()
    {
        $this->_player->destroyBattleship($this);
    }

    public function move_ahead()
    {
        $down_offset = 0;
        $right_offset = 0;

        $down_offset += ($this->_direction == 'N');
        $down_offset -= ($this->_direction == 'S');
        $right_offset += ($this->_direction == 'E');
        $right_offset -= ($this->_direction == 'W');

        $new_position = $this->which_squares(
                $this->_getOriginX() - $down_offset,
                $this->_getOriginY() + $right_offset,
                $this->_getHorizontal(),
                $this->_getVertical());

        $accepted = $this->getPlayer()->getBoard()->try_move($this, $new_position);
        if ($accepted == self::MOVE) {
            $this->_setOriginX($this->_getOriginX() - $down_offset);
            $this->_setOriginY($this->_getOriginY() + $right_offset);
        }

        if (self::$verbose) {
            if ($accepted == self::MOVE) {
                echo  'Ship moves straight ahead'.PHP_EOL;
            }
            if ($accepted == self::DESTRUCTION) {
                echo  'Ship is destructed'.PHP_EOL;
            }
            if ($accepted == self::COLLISION) {
                echo  'Ship collides with another one, does not move and is damaged'.PHP_EOL;
            }
        }
    }

    public function rotate($direction)
    {
        $is_horizontal = $this->_getHorizontal() > $this->_getVertical();
        $pivotlenght = abs(($this->_getHorizontal() - $this->_getVertical()) / 2);

        if ($is_horizontal) {
            $newOriginx = $this->_getOriginX() - $pivotlenght;
            $newOriginy = $this->_getOriginY() + $pivotlenght;
        } else {
            $newOriginx = $this->_getOriginX() + $pivotlenght;
            $newOriginy = $this->_getOriginY() - $pivotlenght;
        }

        $new_position = $this->which_squares(
                $newOriginx,
                $newOriginy,
                $this->_getVertical(),
                $this->_getHorizontal());

        $accepted = $this->getPlayer()->getBoard()->try_move($this, $new_position);
        if ($accepted == self::MOVE) {
            $this->_setOriginX($newOriginx);
            $this->_setOriginY($newOriginy);
            $tmp = $this->_getVertical();
            $this->_setVertical($this->_getHorizontal());
            $this->_setHorizontal($tmp);

            if (($this->_getDirection() == 'N' && $direction == 'right')
                    || ($this->_getDirection() == 'S' && $direction == 'left')) {
                $this->_setDirection('E');
            } elseif (($this->_getDirection() == 'E' && $direction == 'right')
                    || ($this->_getDirection() == 'W' && $direction == 'left')) {
                $this->_setDirection('S');
            } elseif (($this->_getDirection() == 'S' && $direction == 'right')
                    || ($this->_getDirection() == 'N' && $direction == 'left')) {
                $this->_setDirection('W');
            } elseif (($this->_getDirection() == 'W' && $direction == 'right')
                    || ($this->_getDirection() == 'E' && $direction == 'left')) {
                $this->_setDirection('N');
            }
        } elseif ($accepted == self::DESTRUCTION) {
            $this->_destroy();
        }

        if (self::$verbose) {
            if ($accepted == self::MOVE) {
                echo  'Ship moves straight ahead'.PHP_EOL;
            }
            if ($accepted == self::DESTRUCTION) {
                echo  'Ship is destructed'.PHP_EOL;
            }
            if ($accepted == self::COLLISION) {
                echo  'Ship collides with another one, does not move and is damaged'.PHP_EOL;
            }
        }
    }

    public function arrayify()
    {
        $weapons = array();

        foreach ($this->_weapons as $weapon) {
            $weapons[] = $weapon->arrayify();
        }

        return  array(
            'activated' => $this->_activated,
            'originX' => $this->_originx,
            'originY' => $this->_originY,
            'v_squares' => $this->_vertical,
            'h_squares' => $this->_horizontal,
            'direction' => $this->_direction,
            'name' => $this->_name,
            'pp' => $this->_pp,
            'hp' => $this->_hp,
            'speed' => $this->_speed,
            'manoeuvre' => $this->_manoeuvre,
            'shield' => $this->_shield,
            'idle' => $this->_idle,
            'weapons' => $weapons, );
    }

	public function initiatePosition(array $kwargs)
	{
		$this->_direction = $kwargs['direction'];
		$this->originX = $kwargs['X'];
		$this->originY = $kwargs['Y'];
	}
	
    public function __construct(array $kwargs)
    {
    	$this->_name = $kwargs['name'];
        $this->_weapons = $kwargs['weapons'];
        $this->_horizontal = $kwargs['horizontal'];
        $this->_vertical = $kwargs['vertical'];
        $this->_pp = $kwargs['pp'];
        $this->_hp = $kwargs['hp'];
        $this->_speed = $kwargs['speed'];
        $this->_manoeuvre = $kwargs['manoeuvre'];
        if (self::$verbose) {
            echo  $this;
        }
    }

    public static function doc()
    {
        echo file_get_contents('Battleship.doc.txt');
    }
}
