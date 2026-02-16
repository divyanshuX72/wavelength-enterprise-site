<?php
require_once 'config/db_connection.php';

// Seed Products
$products = [
    [
        'name' => 'TV Unit — Classic',
        'category' => 'tv',
        'price_start' => '35,000',
        'material' => 'Solid Teak / Oak Veneer',
        'sizes' => '1.5m, 1.8m, 2.2m (Custom)',
        'image_path' => 'frontend/images/ai_tv_unit_1770204842451.png'
    ],
    [
        'name' => 'Platform Bed — Zen',
        'category' => 'beds',
        'price_start' => '28,000',
        'material' => 'Walnut / Maple',
        'sizes' => 'Queen, King, California King',
        'image_path' => 'frontend/images/ai_bed_modern_1770204864113.png'
    ],
    [
        'name' => 'Wardrobe — Signature',
        'category' => 'wardrobes',
        'price_start' => '18,000/meter',
        'material' => 'HDF / Plywood',
        'sizes' => 'Custom Floor-to-Ceiling',
        'image_path' => 'frontend/images/ai_wardrobe_sleek_1770204884623.png'
    ]
];

foreach ($products as $product) {
    $name = $conn->real_escape_string($product['name']);
    $check = $conn->query("SELECT id FROM products WHERE name = '$name'");
    if ($check->num_rows == 0) {
        $category = $conn->real_escape_string($product['category']);
        $price = $conn->real_escape_string($product['price_start']);
        $material = $conn->real_escape_string($product['material']);
        $sizes = $conn->real_escape_string($product['sizes']);
        $image = $conn->real_escape_string($product['image_path']);

        $sql = "INSERT INTO products (name, category, price_start, material, sizes, image_path) 
                VALUES ('$name', '$category', '$price', '$material', '$sizes', '$image')";
        if ($conn->query($sql) === TRUE) {
            echo "Inserted product: $name\n";
        } else {
            echo "Error inserting product $name: " . $conn->error . "\n";
        }
    } else {
        echo "Product $name already exists.\n";
    }
}

// Seed Services
$services = [
    [
        'title' => 'Custom TV Units',
        'description' => 'Floating, wall-mounted, or floor-standing units designed to fit your electronics and space perfectly.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>'
    ],
    [
        'title' => 'Bespoke Beds',
        'description' => 'From platform beds to storage beds, we create comfortable and stylish sleeping solutions.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14a2 2 0 012 2v1H3v-1a2 2 0 012-2zm12-9.75c0 .41.336.75.75.75h.75A1.5 1.5 0 0120 12.5V19H4v-6.5a1.5 1.5 0 011.5-1.5h.75c.414 0 .75-.34.75-.75V8a2 2 0 012-2h6a2 2 0 012 2v2.25z" /></svg>'
    ],
    [
        'title' => 'Wardrobes & Storage',
        'description' => 'Maximize your storage with custom walk-in closets, sliding wardrobes, and loft units.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>'
    ],
    [
        'title' => 'Modular Interiors',
        'description' => 'Complete interior solutions including modular kitchens, office setups, and wall paneling.',
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>'
    ]
];

foreach ($services as $service) {
    $title = $conn->real_escape_string($service['title']);
    $check = $conn->query("SELECT id FROM services WHERE title = '$title'");
    if ($check->num_rows == 0) {
        $desc = $conn->real_escape_string($service['description']);
        $icon = $conn->real_escape_string($service['icon']);

        $sql = "INSERT INTO services (title, description, icon) VALUES ('$title', '$desc', '$icon')";
        if ($conn->query($sql) === TRUE) {
            echo "Inserted service: $title\n";
        } else {
            echo "Error inserting service $title: " . $conn->error . "\n";
        }
    } else {
        echo "Service $title already exists.\n";
    }
}

echo "Seeding completed.\n";
$conn->close();
