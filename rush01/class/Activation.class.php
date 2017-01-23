<?php

ini_set('display_errors', 1);

class Activation
{
    const ORDER = 'order';
    const MOVEMENT = 'movement';
    const FIRE = 'fire';
    const AHEAD = 'ahead';
    const TURNLEFT = 'left';
    const TURNRIGHT = 'right';
    const STOP = 'stop';

    private $_phase;
    private $_battleship;
    private $_potential;
    private $_totalShield;
    private $_weaponDices = array();
    private $_inertia;
    private $_moved = 0;
    private $_last_pivot = 0;
    private $_repairDices;

    private function _getPhase()
    {
        return  $this->_phase;
    }

    public function getBattleship()
    {
        return  $this->_battleship;
    }

    private function _getPotential()
    {
        return  $this->_potential;
    }

    public function attribute_pp($speedPts, $shieldsPts, array $weaponsPts, $repairPts)
    {
        $sum = $speedPts + $shieldsPts + $repairPts;
        foreach ($weaponsPts as $pts) {
            $sum += $pts;
        }

        if ($sum > $this->_battleship->getPp()
            || ($repairPts != 0 && $this->_battleship->getIdle() == false)) {
            return 'KO';
        } else {
            $this->_potential += $speedPts;
            $this->_totalShield += $shieldPts;
            $this->_repairDices += $repairPts;
            foreach ($weaponPts as $index => $points) {
                  $this->_weaponDices[$index]['dices'] += $points;
            }
            $this->_phase = self::MOVEMENT;

            return 'OK';
        }
    }

    public function listPossibleActions()
    {
        if ($this->_getPhase() == self::ORDER) {
            $return = array();
            $options = array();

            $return['phase'] = 'order';
            $return['pp'] = $this->_battleship->getPp();
            $options['speed'] = 0;
            $options['shield'] = 0;
            if ($this->_battleship->getIdle() == true) {
                $options['repair'] = 0;
            }
            foreach ( $this->_weaponDices as $index => $weapon ) {
            	$options['weapons'][$index] = $weapon['name'];
            }
            $return['options'] = $options;

            return  $return;
        } elseif ($this->_getPhase() == self::MOVE) {
            $options = array();

            if ($this->_inertia > 0) {
                $options['options'] = array(self::AHEAD);

                return  $options;
            } elseif ($_last_pivot < $this->_battleship->getManoeuvre()) {
                $options['options'] = array(self::AHEAD, self::STOP);
            } else {
                $options['options'] = array(self::AHEAD, self::STOP, self::TURNLEFT, self::TURNRIGHT);
            }

            return  $return;
        } elseif ($this->_getPhase() == self::FIRE) {
            $options = array();

            foreach ( $this->_weaponDices as $index => $weapon ) {
                $this->_battleShip->getWeapons()[$index]->generateShot( $weapon['dices'] );
            }
        }
    }

    public function endActivation()
    {
        // renvoyer si le vaisseau sera Idle ou pas
        // passer la main a l'objet Tour
    }

    public function __construct(Battleship $bs)
    {
        $this->_phase = self::ORDER;
        $this->_battleship = $bs;
        $this->_potential = $bs->getSpeed();
        $this->_inertia = $bs->getIdle() ? 0 : $bs->getManoeuvre();
        $this->_totalshield = $bs->getShield();
        $this->_repairDices = 0;
        foreach ($bs->getWeapons() as $index => $weapon) {
            $this->_weaponDices[$index] = array ( 'name' => $name, 'dices' => 0 );
        }
    }

    public static function doc()
    {
        echo file_get_contents('Activation.doc.txt');
    }
}
