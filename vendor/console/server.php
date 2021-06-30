<?php
namespace OULDEVELOPER\CONSOLE;


class Server
{
    private $main;
    private $host;

    public function __construct(Main $main)
    {
        $this->main = $main;
        isset($this->main->_stuff_name) && $this->main->_stuff_name!= '' ? $this->host = $this->main->_stuff_name : $this->host = '127.0.0.1:9600' ;
    }

    public function start(){
        shell_exec("php -S ".$this->host." -t ".str_replace('\\','/',realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'public'));
    }
}