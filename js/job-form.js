document.getElementById('applyForm').addEventListener('submit', function(e) {
  e.preventDefault();

  // Clear errors and hide message
  document.querySelectorAll('.error').forEach(el => el.textContent = '');
  document.getElementById('msg').style.display = 'none';

  let hasError = false;

  const name = document.getElementById('fullname').value.trim();
  const email = document.getElementById('email').value.trim();
  const phone = document.getElementById('phone').value.trim();
  const position = document.getElementById('position').value.trim();
  const resume = document.getElementById('resume').files[0];

  // Validate Name
  if (name === '') {
    document.getElementById('error-fullname').textContent = "Full name is required.";
    hasError = true;
  }

  // Validate Email
  const emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
  if (!email.match(emailPattern)) {
    document.getElementById('error-email').textContent = "Enter a valid email address.";
    hasError = true;
  }

  // Validate Phone
  if (phone !== '' && !/^\+?\d{7,15}$/.test(phone)) {
    document.getElementById('error-phone').textContent = "Enter a valid phone number.";
    hasError = true;
  }

  // Validate Position
  if (position === '') {
    document.getElementById('error-position').textContent = "Position is required.";
    hasError = true;
  }

  // Validate Resume
  if (!resume) {
    document.getElementById('error-resume').textContent = "Resume is required.";
    hasError = true;
  } else {
    const allowed = ['pdf', 'doc', 'docx'];
    const ext = resume.name.split('.').pop().toLowerCase();
    if (!allowed.includes(ext)) {
      document.getElementById('error-resume').textContent = "Invalid resume format.";
      hasError = true;
    }
  }

  if (!hasError) {
    document.getElementById('msg').textContent = "✅ All fields are valid! Ready to submit.";
    document.getElementById('msg').style.display = 'block';

    // Submit using fetch or form action
    // Example: this.submit();
  }
});
