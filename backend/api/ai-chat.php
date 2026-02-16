<?php

/**
 * AI Chat API Endpoint
 * Connects to Google Gemini API with product data from MySQL
 * Supports multi-language, spelling tolerance, and product recommendations
 */

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['error' => 'Method not allowed']);
    http_response_code(405);
    exit;
}

// Load environment & database
require_once __DIR__ . '/../config/db_connection.php';

// Load .env for API key
if (file_exists(__DIR__ . '/../../.env')) {
    $lines = file(__DIR__ . '/../../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        if (strpos($line, '=') === false) continue;
        list($name, $value) = explode('=', $line, 2);
        $_ENV[trim($name)] = trim($value);
    }
}

$apiKey = $_ENV['GEMINI_API_KEY'] ?? '';
if (empty($apiKey) || $apiKey === 'your_gemini_api_key_here') {
    echo json_encode(['error' => 'Gemini API key not configured. Please add your key to .env file.']);
    http_response_code(500);
    exit;
}

// Get request body
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';
$conversationHistory = $input['history'] ?? [];
$language = $input['language'] ?? 'auto';

if (empty($userMessage)) {
    echo json_encode(['error' => 'Message is required']);
    http_response_code(400);
    exit;
}

// ============================================
// 1. Load products from database (auto-update)
// ============================================
$products = [];
$result = $conn->query("SELECT * FROM products ORDER BY category, name");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
}

// Load services
$services = [];
$result = $conn->query("SELECT id, title, description FROM services ORDER BY id");
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

// ============================================
// 2. Build comprehensive system prompt
// ============================================
$productCatalog = "";
foreach ($products as $p) {
    $productCatalog .= "- ID:{$p['id']} | Name: {$p['name']} | Category: {$p['category']} | Price: ₹{$p['price_start']} | Material: {$p['material']} | Sizes: {$p['sizes']} | Image: {$p['image_path']}\n";
}

$serviceList = "";
foreach ($services as $s) {
    $serviceList .= "- {$s['title']}: {$s['description']}\n";
}

$systemPrompt = <<<PROMPT
You are the AI Interior Design & Furniture Assistant for **Wavelength Enterprises**, a premium custom furniture manufacturer based in Pelhar Rd, Wakanpada, Nalasopara East, Maharashtra 401208, India. Phone: +91 93731 54925.

## YOUR ROLE
You are an expert interior designer and furniture consultant. You help customers:
- Choose the right furniture for their space
- Recommend products with prices and details
- Provide interior design tips and suggestions
- Answer questions about materials, sizes, finishes
- Guide them to get a custom quote or schedule a visit

## PRODUCT CATALOG (LIVE FROM DATABASE — always use these current prices):
{$productCatalog}

## SERVICES OFFERED:
{$serviceList}

## ADDITIONAL KNOWLEDGE — Interior Design & Furniture:
- **TV Units**: Wall-mounted saves floor space. Width should be 10-20% wider than TV. Cable management is essential. Popular finishes: Walnut, Oak, White Matte.
- **Beds**: Queen (60"×78") for couples, King (72"×78") for luxury. Platform beds are trendy. Storage beds are space-efficient. Headboard adds elegance.
- **Wardrobes**: Sliding doors save space. Walk-in for luxury rooms. Internal organizers: shelves, drawers, hanging rods, shoe racks. Mirror panels add space illusion.
- **Modular Kitchen**: L-shaped for corners, U-shaped for large kitchens, Island for open layouts. Materials: Marine plywood for base, MDF for shutters. Countertops: Granite, Quartz, Corian.
- **Office Furniture**: Ergonomic height 28-30 inches. L-shaped desks maximize space. Cable management trays essential. Good lighting reduces eye strain.
- **Materials**: Solid Teak (most durable, premium), Walnut (rich dark tone), Plywood (cost-effective), MDF (smooth finish), HDF (moisture resistant), Particleboard (budget).
- **Finishes**: Laminate (budget-friendly, variety), Veneer (natural wood look), Lacquer/PU (high-end gloss), Acrylic (ultra-modern gloss), Membrane (3D shapes).

## RESPONSE FORMAT
You MUST respond in valid JSON with this exact structure:
{
  "text": "Your conversational response text here. Use HTML formatting like <br>, <strong>, <em> for readability.",
  "products": [
    {
      "id": 1,
      "name": "Product Name",
      "price": "₹35,000",
      "material": "Solid Teak",
      "image": "frontend/images/filename.png",
      "category": "tv"
    }
  ],
  "quickActions": [
    {"label": "Get Quote", "action": "quote"},
    {"label": "WhatsApp Us", "action": "whatsapp"}
  ],
  "language": "detected language code like en, hi, mr, ta, te, bn, gu, kn, ml, pa"
}

## RULES:
1. **LANGUAGE**: Detect the user's language automatically and ALWAYS reply in the SAME language. Support: English, Hindi (हिंदी), Marathi (मराठी), Tamil (தமிழ்), Telugu (తెలుగు), Bengali (বাংলা), Gujarati (ગુજરાતી), Kannada (ಕನ್ನಡ), Malayalam (മലയാളം), Punjabi (ਪੰਜਾਬੀ). If they write in Hinglish (mixed Hindi-English), reply in Hinglish.
2. **SPELLING MISTAKES**: Users may type incorrectly. Examples: "ty" = TV, "bed" = bed, "almari" = wardrobe, "rasoi" = kitchen, "dikao" = show me, "kitna" = how much, "chahiye" = want. ALWAYS understand the intent and respond helpfully.
3. **PRODUCTS**: When recommending products, ONLY include products from the catalog above. Include the correct image path. If no exact match, suggest the closest relevant products.
4. **PRICING**: Always use the EXACT prices from the catalog. Never make up prices. Say "starting from ₹X" since these are starting prices.
5. **ACTIONS**: Include "Get Quote" action when discussing specific products. Include "WhatsApp Us" for urgent queries or custom requests.
6. **TONE**: Be friendly, professional, and helpful. Use emojis sparingly (1-2 per message). Keep responses concise but informative.
7. **NO HALLUCINATION**: Do not invent products, prices, or details not in the catalog. If unsure, suggest contacting the team.
8. **ALWAYS reply in valid JSON format as specified above. Never reply in plain text.**
PROMPT;

