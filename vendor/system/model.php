<?php


namespace OULDEVELOPER\LIBRARIES;
use PDO;

class Model
{
	const DATA_TYPE_BOOL 	=	\PDO::PARAM_BOOL;
	const DATA_TYPE_STR 	= 	\PDO::PARAM_STR;
	const DATA_TYPE_INT 	= 	\PDO::PARAM_INT;
	const DATA_TYPE_DECIMAL =	4;
	const DATA_TYPE_DATE 	= 	5;
	const VALIDATE_DATE_STRING = '/^[1-9][1-9][1-9][1-9]-[0-1]?[0-2]-(?:[0-2]?[1-9]|[3][0-1])$/';
	const VALIDATE_DATE_NUMERIC ='^\d{6,8}$';
	const DEFAULT_MYSQL_DATE ='1970-01-01';
	public static $cnx;

	private static function connection()
	{
		if(static::$cnx == null){
			try
			{
				static::$cnx = new PDO(	'mysql://hostname = localhost;dbname=project1;',
									 	'root',
									 	'root');
			}catch(PDOException $er)
			{
				die('coulde not connect to database');
			}
		}
		return static::$cnx;
	}

	private function getColumns()
	{
		$cols='';
		foreach (static::$tableSchema as $column => $type) {			
			if($this->$column!=null)
			{
				if($column === static::$primaryKey){
					if($this->id === null){
						$cols .= $column ." = ? ,";
					}
				}else{
					$cols .= $column ." = ? ,";
				}				
			}
		}		
		return trim($cols,',');
	}

	private function getValues()
	{
		$val ='';
		foreach (static::$tableSchema as $column => $type) {
			if($this->$column!=null)
			{
				if($column === static::$primaryKey){
					if($this->id === null){
						$val .= $this->filterTags($this->$column).",";
					}
				}else{
					$val .= $this->filterTags($this->$column) .",";
				}
			}
		}
		return explode(',',trim($val,','));
	}
	private function filterTags($str){
		return htmlentities(strip_tags(trim($str)));
	}
	private function create()
	{
		$sql = 'INSERT INTO '. static::$tableName . ' SET '. self::getColumns();
		$stmt = self::connection()->prepare($sql);
		return $stmt->execute($this->getValues());
	}

	private function update()
	{
		$sql = 'UPDATE '. static::$tableName . ' SET '. $this->getColumns() . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
		$stmt = self::connection()->prepare($sql);
		return $stmt->execute($this->getValues());
	}

	private function delete()
	{
		$sql = 'DELETE FROM '. static::$tableName . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
		$stmt = self::connection()->prepare($sql);
		$stmt->execute();
	}

	public function save($op){
		switch ($op) {
			case 'add':
				$this->create();
				break;
			case 'delete':
				$this->delete();
				break;
			case 'update':
				$this->update();
				break;
			default:
				return;
		}
	}

	public static function all()
	{
		$sql = 'SELECT * FROM '.static::$tableName;
		$stmt = self::connection()->prepare($sql);
		if($stmt->execute() === true){
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
			return is_array($res)?$res:false;
		}
	}

	public static function find($pk)
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' WHERE '. static::$primaryKey . ' = ?';
		$stmt = self::connection()->prepare($sql);
		if($stmt->execute(array($pk)) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}

	public static function first()
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' limit 1';
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute(array()) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}
	public static function last()
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' limit '.($this->count()-1)	.' , 1';
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute(array()) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}

	public static function where(...$input)
	{
		$vals = array();
		$size = count($input);
		$sql = 'SELECT * FROM '.static::$tableName;
		if($size == 2)
		{
			$sql .= ' WHERE '.$input[0]. ' = ? ';
			array_push($vals, $input[1]);
		}elseif ($size == 3) {
			$sql .= ' WHERE '.$input[0]. ' '.$input[1] .' ? ';
			array_push($vals, $input[2]);
		}elseif ($size >= 7 && ($size - 3) % 4 == 0) {
			
			for($i=0;$i<$size;$i++)
			{
				if ($i===0) {
					$sql .= ' WHERE '.$input[$i]. ' '.$input[$i+1] .' ? ';					
					array_push($vals, $input[$i+2]);
					$i=$i+2;
					
				}else{
					$sql .= $input[$i].'  '.$input[$i+1]. ' '.$input[$i+2] .' ? ';
					
					array_push($vals, $input[$i+3]);
					$i=$i+3;
				}
			}
			
		}else{
			$sql .= ' WHERE 1 <> 1';
		}
		$stmt = self::connection()->prepare($sql);
		if($stmt->execute($vals) === true){
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
			return is_array($res)?$res:false;
		}
			
	}
	public static function count()
	{
		$sql  = 'SELECT * FROM '.static::$tableName;
		$stmt = self::connection()->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();
	}

	/**
	*	create
	*	update
	*	delete
	*	find
	*	all
	*	where
	*	count
	*	first
	*	last
	* 	Inserted
	***/
}

