function likePublication(pub_id) {
    let method = 'post';
    let url = document.getElementById('routeLikePub'+pub_id).value;
    let likeCount = document.getElementById("yeahCountPub"+pub_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
    let yeahButton = document.getElementById("yeahButtonPub"+pub_id);
    yeahButton.setAttribute('class', 'btn btn-secondary');
    yeahButton.setAttribute('onclick', 'dislikePublication('+pub_id+')');
    sendRequest(null, method, url);
    return false;
}

function dislikePublication(pub_id) {
    let method = 'delete';
    let url = document.getElementById('routeLikePub'+pub_id).value;
    let likeCount = document.getElementById("yeahCountPub"+pub_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
    let yeahButton = document.getElementById("yeahButtonPub"+pub_id);
    yeahButton.setAttribute('class', 'btn btn-success');
    yeahButton.setAttribute('onclick', 'likePublication('+pub_id+')');
    sendRequest(null, method, url);
    return false;
}

function likeComment(com_id) {
    let method = 'post';
    let url = document.getElementById('routeLikeCom'+com_id).value;
    let likeCount = document.getElementById("yeahCountCom"+com_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
    let yeahButton = document.getElementById("yeahButtonCom"+com_id);
    yeahButton.setAttribute('class', 'btn btn-secondary');
    yeahButton.setAttribute('onclick', 'dislikeComment('+com_id+')');
    sendRequest(null, method, url);
    return false;
}

function dislikeComment(com_id) {
    let method = 'delete';
    let url = document.getElementById('routeLikeCom'+com_id).value;
    let likeCount = document.getElementById("yeahCountCom"+com_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
    let yeahButton = document.getElementById("yeahButtonCom"+com_id);
    yeahButton.setAttribute('class', 'btn btn-success');
    yeahButton.setAttribute('onclick', 'likeComment('+com_id+')');
    sendRequest(null, method, url);
    return false;
}

function sendRequest(json, method, url){
    //console.log("Requête " + method + " vers " + url + "\nJSON : " + json);
    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'Accept': 'application/json, text/plain, */*',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(json)
    }).then(function(res){ console.log(res) })
        .catch(function(res){ console.log(res) });
}
