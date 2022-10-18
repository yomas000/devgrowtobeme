<?php

namespace App\Controllers;

use App\Models\UserModel;

use App\Models\ScoreModel;


class Create extends BaseController
{
    public function index()
    {
        $model = new UserModel();
        $scoreModel = new ScoreModel();

        $data = [
            "site_title"=> "Grow To Be Me"
        ];

        if ($this->request->getMethod() == 'post'){
            helper(['form']);

            $rules = [
                'email' => 'required|valid_email',
                'username' => [
                    "rules" => 'required|max_length[255]|blackListCheck|othername',
                    "errors" => [
                        "required" => "Put in a username, why do you not want people to know who you are, you crazy person.",
                        "max_length[255]" => "Please put in a username of under 255 characters, why would you ever need more? Like seriously though.",
                        "blackListCheck" => "Well, I'm disapointed in you. Why did you put in a blacklisted name. Please don't do that",
                        "othername" => "Try to be more original, this username is already taken."
                    ]
                ],
                'password' => 'required|min_length[7]'
            ];

            if ($this->validate($rules)){
                $model = new UserModel();
                $session = session();

                $username = esc(htmlspecialchars($_POST['username']));
                $password = hash("sha256", esc(htmlspecialchars($_POST['password'])), False);
                $email = esc(htmlspecialchars($_POST['email']));

                $user = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $password
                ];

                $model->insert($user);

                $id = $model->getIdFromUser($username);

                $scoreModel->setDefaultScores($id);
                
                $data = [
                    "id" => $id,
                    "auth" => true,
                    "username" => $username
                ];

                $session->set($data);
                return redirect("/");

            }else{
                $data = [
                    "site_title" => "Grow To Be Me",
                    'validation' => $this->validator
                ];
            }
        }

        return view("create", $data);
    }
}
