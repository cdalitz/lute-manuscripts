<?php
// --------------------- function draw_flags ----------------------------
function draw_flags() {
	$img_sh = array ('deu', 'eng');
	$img_lg = array ('Deutsch', 'English');

	print "<p class=\"c\">\n";      
	for ($i=0; $i <= 1 ; $i++) {
		if (strlen(getenv("REQUEST_URI")) > strlen("/index.php&lang=deu") ) {
		print "<a href=\"" . str_replace("&","&amp;",str_replace ($img_sh,$img_sh[$i],getenv("REQUEST_URI"))) 
		. "\">\n";
		} else { 
			print "<a href=\"index.php?lang=" . $img_sh[$i] . "\">\n";
		}
		print "<img src=\"images/flag_" . $img_sh[$i] . ".gif\" border=\"0\" 
		alt =\"" . $img_lg[$i] . "\" width=\"39\" height=\"26\"></a>\n";
	}
   	print "\n";
}

// --------------------- function draw_impressum ----------------------------
function draw_impressum($lang) {
	print "<p class=\"c\">";
	print "<a href=\"index.php?id=3&amp;type=contact&amp;lang=" . 
	   $lang . "\">" . 'Impressum';
        if ($lang=="deu") print "/Kontakt";
          else print "/Contact";
        print "</a>\n";
   	print "\n"; 
}


// --------------------- function draw_datenschutz ----------------------------
function draw_datenschutz($lang) {
	print "<p class=\"c\">";
	print "<a href=\"index.php?id=3&amp;type=datenschutz&amp;lang=" . 
	   $lang . "\">";
        if ($lang=="deu") print "Datenschutzerklärung";
		else print "Privacy Policy (in German)";
        print "</a>\n";
   	print "\n"; 
}





// --------------------- function draw_impressum ----------------------------
function draw_barre_gosset () {
print "<p class=\"c\"><img src=\"images/barre_gosset.gif\" height=\"29\" width=\"492\" alt=\"barre_gosset.gif\">";
}

// --------------------- function draw_impressum ----------------------------
function draw_lnfootnote ($number) {
	print "<sup><a name=\"fnre" . $number . "\" href=\"#fn" . $number ."\">" . $number . "</a></sup>";
}

// --------------------- function draw_impressum ----------------------------
 function draw_footnote ($number) {
	print "<p class=\"fn1\">(" . $number . ")";
	print "<a name=\"fn";
	print $number . "\" href=\"#fnre" . $number . "\">";
	print "<img src=\"images/flechehaut.gif\" width=\"20\" height=\"25\" border=\"0\" align=\"bottom\" alt=\"fletchehaut.gif\"></a>\n";
}






// --------------------- function draw_menu ----------------------------
function draw_menu ($font1,$font2,$test_menu,$test_lang,$lang,$id1,$type1,$i2,$test,$instr) {
// include_once ("php_inc/func_stringbild.inc.php");
global $id,$type,$ms,$tabfixfrench; 
$conc_menu = "_1";

	$string = $test_lang[0];
	$string1 = ersetzeUmlaute($string,0);
    
   print "<td class=\"c1\"><ul class=\"menu\">\n"; 
	if ($id == $id1 ) print "<dl id=\"highlight\"><dt>\n";
	  else print "<dl><dt>\n";
	  print "<a class=\"menu\" href=\"index.php?id=" . $id1 . "&amp;type=" . $test_menu[0] . "&amp;lang=" . 
			$lang;
	if ($instr) print "&amp;instr=" . $instr;
	if($tabfixfrench) print "&amp;tabfixfrench=" . $tabfixfrench;
	if ($test) print "&amp;test=" . $test;
        print "\">&nbsp;" . $string . "&nbsp;\n";
	print "</a></dt>\n";

if ($i2 > 0) { 
	print "<dd>\n";
	for ($i=1; $i <= $i2 ; $i++) {
		$string = $test_lang[$i];
		$string1 = ersetzeUmlaute($string,0);

	    print "<a class=\"submenu\" href=\"index.php?id=" . $id1 . "&amp;type=" . 
			$test_menu[$i] . "&amp;lang=" . $lang ;
		if ($id1 == 1 && $test_menu[$i] == 'conc') print "&amp;conc=" . $conc_menu;
		if ($type == "ms" || $type == "ms2" || $type == "ms3") print "&amp;ms=" . $ms;
		if ($instr) print "&amp;instr=" . $instr;
		if($tabfixfrench) print "&amp;tabfixfrench=" . $tabfixfrench;
		if ($test == 1) print "&amp;test=" . $test;
        print "\">" . $string ;
		print "</a>\n";
    
	    }
	print "</dd>\n";
        }

	print "</dl></ul></td>\n";
} 



