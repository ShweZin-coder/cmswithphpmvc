<?php

class PageController extends Controller{
    function defaultAction()
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $pageObj = new Page($dbc);
        $pageObj->findBy('id',$this->entityId);
        $variables['pageObj']= $pageObj;
        $template = new Template('layout');
        $template->view('page/views/static-page',$variables);
    }
}

