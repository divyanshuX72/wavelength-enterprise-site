
/**
 * Global Custom Dropdown Handler
 * Automatically converts native <select> elements into premium custom dropdowns.
 * 
 * Usage:
 * Add class 'premium-select-target' to any <select> element.
 * Or call PremiumSelect.init() to auto-detect.
 */

class PremiumSelect {
    static init(selector = 'select') {
        const selects = document.querySelectorAll(selector);
        selects.forEach(el => new PremiumSelect(el));
    }

    constructor(selectElement) {
        if (selectElement.dataset.customized === 'true') return; // Avoid double init

        this.nativeSelect = selectElement;
        this.wrapper = null;
        this.trigger = null;
        this.optionsList = null;

        this.setupHTML();
        this.bindEvents();

        this.nativeSelect.dataset.customized = 'true';
    }

    setupHTML() {
        // Create Wrapper
        this.wrapper = document.createElement('div');
        this.wrapper.className = 'premium-select-wrapper w-full'; // Ensure wrapper takes width

        // If original select had an ID, keep it on wrapper for label association if needed? 
        // Better: Find if there's a label pointing to this select ID and update it?
        // For now, relies on CSS 'floating-input' sibling logic or parent.

        // Create Trigger
        this.trigger = document.createElement('div');
        this.trigger.className = 'premium-select-trigger';

        // Copy classes from original select to the trigger
        const blockList = [
            'form-control', 'form-select', 'appearance-none', 'block', 'w-full', // structural (wrapper handles w-full)
            'bg-black/30', 'bg-transparent', 'border', 'border-gray-600', 'text-white', // visuals we replace
            'py-3', 'px-4', 'rounded-lg', 'rounded', 'shadow-sm', // metrics we replace
            'focus:outline-none', 'focus:border-wood', 'focus:ring-1', 'focus:ring-wood', 'transition-colors',
            'cursor-pointer', 'text-sm', 'text-base',
            'absolute', 'relative', 'inset-0', 'active', 'opacity-0', 'z-10', 'z-20', 'z-30', 'h-full', // Layout breakers
            'pl-10', 'pl-12', // Padding conflicts (handled by flex or specific logic)
            'premium-input' // We don't want the input styles (like height/borders) clashing with trigger
        ];

        // START FIX: Icon Handling
        // If the original select has 'pl-10' (padding-left 2.5rem), it means there's an icon.
        // We should apply that padding to the trigger so text doesn't overlap icon.
        if (this.nativeSelect.classList.contains('pl-10')) {
            this.trigger.style.paddingLeft = '2.5rem';
        }

        const originalClasses = Array.from(this.nativeSelect.classList)
            .filter(c => !blockList.includes(c));

        if (originalClasses.length) this.trigger.classList.add(...originalClasses); // Apply visual styles to trigger

        // Insert wrapper after select
        this.nativeSelect.parentNode.insertBefore(this.wrapper, this.nativeSelect.nextSibling);

        // Move select into wrapper (hidden by CSS)
        this.wrapper.appendChild(this.nativeSelect);

        // Initial Text Update
        this.updateTriggerText();

        // Arrow
        const arrow = document.createElement('div');
        arrow.className = 'premium-select-arrow';
        this.trigger.appendChild(arrow); // Arrow is last child

        this.wrapper.appendChild(this.trigger);

        // Create Options Panel
        this.optionsList = document.createElement('div');
        this.optionsList.className = 'premium-select-options';

        this.fillOptions();

        this.wrapper.appendChild(this.optionsList);
    }

    fillOptions() {
        this.optionsList.innerHTML = '';
        Array.from(this.nativeSelect.options).forEach(opt => {
            if (opt.disabled) return; // Skip placeholders generally, or style them?

            const optionDiv = document.createElement('div');
            optionDiv.className = 'premium-option';
            optionDiv.textContent = opt.text;
            optionDiv.dataset.value = opt.value;

            if (opt.selected) {
                optionDiv.classList.add('selected');
            }

            optionDiv.addEventListener('click', (e) => {
                e.stopPropagation();
                this.selectOption(opt.value, opt.text);
            });

            this.optionsList.appendChild(optionDiv);
        });
    }

    bindEvents() {
        // Toggle Open
        this.trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            // Close others
            document.querySelectorAll('.premium-select-wrapper').forEach(w => {
                if (w !== this.wrapper) {
                    w.classList.remove('open');
                    w.style.zIndex = 'auto'; // Reset others
                }
            });
            this.wrapper.classList.toggle('open');
            if (this.wrapper.classList.contains('open')) {
                this.wrapper.style.zIndex = '50'; // Raise current
            } else {
                this.wrapper.style.zIndex = 'auto';
            }
        });

        // Close on Outside Click
        document.addEventListener('click', () => {
            if (this.wrapper.classList.contains('open')) {
                this.wrapper.classList.remove('open');
                this.wrapper.style.zIndex = 'auto';
            }
        });

        // Sync Logic: If native select changes programmatically (rare but possible)
        this.nativeSelect.addEventListener('change', () => {
            this.updateTriggerText();
            this.fillOptions(); // Re-render in case options changed
        });
    }



    selectOption(value, text) {
        // Update Native Select
        this.nativeSelect.value = value;

        // Dispatch Input/Change Event so other scripts know (validation, etc)
        const event = new Event('change', { bubbles: true });
        this.nativeSelect.dispatchEvent(event);

        // Update UI
        this.updateTriggerText();

        // Update Selection State in UI
        const allOpts = this.optionsList.querySelectorAll('.premium-option');
        allOpts.forEach(o => {
            if (o.dataset.value === value) o.classList.add('selected');
            else o.classList.remove('selected');
        });

        this.wrapper.classList.remove('open');
        this.wrapper.style.zIndex = 'auto';
    }

    updateTriggerText() {
        const selected = this.nativeSelect.options[this.nativeSelect.selectedIndex];
        const textToDisplay = selected ? selected.text : '';
        const hasValue = selected && selected.value !== "";

        // Manage Text Span (reuse or create)
        let span = this.trigger.querySelector('span'); // Find ANY span
        if (!span) {
            span = document.createElement('span');
            this.trigger.prepend(span); // Add as first child
        }
        // Ensure class is present
        span.classList.add('premium-select-text');
        span.textContent = textToDisplay;

        // Manage Empty State Logic for Floating Labels
        if (!hasValue) {
            this.trigger.classList.add('placeholder');
            this.wrapper.classList.add('empty'); // Helper for CSS to hide text if label floats
            this.wrapper.classList.remove('has-value'); // Ensure removal
            // Also helpful for floating label logic to know it's "placeholder-shown"
        } else {
            this.trigger.classList.remove('placeholder');
            this.wrapper.classList.remove('empty');
            this.wrapper.classList.add('has-value'); // Signal for CSS
        }

        // Also update data attribute for styling flexibility
        this.wrapper.dataset.value = hasValue ? selected.value : '';
    }
}

// Auto-Init on Load
document.addEventListener('DOMContentLoaded', () => {
    // Target all Selects that are NOT inside the existing calculator logic (which uses its own structure)
    // The calculator ones don't use <select> tags in the final HTML (they use divs). 
    // EXCEPT the `contact.html` ones we saw are <select>.

    // We target selects inside the 'booking' and 'quote' sections
    PremiumSelect.init('select:not(#excluded-id)');
});
