<?php

namespace OULDEVELOPER\LIBRARIES;
use OULDEVELOPER\LIBRARIES\SessionManager;
class Session{

	private $configuration;
	private static $instance;
	private function __construct(){
		$this->configuration = require_once __CONFIG__.'session.php';
		$manager = new Sessionmanager($this->configuration);
		session_set_save_handler($manager);
	}
	public static function getInstance(){
		if(self::$instance == null){
			self::$instance = new static;
		}
		return self::$instance;
	}
	public function start(){

		if('' === session_id()){
			if(session_start()){
				$this->setSessionStartTime();
			}
		}
		$this->checkSessionValidity();
	}


	public function __get($key){
		if(isset($_SESSION[$key])){
			$data = $_SESSION[$key];
			if(!$data){
				return $data;
			}else{
				return $_SESSION[$key];
			}
		}else{
			@trigger_error("No session key ".$key." exsits .!<br/>");
		}
	}

	public function __set($key,$value){

		$_SESSION[$key] = $value;
	}

	

	private function setSessionStartTime(){
		if(!isset($_SESSION['sessionStartTime'])){
			$this->sessionStartTime = time();
		}
	}

	private function checkSessionValidity(){
		$this->renewSession();
		$this->regenerateFingerPrint();
	}

	private function renewSession(){
		if((time()-$this->sessionStartTime) >= ($this->configuration['TTL']*50)){
			$this->sessionStartTime=time();
			session_regenerate_id(true);
		}
		
	}
	public function all(){
		return $_SESSION;
	}
	public function kill(){
		session_unset();
		setcookie(
			$this->configuration['SESSION_NAME'],
			'',
			time()-1000,
			$this->configuration['SESSION_PATH'],
			$this->configuration['SESSION_DOMAIN'],
			$this->configuration['SESSION_SECURED_SSL'],
			true
			);
		session_destroy();
	}

	private function regenerateFingerPrint(){
		$userAgentId = $_SERVER['HTTP_USER_AGENT'];
		$this->configuration['SESSION_SECRITE_KEY'] = openssl_random_pseudo_bytes(16);
		$sessionId = session_id();
		$this->fingerPrint = md5($userAgentId.$this->configuration['SESSION_SECRITE_KEY'].$sessionId);
	}

	
	public function isValidFingerprint(){
		if(!isset($this->fingerPrint)){
			$this->regenerateFingerPrint();
		}
		$finger = md5($_SERVER['HTTP_USER_AGENT'].$this->configuration['SESSION_SECRITE_KEY'].session_id());
		if($this->fingerPrint == $finger){
			return true;
		}
		return false;
	}

	
	
}