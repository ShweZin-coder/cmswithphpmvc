<?php

use src\Validation;
use src\validationRules\ValidateEmail;
use src\validationRules\ValidateMaximum;
use src\validationRules\ValidateMinimum;
use src\validationRules\ValidateSpecialCharacters;
use src\Auth;
class DashboardController extends src\Controller{

    function runBeforeAction()
    {
        if($_SESSION['is_admin'] ?? false == true)
        {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if($action != 'login')
        {
            header('Location: index.php?module=dashboard');
        }
        else
        {
            return true;
        }
       
    }

    function defaultAction()
    {
        $variables = [];
        header('Location: index.php?module=page');
        exit();
    }
    function loginAction()
    {
        if($_POST['postAction'] ?? 0 == 1)
        {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
            $validation = new Validation();
            if(!$validation
                           ->addRule(new ValidateMinimum(3))
                           ->addRule(new ValidateMaximum(20))
                           ->addRule(new ValidateSpecialCharacters())
                           ->validate($password))
            {
                $_SESSION['validationRules']['errors'] = $validation->getAllErrorMessages();
            }

            if(!$validation
                           ->addRule(new ValidateMinimum(3))
                           ->addRule(new ValidateMaximum(20))
                           ->addRule(new ValidateEmail())
                           ->validate($username))
            {
                $_SESSION['validationRules']['errors'] = $validation->getAllErrorMessages();
            }
            
            if(($_SESSION['validationRules']['errors'] ?? '') == '')
            {
                $auth = new Auth();
                if($auth->checkLogin($username,$password))
                {
                    $_SESSION['is_admin'] = 1;
                    header('Location: index.php');
                    exit();
                }
                else
                {
                    $_SESSION['validationRules']['errors'][] = "Username and password is incorrect.";
                }
            }
            
        }
        include VIEW_PATH. 'admin/login.html';
        unset($_SESSION['validationRules']['errors']);
       
    }
}

