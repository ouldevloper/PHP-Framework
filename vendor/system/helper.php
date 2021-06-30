<?php

use OULDEVELOPER\LIBRARIES\Session;

$GLOBALS['session'] = Session::getInstance();
$session->start();

if(!function_exists('pre')){
	function pre($var){
		echo "<pre>";
        print_r($var);
        echo "</pre>";
	}
}

if(!function_exists('token')){
	function token(){
		global $session;
		$token = md5(uniqid(mt_rand(), true));
		if(session_id()!=''){
			$session->token = $token;
			echo "<input type='hidden' name='token' value='".$token."' />";
		}
	}
}

if(!function_exists('array_get')){
	function array_get(array $array,$key,$default=null){
		return array_key_exists($key, $array)?$array[$key]:$default;
	}
}   

if(!function_exists('defineCost')){
	function defineCost(){
		$timeTarget = 0.05; 
		$cost = 8;
		do {
		    $cost++;
		    $start = microtime(true);
		    password_hash("test", PASSWORD_BCRYPT, ["cost" => $cost]);
		    $end = microtime(true);
		} while (($end - $start) < $timeTarget);
		\OULDEVELOPER\LIBRARIES\Security::$Options[] = ['cost'=>$cost];
	}
	defineCost();
} 

if(!function_exists('assets')){
	function assets($path){
		return '/assets/'.$path;
	}
} 