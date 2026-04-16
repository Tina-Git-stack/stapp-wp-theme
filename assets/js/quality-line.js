document.addEventListener('DOMContentLoaded', function () {
  var container = document.querySelector('.bg-quality-line');
  var svg = container ? container.querySelector('svg') : null;
  if (!svg) return;

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  // SVG ist 3x Viewport-Höhe (viewBox 0-300), initial so positionieren
  // dass die Mitte sichtbar ist. Animation bewegt sanft auf/ab.
  // Container ist 100vh (fixed), SVG muss 300% Höhe haben damit kein Ende sichtbar.
  svg.style.height = '300%';
  svg.style.width = '100%';
  svg.style.position = 'absolute';
  svg.style.top = '0';
  svg.style.left = '0';

  var offset = 0;

  function animate() {
    offset += 0.015;
    // Bewegt sich zwischen -70% und -60% (Mitte des 300%-Bereichs)
    // So bleibt immer genug Pfad oben und unten außerhalb des Viewports
    var translateY = -65 + Math.sin(offset) * 5;
    svg.style.transform = 'translateY(' + translateY + '%)';
    requestAnimationFrame(animate);
  }

  animate();
});
