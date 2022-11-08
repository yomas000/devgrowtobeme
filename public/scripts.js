window.onload = function() {document.getElementById("signInButton").addEventListener("click", signIn);}

function sendFriendRequest(){
    var statusDiv = document.getElementById("status");
    var input = document.getElementById("friendName");
    var username = input.value;

    $.post("/friends", {

        "type": "request",
        "username": username

    }, function(data, status){
        response = JSON.parse(data);

        console.log(response)

        card = document.createElement("div");
        card.classList.add("card");
        card.classList.add("border-primary");
        
        if (response.success){
            text = response.message;
            input.value = "";
        }else{
            text = response.err;
        }

        card.innerHTML="<h5 class='w-10' style='margin: auto;'>" + text + "</h5>";

        statusDiv.replaceChild(card, statusDiv.childNodes[0]);
    });
}

function makeFriends(e){
    $.post("/friends", {

        "type": "accept",
        "username": e.id

    }, function (data, status) {
        console.log(e.parentNode);
        e.parentNode.parentNode.remove();
        location.reload();
    });
}

function noFriends(e) {
    $.post("/friends", {

        "type": "decline",
        "username": e.id

    }, function (data, status) {
        location.reload();
    });
}

function deleteFriend(e){

    if (confirm("Do you want to delete " + e.id + " as a freind?")){
        $.post("/friends", {

            "type": "delete",
            "username": e.id
    
        }, function (data, status) {
            location.reload();
        });
    }
}

function sendFeedback() {
    var feedback = document.getElementById("feedbackInput");
    $.post("/feedback", {

        "feedback": feedback.value

    }, function (data, status) {
        feedback.value = "";
    });

}

function signIn() {
    var username = document.getElementById("usernameFeild");
    var password = document.getElementById("passwordFeild");

    $.post("/auth", {

        "username": username.value,
        "password": password.value

    }, function (data, status) {
        username.value = "";
        password.value = "";
        javascript:document.open('text/html');document.write(data);document.close();
    });
    console.log(username.value);
}

function addRow(){
    var table = document.getElementById("adminGameTable")

    var tablerow = document.createElement("tr");

    var idArray = ["addgamename", "addgamedesc", "addfilepath", "addimgpath"]

    for (i = 0; i < 4; i++){
        var th = document.createElement("th");
        var input = document.createElement("input");
        input.classList.add("form-control");
        input.setAttribute("id", idArray[i]);
        th.appendChild(input);
        tablerow.appendChild(th);
    }
    var th = document.createElement("th");
    var button = document.createElement("button");
    button.innerHTML = "Enter";
    button.classList.add("btn", "btn-primary");
    button.setAttribute("id", "addGame");
    button.setAttribute("onclick", "addGame();")
    th.appendChild(button)
    tablerow.appendChild(th);

    table.appendChild(tablerow);


}

function updateGame(e){
    var id = e.id;
    var gamename = $("#gamename"+id)[0].value;
    var gamedesc = $("#gamedesc"+id)[0].value;
    var filepath = $("#filepath"+id)[0].value;
    var imgpath = $("#imgpath"+id)[0].value;

    var data = {
        "gameName": gamename,
        "gameDesc": gamedesc,
        "filePath": filepath,
        "imgPath": imgpath
        }

    $.ajax({
        type: "put",
        url: "/gameapi/" + id,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function(result){
            alert("Success!")
            location.reload();
        }
    })
}

function deleteGame(e){
    if (confirm("Are you sure you want to delete this game?")){
        var id = e.id;
        $.ajax({
            type: "delete",
            url: "/gameapi/" + id,
            success: function(result){
                location.reload();
                console.log(result);
            }
        })
    }
}

function addGame(){
    var gamename = $("#addgamename")[0].value;
    var gamedesc = $("#addgamedesc")[0].value;
    var filepath = $("#addfilepath")[0].value;
    var imgpath = $("#addimgpath")[0].value;

    var data = {
        "gameName": gamename,
        "gameDesc": gamedesc,
        "filePath": filepath,
        "imgPath": imgpath
        }

    $.ajax({
        type: "post",
        url: "/gameapi",
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function(result){
            alert("Success!")
            location.reload();
        }
    })
}

function updateUser(e){
    var id = e.id;
    var username = $("#username" + id)[0].value;
    var email = $("#email" + id)[0].value;
    var password = $("#password" + id)[0].value;
    var admin = $("#customSwitch" + id)[0].checked

    console.log(admin);

    var data = {
        "username": username,
        "email": email,
        "password": password,
        "admin": admin
    }

    $.ajax({
        type: "put",
        url: "/userapi/" + id,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (result) {
            alert("Success!")
            //location.reload();
        }
    })
}

function deleteUser(e){
    if (confirm("Are you sure you want to delete this User?")) {
        var id = e.id;
        $.ajax({
            type: "delete",
            url: "/userapi/" + id,
            success: function (result) {
                location.reload();
                console.log(result);
            }
        })
    }
}

function addUser(){

}

function addRowUser(){
  
}

function updateAdmin(e){
    var id = e.id;
    var name = $("#name" + id)[0].value;
    var value = $("#value" + id)[0].value;
    var active = $("#Switch" + id)[0].checked

    console.log(admin);

    var data = {
        "name": name,
        "value": value,
        "active": active
    }

    $.ajax({
        type: "put",
        url: "/adminapi/" + id,
        contentType: "application/json",
        data: JSON.stringify(data),
        success: function (result) {
            alert("Success!")
            //location.reload();
        }
    })
}

function deleteAdmin(e){
    if (confirm("Are you sure you want to delete this Setting?")) {
        var id = e.id;
        $.ajax({
            type: "delete",
            url: "/adminapi/" + id,
            success: function (result) {
                location.reload();
                console.log(result);
            }
        })
    }
}

function updateSetting(e){
    var settingName = e.id;
    var active = e.checked;

    $.post("/account", {
        settingName: settingName,
        active: active
    }, function(result){
        
    })
}

function sendMessage(){

    var message = $("#usermsg")[0].value;

    $("#usermsg")[0].value = "";

    $.post("/friends", {

        "type": "chatmsg",
        "msg": message

    }, function (data, status) {
        loadLog();
    });
}

function loadLog() {
    var oldscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height before the request
    $.ajax({
        url: "log.html",
        cache: false,
        success: function (html) {
            $("#chatbox").html(html); //Insert chat log into the #chatbox div   

            //Auto-scroll           
            var newscrollHeight = $("#chatbox")[0].scrollHeight - 20; //Scroll height after the request
            if (newscrollHeight > oldscrollHeight) {
                $("#chatbox").animate({ scrollTop: newscrollHeight }, 'normal'); //Autoscroll to bottom of div
            }
        },
    });
}

setInterval(loadLog, 2500);