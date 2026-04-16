document.addEventListener('DOMContentLoaded', function () {
  var container = document.querySelector('.bg-quality-line');
  if (!container) return;
  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // Canvas für den Glow erstellen
  var canvas = document.createElement('canvas');
  canvas.style.position = 'absolute';
  canvas.style.top = '0';
  canvas.style.left = '0';
  canvas.style.width = '100%';
  canvas.style.height = '300%';
  canvas.style.willChange = 'transform';
  container.appendChild(canvas);

  // SVG ausblenden (Canvas übernimmt alles)
  var svg = container.querySelector('svg');
  if (svg) svg.style.display = 'none';

  var ctx = canvas.getContext('2d');
  var dpr = window.devicePixelRatio || 1;

  // Pfad-Punkte generieren (Bezier-Kurve wie im SVG)
  function getCurvePoints(w, h) {
    var points = [];
    var segments = [
      { x1: 0.50, y1: -20/300, cx1: 0.20, cy1: 10/300, cx2: 0.80, cy2: 30/300, x2: 0.50, y2: 50/300 },
      { x1: 0.50, y1: 50/300, cx1: 0.15, cy1: 72/300, cx2: 0.85, cy2: 90/300, x2: 0.50, y2: 110/300 },
      { x1: 0.50, y1: 110/300, cx1: 0.20, cy1: 132/300, cx2: 0.80, cy2: 150/300, x2: 0.50, y2: 170/300 },
      { x1: 0.50, y1: 170/300, cx1: 0.15, cy1: 192/300, cx2: 0.85, cy2: 210/300, x2: 0.50, y2: 230/300 },
      { x1: 0.50, y1: 230/300, cx1: 0.20, cy1: 252/300, cx2: 0.80, cy2: 270/300, x2: 0.50, y2: 290/300 },
      { x1: 0.50, y1: 290/300, cx1: 0.15, cy1: 310/300, cx2: 0.85, cy2: 325/300, x2: 0.50, y2: 340/300 }
    ];

    for (var s = 0; s < segments.length; s++) {
      var seg = segments[s];
      var steps = 80;
      for (var i = 0; i <= steps; i++) {
        var t = i / steps;
        var u = 1 - t;
        var x = u*u*u * seg.x1 + 3*u*u*t * seg.cx1 + 3*u*t*t * seg.cx2 + t*t*t * seg.x2;
        var y = u*u*u * seg.y1 + 3*u*u*t * seg.cy1 + 3*u*t*t * seg.cy2 + t*t*t * seg.y2;
        points.push({ x: x * w, y: y * h });
      }
    }
    return points;
  }

  // Farbverlauf entlang der Linie (3 Zyklen Cyan ↔ Blau)
  function getColorAt(t) {
    var cycle = (t * 3) % 1;
    var r, g, b;
    if (cycle < 0.4) {
      // Türkis #66EFE2
      r = 102; g = 239; b = 226;
    } else if (cycle < 0.5) {
      // Übergang Türkis → Blau
      var p = (cycle - 0.4) / 0.1;
      r = 102 - p * 92; g = 239 - p * 90; b = 226 + p * 28;
    } else if (cycle < 0.9) {
      // Blau #0A95FE
      r = 10; g = 149; b = 254;
    } else {
      // Übergang Blau → Türkis
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
    canvas.height = rect.height * 3 * dpr;
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  function draw() {
    var w = canvas.width / dpr;
    var h = canvas.height / dpr;
    ctx.clearRect(0, 0, w, h);

    var points = getCurvePoints(w, h);
    var totalPoints = points.length;

    // Glow zeichnen: an jedem Punkt einen radialen Gradienten
    for (var i = 0; i < totalPoints; i += 2) {
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

    // Kern-Linie zeichnen (dünn, hell)
    ctx.beginPath();
    ctx.moveTo(points[0].x, points[0].y);
    for (var i = 1; i < totalPoints; i++) {
      ctx.lineTo(points[i].x, points[i].y);
    }
    ctx.strokeStyle = '#66EFE2';
    ctx.lineWidth = coreRadius;
    ctx.lineCap = 'round';
    ctx.globalAlpha = 0.9;

    // Gradient entlang der Linie via mehrere Segmente
    for (var i = 0; i < totalPoints - 1; i++) {
      var t = i / totalPoints;
      var col = getColorAt(t);
      ctx.beginPath();
      ctx.moveTo(points[i].x, points[i].y);
      ctx.lineTo(points[i + 1].x, points[i + 1].y);
      ctx.strokeStyle = 'rgba(' + col.r + ',' + col.g + ',' + col.b + ', 0.9)';
      ctx.lineWidth = coreRadius;
      ctx.stroke();
    }

    ctx.globalAlpha = 1;
  }

  resize();
  draw();

  // Nur bei Resize neu zeichnen (statischer Glow)
  var resizeTimer;
  window.addEventListener('resize', function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
      dpr = window.devicePixelRatio || 1;
      resize();
      draw();
    }, 150);
  });

  // Animation: sanfte Auf/Ab-Bewegung
  var offset = 0;
  function animate() {
    offset += 0.015;
    var translateY = -65 + Math.sin(offset) * 5;
    canvas.style.transform = 'translateY(' + translateY + '%)';
    requestAnimationFrame(animate);
  }

  animate();
});
