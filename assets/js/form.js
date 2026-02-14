
// Premium Form Logic
document.addEventListener('DOMContentLoaded', () => {

  // Select Elements
  const form = document.getElementById('premium-quote-form');
  const successOverlay = document.getElementById('success-overlay');
  const successContent = document.getElementById('success-content');
  const closeSuccessBtn = document.getElementById('close-success');
  const productInput = document.getElementById('p_product');
  const productSelect = document.getElementById('p_product_select');

  if (!form) return;

  // 1. Sync Custom Product Select
  if (productSelect && productInput) {
    productSelect.addEventListener('change', (e) => {
      productInput.value = e.target.value;
      // Trigger floating label animation
      if (e.target.value) {
        productInput.classList.remove(':placeholder-shown'); // Note: this is pseudo-class, we rely on value presence check in CSS usually or add a class
        productInput.setAttribute('data-filled', 'true'); // Helper if needed
      }
    });
  }

  // 2. Handle Form Submit
  form.addEventListener('submit', (e) => {
    e.preventDefault();

    // Simple Validation (Browser handles 'required', we can add more here)
    const name = form.querySelector('[name="name"]').value;
    const phone = form.querySelector('[name="phone"]').value;

    if (!name || !phone) {
      alert('Please fill in required fields.');
      return;
    }

    // Simulate API delay
    const btn = form.querySelector('button[type="submit"]');
    const originalBtnContent = btn.innerHTML;
    btn.innerHTML = '<span>Sending...</span>';
    btn.disabled = true;

    setTimeout(() => {
      // Reset Button
      btn.innerHTML = originalBtnContent;
      btn.disabled = false;

      // Show Success Modal
      showSuccessModal();

      // Reset Form (optional, maybe keep values if user wants to send another similar one? usually reset)
      form.reset();
      if (productInput) productInput.value = '';

    }, 1500);
  });

  // 3. Success Modal Logic
  function showSuccessModal() {
    if (!successOverlay) return;
    successOverlay.classList.remove('pointer-events-none', 'opacity-0');
    if (successContent) successContent.classList.remove('scale-90');
    if (successContent) successContent.classList.add('scale-100');
  }

  function hideSuccessModal() {
    if (!successOverlay) return;
    successOverlay.classList.add('opacity-0', 'pointer-events-none');
    if (successContent) successContent.classList.remove('scale-100');
    if (successContent) successContent.classList.add('scale-90');
  }

  if (closeSuccessBtn) {
    closeSuccessBtn.addEventListener('click', hideSuccessModal);
  }

  // Close on click outside content
  if (successOverlay) {
    successOverlay.addEventListener('click', (e) => {
      if (e.target === successOverlay) {
        hideSuccessModal();
      }
    });
  }

  // 4. Input Focus Animations (Optional helpers if CSS :focus-within isn't enough)
  const inputs = form.querySelectorAll('.premium-input');
  inputs.forEach(input => {
    // Initial check for browser autofill
    if (input.value) input.classList.add('has-content');

    input.addEventListener('input', () => {
      if (input.value.trim() !== '') {
        input.classList.add('has-content');
      } else {
        input.classList.remove('has-content');
      }
    });
  });

});
