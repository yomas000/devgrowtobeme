<?php

namespace App\Controllers;

use App\Models\UserModel;

class Admin extends BaseController
{
    public function index()
    {
        $session = session();
        $model = new UserModel();

        if ($session->get("admin")){
            $data = [
                "site_title" => "Admin Page"
            ];
            return view("adminView", $data);
        }else{
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function auth(){
        $check_sum = 123456;
        $sub_num = esc(htmlspecialchars($_POST["confCode"]));

        if ($check_sum == $sub_num){
            $data = [
                "site_title" => "Control Panel"
            ];
            return view("adminPage", $data);
        }
    }
}
