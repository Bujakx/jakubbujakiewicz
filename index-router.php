<?php
// Router for frontend + WordPress
$request_uri = $_SERVER['REQUEST_URI'];

// If requesting shop, blog, or product - load WordPress
if (preg_match('#^/(sklep|blog|produkt|koszyk|zamowienie|moje-konto)#', $request_uri)) {
    define('WP_USE_THEMES', true);
    require(__DIR__ . '/autoinstalator/wordpressplugins1/index.php');
    exit;
}

// Otherwise show frontend
if ($request_uri === '/' || $request_uri === '/index.php') {
    require(__DIR__ . '/main.html');
    exit;
}

// For other frontend pages
if (file_exists(__DIR__ . $request_uri)) {
    return false; // Let server handle it
}

// 404
http_response_code(404);
require(__DIR__ . '/main.html');
?>
