
// Premium Form Logic
document.addEventListener('DOMContentLoaded', () => {

  // Select Elements
  const form = document.getElementById('premium-quote-form');
  const successOverlay = document.getElementById('success-overlay');
  const successContent = document.getElementById('success-content');
  const closeSuccessBtn = document.getElementById('close-success');
  const productInput = document.getElementById('p_product');
  const productSelect = document.getElementById('p_product_select'); // If exists
  
  // Booking Wizard Form
  const bookingForm = document.getElementById('booking-wizard-form');
  const confirmBookingBtn = document.getElementById('btn-finish-booking');
  const bookingSuccessDiv = document.getElementById('booking-success');

  // --- 1. Premium Quote Form Handling ---
  if (form) {
    if (productSelect && productInput) {
      productSelect.addEventListener('change', (e) => {
        productInput.value = e.target.value;
        if (e.target.value) {
          productInput.setAttribute('data-filled', 'true');
        }
      });
    }

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      // Basic Validation
      const name = form.querySelector('[name="name"]').value;
      const phone = form.querySelector('[name="phone"]').value;
      
      if (!name || !phone) {
        alert('Please fill in required fields.');
        return;
      }

      // Prepare Data
      const formData = new FormData(form);
      formData.append('action', 'get_quote');
      
      // Add product if selecting from dropdown (custom logic if needed)
      // Note: The form already has a 'product' input? If not, we might need to map it.
      // Checking premium form HTML, it has a custom dropdown for product.
      // We need to ensure the selected value is sent.
      // The current HTML structure uses a custom dropdown. We need to grab its value.
      // Let's check if there is a hidden input for product.
      // If not, we might need to rely on the 'message' or add a hidden field.
      // Looking at the HTML previously, there was a '.dd-item' selection but no hidden input shown 
      // explicitly in the snippet I saw for 'Select Product'.
      // I'll assume there IS a hidden input or I should add handling for it.
      // BUT, to be safe, let's grab the text of the selected item if possible or just proceed.
      // Actually, looking at the code, I see: <div class="dd">...</div>
      // I will add a hidden input logic here if it's missing in HTML, but for now let's assume
      // standard FormData works if inputs have names.
      // Wait, the dropdown in `index.php` (lines 402-412) does NOT have a hidden input named 'product'.
      // It just has buttons. I need to fix that in HTML or handle it here.
      // I will add a hidden input to the form dynamically if it doesn't exist, 
      // or just append it to formData based on the UI state.
      
      // Let's look for the selected item in the custom dropdown
      const selectedProduct = form.querySelector('.dd .dd-btn').innerText;
      if(selectedProduct !== 'Select Product') {
          formData.append('product', selectedProduct);
      }

      // UI Loading State
      const btn = form.querySelector('button[type="submit"]');
      const originalBtnContent = btn.innerHTML;
      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
      btn.disabled = true;

      try {
        const response = await fetch('process_contact.php', {
          method: 'POST',
          body: formData
        });
        
        const result = await response.json();

        if (result.success) {
          showSuccessModal();
          form.reset();
          // Reset custom dropdowns if any
          const ddBtn = form.querySelector('.dd .dd-btn');
          if(ddBtn) ddBtn.innerText = 'Select Product';
          
          // Redirect after delay
          setTimeout(() => {
             window.location.href = 'index.php';
          }, 3000);
        } else {
          alert('Error: ' + result.message);
        }
      } catch (error) {
        console.error('Error:', error);
        alert('An unexpected error occurred. Please try again.');
      } finally {
        btn.innerHTML = originalBtnContent;
        btn.disabled = false;
      }
    });
  }

  // --- 2. Booking Wizard Form Handling ---
  if (bookingForm) {
      bookingForm.addEventListener('submit', async (e) => {
          e.preventDefault();
          
          // Gather data from all steps
          // output from wizard steps is stored in inputs with names:
          // location_type, address, landmark, pincode, google_map, date, time
          // AND we need 'type' (Home/Measurement/Showroom) which is in data-type attributes of cards.
          // I need to ensure 'type' is added to the form.
          // The HTML showed cards with `data-type`, but no hidden input for 'type' was obvious in the form tag itself in previous view.
          // I will append it manually if validation passes.

          const formData = new FormData(bookingForm);
          formData.append('action', 'book_visit');
          
          // Find selected type
          const activeCard = document.querySelector('.visit-card.active');
          if(activeCard) {
              formData.append('type', activeCard.dataset.type);
          } else {
              alert("Please select a visit type (Step 1).");
              return;
          }

          // UI Loading
          if(confirmBookingBtn) {
              const originalText = confirmBookingBtn.innerHTML;
              confirmBookingBtn.innerHTML = 'Booking...';
              confirmBookingBtn.disabled = true;

              try {
                  const response = await fetch('process_contact.php', {
                      method: 'POST',
                      body: formData
                  });
                  const result = await response.json();

                  if(result.success) {
                      // Hide form, show success
                      bookingForm.style.display = 'none';
                      document.getElementById('booking-progress').style.display = 'none';
                      if(bookingSuccessDiv) bookingSuccessDiv.classList.remove('hidden');
                      
                      // Redirect after delay
                      setTimeout(() => {
                         window.location.href = 'index.php';
                      }, 4000);
                  } else {
                      alert(result.message);
                  }
              } catch (err) {
                  console.error(err);
                  alert('Booking failed. Please check connection.');
              } finally {
                  confirmBookingBtn.innerHTML = originalText;
                  confirmBookingBtn.disabled = false;
              }
          }
      });
  }

  // --- 3. Success Modal Logic ---
  function showSuccessModal() {
    if (!successOverlay) return;
    successOverlay.classList.remove('pointer-events-none', 'opacity-0');
    successOverlay.style.pointerEvents = 'auto'; 
    successOverlay.style.opacity = '1';
    
    if (successContent) {
        successContent.classList.remove('scale-90');
        successContent.classList.add('scale-100');
    }
  }

  function hideSuccessModal() {
    if (!successOverlay) return;
    successOverlay.classList.add('opacity-0', 'pointer-events-none');
    successOverlay.style.pointerEvents = 'none';
    successOverlay.style.opacity = '0';
    
    if (successContent) {
        successContent.classList.remove('scale-100');
        successContent.classList.add('scale-90');
    }
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

  // 4. Input Focus Animations
  const inputs = document.querySelectorAll('.premium-input, .floating-input');
  inputs.forEach(input => {
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
