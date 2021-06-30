<?php

namespace OULDEVELOPER\Controllers\Errors;
use OULDEVELOPER\LIBRARIES\Controller;
class ErrorController extends Controller
{
    public function NotFoundAction(){
       return $this->view();
    }
}



