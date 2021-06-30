<?php


function load($class){
        $class = str_replace('OULDEVELOPER','',$class);
        $class = trim(strtolower($class),'\\');
        $class = __VENDOR__.$class.'.php';
        $class = str_replace('\\', DS, $class);
        if(file_exists($class)){
            require_once $class;
        }

}


spl_autoload_register('load');