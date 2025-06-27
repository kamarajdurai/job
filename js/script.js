document.addEventListener('DOMContentLoaded', function () {
  // AOS animations
  AOS.init({
    duration: 1000,
    once: true,
    offset: 100
  });

  // Click sound (optional)
  const clickSound = new Audio('click.mp3');
  document.querySelectorAll('.click-sound').forEach(btn => {
    btn.addEventListener('click', () => {
      clickSound.currentTime = 0;
      clickSound.play();
    });
  });

  // Typing effect (optional for homepage)
  const text = 'Welcome to DreamHire!';
  const typingTarget = document.getElementById('typing-text');
  if (typingTarget) {
    let index = 0;
    function type() {
      if (index < text.length) {
        typingTarget.textContent += text.charAt(index);
        index++;
        setTimeout(type, 100);
      }
    }
    type();
  }

  // Expandable Job Cards
  document.querySelectorAll('.expandable-card').forEach(card => {
    card.addEventListener('click', () => {
      card.classList.toggle('active');
    });
  });
});
