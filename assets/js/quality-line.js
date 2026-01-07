document.addEventListener('DOMContentLoaded', function () {
  const line = document.querySelector('.bg-quality-line svg');
  if (!line) return;

  if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

  let offset = 0;

  function animate() {
    offset += 0.02;
    line.style.transform = `translateY(${-30 + Math.sin(offset) * 6}vh)`;
    requestAnimationFrame(animate);
  }

  animate();
});
