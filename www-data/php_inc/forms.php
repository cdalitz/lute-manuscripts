<?php
      // $key_short = correct_key_short($key); 
      $key = correct_set_key ($key_orig); 

$arr_types = array (
"mss"  => array ("All sources","Alle Quellen"),
"ms" => array ("Single source","Einzelquelle"),
/* "ms3" => array  ("Single source complete","Einzelquelle komplett"),*/
);

$arr_keys = array (
""  => array ("No key selected","Keine Tonart ausgew&auml;hlt"),
"C" => array ("C Major","C-Dur"),
"a" => array ("a minor","a-Moll"),
"G" => array ("G Major","G-Dur"),
"e" => array ("e minor","e-Moll"),
"D" => array ("D Major","D-Dur"),
"h" => array ("b minor","h-Moll"),
"A" => array ("A major","A-Dur"),
"f#" => array ("f sharp minor","fis-Moll"),
"E" => array ("E Major","E-Dur"),
"g#" => array ("g sharp minor","gis-Moll"),
"H" => array ("B Major","H-Dur"),
"d#" => array ("d sharp minor","dis-Moll"),
"F#" => array ("F sharp Major","Fis-Dur"),
"C#" => array ("C sharp Major","Cis-Dur"),
"G#" => array ("B sharp Major","Gis-Dur"),
"D#" => array ("D sharp Major","Dis-Dur"),
"F" => array ("F Major","F-Dur"),
"d" => array ("d minor","d-Moll"),
"Bb" => array ("B flat Major","B-Dur"),
"g" => array ("g minor","g-Moll"),
"Eb" => array ("E flat Major","Es-Dur"),
"c" => array ("c minor","c-Moll"),
"Ab" => array ("A flat Major","As-Dur"),
"f" => array ("f minor","f-Moll"),
"b" => array ("b flat minor","b-Moll"),
"eb" => array ("e flat minor","es-Moll")
);

$instrument = ''; // in index definiert
$zaehler = 0;
?>

<form method='get' >
<div class=acc>
<div class='searchform'>
<div id='searchinputOben'>

<?php
print "<span class=\"size16bc\">";
if ($lang == "deu") print "Filtern/Suchen"; else print "Filter/Search";
print "</span>";

// $ShowFilter_deu = array ("Filter anzeigen","Filter verbergen");
// $ShowFilter_eng = array ("Show Filters","Hide Filters");
$ExplFilter_deu = array ("Erkl&auml;rung","(PDF)");
$ExplFilter_eng = array ("Explanation","(PDF)");
$uri = getenv("REQUEST_URI");

//  	print "<p class=\"c\"><span class=\"mss_bold\">"  . ${'ShowFilter_'. $lang}[0] . "<br>";

