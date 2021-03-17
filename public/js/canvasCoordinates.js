class CanvasCoordinates {
    constructor(image, coordinates = [], interactive = false, appendCanvas) {
        this.coordinates = coordinates;

        this.canvas = document.createElement('canvas');
        this.ctx = this.canvas.getContext('2d');

        if (interactive) {
            this.canvas.addEventListener('click', (e) => this.addPoint(e));
        }

        this.canvas.width = image.naturalWidth;
        this.canvas.height = image.naturalHeight;

        this.image = image.cloneNode();
        appendCanvas(this.canvas);

        this.reloadCanvas();
        if (this.coordinates.length) {
            this.drawPoints();
            this.drawLines();
        }
    }

    reloadCanvas() {
        this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
        this.ctx.drawImage(this.image, 0, 0, this.image.width, this.image.height);
    }

    addPoint(e) {
        console.log(this.ctx);
        let rect = e.target.getBoundingClientRect();
        let x = e.clientX - rect.left;
        let y = e.clientY - rect.top;
        this.coordinates.push({x,y});

        this.reloadCanvas();
        this.drawPoints();
        this.drawLines();
    }

    drawPoints() {
        for (let i = 0; i < this.coordinates.length; i++) {
            this.ctx.beginPath();
            this.ctx.fillStyle = "rgba(0,0,0,1)";
            this.ctx.arc(this.coordinates[i].x, this.coordinates[i].y, 3, 0, Math.PI * 2, true);
            this.ctx.fill();

            this.ctx.font = "16px Arial";
            this.ctx.fillText(i + 1, this.coordinates[i].x - 3, this.coordinates[i].y + 19);
        }
    }

    drawLines() {
        this.ctx.beginPath();
        this.ctx.fillStyle = "rgba(0,0,0,0.5)";
        this.ctx.moveTo(this.coordinates[0].x, this.coordinates[0].y);
        for (let i = 1; i < this.coordinates.length; i++) {
            this.ctx.lineTo(this.coordinates[i].x, this.coordinates[i].y)
        }
        this.ctx.closePath();
        this.ctx.fill();
    }

    clearCoordinates() {
        this.reloadCanvas();
        this.coordinates = [];
    }

    getCoordinates() {
        return this.coordinates;
    }
}

export default CanvasCoordinates