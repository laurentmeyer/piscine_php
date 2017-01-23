<?php
require_once 'Db.class.php';
session_start();
class User
{
	private $_id;
	private $_login;
	private $_passwd;
	private $_playtotal;
	private $_playlost;
	private $_playwin;
	private $_elo;
	
	static $verbose = false;

	public function __construct(array $kwargs)
	{
		if ($kwargs['login'] == "" || $kwargs['passwd'] == "")
			return NULL;

		if ($kwargs['login'])
			$this->set('_login', htmlspecialchars($kwargs['login']));

		if ($kwargs['passwd'])
			$this->set('_passwd', hash('whirlpool', htmlspecialchars($kwargs['passwd'])));
		
		if ($kwargs['register']) {
			if ($kwargs['register'] == "ON") {
				if ($this->_create_user() == false) {
					$this->set('_password', '');
					return "NO";
				} else {
					$this->set('_password', '');
					return "OK";
				}
			}
		}
		
		if (self::$verbose == true) {
			if (!$kargs['login'] || !$kwargs['passwd']) {
				if (!array_key_exists('login', $kwargs))
					echo "User Object : 'login' not supplied" . PHP_EOL;
				if (!array_key_exists('passwd', $kwargs))
					echo "User Object : 'passwd' not supplied" . PHP_EOL;
			}
		}
	}
	public function __destruct()
	{
		if (self::$verbose == true)
			echo "Destructing User Object";
		return ;
	}
	public function __toString()
	{
		return "User object id: [" . $this->get('_id') . "] login: [" . $this->get('_login') . "] passwd: [" . $this->get('_passwd') . "]" . PHP_EOL;
	}
	private function _create_user()
	{
		$db = Db::co();
		$query = "SELECT login FROM t_user WHERE login = '".$this->get('_login')."'";
		$answer = $db->query($query)->fetch();
		if ($answer['login'] == $this->get('_login')) {
			$this->set('_passwd', '');
			$this->set('_login', 'NOPE');
			$this->set('_id', 0);
			return false;
		} else {
			$query = "INSERT INTO t_user(login, passwd) VALUES('".$this->get('_login')."', '" . $this->get('_passwd') . "')";
			$answer = $db->query($query);
			$query = "SELECT id_user FROM t_user WHERE login = '".$this->get('_login')."'";
			$answer = $db->query($query)->fetch();
			$this->set('_id', $answer['id_user']);
			$this->set('_passwd', '');
			return true;
		}
	}
	public function connect_user()
	{
		$db = Db::co();
		$query = "SELECT id_user, login, passwd, play_total, play_win, play_lost, elo FROM t_user WHERE login = '".$this->get('_login')."' AND passwd = '".$this->get('_passwd')."'";
		$then = $db->query($query);
		$who = $then->fetch();
		if ($who) {
			$this->set('_id', $who['id_user']);
			$this->set('_playtotal', $who['play_total']);
			$this->set('_playwin', $who['play_win']);
			$this->set('_playlost', $who['play_lost']);
			$this->set('_elo', $who['elo']);
			$_SESSION['user'] = $this;
			return $this->get('_id');
		} else {
			return "0";
		}
	}
	
	public function get_User()
	{
		$db = Db::co();
		$query = "SELECT id_user, login, passwd, play_total, play_win, play_lost, elo FROM t_user WHERE login = '".$this->get('_login')."'";
		$then = $db->query($query);
		$who = $then->fetch();
		if ($who) {
			$this->set('_id', $who['id_user']);
			$this->set('_playtotal', $who['play_total']);
			$this->set('_playwin', $who['play_win']);
			$this->set('_playlost', $who['play_lost']);
			$this->set('_elo', $who['elo']);
			//$_SESSION['user'] = $this;
			return $this;
		} else {
			return "0";
		}
	}
	
	public function delog_user()
	{
		if (isset($_SESSION['user']))
			unset($_SESSION['user']);
		return "DELOG";
	}
	
	public function send_message($message)
	{
		$db = Db::co();
		$query = "INSERT INTO t_chat(id_user, message) VALUES('".$_SESSION['user']->get('_id')."', '".htmlspecialchars($message)."')";
		$then = $db->query($query);
	}
	
	public function get($att) { return $this->$att; }
	public function set($att, $val) { $this->$att = $val; }
	public static function doc() {
		echo file_get_contents("User.doc.txt");
	}
}