/*class Model
{

	public $cnx;

	private function connection()
	{
		if($this->cnx == null){
			$connection = require_once __CONFIG__.'connection.php';
			extract($connection);
			try
			{
				$this->cnx = new PDO($PROVIDER.'://hostname = '.$HOSTNAME.';dbname='.$DATABASENAME.';',$USERNAME,$PASSWORD);
			}catch(PDOException $er)
			{
				die('coulde not connect to database');
			}
		}
		return $this->cnx;
	}

	private function getColumns()
	{
		$cols='';
		foreach (static::$tableSchema as $column => $type) {	

			if($this->$column !== null)
			{	
				if($column === static::$primaryKey){
					if($this->id === null){
						$cols .= $column ." = ? ,";
					}
				}else{
					$cols .= $column ." = ? ,";
				}				
			}
		}		
		return trim($cols,',');
	}

	private function getValues()
	{
		$val ='';
		foreach (static::$tableSchema as $column => $type) {
			if($this->$column !== null)
			{
				if($column === static::$primaryKey){
					if($this->id === null){
						$val .= $this->filterTags($this->$column).",";
					}
				}else{
					$val .= $this->filterTags($this->$column) .",";
				}
			}
		}
		return explode(',',trim($val,','));
	}
	private function filterTags($str){
		return htmlentities(strip_tags(trim($str)));
	}

	public function save()
	{
		$sql = 'INSERT INTO '. static::$tableName . ' SET '. self::getColumns();
		$stmt = $this->connection()->prepare($sql);

		pre($this->connection());
		pre($this->getColumns());
		pre($this->getValues());die;
		return $stmt->execute($this->getValues());
	}

	public function update()
	{
		try{
		$sql = 'UPDATE '. static::$tableName . ' SET '. $this->getColumns() . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
			$stmt = $this->connection()->prepare($sql);
			return $stmt->execute($this->getValues());
		}catch(PDOException $er){
			return false;
		}
		
	}

	public function delete()
	{
		try{
			$sql = 'DELETE FROM '. static::$tableName . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
			$stmt = $this->connection()->prepare($sql);
			$stmt->execute();
		}catch(PDOException $er){
			return false;
		}
	}

	public function save($op){
		switch ($op) {
			case 'add':
				$this->create();
				break;
			case 'delete':
				$this->delete();
				break;
			case 'update':
				$this->update();
				break;
			default:
				return;
		}
	}

	public static function all()
	{
		$sql = 'SELECT * FROM '.static::$tableName;
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute() === true){
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
			return is_array($res)?$res:false;
		}
	}

	public static function find($pk)
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' WHERE '. static::$primaryKey . ' = ?';
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute(array($pk)) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}

	public static function first()
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' limit 1';
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute(array()) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}
	public static function last()
	{
		$sql = 'SELECT * FROM '.static::$tableName . ' limit '.($this->count()-1)	.' , 1';
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute(array()) === true )
		{
			$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
			return !empty($obj)?array_shift($obj):false;
		} 
		return false;
	}

	public static function where(...$input)
	{
		$vals = array();
		$size = count($input);
		$sql = 'SELECT * FROM '.static::$tableName;
		if($size == 2)
		{
			$sql .= ' WHERE '.$input[0]. ' = ? ';
			array_push($vals, $input[1]);
		}elseif ($size == 3) {
			$sql .= ' WHERE '.$input[0]. ' '.$input[1] .' ? ';
			array_push($vals, $input[2]);
		}elseif ($size >= 7 && ($size - 3) % 4 == 0) {
			
			for($i=0;$i<$size;$i++)
			{
				if ($i===0) {
					$sql .= ' WHERE '.$input[$i]. ' '.$input[$i+1] .' ? ';					
					array_push($vals, $input[$i+2]);
					$i=$i+2;
					
				}else{
					$sql .= $input[$i].'  '.$input[$i+1]. ' '.$input[$i+2] .' ? ';
					
					array_push($vals, $input[$i+3]);
					$i=$i+3;
				}
			}
			
		}else{
			$sql .= ' WHERE 1 <> 1';
		}
		$stmt = $this->connection()->prepare($sql);
		if($stmt->execute($vals) === true){
			$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
			return is_array($res)?$res:false;
		}
			
	}
	public static function count()
	{
		$sql  = 'SELECT * FROM '.static::$tableName;
		$stmt = $this->connection()->prepare($sql);
		$stmt->execute();
		return $stmt->rowCount();
	}

	/**
	*	create
	*	update
	*	delete
	*	find
	*	all
	*	where
	*	count
	*	first
	*	last
	* 	Inserted
	**
}
*/




