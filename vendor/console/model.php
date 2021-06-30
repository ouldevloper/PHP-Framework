<?php
namespace OULDEVELOPER\CONSOLE;

use PDO;
use Exception;
use PDOException;
class Model
{
    private $main;
    private static $cnx;
    private static $select;
    private $dataType;
    private $header;      
    private $columns;        
    private $tableName;   
    private $primaryKey;    
    private $tableSchema;
    
    
    public function __construct(Main $main)
    {
        $this->dataType = array(
                            'LONG' =>       'DATA_TYPE_INT',
                            'VAR_STRING' => 'DATA_TYPE_STR',
                            'NEWDECIMAL' => 'DATA_TYPE_DECIMAL',
                            'DATE' =>       'DATA_TYPE_DATE',
                            'FLOAT' =>      'DATA_TYPE_FLOAT',
                        );
        $this->main = $main;
        self::connection();
        
    }

    private static function connection(){
        if(self::$cnx == null){
            $connection = require_once  __CONFIG__.'connection.php';
            try{
                self::$cnx = new PDO($connection['PROVIDER'].'://hostname='.$connection['HOSTNAME'].';dbname='.$connection['DATABASENAME'].';',$connection['USERNAME'],$connection['PASSWORD']);
            }catch(PDOExcption $er){
                trigger_error('Internal Error 1996...');
            }
        }
        return self::$cnx;
    }

    public function make(){
     
            $data = $this->build();
            $path = __APP__.'models'.DIRECTORY_SEPARATOR.strtolower($this->main->_stuff_name).'model.php';
            if(!file_exists($path)) {
                $file = fopen($path, "w+");
                fwrite($file, $data);
                fclose($file);
                echo ucfirst($this->main->_stuff_name)."Model Has Been Created !.\r\n";
            }else{
                echo ucfirst($this->main->_stuff_name)."Model Already Exist !.\r\n";
            }
        
        
    }
    private function build(){
        $this->setModelHeader()->setColumnsName()->setTableName()->setTableSchema();
        return $this->header.''.$this->columns.''.$this->tableName.''.$this->primaryKey.''.$this->tableSchema."\r\n\n}";
    }
    private function setModelHeader(){
        $this->header = "<?php\r\n\r\nnamespace OULDEVELOPER\\Models;\r\nuse OULDEVELOPER\\LIBRARIES\\Model;
                    \r\n\r\nclass ".ucfirst($this->main->_stuff_name)."Model extends Model{ ";
        return $this;
    }

    private function setTableName(){
        $this->tableName ="\r\n\tpublic static $".'tableName'." = '".strtolower($this->main->_stuff_name)."';";
        return $this;
    }

    private function setColumnsName(){
        $column = '';
        $count =0;
        $sth = self::$cnx->prepare('SELECT * FROM '.strtolower($this->main->_stuff_name).' limit 1 ');
        $sth->execute();
        $colcount = $sth->columnCount();
        for ($i=0; $i < $colcount; $i++) { 
            $meta = $sth->getColumnMeta($i);
            $column .= "\r\n\tpublic $".$meta['name'].';';
            if(isset($meta['flags'][1])){
                if($count ==0){
                    $this->primaryKey = "\r\n\t".'public static $'."primaryKey".' = \''.$meta['name'].'\';';
                    $count++;
                }
            }       
        }
        $this->columns = $column;
        return $this;
    }

    private function setTableSchema(){
        $tableSchema = "\r\n\tpublic static $".'tableSchema'." = array(\r\n";
        $sth = self::$cnx->prepare('SELECT * FROM '.strtolower($this->main->_stuff_name).' limit 1 ');
        $sth->execute();
        $colcount = $sth->columnCount();
        for ($i=0; $i < $colcount; $i++) { 
            $meta = $sth->getColumnMeta($i);
            $tableSchema .= "\t\t'".$meta['name']."' => ".$this->dataType[$meta['native_type']]." ,\n";
        }
        $this->tableSchema = $tableSchema . "\r\t);";;
        return $this;
    }
}




