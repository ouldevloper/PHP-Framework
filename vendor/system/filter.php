<?php


namespace OULDEVELOPER\LIBRARIES;


trait Filter{
	public function filter($var){
		$var = $this->strip($var);
		if(preg_match('/^\d+\.\d+$/', $var)) 
			$this->float($var);    

		elseif(preg_match('/^\d+$/', $var))
		 	$this->int($var);

		elseif(preg_match('/^(.+:\/\/)?(www.)?(.){2,}\.(.){2,}$/', $var))
		 	$this->url($var);       

		elseif(preg_match('/^(.+)@(.+)\.(.+)$/', $var))
		 	$this->email($var);                
		else
			$this->str($var);          
	}

	public function str($var){
		$var = $this->strip($var);
		return filter_var($var,FILTER_SANITIZE_STRING);   
	}

	public function int($var){
		$var = $this->strip($var);
		return filter_var($var,FILTER_SANITIZE_NUMBER_INT);
	}	

	public function float($var){
		$var = $this->strip($var);
		return filter_var($var,FILTER_SANITIZE_NUMBER_FLOAT); 
	}

	public function email($var){
		$var = $this->strip($var);
		return filter_var($var,FILTER_SANITIZE_EMAIL);  
	}

	public function url($var){
		$var = $this->strip($var);
		return filter_var($var,FILTER_SANITIZE_URL);    
	}

	private function strip($var){
		return htmlentities(strip_tags($var));
	}
}