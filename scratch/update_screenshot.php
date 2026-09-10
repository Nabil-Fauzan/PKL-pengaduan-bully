<?php

$src = __DIR__ . '/../public/assets/img/showcase/dashboard-preview.png';
$dst = __DIR__ . '/../public/assets/img/showcase/dashboard-preview.webp';

if (!file_exists($src)) {
    die("File not found: $src\n");
}

$info = getimagesize($src);
$mime = $info['mime'];

if ($mime === 'image/png') {
    $im = imagecreatefrompng($src);
    imagepalettetotruecolor($im);
    imagealphablending($im, true);
    imagesavealpha($im, true);
} elseif ($mime === 'image/jpeg') {
    $im = imagecreatefromjpeg($src);
} else {
    $im = imagecreatefromstring(file_get_contents($src));
}

imagewebp($im, $dst, 88);
imagedestroy($im);

echo "Success! Converted " . round(filesize($src) / 1024) . " KB PNG -> " . round(filesize($dst) / 1024) . " KB WebP.\n";
