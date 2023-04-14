<?php

class DashboardController extends Controller{

    function runBeforeAction()
    {
        if($_SESSION['is_admin'] ?? false == true)
        {
            return true;
        }

        $action = $_GET['action'] ?? $_POST['action'] ?? 'default';
        if($action != 'login')
        {
            header('Location: index.php?module=dashboard&action=login');
        }
        else
        {
            return true;
        }
       
    }

    function defaultAction()
    {
       echo "Welcome to our dashboard";
    }
    function loginAction()
    {
        if($_POST['postAction'] ?? 0 == 1)
        {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            // if(!$validation->validatePassword($password))
            // {
            //     $_SESSION['validationRules']['error'] = "Password must be between 3 and 20 characters".
            //                                             " and must contain one special character.";
            // }
            // if(!$validation->validateUsername($username))
            // {
            //     $_SESSION['validationRules']['error'] = "User name must be between 3 and 20 characters".
            //                                             " and must be a validated email.";
            // }
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
                    $_SESSION['validationRules']['errors'] = "Username and password is incorrect.";
                }
            }
            
        }
        include VIEW_PATH. 'admin/login.html';
        unset($_SESSION['validationRules']['errors']);
       
    }
}