// --------------------- function draw_menu_sitemap ----------------------------
function draw_menu_sitemap ($font1,$font2,$test_menu,$test_lang,$lang,$id1,$type1,$i2,$test,$instr) {
include_once ("php_inc/func_stringbild.inc.php");

print "<div class=\"sm\"><p class=\"" . $font1 . "\">"; 

$bigsize = "18";
$smallsize = "15";

	$size = $bigsize;
	$col = "b_";	

	$string = $test_lang[0];
	$string1 = ersetzeUmlaute($string,0);
	$img = "img/" . $col . $size .    $string1 . ".png";
	//			$img = ersetzeUmlaute ($img); 
	//			print "erimg: " . $img;
	print "<a class=\"sm_menu\" href=\"index.php?id=" . $id1 . "&amp;type=" . $test_menu[0] . "&amp;lang=" . 
			$lang; 
	if ($instr) print "&amp;instr=" . $instr;
	if ($test) print "&amp;test=" . $test . "\"";
		print ">";
	if (!is_file ($img)) {
//		else print "<img src=\"StringBild.php?name=" . ersetzeUmlaute($test_lang[0],1) . "&size=" . $bigsize . "&col=brown\""; 
//		print "func_stringbild";
		func_stringbild($string,$string1,$bigsize,"brown",0,0);
	}
	print "<img src=\"" . $img  . "\""; 
	print " alt=\"" . $test_lang[0] . "\" border=0></a>\n";


if ($i2 > 0) {
	print "<div class=\"ml20\">\n<span class=\"" . $font2 . "\">";

	for ($i=1; $i <= $i2 ; $i++) {
		$string = $test_lang[$i];
		$string1 = ersetzeUmlaute($string,0);
 		if ($i != "1") print "<br>";
		print "&nbsp;&nbsp;\n<a class=\"sm_menu\" href=\"index.php?id=" . $id1 . "&amp;type=" . 
			$test_menu[$i] . "&amp;lang=" . $lang; 
	if ($instr) print "&amp;instr=" . $instr;
	if ($test) print "&amp;test=" . $test . "\"";
		print ">" . $test_lang[$i] . "</a>";
	}
	print "</span>\n</div></div>\n";
    }
	print "</div>\n";
} 




// Datumfunktionen
function DateiDatum ($file) {
$monate = array(1=>"Januar",
                  2=>"Februar",
                  3=>"M&auml;rz",
                  4=>"April",
                  5=>"Mai",
                  6=>"Juni",
                  7=>"Juli",
                  8=>"August",
                  9=>"September",
                  10=>"Oktober",
                  11=>"November",
                  12=>"Dezember");

$tage = array("Sonntag","Montag","Dienstag","Mittwoch",
  "Donnerstag","Freitag","Samstag");



$FileDate  = filemtime($file);           // Datum von file holen
$FileModDate = date("d. m. Y",$FileDate);   // Datum konvertieren
/*
if ($lang == "deu") {
	$FileModDate = date(", d. m. Y",$FileDate);   // Datum konvertieren
    } else {
	$FileModDate = date ("l") . date(" F d, Y",$FileDate);   // Datum konvertieren
    }
*/
return $FileModDate;

}



