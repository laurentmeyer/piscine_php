<?php

require_once 'User.class.php';
class Db
{
    private static $name = 'db_warhammer';
    private static $user = 'root';
    private static $pass = 'root';
    private static $addr = 'codinglab.io';
    private static $port = '3306';

    public static function co()
    {
        try {
            $pdo = new PDO('mysql:host='.self::$addr.':'.self::$port.';dbname='.self::$name.';charset=utf8', self::$user, self::$pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Erreur !: '.$e->getMessage();
            die();
        }

        return $pdo;
    }

    public static function elo(User $user1, User $user2, $r1, $r2)
    {
        $k1 = 10;
        $k2 = 10;
        $p1 = 1 / (1 + (pow(10, ($user2->get('_elo') - $user1->get('_elo')) / 400)));
        $p2 = 1 / (1 + (pow(10, ($user1->get('_elo') - $user2->get('_elo')) / 400)));

        if ($user1->get('_playtotal') <= 30) {
            $k1 = 40;
        } elseif ($user1->get('_elo') < 2400) {
            $k1 = 20;
        }

        if ($user2->get('_playtotal') <= 30) {
            $k2 = 40;
        } elseif ($user2->get('_elo') < 2400) {
            $k2 = 20;
        }

        $newelo1 = round($user1->get('_elo') + $k1 * ($r1 - $p1), 0);
        $newelo2 = round($user2->get('_elo') + $k2 * ($r2 - $p2), 0);
        if ($r1 == 1) {
            $query = 'UPDATE t_user SET play_total = play_total + 1, play_win = play_win + 1, elo = '.$newelo1.' WHERE id_user = '.$user1->get('_id').'';
        } else {
            $query = 'UPDATE t_user SET play_total = play_total + 1, play_lost = play_lost + 1, elo = '.$newelo1.' WHERE id_user = '.$user1->get('_id').'';
        }
        $db = self::co();
        $db->query($query);
        if ($r2 == 1) {
            $query = 'UPDATE t_user SET play_total = play_total + 1, play_win = play_win + 1, elo = '.$newelo2.' WHERE id_user = '.$user2->get('_id').'';
        } else {
            $query = 'UPDATE t_user SET play_total = play_total + 1, play_lost = play_lost + 1, elo = '.$newelo2.' WHERE id_user = '.$user2->get('_id').'';
        }
        self::co()->query($query);
    }

    public static function getClassement()
    {
        $db = self::co();
        $arr = array();
        $query = 'SELECT login, play_total, play_lost, play_win, elo FROM t_user ORDER BY elo DESC';
        $answer = $db->query($query);
        while ($row = $answer->fetch()) {
            array_push($arr, $row['login'].'|'.$row['play_total'].'|'.$row['play_win'].'|'.$row['play_lost'].'|'.$row['elo']);
        }
        return $arr;
    }

    public static function getChat()
    {
        $db = self::co();
        $user = array();
        $query = 'SELECT t_user.login, t_chat.message FROM t_chat LEFT JOIN t_user ON t_chat.id_user = t_user.id_user ORDER BY t_chat.id_chat DESC LIMIT 30';
        $answer = $db->query($query);
        while ($row = $answer->fetch()) {
            array_push($user, $row['login'].' : '.$row['message']);
        }

        return $user;
    }

    public static function doc()
    {
        echo file_get_contents('Db.doc.txt');
    }
}
