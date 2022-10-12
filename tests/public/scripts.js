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