function MssNames () {

if (file_exists ("data/MssNames.csv")) {
  $handle = fopen ("data/MssNames.csv", "r");      // Datei zum Lesen Öffnen
}

$current_line= -1; // wegen der Datenzeile, um richtige Anzahl zu erhalten

if ($handle) {
// while
  while ( ($data = fgetcsv ($handle, 10000, ";")) !== FALSE) {
    // Daten werden aus der Datei  in ein Array $data gelesen

      if ($current_line==-1) {
	$intQuantityOfFields = count ($data);
	for ($i = 0; $i < $intQuantityOfFields; $i++) {
	  $content[substr($data[$i],0,11)] = $i;
	}
      }  else {
	$Arr_MssNames[$current_line] = $data[$content["Sigl_short"]];
      }
      $current_line++;
  }

}
if ($handle)     fclose ($handle);

return $Arr_MssNames;
}


function MssNames2 ($Arr_MssNamesFile) {
global $Arr_MssNames2;
$zaehler = 0;

if ($Arr_MssNamesFile) {
	foreach ($Arr_MssNamesFile as $ShortName )
	{ 
	  $Arr_MssNames2[$zaehler] = $ShortName[0];
	  $zaehler++;
	}
}
return $Arr_MssNames2;
}



function MssNamesFile () {
global $mss_RISM, $mss_Sigl_long, $mss_Library, $mss_Name_deu, $mss_Name_eng, $mss_Notes_deu, $mss_Notes_eng, $mss_Provenienz, $mss_Date, $mss_URL, $mss_Instruments, $ArrInstr, $Arr_MssNamesFile;
$stimmt = 0;
$vorhanden = 0;

if (file_exists ("data/MssNames.csv")) {
  $handle = fopen ("data/MssNames.csv", "r");      // Datei zum Lesen Öffnen
}

$current_line= -1; // wegen der Datenzeile, um richtige Anzahl zu erhalten

if ($handle) {
// while
  while ( ($data = fgetcsv ($handle, 10000, ";")) !== FALSE) {
    // Daten werden aus der Datei  in ein Array $data gelesen

      if ($current_line==-1) {
		$intQuantityOfFields = count ($data);
           	for ($i = 0; $i < $intQuantityOfFields; $i++)
	          {
				${'mss_' . substr($data[$i],0,11)} = $i;
              }
   		$current_line++;
      }  
    	else {
			foreach($ArrInstr as $instrx)
			{
				if (in_array($instrx,explode(',',$data[$mss_Instruments])) 
				|| in_array(strtoupper($instrx),explode(',',$data[$mss_Instruments])))
				{
					$stimmt++;
				}
			}
			if ($stimmt == count($ArrInstr)) $vorhanden = 1;
			if ($ArrInstr[0]== 'all' || $vorhanden == 1)	       
			{
				for ($x = 0; $x < $intQuantityOfFields; $x++) 
				{
				   if (isset($data[$x])) $Arr_MssNamesFile[$current_line][$x] = $data[$x];
					  else $Arr_MssNamesFile[$current_line][$x] = NULL;
				 }
				$current_line++;
				$vorhanden = 0;
			}
			$stimmt=0;
	  } 

  }
}
if ($handle)     fclose ($handle);

return $Arr_MssNamesFile;
}


// --------------------------------------------------------------
//
// Funktion: Scroll Titel Ms

function correct_key_short ($key)
{

    switch ($key) {
//                 case "c#": $key = "cis"; break;
//                 case "C#" : $key = "Cis"; break;
//                 case "g#": $key = "gis"; break;
//                 case "G#" : $key = "Gis"; break;
//                 case "d#": $key = "dis"; break;
//                 case "D#" : $key = "Dis"; break;
//                 case "f#": $key = "fis"; break;
//                 case "F#" : $key = "Fis"; break;
                
//                 case "b" : $key = "b"; break;
                case "bb" : $key = "b"; break;
//                 case "Bb" : $key = "Bb"; break;
                case "Es" : $key = "Eb"; break;
//                 case "Eb" : $key = "Eb"; break;
                case "eb" : $key = "eb"; break;
	        default:	      $key = $key;

    }
return $key;
}

