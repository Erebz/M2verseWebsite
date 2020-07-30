function likePublication(pub_id) {
    let method = 'post';
    let url = document.getElementById('routeLikePub'+pub_id).value;
    let likeCount = document.getElementById("yeahCountPub"+pub_id);
    let likeLabel = document.getElementById("yeahLabelPub"+pub_id);
    let likeIcon = document.getElementById("yeahIconPub"+pub_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
    likeLabel.innerHTML = "Yeah!";
    likeIcon.setAttribute('class', 'fas fa-thumbs-up');
    let yeahButton = document.getElementById("yeahButtonPub"+pub_id);
    yeahButton.setAttribute('class', 'btn btn-success');
    yeahButton.setAttribute('onclick', 'dislikePublication('+pub_id+')');
    sendRequest(null, method, url);
    return false;
}

function dislikePublication(pub_id) {
    let method = 'delete';
    let url = document.getElementById('routeLikePub'+pub_id).value;
    let likeCount = document.getElementById("yeahCountPub"+pub_id);
    let likeLabel = document.getElementById("yeahLabelPub"+pub_id);
    let likeIcon = document.getElementById("yeahIconPub"+pub_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
    likeLabel.innerHTML = "Yeah";
    likeIcon.setAttribute('class', 'far fa-thumbs-up');
    let yeahButton = document.getElementById("yeahButtonPub"+pub_id);
    yeahButton.setAttribute('class', 'btn btn-outline-success');
    yeahButton.setAttribute('onclick', 'likePublication('+pub_id+')');
    sendRequest(null, method, url);
    return false;
}

function likeComment(com_id) {
    let method = 'post';
    let url = document.getElementById('routeLikeCom'+com_id).value;
    let likeCount = document.getElementById("yeahCountCom"+com_id);
    let likeLabel = document.getElementById("yeahLabelCom"+com_id);
    let likeIcon = document.getElementById("yeahIconCom"+com_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) + 1;
    likeLabel.innerHTML = "Yeah!";
    likeIcon.setAttribute('class', 'fas fa-thumbs-up');
    let yeahButton = document.getElementById("yeahButtonCom"+com_id);
    yeahButton.setAttribute('class', 'btn btn-success');
    yeahButton.setAttribute('onclick', 'dislikeComment('+com_id+')');
    sendRequest(null, method, url);
    return false;
}

function dislikeComment(com_id) {
    let method = 'delete';
    let url = document.getElementById('routeLikeCom'+com_id).value;
    let likeCount = document.getElementById("yeahCountCom"+com_id);
    let likeLabel = document.getElementById("yeahLabelCom"+com_id);
    let likeIcon = document.getElementById("yeahIconCom"+com_id);
    likeCount.innerHTML = parseInt(likeCount.innerHTML) - 1;
    likeLabel.innerHTML = "Yeah";
    likeIcon.setAttribute('class', 'far fa-thumbs-up');
    let yeahButton = document.getElementById("yeahButtonCom"+com_id);
    yeahButton.setAttribute('class', 'btn btn-outline-success');
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

function addDrawing(){
    let addDrawing = document.getElementById('addDrawing');
    addDrawing.value = "true";
    let btn = document.getElementById('btnAddDrawing');
    btn.setAttribute('class', 'btn btn-danger');
    btn.setAttribute('onclick', 'removeDrawing()');
    let label = document.getElementById('labelAddDrawing');
    label.innerHTML = "Remove drawing";
    let icon = document.getElementById('iconAddDrawing');
    icon.setAttribute('class', 'fa fa-times');
}

function removeDrawing(){
    let addDrawing = document.getElementById('addDrawing');
    addDrawing.value = "false";
    let btn = document.getElementById('btnAddDrawing');
    btn.setAttribute('class', 'btn btn-outline-info');
    btn.setAttribute('onclick', 'addDrawing()');
    let label = document.getElementById('labelAddDrawing');
    label.innerHTML = "Add a drawing";
    let icon = document.getElementById('iconAddDrawing');
    icon.setAttribute('class', 'fa fa-pencil');
}

function checkPublicationForm(){
   /*
    let form = document.getElementById('publicationForm');
    let body = document.getElementById('publicationText');
    if(body.value.replace(/ /g, "") !== ""){
        document.getElementById('publicationBtn').disabled = false;
    }else{
        document.getElementById('publicationBtn').disabled = true;
    }
    */
}

function checkCommentForm(){
    /*
    let form = document.getElementById('commentForm');
    let body = document.getElementById('commentText');
    if(body.value.replace(/ /g, "") !== ""){
        document.getElementById('commentBtn').disabled = false;
    }else{
        document.getElementById('commentBtn').disabled = true;
    }
    */
}

function checkForm(){
    let addDrawing = document.getElementById('addDrawing');
    let body = document.getElementById('bodyInput');
    let title = document.getElementById('titleInput');
    let submitOk = false;

    if(title != null && title.value.replace(/ /g, "") === ""){
        title.value = null;
    }

    if(body != null && body.value.replace(/ /g, "") !== "") {
        submitOk = true;
    }

    if(addDrawing != null && addDrawing.value === "true"){
        console.log("Ajout d'un dessin !");
        if(isCanvasEmpty()){
            console.log("Le dessin est vide.");
            if(submitOk){
                let choice = confirm("The drawing is empty. It won't be sent. Continue?");
                if(choice){
                    console.log("Envoi d'un post sans image.");
                    console.log("[SUBMIT]");
                }else{
                    console.log("Pas de submit.");
                }
            }
        }else{
            console.log("Le dessin n'est pas vide.");
            submitOk = true;
        }
    }

    if(submitOk){
        console.log("Le post peut être envoyé.");
    }else{
        console.log("Le post ne peut pas être envoyé.");
    }

    return false;
}
