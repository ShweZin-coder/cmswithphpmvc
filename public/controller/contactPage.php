<?php

class ContactController extends Controller{
    function defaultAction()
    {
        // view contact us 
        include 'view/contact-us.html';
    }
    function submitContactAction()
    {
          // view thank-you page
        include 'view/contact-thank-you.html';
    }
}