function correct_key ($key)
{
    switch ($key) {
                 case "bb" : $key = "b moll"; break;
                case "Bb" : $key = "Bb dur"; break;
                case "Es" : $key = "Eb dur"; break;
                case "Eb" : $key = "Eb dur"; break;
                case "As" : $key = "Ab dur"; break;
                case "Ab" : $key = "Ab dur"; break;
                case "eb" : $key = "eb moll"; break;
                case "cis": $key = "cis moll"; break;
                case "Cis" : $key = "Cis dur"; break;
                case "gis": $key = "gis moll"; break;
                case "Gis" : $key = "Gis dur"; break;
                case "dis": $key = "dis moll"; break;
                case "Dis" : $key = "Dis dur"; break;
                case "fis": $key = "fis moll"; break; // sollte evtl. noch geändert werden
                case "Fis" : $key = "Fis dur"; break;
                case "h" : $key = "h moll"; break;
                case "c" : $key = "c moll"; break;
                case "C" : $key = "C dur"; break;
                case "g" : $key = "g moll"; break;
                case "G" : $key = "G dur"; break;
                case "d" : $key = "d moll"; break;
                case "D" : $key = "D dur"; break;
                case "a" : $key = "a moll"; break;
                case "A" : $key = "A dur"; break;
                case "e" : $key = "e moll"; break;
                case "E" : $key = "E dur"; break;
                case "f" : $key = "f moll"; break;
                case "F" : $key = "F dur"; break;
                case "b" : $key = "b moll"; break;
                case "B" : $key = "Bb dur"; break;
                case "H" : $key = "H dur"; break;

    }
return $key;
}




// --------------------- function ersetzeUmlaute ----------------------------
function ersetzeUmlaute ($ZuErsetzen,$art) {

$suchArr = array("&auml;","&Auml","&ouml;","&Ouml;","&uuml;","&Uuml;","&eacute;"," ","'","´","&OElig;");  
if ($art==0) $ersetzArr = array("ae","Ae","oe","Oe","ue","Ue","e_","_","_","_","OE");
if ($art==1) $ersetzArr = array("ae_ae","Ae_Ae","oe_oe","Oe_Oe","ue_ue","Ue_Ue","eee","_","_","_","OE_OE");

$ZuErsetzen = str_replace ($suchArr,$ersetzArr,$ZuErsetzen);

return $ZuErsetzen;
}


// ---------------------------------------
function UmlauteHTML ($Name) {

$suchArr = array  ("ä","Ä","ö","Ö","ü","Ü","é","è","ë","[U+10C]","[U+10D]","[U+115]","[U+11B]","[U+141]","[U+142]","[U+144]","[U+158]","[U+159]","[U+15B]","[U+17E]");  
$ersetzArr = array("&auml;","&Auml;","&ouml;","&Ouml;","&uuml;","&Uuml;","&eacute;","&egrave;","&euml;","&#268","&#269;","&#277;","&#283;","&#321;","&#322;","&#324;","&#326;","&#344;","&#345;","&#382;");

for ( $x = 0; $x < count ( $suchArr ); $x++ )
{
  $Name = str_replace ( $suchArr[$x], $ersetzArr[$x], $Name );
}

return $Name;
}


function myUrlencode ($Name)
{
$suchArr = array  ('.',',',' ','*');  
$ersetzArr = array('-','-','-','x');

for ( $x = 0; $x < count ( $suchArr ); $x++ )
{
  $Name = str_replace ( $suchArr[$x], $ersetzArr[$x], $Name );
}

return $Name;
}



function UmlauteErsetzen ($Name) {
$suchArr = array  ('ä','Ä','ö','Ö','ü','Ü','é','è','ë',' ',"'",'´','&OElig;','%C5%92','ç');  
$ersetzArr = array('a','A','o','O','u','U','e','e','e','_','_','_','Oe','Oe','c');

for ( $x = 0; $x < count ( $suchArr ); $x++ )
{
  $Name = str_replace ( $suchArr[$x], $ersetzArr[$x], $Name );
}

return $Name;

}


