<?php
namespace app\lib;
use R;

class Database {
	public $db;

    public function __construct() {
        require_once 'app/lib/rb.php';
        $config = require 'app/config/db.php';
        $this->db = R::setup('mysql:host='.$config['db_host'].';dbname='.$config['db_name'].'', $config['db_user'], $config['db_password']);
        R::ext('xdispense', function($table_name){
		return R::getRedBean()->dispense($table_name);
		});
    }
}
/*
	public function query($sql){
		$query = $this->db->query($sql);
		return $query;
	}
	public function row($sql){
		$result = $this->query($sql);
		return $result->fetchAll();
	}
	public function column($sql){
		$result = $this->query($sql);
		return $result->fetchColumn();		
	}
*/

/* PDO
class Db {
	protected $db;
	public function __construct(){
		$config = require 'app/config/db.php';
		$this->db = new PDO('mysql:host='.$config['db_host'].';dbname='.$config['db_name'].'', $config['db_user'], $config['db_password']);
		//debug($config);
	}

	public function query($sql){
		$query = $this->db->query($sql);
		return $query;
	}
	public function row($sql){
		$result = $this->query($sql);
		return $result->fetchAll(PDO::FETCH_ASSOC);
	}
	public function column($sql){
		$result = $this->query($sql);
		return $result->fetchColumn();		
	}
*/