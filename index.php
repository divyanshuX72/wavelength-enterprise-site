<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description"
    content="Wavelength Enterprises — Premium custom furniture: TV units, beds, wardrobes, modular furniture and interior woodwork.">
  <title>Wavelength Enterprises — Custom Furniture</title>
  <meta name="keywords" content="custom furniture, TV unit, bed, wardrobe, modular furniture, interior woodwork">
  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="assets/css/tailwind.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/premium-form.css">
  <link rel="stylesheet" href="assets/css/dropdown.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="data:,"><!-- placeholder favicon -->
</head>

<body class="bg-wood-dark text-gray-100 antialiased font-sans">
  <?php require_once 'includes/header.php'; ?>

  <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <!-- Hero Showcase -->
    <section class="relative bg-cover bg-center flex items-center justify-center text-center text-white overflow-hidden"
      style="background-image:url('assets/images/ai_tv_unit_1770204842451.png'); min-height:56vh;">
      <div class="absolute inset-0 bg-black/60"></div>
      <div class="relative z-10 px-6 py-20 max-w-4xl">
        <h2 class="text-2xl sm:text-4xl font-extrabold text-reveal-line">
          <span>Custom TV Units & Premium Beds</span>
        </h2>
        <p class="mt-3 text-muted max-w-2xl mx-auto reveal fade-up delay-200">Handcrafted timber finishes, tailored to
          your space and lifestyle.
        </p>
        <div class="mt-6 reveal scale-up delay-400">
          <a href="contact#quote"
            class="hero-cta inline-block bg-wood text-black px-6 py-3 rounded shadow-lg hover-lift transition-transform">Get
            Custom Quote</a>
        </div>
      </div>
    </section>

    <!-- Before/After Transformation Slider -->
    <section class="mt-20 reveal fade-up">
      <div class="text-center mb-10">
        <span class="text-wood font-bold tracking-wider uppercase text-sm">Real Results</span>
        <h2 class="text-3xl font-bold mt-2">See the Transformation</h2>
        <p class="text-muted mt-2">Drag the slider to see how we transform spaces.</p>
      </div>

      <div
        class="relative w-full max-w-4xl mx-auto h-[400px] rounded-2xl overflow-hidden border border-gray-700 shadow-2xl select-none group reveal zoom-in"
        id="comparison-container">
        <!-- After Image (Background) -->
        <img src="assets/images/ai_full_bedroom_after_1770206111031.png"
          class="absolute inset-0 w-full h-full object-cover" alt="After Transformation">
        <span
          class="absolute top-4 right-4 bg-wood text-black text-xs font-bold px-3 py-1 rounded shadow z-10">AFTER</span>

        <!-- Before Image (Foreground, clipped) -->
        <div class="absolute inset-0 w-1/2 overflow-hidden border-r-2 border-wood bg-black" id="before-image">
          <img src="assets/images/ai_empty_bedroom_before_1770206092743.png"
            class="absolute inset-0 w-full h-full object-cover max-w-none" style="width: 100%; height: 100%;"
            alt="Before Transformation">
          <span
            class="absolute top-4 left-4 bg-white/20 backdrop-blur text-white border border-white/30 text-xs font-bold px-3 py-1 rounded shadow z-10">BEFORE</span>
        </div>

        <!-- Slider Handle -->
        <div class="absolute inset-y-0 left-1/2 w-10 -ml-5 flex items-center justify-center cursor-ew-resize z-20"
          id="slider-handle">
          <div
            class="w-10 h-10 bg-wood rounded-full border-4 border-black flex items-center justify-center shadow-[0_0_20px_rgba(123,79,42,0.6)] hover:scale-110 transition-transform">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-black" fill="none" viewBox="0 0 24 24"
              stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 9l4-4 4 4m0 6l-4 4-4-4" />
            </svg>
          </div>
        </div>
      </div>
    </section>

    <!-- Categories -->
    <section class="mt-12">
      <h2 class="text-3xl font-bold mb-8 text-center text-white reveal fade-up">Furniture Categories</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 stagger-children">
        <!-- TV Units -->
        <div
          class="group relative bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 hover-card-zoom">
          <div class="overflow-hidden h-64">
            <img src="assets/images/ai_tv_unit_1770204842451.png" alt="TV Units" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-white group-hover:text-wood transition-colors">TV Units</h3>
            <p class="mt-2 text-sm text-gray-400">Sleek, modern stands and wall-mounted units for your entertainment
              center.</p>
            <a href="products?category=tv"
              class="mt-4 inline-block px-4 py-2 border border-wood text-wood font-medium rounded hover:bg-wood hover:text-black transition-all duration-300 transform group-hover:scale-105 hover-lift">View
              Collection</a>
          </div>
        </div>

        <!-- Beds -->
        <div
          class="group relative bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 hover-card-zoom">
          <div class="overflow-hidden h-64">
            <img src="assets/images/ai_bed_modern_1770204864113.png" alt="Beds" class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-white group-hover:text-wood transition-colors">Beds</h3>
            <p class="mt-2 text-sm text-gray-400">Comfortable, sturdy frames crafted for a perfect night's sleep.</p>
            <a href="products.php?category=beds"
              class="mt-4 inline-block px-4 py-2 border border-wood text-wood font-medium rounded hover:bg-wood hover:text-black transition-all duration-300 transform group-hover:scale-105 hover-lift">View
              Collection</a>
          </div>
        </div>

        <!-- Wardrobes -->
        <div
          class="group relative bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 hover-card-zoom">
          <div class="overflow-hidden h-64">
            <img src="assets/images/ai_wardrobe_sleek_1770204884623.png" alt="Wardrobes"
              class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-white group-hover:text-wood transition-colors">Wardrobes</h3>
            <p class="mt-2 text-sm text-gray-400">Spacious, custom-built storage solutions to organize your life.</p>
            <a href="products.php?category=wardrobes"
              class="mt-4 inline-block px-4 py-2 border border-wood text-wood font-medium rounded hover:bg-wood hover:text-black transition-all duration-300 transform group-hover:scale-105 hover-lift">View
              Collection</a>
          </div>
        </div>

        <!-- Modular Kitchen -->
        <div
          class="group relative bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 hover-card-zoom">
          <div class="overflow-hidden h-64">
            <img src="assets/images/ai_kitchen_modern_1770204908651.png" alt="Modular Kitchen"
              class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-white group-hover:text-wood transition-colors">Modular Kitchen</h3>
            <p class="mt-2 text-sm text-gray-400">Functional and stylish kitchen designs tailored to your culinary
              needs.</p>
            <a href="products.php?category=kitchen"
              class="mt-4 inline-block px-4 py-2 border border-wood text-wood font-medium rounded hover:bg-wood hover:text-black transition-all duration-300 transform group-hover:scale-105 hover-lift">View
              Collection</a>
          </div>
        </div>

        <!-- Office Furniture -->
        <div
          class="group relative bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 hover-card-zoom">
          <div class="overflow-hidden h-64">
            <img src="assets/images/ai_office_setup_1770204927242.png" alt="Office Furniture"
              class="w-full h-full object-cover">
          </div>
          <div class="p-6">
            <h3 class="text-xl font-semibold text-white group-hover:text-wood transition-colors">Office Furniture</h3>
            <p class="mt-2 text-sm text-gray-400">Ergonomic desks and chairs to boost productivity and comfort.</p>
            <a href="products.php?category=office"
              class="mt-4 inline-block px-4 py-2 border border-wood text-wood font-medium rounded hover:bg-wood hover:text-black transition-all duration-300 transform group-hover:scale-105 hover-lift">View
              Collection</a>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimonials Section -->
    <section class="mt-20">
      <div class="text-center mb-10 reveal fade-up">
        <span class="text-wood font-bold tracking-wider uppercase text-sm">Happy Homes</span>
        <h2 class="text-3xl font-bold mt-2">What Our Clients Say</h2>
        <p class="text-muted mt-2">Trusted by <span class="text-white font-bold counter-value"
            data-target="500">0</span>+ families across the region.</p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-3 gap-6 stagger-children">

        <!-- Review 1 -->
        <div
          class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl hover:bg-wood-dark/60 transition-colors hover-lift">
          <div class="flex items-center gap-4 mb-4">
            <img src="assets/images/avatar-1.jpg" class="w-12 h-12 rounded-full object-cover border-2 border-wood"
              alt="Client">
            <div>
              <h4 class="font-bold text-white text-sm">Amit Sharma</h4>
              <p class="text-xs text-muted">Mumbai, MH</p>
            </div>
          </div>
          <div class="flex items-center gap-1 mb-3 text-yellow-500 text-xs">
            <span>★★★★★</span>
          </div>
          <p class="text-gray-300 text-sm mb-4">"The custom wardrobe fits perfectly in our master bedroom. The finish is
            exactly what we wanted, and the installation was seamless."</p>
          <span class="inline-block bg-wood/20 text-wood text-xs px-2 py-1 rounded">Ordered: Wardrobe - Signature</span>
        </div>

        <!-- Review 2 -->
        <div
          class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl hover:bg-wood-dark/60 transition-colors hover-lift">
          <div class="flex items-center gap-4 mb-4">
            <img src="assets/images/avatar-2.jpg" class="w-12 h-12 rounded-full object-cover border-2 border-wood"
              alt="Client">
            <div>
              <h4 class="font-bold text-white text-sm">Priya Patel</h4>
              <p class="text-xs text-muted">Pune, MH</p>
            </div>
          </div>
          <div class="flex items-center gap-1 mb-3 text-yellow-500 text-xs">
            <span>★★★★★</span>
          </div>
          <p class="text-gray-300 text-sm mb-4">"Absolutely love our new TV unit! It has transformed our living room.
            Great quality materials and very professional service."</p>
          <span class="inline-block bg-wood/20 text-wood text-xs px-2 py-1 rounded">Ordered: TV Unit - Classic</span>
        </div>

        <!-- Review 3 -->
        <div
          class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl hover:bg-wood-dark/60 transition-colors hover-lift">
          <div class="flex items-center gap-4 mb-4">
            <img src="assets/images/avatar-3.jpg" class="w-12 h-12 rounded-full object-cover border-2 border-wood"
              alt="Client">
            <div>
              <h4 class="font-bold text-white text-sm">Rahul Verma</h4>
              <p class="text-xs text-muted">Nasik, MH</p>
            </div>
          </div>
          <div class="flex items-center gap-1 mb-3 text-yellow-500 text-xs">
            <span>★★★★★</span>
          </div>
          <p class="text-gray-300 text-sm mb-4">"We ordered a custom platform bed and side tables. The design team was
            very helpful with the measurements. Highly recommend!"</p>
          <span class="inline-block bg-wood/20 text-wood text-xs px-2 py-1 rounded">Ordered: Platform Bed - Zen</span>
        </div>

      </div>
    </section>

    <!-- Featured products -->
    <section id="featured" class="mt-12">
      <h2 class="text-xl font-semibold mb-4 reveal fade-up">Featured Products</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
        <!-- Product card -->
        <article class="bg-wood-dark/60 rounded-lg overflow-hidden to-shadow-lg hover-card-zoom hover-lift">
          <img loading="lazy" src="assets/images/ai_tv_unit_1770204842451.png" alt="TV Unit Classic"
            class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-semibold">TV Unit — Classic</h3>
            <p class="mt-2 text-sm text-muted">Solid wood, cable management, customizable finish.</p>
            <div class="mt-3 flex items-center justify-between">
              <span class="font-bold">₹35,000</span>
              <button data-product="TV Unit — Classic"
                class="enquire-btn bg-wood text-black px-3 py-1 rounded hover:scale-105 transition-transform">Enquire</button>
            </div>
          </div>
        </article>
        <!-- Repeat a few products -->
        <article class="bg-wood-dark/60 rounded-lg overflow-hidden shadow-lg hover-card-zoom hover-lift">
          <img loading="lazy" src="assets/images/ai_bed_modern_1770204864113.png" alt="Platform Bed"
            class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Platform Bed</h3>
            <p class="mt-2 text-sm text-muted">Low-profile elegant bed with storage options.</p>
            <div class="mt-3 flex items-center justify-between">
              <span class="font-bold">₹28,000</span>
              <button data-product="Platform Bed"
                class="enquire-btn bg-wood text-black px-3 py-1 rounded hover:scale-105 transition-transform">Enquire</button>
            </div>
          </div>
        </article>
        <article class="bg-wood-dark/60 rounded-lg overflow-hidden shadow-lg hover-card-zoom hover-lift">
          <img loading="lazy" src="assets/images/wardrobe-builtin.jpg" alt="Wardrobe Slim"
            class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="font-semibold">Wardrobe — Slim</h3>
            <p class="mt-2 text-sm text-muted">Custom interiors, soft-close drawers.</p>
            <div class="mt-3 flex items-center justify-between">
              <span class="font-bold">₹18,000</span>
              <button data-product="Wardrobe — Slim"
                class="enquire-btn bg-wood text-black px-3 py-1 rounded hover:scale-105 transition-transform">Enquire</button>
            </div>
          </div>
        </article>
      </div>
    </section>

    <!-- Custom order -->
    <section class="mt-12 bg-wood-dark/50 rounded-lg p-6 reveal scale-up">
      <h2 class="text-lg font-semibold">Custom Orders</h2>
      <p class="mt-2 text-muted">Share your dimensions, finish preference and we'll craft a tailored solution.</p>
      <div class="mt-4">
        <a href="contact.php#quote" class="bg-wood text-black px-5 py-2 rounded hover-lift inline-block">Start a Custom
          Order</a>
      </div>
    </section>



    <!-- Testimonials -->
    <section class="mt-12">
      <h2 class="text-xl font-semibold mb-4 reveal fade-up">Testimonials</h2>
      <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 stagger-children">
        <div class="p-4 bg-wood-dark/60 rounded hover-lift">“Exceptional workmanship and on-time delivery.” — Anna</div>
        <div class="p-4 bg-wood-dark/60 rounded hover-lift">“Custom shelving transformed our living room.” — Carlos
        </div>
      </div>
    </section>

    <!-- Premium Request a Quote Section -->
    <section id="contact" class="mt-24 mb-20 relative">
      <!-- Background Glow (Radial) -->
      <div
        class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-full max-w-4xl h-full bg-wood/5 blur-[100px] rounded-full z-0 pointer-events-none">
      </div>

      <div class="max-w-[1000px] mx-auto px-4 relative z-10">
        <!-- Intro Header -->
        <div class="text-center mb-12 reveal fade-up">
          <span class="text-wood font-bold tracking-[0.2em] uppercase text-xs mb-3 block">Start Your Journey</span>
          <h2 class="text-4xl md:text-5xl font-bold text-white mb-4">Request a Consultation</h2>
          <p class="text-muted max-w-xl mx-auto text-lg font-light">
            Share your vision. We craft bespoke furniture pieces tailored to your exact specifications.
          </p>

          <!-- Trust Badges Row -->
          <div class="flex flex-wrapjustify-center gap-6 mt-6 opacity-80">
            <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-gray-400">
              <svg class="w-4 h-4 text-wood" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>Fast Response</span>
            </div>
            <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-gray-400">
              <svg class="w-4 h-4 text-wood" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>Free Quote</span>
            </div>
            <div class="flex items-center gap-2 text-xs uppercase tracking-wide text-gray-400">
              <svg class="w-4 h-4 text-wood" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>Custom Design</span>
            </div>
          </div>
        </div>

        <!-- Glassmorphism Form Card -->
        <div class="glass-form-card p-8 md:p-12 reveal zoom-in delay-100">
          <form id="premium-quote-form" class="space-y-8">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-stretch">
              <!-- Name -->
              <div class="premium-input-group flex flex-col justify-center">
                <input type="text" name="name" id="p_name"
                  class="premium-input min-h-[56px] flex items-center py-3 px-4" placeholder=" " required />
                <svg class="input-icon flex items-center h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <label for="p_name" class="premium-label">Full Name</label>
              </div>

              <!-- Email -->
              <div class="premium-input-group flex flex-col justify-center">
                <input type="email" name="email" id="p_email"
                  class="premium-input min-h-[56px] flex items-center py-3 px-4" placeholder=" " required />
                <svg class="input-icon flex items-center h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <label for="p_email" class="premium-label">Email Address</label>
              </div>

              <!-- Phone -->
              <div class="premium-input-group flex flex-col justify-center">
                <input type="tel" name="phone" id="p_phone"
                  class="premium-input min-h-[56px] flex items-center py-3 px-4" placeholder=" " required />
                <svg class="input-icon flex items-center h-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                  viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <label for="p_phone" class="premium-label">Phone Number</label>
              </div>

              <!-- Product (Floating Style Same As Other Inputs) -->
              <div class="dd">
                <button class="dd-btn" type="button">Select Product</button>
                <div class="dd-list">
                  <div class="dd-item">TV Unit</div>
                  <div class="dd-item">Wardrobe</div>
                  <div class="dd-item">Bed</div>
                  <div class="dd-item">Modular Kitchen</div>
                  <div class="dd-item">Home Office</div>
                  <div class="dd-item">Other Custom Work</div>
                </div>
              </div>
            </div>

            <!-- Message -->
            <div class="premium-input-group">
              <textarea name="message" id="p_message" class="premium-input" placeholder=" "></textarea>
              <svg class="input-icon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
              </svg>
              <label for="p_message" class="premium-label">Tell us about your project...</label>
            </div>

            <!-- Actions -->
            <div class="flex flex-col md:flex-row items-center gap-6 pt-4">
              <button type="submit"
                class="w-full md:w-auto flex-1 bg-gradient-to-r from-wood to-[#8c5a30] text-white font-bold text-lg py-4 px-8 rounded-lg shadow-[0_10px_30px_rgba(123,79,42,0.4)] hover:shadow-[0_15px_40px_rgba(123,79,42,0.6)] hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3 group">
                <span>Get My Quote</span>
                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                  stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                </svg>
              </button>

              <a href="https://wa.me/919373154925?text=Hi%20I%20am%20interested%20in%20a%20quote" target="_blank"
                class="w-full md:w-auto flex-1 border border-white/20 hover:border-[#25D366] hover:bg-[#25D366]/10 text-white font-medium text-lg py-4 px-8 rounded-lg transition-all duration-300 flex items-center justify-center gap-3 group">
                <svg class="w-6 h-6 fill-current text-[#25D366] group-hover:scale-110 transition-transform"
                  viewBox="0 0 24 24">
                  <path
                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg>
                WhatsApp
              </a>
            </div>

            <!-- Trust text footer -->
            <div class="text-center pt-2">
              <p class="text-sm text-gray-500 flex items-center justify-center gap-2">
                <svg class="w-4 h-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                Your information is secure. We respond within 24 hours.
              </p>
            </div>

          </form>

          <!-- Success Modal (Hidden by default) -->
          <div id="success-overlay"
            class="absolute inset-0 bg-black/80 backdrop-blur-sm flex items-center justify-center opacity-0 pointer-events-none transition-opacity duration-500 z-50 rounded-2xl">
            <div class="text-center p-8 transform scale-90 transition-transform duration-500" id="success-content">
              <div class="w-20 h-20 bg-wood/20 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                  <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
                  <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                </svg>
              </div>
              <h3 class="text-3xl font-bold text-white mb-2">Request Sent!</h3>
              <p class="text-gray-300">Thank you for reaching out. We will contact you shortly.</p>
              <button type="button" id="close-success"
                class="mt-8 text-sm text-wood hover:text-white underline">Close</button>
            </div>
          </div>

        </div>

        <!-- Mobile/Subtle footer content removed - moved to components/footer.html -->
      </div>
    </section>
  </main>

  <!-- WhatsApp floating button -->
  <!-- Floating Action Buttons -->
  <div class="fixed bottom-6 right-6 flex flex-col gap-3 z-50">
    <!-- Get Quote -->
    <a href="contact.html#quote"
      class="flex items-center justify-center w-14 h-14 bg-wood text-black rounded-full shadow-lg hover:scale-110 transition-transform"
      title="Get Instant Quote">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
          d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
    </a>
    <!-- WhatsApp -->
    <a href="https://wa.me/9373154925" target="_blank"
      class="flex items-center justify-center w-14 h-14 bg-green-500 text-white rounded-full shadow-lg hover:scale-110 transition-transform"
      title="Chat on WhatsApp">
      <svg class="h-8 w-8 fill-current" viewBox="0 0 24 24">
        <path
          d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
      </svg>
    </a>
  </div>

  <div id="footer-container">
    <!-- Footer Section moved to components/footer.html -->
  </div>

  <script src="assets/js/main.js"></script>
  <script src="assets/js/slider.js"></script>
  <script src="assets/js/form.js?v=1.2"></script>
  <script src="assets/js/animations.js"></script>
  <script src="assets/js/dropdown.js"></script>
  <script src="assets/js/ai-assistant.js?v=2"></script>
</body>

</html>