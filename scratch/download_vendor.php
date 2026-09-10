<?php

$downloads = [
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' => __DIR__ . '/../public/assets/vendor/bootstrap/bootstrap.min.css',
    'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js' => __DIR__ . '/../public/assets/vendor/bootstrap/bootstrap.bundle.min.js',
    'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css' => __DIR__ . '/../public/assets/vendor/aos/aos.css',
    'https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js' => __DIR__ . '/../public/assets/vendor/aos/aos.js',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css' => __DIR__ . '/../public/assets/vendor/fontawesome/all.min.css',
];

foreach ($downloads as $url => $dest) {
    echo "Downloading $url -> " . basename($dest) . "... ";
    $content = @file_get_contents($url);
    if ($content !== false) {
        file_put_contents($dest, $content);
        echo "OK (" . round(strlen($content) / 1024) . " KB)\n";
    } else {
        echo "FAILED\n";
    }
}
