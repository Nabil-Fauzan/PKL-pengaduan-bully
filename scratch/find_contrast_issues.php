<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$view = view('welcome')->render();

// Check for colors in view
preg_match_all('/color:\s*(#[a-fA-F0-9]{3,6}|rgba?\([^)]+\))/i', $view, $matches);
echo "=== INLINE COLORS ===\n";
print_r(array_unique($matches[0]));

preg_match_all('/background(?:-color)?:\s*(#[a-fA-F0-9]{3,6}|rgba?\([^)]+\))/i', $view, $matchesBg);
echo "=== INLINE BACKGROUNDS ===\n";
print_r(array_unique($matchesBg[0]));
