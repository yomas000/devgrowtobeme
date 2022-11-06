<?php namespace App\Controllers;

use App\Models\GameModel;
use App\Models\UserModel;
use App\Models\AdminModel;
use App\Models\SettingsModel;

class Home extends BaseController
{
    public function index()
    {
        $model = new GameModel();
        $adminModel = new AdminModel();
        $session = \Config\Services::session();
        $settingsModel = new SettingsModel();
        $usermodel = new UserModel();

        $cards = $model->findAll();
        $alertOn = false;
        $alert = '';
        $id = $session->get("id");

        if ($adminModel->checkAlert()){
            $alertOn = true;
            $alert = $adminModel->getAlert();
        }

        // //for the signin button
        if ($this->request->getMethod() == 'post'){ //TODO: Make sign in a ajax request then update page, check for already sign in 
            if ($this->authenticate()){
                if ($alertOn){
                    $data = [
                        "site_title" => "Grow To Be me",
                        "auth" => true,
                        "username" => esc(htmlspecialchars($_POST['username'])),
                        "cards" => $cards,
                        "admin" => $session->get("admin"),
                        "alert" => $alert,
                        "autoplay" => $settingsModel->getSettingUser($id, "autoplay")
                    ];
                }else{
                    $data = [
                        "site_title" => "Grow To Be me",
                        "auth" => true,
                        "username" => esc(htmlspecialchars($_POST['username'])),
                        "cards" => $cards,
                        "admin" => $session->get("admin"),
                        "autoplay" => $settingsModel->getSettingUser($id, "autoplay")
                    ];
                }

                return view('indexVeiw', $data);
            }else{
                if ($alertOn){
                    $data = [
                        "site_title" => "Grow To Be me",
                        "auth" => false,
                        "error" => "Username or Password is incorrect",
                        "cards" => $cards,
                        "admin" => $session->get("admin"),
                        "alert" => $alert,
                    ];
                }else{
                    $data = [
                        "site_title" => "Grow To Be me",
                        "auth" => false,
                        "error" => "Username or Password is incorrect",
                        "cards" => $cards,
                        "admin" => $session->get("admin"),
                    ];
                }

                return view('indexVeiw', $data);
            }
        }


        //for auto login
        if ($session->get("auth") == true){
            if ($alertOn){
                $data = [
                    "site_title" => "Grow To Be me",
                    "auth" => true,
                    "username" => $session->get("username"),
                    "cards" => $cards,
                    "admin" => $session->get("admin"),
                    "alert" => $alert,
                    "autoplay" => $settingsModel->getSettingUser($id, "autoplay")
                ];
            }else{
                $data = [
                    "site_title" => "Grow To Be me",
                    "auth" => true,
                    "username" => $session->get("username"),
                    "cards" => $cards,
                    "admin" => $session->get("admin"),
                    "autoplay" => $settingsModel->getSettingUser($id, "autoplay")
                ];
            }
            return view('indexVeiw', $data);
        }else{
            if ($alertOn){
                $data = [
                    "site_title" => "Grow To Be me",
                    "auth" => false,
                    "username" => $session->get("username"),
                    "cards" => $cards,
                    "admin" => $session->get("admin"),
                    "alert" => $alert,
                ];
            }else{
                $data = [
                    "site_title" => "Grow To Be me",
                    "auth" => false,
                    "cards" => $cards,
                    "admin" => $session->get("admin"),
                ];
            }
            return view('indexVeiw', $data);
        }
    }

    private function authenticate(){
        $username = esc(htmlspecialchars($_POST['username'])); //TODO: Change this to $this->request->getVar('name');
        $spass = esc(htmlspecialchars($_POST['password']));
        $session = session();

        $password = hash("sha256", $spass, False);
        
        $model = new UserModel();
        
        $dpass = $model->findColumn("password");
        $dusr = $model->findColumn("username");
        $ids = $model->findColumn('id');

        $success = False;
        $error = "";
        $id = 0;

        for ($i = 0; $i < count($ids); $i++){
            if ($password == $model->find($ids[$i])['password']){
                if ($username == $model->find($ids[$i])["username"]){
                    $success = True;
                    $id = $ids[$i];
                }
            }
        }

        $sessData = [
            "id" => $id,
            "username" => $username,
            "auth" => $success,
            "admin" => $model->checkAdmin($id)
        ];

        $session->set($sessData);

        return $success;
    }
} 
