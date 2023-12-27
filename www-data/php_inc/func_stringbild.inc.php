<?php
function func_stringbild ($string,$string1,$fontsize,$col,$noshade,$new) 
{
$black = array ("0","0","0");
$blue = array ("0","0","255");
$brown = array ("100","40","0");
$lighterbrown = array ("255","255","217");
$lightbrown = array ("255","237","148");
$lightgray = array ("166","166","166");
$lightergray = array ("205","200","116");
$darklila = array ("31","79","124");
$red = array ("255","0","0");
$white = array ("255","255","255");

if (!$fontsize) $fontsize = 20;
$string = html_entity_decode($string);
$string = str_replace ( '&OElig;', '&#338;', $string );
//$string = umlWorkaround ($string);


// $font = "fonts/DejaVuCondensedSansBold.ttf";
$font = "fonts/LinBiolinum_R.ttf";
//$font = "fonts/Perb____.TTF";
//$font = "fonts/arialbd.ttf";

if (!$col) $col = 'brown';

$bg_col = 'white';


switch ($col) {
	case "brown":
		$file_col="b_";
		break;
	case "lightergray":
		$file_col="lg_";
	 	break;
}
	


$shade_col = 'lightgray';
$string_max ="Üg";
$dir = "img";

if ($string) {
// 	if (!is_dir ($dir))  mkdir ($dir);
//	$string_ersetzt = ersetzeUmlaute($string);

	$img_file = "img/" . $file_col . $fontsize . $string1 . ".png";

//  print "String: " . $string_ersetzt;

/*  if (!$new && is_file($img_file))  {
	    $img = imagecreatefrompng ($img_file);
		header ( 'content-type: image/png' );
    } else	{  
*/
//		header ( 'content-type: image/png' );
		$img_cord = imagettfbbox ($fontsize,0,$font,$string);
		$width = $img_cord[2] + 7;
		$img_cord = imagettfbbox ($fontsize,0,$font,$string_max);
		$img_cord[5] = abs ( $img_cord[5]);
		$heigth = $img_cord[5] + 7;

		$img = imagecreate ( $width , $heigth );
		$IntBG_col= imagecolorallocate ( $img  , ${$bg_col}[0], ${$bg_col}[1], ${$bg_col}[2] );

		$txt_color = 	imagecolorallocate ( $img  , ${$col}[0], ${$col}[1], ${$col}[2] );
		$shade_color = imagecolorallocate ( $img  , ${$shade_col}[0], ${$shade_col}[1], ${$shade_col}[2] );
 
		if  (!$noshade)  	imagettftext ( $img, $fontsize, 0, 4, $fontsize + 4, $shade_color, $font, $string);
		imagettftext ( $img, $fontsize, 0, 3, $fontsize + 3, $txt_color, $font, $string);

//  			imagestring ( $img,  $fontsize, 5, 1, $string, $txt_color);

 		imagecolortransparent($img, $IntBG_col);
  		
	 	imagepng ($img, $img_file); 	 // Bild abspeichern
  	    chmod ($img_file, 0644); 

//	}    // end else  
//    $img = imagecreatefrompng ($img_file);
//	imagepng ( $img );
	ImageDestroy ( $img );

}
$noshade = NULL; 

}

function umlWorkaround($text) {
     $text = (string) $text;
     $text_out = "";
 
     for($i = 0, $n =  strlen($text); $i < $n; $i++) {
         $text_out .= "&#" . ord($text[$i]) . ";";
	}
 
return $text_out;
}


?> 