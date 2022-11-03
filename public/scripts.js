document.addEventListener("DOMContentLoaded", function () {
    alert("New Games Added!")
});

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