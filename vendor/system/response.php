<?php

namespace OULDEVELOPER\LIBRARIES;

class Response{
	public static function Redirect($url){
		if (!headers_sent()) {
			session_write_close();
		    header('Location: '.$url);
		    exit;
		}
	}

	public static function write($data){
		echo $data;
	}
}