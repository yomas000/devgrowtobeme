<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\UserModel;
use App\Models\ScoreModel;
use App\Models\ApiModel;

class Sserapi extends ResourceController
{
    protected $modelName = 'App\Models\ScoreModel';
    protected $format    = 'json';

    public function index()
    {
        if ($this->authorize()) { //show all users
            $users = $this->model->findAll();

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
