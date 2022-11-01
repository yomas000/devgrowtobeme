<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\PassModel;

require '/srv/dev/devgrowtobeme/vendor/autoload.php';
use Mailgun\Mailgun;

class Reset extends BaseController
{
    public function index($id)
    {
        $data = [
            "site_title" => "Password Recovery",
            "success" => false,
            "id" => $id
        ];

        if($this->request->getMethod() == "post"){
            $passModel = new PassModel();
            $userModel = new UserModel();

            $password = esc($this->request->getVar("password"));
            $password = hash("sha256", $password, False);

            $username = esc($this->request->getVar("username"));
            $uid = $userModel->getIdFromUser($username);

            $dbemail = $passModel->getEmail($id);

            if ($userModel->validateUser($dbemail, $username)){
                $userModel->updatePass($uid, $password);
                $passModel->where('reset_key', $id)->delete();
                $data["success"] = true;
            }
        }

        return view("resetView", $data);
    }

    public function update(){
        
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
            $num = rand(100, 5000);

            $user = [
                'email' => $email,
                'reset_key' => $num,
            ];

            $passModel->addKey($user);

            $link = "https://www.growtobe.me/reset/" . strval($num); //TODO: remove this for officail release

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
