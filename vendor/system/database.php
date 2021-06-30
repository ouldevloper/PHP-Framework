<?php

namespace OULDEVELOPER\CORE\Models{
	use PDO;
	class Database{

		private static $instance;
		private static $cnx;

		protected static function getInstance(){
			if(self::$instance == null){
				self::$instance = new static;
			}
			return self::$instance;
		}
		protected function connection(){
			var_dump($this);
			if(self::$cnx == null){
				try{
					self::$cnx = new PDO('mysql:host=localhost;dbname=player;','root','root');/*PROVIDER.'://hostname='.HOSTNAME.';dbname='.DATABASENAME.';',USERNAME,PASSWORD);*/
				}catch(PDOExcption $er){
					//trigger_error('Internal Error 1996...');
				}
			}
			return self::$cnx;
		}
	}
}
