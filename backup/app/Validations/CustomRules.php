<?php 
namespace App\Validations;
use App\Models\UserModel;

class CustomRules{
    function blackListCheck(string $str, string &$error = null) : bool{
        $names = ["fuck", "allah", "damn", "niger", "urmom", "dick", "ass", "bitch"]; //TODO: https://www.cs.cmu.edu/~biglou/resources/bad-words.txt (DB PLEASE)

        foreach($names as $name){
            if (strpos(strtolower($str), $name) !== false){
                return false;
            }
        }

        return true;
    }

    function othername($str) : bool{
        $model = new UserModel;

        $users = $model->findColumn("username");

        foreach($users as $user){
            if ($user == $str){
                return false;
            }
        }
        
        return true;
    }
}

?>
