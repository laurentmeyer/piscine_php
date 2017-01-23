<?php

date_default_timezone_set('UTC');
ini_set('display_errors', 1);

require_once 'Battleship.class.php';
require_once 'Player.class.php';
require_once 'Db.class.php';
require_once 'User.class.php';

class Board
{
    const LINES = 100;
    const COLUMNS = 150;

    public static $verbose = false;

    private $_players = array();
    private $_obstacles = array();
    private $_currentTurn;
    private $_lastTeam;
    private $_lastPlayer = array();
    private $_dead = array();
    private $_currentActivation;

    public function whoseTurn()
    {
        $stillpossible = false;
        //Check all players =>
        foreach ($this->_getPlayers() as $player) {
            if ($player->getState() == "DEAD") {
                $key = array_search($player, $this->_getPlayers(), TRUE);
                array_push($this->_dead, $player);
                unset($this->_players[$key]);
            }
        }
        
        if (sizeof($this->_getPlayers()) == 1) {
            foreach ($this->_players as $player) {
                echo $player->getPlayerName();
                $this->endgame($player);   
            }
            return "OVER";//array('Status' => 'gameover', 'winner' => $this->_getPlayers()[0]);   
        }
        else if (sizeof($this->_getPlayers()) == 2 && $this->_getPlayers()[0]->getTeam() == $this->_getPlayers()[1]->getTeam()) {
            foreach ($this->_players as $player) {
                echo $player->getPlayerName();
                $this->endgame($player);
            }
            return "OVER";// . sizeof($this->_getPlayers());   
        }

        foreach($this->_getPlayers() as $player) {
            if ($player->getState == "CANTPLAY" && array_search($player, $this->_lastPlayer, TRUE) == FALSE) {
                array_push($this->_lastPlayer, $player);
            }
            if (sizeof($this->_lastPlayer) == sizeof($this->_players)) {
                $this->_newTurn();
                $this->_lastPlayers = array();
            }
        }
        
        foreach($this->_getPlayers() as $player) {
            if (sizeof($this->_lastPlayer) == sizeof($this->_players)) {
                $this->_lastPlayer = array();
            }
            if ($player->getState() == "CANPLAY" && in_array($player, $this->_lastPlayer, TRUE) == false) {
                array_push($this->_lastPlayer, $player);
                return $player;
            }
        }
        return "OVER";
    }
    
    private function endgame($winner){
        foreach($this->_dead as $dead) {
            if ($winner->getTeam() != $dead->getTeam()) {
                $user1 = new User(array('login' => $winner->getPlayerName(), 'passwd' => 'notsecureatall'));
                $user2 = new User(array('login' => $dead->getPlayerName(), 'passwd' => 'notsecureatall'));
                $user1->get_User();
                $user2->get_User();
                //echo $user2;
                //echo $user1;
                Db::elo($user1, $user2, 1, 0);
            }
        }
        return ;
    }
    
    private function _newTurn () {
        foreach ( $this->_players as $player) {
            $player->setState( "CANPLAY");
            foreach ( $player->getBattleships() as $bs ) {
                $bs->setActivated(false);
            }
            
        }
    }
    
    public function setActivation(Activation $activation)
    {
        $this->_currentActivation = $activation;
    }

    public function getActivation()
    {
        return  $this->_currentActivation;
    }

    private function _current_board()
    {
        $allelements = array();
        $board = array();

        foreach ($this->_obstacles as $index => $obstacle) {
            if (!empty($obstacle)) {
                $allelements[] = $obstacle;
            }
        }

        foreach ($this->_players as $playerindex => $player) {
            foreach ($player->getBattleships() as $index => $ship) {
                $allelements[] = $ship;
            }
        }

        foreach ($allelements as $piece) {
            foreach ($piece->current_position() as $linenumber => $linearray) {
                foreach ($linearray as $colnumber => $colcontent) {
                    $board[$linenumber][$colnumber] = $piece;
                }
            }
        }

        return  $board;
    }

