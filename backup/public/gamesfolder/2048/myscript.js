window.setTimeout(sendScore, 2000);

function sendScore(){
    var url = window.location.href;
    var id = url.slice(-1);

    score = localStorage.bestScore;

    $.post("/games", {

        "score": score,
        "id": id

    }, function (data, status) {
        console.log(data)
    });
}