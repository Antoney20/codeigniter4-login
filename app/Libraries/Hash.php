<?php

namespace App\Libraries;

class Hash {
    // Encrypt user password.
    
    public static function encrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Check user password with db password.
    public static function checkp($entered_password, $db_password)
    {
        if(password_verify($entered_password, $db_password))
        {
            return true; 
        }
        else{
        return false;
        }
    }
}
