<?php

namespace App\Controllers;

use App\Models\GameModel;
use App\Models\UserModel;
use App\Models\AdminModel;

class Admin extends BaseController
{
    public function index()
    {
        $session = session();

        if ($session->get("admin")){
            $data = [
                "site_title" => "Admin Page",
            ];
            return view("adminView", $data);
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function auth(){
        $session = session();

        $check_sum = 9829485290;
        $sub_num = esc(htmlspecialchars($_POST["confCode"]));
        $gameModel = new GameModel();
        $userModel = new UserModel();
        $adminModel = new AdminModel();

        if ($check_sum == $sub_num){
            $data = [
                "site_title" => "Control Panel",
                "gameList" => $gameModel->findAll(),
                "userList" => $userModel->findAll(),
                "adminList" => $adminModel->findAll()
            ];
            return view("adminPage", $data);
        }
    }

    public function adminMisc(){

    }
}
