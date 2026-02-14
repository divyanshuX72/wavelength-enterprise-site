<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Contact & Custom Order — Wavelength Enterprises</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/tailwind.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/calculator.css">
  <link rel="stylesheet" href="assets/css/dropdown.css">

  <style>
    .visit-card.active {
      border-color: #c08457;
      box-shadow: 0 0 0 2px rgba(192, 132, 87, 0.4);
      background-color: rgba(192, 132, 87, 0.1);
    }

    /* ===== FINAL PREMIUM DROPDOWN PANEL FIX ===== */
    .visit-select,
    .calc-select-wrapper,
    .dd {
      position: relative !important;
    }

    /* dropdown panel */
    .visit-dropdown,
    .calc-dropdown,
    .dd-list {
      position: absolute !important;
      top: calc(100% + 10px) !important;
      left: 0 !important;
      right: 0 !important;
      background: #0f0a06 !important;
      /* fully solid dark */
      opacity: 1 !important;
      backdrop-filter: none !important;
      border: 1px solid #5c3a21 !important;
      border-radius: 18px !important;
      box-shadow: 0 25px 60px rgba(0, 0, 0, .85) !important;
      overflow: hidden !important;
      z-index: 10000 !important;
    }

    /* options */
    .visit-dropdown div,
    .calc-option,
    .dd-item {
      background: #0f0a06 !important;
      color: #d7c2ad !important;
      padding: 16px 20px !important;
      cursor: pointer;
      border-bottom: 1px solid rgba(255, 255, 255, .06);
    }

    .visit-dropdown div:last-child,
    .calc-option:last-child {
      border-bottom: none;
    }

    /* hover premium */
    .visit-dropdown div:hover,
    .calc-option:hover,
    .dd-item:hover {
      background: rgba(200, 146, 58, .22) !important;
      color: #f5e6d3 !important;
    }

    /* CONTAINER CLIPPING FIX */
    #booking-container,
    #visit-step-2,
    .glass-calculator-card {
      overflow: visible !important;
    }

    /* REMOVE TRANSPARENCY FROM OLD GLASS EFFECT */
    .bg-black\/30,
    .bg-neutral-900\/70 {
      background: #140c07 !important;
      backdrop-filter: none !important;
    }

    /* INPUT HEIGHT CONSISTENCY */
    #visit-step-2 input,
    #visit-step-2 textarea,
    #visit-step-2 button {
      min-height: 56px;
    }

    /* STEPPER COLOR FIX */
    .step-indicator.active {
      background: #c8923a !important;
      color: #1a0f08 !important;
      box-shadow: 0 0 14px rgba(200, 146, 58, .6);
    }

    .step-indicator {
      background: #140c07;
      border: 2px solid #6b4226;
      color: #a98f78;
    }
  </style>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="data:,"><!-- placeholder favicon -->
</head>

