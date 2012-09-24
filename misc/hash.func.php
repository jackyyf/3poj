<?php

if(!defined("_IN_3POJ"))die();

function genSalt($length = 16){
	mt_srand(time());
	$ret = "";
	for($i = 0; $i < $length; ++ $i){
		$ret .= dechex(mt_rand(0, 15));
	}
	return $ret;
}

function authPassword($raw, $hash, $method = "sha256"){
	$hash = explode("|", $hash);
	return $hash[1] == hash($method, hash($method, $hash[0]) . $raw);
}

function genPassword($raw, $method = "sha256"){
	$salt = genSalt();
	$ret = $salt . "|" . hash($method, hash($method, $salt) . $raw);
	return $ret;
}

?>