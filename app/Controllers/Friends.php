<?php

namespace App\Controllers;

use App\Models\ScoreModel;

use App\Models\FreindsModel;

use App\Models\UserModel;
use App\Models\GameModel;
use App\Models\SettingsModel;

class Friends extends BaseController
{
    public function index()
    {
        $friendModel = new FreindsModel();
        $userModel = new UserModel();
        $scoreModel = new ScoreModel();
        $gameModel = new GameModel();

        $session = session();
        $id = $session->get("id");

        $friends = $friendModel->getFreindList($session->get("id"));
        $pendingFriends = $friendModel->pendingFriends($session->get("id"));
        
        $pendingFriends = json_decode(json_encode($pendingFriends), true);

        $requestedFriends = array();

        foreach($pendingFriends as $maybeFriend){
            $friend = [
                "username" => $userModel->find($maybeFriend["friend1"])["username"]
            ];
            array_push($requestedFriends, $friend);
        }

        //gets the scores for already friends
        $friendArray = json_decode(json_encode($friends), true);
    
        $scores = array();
        $user = array();

        for($i = 0; $i < count($friendArray); $i++){
            $result = $scoreModel->getScoreForUser($friendArray[$i]["friend2"]);


                $user = [
                    "username" => $result[0]['username']
                ];
                
                for ($j = 0; $j < count($result); $j++){
                    $gameName = $result[$j]["gameName"];
                    $score = 0;

                    if ($gameModel->isDecimal($gameName)){
                        $score = $result[$j]["score"];
                    }else{
                        $score = intVal($result[$j]["score"]);
                    }

                    $userscore = [
                        "game" => $gameName,
                        "score" => $score
                    ];

                    array_push($user, $userscore);
                }
                array_push($scores, $user);

        }

        $chatMessages = $this->chatMessages();

        if ($session->get('auth')){
            $data = [
                "site_title" => "Friends",
                "scores" => $scores,
                "name" => $session->get("username"),
                "pendingFreinds" => $requestedFriends,
                "chatContents" => $chatMessages

            ];
            return view("friends", $data);
        }

    } 

    private function chatMessages(){
        $setModel = new SettingsModel();

        $session = session();
        $id = $session->get("id");
        $famMode = $setModel->getSettingUser($id, "Family Mode")["active"];

        if ($famMode){
           
        }else{
            if (file_exists("log.html") && filesize("log.html") > 0) {
                $contents = file_get_contents("log.html");
                return $contents;
            }
        }
    }

    public function friendRequests(){
        $session = session();
        $model = new UserModel();
        $friendModel = new FreindsModel;
        $userModel =  new UserModel();

        if (isset($_POST["type"])){
            $id = $session->get("id");

            if ($_POST['type'] == "request"){
                $friendName = esc(htmlspecialchars($_POST["username"]));

                $userList = $model->findAll();

                $response = array();
                $success = false;

                foreach($userList as $user){
                    if ($friendName == $user["username"]){
                        $success = true;
                        $friendModel->makeFriends($session->get("id"), $friendName);
                    }
                }

                if ($success){
                    $response = [
                        "success" => $success,
                        "message" => "Friend Request Sent"
                    ];
                }else{
                    $response = [
                        "success" => $success,
                        "err" => "Friend Not Found"
                    ];
                }

                return json_encode($response);
            }

            if ($_POST['type'] == "accept") {
                $friendName = esc(htmlspecialchars($_POST["username"]));
                $friendId = $model->getIdFromUser($friendName);
                $thing = $friendModel->acceptFriends($session->get("id"), $friendId);

                return $thing;
            }

            if ($_POST['type'] == "decline") {
                $friendName = esc(htmlspecialchars($_POST["username"]));
                $friendId = $model->getIdFromUser($friendName);
                $thing = $friendModel->declineFriends($session->get("id"), $friendId);

                return "success";
            }

            if ($_POST['type'] == "delete") {
                $username = esc($_POST["username"]);
                $freindid = $userModel->getIdFromUser($username);

                $friendModel->deleteFriend($session->get("id"), $freindid);

                return "success";
            }

            if ($_POST["type"] == "chatmsg"){
                $message = esc($_POST["msg"]) ?? null;
                $session = session();
                $htmlSting = "<div class='msgln'><span class='chat-time'>" . date("g:i A") . "</span> <b class='user-name'>" . $session->get("username") . "</b>" . $message . "<br></div>";
                file_put_contents("log.html", $htmlSting, FILE_APPEND | LOCK_EX);
            }
        }
    }
}
