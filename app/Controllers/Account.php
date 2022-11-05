<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\SettingsModel;

class Account extends BaseController
{
    public function index()
    {
        $session = session();
        $settingsModel = new SettingsModel();

        $data = [
            "site_title" => "Your Account",
            "settings" => $settingsModel->getSettingsUser($session->get("id"))
        ];

        return view("account", $data);
    }

    public function updateSetting(){
        $settingsModel = new SettingsModel;

        if (isset($_POST["settingName"])){
            $session = session();
            $name = esc($_POST["settingName"]);
            $active = esc($_POST["active"]);

            $return = $settingsModel->changeActive($session->get("id"), $name, $active);
            return json_encode(["success" => $return]);
        }

        return json_encode(["success" => false]);
    }
}