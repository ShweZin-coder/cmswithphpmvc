<?php 
class Validation{
    public function validatePassword($password)
    {
        // minimum number of characters
        if(strlen($password) < 3)
        {
            return false;
        }
        // maximum number of characters
        if(strlen($password) > 20)
        {
            return false;
        }
        // one special character
        if(!preg_match("/[a-zA-Z0-9]+/",$password))
        {
            return false;
        }
        return true;
    }
    public function validateUsername($username)
    {
        // minimum number of characters
        if(strlen($username) < 3)
        {
            return false;
        }
        // maximum number of characters
        if(strlen($username) > 20)
        {
            return false;
        }
        if (!filter_var($username, FILTER_VALIDATE_EMAIL))
        {
            return false;
        }
        return true;
    }
}