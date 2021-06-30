<?php


namespace OULDEVELOPER\LIBRARIES;
use OULDEVELOPER\LIBRARIES\Http\HttpRequest;
use OULDEVELOPER\CORE\Models\Model;

trait Validation{

	private $requestMethod;
	private $value;
	private $name;
	private	$errors = [];
	

	public function validate($filtred=[]){

		if(isset($filtred)){

			foreach ($filtred as $field => $filter) {
		
				$this->value = HttpRequest::input($field);
				$this->name = $field;
				$filters = explode(',', $filter);

				foreach ($filters as $value) {					
					$keyval 	= 	explode(':',$value,3);
					$methodname = 	$keyval[0];
					$param 		= 	isset($keyval[1])?$keyval[1]:'';
					$message 	= 	isset($keyval[2])?$keyval[2]:'';
					$this->$methodname($param,$message);
				}
			}
		}		
	}
	
	public function required($filter,$message=''){
		if(empty(trim($this->value))){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' is Required. ';
			}
		}
	}

	public function unique($filter,$message=''){
		$query = 'select * from '.$filter . ' where '.$this->name.' = '.$this->value;
		if(Model::countFromQuery($query)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Already Exist, try an other one ';
			}
		}
	}

	public function minlen($filter,$message=''){
		if(strlen($this->value)<$filter){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be at Most than '.$filter;
			}
		}
	}

	public function maxlen($filter,$message=''){
		if(strlen($this->value)>$filter){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be at Least than '.$filter;
			}
		}
	}

	public function int($filter,$message=''){
		if(!filter_var($this->value,FILTER_VALIDATE_INT)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be a Valide Integer';
			}
		}
	}

	public function float($filter,$message=''){
		if(!filter_var($this->value,FILTER_VALIDATE_FLOAT)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be a Valide Float';
			}
		}
	}

	public function email($filter,$message=''){
		if(!filter_var($this->value,FILTER_VALIDATE_EMAIL)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be a Valide Email';
			}
		}
	}

	public function ip($filter,$message=''){
		if(!filter_var($this->value,FILTER_VALIDATE_IP)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be a Valide IP Address';
			}
		}
	}

	public function url($filter,$message=''){
		if(!filter_var($this->value,FILTER_VALIDATE_URL)){
			if($message!=''){
				$this->errors[] = $message;
			}else{
				$this->errors[] = $this->name . ' Should be a Valide Url';
			}
		}
	}

	public function hasErrors(){
		return !empty($this->errors);
	}

	public function errors(){
		return $this->errors;
	}

}