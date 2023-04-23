<?php

class ContactController extends Controller{
    function runBeforeAction()
    {
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1)
        {
            // view already submitted page
            $dbh = src\DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new model\Page($dbc);
            $pageObj->findBy('id',4);
            $variables['pageObj']= $pageObj;
            $this->template->view('page/views/static-page',$variables);
            return false;
        }
        return true;
    }
    function defaultAction()
    {
        $dbh = src\DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new model\Page($dbc);
        $pageObj->findBy('id',3);
        $variables['pageObj']= $pageObj;
        $this->template->view('contact/views/contact-us',$variables);
    }
    function submitContactAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;
        // view thank-you page
        $dbh = src\DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new model\Page($dbc);
        $pageObj->findBy('id',4);
        $variables['pageObj']= $pageObj;
        $this->template->view('page/views/static-page',$variables);
        return false;
    }
}

