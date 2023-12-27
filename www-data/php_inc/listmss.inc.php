<?php 
$pagetitle = array (
'deu' => "Liste der Quellen",
'eng' => "List of Sources"
);


// darüber: Instrumentenauswahl
print show_ArrInstr (); 

print "<h3>" . $pagetitle[$lang];
print "<smh3>";
	$ExistingMss_deu = array("vorhandene Quellen");

	$ExistingMss_eng = array("available Sources");

	$intQuantityMssFile = $intQuantityOfMss - $intMissingMss;





print "<div>\n";
/* Form-Abfrage */


?>
<table class='MssSearchform'>
<tr><td colspan="1">

<form method='get'>
<?php
print "<input type=\"hidden\" name=\"lang\" value=\"" . $lang . "\">\n"; 
print "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">\n"; 
if ($type) print "<input type=\"hidden\" name=\"type\" value=\"" . $type . "\">\n"; 
if ($type == "ms") print "<input type=\"hidden\" name=\"ms\" value=\"" . UmlauteErsetzen($ms) . "\">\n"; 
// if ($type == "mss") print "<input type=\"hidden\" name=\"mss\" value=\"" . $mss . "\">"; 
if (isset($instr)) print "<input type=\"hidden\" name=\"instr\" value=\"" . $instr . "\">\n"; 
if (isset($start)) print "<input type=\"hidden\" name=\"st\" value=\"" . $start . "\">\n"; 
if (isset($number)) print "<input type=\"hidden\" name=\"nm\" value=\"" . $number . "\">\n"; 
if (isset($test)) print "<input type=\"hidden\" name=\"test\" value=\"" . $test . "\">\n"; 
if (isset($mssABC)) print "<input type=\"hidden\" name=\"mssABC\" value=\"" . $mssABC . "\">\n"; 


?>
<?php if ($lang == "deu") print "Zeichenfolge in Manuskriptdaten suchen ..."; else print "Search for string in manuscript data ..."; ?><br>
<input name="mssSearch" type="text" width="30" class="input" 
value="<?php if (isset ($mssSearch))	print $mssSearch;?>">
<?php if (!isset($mssSearch)) { ?>
</td></tr>
<tr><td>
<br>
<b>
<input type="checkbox" name="mssDetails" value="yes" <?php if ( isset($_GET['mssDetails']) || isset ($mssDetails)) print ' checked="checked"'; else print '';?>><?php if ($lang == "deu") print "Einzelheiten anzeigen ..."; else print "Show details ..."; } ?>
<input type='submit'  class='button' value='<?php if ($lang == "deu") print "Senden"; else print "Send"; ?>' height='25' />
</b></td>
</tr>
</form>
</table>
</div>
<?php


	$uri = getenv("REQUEST_URI");

	$uri_menu = $uri;

	if (!$id) $uri_menu .= "&amp;id=1";
	if (!$type) $uri_menu .= "&amp;type=listmss";
	if (!$ms) $uri_menu .= "&amp;ms=" . $arrMssOhneUml[0]; //27.02.2011
	if ($test == 1) $uri_menu .= "&amp;test=1";
	if ($instr) $uri_menu .= "&amp;instr=" . $instr;
	if (isset ($mssDetails)  && !strstr($uri,"&mssDetails=yes")) $uri_menu .= "&amp;mssDetails=yes";

// print "<b><font size=2><br>" . $uri_menu . "</b>";

print "<span class=\"size14\">" . $intQuantityMssFile . " (" . $intQuantityOfMss . ") " . ${'ExistingMss_' . $lang}[0] ;

switch ($lang) {
	case "deu": 
		print "<br><b>Es ";
		if ($counterAnzahl != 1) {
			print "werden " . $counterAnzahl; 
			if ($intMissingMss2 > 0) print " (" . ($intMissingMss2+$counterAnzahl) . ")";
			print " Quellen angezeigt!</b>";
		}
		else print "wird " . $counterAnzahl . " Quelle angezeigt!</b>";
		break;
	case "eng":
		print "<br><b>";
		if ($counterAnzahl != 1) {
			print $counterAnzahl; 
			if ($intMissingMss2 > 0) print " (" . ($intMissingMss2+$counterAnzahl) . ")";
			print " sources are listed!</b>";
		}
		else print $counterAnzahl . " source is listed!</b>";
		break;
}

print "</span></smh3></h3>";


	print "\n<dl class=\"listmss\">";
	print $strListMss1;

	print "</dl></div>\n";
    print "&nbsp;\n&nbsp;\n&nbsp;\n&nbsp;\n";



?>
