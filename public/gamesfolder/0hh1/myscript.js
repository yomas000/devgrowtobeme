window.setTimeout(sendScore, 2000);

function sendScore() {
    var url = window.location.href;
    var id = url.slice(-1);

    score = parseInt(document.getElementById("scorenr").innerHTML);

    $.post("/games", {

        "score": score,
        "id": id

    }, function (data, status) {
        console.log(data)
    });

    console.log(id);
}