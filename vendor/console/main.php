<?php


namespace OULDEVELOPER\CONSOLE;


class Main
{
    public $_arags;
    public $_op;
    public $_stuff;
    public $_stuff_name;

    public function __construct($arguments){
        $this->_arags = $arguments;
        $this->parseArgs();
    }

    private function parseArgs(){

        if(isset($this->_arags) and !empty($this->_arags)){
            if(isset($this->_arags[1])){
                $tmp = explode(':',$this->_arags[1],2);
                if(isset($tmp[0])){
                    $this->_op = $tmp[0];
                }
                if(isset($tmp[1])){
                    $this->_stuff = $tmp[1];
                }
            }
            if(isset($this->_arags[2])){
                $this->_stuff_name = $this->_arags[2];
            }
        }

    }

    public function run(){
        $class = 'OULDEVELOPER\\CONSOLE\\'.ucfirst($this->_stuff);
        $action = $this->_op;
        if(class_exists($class) and method_exists($class,$this->_op)){
            $obj = new  $class($this);
            $obj->$action();
        }
    }
}