<canvas id="gameCanvas" height="200" width="300"></canvas>
<script>
    var canvas = document.getElementById("gameCanvas");
var ctx = canvas.getContext("2d");
ctx.fillStyle = "rgba(1,1,1,1)";
ctx.fillRect(0, 0, canvas.getAttribute("height"), canvas.getAttribute("width"));

//report the mouse position on click
canvas.addEventListener("click", function (evt) {
    var mousePos = getMousePos(canvas, evt);
    
    
        ctx.beginPath();
        ctx.arc(mousePos.x, mousePos.y, 5, 0, 2 * Math.PI, false);
        ctx.fillStyle = 'skyblue';
        ctx.fill();
        ctx.lineWidth = 5;
        ctx.strokeStyle = '#030';
        ctx.stroke();
}, false);

//Get Mouse Position
function getMousePos(canvas, evt) {
    var rect = canvas.getBoundingClientRect();
    return {
        x: evt.clientX - rect.left,
        y: evt.clientY - rect.top
    };
}
</script>