/**
 * Premium Calculator Logic - Production Ready
 * Features:
 * - Floating Label Support
 * - 3-Dimension Support (L/W, H, D)
 * - Functional Unit Toggle (ft ↔ in)
 * - Validator & Live Pricing
 * - Safe Event Binding
 */

document.addEventListener('DOMContentLoaded', () => {

    // --- Configuration ---
    const config = {
        rates: {
            tv_unit: 3000,    // per sqft (Frontal Area)
            wardrobe: 1800,   // per sqft (Frontal Area)
            bed: 25000,       // base price (Queen)
            kitchen: 2200,    // per sqft (Elevation Area)
            sofa: 15000       // per seat
        },
        multipliers: {
            // Material
            mdf: 1,
            plywood: 1.25,
            teak: 2.2,
            // Finish
            laminate: 1,
            acrylic: 1.4,
            veneer: 1.8,
            pu: 1.5
        },
        // Validation Constraints (in Feet)
        constraints: {
            length: { min: 1, max: 20 },
            height: { min: 1, max: 12 },
            depth: { min: 0.5, max: 4 },
            width: { min: 1, max: 20 }
        }
    };

    // --- State ---
    // All dimensions stored internally in FEET
    const state = {
        type: 'tv_unit',
        material: 'mdf',
        finish: 'laminate',

        // Default dimensions
        dimensions: {
            length: 6,
            height: 7,
            depth: 1.5,
            width: 4
        },

        // Active Units for input display
        units: {
            length: 'ft',
            height: 'ft',
            depth: 'ft',
            width: 'ft'
        },

        bedSize: 1,      // 1=Queen, 0.8=Single, 1.3=King
        bedStorage: 0,   // Price add-on
        sofaSeats: 3
    };

    // --- DOM Elements ---
    const elements = {
        dynamicFields: document.getElementById('calc-dynamic-fields'),
        displayPrice: document.getElementById('display-price'),
        breakdownBase: document.getElementById('bd-base'),
        breakdownSize: document.getElementById('bd-size'),
        breakdownMat: document.getElementById('bd-mat'),
        bookBtn: document.getElementById('btn-save-quote')
    };

    // --- Initialization ---
    init();

    function init() {
        bindStaticDropdowns();
        renderDynamicFields();
        updatePrice(); // Initial Calc
        bindBookButton();

        // Global click to close dropdowns
        document.addEventListener('click', (e) => closeAllDropdowns());
    }

    // --- Dynamic Field Generation ---
    function renderDynamicFields() {
        const container = elements.dynamicFields;
        if (!container) return;

        // Determine Layout Columns for container class
        let gridClass = 'calc-grid grid md:grid-cols-2 xl:grid-cols-3 gap-6 auto-rows-max calc-reveal active';
        container.className = gridClass;

        // Use DocumentFragment for performance
        const fragment = document.createDocumentFragment();

        // 1. Generate Fields based on Type
        if (state.type === 'tv_unit') {
            fragment.appendChild(createDimensionField('Length', 'length', '📏', 'Wall Width'));
            fragment.appendChild(createDimensionField('Height', 'height', '⬆️', 'Floor to Ceiling'));
            fragment.appendChild(createDimensionField('Depth', 'depth', '↘️', 'Standard 1.5ft'));
        }
        else if (state.type === 'wardrobe') {
            fragment.appendChild(createDimensionField('Width', 'width', '↔️', 'Total Width'));
            fragment.appendChild(createDimensionField('Height', 'height', '⬆️', 'User Height'));
            fragment.appendChild(createDimensionField('Depth', 'depth', '↘️', 'Standard 2ft'));
        }
        else if (state.type === 'kitchen') {
            fragment.appendChild(createDimensionField('Length', 'length', '📏', 'Running Length'));
            fragment.appendChild(createDimensionField('Height', 'height', '⬆️', 'Cabinet Height'));
            fragment.appendChild(createDimensionField('Depth', 'depth', '↘️', 'Counter Depth'));
        }
        else if (state.type === 'bed') {
            fragment.appendChild(createSelectField('Bed Size', 'sel-bed-size', '🛏️', [
                { val: 1, txt: 'Queen (Standard)' },
                { val: 0.8, txt: 'Single' },
                { val: 1.3, txt: 'King Size' }
            ], state.bedSize));

            fragment.appendChild(createSelectField('Storage', 'sel-bed-storage', '📦', [
                { val: 0, txt: 'No Storage' },
                { val: 3000, txt: 'With Drawers' },
                { val: 5000, txt: 'Hydraulic Lift' }
            ], state.bedStorage));
        }
        else if (state.type === 'sofa') {
            fragment.appendChild(createDimensionField('Seats', 'sofaSeats', '🛋️', 'Number of Seats', false));
        }

        // Clear and Append
        container.innerHTML = '';
        container.appendChild(fragment);

        // 2. Re-bind Events
        bindDynamicEvents();
    }

    // HTML Generator: Input Field (Returns Node)
    function createDimensionField(label, key, icon, tooltip, hasUnits = true) {
        // Get current value
        const storedVal = key === 'sofaSeats' ? state.sofaSeats : state.dimensions[key];
        const currentUnit = hasUnits ? state.units[key] : '';

        // Calculate Display Value
        let displayVal = storedVal;
        if (hasUnits && currentUnit === 'in') {
            displayVal = parseFloat((storedVal * 12).toFixed(1));
        } else if (hasUnits) {
            displayVal = parseFloat(storedVal.toFixed(2));
        }

        const wrapper = document.createElement('div');
        wrapper.className = 'calc-field-group relative z-20';

        // Unit Wrapper HTML
        const unitHtml = hasUnits ? `
            <div class="calc-unit-group" data-key="${key}">
                <div class="calc-unit-btn ${currentUnit === 'ft' ? 'active' : ''}" data-unit="ft">ft</div>
                <div class="calc-unit-btn ${currentUnit === 'in' ? 'active' : ''}" data-unit="in">in</div>
            </div>
        ` : '';

        wrapper.innerHTML = `
<div class="rounded-xl border border-white/10 bg-gradient-to-b from-black/40 to-black/20
            px-4 py-3 min-h-[92px] flex flex-col justify-between
            focus-within:border-wood focus-within:ring-1 focus-within:ring-wood transition">

  <div class="flex items-center justify-between">
    <div class="flex items-center gap-2 text-xs text-gray-400 uppercase tracking-wide">
      <span>${icon}</span>
      <span>${label}</span>
    </div>

    ${unitHtml}
  </div>

  <div class="flex items-end gap-2 mt-2">
    <input type="number"
      id="inp-${key}"
      data-key="${key}"
      value="${displayVal}"
      min="0"
      step="${currentUnit === 'in' ? 1 : 0.1}"
      inputmode="decimal"
      class="calc-input bg-transparent outline-none text-white text-2xl font-semibold w-full"
      placeholder="0" />
  </div>

  <div class="text-[11px] text-gray-500 mt-1" id="help-${key}"></div>
</div>
`;

        return wrapper;
    }

    // HTML Generator: Select Field (Returns Node)
    function createSelectField(label, id, icon, options, currentVal) {
        let optsHtml = '';
        let selectedText = '';

        options.forEach(o => {
            const isSel = o.val == currentVal; // soft eq
            if (isSel) selectedText = o.txt;
            optsHtml += `<div class="calc-option px-4 py-3 hover:bg-wood/20 cursor-pointer text-gray-300 hover:text-white transition-colors ${isSel ? 'selected bg-wood/10 font-medium text-wood' : ''}" data-value="${o.val}">${o.txt}</div>`;
        });

        if (!selectedText) selectedText = options[0].txt;

        const wrapper = document.createElement('div');
        wrapper.className = 'calc-field-group relative z-20';
        wrapper.innerHTML = `
            <div class="calc-select-wrapper has-value" id="${id}">
                <button type="button" class="calc-select-trigger w-full min-h-[56px] flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-white/10 bg-black/30 relative z-20 focus:border-wood focus:ring-1 focus:ring-wood transition-all">
                    
                    <div class="flex items-center gap-3 flex-1 min-w-0">
                        <span class="icon text-gray-400 shrink-0">
                            ${icon}
                        </span>

                        <span class="selected-value text-white font-medium truncate leading-normal">
                            ${selectedText}
                        </span>
                    </div>

                    <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200 arrow-icon"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="calc-dropdown absolute left-0 top-full z-[999] mt-2 w-full rounded-xl border border-white/10 bg-[#1a1410] shadow-2xl overflow-hidden hidden">
                    ${optsHtml}
                </div>
            </div>`;

        return wrapper;
    }

    // --- Logic & Events ---

    function bindStaticDropdowns() {
        // Bind the static dropdowns in contact.html (Type, Material, Finish)
        setupDropdown(document.getElementById('sel-type'), (val) => {
            state.type = val;
            renderDynamicFields();
            setTimeout(updatePrice, 50);
        });
        setupDropdown(document.getElementById('sel-material'), (val) => {
            state.material = val;
        });
        setupDropdown(document.getElementById('sel-finish'), (val) => {
            state.finish = val;
        });
    }

    function bindDynamicEvents() {
        // Bind newly created Selects (Bed Size, Storage)
        document.querySelectorAll('#calc-dynamic-fields .calc-select-wrapper').forEach(wrapper => {
            setupDropdown(wrapper, (val) => {
                const id = wrapper.id;
                if (id === 'sel-bed-size') state.bedSize = parseFloat(val);
                if (id === 'sel-bed-storage') state.bedStorage = parseFloat(val);
            });
        });

        // Bind Inputs using safeBind pattern
        document.querySelectorAll('.calc-input').forEach(input => {
            if (input.dataset.bound) return; // Skip if already bound
            input.dataset.bound = "1";

            input.addEventListener('input', handleInput);
            input.addEventListener('focus', () => updatePrice());

            // Helper update on init
            const key = input.dataset.key;
            if (key && state.dimensions[key]) updateHelper(key);
        });

        // Bind Unit Toggles
        document.querySelectorAll('.calc-unit-btn').forEach(btn => {
            if (btn.dataset.bound) return;
            btn.dataset.bound = "1";
            btn.addEventListener('click', handleUnitToggle);
        });
    }

    function setupDropdown(wrapper, onChange) {
        if (!wrapper || wrapper.dataset.bound === "1") return;
        wrapper.dataset.bound = "1";

        const trigger = wrapper.querySelector('.calc-select-trigger');
        const dropdown = wrapper.querySelector('.calc-dropdown');
        const valueNode = wrapper.querySelector('.selected-value');
        const options = wrapper.querySelectorAll('.calc-option');

        trigger.addEventListener('click', (e) => {
            e.stopPropagation();
            closeAllDropdowns(wrapper);
            wrapper.classList.toggle('open');
            dropdown.classList.toggle('hidden');
        });

        options.forEach(opt => {
            opt.addEventListener('click', (e) => {
                e.stopPropagation();

                options.forEach(o => o.classList.remove('selected', 'bg-wood/10', 'text-wood'));
                opt.classList.add('selected', 'bg-wood/10', 'text-wood');

                valueNode.textContent = opt.textContent.trim();

                wrapper.classList.remove('open');
                dropdown.classList.add('hidden');

                if (onChange) onChange(opt.dataset.value);
                updatePrice();
            });
        });
    }

    function openDropdown(wrapper) {
        wrapper.classList.add('open');
        const dropdown = wrapper.querySelector('.calc-dropdown');
        if (dropdown) {
            dropdown.classList.remove('hidden');
            // Trigger reflow
            void dropdown.offsetWidth;
            dropdown.classList.remove('opacity-0', '-translate-y-2');
        }
    }

    function closeDropdown(wrapper) {
        wrapper.classList.remove('open');
        const dropdown = wrapper.querySelector('.calc-dropdown');
        if (dropdown) {
            dropdown.classList.add('opacity-0', '-translate-y-2');
            setTimeout(() => {
                if (!wrapper.classList.contains('open')) {
                    dropdown.classList.add('hidden');
                }
            }, 200);
        }
    }

    function closeAllDropdowns(except) {
        document.querySelectorAll('.calc-select-wrapper').forEach(w => {
            if (w !== except && w.classList.contains('open')) {
                closeDropdown(w);
            }
        });
    }

    function handleInput(e) {
        const inp = e.target;
        let v = parseFloat(inp.value);

        // ✅ hard clamp
        if (isNaN(v) || v < 0) v = 0;

        // optional max guard
        if (v > 1000) v = 1000;

        inp.value = v;

        const key = inp.dataset.key;

        if (key === 'sofaSeats') {
            state.sofaSeats = v;
        } else {
            const unit = state.units[key];
            state.dimensions[key] = (unit === 'in') ? v / 12 : v;

            const help = document.getElementById(`help-${key}`);
            if (help) {
                // Update helper directly for immediate feedback
                if (unit === 'ft') {
                    const inches = Math.round(state.dimensions[key] * 12);
                    help.textContent = `= ${inches} in`;
                } else {
                    help.textContent = `= ${state.dimensions[key].toFixed(2)} ft`;
                }
            }

            validateInput(key, state.dimensions[key]);
        }

        updatePrice();
    }

    function handleUnitToggle(e) {
        e.stopPropagation();
        const btn = e.target;
        if (btn.classList.contains('active')) return;

        const group = btn.closest('.calc-unit-group');
        const key = group.dataset.key;
        const newUnit = btn.dataset.unit;

        // Update State
        state.units[key] = newUnit;

        // Update UI
        group.querySelectorAll('.calc-unit-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        // Update Input Value
        const input = document.getElementById(`inp-${key}`);
        const currentFt = state.dimensions[key];

        if (newUnit === 'in') {
            let displayVal = Math.round(currentFt * 12);
            if (displayVal < 0 || isNaN(displayVal)) displayVal = 0;
            input.value = displayVal;
            input.step = "1";
        } else {
            let displayVal = parseFloat(currentFt.toFixed(2));
            if (displayVal < 0 || isNaN(displayVal)) displayVal = 0;
            input.value = displayVal;
            input.step = "0.1";
        }

        updateHelper(key);
    }

    // --- Helpers ---

    function validateInput(key, valFt) {
        const rules = config.constraints[key];
        const input = document.getElementById(`inp-${key}`);
        const box = document.getElementById(`box-${key}`) || (input ? input.closest('.rounded-xl') : null);
        const err = document.getElementById(`err-${key}`);
        const help = document.getElementById(`help-${key}`); // Fallback for error

        if (!box) return;

        if (rules && (valFt < rules.min || valFt > rules.max)) {
            box.classList.add('border-red-500');
            box.classList.remove('border-white/10', 'focus-within:border-wood');

            if (err) {
                err.innerText = `Limit: ${rules.min}-${rules.max} ft`;
                err.classList.remove('opacity-0', 'translate-y-[-5px]');
            } else if (help) {
                // Use help text for error
                help.innerText = `Limit: ${rules.min}-${rules.max} ft`;
                help.classList.add('text-red-500');
                help.classList.remove('text-gray-500');
            }
        } else {
            box.classList.remove('border-red-500');
            box.classList.add('border-white/10', 'focus-within:border-wood'); // Restore

            if (err) {
                err.classList.add('opacity-0', 'translate-y-[-5px]');
            } else if (help) {
                // Restore help text style (content updated by updateHelper)
                help.classList.remove('text-red-500');
                help.classList.add('text-gray-500');
                updateHelper(key); // Refresh content
            }
        }
    }

    function updateHelper(key) {
        const help = document.getElementById(`help-${key}`);
        if (!help) return;

        const valFt = state.dimensions[key] || 0;
        const currentUnit = state.units[key];

        if (currentUnit === 'ft') {
            const inches = Math.round(valFt * 12);
            help.innerText = `= ${inches} in`;
        } else {
            help.innerText = `= ${valFt.toFixed(2)} ft`;
        }
    }

    // --- Price Calculation ---

    function updatePrice() {
        requestAnimationFrame(calculateTotal);
    }

    function calculateTotal() {
        // Safety Clean
        Object.keys(state.dimensions).forEach(k => {
            if (state.dimensions[k] < 0 || isNaN(state.dimensions[k])) {
                state.dimensions[k] = 0;
            }
        });

        const { rates, multipliers: mX } = config;
        const d = state.dimensions;

        let baseCost = 0;

        // 1. Calculate Base Cost based on Type
        if (state.type === 'tv_unit') {
            // Area = L * H. Depth logic: Standard 1.5. If > 1.6, +15% per ft extra
            const area = d.length * d.height;
            let depthMult = 1;
            if (d.depth > 1.6) {
                depthMult = 1 + ((d.depth - 1.5) * 0.2); // +20% per extra ft depth
            }
            baseCost = area * rates.tv_unit * depthMult;
        }
        else if (state.type === 'wardrobe') {
            const area = d.width * d.height; // Use width for wardrobe frontal area
            let depthMult = 1;
            if (d.depth > 2.2) depthMult = 1.2;
            baseCost = area * rates.wardrobe * depthMult;
        }
        else if (state.type === 'kitchen') {
            // Simple L * H for now
            const area = d.length * d.height;
            baseCost = area * rates.kitchen;
        }
        else if (state.type === 'bed') {
            const sizeMult = state.bedSize || 1;
            baseCost = (rates.bed * sizeMult) + (state.bedStorage || 0);
        }
        else if (state.type === 'sofa') {
            baseCost = (state.sofaSeats || 1) * rates.sofa;
        }

        // 2. Apply Material & Finish Multipliers
        // (Only applies to woodwork, maybe not Sofa? Assuming Sofa is fully upholstered)
        if (state.type !== 'sofa') {
            const matMult = mX[state.material] || 1;
            const finMult = mX[state.finish] || 1;
            baseCost = baseCost * matMult * finMult;
        }

        // 3. Render
        animateTo(baseCost);
        updateBreakdown(baseCost);
    }

    function animateTo(finalValue) {
        const el = elements.displayPrice;
        if (!el) return;

        const startVal = parseInt(el.dataset.val || 0);
        const endVal = Math.round(finalValue);

        if (startVal === endVal) return;

        // Setup Animation
        el.dataset.val = endVal;
        const duration = 800;
        const startTime = performance.now();

        function step(now) {
            const progress = Math.min((now - startTime) / duration, 1);
            const ease = 1 - Math.pow(1 - progress, 4); // EaseOutQuart

            const current = Math.floor(startVal + (endVal - startVal) * ease);
            el.innerText = current.toLocaleString('en-IN');

            if (progress < 1) requestAnimationFrame(step);
        }

        requestAnimationFrame(step);
    }

    function updateBreakdown(cost) {
        // Just examples for the breakdown UI
        if (elements.breakdownBase) elements.breakdownBase.innerText = '₹' + Math.round(cost * 0.7).toLocaleString('en-IN');

        if (elements.breakdownSize) {
            let txt = 'Standard';
            const d = state.dimensions;
            if (state.type === 'tv_unit') txt = `${d.length}x${d.height} ft`;
            if (state.type === 'bed') txt = state.bedSize === 1 ? 'Queen' : 'Custom';
            elements.breakdownSize.innerText = txt;
        }

        if (elements.breakdownMat) {
            if (state.type !== 'sofa') {
                const m = state.material.toUpperCase();
                const f = state.finish.charAt(0).toUpperCase() + state.finish.slice(1);
                elements.breakdownMat.innerText = `${m} + ${f}`;
            } else {
                elements.breakdownMat.innerText = "Fabric / Leather";
            }
        }
    }

    function bindBookButton() {
        const btn = document.getElementById('btn-save-quote');
        if (!btn || btn.dataset.bound === "1") return;
        btn.dataset.bound = "1";

        btn.addEventListener('click', () => {

            // 1️⃣ Scroll to booking form
            const section = document.getElementById('booking-section');
            if (section) {
                section.scrollIntoView({
                    behavior: "smooth",
                    block: "start"
                });
            }

            // 2️⃣ Auto-fill form values
            const d = state.dimensions;

            const setVal = (id, val) => {
                const el = document.getElementById(id);
                if (el) el.value = val;
            };

            setVal("p_product", state.type);
            setVal("p_length", d.length.toFixed(2));
            setVal("p_height", d.height.toFixed(2));
            setVal("p_depth", d.depth.toFixed(2));

            // 3️⃣ Fill message with quote summary
            const msg =
                `Quote Request:
Type: ${state.type}
Size: ${d.length.toFixed(2)} x ${d.height.toFixed(2)} x ${d.depth.toFixed(2)} ft
Material: ${state.material}
Finish: ${state.finish}
Estimate: ₹${elements.displayPrice.innerText}`;

            setVal("p_message", msg);

            // 4️⃣ Open WhatsApp
            const wa = `https://wa.me/919373154925?text=${encodeURIComponent(msg)}`;
            window.open(wa, "_blank");

        });
    }

});
