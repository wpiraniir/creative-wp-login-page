const canvas = document.getElementById('snow-canvas');
const ctx = canvas.getContext('2d');
let snowflakes = [];
let canvasWidth = canvas.width = window.innerWidth;
let canvasHeight = canvas.height = window.innerHeight;
const snowflakeCount = 200; // Number of snowflakes
const minRadius = 1.5;
const maxRadius = 4;
const minSpeed = 0.5;
const maxSpeed = 2;
const colors = ['rgba(255, 255, 255, 0.8)', 'rgba(240, 248, 255, 0.8)','rgba(230, 230, 250, 0.8)'];

// Snowflake Class
class Snowflake {
constructor() {
    this.reset();
    }
    reset(){
        this.x = Math.random() * canvasWidth;
        this.y = Math.random() * canvasHeight;
        this.radius = Math.random() * (maxRadius - minRadius) + minRadius;
        this.speedY = Math.random() * (maxSpeed - minSpeed) + minSpeed;
        this.speedX = (Math.random() - 0.5) * 0.5;
        this.color = colors[Math.floor(Math.random() * colors.length)];
    }
    update() {
    this.y += this.speedY;
    this.x += this.speedX;

    // If snowflake goes off-screen, reset
    if (this.y > canvasHeight + this.radius || this.x < -this.radius || this.x > canvasWidth + this.radius) {
        this.reset()
        }
    }
draw() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
    ctx.fillStyle = this.color;
    ctx.fill();
    }
}
// Create snowflakes
for (let i = 0; i < snowflakeCount; i++) {
snowflakes.push(new Snowflake());
}

function animate() {
    ctx.clearRect(0, 0, canvasWidth, canvasHeight);
    for (const snowflake of snowflakes) {
        snowflake.update();
        snowflake.draw();
    }
    requestAnimationFrame(animate);
}

// Resize listener for canvas
window.addEventListener('resize', () => {
    canvasWidth = canvas.width = window.innerWidth;
    canvasHeight = canvas.height = window.innerHeight;
    // Optionally regenerate snowflakes for responsive
    snowflakes = [];
    for (let i = 0; i < snowflakeCount; i++) {
       snowflakes.push(new Snowflake());
    }
    });

animate();