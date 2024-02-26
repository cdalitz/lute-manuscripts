<?php
// include_once ("php_inc/systemfunctions.inc.php"); // Fehlerroutine

include_once ("php_inc/functions.inc.php");

ini_set("default_charset", "iso-8859-1");  /* wegen Kompatibilitaet */

# Variablen abfragen 
$pieceNr = NULL;
$testsvg = 0; // auf 1 setzen, um svgs zu testen!
$test = NULL;
$testversion = 0; // auf 1 setzen, falls Testversion!
$uri = NULL;
$menu_max = 4; // evtl. unnoetig
$ArrInstr = NULL;
$instr = NULL;
$instrument = "";
$instrument1 = "";
$arrMss = NULL;
$arr_mss = NULL;
$Arr_MssNamesFile= NULL;
$Arr_MssNames2= NULL;
$msnr = NULL;
$msvgUpdate = 0;

$filterUsed = 0;


$showinc = 0; // Inzipits anzeigen

$arr_instr = array(
'','all','bl','BL','rl','RL','al','AL','ang','ANG','bg','BG','CT','ACN','en','EN','th','TH','ma','MA','Print','vs','VS','vih','VIH','no','NO','V','FTab','ITab','DTab','STab');

$arr_instr_long = array(
"" =>  array("Alle Quellen","All sources"),
"all" =>  array("Alle Quellen","All sources"),
"bl" =>  array("Barocklaute mit konkordanten Quellen","Baroque lute with concordant sources"),
"BL" =>  array("Barocklautenquellen","Baroque lute sources"),
"rl" =>  array("Renaissancelaute mit konkordanten Quellen","Renaissance lute with concordant sources"),
"RL" =>  array("Renaissancelautenquellen","Renaissance lute sources"),
"al" =>  array("Archiliuto mit konkordanten Quellen","Archiliuto with concordant sources"),
"AL" =>  array("Archiliutoquellen","Archiliuto sources"),
"ang" =>  array("Angelique mit konkordanten Quellen","Angelique with concordant sources"),
"ANG" =>  array("Angeliquequellen","Angelique sources"),
"bg" =>  array("Barockgitarre mit konkordanten Quellen","Baroque guitar with concordant sources"),
"BG" =>  array("Barockgitarrenquellen","Baroque guitar sources"),
"CT" =>  array("Cisterquellen","Cittern sources"),
"ACN" =>  array("Quellen mit Accord Nouveaux","Sources with Accord Nouveaux"),
"EN" =>  array("Quellen mit Ensemblemusik","Sources with ensemble music"),
"th" =>  array("Theorbe mit konkordanten Quellen","Theorbo with concordant sources"),
"TH" =>  array("Theorbequellen","Theorbo sources"),
"ma" =>  array("Mandora mit konkordanten Quellen","Mandora with concordant sources"),
"MA" =>  array("Mandoraquellen","Mandora sources"),
"Print" =>  array("Drucke","Prints"),
"vs" =>  array("Andere Lauteninstrumente mit Konkordanzen","Other lute instruments with concordances" ),
"VS" =>  array("Quellen f&uuml;r andere Lauteninstrumente","Sources for other lute instruments" ),
"vih" =>  array("Viuhela mit konkordanten Quellen","Viuhela with concordant sources"),
"VIH" =>  array("Vihuelaquellen","Vihuela sources"),
"no" =>  array("Notation mit Konkordanzen","Notation with concordances" ),
"NO" =>  array("Quellen mit Notation","Sources with notation" ),
"V"  =>  array("Quellen mit Vokalstimmen","Sources with vocal parts" ),
"FTab" => array("Franz&ouml;sische Tabulatur","French tablature" ),
"ITab" => array("Italienische Tabulatur","Italian tablature" ),
"DTab" => array("Deutsche Tabulatur","German tablature" ),
"STab" => array("Spanische Tabulatur","Spanish tablature" ),
);

//////////////////

$arr_index = array (
array ('index','index','new','about','research'),
array ("listmss","listmss","ms","ms2","ms3","mss","conc"),
array ("about","about","acknow"),
array ("contact","datenschutz"),
array ("links","lute")
);

$arr_index_deu = array (
array ('Index','Index','Neues','Informationen','Forschung'),
array ("Quellen","Auswahl","Einzelquelle","Einzelquelle komplett (ohne Incipits)","Einzelquelle komplett (mit Incipits &ndash; langsam!)", "Alle Quellen","Konkordanzen"),
array ("Infos","&Uuml;ber dieses Projekt","Danksagungen"),
array ("Kontakt","Datenschutzerkl&auml;rung"),
array ("Verweise","Laute")
);

$arr_index_eng = array (
array ('Index','Index','Updates','About','Research'),
array ("Sources","Selection","Single Source","Single Source complete (without incipits)","Single Source complete (with incipits &ndash; slow)","All Sources","Concordances"),
array ("About","About this projekt","Acknowledgements"),
array ("Contact","Privacy Policy (deutsch)"),
array ("Links","Lute")
);



