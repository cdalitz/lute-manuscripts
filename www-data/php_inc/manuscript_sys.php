<?php

// **************** class DATAsort - Sortierfunktionen, wird eingebunden von MssConc und MssMs
class DATAsort
{

static $sortKey;
static $way_of_sorter;

public static function sorter_digits ( $a, $b )
    {
    if (($a->{self::$sortKey} == $b->{self::$sortKey})  && ($a->{self::$sortKey} != "" || $a->{self::$sortKey} != "")) 
        return 0;
    else if ($a->{self::$sortKey} < $b->{self::$sortKey}) 
        return -1;
    else 		// (if ($a->Smith=="" || $a->Smith==0 ))
        return 1;
     }

public static function sorter_strcasecmp ( $a, $b )
    {
    return strcasecmp( $a->{self::$sortKey}, $b->{self::$sortKey} );
    }

public static function sorter_strcmp ( $a, $b )
    {
    return strcmp( $a->{self::$sortKey}, $b->{self::$sortKey} );
    }

public static function sortByProp ( &$collection, $prop, $way_of_sorter )
    {
        self::$sortKey = $prop;
        usort( $collection, array( __CLASS__, 'sorter_'  . $way_of_sorter ) );
    }

}
// **************** Ende class DATAsort - Sortierfunktionen, wird eingebunden von MssConc und MssMs


// **************** class MssMs mit Sortierfunktionen
// PieceNr;Key;PageNr;Name;Composer;Comment;Tuning;Concordances

// PieceNr;Key;PageNr;Name;Composer;Comment;Tuning;Concordances;TimeInz;Tab



class MssMs extends DATAsort
{
public $MsPieceNr;
public $MsKey;
public $MsPageNr;
public $MsName;
public $MsComposer;
public $MsComment;
public $MsTuning;
public $MsConcordances;
public $MsTimeInz;
public $MsTab;
public $MsTabNotation;


public function __construct($MsPieceNr, $MsKey, $MsPageNr, $MsName, $MsComposer, $MsComment, $MsTuning, $MsConcordances, $MsTimeInz, $MsTab, $MsTabNotation)
    {
    $this->MsPieceNr =  $MsPieceNr;
    $this->MsKey =  $MsKey;
    $this->MsPageNr = $MsPageNr; 
    $this->MsName =  $MsName; 
    $this->MsComposer =  $MsComposer;
    $this->MsComment =  $MsComment;
    $this->MsTuning =  $MsTuning;
    $this->MsConcordances =  $MsConcordances;
    $this->MsTimeInz =  $MsTimeInz;
    $this->MsTab =  $MsTab;
    $this->MsTabNotation =  $MsTabNotation;

    }  
}
// **************** Ende class MssMs mit Sortierfunktionen


// **************** class MssConc mit Sortierfunktionen
// Concordances.csv: Conc_Nr;Composer;WorkNr;Modern Ed;Concordances;Comment


class MssConc extends DATAsort
{
public $ConcNr;
public $ConcComposer;
public $ConcWorkNr;
public $ConcModernEd;
public $ConcConcordances;
public $ConcComment;


public function __construct($ConcNr, $ConcComposer, $ConcWorkNr, $ConcModernEd, $ConcConcordances, $ConcComment)  
  {
    $this->ConcNr = $ConcNr;
    $this->ConcComposer = $ConcComposer;
    $this->ConcWorkNr = $ConcWorkNr;
    $this->ConcModernEd = $ConcModernEd;
    $this->ConcConcordances = $ConcConcordances;
    $this->ConcComment = $ConcComment;

  }


public function __toString()
  {
    return "MssConc [ConcNr = '$this->ConcNr', ConcComposer = '$this->ConcComposer', ConcWorkNr = '$this->ConcWorkNr', ConcModernEd = '$this->ConcModernEd', ConcConcordances = '$this->ConcConcordances',
    ConcComment = '$this->ConcComment]'";
  }

}
// **************** Ende class MssConc mit Sortierfunktionen



// **************** Funktion class MssConc einlesen und erstellen

/*
function make_MssConc($all=NULL)
{
$arr_MssConc = [];

        $header = null;
	$filename = "data/Concordances.csv";
        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 10000, ";")) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $arr_MssConc[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
	return $arr_MssConc;
}

*/


