let canvas, sizeX = 500, sizeY = 300;
let sizeTool = 5, color = 0;
let sizes = [2, 5, 12];
let buffers = [], activeBuffer;
let inputActive = false;

function setup() {
    buffers[0] = createGraphics(sizeX, sizeY);
    buffers[1] = createGraphics(sizeX, sizeY);
    buffers[0].pixelDensity(1);
    buffers[1].pixelDensity(1);
    activeBuffer = 0;
    canvas = createCanvas(sizeX, sizeY);
    canvas.parent('canvas');
    canvas.id("drawingContext");
    buffers[0].background(255, 255, 255);
    buffers[1].background(255, 255, 255);
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

function isCanvasEmpty(){
    buffers[activeBuffer].loadPixels();
    let empty = true;
    let d = buffers[activeBuffer].pixelDensity();
    let size = 4 * (sizeX * d) * (sizeY / d);
    for (let i = 0; empty && i < size; i += 4) {
        //console.log("("+pixels[i] + "," + pixels[i+1] + "," +pixels[i+2]+")");
        if(buffers[activeBuffer].pixels[i] < 255 || buffers[activeBuffer].pixels[i+1] < 255 || buffers[activeBuffer].pixels[i+2] < 255){
            empty = false;
        }
    }
    return empty;
}
