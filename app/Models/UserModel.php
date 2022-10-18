<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'email', 'admin'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function checkAdmin($id){
        $db = \Config\Database::connect();
        $builder = $db->table("users");
        $builder->select("admin")->where("id", $id);
        $adminCheck = $builder->get()->getResult();
        $adminCheck = json_decode(json_encode($adminCheck), true);

        $reutrnVal = false;

        if (count($adminCheck) > 0){
            if ($adminCheck[0]["admin"] == "1"){
                $reutrnVal = true;
            }
        }

        return $reutrnVal;
    }

    public function getIdFromUser($username){
        $db = \Config\Database::connect();
        $builder = $db->table("users");
        $userList = $builder->get()->getResult();
        $userList = json_decode(json_encode($userList), true);

        $id = 0;

        foreach($userList as $user){
            if ($user["username"] == $username){
                $id = $user["id"];
            }
        }
        
        return $id;
    }
}
