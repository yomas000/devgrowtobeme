<?php

namespace App\Controllers;

use Mailgun\Mailgun;
use App\Models\UserModel;
use App\Models\PassModel;

class Reset extends BaseController
{
    public function index($id) //TODO: save email in database to validate requested username
    {

        $passModel = new PassModel();
        $userModel = new UserModel();

        $data = [
            "site_title" => "Password Recovery"
        ];

        return view("resetView", $data);
    }

    public function update(){
        $passModel = new PassModel();
        $userModel = new UserModel();

        $password = esc($this->request->getVar("password"));
        $password = hash("sha256", $password, False);

        $username = esc($this->request->getVar("username"));
        $id = $userModel->getIdFromUser($username);

        $userModel->update($id, ["password" => $password]);
        $passModel->where('reset_key', $id)->delete();

        $data = [
            "site_title" => "Password Recovery",
            "success" => true
        ];

        return view("resetView", $data);
    }

    public function mail(){
        $userModel = new UserModel();
        $passModel = new PassModel();

        $data = [
            "site_title"=>"Password Recovery",
            "success" => false
        ];

        if ($this->request->getMethod() == 'post'){
            $email = esc($this->request->getVar("email", FILTER_VALIDATE_EMAIL));
            $num = rand(100, 1000);

            $passModel->insert([
                "reset_key"=> $num
            ]);

            $link = "http://localhost/reset/" . strval($num);

            $send = array(
                'from'    => 'thomasd@mail.growtobe.me',
                'to'    => $email,
                'subject' => 'Password Reset',
                'template'    => 'password',
                'h:X-Mailgun-Variables'    => '{"link": "' . $link . '"}'
            );
            # Include the Autoloader (see "Libraries" for install instructions)
            # Instantiate the client.
            $mgClient = new Mailgun(getenv("MAIL_API", false));
            $domain = "mail.growtobe.me";
            # Make the call to the client.
            $result = $mgClient->sendMessage($domain, $send);

           $data["success"] = true;
        }

        return view("resetViewPrompt", $data);
    }
}