function make_MssConc($all=NULL)
{
$row = 0;                                      // Anzahl der Datens&auml;tze
$arr_MssConc = NULL;

$handle = fopen ("data/Concordances.csv","r");              // Datei zum Lesen &ouml;ffnen

 while ( ($data = fgetcsv ($handle, 10000, ";") ) !== FALSE ) { 
    	if ($data[0] == "Conc_Nr") {  //Header line  
	  $intQuantityOfFields = count ($data);
	    for ($i = 0; $i < $intQuantityOfFields; $i++)
	    {
	      $content[substr($data[$i],0,12)] = $i;
	    }

	} else  {


//Conc_Nr;Composer;WorkNr;Modern Ed;Concordances;Comment




      if (!isset($data[$content["Conc_Nr"]])) $data[$content["Conc_Nr"]] =  NULL;
      if (!isset($data[$content["Composer"]])) $data[$content["Composer"]] = NULL; 
      if (!isset($data[$content["WorkNr"]])) $data[$content["WorkNr"]] = NULL;
      if (!isset($data[$content["Modern Ed"]])) $data[$content["Modern Ed"]] = NULL;
      if (!isset($data[$content["Concordances"]])) $data[$content["Concordances"]] = NULL;
      if (!isset($data[$content["Comment"]])) $data[$content["Comment"]] = NULL;


       $arr_MssConc[$row] = new MssConc($data[$content["Conc_Nr"]], $data[$content["Composer"]], $data[$content["WorkNr"]],$data[$content["Modern Ed"]],
		      $data[$content["Concordances"]], $data[$content["Comment"]]); 



      $row += 1;
      }
    }
  

 fclose ($handle);
 return $arr_MssConc;
}

// **************** class MssNames mit Sortierfunktionen
// Sigl_short	RISM	Sigl_long	Library	Name_deu	Notes_deu	Notes_eng	Name_eng	Provenienz	Date	URL	Instruments


class MssNames extends DATAsort
{
public $Sigl_short;
public $RISM;
public $Sigl_long;
public $Library;
public $Name_deu;
public $Notes_deu;
public $Notes_eng;
public $Name_eng;
public $Provenienz;
public $Date;
public $URL;
public $Instruments;


public function __construct ($Sigl_short, $RISM, $Sigl_long, $Library, $Name_deu, $Notes_deu, $Notes_eng, $Name_eng, $Provenienz, $Date, $URL, $Instruments)    
	{
    $this->Sigl_short =  $Sigl_short;
    $this->RISM =  $RISM;
    $this->Sigl_long = $Sigl_long; 
    $this->Library =  $Library; 
    $this->Name_deu =  $Name_deu;
    $this->Notes_deu =  $Notes_deu;
    $this->Notes_eng =  $Notes_eng;
    $this->Name_eng =  $Name_eng;
    $this->Provenienz =  $Provenienz;
    $this->Date =  $Date;
    $this->URL =  $URL;
    $this->Instruments =  $Instruments;

    }  
}

// **************** Ende class MssNames mit Sortierfunktionen





// **************** Funktion class MssNames einlesen und erstellen
// $MssSigl_short, $MssRism, $MssSigl_long, $MssLibrary, $MssName_deu, $MssNotes_deu, $MssNotes_eng, $MssName_eng, $MssProvenienz, $MssDate, $MssURL, $MssInstruments

/*
function make_MssNames($all=NULL)
{
$row = 0;                                      // Anzahl der Datens&auml;tze
$arr_MssNames = NULL;

$handle = fopen ("data/MssNames.csv","r");              // Datei zum Lesen &ouml;ffnen

 while ( ($data = fgetcsv ($handle, 10000, ";") ) !== FALSE ) { 
    	if ($data[0] == "Sigl_short") {  //Header line  
	  $intQuantityOfFields = count ($data);
	    for ($i = 0; $i < $intQuantityOfFields; $i++)
	    {
	      $content[substr($data[$i],0,12)] = $i;
	    }

	} else  {

/*


 */
