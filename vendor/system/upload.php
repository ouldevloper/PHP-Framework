<?php

namespace OULDEVELOPER\LIBRARIES;

class Upload{

	private $file_name  			=[];
	private $file_type				=[];
	private $file_size 				=[];
	private $file_error 			=[];
	private $file_tempPath 			=[];
	private $file_extentions 		=[];
	private $files_name 			=[];
	private $allowedExtention 		=[];
	private $files_proper_location	=[];
	private $max_file_size; 
	private $files_count;
	public function __construct()
	{
		$this->files_count = count($_FILES);
		foreach ($_FILES as $key => $file ) {
			$this->file_name[]        = $_FILES[$key]['name'];		
			$this->file_type[]        = $_FILES[$key]['type'];	
			$this->file_size[]        = $_FILES[$key]['size'];	
			$this->file_error[]       = $_FILES[$key]['error'];	
			$this->file_tempPath[]    = $_FILES[$key]['tmp_name'];	
		}
		$this->max_file_size      	= ini_get('upload_max_filesize');
		$this->allowedExtention = require_once __CONFIG__.'extentions.php';
		$this->getExtention();
		$this->getProperLocation();
		$this->fullname();


	}

	private function maxFileUploadSizeToByte(){
		$size = filter_var($this->max_file_size,FILTER_SANITIZE_NUMBER_INT);
		$symbole = str_replace($size, '' ,$this->max_file_size);
		if(substr($symbole ,0,1) == 'B'){
			return $size;
		}
		if(substr($symbole ,0,1) == 'K'){
			return $size*1024;
		}
		if(substr($symbole ,0,1) == 'M'){
			return $size*1024*1024;
		}
		if(substr($symbole ,0,1) == 'G'){
			return $size*1024*1024*1024;
		}
		if(substr($symbole ,0,1) == 'T'){
			return $size*1024*1024*1024*1024;
		}
	}


	private function getExtention(){
		foreach ($this->file_name as $key =>  $value) {
			$tmp = explode('.', $value);
			$this->file_extentions[$key] = $tmp[count($tmp)-1];
		}		
	}


	private function fullname(){
		for($i = 0 ; $i < $this->files_count ; $i++) {
			$tmp = str_replace('.'.$this->file_extentions[$i], '', $this->file_name[$i]);
			$sessionid = session_id()!=''?session_id():"";
			$this->files_name[] = str_replace(['\\','/','.',':','<','>','?','*','"','|'],'',substr(password_hash($tmp.$sessionid.time(),PASSWORD_DEFAULT),0,__UPLOAD_FILE_MAX_LENGHT__)).'.'.$this->file_extentions[$i];
		}
	}


	public function isAllowedExtention(){
		$isAllowed = false;
		foreach ($this->file_extentions as $key=>$value) {	
			if(in_array($value, $this->allowedExtention)){
				$isAllowed = true;
			}else{
				$isAllowed = false;
				break;
			}
		}	
		return $isAllowed;
	}


	private function isAllowedSize(){
		$maxFileUploadSize = $this->maxFileUploadSizeToByte();
		$isAllowed = false;
		foreach ($this->file_size as $key=>$value) {
			if($value < $maxFileUploadSize){
				$isAllowed = true;
			}else{
				$isAllowed = false;
				break;
			}
		}
		return $isAllowed;
	}

	private function hasErrors(){
		$isOk = false;
		foreach ($this->file_error as $key => $value) {
			if(!$value){
				$isOk = false;
			}else{
				$isOk = true;
				break;
			}
		}
		return $isOk;
	}

	private function getProperLocation(){
		
		for ($i=0; $i < $this->files_count; $i++) { 
			$location = explode('/', $this->file_type[$i]);
			$tmp = count($location)>0 && !empty(array_shift($location))?$location[count($location)-1]:"unknow";			
			$dir = scandir(__UPLOAD__);
			if(!in_array($tmp, $dir)){
				mkdir(__UPLOAD__.$tmp,777);
			}
			$this->files_proper_location[$i] = str_replace('\\','/', $tmp.'/');
		}
	}

	private function getPaths(){
		$paths = [];
		for ($i=0; $i < $this->files_count ; $i++) {
			$paths[] =  $this->files_proper_location[$i].$this->files_name[$i];
		}
		return $paths;
	}
	
	
	public function upload(){
		if ($this->isAllowedExtention() && 
			$this->isAllowedSize() 		&& 
			!$this->hasErrors()){
			for ($i=0; $i < $this->files_count ; $i++) {
				$path = __UPLOAD__.$this->files_proper_location[$i].$this->files_name[$i]; 
				move_uploaded_file($this->file_tempPath[$i], $path);
			}
			return $this->getPaths();
		}else{
			return false;
		}
	}
}