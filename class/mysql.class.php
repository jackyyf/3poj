<?php

//require_once("../init.inc.php");
//require_once("../modules/errorlog.mod.php");
//require_once("../func.inc.php");
if(!defined("_IN_3POJ"))die(); // Can't be visited or used directly.

//ErrorLog::setDebug(1);

class MySQL{

	private static $instance = NULL;
	private $handle = NULL;
	private $prefix = '';
	private $cntquery = 0;

	public static function getInstance(){
		if(self::$instance === NULL)self::$instance = new MySQL();
		return self::$instance;
	}

	private function __construct(){
		global $settings;
		$config = $settings['mysql'];
		$this -> handle = new mysqli($config["host"], $config["user"], $config["pass"], $config["db"]);
		if(mysqli_connect_errno()){ // Connect Failed
			ErrorLog::log("Connect to MySQL Server Failed", ErrorLog::ERROR);
			mydie();
		}
		if(!$this -> handle -> set_charset("utf8")){
			ErrorLog::log("Unable to use utf8 character set!");
		}
		$this -> prefix = $config["prefix"];
		return true;
	}

	public function filter($org){
		return $this -> handle -> real_escape_string($org);
	}

	public function query($query, $return=true){
		$res = $this -> handle -> query($query);
		++ $this -> cntquery;
		if($this -> handle -> errno){
			ErrorLog::log("MySQL Query Error: " . $this -> handle -> error, ErrorLog::WARNING);
			return false;
		}
		if($return){
			$t = array();
			while($arr = $res -> fetch_array()){
				array_push($t, $arr);
			}
			return $t;
		}
		return true;
	}

	public function lastId(){
		return $this -> handle -> insert_id;
	}

	public function cnt(){
		return $this -> cntquery;
	}

	public function prefix(){
		return $this -> prefix;
	}

	public function getResult($table, $rows, $conditions, $limit = 0, $start = 0){
		$query = "SELECT ";
		if($rows !== NULL){
			$first = true;
			foreach($rows as $row){
				if(!$first) $query .= ',';
				$first = false;
				$query .= "{$row}";
			}
		} else {
			$query .= "*";
		}
		$query .= " FROM {$this->prefix}{$table} " . $conditions;
		$limit = intval($limit); $start = intval($start);
		if($limit > 0)$query .= " LIMIT {$start},{$limit}";
		return $this -> query($query);
	}
}