// 	$uri1 = str_replace('&amp;exFilter=' . $boolExFilter,'',$uri);

	$uri1 = $uri;
	print "<dl class=\"mss\">";
	print "<a class=\"mss\" align=left>" . ${'ExplFilter_' . $lang}[0] . "</a></span> ";
	print "<a href=\"data/FilterDetails-" . $lang . ".pdf\" target=\"_new\">" . ${'ExplFilter_' . $lang}[1] . "</a><div class=\"hide\">";

	print "<span class=\"font10\"\n";

      switch ($lang) {
     	case ("deu") : 
	  print '<i>Wichtig: Alle Filter k&ouml;nnen miteinander kombiniert werden.<br>
	  Momentan k&ouml;nnen die Filter nur manuell gel&ouml;scht werden, 
	  indem man alle Felder leert und auf <q>Filtern...</q> klickt.</i><br><br>
	  <b>Incipitsuche</b>: Hiermit ist es m&ouml;glich, die Incipits nach Konkordanzen oder &Auml;hnlichkeiten zu durchsuchen.
	  Es wird die abctab2ps-Schreibweise verwendet, allerdings ohne Verzierungen 
	  (cf: <a href="http://www.lautengesellschaft.de/cdmm/userguide/node8.html" 
	  target="_new">http://www.lautengesellschaft.de/cdmm/userguide/node8.html</a>).<br>
	  Es reicht, die jeweils oberste Stimme anzugeben. Die Noten werden durch Leerzeichen getrennt. 
	  Z.B. wird bei <q>e | ,a e</q> die bekannte Weiss-Bourree gefunden. Durch Hinzuf&uuml;gen von einem weiteren 
	  Leerzeichen zwischen den Noten ergibt sich ein Platzhalter f&uuml;r diese Stelle. Mit x1, x2 etc. werden 1, 2 etc. variable 
	  Platzhalter eingef&uuml;gt.<br>Taktstriche k&ouml;nnen mit <q>|</q> angegeben werden, was die Treffergenauigkeit erh&ouml;hen kann, 
	  aber den Nachteil hat, dass dann alle Taktstriche grunds&auml;tzlich ber&uuml;cksichtigt werden und nicht ausgefiltert werden.<br>
	  <b>Instrumente</b>: Es werden die Instrumente gefiltert, die in der Datenbank vorkommen 
	  (Kleinbuchstaben finden alle Bez&uuml;ge, inkl. der Konkordanzen, Gro&szlig;buchstaben alle Quellen 
	  mit Musik f&uuml;r das jeweilige Instrument). Es werden aber jeweils die kompletten Quellen angezeigt:<br>
	  Barocklaute = bl/BL<br>
	  Renaissancelaute = rl/RL<br>
	  Angelique = ang/ANG<br>
	  Barockgitarre = bg/BG<br>
	  Cister = CT<br>
	  Mandora = ma/MA<br>
	  Theorbe = TH<br>
	  Vihuela = VIH<br>
	  Andere Zupfinstrumente = VS<br>
	  Accord Nouveaux = ACN<br>
	  Ensemble = EN<br>
	  Quelle mit Vokalstimme(n) = V<br>
      Dar&uuml;ber hinaus ist es inzwischen m&ouml;glich, damit Drucke (= Print) oder verwendete Tabulaturarten zu filtern: 
      Franz&ouml;sische Tabulatur = FTab, Italienische Tabulatur = ITab, Deutsche Tabulatur = DTab.<br>
	  <b>Komponist</b>: Hier ist es m&ouml;glich, nach einer beliebigen Zeichenkette innerhalb 
	  des Komponistenfeldes zu suchen. Gro&szlig;- und Kleinschreibung wird ber&uuml;cksichtigt.<br>
	  <b>Signatur</b>: Bei der Signatur wird grunds&auml;tzlich vom Beginn an gefiltert und in allen Quellen gesucht. 
	  Gro&szlig;- und Kleinschreibung wird ber&uuml;cksichtigt.
	  Es ist hier m&ouml;glich, nach L&auml;ndern (z.B. <q>A</q> f&uuml;r &Ouml;sterreich oder <q>US</q>
	  f&uuml;r die Vereinigten Staaten von Amerika) bzw. nach Bibliotheken 
	  (<q>A-KR</q> = Kremsm&uuml;nster) zu suchen.
	  Es werden die Kurz-Signaturen verwendet.<br>
	  <b>Titel</b>: Hier ist es m&ouml;glich, nach einer beliebigen Zeichenkette innerhalb des Titels zu suchen. 
	  Gro&szlig;- und Kleinschreibung wird nicht ber&uuml;cksichtigt.<br>
	  <b>Tonart</b>: Durtonarten werden mit Gro&szlig;buchstaben, moll-Tonarten mit Kleinbuchstaben angegeben,
	  zu denen ein <q>b</q> oder <q>#</q> treten k&ouml;nnen (z.B. f# f&uuml;r fis-Moll oder Eb f&uuml;r Es-Dur).
	  Weil manche Tonarten unterschiedlich bezeichnet wurden (z.B. Es-Dur und Dis-Dur), 
	  werden unter Umst&auml;nden nicht alle Vorkommen gefunden.';
	  break;
     	case ("eng") : 
	  print '<i>Important: All filters can be combined.<br>
	  Currently the fields can only be erased manually by emptying them and clicking on <q>Filter...</q> once.</i><br><br>
	  <b>Composer</b>: You can search for every string inside of the field for composer (case-sensitive).<br>
	  <b>Incipit search</b>: You can search incipits to find concordances or similarities. For this abctab2ps code is used, 
	  but with all ornaments filtered out 
	  (cf: <a href="http://www.lautengesellschaft.de/cdmm/userguide/node8.html" 
	  target="_new">http://www.lautengesellschaft.de/cdmm/userguide/node8.html</a>).<br>
	  It is enough to notate the highest notes. To mark the next note, you should use a space. 
	  For example you will find the famous Bourree of Weiss, if you input<q>e | ,a e</q>. Adding a further space between the notes 
	  adds a placeholder exactly at this place. With x1, x2 etc. you have the possibility to add variable placeholders (one, two etc.).y<br>
	  Bars can be added with <q>|</q> to increase the accuracy of the search, but with the disadvantage, that the bars then aren\'t filtered out.<br> 
	  <b>Instruments</b>: Here you can filter the instruments, that are in the database (lowercase means all connected mss, 
	  including concordances, uppercase all mss with notated music of this instrument). But always the whole source will be shown:<br>
	  Baroque lute = bl/BL<br>
	  Renaissance lute = rl/RL<br>
	  Angelique = ang/ANG<br>
	  Baroque guitar = bg/BG<br>
	  Cittern = CT<br>
	  Mandora = ma/MA<br>
	  Theorbo = TH<br>
	  Vihuela = VIH<br>
	  Other plucking instruments = VS<br>
	  Accord Nouveaux = ACN<br>
	  Ensemble = EN<br>
	  Source with vocal part(s) = V<br>
	  <b>Key</b>: Major keys use upper case and minor keys lower case,
	  that can be followed by <q>b</q> or <q>#</q> (e.g. f# for f sharp minor or Eb for E flat Major).
	  Unfortunately, as some keys have historically different denotations (e.g. D# and Eb), at the moment 
	  possibly not all entries will be found.<br>
	  Furthermore it is possible in the meantime to filter herewith prints (= Print) or used type of tablature: 
	  French Tablature = FTab, Italian  Tablature = ITab, German Tablature = DTab.<br>
	  <b>Signature</b>: The searching always starts with the beginning of the signature and refers to all sources (case-sensitive).
	  Only the short signatures are used. You can search for all sources in one land
	  (e.g. <q>A</q> for Austria or <q>US</q> for the United States) or for libraries (<q>A-KR</q> = Kremsm&uuml;nster).<br>
	  <b>Title</b>: You can search for every string in the title of movements (case-insensitive).';
	  break;
	  
      }


	print "\n</span></div></dl>";
	print "</div>";
?>	
 <input type="radio" class="open" name="ac" id="searching" >
      <input type="radio" class="close" name="ac" id="searching-close" >
      <label class="open" for="searching"><b>&nbsp;>&nbsp;<?php if ($lang == 'deu') print "Filter anzeigen"; else print "Show filter";?></b></label>
      <label class="close" for="searching-close"><b>&nbsp;<&nbsp;<?php if ($lang == 'deu') print "Filter einklappen"; else print "Close filter";?></b></label>
<div class="panel">

<?php
print "<input type=\"hidden\" name=\"id\" value=\"" . $id . "\">\n"; 

if ($type != "conc" && $type != "listmss") filterOptions ("Sources");
	else print "<input type=\"hidden\" name=\"type\" value=\"" . $type . "\">\n"; 

print "<input type=\"hidden\" name=\"lang\" value=\"" . $lang . "\">\n"; 
print "<input type=\"hidden\" name=\"ms\" value=\"" . UmlauteErsetzen($ms) . "\">\n"; 

if ($type != "listmss") filterOptions ("Anzahl"); 

print "<input type=\"hidden\" name=\"st\" value=\"0\">\n"; 

filterOptions ("Instruments"); 
if ($type != "listmss") filterOptions ("FrTab");
if ($type != "conc" && $type != "listmss") filterOptions ("Titel");
if ($type != "conc" && $type != "listmss") filterOptions ("Komponist"); 
if ($type != "conc" && $type != "listmss") filterOptions ("Signatur"); 
if ($type != "conc" && $type != "listmss") filterOptions ("Incipits"); 
if ($type != "listmss") filterOptions ("ConcNr");
if ($type != "conc" && $type != "listmss")  filterOptions ("Tonart"); 


if (isset($test) && $test != '0') print "<input type=\"hidden\" name=\"test\" value=\"" . $test . "\">\n"; 

?>
<div id="searchinputUnten"><div class="right">
<input type='submit'  class='button2' value='<?php if ($lang == "deu") print "Anwenden"; else print "Use filters"; ?>' height='25' />
</div></div>
</div>
</div>
</div>
</form>

<?php


  
function filterOptions ($filterOption)
{
	global $abcinc, $arr_types, $arr_keys, $ArrInstr, $comp, $conc, $instrument, $key, $lang, $langArr, $msnam, $tabfixfrench, $title, $type, $zaehler;
	print "<div id=\"searchinput\">";
	
	switch ($filterOption)
	{
		case ("Anzahl"):
			if ($lang == "deu") print "Anzahl Eintr&auml;ge"; else print "Number of Entries"; 
			?><br><input name="nm" type="text" width="14" class="input" 
			value="<?php if (isset($number) && $number <= 50 && $type != 'ms3') print $number; /* else if ($type == 'ms3') print '1000';*/ else if ($type != 'conc') print '10'; else print '200';?>">
			<?php
			break;
		case ("ConcNr"):
			if ($lang == "deu")	print "Konkordanznummer "; else print "Concordance Number "; ?><br>
				<input name="conc" type="text" width="14" class="input" 
				value="<?php if ($conc)	print $conc; ?>">
				<?php
			break;	
		case ("FrTab"):
			?><input type="checkbox" name="tabfixfrench" value="<?php if (isset($tabfixfrench) && $tabfixfrench == '1') print $tabfixfrench . '" checked="checked"';?>">
			<?php  if ($lang == "deu") print "Franz. Tabulatur"; else print "French tablature"; 
			break;
		case ("Incipits"):
			if ($lang == "deu")	print "Incipitsuche"; else print "Incipit search"; 
			?><br><input name="abcinc" type="text" width="28" class="input" 
			value="<?php if ($abcinc)	print $_GET['abcinc']; ?>">
			<?php
			break;
		case ("Instruments"):
			if ($lang == "deu") print "Instrumente"; else print "Instruments"; 
			?><br>
			<input name="instr" type="text" width="14" class="input" value="<?php 
				if ($ArrInstr) { 
					foreach ($ArrInstr as $instrx) { 
						if ($zaehler > 0) $instrument .= ","; 
						$zaehler++; 
						$instrument .= $instrx;  
					} 
					print $instrument; 
				} else print "";
			?>">
			<?php
			break;	
		case ("Komponist"):
			if ($lang == "deu")	print "Komponist"; else print "Composer"; 
			?><br><input name="comp" type="text" width="14" class="input" 
			value="<?php if ($comp)	print $comp; ?>">
			<?php
			break;
		case ("Signatur"):
			if ($lang == "deu")	print "Signatur "; else print "Signature "; 
			?><br><input name="msnam" type="text" width="14" class="input" 
			value="<?php if ($msnam)	print $msnam; ?>">
			<?php
			break;
		case ("Sources"): 
			if ($lang == "deu") print "Durchsuchte Quellen"; else print "Filtered Sources"; 
			?>
			<br>
			<select name="type" width="14" size="1">
			<?php 
			foreach ($arr_types as $types => $type1 ) { 
				print '<option value="' . $types . '"';
				if ($types == $type) print ' selected="selected"';
				print '>' . $type1[$langArr] . '</option>' . "\n";
			}
			?></select>
			<?php
			break;	
		case ("Titel"):
			if ($lang == "deu") print "Titel "; else print "Title "; 
			?><br><input name="title" type="text" width="14" class="input" 
			value="<?php if ($title) print $title;?>">
			<?php
			break; 
		case ("Tonart"):
			if ($lang == "deu") print "Tonart"; else print "Key"; 
			?><br><select name="key" width="14" size="1">
			<?php 
			foreach ($arr_keys as $keys => $keys1 ) { 
				print '<option value="' . $keys . '"';
				if ($keys == $key) print ' selected="selected"';
				print '>' . $keys1[$langArr] . '</option>' . "\n";
			}
			?></select><?php
			break;
		} 
		print "</div>";
}


?>
