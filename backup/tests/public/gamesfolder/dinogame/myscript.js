function sendScore(score){
    var url = window.location.href;
    var id = url.slice(-1);

    score = parseInt(score);

    $.post("/games", {

        "score": score,
        "id": id

    }, function (data, status) {
        console.log(data)
    });
}