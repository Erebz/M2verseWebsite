let canvas, sizeX = 500, sizeY = 300;
let sizeTool = 5, color = 0;
let sizes = [2, 5, 12];
let buffers = [], activeBuffer;
let inputActive = false;

function setup() {
    console.log("HELLO");
    buffers[0] = createGraphics(sizeX, sizeY);
    buffers[1] = createGraphics(sizeX, sizeY);
    activeBuffer = 0;
    canvas = createCanvas(sizeX, sizeY);
    canvas.parent('canvas');
    background(255, 255, 255);
    pencil(2);
}

function draw() {
    if (mouseIsPressed === true && inputInsideCanvas()) {
        if(!inputActive){
            saveBuffer();
            inputActive = true;
        }
        buffers[activeBuffer].line(mouseX, mouseY, pmouseX, pmouseY);
    }
    background(255, 255, 255);
    image(buffers[activeBuffer], 0, 0);
}

function inputInsideCanvas(){
    return (mouseX<=sizeX && mouseY<=sizeY && mouseX>=0 && mouseY>=0);
}

function mouseReleased(){
    inputActive = false;
}

function pencil(id) {
    btnResetFocus();
    document.getElementById('btnPencil' + id).setAttribute('class', 'btn btn-secondary');
    sizeTool = sizes[id-1];
    buffers[0].strokeWeight(sizeTool);
    buffers[1].strokeWeight(sizeTool);
    if(color === 255){
        color = 0;
    }
    buffers[0].stroke(color);
    buffers[1].stroke(color);
}

function eraser(id) {
    btnResetFocus();
    document.getElementById('btnEraser' + id).setAttribute('class', 'btn btn-secondary');
    sizeTool = sizes[id-1];
    buffers[0].strokeWeight(sizeTool);
    buffers[1].strokeWeight(sizeTool);
    color = 255;
    buffers[0].stroke(color);
    buffers[1].stroke(color);
}

function undo() {
    activeBuffer = activeBuffer===0?1:0;
}

function clearCanvas() {
    saveBuffer();
    buffers[activeBuffer].clear();
    buffers[activeBuffer].background(255, 255, 255);
}

function btnResetFocus(){
    for(let i=1; i <=3 ; i++){
        document.getElementById('btnPencil' + i).setAttribute('class', 'btn btn-outline-secondary');
        document.getElementById('btnEraser' + i).setAttribute('class', 'btn btn-outline-secondary');
    }
}

function saveBuffer() {
    if(activeBuffer===1){
        buffers[0].copy(buffers[1], 0, 0, sizeX, sizeY, 0, 0, sizeX, sizeY);
    }else{
        buffers[1].copy(buffers[0], 0, 0, sizeX, sizeY, 0, 0, sizeX, sizeY);
    }
}