    public function get_board_state()
    {
        $ret = array();
        $objects = $this->_current_board();

        foreach ($objects as $linenumber => $linecontent) {
            foreach ($linecontent as $colnumber => $object) {
                if (is_a($object, 'Battleship')) {
                    $ret[$linenumber][$colnumber]['piece'] = 'battleship';
                    $ret[$linenumber][$colnumber]['player'] = $object->getPlayer()->getPlayerName();
                } elseif (is_a($object, 'Obstacle')) {
                    $ret[$linenumber][$colnumber]['piece'] = 'obstacle';
                }
            }
        }

        return  $ret;
    }

    private function _current_board_except(Battleship $bs)
    {
        $allbutone = array();
        $board = array();

        foreach ($this->_obstacles as $index => $obstacle) {
            if (!empty($obstacle)) {
                $allbutone[] = $obstacle;
            }
        }

        foreach ($this->_players as $playerindex => $player) {
            foreach ($player->getBattleships() as $index => $ship) {
                if (!empty($ship) && $ship !== $bs) {
                    $allbutone[] = $ship;
                }
            }
        }

        foreach ($allbutone as $piece) {
            foreach ($piece->current_position() as $linenumber => $linearray) {
                foreach ($linearray as $colnumber => $colcontent) {
                    $board[$linenumber][$colnumber] = $piece;
                }
            }
        }

        return  $board;
    }

    public function attribute_player(Player $player)
    {
        $this->_players[] = $player;
        $player->setBoard($this);
    }

    public function attribute_obstacle(Obstacle $obstacle)
    {
        $this->_obstacles[] = $obstacle;
    }

    public function try_move(Battleship $bs, array $newpos)
    {
        $board = $this->_current_board_except($bs);
        $destroyed = false;
        $collisions = array();
        $return = Battleship::MOVE;

        foreach ($newpos as $linenumber => $linecontent) {
            foreach ($linecontent as $colnumber => $colcontent) {
                if ($linenumber >= self::LINES || $linenumber < 0
                        || $colnumber >= self::COLUMNS || $colnumber < 0) {
                    $destroyed = true;
                }
                if (array_key_exists($linenumber, $board)
                        && array_key_exists($colnumber, $board[$linenumber])) {
                    if (is_a(($elt = $board[$linenumber][$colnumber]), 'Obstacle')) {
                        $destroyed = true;
                    }
                    if (is_a(($elt = $board[$linenumber][$colnumber]), 'Battleship')
                            && !in_array($elt, $collisions)) {
                        $collisions[] = $elt;
                    }
                }
            }
        }

        if ($destroyed) {
            $return = Battleship::DESTRUCTION;
        }

        if (!empty($collisions)) {
            if ($destroyed == false) {
                $collisions[] = $bs;
            }

            //gerer les collisions sur chaque vaisseau

            if ($destroyed == false) {
                $return = Battleship::COLLISION;
            }
        }

        if ($destroyed == false && empty($collisions)) {
            //print ( ' LE MOUVEMENT EST ACCEPTE ' . PHP_EOL );
        }

        return  $return;
    }

    private function _getPlayers()
    {
        return  $this->_players;
    }
    
    private function _setPlayers($players)
    {
        $this->_players = $players;
    }

    private function active_ships()
    {
        $ret = array();
        foreach ($this->_getPlayers() as $player) {
            foreach ($player->getBattleships() as $bs) {
                $ret[] = $bs;
            }
        }
        // var_dump( $ret );
        return  $ret;
    }

    public function arrayify()
    {
        $myPlayers = array();
        $myObstacles = array();

        foreach ($this->_players as $player) {
            $myPlayers[] = $player->arrayify();
        }

        foreach ($this->_obstacles as $obs) {
            $myObstacles[] = $obs->arrayify();
        }

        return  array(
            'currentAtivation' => $this->_currentActivation,
            'players' => $myPlayers,
            'obstacles' => $myObstacles, );
    }

    public function __construct($kwargs)
    {
        $this->_players = $kwargs['players'];
        $this->_obstacles = $kwargs['obstacles'];
        if (self::$verbose) {
            print  'New board created with '.count($this->_players).' players.'.PHP_EOL;
        }
    }

    public static function doc()
    {
        echo file_get_contents('Board.doc.txt');
    }
}
