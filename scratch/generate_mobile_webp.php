<?php
$heroDir = __DIR__ . '/../public/assets/img/hero-carousel/';

$slides = ['slide-1.webp', 'slide-2.webp', 'slide-3.webp'];

foreach ($slides as $slide) {
    $srcPath = $heroDir . $slide;
    $destPath = $heroDir . str_replace('.webp', '-mobile.webp', $slide);

    if (file_exists($srcPath)) {
        $img = imagecreatefromwebp($srcPath);
        if ($img) {
            $origW = imagesx($img);
            $origH = imagesy($img);

            $targetW = 640;
            $targetH = round(($origH / $origW) * $targetW);

            $resized = imagecreatetruecolor($targetW, $targetH);
            imagecopyresampled($resized, $img, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);

            imagewebp($resized, $destPath, 78);
            imagedestroy($img);
            imagedestroy($resized);

            $srcSize = round(filesize($srcPath) / 1024, 1);
            $destSize = round(filesize($destPath) / 1024, 1);
            echo "Created {$slide} mobile: {$srcSize} KB -> {$destSize} KB\n";
        }
    }
}
