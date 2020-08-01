<div class="container mx-auto collapse" id="drawingBox">
    <br>
    <div class="btn-toolbar p-1 mx-auto" role="toolbar" aria-label="Toolbar with button groups" id="toolbox">
        <div class="btn-group mr-2" role="group" aria-label="reset">
            <button id="btnClear" onclick="clearCanvas()" type="button" class="btn btn-outline-danger"><i class="fas fa-trash-alt"></i></button>
        </div>
        <div class="btn-group mr-4" role="group" aria-label="undo">
            <button id="btnUndo" onclick="undo()" type="button" class="btn btn-outline-info"><i class="fas fa-undo-alt"></i></button>
            <button id="btnRedo" onclick="redo()" type="button" class="btn btn-outline-info"><i class="fas fa-redo-alt"></i></button>
        </div>
        <div class="btn-group mr-2" role="group" aria-label="pencils">
            <button id="btnPencil1" onclick="pencil(1)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-sm"></i></button>
            <button id="btnPencil2" onclick="pencil(2)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-md"></i></button>
            <button id="btnPencil3" onclick="pencil(3)" type="button" class="btn btn-outline-secondary"><i class="fas fa-pencil-alt fa-lg"></i></button>
        </div>
        <div class="btn-group mr-4" role="group" aria-label="erasers">
            <button id="btnEraser1" onclick="eraser(1)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-sm"></i></button>
            <button id="btnEraser2" onclick="eraser(2)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-md"></i></button>
            <button id="btnEraser3" onclick="eraser(3)" type="button" class="btn btn-outline-secondary"><i class="fas fa-eraser fa-lg"></i></button>
        </div>
        <div class="btn-group" role="group" aria-label="color">
            <button type="button" class="btn btn-outline-success"><i class="fas fa-palette"></i></button>
        </div>
    </div>
    <div class="" id="canvas"></div>
</div>
