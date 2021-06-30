<?php

namespace OULDEVELOPER\CONSOLE;


class Controller
{
    private $main;
    public function __construct(Main $main)
    {
        $this->main = $main;
    }
    private function data(){
        return "<?php\r\n\r\nnamespace OULDEVELOPER\\Controllers;\r\nuse OULDEVELOPER\\LIBRARIES\\Controller;\r\n\r\nclass ".ucfirst($this->main->_stuff_name)."Controller extends Controller{\r\n\r\n}";
    }
    public function make(){
        $path = __APP__.'controllers'.DIRECTORY_SEPARATOR.strtolower($this->main->_stuff_name).'controller.php';
        if(!file_exists($path)) {
            $file = fopen($path, "w+");
            fwrite($file, $this->data());
            fclose($file);
            echo ucfirst($this->main->_stuff_name)."Controller Has Been Created !.\r\n";
        }else{
            echo ucfirst($this->main->_stuff_name)."Controller Already Exist !.\r\n";
        }
    }
}