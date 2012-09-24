<?php

if(!defined("_IN_3POJ")) die();

class Judge {
	private static $mysql;
	const codeLimit = 65536; // Code Length 64KB Max

	private function __construct(){
	}

	public static function init(){
		self::$mysql = MySQL::getInstance();
	}

	public static function getResult($id){
		$id = intval($id); // Injecting Protection
		if($id < 1)return NULL;
		$res = self::$mysql -> getResult("status", NULL, "WHERE id={$id}", 1);
		$res = $res[0];
		return 
			array(
				"id" => $res["id"],
				"uid" => $res["uid"],
				"pid" => $res["pid"],
				"lang" => $res["lang"],
				"status" => $res["status"],
				"cputime" => $res["cputime"],
				"memusage" => $res["memusage"],
				"time" => $res["time"],
				"code" => $res["code"],
				"testcase" => $res["testcase"],
			);
	}

	public static function getTopResult($count = 50, $start = 0){
		$count = intval($count);
		$start = intval($start);
		if($count < 1 || $start < 0)return NULL; // Injecting Protection
		if($count > 100)return NULL; // Not Allowed to get more than 100 results, this may cause performance problem!
		$res = self::$mysql -> getResult("status", NULL, "ORDER BY id desc", $count, $start);
		$ret = array();
		foreach($res as $row){
			$ret[] = 
				array(
					"id" => $res["id"],
					"uid" => $res["uid"],
					"pid" => $res["pid"],
					"lang" => $res["lang"],
					"status" => $res["status"],
					"cputime" => $res["cputime"],
					"memusage" => $res["memusage"],
					"time" => $res["time"],
				);
		}
		return $ret;
	}

	public static function addSubmition($uid, $pid, $code, $lang){
		$uid = intval($uid);
		$pid = intval($pid);
		if($uid < 1 && $ $pid < 1)return false;
		if($lang != 'C' && $lang != 'C++' && $lang != 'PAS')return false;
		if(strlen($code) > self::codeLimit || strlen(trim($code)) == 0)return -1;
		$code = self::$mysql -> filter($code);
		$prefix = self::$mysql -> prefix();
		$time = time();
		self::$mysql -> query("INSERT INTO {$prefix}status (uid, pid, code, lang, status, cputime, memusage, time,testcase) VALUES ({$uid},{$pid},'{$code}','{$lang}', -2, 0, 0, {$time}, '')", false);
		$id = self::$mysql -> lastId();
		self::$mysql -> query("INSERT INTO {$prefix}pending (id) VALUES ({$id})", false);
		self::$mysql -> query("UPDATE {$prefix}problems SET submit=submit+1 WHERE id={$pid} LIMIT 1");
		self::$mysql -> query("UPDATE {$prefix}users SET submit=submit+1 WHERE id={$uid} LIMIT 1");
		return true;
	}
}

?>
