<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ScoreModel;
use App\Models\ApiModel;
use Kint\Zval\Value;

class UserAPI extends ResourceController
{
    protected $modelName = 'App\Models\UserModel';
    protected $format    = 'json';

    public function index()
    {
        if ($this->authorize()) { //show all users
            $users = $this->model->findAll();

            return $this->respond($users);
        }
    }

    public function show($id = null){ //show spesific user
        if ($this->authorize()) {
            $id = esc($id);
            $scoreModel = new ScoreModel;

            $user = $this->model->find($id);
            unset($user["id"]);
            $scores = $scoreModel->getScoreForUser($id);

            array_push($user, $scores);
            return $this->respond($user);
        }
    }

    public function create(){ //Create users
        $request = \Config\Services::request();
        if ($this->authorize()) {
            $username = esc($request->getVar("username"));
            $password = hash("sha256", esc($request->getVar("password")), false);
            $email = esc($request->getVar("email"));

            $scoreModel = new ScoreModel();

            $user = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            $this->model->insert($user);
            $id = $this->model->getIdFromUser($username);
            $scoreModel->setDefaultScores($id);

            return $this->respond(["success"=> true]);

        }
    }

    public function delete($id = null){ //delete a user
        if ($this->authorize()){
            $id = esc($id);
            $scoreModel = new ScoreModel;

            $this->model->delete($id);
            $scoreModel->delete($id);

            return $this->respond(["success"=> true]);
        }
    }

    public function update($id = null){ //Edit user
        if ($this->authorize()){
            $request = \Config\Services::request();
            $username = esc($request->getVar("username"));
            $password = hash("sha256", esc($request->getVar("password")), false);
            $email = esc($request->getVar("email"));

            $user = [
                'username' => $username,
                'email' => $email,
                'password' => $password
            ];

            $this->model->update($id, $user);
        }
    }

    private function authorize(){
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
