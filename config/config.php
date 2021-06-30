<?php



//DEFINE A DIRECTOY'S PATH

!defined('DS')							? 	define('DS',DIRECTORY_SEPARATOR):null;

!defined('__ROOT__')					? 	define('__ROOT__', realpath(dirname(__FILE__)).DS.'..'.DS) :null;

!defined('__APP__')						? 	define('__APP__', realpath(dirname(__FILE__)).DS.'..'.DS.'app'.DS) :null;

!defined('__VENDOR__')					? 	define('__VENDOR__', realpath(dirname(__FILE__)).DS.'..'.DS.'vendor'.DS) :null;

!defined('__SYS__')						?	define('__SYS__', realpath(dirname(__FILE__)).DS.'..'.DS.'vendor'.DS.'system'.DS) :null;

!defined('__CONFIG__')					?	define('__CONFIG__', realpath(dirname(__FILE__)).DS) :null;

!defined('__VIEW__')					?	define('__VIEW__', realpath(dirname(__FILE__)).DS.'..'.DS.'resources'.DS.'views'.DS) :null;

!defined('__UPLOAD__')					?	define('__UPLOAD__',realpath(dirname(__FILE__)).DS.'..'.DS.'public'.DS.'upload'.DS):null;

!defined('__CACHE__')					?	define('__CACHE__',__APP__.'..'.DS.'storage'.DS.'framework'.DS.'cache'.DS ):null;

!defined('__SESSION__')					?	define('__SESSION__',__APP__.'..'.DS.'storage'.DS.'framework'.DS.'sessions'.DS ):null;

!defined('__CACHE_VIEW__')			  	?	define('__CACHE_VIEW__',__APP__.'..'.DS.'storage'.DS.'framework'.DS.'views'.DS ):null;

!defined('__LOG__')						?	define('__LOG__',__APP__.'..'.DS.'storage'.DS.'log'.DS ):null;

!defined('__PUBLIC__')					?	define('__PUBLIC__', __APP__.'..'.DS.'public'.DS) :null;

!defined('__SCRIPT__')				  	?	define('__SCRIPT__', __PUBLIC__.'scripts'.DS) :null;

!defined('__IMG__')					  	?	define('__IMG__', __PUBLIC__.'images'.DS) :null;

!defined('__STYLE__')				  	?	define('__STYLE__', __PUBLIC__.'styles'.DS) :null;

//upload configuration

!defined('__UPLOAD_FILE_MAX_LENGHT__')	? 	define('__UPLOAD_FILE_MAX_LENGHT__', 25 ) :null;


//DATABASES CONFIGURATION

!defined('DATA_TYPE_STR')				? 	define('DATA_TYPE_STR',	\PDO::PARAM_STR) :null;

!defined('DATA_TYPE_INT')				? 	define('DATA_TYPE_INT', 	\PDO::PARAM_INT) :null;

!defined('DATA_TYPE_DECIMAL')			? 	define('DATA_TYPE_DECIMAL',	4) :null;

!defined('DATA_TYPE_DATE')				? 	define('DATA_TYPE_DATE',	5) :null;

!defined('VALIDATE_DATE_STRING	')		? 	define('VALIDATE_DATE_STRING',	'/^[1-9][1-9][1-9][1-9]-[0-1]?[0-2]-(?:[0-2]?[1-9]|[3][0-1])$/') :null;

!defined('VALIDATE_DATE_NUMERIC')		? 	define('VALIDATE_DATE_NUMERIC',	'^\d{6,8}$') :null;

!defined('DEFAULT_MYSQL_DATE')			? 	define('DEFAULT_MYSQL_DATE',	'1970-01-01') :null;

//session defines

