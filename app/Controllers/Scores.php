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
        $scores = $model->getScoresForGameId($id);

        for ($i = 0; $i < count($scores); $i++){ //Remove users of 0 score
                if ($scores[$i]['score'] == '0'){
                    unset($scores[$i]);
                }
        }


        if (count($scores) == 1) {
            foreach($scores as $score){ //I don't know which index is left in the array so I have to use a foreach loop
                if ($score['score'] == '0'){
                    $scores = [];
                }
            }
        }

        $data = [
            "site_title" => "Scores",
            "scores" => $scores
        ];

        return view("scoreTable", $data);
    } 
}