/*
      if (!isset($data[$content["Sigl_short"]])) $data[$content["Sigl_short"]] = "";
      if (!isset($data[$content["RISM"]])) $data[$content["RISM"]] = ""; 
      if (!isset($data[$content["Sigl_long"]])) $data[$content["Sigl_long"]] = NULL;
      if (!isset($data[$content["Library"]])) $data[$content["Library"]] = NULL;
      if (!isset($data[$content["Name_deu"]])) $data[$content["Name_deu"]] = NULL;
      if (!isset($data[$content["Notes_deu"]])) $data[$content["Notes_deu"]] = NULL;
      if (!isset($data[$content["Notes_eng"]])) $data[$content["Notes_eng"]] = NULL;
      if (!isset($data[$content["Name_eng"]])) $data[$content["Name_eng"]] = NULL;
      if (!isset($data[$content["Provenienz"]])) $data[$content["Provenienz"]] = NULL; 
      if (!isset($data[$content["Date"]])) $data[$content["Date"]] = NULL; 
      if (!isset($data[$content["URL"]])) $data[$content["URL"]] = NULL; 
      if (!isset($data[$content["Instruments"]])) $data[$content["Instruments"]] = NULL; 


       $arr_MssNames[$row] = new MssNames($data[$content["Sigl_short"]], $data[$content["RISM"]], $data[$content["Sigl_long"]],$data[$content["Library"]], $data[$content["Name_deu"]], $data[$content["Notes_deu"]], $data[$content["Notes_eng"]], $data[$content["Name_eng"]], $data[$content["Provenienz"]], $data[$content["Date"]], $data[$content["URL"]], $data[$content["Instruments"]]); 


      $row += 1;
      }
    }
  

 fclose ($handle);
 return $arr_MssNames;
}

*/

function make_MssNames($all=NULL)
{
$arr_MssNames = [];

        $header = null;
	$filename = "data/MssNames.csv";

        if (($handle = fopen($filename, 'r')) !== false) {
            while (($row = fgetcsv($handle, 10000, ";")) !== false) {
                if (!$header) {
                    $header = $row;
                } else {
                    $arr_MssNames[] = array_combine($header, $row);
                }
            }
            fclose($handle);
        }
	return $arr_MssNames;
}





// ***************************************** Smith-Nummern sortieren und anzeigen *****************************************
function SLWsortieren ($arr_SLWwork, $prop, $type=Null) 
{
if ($type == NULL) $type = 'digits';
 
SLWwork::sortByProp ( $arr_SLWwork, $prop, $type );
// if ($prop == "Smith") $end_i = 580; else 
$end_i = count($arr_SLWwork);
$new_row = 0;
if ($prop == 'Smith')  {
	$prop_max = 580;
}
if ($prop == 'Klima')  {
	$prop_max = 437;
}



for ($i = 0;  $i < $end_i; $i++) {
	if ($arr_SLWwork[$i]->$prop && ($arr_SLWwork[$i]->$prop <= $prop_max) 
		&& (!$arr_SLWwork[$i]->Zusatz || strstr($arr_SLWwork[$i]->Zusatz,$prop))) 
	{
		$arr_SLWwork1[$new_row] = $arr_SLWwork[$i];
            	$new_row++;
	}
}


return $arr_SLWwork1;
}


// ***************************************** Konkordanzen auslesen und anzeigen *****************************************
//	RISM wird ausgelesen  

