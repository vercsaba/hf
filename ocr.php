<?php
header('content-type:image/png');
//$img = imagecreatetruecolor(100, 100);
$img = imagecreatefrompng ('intel_vs_amd.png') ;
$zold = imagecolorallocate($img, 0, 255, 0);
$feher = imagecolorallocatealpha($img, 255, 255, 255, 50);
$adatok = getimagesize('intel_vs_amd.png');
$w = $adatok[0];
$h = $adatok[1];

for($y = 0; $y < $h; $y++){
        for($x = 0; $x < $w; $x++){
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            if($b > 200 && $g > 200 && $r > 200){
                imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 0, 0));
            }
            else{
                imagesetpixel($img, $x, $y, imagecolorallocate($img, 0, 255, 0));
            }
        }
}


//imagettftext($img, 300, 0, 285, 380, $zold, 'betu.ttf', 'F');
$betuk = 'ABQDEFGHIJKLMNORCPSTUVWXYZ';

$bNotNullPr = 0;
$karakter = '';
for($i = 0; $i < strlen($betuk); $i++){
  
    imagettftext($img, 300, 0, 285, 380, $feher, 'betu.ttf', $betuk[$i]);
    $bNotNull = 0;
    for($y = 0; $y < 100; $y++){
        for($x = 0; $x < 100; $x++){
            $rgb = imagecolorat($img, $x, $y);
            $r = ($rgb >> 16) & 0xFF;
            $g = ($rgb >> 8) & 0xFF;
            $b = $rgb & 0xFF;
            if($b != 0 && $g == 255){
                $bNotNull++;
            }
        }
    }
    if($bNotNull >= $bNotNullPr){
        $bNotNullPr = $bNotNull;
        $karakter = $betuk[$i];
    }
    imagettftext($img, 300, 0, 285, 380, imagecolorallocate($img, 0, 0, 0), 'betu.ttf', $betuk[$i]);
    imagettftext($img, 300, 0, 285, 380, $zold, 'betu.ttf', 'F');
}
imagestring($img, 7, 0, 0, $karakter, $zold);
imagettftext($img, 60, 0, 20, 70, $feher, 'betu.ttf', $karkter);





imagepng($img);
imagedestroy($img);
?>