if (isset($_GET['type'])) {
      $type = $_GET['type'];
} else  $type = "index";
      $type1 = $type;

if (isset($_GET['id']) ) {
      $id = $_GET['id'];
	  if (!is_numeric ((int)($id))) $id = 0;  
   } else $id = 0;
if (!isset ($arr_index[$id])) $id = 0;

if (isset($_GET['ms'])) {
      $ms = urldecode($_GET['ms']);
   } else $ms = NULL;

if (isset($_GET['lang'])) {
      $lang = $_GET['lang'];
   } else $lang = 'deu';

if ($lang != 'deu' & $lang != 'eng') $lang = 'deu';
if ($lang == 'deu') $langArr= '1'; 
   else $langArr= 0; 

if (isset($_GET['key'])) {
      $key_orig = urldecode ($_GET['key']);
      $key_short = correct_set_key ($key_orig); 
      $key_short = correct_key_short ($key_short);
      $key = correct_key($key_short); 
//        print "Key " . $key . " - Key_orig " . $key_orig . " - Key_short " . $key_short;
   } else 
   {
    $key = NULL;
    $key_orig = NULL;
    $key_short = NULL;
 }

if (isset($_GET['pieceNr'])) {
      $pieceNr = urldecode($_GET['pieceNr']);
   } else $pieceNr = NULL;

if (isset($_GET['title'])) {
      $title = urldecode($_GET['title']);
   } else $title = NULL;

if (isset($_GET['comp'])) {
      $comp = urldecode($_GET['comp']);
   } else $comp = NULL;


if (isset($_GET['msnam'])) {
      $msnam = urldecode($_GET['msnam']);
   } else $msnam = NULL;

if (isset($_GET['mssABC'])) {
      $mssABC = $_GET['mssABC'];
   } else $mssABC = NULL;


if (isset($_GET['instr']) && strlen($_GET['instr']) > 0) {
$ArrInstr = explode(",",$_GET['instr']);
   } else {
$ArrInstr[0] = 'all';
}

if (isset($_GET['mssSearch'])) {
      $mssSearch = urldecode ($_GET['mssSearch']);
	  if ($mssSearch == '') $mssSearch = NULL;
} else $mssSearch = NULL;

if (isset($_GET['mssDetails']) && $_GET['mssDetails'] == 'yes') {
      $mssDetails = "yes";
} else $mssDetails = NULL;

if (isset($_GET['msvgType'])) {
      $msvgType = $_GET['msvgType'];
} else $msvgType = 0;



$zaehler1 = 0;
$zaehler2 = 0;
$ArrInstr2 = NULL;

foreach ($ArrInstr as $InstrTest){ 
   if (in_array($InstrTest,$arr_instr)) 
   {
	$ArrInstr2[$zaehler2] = $InstrTest;
        $zaehler2++;
   }
   $zaehler1++;	
//   echo "ArrInstr = $InstrTest   ";
}

$zaehler3 = 0;
$ArrInstr = $ArrInstr2;
if (!$ArrInstr) $ArrInstr[0] = 'all';
$instr = wandle_ArrInstr($ArrInstr);


if (!isset($instr) &! strlen ($instr) > 0) 
  $instr = 'all';

// Nur zum Test
// print "Arr1" . $ArrInstr[0] . " Instr: " . $instr;



if (isset($_GET['abcinc']) && strlen($_GET['abcinc']) > 0) {
      if (strstr($_GET['abcinc'],'|')) 
      {
        $abcinc_mode = 0;
      } else { 
	$abcinc_mode = 1;
      }

      if (strstr($_GET['abcinc'],'x')) 
      {
	$inc_area = substr ($_GET['abcinc'], strpos ($_GET['abcinc'],' x') +2);
  	$abcincx = substr ($_GET['abcinc'], 0, strlen ($_GET['abcinc']) - (strlen ($inc_area) +2));
 	$abcinc = explode(" ",$abcincx);
       } else  {
       $abcinc = explode(" ",$_GET['abcinc']);
       $inc_area = NULL;
      }
//  echo "<" . $abcinc[0] . " " . $abcinc[1] . ">";
   } else { 
      $abcinc = NULL;
      $inc_area = NULL;
}



if (isset($_GET['conc']) && $_GET['conc'] > '') {
    $conc = urldecode($_GET['conc']);
	$concURL = $conc;
    if (!preg_match('/_|R|M/', $conc[0]))
	{
		if (!preg_match ("/^\d{1,4}$/",$conc)){	
			$temp_conc = 1;
		} else $temp_conc = $conc;
		$conc = "_" . $temp_conc;
	} 
	else 
	{
// Falls Unterbuchstaben sinnvoll eingesetzt werden koennen
/*
		if (preg_match('/[a-z]/',substr($conc,-1,1))) {
			if (preg_match('/^\d{1,4}$/',substr($conc,1,-1)))
				$conc = $conc[0] . substr($conc,1);
		} else {
*/
			if (preg_match('/^\d{1,4}$/',substr($conc,1)))
				$conc = $conc[0] . substr($conc,1);
			else $conc = $conc[0] . "1";			
/*		} */
	}
     $concStart = $conc;
}  else $conc = NULL;


