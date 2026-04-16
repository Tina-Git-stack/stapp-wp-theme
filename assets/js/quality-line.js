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

  // 12 Segmente, jedes 60 Einheiten hoch = 720 total
  function getCurvePoints(w, h) {
    var points = [];
    var total = 720;
    var segHeight = 60;
    var numSegs = 12;

    for (var s = 0; s < numSegs; s++) {
      var yStart = (s * segHeight - 20) / total;
      var yEnd = ((s + 1) * segHeight - 20) / total;
      var yMid1 = yStart + (yEnd - yStart) * 0.35;
      var yMid2 = yStart + (yEnd - yStart) * 0.65;
      // Alternierend links/rechts
      var cx1 = (s % 2 === 0) ? 0.20 : 0.80;
      var cx2 = (s % 2 === 0) ? 0.80 : 0.20;

      var steps = 60;
      for (var i = 0; i <= steps; i++) {
        var t = i / steps;
        var u = 1 - t;
        var x = u*u*u * 0.50 + 3*u*u*t * cx1 + 3*u*t*t * cx2 + t*t*t * 0.50;
        var y = u*u*u * yStart + 3*u*u*t * yMid1 + 3*u*t*t * yMid2 + t*t*t * yEnd;
        points.push({ x: x * w, y: y * h });
      }
    }
    return points;
  }

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
