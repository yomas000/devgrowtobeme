<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ScoreModel;
use App\Models\ApiModel;
use Kint\Zval\Value;

class Gameapi extends ResourceController
{
    protected $modelName = 'App\Models\GameModel';
    protected $format    = 'json';
 
    public function index()
    {
        if ($this->authorize()) { //show all games
            $games = $this->model->findAll();

            return $this->respond($games);
        }
    }

    public function show($id = null){ //show spesific game
        if ($this->authorize()) {
            $id = esc($id);
            
            $game = $this->model->find($id);

            return $this->respond($game);
        }
    }

    public function create(){ //Create game
        if ($this->authorize()) {
            $request = \Config\Services::request();
            $gamename = esc($request->getVar("gameName"));
            $gameDesc = esc($request->getVar("gameDesc"));
            $filepath = esc($request->getVar("filePath"));
            $imgpath = esc($request->getVar("imgPath"));

            $game = [
                'gameName' => $gamename,
                'gameDescription' => $gameDesc,
                'filePath' => $filepath,
                'imgPath' => $imgpath
            ];

            return $this->model->addGame($game);
        }
    }

    public function delete($id = null){ //delete a game
        if ($this->authorize()){
            $scoreModel = new ScoreModel;

            $scoreModel->deleteGame($id);
            $this->model->delete($id);
            return $this->respond(["success"=>true]);
        }
    }

    public function update($id = null){ //Edit game
        if ($this->authorize()){
            $request = \Config\Services::request();
            $gamename = esc($request->getVar("gameName"));
            $gameDesc = esc($request->getVar("gameDesc"));
            $filepath = esc($request->getVar("filePath"));
            $imgpath = esc($request->getVar("imgPath"));

            $game = [
                'gameName' => $gamename,
                'gameDescription' => $gameDesc,
                'filePath' => $filepath,
                'imgPath' => $imgpath
            ];

            $this->model->update($id, $game);

            return $this->respond($gameDesc);
        }
    }

    private function authorize(){ //check if the requested api key has the correct permissions
        $apiModel = new ApiModel();
        $request = \Config\Services::request();
        $session = session();

        if ($session->get('admin')){
            return true;
        }else{
            if ($request->hasHeader("X-API-Key")){
                $apikey = $request->header("X-API-Key")->getValue();

                if ($apiModel->checkApiKey($apikey)) {
                    return true;
                } else {
                    $this->response->setStatusCode(401, 'X-API-Key is incorrect'); // API key wrong
                }
            }else{
                $this->response->setStatusCode(401, 'X-API-Key header not found'); //API Key not found
            }
        }
    }
}
