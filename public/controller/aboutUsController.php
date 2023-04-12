<?php

class AboutUsController extends Controller{
    function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findById(2);
        $variables['pageObj']= $pageObj;
        $template = new Template('layout');
        $template->view('static-page',$variables);
    }
}

