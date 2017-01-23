<?php

session_start();
header('Content-Type: application/json');

require_once($_SERVER['DOCUMENT_ROOT'].'/class/Presets.class.php');
$foldername = $_SERVER['DOCUMENT_ROOT'].'/data/';
$filename = $foldername.'lobbyt.zob';

if (!file_exists($filename)) {
    if (!file_exists($foldername)) {
        mkdir($foldername);
    }
    $lobbies_array = [];
} else {
    $str = file_get_contents($filename);
    $lobbies_array = unserialize($str);
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (empty($lobbies_array)) {
        echo json_encode(array('status' => 'KO', 'Message' => 'No lobbies yet'), JSON_FORCE_OBJECT);

        return;
    } else {
        echo json_encode($lobbies_array, JSON_FORCE_OBJECT);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'create') {
        if ($_POST['type'] == 'TEAM' && $_POST['max_players'] != 4) {
            echo json_encode(array('status' => 'KO', 'Message' => 'FFA must have 4 players'), JSON_FORCE_OBJECT);

            return;
        } else {
            $id = rand(0, 10000);
            while (array_key_exists($id, $lobbies_array)) {
                $id = rand(0, 10000);
            }
            $lobbies_array[$id] = array('type' => $_POST['type'],
                                'status' => 'pending',
                                'size' => $_POST['size'],
                                'players_ready' => array(),
                                'max_players' => $_POST['max_players'],
                                'players' => array(array('login' => $_SESSION['user'],
                                                    'faction' => $_POST['faction'] ) ) );
            $lobby = $id;
            $_SESSION['lobby'] = $id;
            $_SESSION['game'] = $id;
        }
    } elseif ($_POST['action'] == 'join') {
        if ($lobbies_array[$_POST['lobby']]['status'] == 'ready') {
            echo json_encode(array('status' => 'KO', 'Message' => 'Lobby is full'), JSON_FORCE_OBJECT);

            return;
        }
        if (in_array($_SESSION['user'], $lobbies_array[$_POST['lobby']]['players'])) {
            echo json_encode(array('status' => 'KO', 'Message' => 'Player already in lobby'), JSON_FORCE_OBJECT);

            return;
        }

        array_push($lobbies_array[$_POST['lobby']]['players'],
                                    array('login' => $_SESSION['user'],
                                           'faction' => $_POST['faction'], ));
         $_SESSION['lobby'] = $_POST['lobby'];
         $_SESSION['game'] = $_POST['lobby'];
        if (count($lobbies_array[$_POST['lobby']]['players']) == $lobbies_array[$_POST['lobby']]['max_players']) {
            $lobbies_array[$_POST['lobby']]['status'] = 'ready';
        }
    }
    
    elseif ($_POST['action'] == 'ready')
    {
        $lobby = $_SESSION['lobby'];
        $user = $_SESSION['user'];
        $_SESSION['ready'] = 'ready';
        
            array_push($lobbies_array[$lobby]['players_ready'], $user);
            foreach ($lobbies_array[$lobby]['players'] as &$players) {
                if ($players['login'] == $user) {
                    $players['fleet'] = $_POST['fleet'];
                }
            }
    }
    
    elseif ($_POST['action'] == 'delete')
    {
        $lobby = $_POST['lobby'];
        unset ($_SESSION['ready']);
        unset ($_SESSION['lobby']);
        if ( array_key_exists ( $lobby, $lobbies_array )) {
            echo json_encode($lobbies_array[$lobby], JSON_FORCE_OBJECT);
            //$lobbies_array[$lobby] = null;
            //$lobbies_array=  array_filter($lobbies_array);
            $lobbies_array['shipyard'] = unserialize($_SERVER['DOCUMENT_ROOT'].'/data/shipyard');
            $presets = new Presets($lobbies_array);
            $str = serialize($presets->getBoard());
            file_put_contents($foldername.'games/'.$lobby, $str);
            unset ($lobbies_array[$lobby]) ;
        }
    $str = serialize($lobbies_array);
    if (file_put_contents($filename, $str)) {
            echo json_encode($lobbies_array, JSON_FORCE_OBJECT);
    } else {
        echo json_encode(array('status' => 'KO', 'Message' => 'Error saving file'), JSON_FORCE_OBJECT);
    }

    return;
    }

    $lobbies_array['current_user'] = $_SESSION['user'];
    $lobbies_array['current_lobby'] = $_SESSION['lobby'];
    $str = serialize($lobbies_array);
    if (file_put_contents($filename, $str)) {
            echo json_encode($lobbies_array, JSON_FORCE_OBJECT);
    } else {
        echo json_encode(array('status' => 'KO', 'Message' => 'Error saving file'), JSON_FORCE_OBJECT);
    }

    return;
}
