let canvas;
const sizeX = 500, sizeY = 300;
let sizeTool = 5, color = 0;
let sizes = [2, 5, 12];

let points = [];
let pointsCount = 0;
let steps = [];
let stepIndex = 0;

function setup() {
    canvas = createCanvas(sizeX, sizeY);
    pixelDensity(1);
    canvas.parent('canvas');
    //canvas.id('drawingContext');
    stroke(color);
    strokeWeight(sizeTool);
    document.getElementById('btnPencil2').setAttribute('class', 'btn btn-secondary');
    updateStepsButtons();
    background(255);
}

function draw() {
    if  (mouseIsPressed === true && mouseInsideCanvas()) {
        if (pointsCount === 0) {
            updateSteps();
            line(mouseX, mouseY, pmouseX, pmouseY);
            points.push(createVector(pmouseX, pmouseY));
            points.push(createVector(mouseX, mouseY));
            pointsCount += 2;
        } else if (mouseIsMoving()) {
            line(mouseX, mouseY, pmouseX, pmouseY);
            points.push(createVector(mouseX, mouseY));
            pointsCount += 1;
        }
    }
}

function displayPoints() {
    background(255);
    let count = 0;
    for (let i = 0; i < stepIndex; i++) {
        let step = steps[i];
        if (step.type === "point") {
            let previousPoint = points[count];
            strokeWeight(step.sizeTool);
            stroke(step.color);
            for (let j = count + 1; j < count + step.pointsCount; j++) {
                let point = points[j];
                line(point.x, point.y, previousPoint.x, previousPoint.y);
                previousPoint = point;
            }
            count += step.pointsCount;
        } else if (step.type === "clear") {
            background(step.color);
        }
    }
    strokeWeight(sizeTool);
    stroke(color);
}

function updateSteps() {
    if (stepIndex < steps.length) {
        let start = 0;
        let count = 0;
        for (let i = 0; i < steps.length; i++) {
            if (i < stepIndex) {
                start += steps[i].pointsCount;
            } else {
                count += steps[i].pointsCount;
            }
        }
        points.splice(start, count);
        steps.splice(stepIndex, steps.length - stepIndex);
    }
}

function mouseReleased() {
    if  (pointsCount > 0) {
        steps.push({
            type: "point",
            pointsCount,
            sizeTool,
            color
        });
        stepIndex++;
        pointsCount = 0;
        updateStepsButtons();
    }
}

function mouseInsideCanvas(){
    return mouseX <= sizeX && mouseY <= sizeY && mouseX >= 0 && mouseY >= 0;
}

function mouseIsMoving() {
    return movedX !== 0 || movedY !== 0;
}

function updateStepsButtons() {
    document.getElementById('btnRedo').disabled = stepIndex >= steps.length;
    document.getElementById('btnUndo').disabled = stepIndex <= 0;
}

function resetButtonFocus(){
    for(let i = 1; i <= 3 ; i++){
        document.getElementById('btnPencil' + i).setAttribute('class', 'btn btn-outline-secondary');
        document.getElementById('btnEraser' + i).setAttribute('class', 'btn btn-outline-secondary');
    }
}

function pencil(id) {
    resetButtonFocus();
    document.getElementById('btnPencil' + id).setAttribute('class', 'btn btn-secondary');
    sizeTool = sizes[id - 1];
    strokeWeight(sizeTool);
    if (color === 255){
        color = 0;
    }
    stroke(color);
}

function eraser(id) {
    resetButtonFocus();
    document.getElementById('btnEraser' + id).setAttribute('class', 'btn btn-secondary');
    sizeTool = sizes[id - 1];
    strokeWeight(sizeTool);
    color = 255;
    stroke(color);
}

function undo() {
    if (stepIndex > 0) {
        stepIndex--;
        displayPoints();
    }
    updateStepsButtons();
}

function redo() {
    if (stepIndex < steps.length) {
        stepIndex++;
        displayPoints();
    }
    updateStepsButtons();
}

function clearCanvas() {
    if (stepIndex > 0 && steps[stepIndex - 1].type !== "clear") {
        updateSteps();
        background(255);
        steps.push({
            type: "clear",
            pointsCount: 0,
            sizeTool: 0,
            color: 255
        });
        stepIndex++
        pointsCount = 0;
        updateStepsButtons();
    }
}

function isCanvasEmpty(){
    loadPixels();
    let empty = true;
    let d = pixelDensity();
    let size = 4 * (sizeX * d) * (sizeY / d);
    for (let i = 0; empty && i < size; i += 4) {
        //console.log("("+pixels[i] + "," + pixels[i+1] + "," +pixels[i+2]+")");
        if(pixels[i] < 255 || pixels[i+1] < 255 || pixels[i+2] < 255){
            empty = false;
        }
    }
    return empty;
}
