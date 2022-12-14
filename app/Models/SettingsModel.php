<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table      = 'usersettings';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['userid','setting', 'active'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function makeSetting($settingName, $settingValue, $settingActive = false){
        $db = \Config\Database::connect();
        $builder = $db->table("usersettings");

        $usermodel = new UserModel();

        $ids = $usermodel->findColumn("id");

        foreach($ids as $id){
            $data = [
                "userid" => $id,
                "setting" => $settingName,
                "value" => $settingValue,
                "active" => $settingActive
            ];

            $builder->insert($data);
        }
    }

    public function changeActive($id, $settingName, $active){
        $db = \Config\Database::connect();
        $builder = $db->table("usersettings");

        $data = [];

        if ($active == "true"){
            $data = [
                "active" => 1
            ];
        }else{
            $data = [
                "active" => 0
            ];
        }

        $builder->where('userid', $id);
        $builder->where("setting", $settingName);

        return $builder->update($data);

    }

    public function getSettingUser($id, $setting){
        $db = \Config\Database::connect();
        $builder = $db->table("usersettings");
        $builder->select("setting, active");

        $builder->where("userid", $id);
        $builder->where("setting", $setting);

        return json_decode(json_encode($builder->get()->getResult()), true)[0];
    }

    public function getSettingsUser($id){
        $db = \Config\Database::connect();
        $builder = $db->table("usersettings");
        $builder->select("setting, active");

        $builder->where("userid", $id);

        return json_decode(json_encode($builder->get()->getResult()), true);
    }

    public function getAllSettings(){

    }

    public function makeSettingUser($id){
        $adminModel = new AdminModel();

        $settings = explode(',', $adminModel->getSetting('userSettings', 'value'));

        foreach($settings as $setting){
            $db = \Config\Database::connect();
            $builder = $db->table("userSettings");

            $data = [
                "userid" => $id,
                "setting" => $setting,
                "active" => 0
            ];

            $builder->insert($data);
        }
    }

    public function initSettingsTable(){
        $adminModel = new AdminModel();
        $userModel = new UserModel();

        $settingNames = explode(',', $adminModel->getSetting("userSettings", "value"));
        $ids = $userModel->getAllUserIds();

        for ($i = 0; $i < count($settingNames); $i++){
            for ($j = 0; $j < count($ids); $j++){
                $data = [
                    "userid" => $ids[$j],
                    "setting" => $settingNames[$i],
                    "active" => 0
                ];
                $this->insert($data);
            }
        }
    }
}
