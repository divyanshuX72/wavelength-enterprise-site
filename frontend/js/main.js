// Main cross-page interactions: menu toggle, prefill, WA link, smooth scroll
document.addEventListener('DOMContentLoaded', function () {
  // Load Components (Header/Footer)
  const loadComponent = (id, path) => {
    const el = document.getElementById(id);
    if (el) {
      fetch(path)
        .then(res => res.text())
        .then(html => {
          el.innerHTML = html;
          // Re-initialize year if footer loaded
          if (id === 'footer-container') {
            const y = document.getElementById('year');
            if (y) y.textContent = new Date().getFullYear();
          }
        });
    }
  };

  loadComponent('header-container', 'backend/includes/header.php');
  loadComponent('footer-container', 'backend/includes/footer.php');

  // Year
  const y = document.getElementById('year'); if (y) y.textContent = new Date().getFullYear();
  // Mobile menu toggle
  const menuBtn = document.getElementById('menu-btn'); const mobileNav = document.getElementById('mobile-nav');
  if (menuBtn) { menuBtn.addEventListener('click', () => { mobileNav.classList.toggle('hidden') }) }
  // Enquire buttons -> prefill contact form product field and navigate
  document.querySelectorAll('.enquire-btn').forEach(btn => {
    btn.addEventListener('click', () => {
      const p = btn.dataset.product || '';
      localStorage.setItem('wavelength_prefill', p);
      window.location.href = 'contact#quote';
    });
  });
  // Prefill product if set
  const productField = document.getElementById('product-field');
  if (productField) { const pre = localStorage.getItem('wavelength_prefill'); if (pre) { productField.value = pre; localStorage.removeItem('wavelength_prefill') } }
  // Smooth scroll for internal links
  document.querySelectorAll('a[href^="#"]').forEach(a => { a.addEventListener('click', e => { const href = a.getAttribute('href'); if (href.length > 1) { e.preventDefault(); const target = document.querySelector(href); if (target) target.scrollIntoView({ behavior: 'smooth' }) } }) });

  // Material & Finish Selector (services.html)
  const matCards = document.querySelectorAll('.material-card');
  const matInfo = document.getElementById('material-info');
  const matText = document.getElementById('material-text');

  if (matCards.length > 0) {
    matCards.forEach(card => {
      card.addEventListener('click', () => {
        // Reset all
        matCards.forEach(c => c.classList.remove('ring-2', 'ring-wood', 'bg-wood/20'));
        // Highlight active
        card.classList.add('ring-2', 'ring-wood', 'bg-wood/20');
        // Show info
        const desc = card.getAttribute('data-desc');
        if (matInfo && matText) {
          matText.textContent = desc;
          matInfo.classList.remove('hidden');
          matInfo.classList.add('animate-pulse');
          setTimeout(() => matInfo.classList.remove('animate-pulse'), 300);
        }
      });
    });
  }

  // Before/After Slider
  const container = document.getElementById('comparison-container');
  const beforeImg = document.getElementById('before-image');
  const handle = document.getElementById('slider-handle');

  if (container && beforeImg && handle) {
    let isDragging = false;

    // Fix inner image width to match container always
    const fixedImg = beforeImg.querySelector('img');
    const resizeObserver = new ResizeObserver(entries => {
      for (let entry of entries) {
        fixedImg.style.width = entry.contentRect.width + 'px';
      }
    });
    resizeObserver.observe(container);

    const updateSlider = (x) => {
      const rect = container.getBoundingClientRect();
      let pos = ((x - rect.left) / rect.width) * 100;
      pos = Math.max(0, Math.min(100, pos));

      beforeImg.style.width = `${pos}%`;
      handle.style.left = `${pos}%`;
    };

    container.addEventListener('mousedown', () => isDragging = true);
    container.addEventListener('touchstart', () => isDragging = true);

    window.addEventListener('mouseup', () => isDragging = false);
    window.addEventListener('touchend', () => isDragging = false);

    window.addEventListener('mousemove', (e) => {
      if (!isDragging) return;
      updateSlider(e.clientX);
    });

    window.addEventListener('touchmove', (e) => {
      if (!isDragging) return;
      updateSlider(e.touches[0].clientX);
    });
  }

  // Feature 11: Quote Calculator Logic
  const calcType = document.getElementById('calc-type');
  const calcLength = document.getElementById('calc-length');
  const calcHeight = document.getElementById('calc-height');
  const calcBedSize = document.getElementById('calc-bed-size');
  const calcMaterial = document.getElementById('calc-material');
  const calcFinish = document.getElementById('calc-finish');
  const calcTotal = document.getElementById('calc-total');
  const btnUseQuote = document.getElementById('btn-use-quote');

  // Containers to toggle
  const sizeContainer = document.getElementById('calc-size-container');
  const heightGroup = document.getElementById('calc-height-group');
  const bedSizeGroup = document.getElementById('calc-bed-size-group');

  if (calcType && calcTotal) {
    // Rates converted to INR
    const RATE_TV = 3000; // per ft length
    const RATE_WARDROBE = 1800; // per sqft
    const RATE_BED_BASE = 25000; // flat base

    const calculate = () => {
      const type = calcType.value;
      const matMult = parseFloat(calcMaterial.value);
      const finMult = parseFloat(calcFinish.value);
      let price = 0;

      // Visibility Toggle
      if (type === 'tv_unit') {
        sizeContainer.classList.remove('hidden');
        heightGroup.classList.add('hidden');
        bedSizeGroup.classList.add('hidden');
        // Logic: Length * Rate * Mat * Fin
        const len = parseFloat(calcLength.value) || 0;
        price = len * RATE_TV * matMult * finMult;
      }
      else if (type === 'wardrobe') {
        sizeContainer.classList.remove('hidden');
        heightGroup.classList.remove('hidden');
        bedSizeGroup.classList.add('hidden');
        // Logic: (H * W) * Rate * Mat * Fin
        const len = parseFloat(calcLength.value) || 0;
        const h = parseFloat(calcHeight.value) || 0;
        price = (len * h) * RATE_WARDROBE * matMult * finMult;
      }
      else if (type === 'bed') {
        sizeContainer.classList.add('hidden');
        bedSizeGroup.classList.remove('hidden');
        // Logic: Base * SizeMult * Mat * Fin
        const sizeMult = parseFloat(calcBedSize.value);
        price = RATE_BED_BASE * sizeMult * matMult * finMult;
      }

      // Update UI with Count-Up Animation
      const currentVal = parseInt(calcTotal.dataset.value || 0);
      const targetVal = Math.round(price);

      if (currentVal !== targetVal) {
        animateValue(calcTotal, currentVal, targetVal, 800);
        calcTotal.dataset.value = targetVal;

        // Pulse the Live Estimate badge
        const badge = document.querySelector('.glass-card .bg-wood\\/20');
        if (badge) {
          badge.classList.remove('animate-pulse');
          void badge.offsetWidth;
          badge.classList.add('animate-pulse');
        }
      }
    };

    // Count Up Animation Helper
    const animateValue = (obj, start, end, duration) => {
      let startTimestamp = null;
      const step = (timestamp) => {
        if (!startTimestamp) startTimestamp = timestamp;
        const progress = Math.min((timestamp - startTimestamp) / duration, 1);
        const easeProgress = 1 - Math.pow(1 - progress, 3); // Cubic ease-out

        const val = Math.floor(progress * (end - start) + start);
        obj.textContent = val.toLocaleString('en-IN');

        if (progress < 1) {
          window.requestAnimationFrame(step);
        } else {
          obj.textContent = end.toLocaleString('en-IN');
        }
      };
      window.requestAnimationFrame(step);
    };

    // Attach listeners
    [calcType, calcLength, calcHeight, calcBedSize, calcMaterial, calcFinish].forEach(el => {
      el.addEventListener('input', calculate);
      el.addEventListener('change', calculate);
    });

    // Initial run
    calculate();

    // "Use this Quote" functionality
    if (btnUseQuote) {
      btnUseQuote.addEventListener('click', () => {
        const formType = document.querySelector('select[name="furniture_type"]');
        const formDims = document.querySelector('input[name="dimensions"]');
        const formMsg = document.querySelector('textarea[name="message"]');

        // Map values
        if (formType) {
          // Approximate mapping to existing select values
          const typeMap = { 'tv_unit': 'TV Unit', 'wardrobe': 'Wardrobe', 'bed': 'Bed' };
          formType.value = typeMap[calcType.value] || '';
        }

        if (formDims) {
          if (calcType.value === 'tv_unit') formDims.value = `Length: ${calcLength.value} ft`;
          else if (calcType.value === 'wardrobe') formDims.value = `${calcLength.value}ft x ${calcHeight.value}ft`;
          else if (calcType.value === 'bed') {
            const bedText = calcBedSize.options[calcBedSize.selectedIndex].text;
            formDims.value = bedText;
          }
        }

        // Material & Finish in message
        if (formMsg) {
          const matText = calcMaterial.options[calcMaterial.selectedIndex].text;
          const finText = calcFinish.options[calcFinish.selectedIndex].text;
          const price = calcTotal.textContent;
          formMsg.value = `[Quote Estimate: ₹${price}]\nSelected Material: ${matText}\nSelected Finish: ${finText}\n\n(Generated via Calculator)`;
        }

        // Scroll to form
        document.getElementById('quote-form').scrollIntoView({ behavior: 'smooth' });
      });
    }
  }

  // Feature 12: Appointment Booking Logic (Upgraded Wizard)
  const bookingTypes = document.querySelectorAll('.visit-card');
  const nextBtn = document.getElementById('visit-next-btn');
  const prevBtn = document.getElementById('bk-prev-btn');
  const bookingDate = document.getElementById('bk_date');
  const bookingTimeInput = document.getElementById('bk_time');
  const btnConfirmBooking = document.getElementById('btn-finish-booking');

  // Logic: Steps
  let currentStep = 1;
  const totalSteps = 3;

  const updateWizardUI = () => {
    // 1. Show/Hide Steps
    for (let i = 1; i <= totalSteps; i++) {
      const stepEl = document.getElementById(`visit-step-${i}`);
      const indicator = document.querySelector(`.step-indicator[data-step="${i}"]`);

      if (i === currentStep) {
        if (stepEl) stepEl.classList.remove('hidden');
        if (indicator) {
          indicator.classList.add('active', 'bg-amber-600', 'text-black', 'border-amber-400', 'shadow-lg');
          indicator.classList.remove('bg-black/40', 'text-gray-400', 'bg-wood', 'border-wood');
        }
      } else if (i < currentStep) {
        if (stepEl) stepEl.classList.add('hidden');
        if (indicator) {
          indicator.classList.remove('active', 'bg-amber-600', 'text-black', 'border-amber-400', 'shadow-lg', 'text-gray-400', 'bg-black/40');
          indicator.classList.add('bg-wood', 'text-black', 'border-wood'); // Completed
        }
      } else {
        if (stepEl) stepEl.classList.add('hidden');
        if (indicator) {
          indicator.classList.remove('active', 'bg-amber-600', 'text-black', 'border-amber-400', 'shadow-lg', 'bg-wood', 'border-wood');
          indicator.classList.add('bg-black/40', 'text-gray-400'); // Pending
        }
      }
    }

    // 2. Buttons
    if (prevBtn) {
      if (currentStep === 1) prevBtn.classList.add('hidden');
      else prevBtn.classList.remove('hidden');
    }

    if (nextBtn) {
      if (currentStep === 3) nextBtn.classList.add('hidden'); // Show Confirm instead
      else nextBtn.classList.remove('hidden');
    }

    // 3. Scroll to top of wizard
    const container = document.getElementById('booking-container');
    if (container && currentStep > 1) {
      container.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
  };


  // 1. Visit Type Selection
  if (bookingTypes.length > 0) {
    bookingTypes.forEach(card => {
      card.addEventListener('click', () => {
        // Remove active from all
        bookingTypes.forEach(c => c.classList.remove('active'));
        // Add active to clicked
        card.classList.add('active');

        // Update Summary
        const summaryType = document.getElementById('summary-type');
        if (summaryType) summaryType.textContent = card.querySelector('h4').textContent;

        // Enable Next Button
        if (nextBtn) {
          nextBtn.disabled = false;
          nextBtn.classList.remove('opacity-40', 'cursor-not-allowed');
        }
      });
    });
  }

  // 2. Navigation Handlers
  if (nextBtn) {
    nextBtn.addEventListener('click', () => {
      // Validation Step 2 (Relaxed for Testing)
      if (currentStep === 2) {
        const addr = document.getElementById('bk_address').value;
        const pin = document.getElementById('bk_pincode').value;
        // Simple check
        // if (!addr || !pin) {
        //   alert('Please fill in Address and Pincode');
        //   return;
        // }
        // Update Summary Address regardless of validity effectively
        const summaryAddress = document.getElementById('summary-address');
        const summaryAddressBlock = document.getElementById('summary-address-block');
        if (summaryAddress) {
          summaryAddress.textContent = addr || 'Not provided';
          if (summaryAddressBlock) summaryAddressBlock.classList.remove('hidden');
        }
      }

      if (currentStep < totalSteps) {
        currentStep++;
        updateWizardUI();
      }
    });
  }

  if (prevBtn) {
    prevBtn.addEventListener('click', () => {
      if (currentStep > 1) {
        currentStep--;
        updateWizardUI();
      }
    });
  }

  // Step Indicator Click (Optional - allow going back)
  document.querySelectorAll('.step-indicator').forEach(ind => {
    ind.addEventListener('click', () => {
      const step = parseInt(ind.dataset.step);
      if (step < currentStep) {
        currentStep = step;
        updateWizardUI();
      }
    });
  });


  // 3. Custom Dropdown Logic (Location Type) - Event Delegation
  document.addEventListener('click', (e) => {
    const trigger = e.target.closest('.visit-select button');
    const option = e.target.closest('.visit-dropdown div[data-value]');

    // Toggle Dropdown
    if (trigger) {
      e.stopPropagation();
      const wrapper = trigger.closest('.visit-select');
      const dropdown = wrapper.querySelector('.visit-dropdown');

      // Close others
      document.querySelectorAll('.visit-dropdown').forEach(d => {
        if (d !== dropdown) d.classList.add('hidden');
      });

      dropdown.classList.toggle('hidden');
    }

    // Select Option
    else if (option) {
      e.stopPropagation();
      const wrapper = option.closest('.visit-select');
      const dropdown = wrapper.querySelector('.visit-dropdown');
      const input = wrapper.querySelector('input[type="hidden"]');
      const trigger = wrapper.querySelector('button');
      const displaySpan = trigger.querySelector('span');

      const val = option.dataset.value;
      const text = option.textContent;

      if (input) input.value = val;
      if (displaySpan) {
        displaySpan.textContent = text;
        displaySpan.classList.remove('text-gray-500');
        displaySpan.classList.add('text-white');
      }
      dropdown.classList.add('hidden');
    }

    // Close All if clicked outside
    else {
      document.querySelectorAll('.visit-dropdown').forEach(d => d.classList.add('hidden'));
    }
  });


  // 4. Time Slot Selection - Event Delegation
  document.addEventListener('click', (e) => {
    const btn = e.target.closest('.slot-btn');
    if (btn) {
      const timeSlots = document.querySelectorAll('.slot-btn');

      timeSlots.forEach(b => {
        b.classList.remove('bg-wood', 'text-black', 'border-wood');
        b.classList.add('bg-black/40', 'text-gray-300', 'border-white/10'); // Reset style
      });
      btn.classList.remove('bg-black/40', 'text-gray-300', 'border-white/10');
      btn.classList.add('bg-wood', 'text-black', 'border-wood'); // Active style

      if (bookingTimeInput) bookingTimeInput.value = btn.dataset.time;

      // Update Summary
      const dateVal = bookingDate ? bookingDate.value : '';
      const timeVal = btn.dataset.time;
      const summaryTime = document.getElementById('summary-datetime');
      if (summaryTime) summaryTime.textContent = `${dateVal || 'Date'} at ${timeVal}`;
    }
  });

  if (bookingDate) {
    bookingDate.addEventListener('change', () => {
      const timeVal = bookingTimeInput ? bookingTimeInput.value : '';
      const summaryTime = document.getElementById('summary-datetime');
      if (summaryTime) summaryTime.textContent = `${bookingDate.value} at ${timeVal || 'Time'}`;
    });
  }

  // 5. Booking Confirmation
  // Prevent native form submission (belt-and-suspenders)
  const bookingWizardForm = document.getElementById('booking-wizard-form');
  if (bookingWizardForm) {
    bookingWizardForm.addEventListener('submit', (e) => {
      e.preventDefault();
    });
  }

  if (btnConfirmBooking) {
    btnConfirmBooking.addEventListener('click', (e) => {
      e.preventDefault();

      const form = document.getElementById('booking-wizard-form');
      const success = document.getElementById('booking-success');
      const nav = document.getElementById('booking-nav');
      const progress = document.getElementById('booking-progress');

      // Validate date & time
      const dateVal = bookingDate ? bookingDate.value : '';
      const timeVal = bookingTimeInput ? bookingTimeInput.value : '';
      if (!dateVal || !timeVal) {
        alert('Please select a Date and Time.');
        return;
      }

      // Loading state
      const originalText = btnConfirmBooking.innerHTML;
      btnConfirmBooking.disabled = true;
      btnConfirmBooking.innerHTML = `<svg class="animate-spin h-5 w-5 text-black inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...`;

      // Gather form data
      const activeCard = document.querySelector('.visit-card.active');
      const visitType = activeCard ? activeCard.dataset.type : 'showroom';
      const formData = {
        step: 3,
        type: visitType,
        data: {
          address: document.getElementById('bk_address') ? document.getElementById('bk_address').value : '',
          landmark: document.getElementById('bk_landmark') ? document.getElementById('bk_landmark').value : '',
          pincode: document.getElementById('bk_pincode') ? document.getElementById('bk_pincode').value : '',
          locationType: document.getElementById('location_type_input') ? document.getElementById('location_type_input').value : '',
          date: dateVal,
          time: timeVal
        }
      };

      // Send to API
      fetch('backend/api/submit_booking.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify(formData)
      })
        .then(response => response.json())
        .then(data => {
          if (data.success) {
            // Update success screen details if elements exist
            const successType = document.getElementById('success-type');
            const successDate = document.getElementById('success-date');
            const successTime = document.getElementById('success-time');
            if (successType) successType.innerText = activeCard ? activeCard.querySelector('h4').textContent : 'Visit';
            if (successDate) successDate.innerText = dateVal;
            if (successTime) successTime.innerText = timeVal;

            // Show Success
            if (form) form.classList.add('hidden');
            if (nav) nav.classList.add('hidden');
            if (progress) progress.classList.add('hidden');
            if (success) success.classList.remove('hidden');

            // Scroll to success
            const container = document.getElementById('booking-container');
            if (container) container.scrollIntoView({ behavior: 'smooth' });
          } else {
            alert('Booking failed: ' + (data.message || 'Unknown error'));
            btnConfirmBooking.disabled = false;
            btnConfirmBooking.innerHTML = originalText;
          }
        })
        .catch(error => {
          console.error('Booking Error:', error);
          alert('An error occurred. Please try again.');
          btnConfirmBooking.disabled = false;
          btnConfirmBooking.innerHTML = originalText;
        });
    });
  }

  // Feature 13: Visual Polish & Animations (Intersection Observer)
  const observerOptions = {
    threshold: 0.15,
    rootMargin: "0px 0px -50px 0px"
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('active');
        // Optional: Stop observing once revealed
        // observer.unobserve(entry.target);
      }
    });
  }, observerOptions);

  document.querySelectorAll('.reveal').forEach(el => {
    observer.observe(el);
  });
});
