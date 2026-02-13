/**
 * Booking Wizard Logic
 * Handles multi-step appointment scheduling with conditional logic.
 */

document.addEventListener('DOMContentLoaded', () => {
    const wizardForm = document.getElementById('booking-wizard-form');
    if (!wizardForm) return;

    // State
    const state = {
        step: 1,
        type: null, // 'home', 'measurement', 'showroom'
        data: {
            address: '',
            landmark: '',
            pincode: '',
            locationType: '',
            date: '',
            time: ''
        }
    };

    // DOM Elements
    const steps = document.querySelectorAll('.booking-step');
    const indicators = document.querySelectorAll('.step-indicator');
    const progressBars = document.querySelectorAll('.progress-bar-fill');
    const nextBtn = document.getElementById('bk-next-btn');
    const prevBtn = document.getElementById('bk-prev-btn');
    const finishBtn = document.getElementById('btn-finish-booking');
    const navContainer = document.getElementById('booking-nav');

    // Preview Elements
    const summaryType = document.getElementById('summary-type');
    const summaryAddressBlock = document.getElementById('summary-address-block');
    const summaryAddress = document.getElementById('summary-address');
    const summaryDatetime = document.getElementById('summary-datetime');

    // Initialize
    init();

    function init() {
        bindEvents();
        updateUI();
        setupDateInput();
    }

    function bindEvents() {
        // Step 1: Type Selection
        const typeInputs = document.querySelectorAll('input[name="visit_type"]');
        typeInputs.forEach(input => {
            input.addEventListener('change', (e) => {
                state.type = e.target.value;
                updatePreview();
                // Auto-advance for better UX
                setTimeout(() => goToStep(state.type === 'showroom' ? 3 : 2), 300);
            });
        });

        // Step 3: Time Selection
        const timeSlots = document.querySelectorAll('.slot-btn');
        timeSlots.forEach(btn => {
            btn.addEventListener('click', () => {
                // Deselect others
                timeSlots.forEach(b => {
                    b.classList.remove('bg-wood', 'text-black', 'border-wood', 'ring-2', 'ring-wood');
                    b.classList.add('bg-black/20', 'text-gray-300', 'border-gray-700');
                });

                // Select clicked
                btn.classList.remove('bg-black/20', 'text-gray-300', 'border-gray-700');
                btn.classList.add('bg-wood', 'text-black', 'border-wood', 'ring-2', 'ring-wood');

                state.data.time = btn.dataset.time;
                document.getElementById('bk_time').value = state.data.time;
                updatePreview();
            });
        });

        // Date Change
        const dateInput = document.getElementById('bk_date');
        dateInput.addEventListener('change', (e) => {
            state.data.date = e.target.value;
            updatePreview();
        });

        // Success Actions (Bind immediately)
        const calBtn = document.getElementById('btn-add-calendar');
        if (calBtn) {
            calBtn.addEventListener('click', (e) => {
                e.preventDefault(); // Just in case

                try {
                    const title = "Showroom Visit - Wavelength";
                    const location = state.data.type === 'showroom' ? 'Wavelength Showroom, 123 Design District' : (state.data.address || 'Client Location');
                    const details = `Visit Type: ${(state.type || 'Showroom').toUpperCase()}\nDetails: Discussing project requirements.`;

                    // Parse Date safely
                    let startDate, endDate;
                    if (state.data.date && state.data.time) {
                        try {
                            const dateStr = `${state.data.date} ${state.data.time}`;
                            const d = new Date(dateStr);
                            if (!isNaN(d.getTime())) {
                                startDate = d;
                            } else {
                                // Fallback: just use date
                                startDate = new Date(state.data.date);
                                startDate.setHours(10, 0, 0, 0); // Default 10 AM
                            }
                        } catch (err) {
                            startDate = new Date();
                        }
                    } else {
                        startDate = new Date();
                    }

                    // End time = start + 1 hour
                    endDate = new Date(startDate.getTime() + 60 * 60 * 1000);

                    const startISO = startDate.toISOString().replace(/-|:|\.\d\d\d/g, "");
                    const endISO = endDate.toISOString().replace(/-|:|\.\d\d\d/g, "");

                    const url = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&details=${encodeURIComponent(details)}&location=${encodeURIComponent(location)}&dates=${startISO}/${endISO}`;

                    window.open(url, '_blank');
                } catch (error) {
                    console.error("Calendar Error:", error);
                    alert("Could not open calendar. Please check your date settings.");
                }
            });
        }

        const waBtn = document.getElementById('btn-whatsapp');
        if (waBtn) {
            waBtn.addEventListener('click', (e) => {
                e.preventDefault();
                const phone = "919373154925";
                const dateText = state.data.date || 'a future date';
                const timeText = state.data.time || '';
                const text = `Hi, I just booked a ${state.type || 'Showroom'} visit for ${dateText} ${timeText}.`;
                const url = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
                window.open(url, '_blank');
            });
        }

        // Navigation
        nextBtn.addEventListener('click', () => nextStep());
        prevBtn.addEventListener('click', () => prevStep());

        // Submission
        wizardForm.addEventListener('submit', (e) => {
            e.preventDefault();
            submitBooking();
        });
    }

    function setupDateInput() {
        const dateInput = document.getElementById('bk_date');
        const today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
    }

    function nextStep() {
        if (!validateStep(state.step)) return;

        let next = state.step + 1;

        // Skip address step if showroom
        if (state.step === 1 && state.type === 'showroom') {
            next = 3;
        }

        goToStep(next);
    }

    function prevStep() {
        let prev = state.step - 1;

        // Skip address step if showroom
        if (state.step === 3 && state.type === 'showroom') {
            prev = 1;
        }

        goToStep(prev);
    }

    function goToStep(step) {
        state.step = step;
        updateUI();
    }

    function updateUI() {
        // Show/Hide Steps with Animation
        steps.forEach(el => {
            const stepNum = parseInt(el.dataset.step);
            if (stepNum === state.step) {
                el.classList.remove('hidden');
                // Simple fade/slide in
                el.classList.remove('opacity-0', 'translate-x-4');
                el.classList.add('slide-up-fade');
            } else {
                el.classList.add('hidden');
            }
        });

        // Update Indicators
        indicators.forEach(el => {
            const stepNum = parseInt(el.dataset.step);
            if (stepNum <= state.step) {
                el.classList.add('active', 'bg-wood', 'text-black', 'border-wood');
                el.classList.remove('bg-gray-800', 'text-gray-400', 'border-gray-600');
            } else {
                el.classList.remove('active', 'bg-wood', 'text-black', 'border-wood');
                el.classList.add('bg-gray-800', 'text-gray-400', 'border-gray-600');
            }
        });

        // Update Progress Bars
        progressBars.forEach(bar => {
            const stepNum = parseInt(bar.dataset.step); // 1 connects 1->2, 2 connects 2->3
            if (stepNum < state.step) {
                // If we are at step 2, bar 1 (1->2) should be full.
                // If we skipped step 2 (showroom), both bars might need handling or just rely on logic
                if (state.type === 'showroom' && stepNum === 1 && state.step === 3) {
                    bar.style.width = '100%';
                    // Also fill second bar
                    if (progressBars[1]) progressBars[1].style.width = '100%';
                } else {
                    bar.style.width = '100%';
                }
            } else {
                bar.style.width = '0%';
            }
        });

        // Update Buttons
        if (state.step === 1) {
            prevBtn.classList.add('hidden');
            nextBtn.classList.remove('hidden');
            navContainer.classList.remove('hidden');
        } else if (state.step === 3) {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.add('hidden'); // Finish button is inside step 3
            navContainer.classList.remove('hidden');
        } else {
            prevBtn.classList.remove('hidden');
            nextBtn.classList.remove('hidden');
            navContainer.classList.remove('hidden');
        }
    }

    function validateStep(step) {
        let valid = true;

        if (step === 1) {
            if (!state.type) {
                shake(document.querySelector('[data-step="1"]'));
                valid = false;
            }
        } else if (step === 2) {
            const address = document.getElementById('bk_address');
            const pincode = document.getElementById('bk_pincode');

            if (!address.value.trim()) { highlightError(address); valid = false; }
            if (!pincode.value.trim() || pincode.value.length < 6) { highlightError(pincode); valid = false; }

            // Save data
            state.data.address = address.value;
            state.data.landmark = document.getElementById('bk_landmark').value;
            state.data.pincode = pincode.value;
        }

        return valid;
    }

    function highlightError(el) {
        el.classList.add('border-red-500', 'ring-1', 'ring-red-500');
        el.addEventListener('input', () => {
            el.classList.remove('border-red-500', 'ring-1', 'ring-red-500');
        }, { once: true });
    }

    function shake(el) {
        el.classList.add('animate-pulse'); // Tailwind pulse is subtle, better than nothing
        setTimeout(() => el.classList.remove('animate-pulse'), 500);
    }

    function updatePreview() {
        // Type
        const labels = { 'home': 'Home Visit', 'measurement': 'Measurement', 'showroom': 'Showroom Visit' };
        summaryType.innerText = labels[state.type] || '--';

        // Address
        if (state.type === 'showroom') {
            summaryAddressBlock.classList.add('hidden');
        } else {
            summaryAddressBlock.classList.remove('hidden');
            const addr = document.getElementById('bk_address').value || 'No address provided';
            const city = document.getElementById('bk_pincode').value ? `, ${document.getElementById('bk_pincode').value}` : '';
            summaryAddress.innerText = addr + city;
        }

        // Date & Time
        const d = state.data.date ? new Date(state.data.date).toLocaleDateString('en-US', { month: 'short', day: 'numeric' }) : '';
        const t = state.data.time;
        if (d && t) {
            summaryDatetime.innerText = `${d} at ${t}`;
            summaryDatetime.classList.add('text-wood');
        } else {
            summaryDatetime.innerText = 'Select date & time';
            summaryDatetime.classList.remove('text-wood');
        }
    }

    function submitBooking() {
        // Final Validation (Step 3)
        if (!state.data.date || !state.data.time) {
            alert('Please select a Date and Time.');
            return;
        }

        // Loading State
        const originalText = finishBtn.innerHTML;
        finishBtn.disabled = true;
        finishBtn.innerHTML = `<svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg> Processing...`;

        // Simulate API
        setTimeout(() => {
            // Update Success Text
            document.getElementById('success-type').innerText = summaryType.innerText;
            document.getElementById('success-date').innerText = state.data.date;
            document.getElementById('success-time').innerText = state.data.time;

            // Show Success
            wizardForm.classList.add('hidden');
            document.getElementById('booking-progress').classList.add('hidden');
            document.getElementById('booking-success').classList.remove('hidden');

            // Scroll to success
            const bookingSection = document.getElementById('booking');
            if (bookingSection) bookingSection.scrollIntoView({ behavior: 'smooth' });

        }, 1500);
    }
});