// ============================================
// 3. Build conversation for Gemini API
// ============================================
$contents = [];

// Add conversation history (last 10 messages for context)
$historySlice = array_slice($conversationHistory, -10);
foreach ($historySlice as $msg) {
    $role = ($msg['role'] === 'user') ? 'user' : 'model';
    $contents[] = [
        'role' => $role,
        'parts' => [['text' => $msg['text']]]
    ];
}

// Add current user message
$contents[] = [
    'role' => 'user',
    'parts' => [['text' => $userMessage]]
];

// ============================================
// 4. Call Google Gemini API (with model fallback)
// ============================================
$models = [
    ['name' => 'gemini-2.0-flash', 'api' => 'v1beta'],
    ['name' => 'gemini-2.0-flash-lite', 'api' => 'v1beta'],
    ['name' => 'gemini-1.5-flash', 'api' => 'v1beta'],
    ['name' => 'gemini-1.5-flash-latest', 'api' => 'v1beta'],
    ['name' => 'gemini-1.0-pro', 'api' => 'v1beta'],
    ['name' => 'gemini-pro', 'api' => 'v1']
];

$errors = [];

foreach ($models as $modelInfo) {
    $api = $modelInfo['api'];
    $modelName = $modelInfo['name'];
    $geminiUrl = "https://generativelanguage.googleapis.com/{$api}/models/{$modelName}:generateContent?key={$apiKey}";

    // Base request body
    $currentRequestBody = [
        'contents' => $contents,
        'generationConfig' => [
            'temperature' => 0.7,
            'topP' => 0.9,
            'topK' => 40,
            'maxOutputTokens' => 1024
        ]
    ];

    // API-specific adjustments
    if ($api === 'v1beta') {
        // v1beta supports system_instruction and responseMimeType
        $currentRequestBody['system_instruction'] = [
            'parts' => [['text' => $systemPrompt]]
        ];
        $currentRequestBody['generationConfig']['responseMimeType'] = 'application/json';
    } else {
        // v1: Move system prompt to the beginning of the conversation
        // Prepend system prompt to the first message's text
        $v1Contents = $contents;

        // Ensure we have content to prepend to
        if (empty($v1Contents)) {
            $v1Contents[] = [
                'role' => 'user',
                'parts' => [['text' => ""]]
            ];
        }

        // Find the first part of the first message
        if (isset($v1Contents[0]['parts'][0]['text'])) {
            $originalText = $v1Contents[0]['parts'][0]['text'];
            $v1Contents[0]['parts'][0]['text'] = "SYSTEM INSTRUCTION:\n{$systemPrompt}\n\nUSER MESSAGE:\n{$originalText}";
        }

        $currentRequestBody['contents'] = $v1Contents;
    }

    $ch = curl_init($geminiUrl);
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_POSTFIELDS => json_encode($currentRequestBody),
        CURLOPT_TIMEOUT => 30,
        CURLOPT_SSL_VERIFYPEER => false
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // If success, stop trying
    if ($httpCode === 200) {
        break;
    }

    // Collect error
    $errResp = json_decode($response, true);
    $errMsg = $errResp['error']['message'] ?? $curlError ?? 'Unknown error';
    $errors[] = "Model {$modelName} ({$api}): HTTP {$httpCode} - {$errMsg}";
}

if ($httpCode !== 200) {
    // Check if any error was a 429 (Quota Exceeded)
    $isQuotaError = false;
    foreach ($errors as $err) {
        if (strpos($err, 'HTTP 429') !== false) {
            $isQuotaError = true;
            break;
        }
    }

    if ($isQuotaError) {
        echo json_encode([
            'error' => 'AI service is currently busy (Quota Exceeded). Please try again in a few moments.',
            'details' => $errors
        ]);
        http_response_code(429);
    } else {
        echo json_encode([
            'error' => 'All AI models failed to respond. Please check API key/configuration.',
            'details' => $errors
        ]);
        http_response_code(500);
    }
    exit;
}

// ============================================
// 5. Parse and return response
// ============================================
$geminiResponse = json_decode($response, true);
$aiText = $geminiResponse['candidates'][0]['content']['parts'][0]['text'] ?? '';

// Try to parse the AI's JSON response
$aiData = json_decode($aiText, true);

if ($aiData && isset($aiData['text'])) {
    // Successfully parsed structured response
    echo json_encode([
        'success' => true,
        'text' => $aiData['text'],
        'products' => $aiData['products'] ?? [],
        'quickActions' => $aiData['quickActions'] ?? [],
        'language' => $aiData['language'] ?? 'en'
    ], JSON_UNESCAPED_UNICODE);
} else {
    // Fallback: return raw text if JSON parsing fails
    echo json_encode([
        'success' => true,
        'text' => $aiText ?: 'I apologize, I could not process your request. Please try again.',
        'products' => [],
        'quickActions' => [
            ['label' => 'Get Quote', 'action' => 'quote'],
            ['label' => 'WhatsApp Us', 'action' => 'whatsapp']
        ],
        'language' => 'en'
    ], JSON_UNESCAPED_UNICODE);
}