function sort_Conc($arr_MssConc,$treffer,$type_int = NULL)
{

    global $conc_bool;
    global $CurrentMs;
    global $set_page;
    global $set_conc;
    global $type;
    global $lang;
    global $instr;
    global $test;
    global $test_expression;
    global $ms;
    global $id;
    global $msAllConcordances;
	$isRISM = 0;

    $concordances = $arr_MssConc->ConcConcordances;
    $ConcNr1 = $arr_MssConc->ConcNr;
    $conc_sort = NULL;
    $count_conc = "1";
    $disp_conc=NULL;
    $conc_all = explode(" - ",$concordances);
    natsort ($conc_all);

    foreach($conc_all as $conc_abc)
    {
		if (strstr($conc_abc," / ")) $conc_ms = substr($conc_abc,0,strpos($conc_abc," / "));
			else $conc_ms = $conc_abc;

// print $conc_ms . " TEST \n";

		$conc_page = substr($conc_abc,strpos($conc_abc," / ")+3);
		if (strstr($conc_page," ") OR strstr($conc_page,"(")) 
		{ 
			if (strstr($conc_page," ")) $conc_page1 = substr($conc_page,0,strpos($conc_page," "));
			else $conc_page1 = substr($conc_page,0,strpos($conc_page,"("));
		}	else $conc_page1 = $conc_page;
		
		if ($conc_ms == $CurrentMs && $conc_page1 == $set_page && $set_conc == $ConcNr1 ) {
			$disp_conc = 0; 
			$msAllConcordances[1]++;
		} else $disp_conc = 1;
		if ($type_int == "conc") $disp_conc = 1;
			$conc_link = "index.php?id=" . $id . "&amp;type=ms&amp;lang=". $lang . "&amp;ms=" 
						. UmlauteErsetzen($conc_ms) . "&amp;page=" . UmlauteErsetzen($conc_page1) . "&instr=" . $instr;
		if ($test && $test == 1) $conc_link .= $test_expression ;

	// RISM-Nummern bearbeiten
		if (strncmp (substr($conc_abc,0,4),'RISM',4) == 0) { 
			if (strstr($conc_abc," ")) {
				$conc_ms = substr($conc_abc,4,strpos($conc_abc," ")-4);
				$conc_page = substr($conc_abc,strpos($conc_abc," "));
			}
			else {
				$conc_ms = substr($conc_abc,4);	
				$conc_page = "";
			}
			$conc_link = "https://opac.rism.info/search?id=" . $conc_ms;
			$conc_ms = 'RISM' . $conc_ms;
			$isRISM = 1;
	// print $conc_abc . " Conclink " . $conc_link . " Strlen: " . substr($conc_abc,4, strlen($conc_abc)-4);
		}

	 	if (is_file ("mss/" . UmlauteErsetzen($conc_ms) . ".csv") || $isRISM == 1) {
			if (substr($conc_abc,0,2) == 'cf') { ; }
			else if ($disp_conc == 1) {
				if ($count_conc != "1") $conc_sort .= " | \n"; 
				if ($type_int == "com") 
				{ 
					$conc_sort .= $count_conc . ".&nbsp;";
					$conc_sort .= "<a class=\"comm\" href=\"" . $conc_link . "\" target=\"_new\">" . $conc_ms . "</a>";

					if ($isRISM == 0)	$conc_sort .= "&nbsp;/&nbsp" . str_replace(" ","&nbsp;",$conc_page) 
							. "&nbsp;&nbsp;";
					else $conc_sort .= "&nbsp;" . $conc_page . "&nbsp;&nbsp;";
				} 
				else 
				{
					$conc_sort .= "<b>" . $count_conc . ".&nbsp;</b>";
					$conc_sort .= "<a href=\"" . $conc_link . "\" target=\"_new\">" . $conc_ms . "</a>";

					if ($isRISM == 0)	$conc_sort .= "&nbsp;/&nbsp" . str_replace(" ","&nbsp;",$conc_page) 
								. "&nbsp;&nbsp;";
					else $conc_sort .= "&nbsp;" . $conc_page . "&nbsp;&nbsp;";

				}
			} else {
				$count_conc--;
			}
		} else {
			if (substr($conc_abc,0,2) == 'cf') { ; }
			else {
			  if ($count_conc != "1") $conc_sort .= " | \n"; 
			if ($type == "com") $conc_sort .= $count_conc . ".&nbsp;";
			  else $conc_sort .= "<b>" . $count_conc . ".&nbsp;</b>";
			}
			$conc_sort .= str_replace(" ","&nbsp;",$conc_abc) . "&nbsp;&nbsp;";
		}
// test: Konkordanzen eines Manuskriptes sammeln
	    if ($disp_conc == 1) { 
			$msAllConcordances[0] .= $conc_ms . ' - ';
		}

		$count_conc ++;

		$isRISM = 0;
    }
// $conc_sort .= "<br>" . $type_int . "<br>";
if ($count_conc == 1) 
	if ($lang == 'deu') $conc_sort = "Keine Konkordanz";
		else $conc_sort = "No concordance";

$arrConc_sort[0] = $conc_sort;
$arrConc_sort[1] = $count_conc;
return $arrConc_sort;
}

