<?php

class ContactController extends Controller{
    function runBeforeAction()
    {
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1)
        {
            // view already submitted page
            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findById(4);
            $variables['pageObj']= $pageObj;
            $template = new Template('layout');
            $template->view('static-page',$variables);
            return false;
        }
        return true;
    }
    function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findById(3);
        $variables['pageObj']= $pageObj;
        $template = new Template('layout');
        $template->view('contact/contact-us',$variables);
    }
    function submitContactAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;
        // view thank-you page
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findById(4);
        $variables['pageObj']= $pageObj;
        $template = new Template('layout');
        $template->view('static-page',$variables);
        return false;
    }
}

