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
        if ($this->authorize()) {
            return $this->respond($this->model->findAll());
        }
    }

    public function show($id = null){
        if ($this->authorize()) {
            return "yes";
        }
    }

    public function update($id = null){
        if ($this->authorize()){
            return "yes";
        }
    }

    private function authorize(){
        $apiModel = new ApiModel();
        $request = \Config\Services::request();

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
