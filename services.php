<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Services & Measurement Guide — Wavelength Enterprises</title>

  <!-- Google Fonts: Outfit -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="frontend/css/tailwind.css">
  <link rel="stylesheet" href="frontend/css/style.css">
  <link rel="stylesheet" href="frontend/css/responsive.css">

  <link rel="stylesheet" href="frontend/css/tailwind.css">
  <link rel="stylesheet" href="frontend/css/dropdown.css">
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

  <main class="max-w-6xl mx-auto px-4 sm:px-6 pt-10 pb-0">
    <div class="text-center mb-16">
      <h1 class="text-4xl font-bold mb-4">Our Services</h1>
      <p class="text-muted text-lg max-w-2xl mx-auto">We specialize in crafting premium custom furniture and modular
        interiors tailored to your lifestyle.</p>
    </div>

    <!-- Services Grid -->
    <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-20">
      <?php
      require_once 'backend/config/db_connection.php';

      $sql = "SELECT * FROM services ORDER BY id ASC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        $delay = 100;
        while ($row = $result->fetch_assoc()) {
          $title = htmlspecialchars($row["title"] ?? '');
          $desc = htmlspecialchars($row["short_description"] ?? '');
          // Icon is stored as SVG string, so we echo it directly (be careful if user input allowed, but here it's admin/seeded)
          $icon = $row["icon_svg"] ?? '';
      ?>
          <div
            class="bg-white/5 border border-white/10 p-6 rounded-xl hover:bg-white/10 transition-colors group reveal fade-up delay-<?php echo $delay; ?> hover-lift">
            <div
              class="w-12 h-12 bg-wood/20 rounded-full flex items-center justify-center mb-4 text-wood group-hover:bg-wood group-hover:text-black transition-all duration-300 group-hover:scale-110">
              <?php echo $icon; ?>
            </div>
            <h3 class="text-xl font-semibold mb-2"><?php echo $title; ?></h3>
            <p class="text-gray-400 text-sm"><?php echo $desc; ?></p>
          </div>
      <?php
          $delay += 100;
        }
      } else {
        echo '<div class="col-span-full text-center text-gray-400">No services found.</div>';
      }
      $conn->close();
      ?>
    </section>

    <!-- Measurement Guide Section -->
    <section id="guide" class="bg-black/20 rounded-2xl p-8 border border-white/5 shadow-2xl">
      <div class="text-center mb-10">
        <span class="text-wood font-bold tracking-wider uppercase text-sm">Customer Resources</span>
        <h2 class="text-3xl font-bold mt-2">Measurement Guide</h2>
        <p class="text-muted mt-2">Follow these simple steps to ensure your custom furniture fits perfectly.</p>
      </div>

      <div class="space-y-12">

        <!-- 1. Wall Measurement -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-b border-gray-800 pb-12">
          <div
            class="bg-wood-dark p-6 rounded-lg border border-gray-700 relative overflow-hidden h-64 flex items-center justify-center group">
            <!-- Abstract Wall Diagram -->
            <div class="border-2 border-gray-500 w-3/4 h-3/4 absolute"></div>
            <div class="absolute top-[10%] w-3/4 border-t border-dashed border-wood flex justify-center"><span
                class="bg-wood-dark px-1 text-xs text-wood">Width Top</span></div>
            <div class="absolute top-[50%] w-3/4 border-t border-dashed border-wood flex justify-center"><span
                class="bg-wood-dark px-1 text-xs text-wood">Width Middle</span></div>
            <div class="absolute top-[90%] w-3/4 border-t border-dashed border-wood flex justify-center"><span
                class="bg-wood-dark px-1 text-xs text-wood">Width Bottom</span></div>
            <div class="absolute left-[10%] h-3/4 border-l border-dashed border-wood flex items-center"><span
                class="bg-wood-dark py-1 text-xs text-wood -rotate-90">Height</span></div>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-white mb-4">How to Measure a Wall</h3>
            <ul class="space-y-3 text-gray-300">
              <li class="flex items-start gap-3">
                <span
                  class="bg-wood text-black text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full mt-0.5">1</span>
                <span>Measure width at 3 points: <strong>Top, Middle, and Bottom</strong>. Use the smallest
                  measurement.</span>
              </li>
              <li class="flex items-start gap-3">
                <span
                  class="bg-wood text-black text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full mt-0.5">2</span>
                <span>Measure height from <strong>floor to ceiling</strong> (or desired height).</span>
              </li>
              <li class="flex items-start gap-3">
                <span
                  class="bg-wood text-black text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full mt-0.5">3</span>
                <span>Note any obstructions like <strong>switch boards, AC units, or skirting boards</strong>.</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- 2. Bed Size Guide -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center border-b border-gray-800 pb-12">
          <div class="order-2 md:order-1">
            <h3 class="text-2xl font-bold text-white mb-4">Standard Bed Sizes</h3>
            <p class="text-gray-400 mb-4 text-sm">We recommend keeping at least <strong>24 inches</strong> of walking
              space around the bed.</p>
            <div class="overflow-x-auto">
              <table class="w-full text-left bg-black/30 rounded-lg overflow-hidden">
                <thead class="bg-wood text-black">
                  <tr>
                    <th class="p-3 text-sm">Size Name</th>
                    <th class="p-3 text-sm">Dimensions (Inches)</th>
                    <th class="p-3 text-sm">Dimensions (Feet)</th>
                  </tr>
                </thead>
                <tbody class="divide-y divide-gray-700 text-sm">
                  <tr>
                    <td class="p-3 font-medium text-white">King</td>
                    <td class="p-3 text-gray-300">72" x 78"</td>
                    <td class="p-3 text-gray-300">6.0' x 6.5'</td>
                  </tr>
                  <tr>
                    <td class="p-3 font-medium text-white">Queen</td>
                    <td class="p-3 text-gray-300">60" x 78"</td>
                    <td class="p-3 text-gray-300">5.0' x 6.5'</td>
                  </tr>
                  <tr>
                    <td class="p-3 font-medium text-white">Single</td>
                    <td class="p-3 text-gray-300">36" x 78"</td>
                    <td class="p-3 text-gray-300">3.0' x 6.5'</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div
            class="order-1 md:order-2 bg-wood-dark p-6 rounded-lg border border-gray-700 h-64 flex items-center justify-center">
            <div class="border border-gray-500 w-4/5 h-3/5 relative flex items-center justify-center">
              <span class="text-gray-500 font-bold text-2xl">BED</span>
              <div class="absolute -top-6 w-full text-center text-xs text-wood">Width</div>
              <div class="absolute -left-8 h-full flex items-center text-xs text-wood -rotate-90">Length</div>
            </div>
          </div>
        </div>

        <!-- 3. TV Unit Spacing -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div
            class="bg-wood-dark p-6 rounded-lg border border-gray-700 h-64 flex items-center justify-center relative">
            <div class="border-b-4 border-gray-600 w-full absolute bottom-4"></div> <!-- Floor -->
            <div class="bg-black border border-gray-600 w-32 h-20 absolute top-20 rounded"></div> <!-- TV -->
            <div class="absolute top-28 left-1/2 -ml-1 w-2 h-2 bg-red-500 rounded-full"></div> <!-- Eye level -->
            <div class="absolute left-10 h-full border-r border-dashed border-wood top-0 bottom-4"></div>
            <span class="absolute left-12 top-1/2 text-xs text-wood bg-wood-dark p-1">~42 inches</span>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-white mb-4">TV Unit Positioning</h3>
            <ul class="space-y-3 text-gray-300">
              <li class="flex items-start gap-3">
                <span
                  class="bg-wood text-black text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full mt-0.5">✓</span>
                <span><strong>Mounting Height</strong>: The center of your TV screen should be at eye level when seated,
                  typically <strong>42 to 45 inches</strong> from the floor.</span>
              </li>
              <li class="flex items-start gap-3">
                <span
                  class="bg-wood text-black text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full mt-0.5">✓</span>
                <span><strong>Viewing Distance</strong>: Ideal distance is <strong>1.5 to 2.5 times</strong> the
                  diagonal screen size of your TV.</span>
              </li>
            </ul>
          </div>
        </div>

      </div>
    </section>

    <!-- Materials & Finishes Selector -->
    <section id="materials" class="mt-20">
      <div class="text-center mb-10">
        <span class="text-wood font-bold tracking-wider uppercase text-sm">Quality Matters</span>
        <h2 class="text-3xl font-bold mt-2">Materials & Finishes</h2>
        <p class="text-muted mt-2">Tap on a material to learn more about its properties.</p>
      </div>

      <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
        <!-- Plywood -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="High-strength structural wood. Ideal for robust furniture frames and moisture-prone areas like kitchens.">
          <div
            class="h-32 w-full rounded-lg bg-[url('frontend/images/mat-plywood.jpg')] bg-cover bg-center mb-3 group-hover:opacity-80 transition-opacity">
          </div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">BWP Plywood</h3>
            <p class="text-xs text-gray-400 mt-1">Water-proof structural core</p>
          </div>
        </button>

        <!-- MDF -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="Smooth and consistent engineered wood. Perfect for painted finishes and detailed routing work.">
          <div class="h-32 w-full rounded-lg bg-[#bcaaa4] mb-3 group-hover:opacity-80 transition-opacity"></div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">HDHMR / MDF</h3>
            <p class="text-xs text-gray-400 mt-1">Smooth engineered finish</p>
          </div>
        </button>

        <!-- Teak -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="Premium solid wood known for its durability, weather resistance, and beautiful grain patterns.">
          <div
            class="h-32 w-full rounded-lg bg-[url('frontend/images/mat-teak.jpg')] bg-cover bg-center mb-3 group-hover:opacity-80 transition-opacity">
          </div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">Burma Teak</h3>
            <p class="text-xs text-gray-400 mt-1">Premium solid wood</p>
          </div>
        </button>

        <!-- Laminate -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="Durable surface finish available in thousands of colors and textures. Scratch and heat resistant.">
          <div
            class="h-32 w-full rounded-lg bg-gradient-to-br from-gray-700 to-gray-900 mb-3 group-hover:opacity-80 transition-opacity">
          </div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">Laminate</h3>
            <p class="text-xs text-gray-400 mt-1">Durable & decorative</p>
          </div>
        </button>

        <!-- Gloss -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="High-shine reflective surface that makes spaces feel larger and adds a luxurious modern touch.">
          <div
            class="h-32 w-full rounded-lg bg-gradient-to-tr from-gray-800 to-white/20 mb-3 group-hover:opacity-80 transition-opacity relative">
            <div class="absolute inset-0 bg-white/10 skew-x-12 translate-x-1/2 opacity-50"></div> <!-- gloss sheen -->
          </div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">High Gloss</h3>
            <p class="text-xs text-gray-400 mt-1">Modern reflective finish</p>
          </div>
        </button>

        <!-- Matte -->
        <button
          class="material-card bg-wood-dark border border-gray-700 rounded-xl p-1 overflow-hidden group text-left transition-all hover:scale-105 focus:outline-none focus:ring-2 focus:ring-wood"
          data-desc="Soft, non-reflective finish that hides fingerprints and offers a sophisticated, understated look.">
          <div class="h-32 w-full rounded-lg bg-gray-600 mb-3 group-hover:opacity-80 transition-opacity"></div>
          <div class="px-3 pb-3">
            <h3 class="font-semibold text-white">Super Matte</h3>
            <p class="text-xs text-gray-400 mt-1">Soft-touch elegance</p>
          </div>
        </button>
      </div>

      <!-- Description Display -->
      <div id="material-info"
        class="mt-8 bg-wood/10 p-4 rounded-lg border border-wood/20 text-center hidden transition-all">
        <p id="material-text" class="text-lg text-gray-200"></p>
      </div>
    </section>

  </main>

  <?php require_once 'backend/includes/footer.php'; ?>
  <script>
    // Update year for static PHP footer if needed
    const y = document.getElementById('year');
    if (y) y.textContent = new Date().getFullYear();
  </script>
  <script src="frontend/js/main.js"></script>
  <script src="frontend/js/animations.js"></script>
  <script src="frontend/js/dropdown.js"></script>
</body>

</html>