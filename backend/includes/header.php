<!-- Header component: navigation -->
<?php
// Detect if current page is the home page
$pageName = basename($_SERVER['PHP_SELF']);
$isHome = ($pageName === '' || $pageName === 'index.php' || $pageName === 'index.html' || $pageName === 'index');
?>
<header class="sticky top-0 z-40 backdrop-blur bg-wood-dark/70">
  <div class="max-w-6xl mx-auto px-4 sm:px-6">
    <nav class="flex items-center justify-between h-16">
      <a href="index" class="text-2xl font-semibold text-white flex items-center gap-[2px]" style="font-size:clamp(1.125rem,3vw,1.5rem)">
        <span class="brand-logo inline-flex">W</span>
        <span>avelength<span style="color:var(--wood)"> Enterprises</span></span>
      </a>

      <!-- Desktop nav -->
      <ul id="nav" class="hidden md:flex space-x-6 items-center text-sm">
        <li><a href="index" class="hover:text-wood transition-colors">Home</a></li>
        <li><a href="about" class="hover:text-wood transition-colors">About</a></li>
        <li><a href="services" class="hover:text-wood transition-colors">Services</a></li>
        <li><a href="products" class="hover:text-wood transition-colors">Products</a></li>
        <li><a href="gallery" class="hover:text-wood transition-colors">Gallery</a></li>
        <li><a href="contact" class="hover:text-wood transition-colors">Contact</a></li>
      </ul>

      <!-- Mobile hamburger button -->
      <button id="menu-btn" class="hamburger md:hidden" aria-label="Open menu" aria-expanded="false">
        <div class="hamburger-lines">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </button>
    </nav>
  </div>
</header>

<!-- Mobile drawer backdrop -->
<div id="drawer-backdrop"></div>

<!-- Mobile drawer navigation -->
<nav id="mobile-nav-drawer" aria-label="Mobile navigation">
  <button class="drawer-close-btn" id="drawer-close" aria-label="Close menu">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <line x1="18" y1="6" x2="6" y2="18"></line>
      <line x1="6" y1="6" x2="18" y2="18"></line>
    </svg>
  </button>

  <div style="margin-top:var(--space-4)">
    <p style="font-size:0.75rem;text-transform:uppercase;letter-spacing:0.15em;color:rgba(123,79,42,0.8);margin-bottom:var(--space-2);padding-left:var(--space-1)">Navigation</p>
    <ul style="display:flex;flex-direction:column;gap:2px">
      <li><a href="index"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
            <polyline points="9 22 9 12 15 12 15 22" />
          </svg>Home</a></li>
      <li><a href="about"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="10" />
            <line x1="12" y1="16" x2="12" y2="12" />
            <line x1="12" y1="8" x2="12.01" y2="8" />
          </svg>About</a></li>
      <li><a href="services"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z" />
          </svg>Services</a></li>
      <li><a href="products"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
            <path d="M16 7V5a4 4 0 0 0-8 0v2" />
          </svg>Products</a></li>
      <li><a href="gallery"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
            <circle cx="8.5" cy="8.5" r="1.5" />
            <polyline points="21 15 16 10 5 21" />
          </svg>Gallery</a></li>
      <li><a href="contact"><svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
          </svg>Contact</a></li>
    </ul>
  </div>

  <!-- Drawer CTA -->
  <div style="margin-top:auto;padding-top:var(--space-4);border-top:1px solid rgba(255,255,255,0.06)">
    <a href="contact#quote" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;min-height:48px;background:var(--wood);color:#000;font-weight:700;border-radius:10px;font-size:0.95rem;transition:opacity 0.2s">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
      </svg>
      Get a Quote
    </a>
    <a href="https://wa.me/919373154925" target="_blank" style="display:flex;align-items:center;justify-content:center;gap:8px;width:100%;min-height:48px;background:#25D366;color:#fff;font-weight:600;border-radius:10px;font-size:0.95rem;margin-top:8px;transition:opacity 0.2s">
      <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
      </svg>
      WhatsApp Us
    </a>
  </div>
</nav>

<!-- Active link highlighting script -->
<script>
  (function() {
    var path = window.location.pathname.replace(/\/$/, '').split('/').pop() || 'index';
    path = path.replace('.php', '');
    // Desktop nav
    document.querySelectorAll('#nav a').forEach(function(a) {
      var href = a.getAttribute('href').replace('.php', '');
      if (href === path) a.classList.add('active-link');
    });
    // Drawer nav
    document.querySelectorAll('#mobile-nav-drawer a').forEach(function(a) {
      var href = a.getAttribute('href');
      if (href && href.replace('.php', '') === path) a.classList.add('active-link');
    });
  })();
</script>