<?php

namespace App\Controllers;

use CodeIgniter\RESTful\ResourceController;
use App\Models\ApiModel;
use App\Models\AdminModel;

class Adminapi extends ResourceController
{
    protected $modelName = 'App\Models\AdminModel';
    protected $format    = 'json';

    public function index()
    {
        if ($this->authorize()) { //show all users
            
            $settings = $this->model->findAll();

            return $this->respond($settings);
        }
    }

    public function show($id = null)
    { //show spesific user
        if ($this->authorize()) {
            $this->model->find($id);
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
          $this->model->delete($id);
        }
    }

    public function update($id = null)
    { //Edit user
        if ($this->authorize()) {
            $request = \Config\Services::request();
            $data = [
                "name" => esc($request->getVar("name")),
                "value" => esc($request->getVar("value")),
                "active" => esc($request->getVar("active"))
            ];

            $this->model->update($id, $data);
            return $this->respond(["success"=> true]);
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
