<?php
$conn = new mysqli('localhost', 'root', '', 'wavelength_v2');

$svg1 = $conn->real_escape_string('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>');
$svg2 = $conn->real_escape_string('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h14a2 2 0 012 2v1H3v-1a2 2 0 012-2zm12-9.75c0 .41.336.75.75.75h.75A1.5 1.5 0 0120 12.5V19H4v-6.5a1.5 1.5 0 011.5-1.5h.75c.414 0 .75-.34.75-.75V8a2 2 0 012-2h6a2 2 0 012 2v2.25z" /></svg>');
$svg3 = $conn->real_escape_string('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" /></svg>');
$svg4 = $conn->real_escape_string('<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>');

$conn->query("UPDATE services SET icon_svg = '$svg1' WHERE id = 1");
$conn->query("UPDATE services SET icon_svg = '$svg2' WHERE id = 2");
$conn->query("UPDATE services SET icon_svg = '$svg3' WHERE id = 3");
$conn->query("UPDATE services SET icon_svg = '$svg4' WHERE id = 4");

echo "Icons inserted.\n";
