<?php

define('ROOT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR);
define('VIEW_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);
define('ENCRYPTION_SALT','2394f448393r438ruf8r43398r432iru');

session_start();
require_once ROOT_PATH .'src/DatabaseConnection.php';
require_once ROOT_PATH .'src/Entity.php';
require_once ROOT_PATH .'src/Auth.php';
require_once ROOT_PATH .'src/Validation.php';
require_once ROOT_PATH .'src/Controller.php';
require_once MODULE_PATH .'user/models/User.php';


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
    $dashboardController->runAction($action);
    
}

$userObj = new User($dbc);
$userObj->findBy('username','admin');

$authObj = new Auth();
$authObj = $authObj->changeUserPassword($userObj,'Sz@123');
//var_dump($authObj);