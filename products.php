<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Products — Wavelength Enterprises</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <link rel="stylesheet" href="frontend/css/tailwind.css">
  <link rel="stylesheet" href="frontend/css/style.css">
  <link rel="stylesheet" href="frontend/css/responsive.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="icon" href="data:,"><!-- placeholder favicon -->
  <link rel="stylesheet" href="frontend/css/dropdown.css">

</head>

<body class="bg-wood-dark text-gray-100 antialiased font-sans">

  <?php require_once 'backend/includes/header.php'; ?>

  <main class="max-w-6xl mx-auto px-4 sm:px-6 py-10">
    <div class="text-center mb-12">
      <h1 class="text-3xl md:text-4xl font-bold mb-4 reveal fade-up">Our Premium Collection</h1>
      <p class="text-muted max-w-2xl mx-auto reveal fade-up delay-100">Discover our handcrafted furniture, designed for
        elegance and durability.
        Customize any piece to fit your unique space.</p>
    </div>

    <!-- Product Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 stagger-children">
      <?php
      require_once 'backend/config/db_connection.php';
      
      $category_filter = isset($_GET['category']) ? $conn->real_escape_string($_GET['category']) : '';
      $sql = "SELECT * FROM products";
      if ($category_filter) {
          $sql .= " WHERE category = '$category_filter'";
      }
      $sql .= " ORDER BY created_at DESC";
      
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
              $name = htmlspecialchars($row["name"]);
              $category = htmlspecialchars($row["category"]);
              $price = htmlspecialchars($row["price_start"]);
              $material = htmlspecialchars($row["material"]);
              $sizes = htmlspecialchars($row["sizes"]);
              $image = htmlspecialchars($row["image_path"]);
              $link_name = urlencode($row["name"]);
      ?>
      <article data-category="<?php echo $category; ?>"
        class="bg-wood-dark/40 rounded-xl overflow-hidden shadow-lg border border-white/5 hover:border-wood/30 transition-all duration-300 hover:-translate-y-1 group pb-product-item hover-card-zoom">
        <div class="relative h-64 overflow-hidden">
          <img src="<?php echo $image; ?>" alt="<?php echo $name; ?>"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
          <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors"></div>
          <button
            class="quick-view-btn absolute bottom-4 left-1/2 -translate-x-1/2 bg-white/90 text-black px-6 py-2 rounded-full font-semibold shadow-lg opacity-0 translate-y-4 group-hover:opacity-100 group-hover:translate-y-0 transition-all duration-300 z-10 hover:bg-wood hover:text-white"
            data-title="<?php echo $name; ?>"
            data-price="Starting from ₹<?php echo $price; ?>"
            data-desc="Premium handcrafted furniture."
            data-materials="<?php echo $material; ?>"
            data-sizes="<?php echo $sizes; ?>"
            data-img="<?php echo $image; ?>">
            Quick View
          </button>
        </div>
        <div class="p-6">
          <h2 class="text-xl font-bold text-white mb-2"><?php echo $name; ?></h2>
          <p class="text-wood font-semibold mb-4">Starting from ₹<?php echo $price; ?></p>

          <div class="space-y-2 text-sm text-gray-300 mb-6">
            <div class="flex items-start"><span class="w-20 text-muted">Material:</span> <span><?php echo $material; ?></span></div>
            <div class="flex items-start"><span class="w-20 text-muted">Sizes:</span> <span><?php echo $sizes; ?></span></div>
          </div>

          <div class="flex gap-3 mt-auto">
            <a href="contact?product=<?php echo $link_name; ?>"
              class="flex-1 text-center bg-wood text-black font-medium py-2 rounded hover:bg-white transition-colors hover-lift">Enquire</a>
            <a href="https://wa.me/9373154925?text=Hi, I'm interested in the <?php echo $link_name; ?>" target="_blank"
              class="flex-none w-12 flex items-center justify-center bg-green-600 text-white rounded hover:bg-green-500 transition-colors hover-lift"
              title="Chat on WhatsApp">
              <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
              </svg>
            </a>
          </div>
        </div>
      </article>
      <?php
          }
      } else {
          echo '<div id="no-results" class="bg-wood-dark/40 rounded-xl p-8 text-center text-gray-400 col-span-full">No products found.</div>';
      }
      $conn->close();
      ?>
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

  <div id="footer-container"></div>
  <script src="frontend/js/main.js"></script>
  <script src="frontend/js/animations.js"></script>
  <script>
    // URL Parameter Filtering Logic
    document.addEventListener('DOMContentLoaded', () => {
      const urlParams = new URLSearchParams(window.location.search);
      const category = urlParams.get('category');

      if (category) {
        const items = document.querySelectorAll('.pb-product-item');
        let visibleCount = 0;

        items.forEach(item => {
          if (item.dataset.category === category) {
            item.style.display = 'block';
            visibleCount++;
          } else {
            item.style.display = 'none';
          }
        });

        // Update title
        const title = document.querySelector('h1');
        const catName = category.charAt(0).toUpperCase() + category.slice(1);
        if (title && visibleCount > 0) {
          title.textContent = `${catName} Collection`;
        }

        if (visibleCount === 0) {
          document.getElementById('no-results').classList.remove('hidden');
        }
      }
    });
  </script>
  <script src="frontend/js/product-modal.js"></script>

  <!-- Quick View Modal -->
  <div id="quick-view-modal" class="hidden fixed inset-0 z-50 flex items-center justify-center">
    <div class="modal-backdrop absolute inset-0 bg-black/80 backdrop-blur-sm opacity-0 transition-opacity duration-300">
    </div>

    <div
      class="modal-content relative bg-[#1a120b] border border-[#7b4f2a]/30 w-full max-w-4xl mx-4 md:mx-0 rounded-2xl shadow-2xl overflow-hidden transform scale-95 opacity-0 transition-all duration-300 flex flex-col md:flex-row max-h-[90vh]">

      <!-- Close Button -->
      <button id="modal-close-btn"
        class="absolute top-4 right-4 z-20 bg-black/50 hover:bg-[#7b4f2a] text-white p-2 rounded-full transition-colors">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>

      <!-- Image Section -->
      <div class="w-full md:w-1/2 h-64 md:h-auto relative bg-black">
        <img id="modal-img" src="" alt="Product Detail" class="w-full h-full object-cover">
        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
      </div>

      <!-- Details Section -->
      <div class="w-full md:w-1/2 p-6 md:p-10 flex flex-col overflow-y-auto">
        <h2 id="modal-title" class="text-2xl md:text-3xl font-bold text-white mb-2"></h2>
        <p id="modal-price" class="text-xl text-[#7b4f2a] font-semibold mb-6"></p>

        <p id="modal-desc" class="text-gray-300 text-sm leading-relaxed mb-6"></p>

        <div class="space-y-4 mb-8">
          <div class="flex border-b border-gray-800 pb-2">
            <span class="text-gray-500 w-24">Materials</span>
            <span id="modal-materials" class="text-gray-200"></span>
          </div>
          <div class="flex border-b border-gray-800 pb-2">
            <span class="text-gray-500 w-24">Sizes</span>
            <span id="modal-sizes" class="text-gray-200"></span>
          </div>
        </div>

        <div class="mt-auto pt-6 flex flex-col gap-3">
          <a href="contact.php#quote"
            class="w-full bg-[#7b4f2a] text-black font-bold py-3 rounded text-center hover:bg-white transition-colors">Request
            Detailed Quote</a>

          <a id="modal-wa-link" href="#" target="_blank"
            class="w-full border border-[#25D366] text-[#25D366] font-bold py-3 rounded text-center hover:bg-[#25D366] hover:text-white transition-colors flex items-center justify-center gap-2">
            <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
              <path
                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
            </svg>
            Chat on WhatsApp
          </a>
        </div>
      </div>
    </div>
  </div>
</body>

</html>