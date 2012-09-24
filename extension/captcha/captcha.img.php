<?php

require_once("../../conf.inc.php");
if(!defined("_IN_3POJ")) die();
require_once($settings['module_dir'] . "/session.mod.php");

header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
header("Cache-Control: no-cache, must-revalidate, no-store, no-cache, must-revalidate, post-check=0, pre-check=0");
header("Pragma: no-cache");

Session::init();
$width = 150; //The width of the image.
$height = 42; //The height of the image.
$line_counter = 1; //Disturbing Line
$strset = "23456789abcdefghjkmnpqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
$code = "";
for($i=1;$i<=5;$i++){
	$rand = mt_rand(0,54); //Make Random Number in the Charater Set.
	$code .= $strset[$rand];
}
Session::set("captcha", $code);
error_reporting(0); //No error report.It might cause serious problem if there were some error-report...
header("Content-type: image/PNG"); //Send header of PNG.
$im = imagecreatetruecolor($width,$height); //Image size
$myself1 = imagecolorallocate($im,$br=mt_rand(144,255),$bg=mt_rand(144,255),$bb=mt_rand(144,255)); //Background color;
imagefill($im,0,0,$myself1);//Set the background color.
for($i=0;$i<5;$i++){
	$myself2 = imagecolorallocate($im, mt_rand(0,72),mt_rand(0,72),mt_rand(0,72)); //Character color;
	imagettftext($im,mt_rand(26,28),mt_rand(-10,10),(($i)*($width/5))+mt_rand(1,4),mt_rand($height-10,$height-8),$myself2,dirname(__FILE__).'/font'.mt_rand(1,13).'.ttf',$code[$i]); //Draw the random number in the image.
}
//imagettftext($im, 40, mt_rand(-2,4), mt_rand(1,4),mt_rand(50,55), $myself2,dirname(__FILE__).'/font.ttf',$mt_randval); 
for($i=0;$i<$height*$width/6;$i++){ //Set desturbing pixel.
	$randcolor = imagecolorallocate($im,mt_rand(0,72),mt_rand(0,72),mt_rand(0,72));//Set random color
	imagesetpixel($im, mt_rand()%$width , mt_rand()%$height , $randcolor/*$myself2*/); 
}//Set the pixel
for($i=0;$i<$line_counter;$i++){
	$randcolor = imagecolorallocate($im,mt_rand(max(0,$br-64),max($br+64,255)),mt_rand(max(0,$bg-64),max($bg+64,255)),mt_rand(max(0,$bb-64),max($bb+64,255)));
	imageline($im,mt_rand(0,$width/6),mt_rand(0,$height/6),mt_rand($width*5/6,$width),mt_rand($height*2/3,$height*5/6),$randcolor);
	$randcolor = imagecolorallocate($im,mt_rand(max(0,$br-64),max($br+64,255)),mt_rand(max(0,$bg-64),max($bg+64,255)),mt_rand(max(0,$bb-64),max($bb+64,255)));
	imageline($im,mt_rand(0,$width/6),mt_rand($height*5/6,$height),mt_rand($width*5/6,$width),mt_rand($height/6,$height/3),$randcolor);
	$randcolor = imagecolorallocate($im,mt_rand(max(0,$br-64),max($br+64,255)),mt_rand(max(0,$bg-64),max($bg+64,255)),mt_rand(max(0,$bb-64),max($bb+64,255)));
	imageline($im,mt_rand(0,$width/6),mt_rand($height/3,$height*2/3),mt_rand($width*5/6,$width),mt_rand($height/3,$height*2/3),$randcolor);
	$randcolor = imagecolorallocate($im,mt_rand(max(0,$br-64),max($br+64,255)),mt_rand(max(0,$bg-64),max($bg+64,255)),mt_rand(max(0,$bb-64),max($bb+64,255)));
	imageline($im,mt_rand(0,$width/6),mt_rand($height/3,$height*2/3),mt_rand($width*5/6,$width),mt_rand($height/3,$height*2/3),$randcolor);
	$randcolor = imagecolorallocate($im,mt_rand(max(0,$br-64),max($br+64,255)),mt_rand(max(0,$bg-64),max($bg+64,255)),mt_rand(max(0,$bb-64),max($bb+64,255)));
	imageline($im,mt_rand(0,$width/6),mt_rand($height/3,$height*2/3),mt_rand($width*5/6,$width),mt_rand($height/3,$height*2/3),$randcolor);
}
imagepng($im);
imagedestroy($im);
?>