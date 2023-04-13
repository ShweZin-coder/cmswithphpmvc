<?php

define('ROOT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('VIEW_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);

session_start();
require_once ROOT_PATH .'src/Controller.php';
require_once ROOT_PATH .'src/Template.php';
require_once ROOT_PATH .'src/DatabaseConnection.php';
require_once ROOT_PATH .'src/Entity.php';
require_once ROOT_PATH .'src/Router.php';
require_once ROOT_PATH .'model/Page.php';

// Database Connection
// connect to database
DatabaseConnection::connect('localhost','cmsdb','root','');

// if / else logic 

$action = $_GET['seo-name'] ?? 'home';
// connecting database for query
$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();
$router = new Router($dbc);
$router->findBy('pretty_url',$action);
$action = $router->action != '' ? $router->action : 'default';

$moduleName = ucfirst($router->module).'Controller';

if(file_exists(ROOT_PATH .'controller/'.$moduleName.'.php'))
{
    include ROOT_PATH .'controller/'.$moduleName.'.php';
    $controller = new $moduleName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);
}



