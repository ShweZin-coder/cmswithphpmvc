<?php

class AboutUsController extends Controller{
    function defaultAction()
    {
        $variables['title'] = "About Us Page Title";
        $variables['content'] = "Welcome to our About Us Page";
        $template = new Template('layout');
        $template->view('static-page',$variables);
    }
}