function correct_set_key ($key) {
$suchArr = array  ('#','Dur','Moll','B ','Dis');  
$ersetzArr = array('is','dur','moll','Bb ','Eb');

for ( $x = 0; $x < count ( $suchArr ); $x++ )
{
  $key = str_replace ( $suchArr[$x], $ersetzArr[$x], $key );
}

return $key;

}





function draw_bargos () {
print "<p class=\"c\"><img SRC=\"images/barre_gosset.gif\" width=\"492\" height=\"29\">";
}

function draw_title ($lang,$TextTitel,$size) {
global $TitelZusatz;
global $TitelZusatz1;

draw_bargos();
print "<h2>" . $TextTitel[$lang]["Titel"] . "\n";
If ($TitelZusatz1)    print "<br><span class=\"smh" . ($size+1) . "\">" . $TitelZusatz1 . "</span>\n";

If ($TextTitel[$lang]["UnterTitel"]) {
  print "<br><span class=\"smh" . $size . "\">" . $TextTitel[$lang]["UnterTitel"] . "</span>\n";
}

If ($TitelZusatz[$lang])    print "<br>" . $TitelZusatz[$lang];

print "</h2>\n";

draw_bargos();
print "<br>&nbsp;\n";

}



function Neues_einlesen($num = NULL) 
{
global $Daten_new;
global $lang;
global $type;


$start = 0;
$language1 = NULL;
$num1 = 0;
if (!$num) $num = 0;

$lines = file ("data/new.txt");
if ($lang == "deu") {
	$language = "Deutsch"; 
	$language1 = "Englisch";
	setlocale(LC_TIME, "de_DE");
} 
if ($lang == "eng") {
	$language = "Englisch";
	$language1 = "Deutsch";
}

foreach ($lines as $line_num => $line) {
    $data = explode ("\t", $line);
    $count = count ($data);
    while ($count <= 2) {
       $data [$count] = ' ';
       $count += 1;
    } 

	if ($start == 1 && substr($data[0],0,strlen($language1)) == $language1) {
		break;
	}

	if ($start == 1 && strlen($data[0]) > 1) {
		if ($type == "new") {
		  $Daten_new .= "<dt>&bull;&nbsp;" . $data[0] . "</dt><dd>" . $data[1] . "</dd>\n";
		}
		else {
		  if ($num1+1 > $num) break;
		    $Daten_new .= $data[0] . " " . $data[1];
		  if ($num1+1 != $num)  $Daten_new .= "&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;";
		  $num1 += 1;
		}
	}

	if ($start == 0 && substr($data[0],0,strlen($language)) == $language) {
	  $start = 1; 
	} 

}

return $Daten_new;

} 


function wandle_ArrInstr ($ArrInstr)
{
global $instr;
$zaehler = 0;

	foreach($ArrInstr as $instrx)
			{
				if ($zaehler > 0) $instr .= ",";
				$instr .= $instrx;
				$zaehler++;
			}
 	return $instr;
}


// darüber: Instrumentenauswahl
function show_ArrInstr ()
{
global $ArrInstr;
global $arr_instr_long;
global $lang;
$xzahl = 0;
$zahl = 0;
$Ausgabe = Null;

	$Ausgabe = "\n<div class=\"content1\">\n";

	if (isset ($ArrInstr[0])) {
		if ($lang == "deu") $xzahl = 0;
			else $xzahl = 1;
		$Ausgabe .=  "<p class=\"a14\"  style=\"background-color: #EEDDB9; line-heigth=1.5\"><b>"; 
		$zahl = 0;
		$Ausgabe .=   "&nbsp;" . $arr_instr_long[$ArrInstr[$zahl]][$xzahl] ;
		$zahl++;

		while (isset($ArrInstr[$zahl]) ) { 
			$Ausgabe .=   "<br>&nbsp;" . $arr_instr_long[$ArrInstr[$zahl]][$xzahl] ;
			$zahl++;
		}
		$Ausgabe .= "</b></p>\n";
	}
	return $Ausgabe;
}

