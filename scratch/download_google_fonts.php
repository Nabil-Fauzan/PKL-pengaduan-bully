<?php

$url = 'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@600;700;800&family=Poppins:wght@400;500;600;700&display=swap';
$opts = [
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36\r\n"
    ]
];
$context = stream_context_create($opts);
$css = file_get_contents($url, false, $context);

if (!$css) {
    echo "Failed to fetch CSS\n";
    exit(1);
}

@mkdir(__DIR__ . '/../public/assets/vendor/fonts', 0777, true);

preg_match_all('/url\((https:\/\/[^)]+)\)/', $css, $matches);
$urls = array_unique($matches[1]);

echo "Found " . count($urls) . " font files.\n";

$localCss = $css;

foreach ($urls as $i => $fontUrl) {
    $ext = pathinfo(parse_url($fontUrl, PHP_URL_PATH), PATHINFO_EXTENSION);
    $filename = "font-$i.$ext";
    $dest = __DIR__ . '/../public/assets/vendor/fonts/' . $filename;
    
    echo "Downloading $fontUrl -> $filename... ";
    $fontData = file_get_contents($fontUrl);
    if ($fontData) {
        file_put_contents($dest, $fontData);
        echo "OK (" . round(strlen($fontData) / 1024) . " KB)\n";
        $localCss = str_replace($fontUrl, "../vendor/fonts/" . $filename, $localCss);
    } else {
        echo "FAILED\n";
    }
}

file_put_contents(__DIR__ . '/../public/assets/css/fonts.css', $localCss);
echo "Saved local fonts.css successfully!\n";
