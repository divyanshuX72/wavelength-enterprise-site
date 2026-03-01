<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Gallery — Wavelength Enterprises</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="frontend/css/tailwind.css">
  <link rel="stylesheet" href="frontend/css/style.css">
  <link rel="stylesheet" href="frontend/css/responsive.css">
  <link rel="stylesheet" href="frontend/css/dropdown.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="data:,"><!-- placeholder favicon -->
</head>

<body class="bg-wood-dark text-gray-100 antialiased font-sans">
  <?php require_once 'backend/includes/header.php'; ?>

  <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <div class="text-center mb-10">
      <h1 class="text-3xl font-bold reveal fade-up">Project Gallery</h1>
      <p class="text-muted mt-2 reveal fade-up delay-100">Explore our portfolio of handcrafted furniture and interior
        projects.</p>
    </div>

    <!-- Filter Buttons -->
    <div class="flex flex-wrap justify-center gap-3 mb-10 reveal scale-up delay-200">
      <button
        class="filter-btn active px-5 py-2 rounded-full border border-wood bg-wood text-black font-medium transition-all hover:bg-white hover:scale-105"
        data-filter="tv">TV Units</button>
      <button
        class="filter-btn px-5 py-2 rounded-full border border-gray-600 text-gray-300 transition-all hover:border-wood hover:text-wood hover:scale-105"
        data-filter="beds">Beds</button>
      <button
        class="filter-btn px-5 py-2 rounded-full border border-gray-600 text-gray-300 transition-all hover:border-wood hover:text-wood hover:scale-105"
        data-filter="wardrobes">Wardrobes</button>
      <button
        class="filter-btn px-5 py-2 rounded-full border border-gray-600 text-gray-300 transition-all hover:border-wood hover:text-wood hover:scale-105"
        data-filter="custom">Custom Work</button>
      <button
        class="filter-btn px-5 py-2 rounded-full border border-gray-600 text-gray-300 transition-all hover:border-wood hover:text-wood hover:scale-105"
        data-filter="office">Office Furniture</button>
      <button
        class="filter-btn px-5 py-2 rounded-full border border-gray-600 text-gray-300 transition-all hover:border-wood hover:text-wood hover:scale-105"
        data-filter="kitchen">Modular Kitchen</button>
    </div>

    <!-- Gallery Grid -->
    <div id="gallery-grid" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 stagger-children">
      <!-- TV Units -->
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="tv">
        <img src="frontend/images/ai_tv_unit_1770204842451.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="TV Unit 1">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Teak Unit</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="tv">
        <img src="frontend/images/tv-unit-wall.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="TV Unit 2">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Minimalist
            Wall Unit</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="tv">
        <img src="frontend/images/tv-unit-modern.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="TV Unit 3">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Contemporary
            TV Cabinet</span>
        </div>
      </div>


      <!-- Beds -->
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="beds">
        <img src="frontend/images/ai_bed_modern_1770204864113.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Bed 1">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Platform Bed</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="beds">
        <img src="frontend/images/bed-modern.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Bed 2">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Contemporary
            Bed Frame</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="beds">
        <img src="frontend/images/bed-canopy.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Bed 3">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Elegant
            Canopy Bed</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="beds">
        <img src="frontend/images/bedroom-1.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Bed 4">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Luxury
            Master Bed</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="beds">
        <img src="frontend/images/ai_full_bedroom_after_1770206111031.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Bed 5">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Complete
            Bedroom Suite</span>
        </div>
      </div>

      <!-- Wardrobes -->
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="wardrobes">
        <img src="frontend/images/ai_wardrobe_sleek_1770204884623.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Wardrobe 1">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Sliding Wardrobe</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="wardrobes">
        <img src="frontend/images/wardrobe-builtin.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Wardrobe 2">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Built-in
            Wardrobe</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="wardrobes">
        <img src="frontend/images/wardrobe-walkin.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Wardrobe 3">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Walk-in
            Closet System</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="wardrobes">
        <img src="frontend/images/wardrobe-classic.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Wardrobe 4">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Classic
            Wooden Wardrobe</span>
        </div>
      </div>


      <!-- Custom Work -->
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="custom">
        <img src="frontend/images/custom-study.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom 1">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Custom
            Study Table</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="custom">
        <img src="frontend/images/custom-console.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom 2">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Living
            Room Console</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="custom">
        <img src="frontend/images/ai_kitchen_modern_1770204908651.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom 3">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Kitchen Cabinetry</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="custom">
        <img src="frontend/images/kitchen-modular.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom 5">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modular
            Kitchen Design</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="custom">
        <img src="frontend/images/dining-1.jpg"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Custom 7">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Dining
            Room Set</span>
        </div>
      </div>

      <!-- Office Furniture -->

      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_desk_executive_1771023315997.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 4">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Executive
            Desk Setup</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_workstation_modern_1771023329722.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 5">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Workstation</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_cabinet_storage_1771023348187.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 6">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Storage
            Cabinets</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_conference_table_1771023364208.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 7">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Conference
            Table</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_reception_desk_1771023380183.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 8">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Reception
            Desk</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_executive_desk_1771023414214.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 9">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Premium
            Executive Desk</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_computer_workstation_1771023436552.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 10">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Computer
            Workstation</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_conference_table_1771023456802.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 11">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Boardroom
            Conference Setup</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_storage_cabinet_1771023472767.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 12">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Office
            Storage Solutions</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="office">
        <img src="frontend/images/office_executive_setup_1771023487973.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Office 13">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Complete
            Executive Office</span>
        </div>
      </div>


      <!-- Modular Kitchen -->
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/ai_kitchen_modern_1770204908651.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 1">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Contemporary
            Kitchen Design</span>
        </div>
      </div>

      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/modular_kitchen_luxury_black_1771021260305.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 4">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Luxury
            Black Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/modular_kitchen_contemporary_white_1771021275709.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 5">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Contemporary
            White Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/modular_kitchen_premium_navy_1771021294369.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 6">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Premium
            Navy Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_1_1771021323970.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 7">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Luxury
            Modern Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_2_1771021341900.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 8">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Sleek
            Designer Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_1_1771021410637.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 9">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Elite
            Modular Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_2_1771021426585.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 10">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Premium
            Island Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_3_1771021442510.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 11">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Luxury
            Open Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_1_1771021473377.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 12">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Advanced
            Kitchen Design</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_2_1771021491843.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 13">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Sophisticated
            Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_modular_kitchen_3_1771021509355.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 14">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Modern
            Luxury Kitchen</span>
        </div>
      </div>
      <div class="gallery-item group relative overflow-hidden rounded-xl h-64 cursor-pointer hover-card-zoom"
        data-category="kitchen">
        <img src="frontend/images/luxury_kitchen_minimalist_1771021535742.png"
          class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" alt="Kitchen 15">
        <div
          class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center backdrop-blur-sm">
          <span
            class="text-white font-semibold transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">Minimalist
            Luxury Kitchen</span>
        </div>
      </div>

    </div>
  </main>


  <!-- Floating Action Buttons -->

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

  <?php require_once 'backend/includes/footer.php'; ?>

  <script src="frontend/js/main.js"></script>
  <script src="frontend/js/gallery.js"></script>
  <script src="frontend/js/animations.js"></script>
</body>

</html>