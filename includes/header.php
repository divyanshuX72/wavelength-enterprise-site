<!-- Header component: navigation -->
<header class="sticky top-0 z-40 backdrop-blur bg-wood-dark/70">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <nav class="flex items-center justify-between h-16">
      <a href="index" class="text-2xl font-semibold text-white">Wavelength<span style="color:var(--wood)"> Enterprises</span></a>
      <button id="menu-btn" class="md:hidden p-2 text-gray-200">☰</button>
      <ul id="nav" class="hidden md:flex space-x-6 items-center text-sm">
        <li><a href="index" class="hover:text-wood">Home</a></li>
        <li><a href="about" class="hover:text-wood">About</a></li>
        <li><a href="services" class="hover:text-wood">Services</a></li>
        <li><a href="products" class="hover:text-wood">Products</a></li>
        <li><a href="gallery" class="hover:text-wood">Gallery</a></li>
        <li><a href="contact" class="hover:text-wood">Contact</a></li>
      </ul>
    </nav>
  </div>
  <div id="mobile-nav" class="md:hidden hidden px-4 pb-4">
    <ul class="space-y-2">
      <li><a href="index" class="block">Home</a></li>
      <li><a href="about" class="block">About</a></li>
      <li><a href="services" class="block">Services</a></li>
      <li><a href="products" class="block">Products</a></li>
      <li><a href="gallery" class="block">Gallery</a></li>
      <li><a href="contact" class="block">Contact</a></li>
    </ul>
  </div>
</header>
