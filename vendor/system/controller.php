<?php


namespace OULDEVELOPER\LIBRARIES;

    use OULDEVELOPER\LIBRARIES\Helper;
    use OULDEVELOPER\LIBRARIES\Html;
    use OULDEVELOPER\LIBRARIES\Validation;
    use OULDEVELOPER\LIBRARIES\Template;
    class Controller 
    {
        use Template;
        use Validation;
        private $controller;
        private $action;
        private $params;
        private $data;

        public function setController($controllerName){
            $this->controller  = $controllerName;
        }
        public function setAction($actionName){
            $this->action = $actionName;
        }
        public function setParams($paramsList){
            $this->params = $paramsList;
        }
        public function setData($data){
            $this->data = $data;
        }
        public function notfound(){
            return $this->view();
        }
        public function noviewfound(){
            return $this->view();
        }
        public function view($data=array()){
            $header = __VIEW__.'layout'.DS.'header.php';
            $footer = __VIEW__.'layout'.DS.'footer.php';
            if(file_exists($header)){
                $this->render($header,'header');
                require_once __CACHE_VIEW__.'header.php';
            }
            if($this->action == 'NotFoundAction'  ){
                require_once __VIEW__  . 'error' . DS .'notfound.php';
            }else{
                $view = __VIEW__ . $this->controller . DS . $this->action . '.php';
                if(file_exists($view))
                {
                    extract($this->params);
                    extract($data);
                    $this->render($view);
                    require_once __CACHE_VIEW__.'view.php';
                }else{
                    require_once __VIEW__  . 'error' . DS . 'noviewfound.php';
                }
            }

            if(file_exists($footer)){
               $this->render($footer,'footer');
               require_once __CACHE_VIEW__.'footer.php';
            }

        }
    }



