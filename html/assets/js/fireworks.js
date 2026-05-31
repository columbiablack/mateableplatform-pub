/*
 * Copyright (c) 2024-2026. Mateable LLC
 */

const canvas = document.getElementById('fireworksCanvas');
const ctx = canvas.getContext('2d');

canvas.width = window.innerWidth;
canvas.height = window.innerHeight;

class Firework {
    constructor(x, y, colors) {
        this.x = x;
        this.y = y;
        this.colors = colors;
        this.particles = [];
        this.createParticles();
    }

    createParticles() {
        for (let i = 0; i < 100; i++) {
            const angle = (Math.random() * 360) * (Math.PI / 180);
            const speed = Math.random() * 3 + 2;
            const color = this.colors[Math.floor(Math.random() * this.colors.length)];
            this.particles.push(new Particle(this.x, this.y, angle, speed, color));
        }
    }

    update() {
        this.particles.forEach(particle => particle.update());
    }

    draw() {
        this.particles.forEach(particle => particle.draw());
    }
}

class Particle {
    constructor(x, y, angle, speed, color) {
        this.x = x;
        this.y = y;
        this.angle = angle;
        this.speed = speed;
        this.color = color;
        this.gravity = 0.05;
        this.alpha = 1;
        this.decay = Math.random() * 0.02 + 0.01;
    }

    update() {
        this.speed *= 0.98;
        this.x += Math.cos(this.angle) * this.speed;
        this.y += Math.sin(this.angle) * this.speed + this.gravity;
        this.alpha -= this.decay;
    }

    draw() {
        ctx.save();
        ctx.globalAlpha = this.alpha;
        ctx.fillStyle = this.color;
        ctx.beginPath();
        ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
        ctx.fill();
        ctx.restore();
    }
}

const fireworks = [];

function animate() {
    ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
    ctx.fillRect(0, 0, canvas.width, canvas.height);

    if (Math.random() < 0.05) {
        const x = Math.random() * canvas.width;
        const y = Math.random() * canvas.height;
        const colors = ['#fffb00', '#c7ad07', 'rgba(57,50,62,0.45)', '#91829b', '#00ffff', '#ff00ff'];
        fireworks.push(new Firework(x, y, colors));
    }

    fireworks.forEach((firework, index) => {
        firework.update();
        firework.draw();
        if (firework.particles.every(p => p.alpha <= 0)) {
            fireworks.splice(index, 1);
        }
    });

    requestAnimationFrame(animate);
}

animate();
