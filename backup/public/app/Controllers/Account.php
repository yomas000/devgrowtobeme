<?php

namespace App\Controllers;

use App\Models\GameModel;

class Account extends BaseController
{
    public function index()
    {
        $session = session();
        $data = [
            "site_title" => "Your Account"
        ];
        return view("account", $data);
    }
}