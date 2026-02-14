<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>About Us — Wavelength Enterprises</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

  <link rel="stylesheet" href="assets/css/tailwind.css">
  <link rel="stylesheet" href="assets/css/responsive.css">
  <link rel="stylesheet" href="assets/css/dropdown.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="data:,">
  <!-- placeholder favicon -->
</head>

<body class="bg-wood-dark text-gray-100 antialiased font-sans">

  <?php require_once 'includes/header.php'; ?>

  <main>

    <!-- 1. Hero About Banner -->
    <section class="relative h-[60vh] flex items-center justify-center text-center px-4 bg-fixed bg-cover bg-center"
      style="background-image: url('assets/images/about-hero.jpg');">
      <div class="absolute inset-0 bg-black/70"></div>
      <div class="relative z-10 max-w-4xl mx-auto reveal zoom-in">
        <span class="text-wood font-bold tracking-wider uppercase text-sm mb-2 block">Since 1972</span>
        <h1 class="text-4xl md:text-5xl lg:text-6xl font-extrabold text-white mb-6">Mastering the Art of Custom
          Furniture</h1>
        <p class="text-lg md:text-xl text-gray-300 max-w-2xl mx-auto mb-8">
          Bespoke TV units, premium beds, and wardrobes — crafted to perfection for homes in Vasai-Virar & Mumbai.
        </p>
        <a href="contact.html#quote"
          class="inline-block bg-wood text-black font-bold px-8 py-3 rounded-full hover:bg-white hover:scale-105 transition-all shadow-[0_0_20px_rgba(123,79,42,0.4)]">
          Contact for Custom Quote
        </a>
      </div>
    </section>

    <!-- 2. Company Overview -->
    <section class="py-20 px-4 max-w-6xl mx-auto">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
        <div class="reveal fade-right">
          <div class="relative">
            <img src="assets/images/carpenter-work.jpg" alt="Carpenter at work"
              class="rounded-xl shadow-2xl border border-white/10">
            <div
              class="absolute -bottom-6 -right-6 bg-wood-dark p-6 rounded-xl border border-wood shadow-xl hidden md:block">
              <p class="text-4xl font-bold text-wood">50+</p>
              <p class="text-sm text-gray-400 uppercase tracking-widest">Years Experience</p>
            </div>
          </div>
        </div>
        <div class="reveal fade-left">
          <h2 class="text-3xl font-bold mb-6">More Than Just Furniture,<br>It's A Legacy.</h2>
          <p class="text-gray-400 mb-4 leading-relaxed">
            At <strong>Wavelength Enterprises</strong>, we don't just build furniture; we craft experiences. Based in
            the
            heart of <strong>Vasai-Virar</strong>, we have spent decades perfecting the balance between aesthetic beauty
            and structural durability.
          </p>
          <p class="text-gray-400 mb-6 leading-relaxed">
            We specialize in turning your vision into reality. Whether it's a space-saving modular kitchen for a compact
            apartment or a luxurious king-size bed for a master suite, our approach is always the same:
            <strong>Precision,
              Quality, and Integrity.</strong>
          </p>
          <div class="flex items-center gap-4">
            <div class="flex -space-x-4">
              <img class="w-10 h-10 rounded-full border-2 border-wood-dark" src="assets/images/avatar-1.jpg" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-wood-dark" src="assets/images/avatar-3.jpg" alt="">
              <img class="w-10 h-10 rounded-full border-2 border-wood-dark" src="assets/images/avatar-4.jpg" alt="">
            </div>
            <span class="text-sm text-muted">Trusted by 500+ Local Families</span>
          </div>
        </div>
      </div>
    </section>

    <!-- 3. Feature Grid (Differentiation) -->
    <section class="py-20 bg-black/20">
      <div class="max-w-6xl mx-auto px-4">
        <div class="text-center mb-16 reveal">
          <span class="text-wood font-bold tracking-wider uppercase text-sm">Why Choose Us</span>
          <h2 class="text-3xl font-bold mt-2">The Wavelength Difference</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
          <!-- Card 1 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Custom Design Approach</h3>
            <p class="text-gray-400 text-sm">We don't do "one size fits all". Every piece is designed to fit your
              specific wall dimensions and style preference.</p>
          </div>

          <!-- Card 2 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal stagger-1">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Space-Optimized</h3>
            <p class="text-gray-400 text-sm">Our specialty is maximizing utility in compact Mumbai apartments without
              compromising on elegance.</p>
          </div>

          <!-- Card 3 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal stagger-2">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Premium Materials</h3>
            <p class="text-gray-400 text-sm">We use only BWP-grade plywood, high-density MDF, and authentic veneers. No
              cheap particle board.</p>
          </div>

          <!-- Card 4 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">On-Time Delivery</h3>
            <p class="text-gray-400 text-sm">We respect your time. Our project timeline is guaranteed, with updates at
              every manufacturing stage.</p>
          </div>

          <!-- Card 5 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal stagger-1">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">Transparent Pricing</h3>
            <p class="text-gray-400 text-sm">No hidden costs. Detailed quotations that break down material and labor
              costs clearly.</p>
          </div>

          <!-- Card 6 -->
          <div
            class="bg-wood-dark border border-white/5 p-8 rounded-xl hover:border-wood/40 transition-colors group reveal stagger-2">
            <div
              class="w-12 h-12 bg-wood/10 rounded-lg flex items-center justify-center mb-6 text-wood group-hover:bg-wood group-hover:text-black transition-colors">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold mb-3">After-Install Support</h3>
            <p class="text-gray-400 text-sm">We don't disappear after installation. We offer service checks to ensure
              hardware stays smooth.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- 4. Furniture Specialization -->
    <section class="py-20 px-4 max-w-6xl mx-auto">
      <div class="text-center mb-12 reveal">
        <h2 class="text-3xl font-bold">Our Craftsmanship Categories</h2>
        <p class="text-muted mt-2">Specializing in residential and commercial woodwork</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
        <!-- Item 1 -->
        <a href="products.php" class="group relative rounded-lg overflow-hidden h-40 md:h-64 reveal">
          <img src="assets/images/ai_tv_unit_1770204842451.png"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="TV Unit">
          <div
            class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
            <span class="font-bold text-white text-center px-2">TV Units</span>
          </div>
        </a>
        <!-- Item 2 -->
        <a href="products.php" class="group relative rounded-lg overflow-hidden h-40 md:h-64 reveal stagger-1">
          <img src="assets/images/ai_bed_modern_1770204864113.png"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Beds">
          <div
            class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
            <span class="font-bold text-white text-center px-2">Premium Beds</span>
          </div>
        </a>
        <!-- Item 3 -->
        <a href="products.php" class="group relative rounded-lg overflow-hidden h-40 md:h-64 reveal stagger-2">
          <img src="assets/images/ai_wardrobe_sleek_1770204884623.png"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Wardrobes">
          <div
            class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
            <span class="font-bold text-white text-center px-2">Wardrobes</span>
          </div>
        </a>
        <!-- Item 4 -->
        <a href="products.php" class="group relative rounded-lg overflow-hidden h-40 md:h-64 reveal stagger-3">
          <img src="assets/images/ai_kitchen_modern_1770204908651.png"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Modular">
          <div
            class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
            <span class="font-bold text-white text-center px-2">Modular</span>
          </div>
        </a>
        <!-- Item 5 -->
        <a href="products.php"
          class="group relative rounded-lg overflow-hidden h-40 md:h-64 md:col-span-1 col-span-2 reveal stagger-4">
          <img src="assets/images/custom-console.jpg"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom">
          <div
            class="absolute inset-0 bg-black/50 flex items-center justify-center group-hover:bg-black/30 transition-colors">
            <span class="font-bold text-white text-center px-2">Custom</span>
          </div>
        </a>
      </div>
    </section>

    <!-- 5. Work Process Timeline -->
    <section class="py-20 bg-wood-dark border-y border-white/5">
      <div class="max-w-6xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-16 reveal">How We Work</h2>

        <div class="hidden md:flex justify-between relative">
          <!-- Connector Line -->
          <div class="absolute top-8 left-0 w-full h-1 bg-gray-800 -z-0"></div>

          <!-- Steps -->
          <div class="relative z-10 text-center w-1/6 reveal">
            <div
              class="w-16 h-16 bg-wood text-black font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-wood-dark">
              1</div>
            <h4 class="font-bold">Consult</h4>
            <p class="text-xs text-muted mt-2">Understanding your needs</p>
          </div>
          <div class="relative z-10 text-center w-1/6 reveal stagger-1">
            <div
              class="w-16 h-16 bg-black border border-wood text-wood font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-wood-dark">
              2</div>
            <h4 class="font-bold">Measure</h4>
            <p class="text-xs text-muted mt-2">Precision site survey</p>
          </div>
          <div class="relative z-10 text-center w-1/6 reveal stagger-2">
            <div
              class="w-16 h-16 bg-black border border-wood text-wood font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-wood-dark">
              3</div>
            <h4 class="font-bold">Design</h4>
            <p class="text-xs text-muted mt-2">2D/3D selection</p>
          </div>
          <div class="relative z-10 text-center w-1/6 reveal stagger-3">
            <div
              class="w-16 h-16 bg-black border border-wood text-wood font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-wood-dark">
              4</div>
            <h4 class="font-bold">Build</h4>
            <p class="text-xs text-muted mt-2">Crafting in workshop</p>
          </div>
          <div class="relative z-10 text-center w-1/6 reveal stagger-4">
            <div
              class="w-16 h-16 bg-wood text-black font-bold text-xl rounded-full flex items-center justify-center mx-auto mb-4 border-4 border-wood-dark">
              5</div>
            <h4 class="font-bold">Install</h4>
            <p class="text-xs text-muted mt-2">Final fitting & check</p>
          </div>
        </div>

        <!-- Mobile Steps (Vertical) -->
        <div class="md:hidden space-y-8 pl-8 border-l border-wood/30 ml-4">
          <div class="relative pl-6 reveal">
            <div
              class="absolute -left-[45px] top-0 w-8 h-8 bg-wood rounded-full text-black flex items-center justify-center font-bold text-sm">
              1</div>
            <h4 class="font-bold">Consultation</h4>
            <p class="text-sm text-gray-400">We discuss your requirements and budget.</p>
          </div>
          <div class="relative pl-6 reveal">
            <div
              class="absolute -left-[45px] top-0 w-8 h-8 bg-black border border-wood rounded-full text-wood flex items-center justify-center font-bold text-sm">
              2</div>
            <h4 class="font-bold">Measurement</h4>
            <p class="text-sm text-gray-400">Our team visits for exact measurements.</p>
          </div>
          <div class="relative pl-6 reveal">
            <div
              class="absolute -left-[45px] top-0 w-8 h-8 bg-black border border-wood rounded-full text-wood flex items-center justify-center font-bold text-sm">
              3</div>
            <h4 class="font-bold">Manufacturing</h4>
            <p class="text-sm text-gray-400">Crafting your furniture with selected materials.</p>
          </div>
          <div class="relative pl-6 reveal">
            <div
              class="absolute -left-[45px] top-0 w-8 h-8 bg-wood rounded-full text-black flex items-center justify-center font-bold text-sm">
              4</div>
            <h4 class="font-bold">Installation</h4>
            <p class="text-sm text-gray-400">Final setup at your location.</p>
          </div>
        </div>

      </div>
    </section>

    <!-- 6. Materials & Finish Expertise -->
    <section class="py-20 px-4 max-w-6xl mx-auto text-center">
      <div class="mb-12 reveal">
        <h2 class="text-3xl font-bold">Materials We Trust</h2>
        <p class="text-muted mt-2">We partner with top brands to ensure longevity.</p>
      </div>

      <div class="flex flex-wrap justify-center gap-4">
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal">BWP
          Plywood</span>
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal stagger-1">HDHMR
          (High Moisture Resistance)</span>
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal stagger-2">Teak
          Veneer</span>
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal stagger-3">PU
          High-Gloss</span>
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal stagger-4">Acrylic
          Laminates</span>
        <span
          class="px-6 py-3 rounded-full bg-white/5 border border-white/10 text-gray-300 font-medium hover:border-wood hover:text-wood transition-colors reveal stagger-1">Hettich
          / Hafele Fittings</span>
      </div>
    </section>

    <!-- 7. Trust & Quality Assurance -->
    <section class="py-12 bg-wood text-black">
      <div class="max-w-6xl mx-auto px-4 flex flex-col md:flex-row justify-around text-center gap-8">
        <div class="reveal">
          <div class="font-bold text-4xl mb-1">5 Year</div>
          <div class="text-sm font-semibold opacity-80">Warranty on Woodwork</div>
        </div>
        <div class="reveal stagger-1">
          <div class="font-bold text-4xl mb-1">100%</div>
          <div class="text-sm font-semibold opacity-80">Termite Proof Materials</div>
        </div>
        <div class="reveal stagger-2">
          <div class="font-bold text-4xl mb-1">48 Hr</div>
          <div class="text-sm font-semibold opacity-80">Service Guarantee</div>
        </div>
      </div>
    </section>

    <!-- 8. Client Testimonials -->
    <section class="py-20 px-4 max-w-6xl mx-auto">
      <h2 class="text-3xl font-bold text-center mb-12">Stories from Happy Homes</h2>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl reveal">
          <p class="italic text-gray-300 mb-4">"Wavelength transformed our small bedroom. The storage bed they built
            gave us so much extra space we didn't know we had."</p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-wood rounded-full flex items-center justify-center text-black font-bold">R</div>
            <div>
              <p class="font-bold text-sm">Rahul M.</p>
              <p class="text-xs text-muted">Vasai West</p>
            </div>
          </div>
        </div>
        <div class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl reveal stagger-1">
          <p class="italic text-gray-300 mb-4">"Professional finish. I wanted a specific matte walnut look for my TV
            unit and they matched it perfectly."</p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-wood rounded-full flex items-center justify-center text-black font-bold">P</div>
            <div>
              <p class="font-bold text-sm">Priya S.</p>
              <p class="text-xs text-muted">Virar Global City</p>
            </div>
          </div>
        </div>
        <div class="bg-wood-dark/40 border border-white/5 p-6 rounded-xl reveal stagger-2">
          <p class="italic text-gray-300 mb-4">"Best part was the transparency. The quote was clear and there were no
            hidden charges at the end."</p>
          <div class="flex items-center gap-3">
            <div class="w-10 h-10 bg-wood rounded-full flex items-center justify-center text-black font-bold">A</div>
            <div>
              <p class="font-bold text-sm">Ankit D.</p>
              <p class="text-xs text-muted">Nalasopara East</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- 9. Workshop Story -->
    <section class="py-20 bg-black/30">
      <div class="max-w-4xl mx-auto px-4 text-center reveal zoom-in">
        <span class="text-6xl text-wood opacity-20 font-serif">"</span>
        <h3 class="text-2xl md:text-3xl font-bold font-serif italic mb-6">
          Every piece that leaves our workshop carries our family name. We sand, polish, and inspect it until it's
          something we'd be proud to keep in our own home.
        </h3>
        <p class="text-wood font-bold">— The Workshop Team</p>
      </div>
    </section>

    <!-- 10. Contact CTA Section -->
    <section class="py-24 px-4 text-center">
      <div class="max-w-3xl mx-auto reveal">
        <h2 class="text-4xl font-bold mb-6">Ready to Build Your Custom Furniture?</h2>
        <p class="text-xl text-gray-400 mb-10">Let's discuss your requirements. Visit our studio or get a quick quote
          online.</p>

        <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
          <a href="contact#quote"
            class="bg-wood text-black font-bold py-4 px-8 rounded hover:bg-white transition-colors shadow-lg shadow-wood/20">
            Get Custom Quote
          </a>
          <a href="https://wa.me/919373154925?text=Hi%20Wavelength%20Enterprises"
            class="bg-[#25D366] text-white font-bold py-4 px-8 rounded hover:bg-[#128C7E] transition-colors flex items-center justify-center gap-2">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
            WhatsApp Now
          </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 text-left border-t border-gray-800 pt-8">
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
                <span class="text-white">Pelhar Rd, Wakanpada,<br>
                  Nalasopara East, Vasai-Virar,<br>
                  Maharashtra 401208</span>
              </p>

              <p class="text-muted"><strong>Website:</strong><br>
                <a href="https://www.wavelengthenterprises.in" target="_blank"
                  class="hover:text-wood transition-colors text-white">www.wavelengthenterprises.in</a>
              </p>
            </div>
          </div>

          <!-- Map -->
          <div class="h-80 w-full bg-wood-dark/40 rounded-xl overflow-hidden border border-white/5">
            <iframe
              src="https://www.google.com/maps?q=Pelhar%20Rd,%20Wakanpada,%20Nalasopara%20East,%20Vasai-Virar,%20Maharashtra%20401208&output=embed"
              width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
          </div>
        </div>

      </div>
    </section>

  </main>

  <div id="footer-container"></div>

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

  <script src="assets/js/main.js"></script>
  <script src="assets/js/animations.js"></script>
</body>

</html>