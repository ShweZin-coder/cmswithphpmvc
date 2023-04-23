<?php 

namespace src;
use modules\user\models\User;
class Auth{
    function checkLogin($username,$password)
    {
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();

        $userObj = new User($dbc);
        $userObj->findBy('username',$username);
        if(property_exists($userObj,'id'))
        {
            //if($userObj->password == md5($password . ENCRYPTION_SALT. $userObj->password_hash))
            if(password_verify($password,$userObj->password))
            {
                return true;
            }
        }
        return false;
    }
    function changeUserPassword($userObj, $newPassword)
    {
        // $tmp = date('YmdHis') . 'secrect_string2395493053';
        // $hash = md5($tmp);
        // $hashedpassword = md5($newPassword . ENCRYPTION_SALT. $hash);
        // $userObj->password = $hashedpassword;
        // $userObj->password_hash = $hash;
        $userObj->password = password_hash($newPassword,PASSWORD_DEFAULT);
        return $userObj;
    }
}