<body class="bg-wood-dark text-gray-100 antialiased font-sans">

  <?php require_once 'includes/header.php'; ?>

  <main class="max-w-4xl mx-auto px-4 sm:px-6 py-10">
    <div class="text-center mb-10">
      <h1 class="text-3xl font-bold">Start Your Custom Order</h1>
      <p class="text-muted mt-2">Tell us about your vision. Fill out the details below to get a tailored quote.</p>
    </div>

    <!-- Section: Instant Quote Calculator (Premium Redesign) -->
    <section id="calculator" class="mb-20 reveal zoom-in">
      <div class="glass-calculator-card">

        <!-- Decoration: Radial Glow -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none overflow-hidden z-0">
          <div class="absolute -top-[200px] -left-[200px] w-[500px] h-[500px] bg-wood/10 rounded-full blur-[100px]">
          </div>
          <div class="absolute top-1/2 right-0 w-[300px] h-[300px] bg-blue-500/5 rounded-full blur-[80px]"></div>
        </div>

        <!-- Left Panel: Configurator -->
        <div class="calc-config-panel p-6 md:p-8 relative z-20">

          <div class="calc-section-title flex items-center gap-4 mb-8">
            <div
              class="calc-icon-circle w-12 h-12 flex items-center justify-center rounded-full bg-wood/10 text-wood border border-wood/20 shadow-[0_0_15px_rgba(123,79,42,0.15)]">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
            </div>
            <div>
              <span class="block text-[10px] font-bold text-wood tracking-widest uppercase mb-1">Intelligent
                Pricing</span>
              <h2 class="text-2xl font-bold text-white leading-none">Instant Estimate</h2>
            </div>
          </div>

          <div class="space-y-6 relative z-10">
            <!-- 1. Furniture Type (Custom Dropdown) -->
            <div class="calc-field-group relative z-30">
              <div class="calc-select-wrapper has-value" id="sel-type">
                <button type="button"
                  class="calc-select-trigger w-full min-h-[56px] flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-white/10 bg-black/30 relative z-20 focus:border-wood focus:ring-1 focus:ring-wood transition-all">

                  <div class="flex items-center gap-3 flex-1 min-w-0">
                    <span class="icon text-gray-400 shrink-0">
                      <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                      </svg>
                    </span>

                    <span class="selected-value text-white font-medium truncate leading-normal">
                      TV Unit
                    </span>
                  </div>

                  <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200 arrow-icon" fill="none"
                    class="text-gray-500 pointer-events-none group-focus-within:text-white transition-colors">Location
                    Type</span>
                    <path stroke-width="2" d="M19 9l-7 7-7-7" />
                  </svg>
                </button>

                <div
                  class="calc-dropdown absolute left-0 top-full z-50 mt-2 w-full rounded-xl border border-white/20 bg-neutral-900 shadow-2xl hidden">
                  <div
                    class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors selected bg-amber-500/20 font-medium text-amber-300"
                    data-value="tv_unit">TV Unit</div>
                  <div
                    class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                    data-value="wardrobe">Wardrobe</div>
                  <div
                    class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                    data-value="bed">Bed</div>
                  <div
                    class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                    data-value="kitchen">Modular Kitchen</div>
                  <div
                    class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                    data-value="sofa">Sofa Set</div>
                </div>
              </div>
            </div>

            <!-- 2. Dimensions & Logic Container (Dynamic) -->
            <div id="calc-dynamic-fields" class="calc-grid grid md:grid-cols-2 xl:grid-cols-3 gap-6 auto-rows-max">
              <!-- JS Injected Fields Go Here -->
            </div>

            <!-- 3. Material & Finish -->
            <div class="calc-grid grid md:grid-cols-2 xl:grid-cols-2 gap-6 auto-rows-max relative z-10">
              <!-- Material -->
              <div class="calc-field-group relative z-20">
                <div class="calc-select-wrapper has-value" id="sel-material">
                  <button type="button"
                    class="calc-select-trigger w-full min-h-[56px] flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-white/10 bg-black/30 relative z-20 focus:border-wood focus:ring-1 focus:ring-wood transition-all">

                    <div class="flex items-center gap-3 flex-1 min-w-0">
                      <span class="icon text-gray-400 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                      </span>

                      <span class="selected-value text-white font-medium truncate leading-normal">
                        MDF (Standard)
                      </span>
                    </div>

                    <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200 arrow-icon" fill="none"
                      class="text-gray-500 pointer-events-none group-focus-within:text-white transition-colors">Location
                      Type</span>
                      <path stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <div
                    class="calc-dropdown absolute left-0 top-full z-50 mt-2 w-full rounded-xl border border-white/20 bg-neutral-900 shadow-2xl hidden">
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors selected bg-amber-500/20 font-medium text-amber-300"
                      data-value="mdf">MDF (Standard)</div>
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                      data-value="plywood">BWP Plywood (Durable)</div>
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                      data-value="teak">Teak Wood (Premium)</div>
                  </div>
                </div>
              </div>

              <!-- Finish -->
              <div class="calc-field-group relative z-20">
                <div class="calc-select-wrapper has-value" id="sel-finish">
                  <button type="button"
                    class="calc-select-trigger w-full min-h-[56px] flex items-center justify-between gap-3 px-4 py-3 rounded-xl border border-white/10 bg-black/30 relative z-20 focus:border-wood focus:ring-1 focus:ring-wood transition-all">

                    <div class="flex items-center gap-3 flex-1 min-w-0">
                      <span class="icon text-gray-400 shrink-0">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                        </svg>
                      </span>

                      <span class="selected-value text-white font-medium truncate leading-normal">
                        Laminate
                      </span>
                    </div>

                    <svg class="w-5 h-5 text-gray-500 shrink-0 transition-transform duration-200 arrow-icon" fill="none"
                      class="text-gray-500 pointer-events-none group-focus-within:text-white transition-colors">Location
                      Type</span>
                      <path stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                  </button>

                  <div
                    class="calc-dropdown absolute left-0 top-full z-50 mt-2 w-full rounded-xl border border-white/20 bg-neutral-900 shadow-2xl hidden">
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors selected bg-amber-500/20 font-medium text-amber-300"
                      data-value="laminate">Laminate (Matte/Gloss)</div>
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                      data-value="acrylic">Acrylic (High Gloss)</div>
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                      data-value="veneer">Natural Veneer</div>
                    <div
                      class="calc-option px-4 py-3 hover:bg-amber-600/20 cursor-pointer text-white hover:text-white transition-colors"
                      data-value="pu">PU Paint</div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Right Panel: Estimate -->
        <div class="calc-estimate-panel">
          <div class="calc-estimate-bg"></div>

          <div class="relative z-10 text-center lg:text-left">
            <div class="live-badge">
              <div class="live-dot"></div> Live Estimate
            </div>

            <div class="price-display animate-price-update">
              <span class="currency-symbol">₹</span>
              <span id="display-price">0</span>
            </div>
            <p class="text-gray-500 text-xs mb-6">*Approximate cost excluding taxes & installation</p>

            <!-- Breakdown -->
            <div class="breakdown-list">
              <div class="breakdown-row">
                <span>Base Cost</span>
                <span id="bd-base">₹0</span>
              </div>
              <div class="breakdown-row">
                <span>Size Multiplier</span>
                <span id="bd-size">x1.0</span>
              </div>
              <div class="breakdown-row">
                <span>Material & Finish</span>
                <span id="bd-mat">Standard</span>
              </div>
            </div>

            <!-- Trust -->
            <div class="trust-row">
              <div class="trust-item">
                <svg class="w-5 h-5 text-wood mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                PREMIUM QUALITY
              </div>
              <div class="trust-item">
                <svg class="w-5 h-5 text-wood mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                3 WEEKS DELIVERY
              </div>
              <div class="trust-item">
                <svg class="w-5 h-5 text-wood mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4" />
                </svg>
                5 YEAR WARRANTY
              </div>
            </div>

            <!-- Action -->
            <button id="btn-save-quote"
              class="w-full mt-8 bg-wood hover:bg-white text-black font-bold py-4 rounded-xl transition-all shadow-[0_4px_14px_rgba(123,79,42,0.4)] flex items-center justify-center gap-2 group">
              <span>Book Consultation</span>
              <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </button>
          </div>
        </div>

      </div>
    </section>

    <!-- Feature 12: Appointment Booking (Upgraded Wizard) -->
    <section id="booking-section" class="mb-12 scroll-mt-24">
      <h2 class="text-2xl font-bold text-center mb-8 text-white">Schedule a Visit</h2>

      <div class="bg-wood-dark border border-wood/30 rounded-xl p-6 sm:p-8 shadow-2xl reveal relative"
        id="booking-container">
        <!-- Background Glow -->
        <div
          class="absolute top-0 right-0 w-64 h-64 bg-wood/10 rounded-full blur-3xl -mr-16 -mt-16 pointer-events-none z-0">
        </div>


        <!-- Wizard Progress -->
        <div class="flex items-center justify-center mb-10 relative z-10" id="booking-progress">
          <div class="w-full max-w-sm flex items-center justify-between relative px-2">
            <!-- Step 1 -->
            <div class="relative flex flex-col items-center group cursor-default z-20">
              <div
                class="w-10 h-10 rounded-full bg-wood text-black flex items-center justify-center font-bold text-sm shadow-[0_0_15px_rgba(123,79,42,0.6)] transition-all duration-300 step-indicator active border-2 border-wood"
                data-step="1">1</div>
              <span
                class="absolute top-12 text-[10px] w-20 text-center sm:text-xs text-wood font-bold tracking-wide uppercase transition-all duration-300 group-hover:text-white">Type</span>
            </div>

            <!-- Connector 1-2 -->
            <div class="absolute left-10 right-10 top-5 h-1 bg-gray-700 -z-10 overflow-hidden rounded-full">
              <div class="h-full bg-wood w-0 transition-all duration-500 ease-out progress-bar-line"></div>
            </div>

            <!-- Step 2 -->
            <div class="relative flex flex-col items-center group cursor-default z-20">
              <div
                class="w-10 h-10 rounded-full bg-gray-900 border-2 border-gray-600 text-gray-400 flex items-center justify-center font-bold text-sm transition-all duration-300 step-indicator"
                data-step="2">2</div>
              <span
                class="absolute top-12 text-[10px] w-20 text-center sm:text-xs text-gray-500 font-bold tracking-wide uppercase transition-colors duration-300">Details</span>
            </div>


            <!-- Step 3 -->
            <div class="relative flex flex-col items-center group cursor-default z-20">
              <div
                class="w-10 h-10 rounded-full bg-gray-900 border-2 border-gray-600 text-gray-400 flex items-center justify-center font-bold text-sm transition-all duration-300 step-indicator"
                data-step="3">3</div>
              <span
                class="absolute top-12 text-[10px] w-20 text-center sm:text-xs text-gray-500 font-bold tracking-wide uppercase transition-colors duration-300">Slot</span>
            </div>
          </div>
        </div>

        <!-- Booking Form Wizard -->
        <form id="booking-wizard-form" class="relative z-10 min-h-[400px]">

          <!-- STEP 1: Consultation Type -->
          <div id="visit-step-1" class="booking-step space-y-8" data-step="1">
            <h3 class="text-xl font-semibold text-white mb-4 text-center">How can we help you?</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

              <!-- Card 1: Home -->
              <div
                class="visit-card cursor-pointer group h-full bg-black/40 border border-gray-700 p-6 rounded-2xl hover:border-wood/60 transition-all flex flex-col items-center text-center"
                data-type="home">
                <div
                  class="text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                  🏡</div>
                <h4 class="font-bold text-white mb-2 group-hover:text-wood transition-colors text-lg">Home Visit</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Our designers visit your home for a personal
                  consultation.</p>
              </div>

              <!-- Card 2: Measurement -->
              <div
                class="visit-card cursor-pointer group h-full bg-black/40 border border-gray-700 p-6 rounded-2xl hover:border-wood/60 transition-all flex flex-col items-center text-center"
                data-type="measurement">
                <div
                  class="text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                  📏</div>
                <h4 class="font-bold text-white mb-2 group-hover:text-wood transition-colors text-lg">Measurement</h4>
                <p class="text-xs text-gray-400 leading-relaxed">Technician visit for precise room measurements.</p>
              </div>

              <!-- Card 3: Showroom -->
              <div
                class="visit-card cursor-pointer group h-full bg-black/40 border border-gray-700 p-6 rounded-2xl hover:border-wood/60 transition-all flex flex-col items-center text-center"
                data-type="showroom">
                <div
                  class="text-4xl mb-4 transform group-hover:scale-110 transition-transform duration-300 drop-shadow-lg">
                  🏢</div>
                <h4 class="font-bold text-white mb-2 group-hover:text-wood transition-colors text-lg">Showroom Visit
                </h4>
                <p class="text-xs text-gray-400 leading-relaxed">Visit our gallery to explore materials and designs.
                </p>
              </div>

            </div>
          </div>

          <!-- STEP 2: Address Details (Conditional) -->
          <div id="visit-step-2" class="hidden booking-step space-y-6" data-step="2">
            <h3 class="text-xl font-semibold text-white mb-1">Where should we visit?</h3>
            <p class="text-sm text-gray-400 mb-4 flex items-center gap-2">
              <span class="text-wood">📍</span> Please provide the site location for measurement.
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start relative z-10">
              <div class="md:col-span-2 relative group">
                <textarea name="address" id="bk_address" rows="2" placeholder=" "
                  class="floating-input block w-full bg-black/30 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors"></textarea>
                <label for="bk_address"
                  class="absolute left-4 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Full
                  Address (House, Street, Area)*</label>
              </div>

              <div class="relative group">
                <input type="text" name="landmark" id="bk_landmark" placeholder=" "
                  class="floating-input block w-full bg-black/30 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors">
                <label for="bk_landmark"
                  class="absolute left-4 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Landmark</label>
              </div>

              <div class="relative group">
                <input type="text" name="pincode" id="bk_pincode" placeholder=" " maxlength="6" inputmode="numeric"
                  class="floating-input block w-full bg-black/30 border border-gray-700 text-white px-4 py-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors">
                <label for="bk_pincode"
                  class="absolute left-4 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Pincode*</label>
              </div>

              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-500 transition-colors group-focus-within:text-wood"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                  </svg>
                </div>
                <input type="text" name="google_map" id="bk_map" placeholder=" "
                  class="floating-input block w-full bg-black/30 border border-gray-700 text-white pl-10 pr-4 py-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors">
                <label for="bk_map"
                  class="absolute left-10 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Google
                  Map Link (Optional)</label>
              </div>

              <!-- CUSTOM DROPDOWN REPLACEMENT -->
              <div class="relative z-30 visit-select">
                <input type="hidden" name="location_type" id="location_type_input">
                <button type="button" id="location_type_trigger" class="w-full min-h-[56px] rounded-lg bg-black/30 border border-gray-700
                         px-4 py-3 flex items-center gap-3 hover:border-wood
                         focus:ring-1 focus:ring-wood text-[#d7c2ad]">

                  <span class="text-[#a98f78]">📍</span>
                  <span class="selected-text">Select Location Type</span>
                </button>

                <div
                  class="visit-dropdown absolute left-0 top-full mt-2 w-full z-[9999] rounded-xl border border-white/10 bg-[#1a1410] shadow-2xl hidden">
                  <div
                    class="px-4 py-3 hover:bg-wood/20 cursor-pointer text-gray-300 hover:text-white transition-colors"
                    data-value="apartment">Apartment / Flat / Bungalow / Villa</div>

                  <div
                    class="px-4 py-3 hover:bg-wood/20 cursor-pointer text-gray-300 hover:text-white transition-colors"
                    data-value="office">Office / Commercial</div>
                  <div
                    class="px-4 py-3 hover:bg-wood/20 cursor-pointer text-gray-300 hover:text-white transition-colors"
                    data-value="store">Store / Retail</div>
                </div>
              </div>
            </div>
          </div>

          <!-- STEP 3: Date & Time + Preview -->
          <div id="visit-step-3" class="hidden booking-step space-y-6" data-step="3">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

              <!-- Selection -->
              <div class="space-y-6">
                <div>
                  <h3 class="text-lg font-semibold text-white mb-3">Select Date</h3>
                  <input type="date" name="date" id="bk_date"
                    class="w-full p-3 rounded-lg bg-black/30 border border-gray-700 focus:border-wood text-white appearance-none cursor-pointer"
                    style="color-scheme: dark;">
                </div>

                <div>
                  <h3 class="text-lg font-semibold text-white mb-3">Preferred Time</h3>
                  <div class="grid grid-cols-3 gap-3" id="time-slots">
                    <!-- Generated by JS -->
                    <button type="button"
                      class="slot-btn py-2 px-1 rounded border border-gray-700 bg-black/20 text-sm text-gray-300 hover:border-wood hover:text-white transition-all focus:ring-1 focus:ring-wood"
                      data-time="10:00 AM">10:00 AM</button>
                    <button type="button"
                      class="slot-btn py-2 px-1 rounded border border-gray-700 bg-black/20 text-sm text-gray-300 hover:border-wood hover:text-white transition-all focus:ring-1 focus:ring-wood"
                      data-time="12:00 PM">12:00 PM</button>
                    <button type="button"
                      class="slot-btn py-2 px-1 rounded border border-gray-700 bg-black/20 text-sm text-gray-300 hover:border-wood hover:text-white transition-all focus:ring-1 focus:ring-wood"
                      data-time="02:00 PM">2:00 PM</button>
                    <button type="button"
                      class="slot-btn py-2 px-1 rounded border border-gray-700 bg-black/20 text-sm text-gray-300 hover:border-wood hover:text-white transition-all focus:ring-1 focus:ring-wood"
                      data-time="04:00 PM">4:00 PM</button>
                    <button type="button"
                      class="slot-btn py-2 px-1 rounded border border-gray-700 bg-black/20 text-sm text-gray-300 hover:border-wood hover:text-white transition-all focus:ring-1 focus:ring-wood"
                      data-time="06:00 PM">6:00 PM</button>
                  </div>
                  <input type="hidden" name="time" id="bk_time">
                </div>
              </div>

              <!-- Preview Card -->
              <div class="bg-black/40 border border-white/5 rounded-xl p-6 flex flex-col h-full">
                <h4 class="text-wood font-bold uppercase tracking-widest text-xs mb-4">Request Summary</h4>

                <div class="space-y-4 flex-1">
                  <div class="flex items-start gap-3">
                    <div class="bg-wood/20 p-2 rounded text-wood"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                      </svg></div>
                    <div>
                      <p class="text-xs text-gray-500">Service Type</p>
                      <p class="font-medium text-white" id="summary-type">--</p>
                    </div>
                  </div>

                  <div class="flex items-start gap-3 hidden" id="summary-address-block">
                    <div class="bg-wood/20 p-2 rounded text-wood"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg></div>
                    <div>
                      <p class="text-xs text-gray-500">Location</p>
                      <p class="font-medium text-white text-sm line-clamp-2" id="summary-address">--</p>
                    </div>
                  </div>

                  <div class="flex items-start gap-3">
                    <div class="bg-wood/20 p-2 rounded text-wood"><svg class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg></div>
                    <div>
                      <p class="text-xs text-gray-500">Date & Time</p>
                      <p class="font-medium text-white" id="summary-datetime">Select date & time</p>
                    </div>
                  </div>
                </div>

                <div class="mt-6 pt-4 border-t border-white/5">
                  <p class="text-[10px] text-gray-500 text-center mb-3">By clicking Confirm, you agree to our booking
                    terms.</p>
                  <button type="submit" id="btn-finish-booking"
                    class="w-full bg-wood text-black font-bold py-3 rounded-lg hover:bg-white hover:scale-[1.02] transition-all shadow-lg flex items-center justify-center gap-2">
                    Confirm Appointment
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                  </button>
                </div>
              </div>
            </div>
          </div>

          <!-- Navigation Footer -->
          <div class="flex justify-between items-center mt-8 pt-4 border-t border-white/5" id="booking-nav">
            <button type="button" id="bk-prev-btn"
              class="text-gray-400 hover:text-white flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-white/5 transition-colors hidden">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Back
            </button>
            <div class="ml-auto flex items-center">
              <button type="button" id="visit-next-btn" disabled
                class="visit-next-btn opactiy-50 cursor-not-allowed bg-white/10 text-white font-medium px-6 py-2 rounded-full hover:bg-wood hover:text-black transition-all flex items-center gap-2 min-w-[160px]">
                Next Step
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>
            </div>
          </div>
        </form>

        <!-- Success Screen -->
        <div id="booking-success" class="hidden text-center py-10 fade-in-up">
          <div
            class="w-20 h-20 bg-green-500/10 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 ring-4 ring-green-500/20">
            <svg class="w-10 h-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <h3 class="text-2xl font-bold text-white mb-2">Booking Confirmed!</h3>
          <p class="text-gray-400 mb-8">We have scheduled your visit. A confirmation has been sent to your phone.</p>

          <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <button id="btn-add-calendar"
              class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
              <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              Add to Calendar
            </button>
            <a href="#" id="btn-whatsapp"
              class="px-6 py-2 bg-[#25D366] text-white rounded-lg hover:bg-[#20bd5a] transition-colors flex items-center justify-center gap-2 shadow-lg hover:shadow-green-500/20">
              <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                <path
                  d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
              </svg>
              WhatsApp Us
            </a>
          </div>

          <button onclick="location.reload()" class="mt-8 text-sm text-gray-500 hover:text-wood underline">Book another
            appointment</button>
        </div>

      </div>
    </section>

    <!-- Modern Multi-Step Quote Interface -->
    <section id="quote"
      class="relative z-10 bg-[rgba(42,26,18,0.9)] rounded-2xl p-8 sm:p-10 shadow-2xl border border-wood/30 mb-32">
      <!-- Background Elements -->
      <div class="bg-gradient-blob bg-wood/30 w-64 h-64 -top-20 -left-20"></div>
      <div class="bg-gradient-blob bg-blue-500/10 w-64 h-64 top-40 -right-20 animation-delay-2000"></div>

      <!-- Step Indicator -->
      <div class="flex items-center justify-center mb-10 w-full max-w-lg mx-auto relative z-10">
        <div class="flex items-center w-full">
          <div class="flex flex-col items-center relative">
            <div
              class="w-10 h-10 rounded-full border-2 border-wood bg-wood text-black flex items-center justify-center font-bold z-10 step-dot shadow-[0_0_15px_rgba(123,79,42,0.5)]">
              1</div>
            <span class="absolute top-12 text-xs font-semibold text-wood whitespace-nowrap">Personal Info</span>
          </div>
          <div class="flex-1 h-1 bg-gray-700 mx-2 rounded step-line"></div>
          <div class="flex flex-col items-center relative">
            <div
              class="w-10 h-10 rounded-full border-2 border-gray-700 bg-black/40 text-gray-400 flex items-center justify-center font-bold z-10 step-dot">
              2</div>
            <span class="absolute top-12 text-xs font-semibold text-gray-400 whitespace-nowrap">Project Details</span>
          </div>
        </div>
      </div>

      <!-- Form Content -->
      <div id="wizard-content" class="text-left w-full">
        <form id="quote-form" class="space-y-6">

          <!-- Step 1: Personal Info -->
          <div class="form-step space-y-6">
            <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 mb-6">
              Tell us about yourself</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Name -->
              <div class="relative group input-group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-500 transition-colors group-focus-within:text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <input name="name" id="f_name" placeholder=" " required
                  class="floating-input pl-10 pr-10 block w-full bg-black/50 border border-gray-700 text-white py-3 px-4 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-center placeholder:text-center" />
                <label for="f_name"
                  class="absolute left-10 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Full
                  Name</label>
              </div>

              <!-- Phone -->
              <div class="relative group input-group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-500 transition-colors group-focus-within:text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                  </svg>
                </div>
                <input name="phone" id="f_phone" placeholder=" " required
                  class="floating-input pl-10 pr-10 block w-full bg-black/50 border border-gray-700 text-white py-3 px-4 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-center placeholder:text-center" />
                <label for="f_phone"
                  class="absolute left-10 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Phone
                  Number</label>
              </div>

              <!-- Email -->
              <div class="relative group input-group md:col-span-2">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <svg class="h-5 w-5 text-gray-500 transition-colors group-focus-within:text-white"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                  </svg>
                </div>
                <input type="email" name="email" id="f_email" placeholder=" " required
                  class="floating-input pl-10 pr-10 block w-full bg-black/50 border border-gray-700 text-white py-3 px-4 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-center placeholder:text-center" />
                <label for="f_email"
                  class="absolute left-10 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Email
                  Address</label>
              </div>
            </div>
          </div>

          <!-- Step 2: Project Details -->
          <div class="form-step hidden space-y-6">
            <h2 class="text-2xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-white to-gray-400 mb-6">
              Project Requirements</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <!-- Room Type -->
              <div class="dd">
                <input type="hidden" name="room_type" id="room_type">
                <button class="dd-btn" type="button">Select Room Type</button>
                <div class="dd-list">
                  <div class="dd-item">Living Room</div>
                  <div class="dd-item">Bedroom</div>
                  <div class="dd-item">Kitchen</div>
                  <div class="dd-item">Home Office</div>
                  <div class="dd-item">Other</div>
                </div>
              </div>

              <!-- Furniture Type -->
              <div class="dd">
                <input type="hidden" name="furniture_type" id="furniture_type">
                <button class="dd-btn" type="button">Select Furniture Type</button>
                <div class="dd-list">
                  <div class="dd-item">TV Unit</div>
                  <div class="dd-item">Bed</div>
                  <div class="dd-item">Wardrobe</div>
                  <div class="dd-item">Table / Desk</div>
                  <div class="dd-item">Shelving / Storage</div>
                  <div class="dd-item">Other</div>
                </div>
              </div>

              <!-- Dimensions (Split) -->
              <div class="flex justify-center gap-3 md:col-span-1">
                <div class="relative group input-group flex-1">
                  <input type="number" name="length" id="p_length" placeholder=" " inputmode="numeric" min="0"
                    oninput="this.value=this.value.replace(/-/g,'')"
                    class="peer floating-input block w-full bg-black/50 border border-gray-700 text-white py-3 px-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-sm text-center placeholder:text-center" />
                  <label for="p_length"
                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none transition-all duration-200 peer-focus:left-2 peer-focus:top-[-0.75rem] peer-focus:translate-x-0 peer-focus:translate-y-0 peer-[:not(:placeholder-shown)]:left-2 peer-[:not(:placeholder-shown)]:top-[-0.75rem] peer-[:not(:placeholder-shown)]:translate-x-0 peer-[:not(:placeholder-shown)]:translate-y-0">Length
                    (ft)</label>
                </div>
                <div class="relative group input-group flex-1">
                  <input type="number" name="height" id="p_height" placeholder=" " inputmode="numeric" min="0"
                    oninput="this.value=this.value.replace(/-/g,'')"
                    class="peer floating-input block w-full bg-black/50 border border-gray-700 text-white py-3 px-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-sm text-center placeholder:text-center" />
                  <label for="p_height"
                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none transition-all duration-200 peer-focus:left-2 peer-focus:top-[-0.75rem] peer-focus:translate-x-0 peer-focus:translate-y-0 peer-[:not(:placeholder-shown)]:left-2 peer-[:not(:placeholder-shown)]:top-[-0.75rem] peer-[:not(:placeholder-shown)]:translate-x-0 peer-[:not(:placeholder-shown)]:translate-y-0">Height
                    (ft)</label>
                </div>
                <div class="relative group input-group flex-1">
                  <input type="number" name="depth" id="p_depth" placeholder=" " inputmode="numeric" min="0"
                    oninput="this.value=this.value.replace(/-/g,'')"
                    class="peer floating-input block w-full bg-black/50 border border-gray-700 text-white py-3 px-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-sm text-center placeholder:text-center" />
                  <label for="p_depth"
                    class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-gray-400 text-xs pointer-events-none transition-all duration-200 peer-focus:left-2 peer-focus:top-[-0.75rem] peer-focus:translate-x-0 peer-focus:translate-y-0 peer-[:not(:placeholder-shown)]:left-2 peer-[:not(:placeholder-shown)]:top-[-0.75rem] peer-[:not(:placeholder-shown)]:translate-x-0 peer-[:not(:placeholder-shown)]:translate-y-0">Depth
                    (ft)</label>
                </div>
              </div>

              <div class="relative group">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                  <span class="text-gray-500 text-lg transition-colors group-focus-within:text-wood">₹</span>
                </div>
                <input type="number" name="budget" id="p_budget" placeholder=" " inputmode="numeric" min="0"
                  oninput="this.value=this.value.replace(/-/g,'')"
                  class="floating-input block w-full bg-black/50 border border-gray-700 text-white pl-10 pr-4 py-3 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors">
                <label for="p_budget"
                  class="absolute left-10 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Budget
                  Range</label>
              </div>

              <!-- File Upload -->
              <div class="md:col-span-2">
                <div id="file-drop-zone"
                  class="file-drop-zone relative rounded-xl p-8 text-center cursor-pointer bg-black/20 group">
                  <input type="file" name="design_image" accept="image/*"
                    class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                  <div class="flex flex-col items-center justify-center space-y-2">
                    <svg
                      class="h-10 w-10 text-gray-400 group-hover:text-wood transition-colors group-hover:-translate-y-2 duration-300"
                      xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                    </svg>
                    <p class="text-sm text-gray-300 font-medium">Click to upload design reference</p>
                    <p id="file-name" class="text-xs text-gray-500">or drag and drop file here</p>
                  </div>
                </div>
              </div>

              <!-- Message -->
              <div class="md:col-span-2 relative group input-group">
                <textarea name="message" id="p_message" rows="3" placeholder=" "
                  class="floating-input block w-full bg-black/50 border border-gray-700 text-white py-3 px-4 rounded-lg focus:outline-none focus:border-wood focus:ring-1 focus:ring-wood transition-colors text-center placeholder:text-center"></textarea>
                <label for="p_message"
                  class="absolute left-4 top-3 text-gray-400 text-sm pointer-events-none transition-all duration-200">Additional
                  Details...</label>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="flex items-center justify-between pt-6 border-t border-white/10 mt-6">
            <button type="button" id="btn-back"
              class="hidden text-gray-400 hover:text-white flex items-center gap-2 transition-colors">
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
              </svg>
              Back
            </button>

            <div class="ml-auto">
              <button type="button" id="btn-next"
                class="bg-wood text-black font-bold px-8 py-3 rounded-full hover:bg-white hover:scale-105 transition-all shadow-[0_0_20px_rgba(123,79,42,0.4)] flex items-center gap-2 group">
                Next Step
                <svg class="h-4 w-4 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
              </button>

              <button type="submit" id="btn-submit"
                class="hidden bg-gradient-to-r from-wood to-yellow-600 text-white font-bold px-10 py-3 rounded-full hover:scale-105 transition-all shadow-lg">
                Submit Request
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Success UI (Hidden) -->
      <div id="wizard-success" class="hidden text-center py-10 fade-in-up">
        <div class="flex justify-center mb-6">
          <div class="checkmark-wrapper">
            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
              <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
              <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
            </svg>
          </div>
        </div>
        <h3 class="text-3xl font-bold text-white mb-2">Request Received!</h3>
        <p class="text-gray-300 mb-8 max-w-md mx-auto">Thank you for sharing your project details. Our team will review
          your requirements and contact you within 24 hours.</p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center mb-8">
          <button id="quote-calendar"
            class="px-6 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 transition-colors flex items-center justify-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
            </svg>
            Add to Calendar
          </button>
          <a href="#" id="quote-whatsapp"
            class="px-6 py-2 bg-[#25D366] text-white rounded-lg hover:bg-[#20bd5a] transition-colors flex items-center justify-center gap-2 shadow-lg hover:shadow-green-500/20">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
            WhatsApp Us
          </a>
        </div>

        <a href="index"
          class="inline-block bg-white/10 border border-white/20 text-white px-6 py-2 rounded-full hover:bg-white hover:text-black transition-colors">Return
          Home</a>
      </div>
    </section>


    <!-- Simple Contact Info -->
    <div class="mt-12 grid grid-cols-1 lg:grid-cols-2 gap-8 text-left border-t border-gray-800 pt-8">
      <div>
        <h3 class="text-xl font-semibold mb-6 text-white">Contact Details</h3>

        <div class="space-y-4">
          <p class="text-muted"><strong>Phone:</strong><br>
            <a href="tel:+919373154925" class="hover:text-wood transition-colors text-white">+91 93731 54925</a>
          </p>

          <p class="text-muted"><strong>Email:</strong><br>
            <a href="mailto:wavelength.enterprises1972@gmail.com"
              class="hover:text-wood transition-colors text-white">wavelength.enterprises1972@gmail.com</a>
          </p>

          <p class="text-muted"><strong>WhatsApp:</strong><br>
            <a href="https://wa.me/919373154925" target="_blank"
              class="hover:text-wood transition-colors text-white">Chat
              on WhatsApp</a>
          </p>

          <p class="text-muted"><strong>Address:</strong><br>
            <a href="https://maps.app.goo.gl/Tx73RcsLcN3vXC2GA" target="_blank"
              class="hover:text-wood transition text-white">
              Pelhar Rd, Wakanpada,<br>
              Nalasopara East, Vasai-Virar,<br>
              Maharashtra 401209
            </a>
          </p>

          <p class="text-muted"><strong>Website:</strong><br>
            <a href="https://www.wavelengthenterprises.in" target="_blank"
              class="hover:text-wood transition-colors text-white">www.wavelengthenterprises.in</a>
          </p>
        </div>
      </div>

      <!-- Map -->
      <div class="h-96 w-full bg-wood-dark/40 rounded-xl overflow-hidden border border-white/5">
        <iframe src="https://www.google.com/maps?q=Wavelength%20Enterprises%20Pelhar%20Rd%20Nalasopara&output=embed"
          width="100%" height="100%" style="border:0;" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
        </iframe>
      </div>

      <a href="https://maps.app.goo.gl/Tx73RcsLcN3vXC2GA" target="_blank" class="inline-block mt-4 px-5 py-3 rounded-xl
                bg-amber-700 hover:bg-amber-600
                text-white font-medium transition shadow-lg">
        Open in Google Maps →
      </a>
    </div>
  </main>


  <!-- Floating Action Buttons -->

  <div id="footer-container"></div>

  <script src="assets/js/main.js"></script>
  <script src="assets/js/form-wizard.js"></script>


  <script src="assets/js/animations.js"></script>
  <script src="assets/js/slider.js"></script>
  <script src="assets/js/dropdown.js"></script>
  <script src="assets/js/calculator.js"></script>


  <script>
    // Location Type Dropdown Logic
    const locTrigger = document.getElementById('location_type_trigger');
    const locInput = document.getElementById('location_type_input');
    const locDropdown = document.querySelector('.visit-dropdown');

    if (locTrigger && locDropdown) {
      // Toggle
      locTrigger.addEventListener('click', (e) => {
        e.stopPropagation();
        locDropdown.classList.toggle('hidden');
      });

      // Selection
      locDropdown.querySelectorAll('[data-value]').forEach(item => {
        item.addEventListener('click', (e) => {
          e.stopPropagation();

          // Update text
          const textSpan = locTrigger.querySelector('.selected-text');
          if (textSpan) textSpan.textContent = item.innerText;

          // Update hidden input
          if (locInput) locInput.value = item.dataset.value;

          // Close
          locDropdown.classList.add('hidden');

          // Active state (optional)
          locTrigger.classList.add('border-[#c8923a]', 'ring-1', 'ring-[#c8923a]');
        });
      });

      // Outside Click
      document.addEventListener('click', (e) => {
        if (!locTrigger.contains(e.target) && !locDropdown.contains(e.target)) {
          locDropdown.classList.add('hidden');
        }
      });
    }
  </script>

  <!-- Premium WhatsApp Floating Button -->
  <style>
    .whatsapp-premium-btn {
      position: fixed;
      bottom: 30px;
      right: 30px;
      background: linear-gradient(135deg, #25D366 0%, #128C7E 100%);
      color: white;
      padding: 18px;
      border-radius: 50%;
      text-decoration: none;
      z-index: 999;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 8px 32px rgba(37, 211, 102, 0.4),
        0 0 0 0 rgba(37, 211, 102, 0.7);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
      overflow: hidden;
      animation: pulse-glow 2s ease-in-out infinite;
      width: 64px;
      height: 64px;
    }

    .whatsapp-premium-btn::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: linear-gradient(45deg,
          transparent,
          rgba(255, 255, 255, 0.1),
          transparent);
      transform: rotate(45deg);
      animation: shine 3s linear infinite;
    }

    .whatsapp-premium-btn:hover {
      transform: translateY(-4px) scale(1.05);
      box-shadow: 0 12px 48px rgba(37, 211, 102, 0.6),
        0 0 60px rgba(37, 211, 102, 0.4);
      background: linear-gradient(135deg, #2EE87E 0%, #0FA68B 100%);
    }

    .whatsapp-premium-btn:active {
      transform: translateY(-2px) scale(1.02);
    }

    .whatsapp-icon {
      width: 32px;
      height: 32px;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
      animation: bounce-subtle 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {

      0%,
      100% {
        box-shadow: 0 8px 32px rgba(37, 211, 102, 0.4),
          0 0 0 0 rgba(37, 211, 102, 0.7);
      }

      50% {
        box-shadow: 0 8px 32px rgba(37, 211, 102, 0.6),
          0 0 30px 10px rgba(37, 211, 102, 0.3);
      }
    }

    @keyframes shine {
      0% {
        transform: translateX(-100%) translateY(-100%) rotate(45deg);
      }

      100% {
        transform: translateX(100%) translateY(100%) rotate(45deg);
      }
    }

    @keyframes bounce-subtle {

      0%,
      100% {
        transform: translateY(0);
      }

      50% {
        transform: translateY(-3px);
      }
    }

    /* Ripple effect on click */
    .whatsapp-premium-btn::after {
      content: '';
      position: absolute;
      top: 50%;
      left: 50%;
      width: 0;
      height: 0;
      border-radius: 50%;
      background: rgba(255, 255, 255, 0.5);
      transform: translate(-50%, -50%);
      transition: width 0.6s, height 0.6s;
    }

    .whatsapp-premium-btn:active::after {
      width: 300px;
      height: 300px;
      opacity: 0;
    }

    /* Mobile responsive */
    @media (max-width: 768px) {
      .whatsapp-premium-btn {
        bottom: 20px;
        right: 20px;
        padding: 16px;
        width: 56px;
        height: 56px;
      }

      .whatsapp-icon {
        width: 28px;
        height: 28px;
      }
    }
  </style>

  <a href="https://wa.me/919373154925?text=Hi%20Wavelength%20Enterprises" class="whatsapp-premium-btn">
    <svg class="whatsapp-icon" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
    </svg>
  </a>
</body>

</html>