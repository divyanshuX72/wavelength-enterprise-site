/**
 * AI Furniture Assistant
 * A self-contained module that injects a floating chat button and modal.
 * Uses rule-based logic to simulate an AI consultant.
 */

(function () {
    // 1. styles
    const styles = `
      <style>
        .ai-glass {
            background: rgba(18, 18, 18, 0.85);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 12px 40px 0 rgba(0, 0, 0, 0.6), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }
        .ai-btn-gradient {
            background: linear-gradient(135deg, #1a120b 0%, #3e2714 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 50;
        }
        /* Premium Hover Glow */
        .ai-btn-gradient::after {
            content: '';
            position: absolute;
            inset: -2px;
            border-radius: 9999px;
            background: linear-gradient(45deg, #7b4f2a, #d4a373, #7b4f2a);
            z-index: -1;
            opacity: 0;
            transition: opacity 0.4s ease;
            filter: blur(8px);
        }
        .ai-btn-gradient:hover::after {
            opacity: 0.6;
        }
        
        /* Floating Animation */
        .ai-float {
            animation: float 4s ease-in-out infinite;
        }
        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        /* Pulse Ring for Attention */
        .ai-pulse-ring::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 100%; height: 100%;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: ripple 3s linear infinite;
            z-index: -2;
            pointer-events: none;
        }
        @keyframes ripple {
            0% { width: 100%; height: 100%; opacity: 0.4; border-color: rgba(255,255,255,0.4); }
            100% { width: 160%; height: 160%; opacity: 0; border-color: rgba(255,255,255,0); }
        }

        .ai-typing-dot {
            animation: aiBounce 1.4s infinite ease-in-out both;
        }
        .ai-typing-dot:nth-child(1) { animation-delay: -0.32s; }
        .ai-typing-dot:nth-child(2) { animation-delay: -0.16s; }
        
        @keyframes aiBounce {
            0%, 80%, 100% { transform: scale(0); }
            40% { transform: scale(1); }
        }
        
        .ai-slide-up { animation: aiSlideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        @keyframes aiSlideUp {
            from { opacity: 0; transform: translateY(15px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }
        
        /* Custom Scrollbar */
        .ai-scroll::-webkit-scrollbar { width: 5px; }
        .ai-scroll::-webkit-scrollbar-track { background: transparent; }
        .ai-scroll::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .ai-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }
      </style>
    `;

    // 2. HTML Structure
    const html = `
      <!-- Floating Trigger Button (Circular FAB) -->
      <!-- Moved to Bottom-Right to stack with WhatsApp/Quote -->
      <button id="ai-trigger-btn" class="fixed bottom-40 right-6 z-50 w-14 h-14 flex items-center justify-center ai-btn-gradient text-white rounded-full transition-all duration-300 group ai-float ai-pulse-ring">
        <div class="relative flex items-center justify-center">
           <!-- Sparkles Icon (Simple) -->
           <svg class="w-7 h-7 text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)] group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
           </svg>
           <!-- Online Dot -->
           <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-[#1a120b] animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.6)]"></span>
        </div>
      </button>

      <!-- Modal Overlay -->
      <div id="ai-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
         <div id="ai-backdrop" class="absolute inset-0 bg-black/70 backdrop-blur-[2px] opacity-0 transition-opacity duration-300"></div>
         
         <!-- Modal Card -->
         <div id="ai-card" class="relative w-full max-w-sm h-[600px] max-h-[85vh] ai-glass rounded-2xl flex flex-col overflow-hidden opacity-0 scale-95 transition-all duration-300 transform shadow-2xl">
            
            <!-- Header -->
            <div class="px-5 py-4 border-b border-white/5 flex justify-between items-center shrink-0 bg-white/5">
               <div class="flex items-center gap-3">
                  <div class="w-9 h-9 rounded-full bg-gradient-to-br from-wood-dark to-black flex items-center justify-center text-wood border border-white/10">
                     <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" /></svg>
                  </div>
                  <div>
                     <h3 class="text-white font-medium text-base">Wavelength Assistant</h3>
                     <p class="text-[11px] text-gray-400 flex items-center gap-1.5"><span class="w-1.5 h-1.5 rounded-full bg-green-500"></span> Online</p>
                  </div>
               </div>
               <button id="ai-close-btn" class="p-2 text-gray-400 hover:text-white hover:bg-white/10 rounded-full transition-all">
                  <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
               </button>
            </div>

            <!-- Chat Area -->
            <div id="ai-chat-box" class="flex-1 overflow-y-auto p-5 space-y-5 ai-scroll">
               <!-- Messages will be injected here -->
               <div class="flex flex-col gap-1 items-start ai-slide-up">
                  <div class="bg-white/10 text-gray-100 px-4 py-3 rounded-2xl rounded-tl-sm max-w-[90%] text-sm leading-relaxed border border-white/5">
                     Hello! I'm your Wavelength design assistant. 🛋️<br>I can help you select furniture, plan your budget, or find the perfect fit for your room.
                  </div>
               </div>
            </div>

            <!-- Suggestion Chips -->
            <div class="px-5 py-3 flex gap-2 overflow-x-auto scrollbar-hide shrink-0 border-t border-white/5">
               <button class="ai-chip whitespace-nowrap px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-gray-400 hover:bg-wood hover:text-white hover:border-wood/50 transition-all active:scale-95">Suggest for my room</button>
               <button class="ai-chip whitespace-nowrap px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-gray-400 hover:bg-wood hover:text-white hover:border-wood/50 transition-all active:scale-95">TV unit guide</button>
               <button class="ai-chip whitespace-nowrap px-3 py-1.5 rounded-full bg-white/5 border border-white/10 text-xs text-gray-400 hover:bg-wood hover:text-white hover:border-wood/50 transition-all active:scale-95">Price Guide</button>
            </div>

            <!-- Input Area -->
            <div class="p-4 pt-2 border-t border-transparent shrink-0">
               <form id="ai-form" class="flex gap-2 relative">
                  <input type="text" id="ai-input" placeholder="Type your question..." class="flex-1 bg-black/40 border border-white/10 rounded-full pl-5 pr-12 py-3 text-sm text-white focus:outline-none focus:border-wood/50 focus:bg-black/60 transition-all placeholder-gray-600">
                  <button type="submit" class="absolute right-1.5 top-1.5 p-1.5 bg-wood text-white rounded-full hover:brightness-110 transition-transform active:scale-95 flex items-center justify-center w-8 h-8">
                     <svg class="w-4 h-4 ml-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                  </button>
               </form>
               <div class="text-[10px] text-center text-gray-600 mt-2">AI suggestions are based on our catalog guidelines.</div>
            </div>
         </div>
      </div>
    `;

    // 3. Inject into DOM
    document.head.insertAdjacentHTML('beforeend', styles);
    document.body.insertAdjacentHTML('beforeend', html);

    // 4. Dom Elements
    const triggerBtn = document.getElementById('ai-trigger-btn');
    const modal = document.getElementById('ai-modal');
    const backdrop = document.getElementById('ai-backdrop');
    const card = document.getElementById('ai-card');
    const closeBtn = document.getElementById('ai-close-btn');
    const form = document.getElementById('ai-form');
    const input = document.getElementById('ai-input');
    const chatBox = document.getElementById('ai-chat-box');
    const chips = document.querySelectorAll('.ai-chip');

    // 5. State
    let isTyping = false;

    // 6. Logic
    function toggleModal(show) {
        if (show) {
            modal.classList.remove('hidden');
            // Allow CSS transition to catch up
            requestAnimationFrame(() => {
                backdrop.classList.add('opacity-100');
                card.classList.remove('opacity-0', 'scale-95');
                input.focus();
            });
            document.body.style.overflow = 'hidden';
        } else {
            backdrop.classList.remove('opacity-100');
            card.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }
    }

    function scrollToBottom() {
        chatBox.scrollTop = chatBox.scrollHeight;
    }

    function addMessage(text, type = 'ai', extraHTML = '') {
        const isAI = type === 'ai';
        const alignClass = isAI ? 'items-start' : 'items-end';
        const bgClass = isAI ? 'bg-wood-dark/80 text-gray-100 rounded-tl-sm' : 'bg-wood text-white rounded-tr-sm';
        const shadow = isAI ? 'shadow-sm' : 'shadow-md';

        const msgDiv = document.createElement('div');
        msgDiv.className = `flex flex-col gap-1 ${alignClass} ai-slide-up mb-4`;
        msgDiv.innerHTML = `
            <div class="${bgClass} p-3 rounded-2xl max-w-[85%] border border-white/5 text-sm leading-relaxed ${shadow}">
               ${text}
            </div>
            ${extraHTML}
        `;

        chatBox.appendChild(msgDiv);
        scrollToBottom();
    }

    function showTyping() {
        if (isTyping) return;
        isTyping = true;
        const typingDiv = document.createElement('div');
        typingDiv.id = 'ai-typing';
        typingDiv.className = 'flex flex-col gap-1 items-start ai-slide-up mb-4';
        typingDiv.innerHTML = `
            <div class="bg-wood-dark/50 p-3 rounded-2xl rounded-tl-sm border border-white/5 flex gap-1">
               <div class="w-1.5 h-1.5 bg-gray-400 rounded-full ai-typing-dot"></div>
               <div class="w-1.5 h-1.5 bg-gray-400 rounded-full ai-typing-dot"></div>
               <div class="w-1.5 h-1.5 bg-gray-400 rounded-full ai-typing-dot"></div>
            </div>
        `;
        chatBox.appendChild(typingDiv);
        scrollToBottom();
    }

    function removeTyping() {
        const el = document.getElementById('ai-typing');
        if (el) el.remove();
        isTyping = false;
    }

    // Knowledge Base Rules
    function getResponse(query) {
        const q = query.toLowerCase();

        if (q.includes('tv') || q.includes('television')) {
            return {
                text: "For TV units, we recommend a width at least 10-20% wider than your TV screen. Here are our popular options:",
                extra: `
                   <div class="mt-2 w-[85%] bg-black/40 rounded-xl overflow-hidden border border-white/10 hover:border-wood/40 transition-colors group cursor-pointer" onclick="window.location.href='products?category=tv'">
                      <div class="h-24 bg-gray-800 relative">
                         <img src="images/ai_tv_unit_1770204842451.png" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                      </div>
                      <div class="p-3">
                         <h4 class="text-white font-medium text-sm">Classic TV Unit</h4>
                         <p class="text-wood text-xs">Solid Teak • From ₹35,000</p>
                         <button class="mt-2 w-full text-xs bg-white/10 hover:bg-wood text-white py-1.5 rounded transition-colors">View Details</button>
                      </div>
                   </div>
                `
            };
        }

        if (q.includes('bed') || q.includes('sleep')) {
            return {
                text: "Choosing the right bed size is crucial! <br>• <strong>Queen (60\"x78\")</strong>: Perfect for couples & most masters.<br>• <strong>King (72\"x78\")</strong>: Luxury space, needs a larger room.<br><br>Check out our Platform Bed:",
                extra: `
                   <div class="mt-2 w-[85%] bg-black/40 rounded-xl overflow-hidden border border-white/10 hover:border-wood/40 transition-colors group cursor-pointer" onclick="window.location.href='products?category=beds'">
                      <div class="h-24 bg-gray-800 relative">
                         <img src="images/ai_bed_modern_1770204864113.png" class="w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                      </div>
                      <div class="p-3">
                         <h4 class="text-white font-medium text-sm">Zen Platform Bed</h4>
                         <p class="text-wood text-xs">Walnut Finish • From ₹28,000</p>
                      </div>
                   </div>
                `
            };
        }

        if (q.includes('price') || q.includes('cost') || q.includes('budget') || q.includes('quote')) {
            return {
                text: "Our pricing reflects premium materials and craftsmanship. <br>• <strong>TV Units</strong>: Start ~₹35k<br>• <strong>Beds</strong>: Start ~₹28k<br>• <strong>Wardrobes</strong>: ~₹18k/meter<br><br>For a custom quote, just send us your details:",
                extra: `
                   <a href="contact#quote" class="mt-2 inline-block bg-wood text-black px-4 py-2 rounded-lg text-sm font-bold hover:bg-white transition-colors">Get a Free Quote</a>
                `
            };
        }

        if (q.includes('contact') || q.includes('location') || q.includes('where')) {
            return {
                text: "We serve the entire region! You can visit our showroom or we can come to you for measurements.",
                extra: `
                   <div class="flex gap-2 mt-2">
                     <a href="contact" class="bg-white/10 text-white px-3 py-1.5 rounded text-sm hover:bg-wood">View Map</a>
                     <a href="https://wa.me/9373154925" class="bg-[#25D366]/20 text-[#25D366] px-3 py-1.5 rounded text-sm hover:bg-[#25D366] hover:text-white border border-[#25D366]/30">WhatsApp Us</a>
                   </div>
                `
            };
        }

        if (q.includes('wardrobe') || q.includes('closet')) {
            return {
                text: "We specialize in floor-to-ceiling modular wardrobes. Choose from:<br>• <strong>Sliding</strong>: Space efficient.<br>• <strong>Hinged</strong>: Classic access.<br>• <strong>Walk-in</strong>: Ultimate luxury.",
                extra: ''
            };
        }

        if (q.includes('material') || q.includes('wood')) {
            return {
                text: "We use only premium materials:<br>• <strong>Solid Teak/Walnut</strong> for durability.<br>• <strong>HDF/Plywood</strong> for moisture-resistant cabinets.<br>• <strong>Premium Laminates & Veneers</strong> for finish.",
                extra: ''
            };
        }

        // Default Fallback
        return {
            text: "I can help with product details, sizing guides, or pricing. Try asking about 'TV units', 'Beds', or 'Materials'. Or explore our catalog below.",
            extra: `<button onclick="window.location.href='products'" class="mt-2 text-xs text-wood hover:text-white underline underline-offset-4">Browse Full Catalog</button>`
        };
    }

    function processInput(text) {
        if (!text.trim()) return;

        // Add User Message
        addMessage(text, 'user');
        input.value = '';

        // Simulate AI Delay
        showTyping();

        // Random delay between 800ms and 1500ms
        const delay = Math.floor(Math.random() * 700) + 800;

        setTimeout(() => {
            removeTyping();
            const response = getResponse(text);
            addMessage(response.text, 'ai', response.extra);
        }, delay);
    }

    // 7. Event Listeners
    triggerBtn.addEventListener('click', () => toggleModal(true));
    closeBtn.addEventListener('click', () => toggleModal(false));
    backdrop.addEventListener('click', () => toggleModal(false));

    // Chips
    chips.forEach(chip => {
        chip.addEventListener('click', (e) => {
            const text = e.target.innerText;
            if (text === 'Suggest for my room') processInput('What furniture is best for my room?');
            else if (text === 'TV unit guide') processInput('Tell me about TV units');
            else if (text === 'Bed size help') processInput('Help me choose a bed size');
            else if (text === 'Price Guide') processInput('What are your prices?');
            else processInput(text);
        });
    });

    // Form
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        processInput(input.value);
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') toggleModal(false);
    });

})();