if (isset($_GET['showinc'])) {
      $showinc = $_GET['showinc'];
   }  else $showinc = 1;



if (isset($_GET['page'])) {
      $page = $_GET['page'];
   }  else $page = NULL;



if (isset($_GET['st'])) {
      $start = (int)$_GET['st'];
   } else {
      $start = 0; 
}


if (isset($_GET['test'])) {
      $test = $_GET['test'];
   } else {
      if (isset($test)) $test = 0;
}

if ($testversion == 0) $test = 0;


if (isset($_GET['nm'])) {
      $number = (int)$_GET['nm'];
//	  if (!is_numeric ($number)) $number = 10;  
   } else {
   if ($type == "conc") $number = 100;
   else if ($type == 'ms2' || $type == 'ms3')   $number = 1000;
   else $number = 10;
}

//	if (isset($_GET['showmss'])) {
//	      $boolShowExistingMss = $_GET['showmss'];
//	   } else {
//	      $boolShowExistingMss = 0;
//	}

if (isset($_GET['exFilter'])) {
      $boolExFilter = $_GET['exFilter'];
   } else {
      $boolExFilter = 0;
}

if (isset($_GET['testms'])) {
      $test_ms = "1";
   } else {
      if (isset($test_ms)) unset ($test_ms);
}


if (isset($_GET['tun'])) {
      $Tuning = $_GET['tun'];
   } else {
      $Tuning = "1";
}

if (isset($_GET['new'])) {
      $new = "1";
   } else {
      if (isset($new)) unset ($new);
}

if (isset($_GET['nomenu'])) {
      $nomenu = "1";
   } else {
      if (isset($nomenu)) unset ($nomenu);
      $nomenu = "0";
}

/* usesvg = 1 enables SVG generation
if (isset($_GET['testsvg']) || is_file ("php_inc/testsvg")) {
      $usesvg = 1;
   } else {
      if (isset($usesvg)) unset ($usesvg);
      $usesvg = 0;
}
*/
$usesvg = 1;

if (isset($_GET['forceMsvg'])) {
      $forceMsvg = 1;
   } else {
	$forceMsvg = 0;
}
 
if (isset($_GET['viewConc'])) {
      $viewConc = 1;
   } else {
	$viewConc = 0;
}
 


if (isset($_GET['tabfixfrench']) && $_GET['tabfixfrench'] != "0") {
      $tabfixfrench = "1";
   } else {
      if (isset($tabfixfrench)) unset ($tabfixfrench);
}


// setlocale ("de_De");


include ("php_inc/manuscript_sys.php");
include ("php_inc/listmss_sys.inc.php");


$arr_index1 = $arr_index;

if (!in_array($type, $arr_index1[$id]) || !$type) $type = $arr_index[$id][0];

if ($type === 'ms' || $type === 'ms2' || $type === 'ms3' ) 
{
	if (!$ms) $ms = 'Abondante1546';
	$htmltitle = $ms . ' ';
	if ($type === 'ms2') 
		$htmltitle .= ($lang === 'deu')?'komplett ohne Incipits ':'complete without incipits ';
	if ($type === 'ms3') 
		$htmltitle .= ($lang === 'deu')?'komplett mit Incipits ':'complete with incipits ';
}
else 
{
	if ($type === 'conc') 
	{
		$htmltitle = 'Conc' . $conc . ' &ndash; ';
		$htmltitle .= ($lang === 'deu')?'Konkordanzen ':'Concordances ';
	}
	else $htmltitle = ${"arr_index_" . $lang}[$id][array_search($type, $arr_index[$id])];
}





include ("php_inc/head.inc.php");

if (!$nomenu) {
	include ("php_inc/menu.inc.php"); 
	// ----------------------------------------------------------------
	// show content
	print "<div id=\"container\">";
	print "<div class=\"content\">";
} else 
	print "</div><div class=\"content_all\">\n<a name=\"top\"></a>";

if ($id == "1" && $type!="listmss") {
	if ($testversion == "0") {
	  include ("php_inc/manuscript.inc.php"); 
	} else { include ("php_inc/manuscript1.inc.php");}
} 
else if ($id == "4") {
  include "php_inc/links.inc.php";
}
else {
  include "php_inc/" . $type . ".inc.php";
}

// show copyright

?>
<p class="imp">
<br>&nbsp;
<b>Copyright &copy; 
<?php
	if (date("Y") == "2009") print "2009";
	else print "2009-" . date("Y");

?>

Peter Steur, Markus Lutz</b>
<br>
<?php


// show searchbox

if ($id == 1) {
	print "</div>";  // Ende div.content
	print "<div class=\"searchbox\">";
	include "php_inc/forms.php";
	print "</div>";
} else print "</div>";

print "</div>";
include ("php_inc/bottom.inc.php");

?>
