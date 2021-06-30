<?php
namespace OULDEVELOPER\LIBRARIES;


spl_autoload_register(function($className){

	$class = str_replace('OULDEVELOPER','',$className);
	$class = str_replace('\\','/',$class);
	$class = trim($class,'/');
	$strpos = strpos($className,'LIBRARIES');

	if($strpos){
		$class = str_replace('LIBRARIES','SYSTEM',$class);
		$class =strtolower($class);
		$class = __VENDOR__.$class.'.php';
		if(file_exists($class)){
			require_once $class;
		}		
	}

	if(!$strpos){
	    $class = strtolower($class ).'.php';
	    $class = __APP__.$class;
	    if(file_exists($class)) {
	        require_once  $class;
	    }
	}
    
	if($className == "Router"){
		require_once __SYS__.'router.php';
	}
});
