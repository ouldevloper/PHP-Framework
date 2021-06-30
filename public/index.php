<?php

use OULDEVELOPER\LIBRARIES\Application;
use OULDEVELOPER\LIBRARIES\Session;

require_once '..'.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php';
require_once  __SYS__.'autoload.php';
require_once  __SYS__.'application.php';
require_once  __SYS__.'helper.php';
require_once  __APP__.'..'.DS.'Routes'.DS.'web.php';

$app = Application::getInstance();
$app->run();


