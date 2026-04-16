document.addEventListener('DOMContentLoaded', function () {
  var container = document.querySelector('.bg-quality-line');
  if (!container) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  var canvas = document.createElement('canvas');
  canvas.style.position = 'absolute';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.width = '100%';
  canvas.style.height = '600%';
  canvas.style.willChange = 'transform';
  container.appendChild(canvas);

  var svg = container.querySelector('svg');
  if (svg) svg.style.display = 'none';

  var ctx = canvas.getContext('2d');
  var dpr = window.devicePixelRatio || 1;

  // Sinuswelle: garantiert glatt, keine Knicke
  function getCurvePoints(w, h) {
    var points = [];
    var totalSteps = 800;
    var waves = 5; // Anzahl voller Wellen über die gesamte Höhe
    var amplitude = w * 0.25; // 25% der Breite nach links/rechts
    var centerX = w * 0.5;

    for (var i = 0; i <= totalSteps; i++) {
      var t = i / totalSteps;
      var y = t * h;
      var x = centerX + Math.sin(t * waves * Math.PI * 2) * amplitude;
      points.push({ x: x, y: y });
    }
    return points;
  }

  // Farbverlauf: 4 Zyklen Türkis ↔ Blau
  function getColorAt(t) {
    var cycle = (t * 4) % 1;
    var r, g, b;
    if (cycle < 0.4) {
      r = 102; g = 239; b = 226;
    } else if (cycle < 0.5) {
      var p = (cycle - 0.4) / 0.1;
      r = 102 - p * 92; g = 239 - p * 90; b = 226 + p * 28;
    } else if (cycle < 0.9) {
      r = 10; g = 149; b = 254;
    } else {
      var p = (cycle - 0.9) / 0.1;
      r = 10 + p * 92; g = 149 + p * 90; b = 254 - p * 28;
    }
    return { r: Math.round(r), g: Math.round(g), b: Math.round(b) };
  }

  var glowRadius = 80;
  var coreRadius = 3;

  function resize() {
    var rect = container.getBoundingClientRect();
    canvas.width = rect.width * dpr;
    canvas.height = rect.height * 6 * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function draw() {
    var w = canvas.width / dpr;
    var h = canvas.height / dpr;
    ctx.clearRect(0, 0, w, h);

    var points = getCurvePoints(w, h);
    var totalPoints = points.length;

    // Glow
    for (var i = 0; i < totalPoints; i += 3) {
      var pt = points[i];
      var t = i / totalPoints;
      var col = getColorAt(t);

      var grad = ctx.createRadialGradient(pt.x, pt.y, 0, pt.x, pt.y, glowRadius);
      grad.addColorStop(0, 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0.25)');
      grad.addColorStop(0.3, 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0.08)');
      grad.addColorStop(0.6, 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0.03)');
      grad.addColorStop(1, 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0)');

      ctx.fillStyle = grad;
      ctx.fillRect(pt.x - glowRadius, pt.y - glowRadius, glowRadius * 2, glowRadius * 2);
    }

    // Kern-Linie
    for (var i = 0; i < totalPoints - 1; i++) {
      var t = i / totalPoints;
      var col = getColorAt(t);
      ctx.beginPath();
      ctx.moveTo(points[i].x, points[i].y);
      ctx.lineTo(points[i + 1].x, points[i + 1].y);
      ctx.strokeStyle = 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0.9)';
      ctx.lineWidth = coreRadius;
      ctx.lineCap = 'round';
      ctx.stroke();
    }
  }

  resize();
  draw();

  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      dpr = window.devicePixelRatio || 1;
      resize();
      draw();
    }, 150);
  });

  // Animation: sanfte Auf/Ab + Links/Rechts
  var offset = 0;
  function animate() {
    offset += 0.015;
    var translateY = -82 + Math.sin(offset) * 3;
    var translateX = Math.sin(offset * 0.7) * 3;
    canvas.style.transform = 'translateY(' + translateY + '%) translateX(' + translateX + '%)';
    requestAnimationFrame(animate);
  }

  animate();
});
