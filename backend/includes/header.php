<!-- Header component: navigation -->
<?php
// Detect current page for active nav highlighting
$current_page = basename($_SERVER['PHP_SELF'], '.php');
if ($current_page === '' || $current_page === 'index') $current_page = 'index';
?>
<header class="sticky top-0 z-40 backdrop-blur bg-wood-dark/70" id="site-header">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <nav class="flex items-center justify-between h-16">
      <a href="index.php" class="nav-brand animated-brand">
        <div class="animated-w-box">W</div>
        <div class="animated-text-group">
          <span class="animated-text-main">avelength</span>
          <span class="animated-text-sub">Enterprises</span>
        </div>
      </a>
      <!-- Hamburger Button (Mobile) -->
      <button id="menu-btn" class="md:hidden p-2 text-gray-200 relative z-[60] flex flex-col items-center justify-center w-10 h-10" aria-label="Toggle Menu" aria-expanded="false">
        <span class="hamburger-line hamburger-line-1"></span>
        <span class="hamburger-line hamburger-line-2"></span>
        <span class="hamburger-line hamburger-line-3"></span>
      </button>
      <!-- Desktop Nav -->
      <ul id="nav" class="hidden md:flex space-x-6 items-center text-sm">
        <li><a href="index.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'index' ? 'text-wood font-semibold nav-active' : ''; ?>">Home</a></li>
        <li><a href="about.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'about' ? 'text-wood font-semibold nav-active' : ''; ?>">About</a></li>
        <li><a href="services.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'services' ? 'text-wood font-semibold nav-active' : ''; ?>">Services</a></li>
        <li><a href="products.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'products' ? 'text-wood font-semibold nav-active' : ''; ?>">Products</a></li>
        <li><a href="gallery.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'gallery' ? 'text-wood font-semibold nav-active' : ''; ?>">Gallery</a></li>
        <li><a href="contact.php" class="nav-link hover:text-wood transition-colors <?php echo $current_page === 'contact' ? 'text-wood font-semibold nav-active' : ''; ?>">Contact</a></li>
      </ul>
    </nav>
  </div>

  <!-- Mobile Drawer Overlay -->
  <div id="mobile-overlay" class="mobile-overlay"></div>

  <!-- Mobile Slide-in Drawer -->
  <div id="mobile-drawer" class="mobile-drawer">
    <div class="mobile-drawer-header">
      <div class="animated-brand">
        <div class="animated-w-box" style="width:24px;height:24px;font-size:16px;border-radius:4px;">W</div>
        <div class="animated-text-group text-lg">
          <span class="animated-text-main">avelength</span>
          <span class="animated-text-sub">Enterprises</span>
        </div>
      </div>
    </div>
    <nav class="mobile-drawer-nav">
      <a href="index.php" class="mobile-nav-link <?php echo $current_page === 'index' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
        </svg>
        Home
      </a>
      <a href="about.php" class="mobile-nav-link <?php echo $current_page === 'about' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        About
      </a>
      <a href="services.php" class="mobile-nav-link <?php echo $current_page === 'services' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
        </svg>
        Services
      </a>
      <a href="products.php" class="mobile-nav-link <?php echo $current_page === 'products' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
        </svg>
        Products
      </a>
      <a href="gallery.php" class="mobile-nav-link <?php echo $current_page === 'gallery' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        Gallery
      </a>
      <a href="contact.php" class="mobile-nav-link <?php echo $current_page === 'contact' ? 'mobile-nav-active' : ''; ?>">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
        </svg>
        Contact
      </a>
    </nav>
    <!-- Drawer Footer -->
    <div class="mobile-drawer-footer">
      <a href="https://wa.me/919373154925" target="_blank" class="mobile-drawer-whatsapp">
        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
        </svg>
        Chat on WhatsApp
      </a>
      <p class="text-xs text-gray-500 mt-3">&copy; <span id="drawer-year">2026</span> Wavelength Enterprises</p>
    </div>
  </div>
</header>