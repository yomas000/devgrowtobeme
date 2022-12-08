<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table      = 'adminSettings';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'value', "active"];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function checkAlert(){
        $db = \Config\Database::connect();
        $builder = $db->table("adminSettings");

        $builder->where('name', "alert");

        $setting = json_decode(json_encode($builder->get()->getResult()), true)[0]["active"];

        if ($setting){
            return true;
        }else{
            return false;
        }
    }
    public function getAlert(){
        $db = \Config\Database::connect();
        $builder = $db->table("adminSettings");

        $builder->where('name', "alert");

        $setting = json_decode(json_encode($builder->get()->getResult()), true)[0]["value"];

        return $setting;
    }

    public function getSetting($settingName, $selection){
        $db = \Config\Database::connect();
        $builder = $db->table("adminSettings");

        $builder->select($selection);
        $builder->where('name', $settingName);

       return json_decode(json_encode($builder->get()->getResult()), true)[0][$selection];
    }
}
