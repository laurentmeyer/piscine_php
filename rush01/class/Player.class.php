<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

class Player
{
    public static $verbose = false;

    private $_board;
    private $_playerName;
    private $_team;
    private $_faction;
    private $_battleships = array();
    
    private $_state = "CANPLAY";

    public function attribute_battleship(Battleship $bs)
    {
        $this->_battleships[] = $bs;
        $bs->setPlayer($this);
    }

    public function setBoard(Board $board)
    {
        $this->_board = $board;
    }
    
    public function setTeam($nb)
    {
        $this->_team = $nb;
    }
    
    public function getTeam()
    {
        return $this->_team;
    }
    
    public function getState()
    {
        return $this->_state;
    }
    
    public function setState($state)
    {
        $this->_state = $state;
    }
    
    public function setFleet(array $fleet)
    {
        $this->_battleships = $fleet;
    }
    
    public function getBoard()
    {
        return  $this->_board;
    }

    public function getPlayername()
    {
        return  $this->_playerName;
    }

    public function getBattleships()
    {
        return  $this->_battleships;
    }
    
    public function getUnactivatedBattleships()
    {
        $ret = array ();
        foreach ($this->getBattleships() as $bs) {
            if ($bs->getActivation() ){
                $ret[] = $bs;
            }
        }
        $this->setState(empty ($ret) ? "CANTPLAY" : "CANPLAY");
        return ($ret) ;
    }

    public function destroyBattleship(Battleship $bs)
    {
        foreach ($this->_battleships as $index => $ship) {
            if ($ship === $bs) {
                unset($index);
            }
        }
    }

    public function arrayify()
    {
        $myBattleships = array();

        foreach ($this->_battleships as $bs) {
            $myBattleships[] = $bs->arrayify();
        }

        return  array(
            'playerName' => $this->_playerName,
            'team' => $this->_team,
            'faction' => $this->_faction,
            'battleships' => $myBattleships, );
    }

    public function __construct(array $kwargs)
    {
        $this->_playerName = $kwargs['name'];
        $this->_team = $kwargs['team'];
        $this->_faction = $kwargs['faction'];
        if (self::$verbose) {
            print  'Player '.$this->_playerName.' constructed.'.PHP_EOL;
        }

        return;
    }

    public static function doc()
    {
        echo file_get_contents('Player.doc.txt');
    }
}