// ***************************************** Daten aufteilen  *****************************************
function aufteilen ($count,$number)
{
  global $start;
  global $ReqURI;
  $ausgabe1 = NULL;
  if ($count > $number) {
    $link  = str_replace ("&st=" . $start ,"",$ReqURI);

    $ausgabe1 .= "<hr><center>";
    for ($i = 0 ; $i < ($count / $number) ; $i += 1) {
	if (($number * $i) != $start) { 
		$ausgabe1 .=  "<a href=\"" . $link;
  		$ausgabe1 .=  "&amp;st=" . $i * $number ;
  		$ausgabe1 .=  "\">" ;
  		$ausgabe1 .= ($i * $number +1);
	} else {
	  	$ausgabe1 .= "<b>" . ($i * $number +1) . "</b>";
  	} 
	if (($number * $i) != $start) {   
  		$ausgabe1 .= "</a>\n";
	}
 		$ausgabe1 .= " ";
    }
    $ausgabe1 .=  "<hr></center><br>";
  }

  return $ausgabe1;
}


// ***************************************** ms_link  *****************************************
function ms_link ($ms)
{
	global $lang;
	global $id;

	$ms_link = "<a href=\"index.php?id=" . $id . "&amp;type=ms&amp;lang=". $lang . "&amp;ms=" . UmlauteErsetzen($ms) . "\">" . $ms . "</a>";

	return $ms_link;
}


