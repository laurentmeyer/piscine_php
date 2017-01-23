<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/class/Player.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/class/Fleet.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/class/Board.class.php');
require_once ($_SERVER['DOCUMENT_ROOT'].'/class/Obstacle.class.php');

Class Presets{
    
    public static $verbose = False;
    private $_players = array();
    private $_fleet_size;
    private $_max_players;
    private $_fleetBuilder;
    private $_board;
    
    function __construct(array $kwargs)
    {
        $this->_fleetBuilder = $kwargs['fb'];
        $FB = $this->_fleetBuilder;
        $this->_max_players = $kwargs['max_players'];
        $this->_players = $kwargs['players'];
        foreach ($this->_players as $key => $p)
        {
            $faction = ($p['faction'] == 'SPM') ? "Space Marine":($p['faction'] == 'ORK') ? "Ork": "Eldar";
            if ($kwargs['type'] == 'FFA')
                $this->_players[] = new Player(array('name' => $p['login'], 'team' => ($key + 1), 'faction' => $faction));
            else
                $this->_players[] = new Player(array('name' => $p['login'], 'team' => (($key % 2) + 1), 'faction' => $faction));
            $tmp = $this->_players[$key];
            $tmp->setFleet($FB->makeDaFleetGreatAgain($kwargs['size'].$p['fleet'], $faction));
            $this->_initiateFleetPosion($key);
        }
        $this->_board = new Board(array(
            'obstacles' => array(new Obstacle ( array ( 'horizontal' => 2, 'vertical' => 8, 'originx' => 40, 'originy' => 5 )),
                                new Obstacle ( array ( 'horizontal' => 5, 'vertical' => 4, 'originx' => 40, 'originy' => 140 )),
                                new Obstacle ( array ( 'horizontal' => 7, 'vertical' => 10, 'originx' => 30, 'originy' => 70 ))),
            'players' => $this->_players));
    }
     
    private function _initiateFleetPosition($key)
    {
        $x = 2;
        $y = 2;
        foreach ($this->_players[$key] as $player)
        {
            foreach($player->getBattleships() as $ship)
            {
                $ship->initiatePosition(array(
                    'X' => $x + (120 * ($key / 2)),
                    'Y' => $y + (80 * ($key % 2)),
                    'direction' => (($key % 2) == 1) ? 'W':'E'
                    ));
                $x += 4;
                $y += 6;
            }
        }
    }
    function getBoard()
    {
        return $this->_board;
    }
    
    public static function doc() {
        echo file_get_contents("Presets.doc.txt");
    }
}
?>