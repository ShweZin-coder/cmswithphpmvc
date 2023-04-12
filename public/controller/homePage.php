<?php

class HomePageController extends Controller{
    function defaultAction()
    {
        $variables['title'] = "Home Page Title";
        $variables['content'] = "Welcome to our Home Page";
        $template = new Template('layout');
        $template->view('static-page',$variables);
    }
}