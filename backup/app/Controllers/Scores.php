<?php

namespace App\Controllers;
use App\Models\ScoreModel;

class Scores extends BaseController
{
    public function index()
    {
      if (isset($_POST["id"])){
        $session = session();
        $model = new ScoreModel();
        $gameId = esc(htmlspecialchars($_POST["id"]));
        $score = esc(htmlspecialchars($_POST["score"]));

        return json_encode($model->setScore($session->get("id"), $gameId, $score));

       }
    }

    public function game($id){
        $id = esc(htmlspecialchars($id));
        $model = new ScoreModel();

        $data = [
            "site_title" => "Scores",
            "scores" => $model->getScoresForGameId($id)
        ];

        return view("scoreTable", $data);
    } 
}