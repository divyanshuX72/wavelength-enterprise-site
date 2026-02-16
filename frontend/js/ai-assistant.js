/**
 * AI Furniture Assistant — LLM Powered
 * Connects to Google Gemini API via backend proxy
 * Features: Multi-language, product cards, spelling tolerance, auto-updating data
 */

(function () {
    // 1. Styles
    const styles = `
      <style>
        .ai-glass {
            background: rgba(18, 18, 18, 0.92);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 16px 50px 0 rgba(0, 0, 0, 0.7), inset 0 0 0 1px rgba(255, 255, 255, 0.05);
        }
        .ai-btn-gradient {
            background: linear-gradient(135deg, #1a120b 0%, #3e2714 100%);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            z-index: 50;
        }
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
        .ai-btn-gradient:hover::after { opacity: 0.6; }
        
        .ai-float { animation: aiFloat 4s ease-in-out infinite; }
        @keyframes aiFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-6px); }
        }

        .ai-pulse-ring::before {
            content: '';
            position: absolute;
            top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: 100%; height: 100%;
            border-radius: 50%;
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: aiRipple 3s linear infinite;
            z-index: -2;
            pointer-events: none;
        }
        @keyframes aiRipple {
            0% { width: 100%; height: 100%; opacity: 0.4; }
            100% { width: 160%; height: 160%; opacity: 0; }
        }

        .ai-typing-dot { animation: aiBounce 1.4s infinite ease-in-out both; }
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

        .ai-scroll::-webkit-scrollbar { width: 5px; }
        .ai-scroll::-webkit-scrollbar-track { background: transparent; }
        .ai-scroll::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.1); border-radius: 10px; }
        .ai-scroll::-webkit-scrollbar-thumb:hover { background: rgba(255, 255, 255, 0.2); }

        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .scrollbar-hide { -ms-overflow-style: none; scrollbar-width: none; }

        /* Product Card Styles */
        .ai-product-card {
            background: rgba(0,0,0,0.4);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 12px;
            overflow: hidden;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 8px;
        }
        .ai-product-card:hover {
            border-color: rgba(123,79,42,0.5);
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.3);
        }
        .ai-product-card img {
            width: 100%;
            height: 80px;
            object-fit: cover;
            opacity: 0.85;
            transition: opacity 0.3s;
        }
        .ai-product-card:hover img { opacity: 1; }
        .ai-product-card .ai-card-body { padding: 10px; }
        .ai-product-card h4 { color: #fff; font-size: 13px; font-weight: 600; margin: 0; }
        .ai-product-card .ai-card-price { color: #c8923a; font-size: 12px; margin-top: 2px; }
        .ai-product-card .ai-card-material { color: #999; font-size: 11px; margin-top: 2px; }
        .ai-product-card .ai-card-btn {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 8px;
            padding: 6px;
            background: rgba(255,255,255,0.08);
            color: #fff;
            border: none;
            border-radius: 6px;
            font-size: 11px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .ai-product-card .ai-card-btn:hover { background: #7b4f2a; }

        /* Quick Action Buttons */
        .ai-quick-action {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 11px;
            border: none;
            cursor: pointer;
            transition: all 0.2s;
            font-weight: 500;
        }
        .ai-action-quote {
            background: #7b4f2a;
            color: #fff;
        }
        .ai-action-quote:hover { background: #9a6838; }
        .ai-action-whatsapp {
            background: rgba(37,211,102,0.15);
            color: #25D366;
            border: 1px solid rgba(37,211,102,0.3);
        }
        .ai-action-whatsapp:hover { background: #25D366; color: #fff; }

        /* Language chip active */
        .ai-lang-chip.active {
            background: #7b4f2a !important;
            color: #fff !important;
            border-color: #7b4f2a !important;
        }

        /* Thinking indicator */
        .ai-thinking {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #999;
            font-size: 12px;
            padding: 8px 14px;
        }
        .ai-thinking-spinner {
            width: 16px; height: 16px;
            border: 2px solid rgba(255,255,255,0.1);
            border-top-color: #c8923a;
            border-radius: 50%;
            animation: aiSpin 0.8s linear infinite;
        }
        @keyframes aiSpin { to { transform: rotate(360deg); } }
      </style>
    `;

    // 2. HTML Structure
    const html = `
      <!-- Floating Trigger Button -->
      <button id="ai-trigger-btn" style="position:fixed; bottom:168px; right:24px; z-index:50;" class="w-14 h-14 flex items-center justify-center ai-btn-gradient text-white rounded-full transition-all duration-300 group ai-float ai-pulse-ring">
        <div class="relative flex items-center justify-center">
           <svg class="w-7 h-7 text-white drop-shadow-[0_2px_4px_rgba(0,0,0,0.5)] group-hover:scale-110 transition-transform duration-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
           </svg>
           <span class="absolute -top-1 -right-1 w-3 h-3 bg-green-500 rounded-full border-2 border-[#1a120b] animate-pulse shadow-[0_0_8px_rgba(34,197,94,0.6)]"></span>
        </div>
      </button>

      <!-- Modal Overlay -->
      <div id="ai-modal" class="fixed inset-0 z-[100] hidden flex items-center justify-center p-4">
         <div id="ai-backdrop" class="absolute inset-0 bg-black/70 backdrop-blur-[2px] opacity-0 transition-opacity duration-300"></div>
         
         <!-- Modal Card -->
         <div id="ai-card" class="relative w-full max-w-sm h-[600px] max-h-[85vh] ai-glass rounded-2xl flex flex-col overflow-hidden opacity-0 scale-95 transition-all duration-300 transform shadow-2xl">
            
            <!-- Header -->
            <div style="padding:16px 20px; border-bottom:1px solid rgba(255,255,255,0.05); display:flex; justify-content:space-between; align-items:center; flex-shrink:0; background:rgba(255,255,255,0.03);">
               <div style="display:flex; align-items:center; gap:12px;">
                  <div style="width:36px;height:36px;border-radius:50%;background:linear-gradient(135deg,#1a120b,#000);display:flex;align-items:center;justify-content:center;color:#c8923a;border:1px solid rgba(255,255,255,0.1);">
                     <svg style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" /></svg>
                  </div>
                  <div>
                     <h3 style="color:#fff;font-weight:600;font-size:15px;margin:0;">Wavelength AI</h3>
                     <p style="font-size:11px;color:#888;display:flex;align-items:center;gap:5px;margin:0;"><span style="width:6px;height:6px;border-radius:50%;background:#22c55e;display:inline-block;"></span> Online — Powered by Gemini</p>
                  </div>
               </div>
               <button id="ai-close-btn" style="padding:8px;color:#888;background:none;border:none;cursor:pointer;border-radius:50%;transition:all 0.2s;" onmouseover="this.style.background='rgba(255,255,255,0.1)';this.style.color='#fff'" onmouseout="this.style.background='none';this.style.color='#888'">
                  <svg style="width:20px;height:20px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
               </button>
            </div>

            <!-- Language Chips -->
            <div style="padding:8px 16px; display:flex; gap:6px; overflow-x:auto; flex-shrink:0; border-bottom:1px solid rgba(255,255,255,0.03);" class="scrollbar-hide">
               <button class="ai-lang-chip active" data-lang="auto" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">🌐 Auto</button>
               <button class="ai-lang-chip" data-lang="en" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">English</button>
               <button class="ai-lang-chip" data-lang="hi" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">हिंदी</button>
               <button class="ai-lang-chip" data-lang="mr" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">मराठी</button>
               <button class="ai-lang-chip" data-lang="gu" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">ગુજરાતી</button>
               <button class="ai-lang-chip" data-lang="ta" style="white-space:nowrap;padding:4px 10px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">தமிழ்</button>
            </div>

            <!-- Chat Area -->
            <div id="ai-chat-box" style="flex:1; overflow-y:auto; padding:16px; display:flex; flex-direction:column; gap:16px;" class="ai-scroll">
               <!-- Welcome Message -->
               <div class="ai-slide-up" style="display:flex;flex-direction:column;gap:4px;align-items:flex-start;">
                  <div style="background:rgba(255,255,255,0.08);color:#e5e5e5;padding:12px 16px;border-radius:16px;border-top-left-radius:4px;max-width:90%;font-size:13px;line-height:1.6;border:1px solid rgba(255,255,255,0.05);">
                     Namaste! 🙏 I'm your <strong>Wavelength AI Assistant</strong>.<br><br>
                     I can help you with:<br>
                     • Furniture recommendations with prices<br>
                     • Interior design suggestions<br>
                     • Custom measurements & materials<br><br>
                     <em style="color:#999;">Ask me in Hindi, English, Marathi or any Indian language!</em>
                  </div>
               </div>
            </div>

            <!-- Suggestion Chips -->
            <div style="padding:8px 16px; display:flex; gap:6px; overflow-x:auto; flex-shrink:0; border-top:1px solid rgba(255,255,255,0.05);" class="scrollbar-hide">
               <button class="ai-chip" style="white-space:nowrap;padding:6px 12px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">🛋️ TV Unit दिखाओ</button>
               <button class="ai-chip" style="white-space:nowrap;padding:6px 12px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">🛏️ Bed options</button>
               <button class="ai-chip" style="white-space:nowrap;padding:6px 12px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">💰 Price Guide</button>
               <button class="ai-chip" style="white-space:nowrap;padding:6px 12px;border-radius:20px;background:rgba(255,255,255,0.05);border:1px solid rgba(255,255,255,0.1);font-size:11px;color:#aaa;cursor:pointer;transition:all 0.2s;">🏠 Interior Tips</button>
            </div>

            <!-- Input Area -->
            <div style="padding:12px 16px; border-top:1px solid rgba(255,255,255,0.03); flex-shrink:0;">
               <form id="ai-form" style="display:flex; gap:8px; position:relative;">
                  <input type="text" id="ai-input" placeholder="Ask in any language..." style="flex:1;background:rgba(0,0,0,0.4);border:1px solid rgba(255,255,255,0.1);border-radius:24px;padding:10px 44px 10px 16px;font-size:13px;color:#fff;outline:none;transition:all 0.2s;" onfocus="this.style.borderColor='rgba(123,79,42,0.5)';this.style.background='rgba(0,0,0,0.6)'" onblur="this.style.borderColor='rgba(255,255,255,0.1)';this.style.background='rgba(0,0,0,0.4)'">
                  <button type="submit" style="position:absolute;right:6px;top:6px;padding:6px;background:#7b4f2a;color:#fff;border-radius:50%;border:none;cursor:pointer;width:32px;height:32px;display:flex;align-items:center;justify-content:center;transition:all 0.2s;" onmouseover="this.style.filter='brightness(1.2)'" onmouseout="this.style.filter='brightness(1)'">
                     <svg style="width:16px;height:16px;margin-left:2px;" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" /></svg>
                  </button>
               </form>
               <div style="font-size:10px;text-align:center;color:#555;margin-top:6px;">Powered by Google Gemini AI • Multi-language support</div>
            </div>
         </div>
      </div>
    `;

    // 3. Inject into DOM
    document.head.insertAdjacentHTML('beforeend', styles);
    document.body.insertAdjacentHTML('beforeend', html);

    // 4. DOM Elements
    const triggerBtn = document.getElementById('ai-trigger-btn');
    const modal = document.getElementById('ai-modal');
    const backdrop = document.getElementById('ai-backdrop');
    const card = document.getElementById('ai-card');
    const closeBtn = document.getElementById('ai-close-btn');
    const form = document.getElementById('ai-form');
    const input = document.getElementById('ai-input');
    const chatBox = document.getElementById('ai-chat-box');
    const chips = document.querySelectorAll('.ai-chip');
    const langChips = document.querySelectorAll('.ai-lang-chip');

    // 5. State
    let isProcessing = false;
    let selectedLang = 'auto';
    let conversationHistory = [];

    // 6. Modal Toggle
    function toggleModal(show) {
        if (show) {
            modal.classList.remove('hidden');
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
        setTimeout(() => { chatBox.scrollTop = chatBox.scrollHeight; }, 50);
    }

    // 7. Message Rendering
    function addMessage(content, type = 'ai', products = [], quickActions = []) {
        const isAI = type === 'ai';
        const align = isAI ? 'flex-start' : 'flex-end';
        const bg = isAI ? 'rgba(255,255,255,0.08)' : '#7b4f2a';
        const textColor = isAI ? '#e5e5e5' : '#fff';
        const borderRadius = isAI ? '16px 16px 16px 4px' : '16px 16px 4px 16px';

        const msgDiv = document.createElement('div');
        msgDiv.className = 'ai-slide-up';
        msgDiv.style.cssText = `display:flex;flex-direction:column;gap:4px;align-items:${align};`;

        // Text bubble
        let html = `<div style="background:${bg};color:${textColor};padding:12px 16px;border-radius:${borderRadius};max-width:90%;font-size:13px;line-height:1.6;border:1px solid rgba(255,255,255,0.05);">${content}</div>`;

        // Product cards
        if (products && products.length > 0) {
            html += '<div style="display:flex;flex-direction:column;gap:8px;width:90%;max-width:90%;">';
            products.forEach(p => {
                const imgPath = p.image || '';
                html += `
                    <div class="ai-product-card" onclick="window.location.href='products.php?category=${p.category || ''}'">
                        ${imgPath ? `<img src="${imgPath}" alt="${p.name}" onerror="this.style.display='none'">` : ''}
                        <div class="ai-card-body">
                            <h4>${p.name || 'Product'}</h4>
                            <div class="ai-card-price">${p.price || ''}</div>
                            <div class="ai-card-material">${p.material || ''}</div>
                            <button class="ai-card-btn" onclick="event.stopPropagation();window.location.href='contact.php#quote'">Get Quote →</button>
                        </div>
                    </div>
                `;
            });
            html += '</div>';
        }

        // Quick Actions
        if (quickActions && quickActions.length > 0) {
            html += '<div style="display:flex;gap:6px;flex-wrap:wrap;margin-top:4px;">';
            quickActions.forEach(a => {
                if (a.action === 'quote') {
                    html += `<button class="ai-quick-action ai-action-quote" onclick="window.location.href='contact.php#quote'">📋 ${a.label}</button>`;
                } else if (a.action === 'whatsapp') {
                    html += `<button class="ai-quick-action ai-action-whatsapp" onclick="window.open('https://wa.me/919373154925','_blank')">💬 ${a.label}</button>`;
                }
            });
            html += '</div>';
        }

        msgDiv.innerHTML = html;
        chatBox.appendChild(msgDiv);
        scrollToBottom();
    }

    function showThinking() {
        const div = document.createElement('div');
        div.id = 'ai-thinking';
        div.className = 'ai-slide-up';
        div.style.cssText = 'display:flex;flex-direction:column;align-items:flex-start;';
        div.innerHTML = `
            <div class="ai-thinking">
                <div class="ai-thinking-spinner"></div>
                <span>Thinking...</span>
            </div>
        `;
        chatBox.appendChild(div);
        scrollToBottom();
    }

    function removeThinking() {
        const el = document.getElementById('ai-thinking');
        if (el) el.remove();
    }

    // 8. API Call
    async function sendMessage(text) {
        if (!text.trim() || isProcessing) return;
        isProcessing = true;

        // Add user message
        addMessage(text, 'user');
        conversationHistory.push({ role: 'user', text: text });
        input.value = '';

        // Show thinking
        showThinking();

        try {
            const response = await fetch('backend/api/ai-chat.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({
                    message: text,
                    history: conversationHistory,
                    language: selectedLang
                })
            });

            const data = await response.json();
            removeThinking();

            if (data.error) {
                addMessage('⚠️ ' + data.error, 'ai');
            } else if (data.success) {
                addMessage(
                    data.text || 'I could not process your request.',
                    'ai',
                    data.products || [],
                    data.quickActions || []
                );
                conversationHistory.push({ role: 'assistant', text: data.text });
            } else {
                addMessage('Sorry, something went wrong. Please try again.', 'ai');
            }
        } catch (error) {
            removeThinking();
            console.error('AI Chat Error:', error);
            addMessage('⚠️ Connection error. Please check your internet and try again.', 'ai');
        }

        isProcessing = false;
    }

    // 9. Event Listeners
    triggerBtn.addEventListener('click', () => toggleModal(true));
    closeBtn.addEventListener('click', () => toggleModal(false));
    backdrop.addEventListener('click', () => toggleModal(false));

    // Form submit
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        sendMessage(input.value);
    });

    // Suggestion chips
    chips.forEach(chip => {
        chip.addEventListener('click', () => {
            sendMessage(chip.textContent.trim());
        });
    });

    // Language chips
    langChips.forEach(chip => {
        chip.addEventListener('click', () => {
            langChips.forEach(c => c.classList.remove('active'));
            chip.classList.add('active');
            selectedLang = chip.dataset.lang;
        });
    });

    // Close on Escape
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') toggleModal(false);
    });

})();
