<?php

class ContactController extends Controller{
    function runBeforeAction()
    {
        if($_SESSION['has_submitted_the_form'] ?? 0 == 1)
        {
            // view already submitted page
            $variables['title'] = "Oops";
            $variables['content'] = "You already submitted. ";
            $template = new Template('layout');
            $template->view('static-page',$variables);
            return false;
        }
        return true;
    }
    function defaultAction()
    {
        $variables['title'] = "Contact Us";
        $variables['content'] = "Tell us something";
        $template = new Template('layout');
        $template->view('contact/contact-us',$variables);
    }
    function submitContactAction()
    {
        $_SESSION['has_submitted_the_form'] = 1;
        // view thank-you page
        $variables['title'] = "Thank You";
        $variables['content'] = "We will reply in two business days";
        $template = new Template('layout');
        $template->view('static-page',$variables);
        return false;
    }
}

