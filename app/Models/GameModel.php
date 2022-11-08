<?php

namespace App\Models;

use CodeIgniter\Model;

class GameModel extends Model
{
    protected $table      = 'games';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    // protected $returnType     = 'array';
    // protected $useSoftDeletes = true;
 
    protected $allowedFields = ['gameName', 'gameDescription', 'filePath', 'imgPath'];

    // protected $useTimestamps = false;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';
 
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = false;

    public function addGame($game){
        $db = \Config\Database::connect();
        $this->insert($game);

        //get Distinct userids
        $builder = $db->table("scores");
        $builder->select("userid");
        $builder->distinct();
        $query = json_decode(json_encode($builder->get()->getResult()), true);

        $userIds = [];

        foreach ($query as $row){
            array_push($userIds, $row["userid"]);
        }

        $builder = $db->table("games");
        $builder->select("id");
        $builder->where("gameName", $game["gameName"]);
        $gameid = json_decode(json_encode($builder->get()->getResult()), true)[0]['id'];
        
        foreach($userIds as $userid){
            $builder = $db->table("scores");
            $data = [
                "userid" => $userid,
                "gameid" => $gameid,
                "score" => 0
            ];
            $builder = $db->table("scores");
            $builder->insert($data);
        }
    }

    public function isDecimal($gameName){
        $db = \Config\Database::connect();
        $builder = $db->table("games");
        $builder->select("isDecimal");
        $builder->where("gameName", $gameName);

        $query = json_decode(json_encode($builder->get()->getResult()), true);

        if ($query[0]['isDecimal'] == '1'){
            return true;
        }else{
            return false;
        }
    }

    public function getGamebyId($id){
        $db = \Config\Database::connect();
        $builder = $db->table("games");
        $builder->select("gameName");
        $builder->where("id", $id);

        $query = json_decode(json_encode($builder->get()->getResult()), true);
        return $query[0]["gameName"];
    }
}
