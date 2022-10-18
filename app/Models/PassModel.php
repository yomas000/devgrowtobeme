<?php

namespace App\Models;

use CodeIgniter\Model;

class PassModel extends Model
{
    protected $table      = 'pass_reset_keys';
    protected $primaryKey = 'userid';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['userid', 'reset_key'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function checkKey($num){
        $db = \Config\Database::connect();
        $builder = $db->table("pass_reset_keys");
        $builder->select("reset_key");
        $builder->where("reset_key", $num);
        $key = json_decode(json_encode($builder->get()->getResult()), true);

        if ($key[0]["reset_key"] == $num){
            return true;
        }else{
            return false;
        }
    }

}
