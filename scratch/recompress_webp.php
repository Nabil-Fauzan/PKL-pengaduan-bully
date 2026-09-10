<?php

$files = [
    __DIR__ . '/../public/assets/img/hero-carousel/slide-1.png' => __DIR__ . '/../public/assets/img/hero-carousel/slide-1.webp',
    __DIR__ . '/../public/assets/img/hero-carousel/slide-2.png' => __DIR__ . '/../public/assets/img/hero-carousel/slide-2.webp',
    __DIR__ . '/../public/assets/img/hero-carousel/slide-3.png' => __DIR__ . '/../public/assets/img/hero-carousel/slide-3.webp',
    __DIR__ . '/../public/assets/img/showcase/dashboard-preview.png' => __DIR__ . '/../public/assets/img/showcase/dashboard-preview.webp',
];

foreach ($files as $png => $webp) {
    if (file_exists($png)) {
        $img = imagecreatefrompng($png);
        imagepalettetotruecolor($img);
        imagealphablending($img, true);
        imagesavealpha($img, true);
        
        // Save with 80 quality for crisp visuals + tiny file size
        imagewebp($img, $webp, 80);
        imagedestroy($img);
        
        echo basename($webp) . " size: " . round(filesize($webp) / 1024) . " KB\n";
    }
}
