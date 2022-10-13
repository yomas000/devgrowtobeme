<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['username', 'password', 'email'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getId($username){
        
    }

    public function checkAdmin($id){
        $db = \Config\Database::connect();
        $builder = $db->table("users");
        $builder->select("id")->where("id", 1);
        $userList = $builder->get()->getResult();
        $userList = json_decode(json_encode($userList), true);

        foreach($userList as $user){
            if($user == $id){
                return true;
            }   
        }

        return false;
    }
}
