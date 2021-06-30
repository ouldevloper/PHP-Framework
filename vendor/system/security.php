<?php

namespace OULDEVELOPER\LIBRARIES;

class Security{
	const Algo = PASSWORD_BCRYPT;
	public static $Options;
	public static function crypt_pwd($password){
		return password_hash($password,self::Algo,self::$Options);
	}

	public static function isValidPwd($password){
		return password_verify ($password , self::crypt_pwd($password));
	}
}

?>