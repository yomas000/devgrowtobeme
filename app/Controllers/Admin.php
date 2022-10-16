<?php

namespace App\Controllers;

use App\Models\GameModel;

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

        $check_sum = 123456;
        $sub_num = esc(htmlspecialchars($_POST["confCode"]));
        $gameModel = new GameModel();

        if ($check_sum == $sub_num){
            $data = [
                "site_title" => "Control Panel",
                "gameList" => $gameModel->findAll()
            ];
            return view("adminPage", $data);
        }
    }
}
