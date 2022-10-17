<?php

namespace App\Models;

use CodeIgniter\Model;

class ApiModel extends Model
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

    public function checkApiKey($key){
        $returnVal = false;

        $db = \Config\Database::connect();
        $builder = $db->table("api_keys");

        $builder->where('api_key', $key);

        $user = json_decode(json_encode($builder->get()->getResult()), true);

        if (count($user) > 0){
            if ($user[0]["permissions"] == 1){
                $returnVal = true;
            }
        }

        return $returnVal;
    }
}
