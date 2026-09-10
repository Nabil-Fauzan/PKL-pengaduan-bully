<?php

$files = [
    __DIR__ . '/../public/assets/img/hero-carousel/slide-1.png',
    __DIR__ . '/../public/assets/img/hero-carousel/slide-2.png',
    __DIR__ . '/../public/assets/img/hero-carousel/slide-3.png',
    __DIR__ . '/../public/assets/img/kepsek.jpg'
];

foreach ($files as $f) {
    if (!file_exists($f)) {
        echo "Not found: $f\n";
        continue;
    }
    $ext = strtolower(pathinfo($f, PATHINFO_EXTENSION));
    if ($ext === 'png') {
        $im = imagecreatefrompng($f);
        imagepalettetotruecolor($im);
        imagealphablending($im, true);
        imagesavealpha($im, true);
    } else {
        $im = imagecreatefromjpeg($f);
    }
    $target = preg_replace('/\.(png|jpg)$/i', '.webp', $f);
    imagewebp($im, $target, 82);
    imagedestroy($im);
    echo basename($f) . ' (' . round(filesize($f)/1024) . 'KB) -> ' . basename($target) . ' (' . round(filesize($target)/1024) . 'KB)' . PHP_EOL;
}
