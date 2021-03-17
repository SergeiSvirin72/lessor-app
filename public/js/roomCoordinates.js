let coordinates = [];
let image, canvas, ctx, image_dimensions = {};

function init(_image, _coordinates = [], interactive = false) {
    canvas = document.createElement('canvas');
    ctx = canvas.getContext('2d');

    if (interactive) {
        canvas.addEventListener('click', addPoint);
    }

    canvas.width = _image.width;
    canvas.height = _image.height;

    image = _image;
    coordinates = _coordinates;

    image_dimensions.width = _image.width;
    image_dimensions.height = _image.height;

    _image.parentNode.replaceChild(canvas, _image);

    reloadCanvas();
    if (coordinates.length) {
        drawPoints();
        drawLines();
    }
}

function reloadCanvas() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.drawImage(image, 0, 0, image_dimensions.width, image_dimensions.height);
}

function addPoint(e) {
    let rect = e.target.getBoundingClientRect();
    let x = e.clientX - rect.left;
    let y = e.clientY - rect.top;
    coordinates.push({x,y});

    reloadCanvas();
    drawPoints();
    drawLines();
}

function drawPoints() {
    for (let i = 0; i < coordinates.length; i++) {
        ctx.beginPath();
        ctx.fillStyle = "rgba(0,0,0,1)";
        ctx.arc(coordinates[i].x, coordinates[i].y, 3, 0, Math.PI * 2, true);
        ctx.fill();

        ctx.font = "16px Arial";
        ctx.fillText(i + 1, coordinates[i].x - 3, coordinates[i].y + 19);
    }
}

function drawLines() {
    ctx.beginPath();
    ctx.fillStyle = "rgba(0,0,0,0.5)";
    ctx.moveTo(coordinates[0].x, coordinates[0].y);
    for (let i = 1; i < coordinates.length; i++) {
        ctx.lineTo(coordinates[i].x, coordinates[i].y)
    }
    ctx.closePath();
    ctx.fill();
}

function clearCoordinates() {
    reloadCanvas();
    coordinates = [];
}

function getCoordinates() {
    return coordinates;
}

export default {
    init, clearCoordinates, getCoordinates
}