<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Admin extends BaseController
{
    public function index()
    {   
        mail("thomas.ed.dick@gmail.com", "Sent from server", "Hello from growtobeme");
        return "Maybe";
    }
}
