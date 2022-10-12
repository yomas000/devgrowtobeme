<?php

namespace App\Controllers;

use App\Models\FeedbackModel;

class Feedback extends BaseController
{
    public function index()
    {
       $model = new FeedbackModel();

       if (isset($_POST["feedback"])){
        $session = session();
        $feedback = esc(htmlspecialchars($_POST["feedback"]));

        $data = [
            "userid" => $session->get("id"),
            "feedback" => $feedback
        ];

        $model->insert($data);
       }

       return json_encode($data);
    }
}