<?php
function image_processing_extension() {
	return extension_loaded('gd');
}
header('Content-Type: image/webp');

$width = 50;
$height = 70;

$image = @imagecreatetruecolor($width, $height);
if (!$image) {
    // Handle image creation failure gracefully
    die('Failed to create image.');
}
$bg_color = imagecolorallocate($image, 94, 91, 150);
$line_color = imagecolorallocate($image, 205, 205, 205);
$text_color = imagecolorallocate($image, 205, 205, 205); // Text color for fallback

imagefill($image, 0, 0, $bg_color);

for ($i = 0; $i < 3; $i++) {
    $x1 = random_int(0, $width);
    $y1 = random_int(0, $height);
    $x2 = random_int(0, $width);
    $y2 = random_int(0, $height);
    imagesetthickness($image, 2);
    imageline($image, $x1, $y1, $x2, $y2, $line_color);
}

for ($i = 0; $i < 2; $i++) {
    $cx = random_int(0, $width);
    $cy = random_int(0, $height);
    $radius = random_int(10, 30);
    imagearc($image, $cx, $cy, $radius * 2, $radius * 2, 0, 360, $line_color);
}

$use_ttf = function_exists('imagettftext');
$font_path = __DIR__ . '/Bakeri.ttf';
$font_size = random_int(14, 25);
$text_to_add = [];
for ($i = 0; $i <= 10; $i++) {
    $text_to_add[] = (string) $i;
}

// if (! has_image_processing_extension() && file_exists( $font_path ) && is_readable( $font_path ) ) {
if ($use_ttf && file_exists( $font_path ) && is_readable( $font_path ) ) {
  // Use TrueType fonts if available
    foreach ($text_to_add as $text) {
      $x = random_int(0, $width - 20);
      $y = random_int(20, $height);
      imagettftext($image, $font_size, 0, $x, $y, $line_color, $font_path, $text);
    }
} elseif( ! $use_ttf && image_processing_extension() ) {
   // Fallback to built-in fonts using imagechar
   $font = 5; // Built-in font (1-5, 5 is largest)
   $font_width = imagefontwidth($font);
   $font_height = imagefontheight($font);
    foreach ($text_to_add as $text) {
       $x = random_int(0, $width - ($font_width * strlen($text)) );
       $y = random_int(20, $height);
       for($j=0; $j< strlen($text); $j++){
          imagechar($image, $font, $x + ($font_width * $j), $y, $text[$j], $text_color);
       }
    }
}


imagewebp($image);
imagedestroy($image);
?>