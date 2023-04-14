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

            $validation = new Validation();
            if(!$validation->validatePassword($password))
            {
                $_SESSION['validationRules']['error'] = "Password must be between 3 and 20 characters".
                                                        " and must contain one special character.";
            }
            if(!$validation->validateUsername($username))
            {
                $_SESSION['validationRules']['error'] = "User name must be between 3 and 20 characters".
                                                        " and must be a validated email.";
            }

            $auth = new Auth();
            if($auth->checkLogin($username,$password))
            {
                $_SESSION['is_admin'] = 1;
                header('Location: index.php');
                exit();
            }
            echo 'bad login';
        }
        include VIEW_PATH. 'admin/login.html';
    }
}

