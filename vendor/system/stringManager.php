<?php

namespace OULDEVELOPER\LIBRARIES;

trait StringManager{
	public function decryptStr($edata, $password) {
	    $data = base64_decode($edata);
	    $salt = substr($data, 0, 16);
	    $ct = substr($data, 16);

	    $rounds = 3; 
	    $data00 = $password.$salt;
	    $hash = array();
	    $hash[0] = hash('sha256', $data00, true);
	    $result = $hash[0];
	    for ($i = 1; $i < $rounds; $i++) {
	        $hash[$i] = hash('sha256', $hash[$i - 1].$data00, true);
	        $result .= $hash[$i];
	    }
	    $key = substr($result, 0, 32);
	    $iv  = substr($result, 32,16);

	    return openssl_decrypt($ct, 'AES-256-CBC', $key, true, $iv);
	  }
	public function encryptStr($data, $password) {
	    $salt = openssl_random_pseudo_bytes(16);
	    $salted = '';
	    $dx = '';
	    while (strlen($salted) < 48) {
	      $dx = hash('sha256', $dx.$password.$salt, true);
	      $salted .= $dx;
	    }
	    $key = substr($salted, 0, 32);
	    $iv  = substr($salted, 32,16);

	    $encrypted_data = openssl_encrypt($data, 'AES-256-CBC', $key, true, $iv);
	    return base64_encode($salt . $encrypted_data);
	}
}