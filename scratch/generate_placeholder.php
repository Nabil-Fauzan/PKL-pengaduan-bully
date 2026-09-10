<?php

$width = 900;
$height = 560;
$im = imagecreatetruecolor($width, $height);

// Gradient background
$bg_top = imagecolorallocate($im, 241, 245, 249); // #f1f5f9
$bg_bottom = imagecolorallocate($im, 226, 232, 240); // #e2e8f0
imagefilledrectangle($im, 0, 0, $width, $height, $bg_top);

// App mockup simulated header
$blue = imagecolorallocate($im, 37, 99, 235);
$dark = imagecolorallocate($im, 15, 23, 42);
$gray = imagecolorallocate($im, 100, 116, 139);
$white = imagecolorallocate($im, 255, 255, 255);
$green = imagecolorallocate($im, 16, 185, 129);
$yellow = imagecolorallocate($im, 245, 158, 11);

// Top navbar in mockup
imagefilledrectangle($im, 0, 0, $width, 50, $white);
imagefilledellipse($im, 35, 25, 24, 24, $blue);

// 3 Metric Cards
imagefilledrectangle($im, 30, 80, 290, 190, $white);
imagefilledrectangle($im, 310, 80, 580, 190, $white);
imagefilledrectangle($im, 600, 80, 870, 190, $white);

// Big table card
imagefilledrectangle($im, 30, 220, 870, 520, $white);

// Save PNG and WebP
imagepng($im, __DIR__ . '/../public/assets/img/showcase/dashboard-preview.png');
imagewebp($im, __DIR__ . '/../public/assets/img/showcase/dashboard-preview.webp', 85);
imagedestroy($im);

echo "Placeholder dashboard preview generated successfully.\n";
