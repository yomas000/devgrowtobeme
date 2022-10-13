<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Admin extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get("admin")){
            $data = [
                "site_title" => "Admin Page"
            ];

            return view("adminView", $data);
        }else{
            
        }
    }

    public function auth(){
        $check_sum = 123456;
        $sub_num = esc(htmlspecialchars($_POST["confCode"]));
    }
}
