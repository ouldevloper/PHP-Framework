<?php


namespace OULDEVELOPER\LIBRAIES;

class OOLDEVELOPERException extends Exception{
	public function __construct($message, $code = 0, Exception $previous = null) {
        parent::__construct($message, $code, $previous);
    }

    public function __get($name){
    	if(method_exists($this, $name))
    		$this->$name();
    }
    private function previous(){
        return $this->previous; 
    }

    private function code(){
        return $this->code;
    }

    private function file(){
        return $this->file;
    }

    private function line(){
        return $this->line;
    }

    private function trace(){
        return $this->trace;
    }

    private function traceToString(){
        return parent::getTraceAsString();
    }

    private function toString(){
        return $this->message();
    }

    
    public function __toString() {
        return $this->toString();//__CLASS__ ." :  {$this->message}\n";
    }

    public function message(){
        $trace =  $this->getTrace();
        $trace = array_shift($trace);
        
        echo "OULDEVELOPER Exception in {$this->file} at Line {$this->line} : {$this->message} [+] class : {$trace['class']}\n[+] function {$trace['function']}\n";
    }
}