/*
	class Model extends Database
	{
		private function getColumns()
		{
			$cols='';
			foreach (static::$tableSchema as $column => $type) {			
				if($this->$column!=null)
				{
					if($column === static::$primaryKey){
						if($this->id === null){
							$cols .= $column ." = ? ,";
						}
					}else{
						$cols .= $column ." = ? ,";
					}				
				}
			}		
			return trim($cols,',');
		}

		private function getValues()
		{
			$val ='';
			foreach (static::$tableSchema as $column => $type) {
				if($this->$column!=null)
				{
					if($column === static::$primaryKey){
						if($this->id === null){
							$val .= $this->filterTags($this->$column).",";
						}
					}else{
						$val .= $this->filterTags($this->$column) .",";
					}
				}
			}
			return explode(',',trim($val,','));
		}

		private function filterTags($str){
			return htmlentities(strip_tags(trim($str)));
		}
		public function save()
		{
			$sql = 'INSERT INTO '. static::$tableName . ' SET '. $this->getColumns();
			$stmt = static::getInstance()->connection()->prepare($sql);
			pre($this->getValues());die;
			return $stmt->execute($this->getValues());
		}

		protected function update()
		{
			try{
			$sql = 'UPDATE '. static::$tableName . ' SET '. $this->getColumns() . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
				$stmt = static::getInstance()->connection()->prepare($sql);
				return $stmt->execute($this->getValues());
			}catch(PDOException $er){
				return false;
			}
			
		}

		protected function delete()
		{
			try{
				$sql = 'DELETE FROM '. static::$tableName . ' WHERE '.static::$primaryKey . ' = ' . $this->{static::$primaryKey};
				$stmt = static::getInstance()->connection()->prepare($sql);
				$stmt->execute();
			}catch(PDOException $er){
				return false;
			}
		}

		protected static function all()
		{
			$sql = 'SELECT * FROM '.static::$tableName;
			$stmt = static::getInstance()->connection()->prepare($sql);
			if($stmt->execute() === true){
				$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
				return is_array($res)?$res:false;
			}
		}

		protected static function find($pk)
		{
			$sql = 'SELECT * FROM '.static::$tableName . ' WHERE '. static::$primaryKey . ' = ?';
			$stmt = static::getInstance()->connection()->prepare($sql);
			if($stmt->execute(array($pk)) === true )
			{
				$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
				return !empty($obj)?array_shift($obj):false;
			} 
			return false;
		}

		protected static function first()
		{
			$sql = 'SELECT * FROM '.static::$tableName . ' limit 1';
			$stmt = static::getInstance()->connection()->prepare($sql);
			if($stmt->execute(array()) === true )
			{
				$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
				return !empty($obj)?array_shift($obj):false;
			} 
			return false;
		}
		protected static function last()
		{
			$sql = 'SELECT * FROM '.static::$tableName . ' limit '.($this->count()-1)	.' , 1';
			$stmt = static::getInstance()->connection()->prepare($sql);
			if($stmt->execute(array()) === true )
			{
				$obj = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null);
				return !empty($obj)?array_shift($obj):false;
			} 
			return false;
		}

		protected static function where(...$input)
		{
			$vals = array();
			$size = count($input);
			$sql = 'SELECT * FROM '.static::$tableName;
			if($size == 2)
			{
				$sql .= ' WHERE '.$input[0]. ' = ? ';
				array_push($vals, $input[1]);
			}elseif ($size == 3) {
				$sql .= ' WHERE '.$input[0]. ' '.$input[1] .' ? ';
				array_push($vals, $input[2]);
			}elseif ($size >= 7 && ($size - 3) % 4 == 0) {
				
				for($i=0;$i<$size;$i++)
				{
					if ($i===0) {
						$sql .= ' WHERE '.$input[$i]. ' '.$input[$i+1] .' ? ';					
						array_push($vals, $input[$i+2]);
						$i=$i+2;
						
					}else{
						$sql .= $input[$i].'  '.$input[$i+1]. ' '.$input[$i+2] .' ? ';
						
						array_push($vals, $input[$i+3]);
						$i=$i+3;
					}
				}
				
			}else{
				$sql .= ' WHERE 1 <> 1';
			}
			$stmt = static::getInstance()->connection()->prepare($sql);
			if($stmt->execute($vals) === true){
				$res = $stmt->fetchAll(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE,get_called_class(),null); 
				return is_array($res)?$res:false;
			}
				
		}
		protected static function count()
		{
			$sql  = 'SELECT * FROM '.static::$tableName;
			$stmt = static::getInstance()->connection()->prepare($sql);
			$stmt->execute();
			return $stmt->rowCount();
		}

		public static function countFromQuery($query){
			$stmt = static::getInstance()->connection()->prepare($query);
			$stmt->execute();
			return $stmt->rowCount();
		}
		/**
		*	create
		*	update
		*	delete
		*	find
		*	all
		*	where
		*	count
		*	first
		*	last
		* 	Inserted
		**
	}
}
*/



