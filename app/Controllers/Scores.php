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

        $gameopp = false;

        $oppgames = [4];
        foreach ($oppgames as $game) {
            if ($game == $gameId) {
                $gameopp = true;
            }
        }

        if ($gameopp){
            return json_encode($model->setScore($session->get("id"), $gameId, $score, false));
        }else{
            return json_encode($model->setScore($session->get("id"), $gameId, $score));
        }

       }
    }

    public function game($id){
        $id = esc(htmlspecialchars($id));
        $model = new ScoreModel();
        $oppgames = [4];
        $oppgame = false;

        //If game needs scores to be sorted by ascending
        foreach($oppgames as $game){
            if ($game == $id){
                $oppgame = true;
            }
        }

        if ($oppgame){
            $scores = $model->getScoresForGameId($id, false);
        }else{
            $scores = $model->getScoresForGameId($id);
        }
        

        //remove users who have a 0 score
        $len = count($scores);

        for ($i = 0; $i < $len; $i++){
                if ($scores[$i]['score'] == "0"){
                    unset($scores[$i]);
                }
        }
            //fix very niche error
        if (count($scores) == 1) {
            foreach($scores as $score){ //I don't know which index is left in the array so I have to use a foreach loop
                if ($score['score'] == '0'){
                    $scores = [];
                }
            }
        }

        //remove decimals for non games
        if (!$oppgame){
            foreach($scores as &$score){
                $score['score'] = intval($score['score']);
            }
        }

        //Make the places for the table
        $i = 1;
        foreach ($scores as &$score) {

            $score['place'] = $i;
            $i++;
        }

        $data = [
            "site_title" => "Scores",
            "scores" => $scores
        ];

        return view("scoreTable", $data);
    } 
}