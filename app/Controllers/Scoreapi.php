<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ApiModel;

class Scoreapi extends ResourceController
{
    protected $modelName = 'App\Models\ScoreModel';
    protected $format    = 'json';

    public function index()
    {
        if ($this->authorize()) { //show all users
            $usermodel = new UserModel();
            $ids = $usermodel->getAllUserIds();

            $users = [];

            foreach($ids as $id){
                $user = $this->model->getScoreForUser($id);
                $username = $user[0]["username"];
                $scores = [];

                for ($i = 0; $i < count($user); $i++) {
                    $game = [
                        "game" => $user[$i]['gameName'],
                        "score" => $user[$i]["score"]
                    ];
                    array_push($scores, $game);
                }

                $user1 = [
                    "username" => $username,
                    "scores" => $scores
                ];
                array_push($users, $user1);
            }
           

            return $this->respond($users);
        }
    }

    public function show($id = null)
    { //show spesific user
        if ($this->authorize()) {
        }
    }

    public function create()
    { //Create users
        if ($this->authorize()) {
        }
    }

    public function delete($id = null)
    { //delete a user
        if ($this->authorize()) {
          
        }
    }

    public function update($id = null)
    { //Edit user
        if ($this->authorize()) {
        }
    }

    private function authorize()
    {
        $apiModel = new ApiModel();
        $request = \Config\Services::request();
        $session = session();

        if ($session->get('admin')) {
            return true;
        } else {
            if ($request->hasHeader("X-API-Key")) {
                $apikey = $request->header("X-API-Key")->getValue();

                if ($apiModel->checkApiKey($apikey)) {
                    return true;
                } else {
                    $this->response->setStatusCode(401, 'X-API-Key is incorrect'); // API key wrong
                }
            } else {
                $this->response->setStatusCode(401, 'X-API-Key header not found'); //API Key not found
            }
        }
    }
}