// ***************************************** abcinc_cmp  *****************************************
function abcinc_cmp ($arr_abcinc, $set_tab, $inc_area= NULL, $abcinc_mode= NULL)
{
	global $Daten;
	global $test;

// if (substr ($set_tab,0,5) == " | | ") 
//	$set_tab = substr ($set_tab,5);   // neu 20.08.2014
	$set_tab = str_replace ("%%tabunderscoreis8", "", $set_tab);   // neu 26.04.2022



if ($set_tab[0] == " ") $set_tab = substr ($set_tab,1);   // neu 20.08.2014
if ($set_tab[0] == "|") $set_tab = substr ($set_tab,1);   // neu 20.08.2014
if ($set_tab[0] == " ") $set_tab = substr ($set_tab,1);   // neu 20.08.2014
if ($set_tab[0] == "|") $set_tab = substr ($set_tab,1);   // neu 20.08.2014
if ($set_tab[0] == " ") $set_tab = substr ($set_tab,1);   // neu 20.08.2014

//	if ($set_tab[0] == " ") print "Leerzeichen am Anfang"; 
//	if ($set_tab[0] == "|") print "Takt am Anfang"; 

//	Strings in Anführungszeichen löschen, eingefügt 10.04.2019
	$pattern = "/\"[^\}]*\"/";
	$replace = '';
	$set_tab = preg_replace($pattern, $replace, $set_tab);

//	Zeilenenden etc. löschen, eingefügt 10.04.2019
	$pattern = "/\\|\n|\r|\t/";
	$set_tab = preg_replace($pattern, $replace, $set_tab);
	$pattern = "/<|>/";
	$replace = ' ';
	$set_tab = preg_replace($pattern, $replace, $set_tab);

/*	
//	alt, ersetzt durch oben
	$set_tab = str_replace ("\\", "", $set_tab);   // neu 22.02.2014
	$set_tab = str_replace ("\n ", "", $set_tab);   // neu 22.02.2014
	$set_tab = str_replace ("\r ", "", $set_tab);   // neu 22.02.2014
	$set_tab = str_replace ("\t ", "", $set_tab);   // neu 22.02.2014
	$set_tab = str_replace (">", " > ", $set_tab);   // neu 12.03.2014
	$set_tab = str_replace (">", "", $set_tab);   // neu 12.03.2014
*/

if ($abcinc_mode == 1) 	$set_tab = str_replace ("|", "", $set_tab);   // neu 21.08.2014
	$set_tab = str_replace ("y",",", $set_tab);   // neu 01.05.2020
	$set_tab = str_replace ("L","", $set_tab);   // neu 01.05.2020
	$set_tab = str_replace ("|", " | ", $set_tab);   // neu 18.08.2014
	$set_tab = str_replace ("]", "] ", $set_tab);   // neu 19.08.2014
//	$set_tab = str_replace ("[", " [", $set_tab);   // neu 19.08.2014
	$set_tab = str_replace ("(3", "", $set_tab);   // Triolen loeschen -  neu 22.02.2014
	$set_tab = str_replace ("(", "", $set_tab);   // Klammer loeschen -  neu 19.08.2014
	$set_tab = str_replace (")", "", $set_tab);   // Klammern loeschen -  neu 19.08.2014
	$set_tab = str_replace ("  ", " ", $set_tab);   // neu 22.02.2014
	$set_tab = str_replace ("  ", " ", $set_tab);   // verdoppelt 20.08.2014
	$set_tab = str_replace ("  ", " ", $set_tab);   // und nochmals 20.08.2014
	$set_tab = str_replace ("!strumup!", "", $set_tab);   // neu 12.11.2020
	$set_tab = str_replace ("!strumdown!", "", $set_tab);   // neu 12.11.2020
	$set_tab = str_replace (".", "", $set_tab);   // neu 27.05.2021

//	if ($set_tab && strstr ($set_tab,"  ")) print "\nDoppelte Leerzeichen\n"; 


	$arr_settab = explode  (" ", $set_tab);
	$count_set = count ($arr_settab) -1;  // -1 um Fehler zu vermeiden ...
	$count_abcinc = count ($arr_abcinc);
	if (!$inc_area) $inc_area = $count_abcinc;
		else $inc_area = $count_abcinc + (int) $inc_area;
	$treffer = 0;
	$zaehler = 0;
	$zaehler1 = $count_abcinc;
	
	foreach ($arr_abcinc as $abcinc) {
	  while ($zaehler < $count_set && $zaehler < $inc_area) {
	    if ($arr_settab[$zaehler] == ',') { $zaehler1++; $zaehler++; }

// orig - am 20.08.2014 gekuerzt //   if (strncmp ($abcinc,preg_replace('/[0-9]\s|[0-9]\]|[0-9]\/[0-9]|[\s\\\\\/\(\)\'\#UVX\]\[\>\:]/', '', $arr_settab[$zaehler]),strlen($abcinc)) == 0) {

	    if (strncmp ($abcinc,preg_replace('/[0-9]\s|[0-9]\]|[0-9]\/[0-9]|[\s\\\\\/\'\#+UVX\]\[\:]/', '', $arr_settab[$zaehler]),strlen($abcinc)) == 0) {
		$treffer++;

// if ($test == 1)		$Daten .= "\rarr_settab[" . $zaehler . "] = " . $arr_settab[$zaehler] . " -> " . preg_replace('/[0-9]\s|[0-9]\]|[0-9]\/[0-9]|[\s\\\\\/\(\)\'\#UV\]\[\>\:]/', '', $arr_settab[$zaehler]) . "\r";
		$zaehler++;
		break;
	    } else $zaehler++; 
	  }
//	  if ($treffer == 3) break;
 	}

// 		nur zum Test, 22.02.2014
//	$settab1 = preg_replace('/[0-9]\s|[0-9]\]|[0-9]\/[0-9]|[\s\\\\\/\(\)\'\#UVX\]\[\>\:]/', '', $settab);
//       if ($treffer >= $count_abcinc) print $settab1;

	if ($treffer >= $count_abcinc) return TRUE;
	  else return FALSE;
}

// ******************** svg-Dateien darstellen ********************
function extractStringBetween($strFirstWord, $strSecondWord, $sString)
{
//	echo "test";    
	preg_match_all ("/".$strFirstWord. "(.*?)" . $strSecondWord ."/", $sString, $aMatches);
    return $aMatches;
}

function splitString ($strFirstWord, $strSecondWord, $sString)
{
//	echo "test";    
	$svgs = preg_split ( "/".$strFirstWord. "(.*?)" . $strSecondWord ."/",$sString);
//	echo $svgs;
//  print_r ($svgs);
    return $svgs;
}


