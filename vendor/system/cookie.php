<?php

namespace OULDEVELOPER\LIBRARIES;
use OULDEVELOPER\LIBRARIES\StringManager;

class Cookie{

	use StringManager;
	private $configuration;
	public function __construct(){
		$this->configuration = require_once CONFIG_PATH.'cookie.php';
	}
	public function __get($name){
		return $this->get($name);
	}
	public function __set($key,$value){
		$this->set($key,$value);
	}
	public function set($key,$value,$time=100){
		return setcookie( $key,
				   $this->encryptStr($value,$this->configuration['COOKIE_SECRITE_KEY']),
				   time()+$time*3600,
				   '/',
				   $this->configuration['COOKIE_DOMAIN'],
				   $this->configuration['COOKIE_SECURED_SSL'],
				   true ) ? true : false;
	}

	private function get($key){
		
		$data = array_get($_COOKIE,$key);
		return $data!=null ? $this->decryptStr($data,$this->configuration['COOKIE_SECRITE_KEY']) : null ; 
	}

	public function has($key){
		return array_key_exists($key,$_COOKIE);
	}

	public function remove($key){
		$this->set($key,null,0);
		unset($_COOKIE[$key]);		
	}

	public function all(){
		return $_COOKIE;
	}

	public function destroy(){
		foreach (array_keys($_COOKIE) as $key) {
			$this->remove($key);
		}
		unset($_COOKIE);
	}

}