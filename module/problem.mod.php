<?php

if(!defined("_IN_3POJ")) die();

class Problem {
	private static $mysql;

	private function __construct(){
	}

	public static function init(){
		self::$mysql = MySQL::getInstance();
	}

	public static function getProblem($id){
		$res = self::$mysql -> getResult("problems", NULL, "WHERE id={$id}", 1);
		if(!isset($res[0]))return false;
		$res = $res[0];
		return
			array(
				"title" => $res["title"],
				"content" => $res["content"],
				"input" => $res["input"],
				"output" => $res["output"],
				"samplein" => $res["samplein"],
				"sampleout" => $res["sampleout"],
				"hint" => $res["hint"],
				"cpulimit" => $res['cpulimit'],
				"memlimit" => $res['memlimit'],
				"submit" => $res["submit"],
				"accept" => $res["accept"],
			);
	}

	public static function getTopProblem($count = 50, $start = 0){
		$count = intval($count);
		$start = intval($start);
		if($count > 100 || $start < 0 || $count < 1) return NULL; // Hack Attempt
		$res = self::$mysql -> getResult("problems", array("id", "title", "submit", "accept"), "ORDER BY id asc", $count, $start);
		$ret = array();
		foreach($res as $row){
			$ret [] = 
				array(
					"id" => $row["id"],
					"title" => $row["title"],
					"submit" => $row["submit"],
					"accept" => $row["accept"],
				);
		}
		return $ret;
	}

	public static function addProblem($title, $content, $input, $output, $samplein, $sampleout, $hint, $datazip, $memlimit, $cpulimit, $hide = 0){ // Return Problem ID on success.
		$zip = new ZipArchive();
		$res = $zip -> open($datazip);
		if($res !== true){
			return -1; // Not an zip file.
		}
		$hide = $hide ? 1 : 0;
		$list = $zip -> getFromName("datalist.txt");
		if($list === false) return -2; // datalist.txt not found
		$data = explode("\n", $list);
		foreach($data as $testcase){
			if(($testcase = trim($testcase)) == '')continue;
			list($input, $output) = explode("|", $testcase);
			$input = trim($input); $output = trim($output);
			if($zip -> statName($input) === false || $zip -> statName($output) === false)return -3; //input or output data missing
		}
		$zip -> close();
		unset($zip);
		$memlimit = intval($memlimit);
		if($memlimit < 1)return false;
		$cpulimit = intval($cpulimit);
		if($cpulimit < 1)return false;
		$prefix = self::$mysql -> prefix();
		$title = self::$mysql -> filter($title);
		$content = self::$mysql -> filter($content);
		$input = self::$mysql -> filter($input);
		$output = self::$mysql -> filter($output);
		$samplein = self::$mysql -> filter($samplein);
		$sampleout = self::$mysql -> filter($sampleout);
		$hint = self::$mysql -> filter($hint);
		$query = "INSERT INTO {$prefix}problems (title,content,input,output,samplein,sampleout,hint,dataversion,hide,cpulimit,memlimit)";
		$query .= "VALUES ('{$title}','{$content}','{$input}','{$output}','{$samplein},'{$sampleout}','{$hint}',1,'{$hide}',{$cpulimit},{$memlimit})";
		$probid = self::$mysql -> lastId();
		global $settings;
		if(!move_uploaded_file($datazip, $settings['data_dir'] . "/{$probid}.zip"))return false;
		if(self::$mysql -> query($query))return $probid;
	}

	public static function modifyProblem($id, $title, $content, $input, $output, $samplein, $sampleout, $hint, $cpulimit, $memlimit, $datazip){
		$id = intval($id);
		if($id < 1)return false;
		if($datazip !== NULL){
			$zip = new ZipArchive();
			$res = $zip -> open($datazip);
			if($res !== true){
				return -1; // Not an zip file.
			}
			$list = $zip -> getFromName("datalist.txt");
			if($list === false) return -2; // datalist.txt not found
			$data = explode("\n", $list);
			foreach($data as $testcase){
				list($input, $output) = explode("|", $testcase);
				$input = trim($input); $output = trim($output);
				if($zip -> statName($input) === false || $zip -> statName($output) === false)return -3; //input or output data missing
			}
			$zip -> close();
			unset($zip);
		}
		$prefix = self::$mysql -> prefix();
		$query = "UPDATE {$prefix}problems SET ";
		$first = true;
		if($title !== NULL){
			$first = false;
			$title = self::$mysql -> filter($title);
			$query .= "title='{$title}'";
		}
		if($content !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$content = self::$mysql -> filter($content);
			$query .= "content='{$content}' ";
		}
		if($input !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$input = self::$mysql -> filter($input);
			$query .= "input='{$input}' ";
		}
		if($output !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$output = self::$mysql -> filter($output);
			$query .= "output='{$outout}' ";
		}
		if($samplein !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$samplein = self::$mysql -> filter($samplein);
			$query .= "samplein='{$samplein}' ";
		}
		if($sampleout !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$sampleout = self::$mysql -> filter($sampleout);
			$query .= "sampleout='{$sampleout}' ";
		}
		if($cpulimit !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$cpulimit = intval($cpulimit);
			if($cpulimit < 1)return false;
			$query .= "cpulimit={$cpulimit} ";
		}
		if($memlimit !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$memlimit = intval($memlimit);
			if($memlimit < 1)return false;
			$query .= "memlimit='{$memlimit}' ";
		}
		if($hint !== NULL){
			if($first) $query .= " ,";
			$first = false;
			$hint = self::$mysql -> filter($hint);
			$query .= "hint='{$hint}' ";
		}
		if($datazip !== NULL){
			if($first) $query .= " ,";
			$first = false;
			if(!move_uploaded_file($datazip, $settings['data_dir']. "/{$id}.zip"))return false;
			$query .= "dataversion=dataversion+1";
		}
		if($first)return false;
		$query .= " WHERE id={$id} LIMIT 1";
		if(self::$mysql -> query($query, false)){
			return true;
		}
		return false;
	}

	public static function deleteProblem($id){
		global $settings;
		$id = intval($id);
		if($id < 1)return false;
		$prefix = self::$mysql -> prefix();
		$query = "DELETE FROM {$prefix}problems WHERE id=$id LIMIT 1";
		if(self::$mysql -> query($query, false)){
			return unlink($settings['data_dir']. "/{$id}.zip");
		}
		return false;
	}
	
}