// ************************ show_msvg0 (eine Datei) *************************************
function show_msvg0 ($ms,$incNr,$msNr,$msPage) 
{
global $IncDir1;
$svgBild = NULL;
$splitPiece = " - ";
$pieceNr = NULL;
global $msPieces;
global $msSVGs ;


/*
	$ms_svg = file_get_contents($IncDir1 . "/" . $ms . ".msvg");              // Datei zum Lesen &ouml;ffnen
// echo $ms_svg;
	$msPieces = extractStringBetween ('<piece>','<\/piece>',$ms_svg);
	$msSVGs = splitString ('<piece>','<\/piece>',$ms_svg);
	// print_r ($msBilder);
	// print_r ($msSVGs);
*/
	$i=1;
	foreach ($msPieces[1] as $msPieces1) {
		$pieceNr = explode ($splitPiece, $msPieces1);
		if ($pieceNr[1] === $msNr /* && myUrlencode($pieceNr[2]) === myUrlencode($msPage) */) {
//		echo $i . ": " . $pieceNr[0] . " " .  $pieceNr[1] . " " .  $pieceNr[2] . " Nr: " . $msNr . " Page: " . $msPage . "<br>";
//		echo "<br>" . $i . ". Durchlauf<br>";
			$svgBild =  $msSVGs[$i];
			break;
		}
		$i++;
	} 
	if (!$svgBild) $svgBild = "Kein Incipit gefunden";	
//	echo $svgBild;
	return $svgBild;
}

// ************************ show_msvg1 (aufgeteilt) *************************************
function show_msvg1 ($ms,$incNr,$msNr,$msPage) 
{
global $IncDir1;
global $start;
$svgBild = NULL;
$splitPiece = " - ";
$ms_svg = NULL;
$msPieces = NULL;
$msSVGs = NULL;
$pieceNr = NULL;

$incNr = $incNr + $start;

switch ($incNr) 
{
	case ($incNr <= 99): $hundert = "";
						 $hundzahl = 0;
							break;
	case ($incNr <= 199): $hundert = "-1";
						 $hundzahl = 1;
							break;
	case ($incNr <= 299): $hundert = "-2";
						 $hundzahl = 2;
							break;
	case ($incNr <= 399): $hundert = "-3";
						 $hundzahl = 3;
							break;
	case ($incNr <= 499): $hundert = "-4";
						 $hundzahl = 4;
							break;
	case ($incNr <= 599): $hundert = "-5";
						 $hundzahl = 5;
							break;
	case ($incNr <= 699): $hundert = "-6";
						 $hundzahl = 6;
							break;
	case ($incNr <= 799): $hundert = "-7";
						 $hundzahl = 7;
							break;
	case ($incNr <= 899): $hundert = "-8";
						 $hundzahl = 8;
							break;
	case ($incNr <= 999): $hundert = "-9";
						 $hundzahl = 9;
							break;
}


//	echo "<p><b>Anzeige des Manuskriptes $ms mit Incipits</b></p>"; 

	$ms_svg = file_get_contents($IncDir1 . "/" . $ms[0] . "/" . $ms . $hundert . ".msvg");              // Datei zum Lesen &ouml;ffnen

// echo $ms_svg;

	$msPieces = extractStringBetween ('<piece>','<\/piece>',$ms_svg);
	$msSVGs = splitString ('<piece>','<\/piece>',$ms_svg);

// print_r ($msPieces);
// print_r ($msSVGs);

	$i= $incNr - ($hundzahl * 100) -5;
	if ($i < 0) $i = 0;
//	$svgBild = "i=" . $i . " IncNr=" . $incNr . " Start=" . $start . " Datei=" . $IncDir1 . "/" . $ms[0] . "/" . $ms . $hundert . ".msvg" . "<br>";

// $svgBild = $i . " - IncNr " . $incNr;


$iplus = $i;

	while ($msPieces[1][$iplus]) {

// print $msPieces[1][$i+1];

		$pieceNr = explode ($splitPiece, $msPieces[1][$iplus]);
//		if (!$pieceNr ) $svgBild .= $iplus . ": " . " Nr: " . $msNr . " Page: " . $msPage . "Es gibt ein Problem!<br>";
         	$svgBild .= $iplus . ": " . $pieceNr[0] . " " .  $pieceNr[1] . " " .  $pieceNr[2] . " Nr: " . $msNr . " Page: " . $msPage . "<br>";
		if ($pieceNr[1] === $msNr && myUrlencode($pieceNr[2]) === myUrlencode($msPage)) {
 
			$svgBild =  $msSVGs[$iplus+1];
			break;

		}
		$iplus++;
	} 

 
//	if (!svgBild) $svgBild = "Kein Incipit gefunden";	
//	echo $svgBild;

	return $svgBild;
}



