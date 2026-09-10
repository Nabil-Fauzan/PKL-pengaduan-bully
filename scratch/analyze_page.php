<?php
require_once __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$view = view('welcome')->render();

// Check for missing aria-labels, buttons with no text, inputs without label, images without alt, etc.
$dom = new DOMDocument();
@$dom->loadHTML($view);

$buttons = $dom->getElementsByTagName('button');
echo "=== CHECKING BUTTONS (" . count($buttons) . ") ===\n";
foreach ($buttons as $btn) {
    $text = trim($btn->textContent);
    $aria = $btn->getAttribute('aria-label');
    $title = $btn->getAttribute('title');
    $type = $btn->getAttribute('type');
    $class = $btn->getAttribute('class');
    if (empty($text) && empty($aria)) {
        echo "[FAIL] Button without text or aria-label: class='{$class}', type='{$type}'\n";
    }
}

$links = $dom->getElementsByTagName('a');
echo "=== CHECKING LINKS (" . count($links) . ") ===\n";
foreach ($links as $a) {
    $text = trim($a->textContent);
    $aria = $a->getAttribute('aria-label');
    $title = $a->getAttribute('title');
    $href = $a->getAttribute('href');
    $class = $a->getAttribute('class');
    if (empty($text) && empty($aria) && empty($title)) {
        echo "[FAIL] Link without text or aria-label: href='{$href}', class='{$class}'\n";
    }
}

$inputs = $dom->getElementsByTagName('input');
echo "=== CHECKING INPUTS (" . count($inputs) . ") ===\n";
foreach ($inputs as $input) {
    $id = $input->getAttribute('id');
    $aria = $input->getAttribute('aria-label');
    $ariaLabeledBy = $input->getAttribute('aria-labelledby');
    $placeholder = $input->getAttribute('placeholder');
    $type = $input->getAttribute('type');
    if (empty($aria) && empty($ariaLabeledBy)) {
        echo "[WARN] Input without aria-label: id='{$id}', type='{$type}', placeholder='{$placeholder}'\n";
    }
}

$images = $dom->getElementsByTagName('img');
echo "=== CHECKING IMAGES (" . count($images) . ") ===\n";
foreach ($images as $img) {
    $alt = $img->getAttribute('alt');
    $src = $img->getAttribute('src');
    if (empty($alt)) {
        echo "[FAIL] Image without alt: src='{$src}'\n";
    }
}

echo "=== CHECKING HEADING HIERARCHY ===\n";
for ($i = 1; $i <= 6; $i++) {
    $h = $dom->getElementsByTagName("h{$i}");
    echo "H{$i}: " . count($h) . " elements\n";
}

echo "DONE.\n";
