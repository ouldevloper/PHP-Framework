<?php
namespace OULDEVELOPER\LIBRARIES;
class Request 
{
	public static function isMethod($method = 'get'){
		return strtolower($method) === strtolower($_SERVER['REQUEST_METHOD']) ? true : false ;
	}

	public static function get($name){
		return !empty($name)?isset($_GET[$name])?htmlspecialchars(strip_tags($_GET[$name])):false:false;
	}

	public static function post($name){
		global $session;
		if(!empty($name)){
			if(isset($_POST[$name])){
				if(isset($_POST['token']) && $_POST['token'] === $session->token){
					return htmlspecialchars(strip_tags($_POST[$name]));
				}else{
					die('<b>Token not exists or not valid. You should Add an Anti CSRF by the <strong> token() </stronge> function.!</b><br>');
				}
			}
		}
		return false;
	}

	public static function request($name){
		return !empty($name)?isset($_REQUEST[$name])?htmlspecialchars(strip_tags($_REQUEST[$name])):false:false;
	}

	public static function input($name){
		$method = strtolower($_SERVER['REQUEST_METHOD']);
		switch ($method) {
			case 'post':
				return static::post($name);
			case 'get' :
				return static::get($name);
			default:
				return static::request($name);				
		}
		/*if($method == 'post'){
			if(session_id() != ''){
				if(isset($session->token)){
					echo $session->token;exit();
					if(static::post($name) !== $session->token){
						return static::post($name);
					}
				}else{
					die('Add Anti Csrf token plais');
				}
				
			}
			
		}
		else if($method == 'get'){
			return static::get($name);
		}else{
			return static::request($name);
		}*/
	}
	
	
}


