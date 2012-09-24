<?php

if(!defined("_IN_3POJ")) die();

class User{
	
	private static $mysql;
	
	private function __construct(){
	}
	
	public static function init(){
		self::$mysql = MySQL::getInstance();
	}
	
	public static function addUser($name, $pass, $email, $school, $motd){
		//Allow character in name: 0-9, a-z, A-Z, _, -
		$l = strlen($name);
		for($i = 0; $i < $l; ++ $i){
			$ch = $name[$i];
			if($ch >= '0' && $ch <= '9')continue;
			if($ch >= 'a' && $ch <= 'z')continue;
			if($ch >= 'A' && $ch <= 'Z')continue;
			if($ch == '-' || $ch == '_')continue;
			//echo "Error";
			return false;
		}
		$prefix = self::$mysql -> prefix();
		$res = self::$mysql -> query("SELECT COUNT(*) FROM {$prefix}users WHERE name='$name' LIMIT 1");
		if($res[0][0] > 0)return false;
		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
			return false;
		}
		$pass = genPassword($pass);
		$email = self::$mysql -> filter($email);
		$school = self::$mysql -> filter($school);
		$motd = self::$mysql -> filter($motd);
		$query = "INSERT INTO {$prefix}users (name, pass, email, school, motd) VALUES ('{$name}','{$pass}','$email','{$school}','{$motd}')";
		if(self::$mysql -> query($query, false))
			return true;
		return false;
	}
	
	public static function modifyUser($id, $pass, $newpass, $email, $school, $motd){
		$id = intval($id);
		if($id < 1)return false;
		$hashedPass = self::$mysql -> getResult("users", array("pass"), "WHERE id={$id}", 1);
		$hashedPass = $hashedPass[0]["pass"];
		if(!authPassword($pass, $hashedPass)) return false;
				$prefix = self::$mysql -> prefix();
		$query = "UPDATE {$prefix}users SET ";
		$first = true;
		if($newpass !== NULL){
			$first = false;
			$newpass = genPassword($newpass);
			$query .= "pass='{$newpass}'";
		}
		if($email !== NULL){
			if($first) $query .= " ,";
			$first = false;
			if(!filter_var($email, FILTER_VALIDATE_EMAIL))return false;
			$email = self::$mysql -> filter($email);
			$query .= "email='{$email}' ";
		}
		if($school !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$school = self::$mysql -> filter($school);
			$query .= "school='{$school}' ";
		}
		if($motd !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$motd = self::$mysql -> filter($motd);
			$query .= "motd='{$motd}' ";
		}
		if($first)return false;
		$query .= " WHERE id={$id} LIMIT 1";
		if(self::$mysql -> query($query, false)){
			return true;
		}
		return false;
	}
	
	public static function deleteUser($id){
		$id = intval($id);
		if($id < 1)return false;
		$prefix = self::$mysql -> prefix();
		$query = "DELETE FROM {$prefix}users WHERE id={$id} LIMIT 1";
		return self::$mysql -> query($query, false);
	}
	
	public static function getTopUser($count = 50, $start = 0){
		$count = intval($count);
		$start = intval($start);
		if($count > 100 || $start < 0 || $count < 1) return NULL; // Hack Attempt
		$res = self::$mysql -> getResult("users", array("id", "name", "email", "submit", "accept"), "ORDER BY accept desc, submit asc", $count, $start);
		$ret = array();
		foreach($res as $row){
			$ret [] = 
				array(
					"id" => $row["id"],
					"name" => $row["name"],
					"submit" => $row["submit"],
					"accept" => $row["accept"],
				);
		}
		return $ret;
	}
	
	public static function getUser($id){
		$id = intval($id);
		if($id < 1)return false;
		$prefix = self::$mysql -> prefix();
		$res = self::$mysql -> query("SELECT uo.*, (SELECT COUNT(*) FROM {$prefix}users ui WHERE (ui.accept, -ui.submit) > (uo.accept, -uo.submit)) AS rank FROM {$prefix}users uo WHERE id={$id}", true);
		if(!isset($res[0]))return false;
		$res = $res[0];
		return
			array(
				"id" => $res["id"],
				"name" => $res["name"],
				"email" => $res["email"],
				"school" => $res["school"],
				"motd" => $res["motd"],
				"submit" => $res["submit"],
				"accept" => $res["accept"],
				"acceptid" => $res["acceptid"],
				"rank" => $res["rank"] + 1
			);
	}
}



?>