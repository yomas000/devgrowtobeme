<?php

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model
{
    protected $table      = 'scores';
    protected $primaryKey = 'userid';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;

    protected $allowedFields = ['userid', 'gameid', 'score'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function getScoreForUser($id){
        $db = \Config\Database::connect();

        $builder = $db->table('users');
        $builder->select("username, score, gameName");
        $builder->join('scores', 'scores.userid=users.id');
        $builder->join('games', 'scores.gameId=games.id')->where("userid", $id);
        $query = $builder->get()->getResult();

        return json_decode(json_encode($query), true);
    }

    public function getScoresForGameId($id, $desc = true){
        $db = \Config\Database::connect();

        $builder = $db->table('scores');
        $builder->select("username, score");
        
        if ($desc){
            $builder->join("users", "scores.userid = users.id")->where("scores.gameid", $id)->orderBy("score", "DESC");
        }else{
            $builder->join("users", "scores.userid = users.id")->where("scores.gameid", $id)->orderBy("score", "ASC");
        }

        $query = $builder->get()->getResult();

        return json_decode(json_encode($query), true);
    }
    public function setDefaultScores($id){
        $db = \Config\Database::connect();
        $builder = $db->table('games');
        $query = $builder->select()->get()->getResult();

        $query = json_decode(json_encode($query), true);

        $builder = $db->table('scores');
        for($i = 0; $i < count($query); $i++){
            $data = [
                "userid" => $id,
                "gameid" => $query[$i]["id"],
                "score" => 0
            ];
            $builder->insert($data);
        }
    }
    public function setScore($userid, $gameid, $score, $scoreComp = true){
        $db = \Config\Database::connect();
        $builder = $db->table("scores");
        $builder->select("score");
        $builder->where("userid", $userid);
        $builder->where("gameid", $gameid);
        
        $query = $builder->get()->getResult();
       
        $query = json_decode(json_encode($query), true);

        if ($scoreComp){
            if ($score > $query[0]["score"]){
                $builder = $db->table("scores");
                $builder->set("score", $score);
                $builder->where("userid", $userid);
                $builder->where("gameid", $gameid);
                $builder->update();
            }
        }else{
            if ($score < $query[0]["score"]) {
                $builder = $db->table("scores");
                $builder->set("score", $score);
                $builder->where("userid", $userid);
                $builder->where("gameid", $gameid);
                $builder->update();
            }
        }

        return $query[0];
    }

    public function deleteGame($id){
        $db = \Config\Database::connect();
        $builder = $db->table("scores");
        $builder->where("gameid", $id);
        $builder->delete();
    }
}