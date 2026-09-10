<?php

$fonts = [
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-solid-900.woff2' => __DIR__ . '/../public/assets/vendor/webfonts/fa-solid-900.woff2',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-regular-400.woff2' => __DIR__ . '/../public/assets/vendor/webfonts/fa-regular-400.woff2',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/webfonts/fa-brands-400.woff2' => __DIR__ . '/../public/assets/vendor/webfonts/fa-brands-400.woff2',
];

foreach ($fonts as $url => $dest) {
    echo "Downloading $url -> " . basename($dest) . "... ";
    $content = @file_get_contents($url);
    if ($content !== false) {
        file_put_contents($dest, $content);
        echo "OK (" . round(strlen($content) / 1024) . " KB)\n";
    } else {
        echo "FAILED\n";
    }
}
