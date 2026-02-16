/**
 * Form Security Helper
 * Client-side security utilities for CSRF and honeypot
 */

class FormSecurity {
    constructor(formId, apiEndpoint) {
        this.form = document.getElementById(formId);
        this.apiEndpoint = apiEndpoint;
        this.submitBtn = null;

        if (!this.form) {
            console.error(`Form with ID "${formId}" not found`);
            return;
        }

        this.init();
    }

    init() {
        // Add honeypot field
        this.addHoneypot();

        // Find submit button
        this.submitBtn = this.form.querySelector('button[type="submit"]');

        // Attach submit handler
        this.form.addEventListener('submit', (e) => this.handleSubmit(e));
    }

    /**
     * Add hidden honeypot field to form
     */
    addHoneypot() {
        const honeypot = document.createElement('input');
        honeypot.type = 'text';
        honeypot.name = 'website';
        honeypot.id = 'website';
        honeypot.value = '';
        honeypot.style.position = 'absolute';
        honeypot.style.left = '-9999px';
        honeypot.style.width = '1px';
        honeypot.style.height = '1px';
        honeypot.setAttribute('tabindex', '-1');
        honeypot.setAttribute('autocomplete', 'off');

        this.form.appendChild(honeypot);
    }

    /**
     * Handle form submission
     */
    async handleSubmit(e) {
        e.preventDefault();

        // Hide previous alerts
        this.hideAlerts();

        // Disable submit button
        if (this.submitBtn) {
            this.submitBtn.disabled = true;
            this.submitBtn.innerHTML = '<span class="spinner"></span>Sending...';
        }

        try {
            const formData = new FormData(this.form);

            const response = await fetch(this.apiEndpoint, {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                this.showSuccess(result.message);
                this.form.reset();

                // Reload page to get new CSRF token
                setTimeout(() => {
                    window.location.reload();
                }, 2000);
            } else {
                if (result.data && result.data.errors) {
                    this.showError(result.data.errors.join('<br>'));
                } else {
                    this.showError(result.message);
                }
            }
        } catch (error) {
            console.error('Form submission error:', error);
            this.showError('An unexpected error occurred. Please try again.');
        } finally {
            // Re-enable submit button
            if (this.submitBtn) {
                this.submitBtn.disabled = false;
                this.submitBtn.textContent = 'Send Message';
            }
        }
    }

    /**
     * Show success message
     */
    showSuccess(message) {
        const alert = document.getElementById('alertSuccess') || this.createAlert('success');
        alert.innerHTML = message;
        alert.classList.add('show');

        // Auto-hide after 5 seconds
        setTimeout(() => {
            alert.classList.remove('show');
        }, 5000);
    }

    /**
     * Show error message
     */
    showError(message) {
        const alert = document.getElementById('alertError') || this.createAlert('error');
        alert.innerHTML = message;
        alert.classList.add('show');

        // Auto-hide after 5 seconds
        setTimeout(() => {
            alert.classList.remove('show');
        }, 5000);
    }

    /**
     * Hide all alerts
     */
    hideAlerts() {
        const alerts = this.form.querySelectorAll('.alert');
        alerts.forEach(alert => alert.classList.remove('show'));
    }

    /**
     * Create alert element if it doesn't exist
     */
    createAlert(type) {
        const alert = document.createElement('div');
        alert.id = type === 'success' ? 'alertSuccess' : 'alertError';
        alert.className = `alert alert-${type}`;
        this.form.insertBefore(alert, this.form.firstChild);
        return alert;
    }
}

/**
 * Initialize form with security features
 * @param {string} formId - Form element ID
 * @param {string} apiEndpoint - API endpoint URL
 */
function initializeSecureForm(formId, apiEndpoint) {
    return new FormSecurity(formId, apiEndpoint);
}

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { FormSecurity, initializeSecureForm };
}
