<?php

define('ROOT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
define('VIEW_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT','2394f448393r438ruf8r43398r432iru');

session_start();

use src\DatabaseConnection;
use src\Template;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use modules\page\models\Page;
spl_autoload_register(function ($class_name) {

    $file = ROOT_PATH . str_replace('\\', '/', $class_name) . '.php';

    if(file_exists($file))
    {
        require $file;
    }

    // if(file_exists(ROOT_PATH .'src/'.$class_name . '.php'))
    // {
    //     include ROOT_PATH .'src/'.$class_name . '.php';
    // }
    // // else if(ROOT_PATH .'src/validationRules/'.$class_name . '.php')
    // // {
    // //     include ROOT_PATH .'src/validationRules/'.$class_name . '.php';
    // // }
    // else if(MODULE_PATH .'page/models/'.$class_name . '.php'){
    //     include MODULE_PATH .'page/models/'.$class_name . '.php';
    // }
    // else if(MODULE_PATH .'user/models/'.$class_name . '.php'){
    //     include MODULE_PATH .'user/models/'.$class_name . '.php';
    // }
});

require '../../vendor/autoload.php';

// require_once ROOT_PATH .'src/interfaces/ValidationRuleInterface.php';
// require_once ROOT_PATH .'src/DatabaseConnection.php';
// require_once ROOT_PATH .'src/Entity.php';
// require_once MODULE_PATH .'page/models/Page.php';
// require_once ROOT_PATH .'src/Template.php';
// require_once ROOT_PATH .'src/Auth.php';
// require_once ROOT_PATH .'src/validationRules/ValidateEmail.php';
// require_once ROOT_PATH .'src/validationRules/ValidateMaximum.php';
// require_once ROOT_PATH .'src/validationRules/ValidateMinimum.php';
// require_once ROOT_PATH .'src/validationRules/ValidateSpecialCharacters.php';
// require_once ROOT_PATH .'src/Validation.php';
// require_once ROOT_PATH .'src/Controller.php';
// require_once MODULE_PATH .'user/models/User.php';


// Database Connection
// connect to database
DatabaseConnection::connect('localhost','cmsdb','root','');

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

// if / else logic 

$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



if ($module=='dashboard') {
    
    include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';
    
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    
}
else if($module == 'page')
{
    
    include MODULE_PATH . 'page/admin/controllers/PageController.php';
    
    
    // create a log channel
    $log = new Logger('name');
    $log->pushHandler(new StreamHandler('path/to/your.log', Level::Warning));
    $pageController = new PageController();
    $pageController->dbc = $dbc;
    $pageController->log = $log;
    $pageController->template = new Template('admin/layout/default');
    $pageController->runAction($action);
}

// $userObj = new User($dbc);
// $userObj->findBy('username','admin');

// $authObj = new Auth();
// $authObj = $authObj->changeUserPassword($userObj,'Sz@123');
//var_dump($authObj);