<?php

namespace OULDEVELOPER\LIBRARIES;
use OULDEVELOPER\LIBRARIES\StringManager;
class Sessionmanager extends \SessionHandler{
	use StringManager;
	protected $configuration;
	public function __construct(array $configuration){
		$this->configuration = $configuration;
		$this->init();
	}
	private function init(){
		ini_set('session.use_cookies', 'On');
		ini_set('session.use_only_cookies', 'On');
		ini_set('session.use_trans_sid', 'Off');
		ini_set('session.save_handler','files');
		ini_set('session.cookie_httponly', 'On');
		ini_set('session.cookie_secure',$this->configuration['SESSION_SECURED_SSL']);
		
		session_name($this->configuration['SESSION_NAME']);
		session_save_path($this->configuration['SESSION_SAVE_PATH']);


 		session_set_cookie_params(
 			$this->configuration['SESSION_MAX_LIFE_TIME'],
 			$this->configuration['SESSION_PATH'],
 			$this->configuration['SESSION_DOMAIN'],
 			$this->configuration['SESSION_SECURED_SSL'],
 			true
 		);
	}
	
	public function read($id)
    {
        $data = parent::read($id);
        if ($data) {
            return $this->decryptStr($data, $this->configuration['SESSION_SECURED_SSL']);
        } 
        return "";
    }

    public function write($id, $data)
    {
        $data = $this->encryptStr($data, $this->configuration['SESSION_SECURED_SSL']);
        return parent::write($id,$data);
    }
}