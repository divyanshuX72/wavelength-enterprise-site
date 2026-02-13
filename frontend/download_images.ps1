$images = @{
    "tv-unit-modern.jpg"   = "https://images.unsplash.com/photo-1600585154732-83c8461c2e4b?q=80&w=1200&fit=crop";
    "about-hero.jpg"       = "https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200&fit=crop";
    "carpenter-work.jpg"   = "https://images.unsplash.com/photo-1581091226825-a6a2a5aee158?q=80&w=1200&fit=crop";
    "bed-modern.jpg"       = "https://images.unsplash.com/photo-1560448204-e02f11c3d0e2?q=80&w=1200&fit=crop";
    "wardrobe-classic.jpg" = "https://images.unsplash.com/photo-1540574163026-643ea20ade25?q=80&w=1200&fit=crop";
    "tv-unit-wall.jpg"     = "https://images.unsplash.com/photo-1598300050874-2a6db9f9b6a6?q=80&w=1200&fit=crop";
    "bed-canopy.jpg"       = "https://images.unsplash.com/photo-1505693416388-b0346efee958?q=80&w=1200&fit=crop";
    "wardrobe-walkin.jpg"  = "https://images.unsplash.com/photo-1558997519-83ea9252edf8?q=80&w=1200&fit=crop";
    "wardrobe-builtin.jpg" = "https://images.unsplash.com/photo-1595428774223-ef52624120d2?q=80&w=1200&fit=crop";
    "custom-study.jpg"     = "https://images.unsplash.com/photo-1600210491892-03d54c0aaf87?q=80&w=1200&fit=crop";
    "custom-console.jpg"   = "https://images.unsplash.com/photo-1615873968403-89e061852336?q=80&w=1200&fit=crop";
    "kitchen-modular.jpg"  = "https://images.unsplash.com/photo-1556911220-e8dbce8c74e8?q=80&w=1200&fit=crop";
    "living-room-1.jpg"    = "https://images.unsplash.com/photo-1616486338812-3dadae4b4f9d?q=80&w=1200&fit=crop";
    "bedroom-1.jpg"        = "https://images.unsplash.com/photo-1513694203232-719a280e022f?q=80&w=1200&fit=crop";
    "dining-1.jpg"         = "https://images.unsplash.com/photo-1603370419735-cc0b1f99b4b6?q=80&w=1200&fit=crop";
    "sofa-1.jpg"           = "https://images.unsplash.com/photo-1567016432779-9b2d1c4a5d20?q=80&w=1200&fit=crop";
    "office-1.jpg"         = "https://images.unsplash.com/photo-1542314831-068cd1dbfeeb?q=80&w=1200&fit=crop";
    "armchair-1.jpg"       = "https://images.unsplash.com/photo-1524758631624-e2822e304c36?q=80&w=1200&fit=crop";
    "furniture-mix-1.jpg"  = "https://images.unsplash.com/photo-1549187774-b4e9b0445b61?q=80&w=1200&fit=crop";
    "furniture-mix-2.jpg"  = "https://images.unsplash.com/photo-1598300050827-5d8c2d9a4a0b?q=80&w=1200&fit=crop";
    "furniture-mix-3.jpg"  = "https://images.unsplash.com/photo-1600585154702-9e8f0b0e9b8a?q=80&w=1200&fit=crop";
    "furniture-mix-4.jpg"  = "https://images.unsplash.com/photo-1582582494704-1f6d8d7aa0a0?q=80&w=1200&fit=crop";
    "mat-plywood.jpg"      = "https://images.unsplash.com/photo-1525909002-1b05e0c869d8?q=80&w=400&fit=crop";
    "mat-teak.jpg"         = "https://images.unsplash.com/photo-1543440738-42f0739c9082?q=80&w=400&fit=crop";
    "avatar-1.jpg"         = "https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=200&fit=crop";
    "avatar-2.jpg"         = "https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=200&fit=crop";
    "avatar-3.jpg"         = "https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=200&fit=crop";
    "avatar-4.jpg"         = "https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=200&fit=crop";
}

foreach ($name in $images.Keys) {
    $url = $images[$name]
    $output = "assets\images\$name"
    Write-Host "Downloading $name..."
    try {
        Invoke-WebRequest -Uri $url -OutFile $output
    }
    catch {
        Write-Host "Failed to download $name"
    }
}
