<?php

define('ROOT_PATH',dirname(__FILE__).DIRECTORY_SEPARATOR);
define('VIEW_PATH',ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);

session_start();
require_once ROOT_PATH .'src/Controller.php';
require_once ROOT_PATH .'src/Template.php';
require_once ROOT_PATH .'src/DatabaseConnection.php';
require_once ROOT_PATH .'model/Page.php';

// Database Connection
// connect to database
DatabaseConnection::connect('localhost','cmsdb','root','');

// if / else logic 

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';

$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


if ($section=='about-us') {
    
    include ROOT_PATH .'controller/aboutUsController.php';
    $aboutUsController = new AboutUsController();
    $aboutUsController->runAction($action);
} else if ($section == 'contact'){
    include ROOT_PATH .'controller/contactController.php';
    $contactController = new ContactController();
    $contactController->runAction($action);
} else {
    include ROOT_PATH . 'controller/homePageController.php';
    $homePageController = new HomePageController();
    $homePageController->runAction($action);
}




