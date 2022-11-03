<?php

namespace App\Controllers;

use App\Models\GameModel;

class Games extends BaseController
{
    public function index()
    {
       redirect(base_url() . "/");
    }

    public function game($id){
        $id = esc($id);

        $model = new GameModel();
        $game = $model->find($id);
        $file = $game["filePath"];

        return view("gamesfolder/{$file}/index.html");
    }
}
