<?php
require_once('CSVHelper.php');
class AuthHelper{
    private static $obfuscator='<?php die() ?>';

    static function signup($email,$password){
        if(CSVHelper::find('users.csv.php',$email)==False){
            $fh = fopen('users.csv.php', 'a+');
            fputs($fh, $email.",". password_hash($password, PASSWORD_DEFAULT) . PHP_EOL);
            fclose($fh);
            echo "You created your account. Sign in please.";
            return;
        }
        else{
            echo "Email is already in uses";
        }
    }

    static function signin($email,$password){
        if (isset($_SESSION['logged']) && $_SESSION['logged']== true) {
            echo "Already Signed In";
            return;
        }
        $fh = fopen('users.csv.php', 'r');
        while ($line = fgets($fh)) {
            $line = trim($line);
            $line = explode(',', $line);
            if ($line[0] == $email) {
                if (password_verify($password, $line[1])) {
                    $_SESSION['logged'] = true;
                    $_SESSION['email'] = $line[0];
                    echo "you have signed in!";
                    return True;
                } else{
                    echo 'You\'re password didn\'t match our records';
                    return FALSE;
                } 
            }
        }
        fclose($fh);
        echo "you must create an account first";
        return false;
    }

    static function signout(){
        // if(!isset($_SESSION['logged'])){
        //     echo "Already Signed Out";
        //     return;
        // }else{
            $_SESSION=[];
            session_destroy();
            echo "You sucessfully sign out";
            return;
        // }
        
    }

    static function loggedin(){
        if (isset($_SESSION['logged']) && $_SESSION['logged']== true) {
            echo $_SESSION['email']. " is currently active";
            return true;
        }
        else{
            echo "not logged in";
            return false;
        }

    }

}