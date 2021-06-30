<?php
use OULDEVELOPER\LIBRARIES\Application;
class Router extends Application{

	public static function add($uri,$callback,$method='get'){
		static::$_uri[] = (isset($uri) and $uri != '/') ? trim($uri,'/') : '/';

		if($callback != null){

			static::$_method[] = $callback;
		}
		static::$requestMethods[] = $method;
	}
}