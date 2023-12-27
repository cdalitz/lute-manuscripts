<?php
include_once "php_inc/functions.inc.php";

$uri = getenv("REQUEST_URI");
// echo "URI = " . $uri;

if ($type1 == "sitemap1") { 
$font1 = "smh3";
$font2 = "text";
$hruler = "";

print "<div class=\"sitemap\">";
print "<table><tr><td>";

}  else { 
?>

<div class="oben">
<div class="heading1">
<?php
	$FileModDate_index = DateiDatum ('index.php');
	$FileModDate_conc = DateiDatum ('data/Concordances.csv');
    print "<a name=\"top\"></a>\n<table class=\"tblh1\" style=\"background-image:url('images/tabulatur.gif'); background-repeat:no-repeat; background-position: center; \" ><tr>\n";
//         draw_impressum($lang);
    print "<td class=\"vmid\" colspan=\"2\"><span class=\"min1\">"; 
   
if (!strstr($uri,'index.php')) $uri .= "index.php?id=0&type=index&lang=" . $lang;

$uri_test = str_replace('&amp;test=' . $test,'',$uri);
if (!isset($test) || $test == '0') 
	$uri_test = $uri_test . "&amp;test=1";

if ($lang=='deu') {
	print "Zuletzt ge&auml;ndert: " . $FileModDate_conc . " (Konkordanzen), ";
} else {
	print "Last updated : " . $FileModDate_conc . " (Concordances), ";
}
if ($testversion == 1) print "<a href=\"" . $uri_test . "\">"; 
print $FileModDate_index;
print " (Scripts)";
if ($testversion == 1) print "</a>";
if ($test && $test == 1) 
if ($lang=='deu') {
	print " !Testversion!"; 
} else {
	print " !Testing version!"; 
}
print "</span></td><td></td></tr><tr><td>";
print "<h3>";
if ($lang=='deu') {
	print "Musik f&uuml;r Lauteninstrumente";
} else {
	print "Music for Lute Instruments";
}
	print	"<br><span class=\"smh3\">";
if ($lang=='deu') {
	print	"Eine Datenbank von Peter Steur und Markus Lutz";
} else {
	print "A Database by Peter Steur and Markus Lutz";
}
print "</span></h3>"; 

    print "</td><td class=\"headout\">";
	draw_impressum($lang);
	print "<br>";
	draw_datenschutz($lang);
// 	print "<br";
 	draw_flags();
    print "</td></tr>";
    print "</table></div>";
 
$font1 = "smh4";
$font2 = "min1";
$hruler= "<p class=\"l\"><img src=\"images/sm_barre_gosset.gif\" width=\"100\" height=\"5\" alt=\"sm_barre_gosset.gif\">\n";
//$hruler = "<hr class=\"menu\">";
?>



<div class="menu">
<?php  
}



print "<div id=\"links\">\n";


if ($type1 != "sitemap1") print "<div class=\"flexy\">";


// Menü

for ($i=0; $i <= $menu_max; $i++) {
$id1= $i;
$i2 = -1;

  foreach ($arr_index[$i] as $test1) {
     $i2++;
  }
   if ($type1 != "sitemap1") draw_menu ($font1,$font2,$arr_index[$i],${"arr_index_" . $lang}[$i],$lang,$i,$type1,$i2,$test,$instr);
     else draw_menu_sitemap ($font1,$font2,$arr_index[$i],${"arr_index_" . $lang}[$i],$lang,$i,$type1,$i2,$test,$instr);
//      else draw_menu ($hru,$hruler,$font1,$font2,$arr_index[$i],${"arr_index_" . $lang}[$i],$lang,$i,$id1,$type1,$i2);

}
// Vorhandene Quellen
//	if (!$ms) $uri .= "&amp;ms=" . $arrMss[0];



// if ($arr_index[$id][0] == "ms") {
	print "<div class=\"mss_menu\">\n";


	$ExistingMss_deu = array("Vorhandene Quellen");

	$ExistingMss_eng = array("Available Sources");

	$intQuantityMssFile = $intQuantityOfMss - $intMissingMss;



/* test */
	$uri_menu = $uri;

	if (!$id) $uri_menu .= "&amp;id=1";

	if (!$type) $uri_menu .= "&amp;type=ms";

	if (!$ms) $uri_menu .= "&amp;ms=" . $arrMssOhneUml[0]; //27.02.2011
		else $uri_menu .= "&amp;ms=" . $ms;
	if ($test == 1) $uri_menu .= "&amp;test=1";
//	if ($instr) $uri_menu .= "&amp;instr=" . $instr;

	print "<dl class=\"mss\"><a class=\"mss_menu\" style=\"font-size: 1.2rem;\"";
	print " href=\"index.php?id=1&amp;type=listmss";
	if ($lang) print "&amp;lang=" . $lang; 
	if ($instr) print "&amp;instr=" . $instr;
	print "\">";
	print ${'ExistingMss_' . $lang}[0] . "</a>";


	print "<div class=\"hide\"><span class=\"mss\">";
 	print "<span class=\"mss10\">" . $intQuantityMssFile . " (" . $intQuantityOfMss . ") " . ${'ExistingMss_' . $lang}[0] . "</span><br>";
	print $strExistingMss;

	print "</span></div>\n";

	print "</dl></div><div></div>\n";





// ----------------------------------------------------------------

// print "</tr></table>\n";

// if ($type1 != "sitemap1") {
// print "</td></tr></table></div>\n<div class=\"content\">\n";
// } else print "</td></tr></table></div>\n";

if ($type1 != "sitemap1") {
	print "</tr></div></div></div></div>\n";
} else {
	print "</td></tr></table></div>\n";
}

	
?>





