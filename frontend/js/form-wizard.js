document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('quote-form');
    if (!form) return;

    const steps = Array.from(document.querySelectorAll('.form-step'));
    const nextBtn = document.getElementById('btn-next');
    const backBtn = document.getElementById('btn-back');
    const submitBtn = document.getElementById('btn-submit');
    const stepDots = document.querySelectorAll('.step-dot');
    const stepLines = document.querySelectorAll('.step-line');

    let currentStep = 0;

    // Initialize
    updateStep();

    // Next Button Click
    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            if (validateStep(currentStep)) {
                currentStep++;
                updateStep();
            }
        });
    }

    // Back Button Click
    if (backBtn) {
        backBtn.addEventListener('click', () => {
            if (currentStep > 0) {
                currentStep--;
                updateStep();
            }
        });
    }

    // File Upload UI Interaction
    const fileInput = document.querySelector('input[type="file"]');
    const fileZone = document.getElementById('file-drop-zone');
    const fileNameDisplay = document.getElementById('file-name');

    if (fileInput && fileZone) {
        fileInput.addEventListener('change', (e) => {
            if (e.target.files.length > 0) {
                fileNameDisplay.textContent = e.target.files[0].name;
                fileZone.classList.add('border-wood', 'bg-wood/10');
            } else {
                fileNameDisplay.textContent = 'Drag & drop or click to upload';
                fileZone.classList.remove('border-wood', 'bg-wood/10');
            }
        });

        // Drag effects
        ['dragenter', 'dragover'].forEach(eventName => {
            fileZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                fileZone.classList.add('drag-over', 'border-wood');
            }, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            fileZone.addEventListener(eventName, (e) => {
                e.preventDefault();
                fileZone.classList.remove('drag-over');
            }, false);
        });

        fileZone.addEventListener('drop', (e) => {
            const dt = e.dataTransfer;
            const files = dt.files;
            fileInput.files = files;
            // Trigger change event manually
            const event = new Event('change');
            fileInput.dispatchEvent(event);
        });
    }

    // Handle Form Submission Animation
    if (form) {
        form.addEventListener('submit', (e) => {
            e.preventDefault();

            // Simulate submission
            const btnContent = submitBtn.innerHTML;
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<svg class="animate-spin h-5 w-5 text-black" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>';

            // Send to API
            const formData = new FormData(form);
            formData.append('action', 'get_quote');

            fetch('backend/process_contact.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Hide form, show success
                        document.getElementById('wizard-content').classList.add('hidden');
                        document.getElementById('wizard-success').classList.remove('hidden');

                        setupQuoteSuccessActions();

                        // Reset form for next time (optional)
                        form.reset();
                    } else {
                        alert('Quote request failed: ' + data.message);
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = btnContent;
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred. Please try again.');
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = btnContent;
                });
        });
    }

    function setupQuoteSuccessActions() {
        // Collect Data for actions
        const name = document.getElementById('f_name').value || 'Customer';
        const furniture = document.getElementById('p_product').value || 'Furniture';

        // Add to Calendar
        const calBtn = document.getElementById('quote-calendar');
        if (calBtn) {
            calBtn.onclick = () => {
                const title = `Quote Request - ${furniture}`;
                const details = `Requested quote for ${furniture}. Follow up with Wavelength Interiors.`;
                const location = "Wavelength Interiors";

                // Set for tomorrow at 10 AM as a placeholder reminder
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);
                tomorrow.setHours(10, 0, 0, 0);

                const start = tomorrow.toISOString().replace(/-|:|\.\d\d\d/g, "");
                const end = new Date(tomorrow.getTime() + 60 * 60 * 1000).toISOString().replace(/-|:|\.\d\d\d/g, "");

                const url = `https://calendar.google.com/calendar/render?action=TEMPLATE&text=${encodeURIComponent(title)}&details=${encodeURIComponent(details)}&location=${encodeURIComponent(location)}&dates=${start}/${end}`;

                window.open(url, '_blank');
            };
        }

        // WhatsApp
        const waBtn = document.getElementById('quote-whatsapp');
        if (waBtn) {
            waBtn.onclick = (e) => {
                e.preventDefault();
                const phone = "919373154925"; // Updated to match contact details
                const text = `Hi, I just requested a quote for a ${furniture}. My name is ${name}.`;
                const url = `https://wa.me/${phone}?text=${encodeURIComponent(text)}`;
                window.open(url, '_blank');
            }
        }
    }

    function updateStep() {
        // Show/Hide Steps
        steps.forEach((step, index) => {
            if (index === currentStep) {
                step.classList.remove('hidden');
                // Add animation class to children
                step.querySelectorAll('.input-group').forEach((el, i) => {
                    el.style.opacity = '0';
                    el.classList.remove('slide-up-fade');
                    void el.offsetWidth; // trigger reflow
                    el.classList.add('slide-up-fade');
                    el.style.animationDelay = `${i * 100}ms`;
                });
            } else {
                step.classList.add('hidden');
            }
        });

        // Update Buttons
        if (currentStep === 0) {
            if (backBtn) backBtn.classList.add('hidden');
            if (nextBtn) nextBtn.classList.remove('hidden');
            if (submitBtn) submitBtn.classList.add('hidden');
        } else if (currentStep === steps.length - 1) {
            if (backBtn) backBtn.classList.remove('hidden');
            if (nextBtn) nextBtn.classList.add('hidden');
            if (submitBtn) submitBtn.classList.remove('hidden');
        } else {
            if (backBtn) backBtn.classList.remove('hidden');
            if (nextBtn) nextBtn.classList.remove('hidden');
            if (submitBtn) submitBtn.classList.add('hidden');
        }

        // Update Progress Indicator
        stepDots.forEach((dot, index) => {
            if (index <= currentStep) {
                dot.classList.add('active', 'bg-wood', 'border-wood', 'text-black');
                dot.classList.remove('border-gray-600', 'text-gray-400', 'bg-black/40');
            } else {
                dot.classList.remove('active', 'bg-wood', 'border-wood', 'text-black');
                dot.classList.add('border-gray-600', 'text-gray-400', 'bg-black/40');
            }
        });

        stepLines.forEach((line, index) => {
            if (index < currentStep) {
                line.classList.add('active', 'bg-wood');
                line.classList.remove('bg-gray-700');
            } else {
                line.classList.remove('active', 'bg-wood');
                line.classList.add('bg-gray-700');
            }
        });
    }

    function validateStep(stepIndex) {
        const inputs = steps[stepIndex].querySelectorAll('input[required], select[required], textarea[required]');
        let valid = true;
        inputs.forEach(input => {
            if (!input.value.trim()) {
                valid = false;
                input.classList.add('border-red-500');
                // Remove error on input
                input.addEventListener('input', () => {
                    input.classList.remove('border-red-500');
                }, { once: true });
            }
        });

        if (!valid) {
            // Shake animation?
            const currentStepEl = steps[stepIndex];
            currentStepEl.classList.add('animate-pulse');
            setTimeout(() => currentStepEl.classList.remove('animate-pulse'), 200);
        }
        return valid;
    }
});
