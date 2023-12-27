<?php 
//include_once("php_inc/abctab1.php");
include_once("php_inc/abctab.php");

// $numbertest=20;
$nm_extend = 0; // für Zeilen, die eine PieceNr haben, aber kein Stück sind
// Konkordanzen eines Manuskriptes darstellen
$msAllConcordances[0] = NULL;
$msAllConcordances[1] = 0;
$msCountIntConc = 0;


include_once("php_inc/manuscript_sys.php");
$arr_MssConc = make_MssConc();  // Konkordanzendatei einlesen
$arr_MssConc_max = count($arr_MssConc);
// $arr_MssNamesFile = make_MssNames();

$test_expression = "";
if ($test) $test_expression = "&amp;test=" . $test; 
 
$incipitNr = 0;

$DirIndex = getcwd ();
$IncDir1 = "incipits";
if (! is_dir ('incipits')) exec ('mkdir incipits');
$IncDir2 = rand(0,50);
$IncDir = $IncDir1 . '/' . $IncDir2;
if (! is_dir ($IncDir1)) mkdir ($IncDir1);
if (! is_dir ($IncDir)) mkdir ($IncDir);
	else rm_incipits (); 


/* 4.8.2010 iconv("UTF-8", "ISO-8859-1//TRANSLIT",$ms1) hat nicht geklappt! */


/* abc - globale Variablen und Pfade */
$length_global = "1/4";
$length_ms = "1/4";
$tabaddflags_global = "0";
$tabaddflags_ms = "0";
$header_nr = "0";
$strIfOccurence = NULL;

$ms_svg = NULL;
$msPieces = NULL;
$msSVGs = NULL;
$add_tabfixfr = '';
$arrMssNamesInstr = NULL;

/* ......... */


$set_br = NULL;
$MConcDat = NULL;
$MConcConc = NULL;
$MConcNr = NULL;
$MConcComment = NULL;
$ConcRow = 1;
$Conc1Row = NULL;
$internMConc = NULL;
$DatenConc = NULL;
$DatenConc_zahl = 0;
$DatenConcComment = NULL;
$concCount = NULL;
$arrConc_sort = NULL;
$arr_setConc[] = NULL;
$intMsNumber = 0;

$msOhneUml = UmlauteErsetzen($ms);
$ms = $arrMss[array_search ($msOhneUml,$arrMssOhneUml)] ;

if ($msnam) $type = 'mss';

$editions = array (
'deu' => "Moderne Editionen",
'eng' => "Modern Editions "
);

$keyLang = array (
      "a moll" => array ("a minor","a-Moll"),
      "Bb moll" => array ("b flat minor","b-Moll"),
      "bb moll" => array ("b flat minor","b-Moll"),
      "b moll" => array ("b flat minor","b-Moll"),
      "c moll" => array ("c minor","c-Moll"),
      "d moll" => array ("d minor","d-Moll"),
      "e moll" => array ("e minor","e-Moll"),
      "f moll" => array ("f minor","f-Moll"),
      "g moll" => array ("g minor","g-Moll"),
      "h moll" => array ("b minor","h-Moll"),
      "c# moll" => array ("c sharp minor","cis-Moll"),
      "d# moll" => array ("d sharp minor","dis-Moll"),
      "f# moll" => array ("f sharp minor","fis-Moll"), // sollte evtl. geaendert werden!
      "g# moll" => array ("g sharp minor","gis-Moll"),
      "cis moll" => array ("c sharp minor","cis-Moll"),
      "dis moll" => array ("d sharp minor","dis-Moll"),
      "fis moll" => array ("f sharp minor","fis-Moll"), // sollte evtl. geaendert werden!
      "gis moll" => array ("g sharp minor","gis-Moll"),
      "eb moll" => array ("e flat minor","es-Moll"),
      "Eb moll" => array ("e flat minor","es-Moll"),
      "Es moll" => array ("e flat minor","es-Moll"),
     "es moll" => array ("e flat minor","es-Moll"),
      "A dur" => array ("A Major","A-Dur"),
      "B dur" => array ("B flat Major","B-Dur"),
      "Bb dur" => array ("B flat Major","B-Dur"),
      "C dur" => array ("C Major","C-Dur"),
      "D dur" => array ("D Major","D-Dur"),
      "E dur" => array ("E Major","E-Dur"),
      "F dur" => array ("F Major","F-Dur"),
      "G dur" => array ("G Major","G-Dur"),
      "H dur" => array ("B Major","H-Dur"),
      "C# dur" => array ("C sharp Major","Cis-Dur"),
      "D# dur" => array ("D sharp Major","Dis-Dur"),
      "F# dur" => array ("F sharp Major","Fis-Dur"),
      "G# dur" => array ("G sharp Major","Gis-Dur"),
      "Cis dur" => array ("C sharp Major","Cis-Dur"),
      "Dis dur" => array ("D sharp Major","Dis-Dur"),
      "Fis dur" => array ("F sharp Major","Fis-Dur"),
      "Gis dur" => array ("G sharp Major","Gis-Dur"),
      "Ab dur" => array ("A flat Major","As-Dur"),
      "As dur" => array ("A flat Major","As-Dur"),
      "Es dur" => array ("E flat Major","Es-Dur"),
      "Eb dur" => array ("E flat Major","Es-Dur")
);







if ($type == "mss") {
      $pagetitle = array (
      'deu' => "Alle Quellen",
      'eng' => "All Sources"
      );
} else if ($type == "conc") {
      $pagetitle = array (
      'deu' => "Konkordanzen",
      'eng' => "Concordances"
      );
} else if ($type == "ms" ) {
      $ms1 = str_replace('\\', '',$ms);

	$pagetitle = array (
	'deu' => "$ms1",
	'eng' => "$ms1"
	);
} else if ($type == "ms2") {
      $ms1 = str_replace('\\', '',$ms);
	$showinc = 0;

	$pagetitle = array (
	'deu' => "$ms1",
	'eng' => "$ms1"
	);
} 
else if ($type == "ms3" ) {
      $ms1 = str_replace('\\', '',$ms);
	$showinc = 1;

	$pagetitle = array (
	'deu' => "$ms1",
	'eng' => "$ms1"
	);
} 


$ConcDat = array (
  'Nr' => "0",
  'Comp' => "1",
  'Work' => "2",
  'MoEd' => "3",
  'Conc' => "4",
//  'Conc2' => "5",
  'Comm' => "5"
);




// count Mss 


/*	switch ($lang) {
     	case "deu":
                      print "<br>Es sind " . $intQuantityOfMss . " Quellen vorhanden.<br>";
                      break; 
     	case "eng": 
                      print "<br>There are " . $intQuantityOfMss . " sources.<br>"; 
                      break;
	} */



$all=1;

$row = 0;
$row1 = 500000;
$row_mss = 0;
$pieces_mss = 0;
$entries = 0;
$hidden = 1;
$intMssNumberNotShown = 0;
$intMssNumberStart = 0;
$intMssNumberOccurence = 0;
$Daten = NULL;
$Daten_all = NULL;

while (ob_get_level()) {
    ob_end_flush();
}
// start output buffering
if (ob_get_length() === false) {
    ob_start();
}

if ($lang == "deu") {
	print "<p class=\"inwork\">Die Seite wird aufgebaut, bitte warten!</p>\n";
} else {
	print "<p class=\"inwork\">The page is built, please be patient!</p>\n";
}

ob_flush();
flush();

	



if ($type == "mss" || $type == "conc") 
{
	$intMssNumberStart = 0;
	$intMssNumberOccurence = 0;
} else {
	for ($intMssNumber = 0; $intMssNumber < $intQuantityOfMss; $intMssNumber++)
	{
	     if ($arrMssOhneUml[$intMssNumber] == UmlauteErsetzen($ms)) // 20.02.2011
	     {
	     	$intMsNumber = $intMssNumber;
	     } else {
		//		print_r ($arrMss);
		//		print $ms . "<br>";
	             if (str_replace('\\', '',$arrMss[$intMssNumber]) == str_replace('\\', '',$ms)) 
	    		 {
	     			$intMsNumber = $intMssNumber;
//	     			print "intMsNumber= $intMsNumber";
	    		 }
	     }
	}
	$intMssNumberStart = $intMsNumber;
	if ($intMsNumber > 0) $intMsNumberLast = $intMsNumber-1;
		else $intMsNumberLast = $intMsNumber;
	if ($intMsNumber < $intQuantityOfMss-1) $intMsNumberNext = $intMsNumber+1;
		else $intMsNumberNext = $intMsNumber;

/* 
	print "IntQuantity: " .  $intQuantityOfMss;
	print "vorher: " .  $intMsNumberLast . "Ms: " .  $intMsNumber .  "nachher: " .  $intMsNumberNext . "<br>\n";
*/
	
	$intQuantityOfMss = $intMsNumber+1;
} 
	
if ($type === 'ms3') {
	$page = NULL;
	$title = NULL;
	$key = NULL;
	$msnam = NULL;
	$abcinc = NULL;
	$pieceNr = NULL;
	$comp = NULL;
	$start = 0;
}
	

$all_keys = NULL;  // for testing only

// Beginn for-Schleife   
for ($intMssNumber = $intMssNumberStart ; $intMssNumber < $intQuantityOfMss; $intMssNumber++) {

		if ($row1 == 500000) {
			$row1 = $row  +1;
         }

		$CurrentMs = $arrMss[$intMssNumber];
		$CurrentMsOhneUml = UmlauteErsetzen ($CurrentMs);

//		$CurrentMs = urldecode($ms);
//		print "mss/" . stripslashes($CurrentMs) . ".csv<br>\n"; 
//		print "mss/" . str_replace('\\', '',$CurrentMs) . ".csv<br>\n"; 
//		if (file_exists ("mss/" . str_replace('\\', '',urldecode($ms) . ".csv")) {

		if (file_exists ("mss/" . $CurrentMsOhneUml . ".csv")) {
			$handle = fopen ("mss/" . $CurrentMsOhneUml . ".csv", "r");              // Anzahl der Array            
                                                            // Datei zum Lesen öffnen
		} else {
			$intMssNumberNotShown++;
			$handle = NULL;
		}
//		if (file_exists ("mss/Concordances.csv")) {
//			$handle_conc = fopen ("mss/Concordances.csv", "r");        
//                                                            // Datei zum Lesen öffnen
//		} 
	
	
//		print "mss/$CurrentMs.csv"; 

		$ms_long = array (
			'deu' => 1, // ms_long_deu
			'eng' => 2, // ms_long_eng
			'fra' => 3  // ms_long_fra
		);
		
		$entries = 0;
		$current_line= -1; // wegen der Datenzeile, um richtige Anzahl zu erhalten
		$row_ms = 0;  // Zahl der in ms enhaltenen Datensätze, die Bedingung erfüllen
		$pieces_ms = 0;  // Zahl der in ms enhaltenen Stücke, die Bedingung erfüllen

/* funktioniert so nicht!
$Bedingung = '!$key || substr($content["Key"],0,5) == substr($key,0,5)';
und so auch nicht!
$Bedingung = '"!$key || substr($content["Key"],0,5) == substr($key,0,5)"';
*/

//	print "row=" . $row . " hidden=" . $hidden . "<br>\n";  // Teste hidden
//	if ($row > ($row1 + $start-1 + $number) && $hidden == 0) {
//               				$hidden = 1;
//	} // Test hidden

// if handle AND !feof($handle)

if ($handle  AND !feof($handle)) {
	$abcinc_fits = NULL;
	$page_fits = NULL;
	$zaehler = 0;

	$inz_path = $IncDir;

// bei tabfixfrench
	if ($Arr_MssNamesFile) $arrMssNamesInstr = $Arr_MssNamesFile[$intMssNumber][$mss_Instruments];
	if (strpos ($arrMssNamesInstr,'DTab') !== false || strpos ($arrMssNamesInstr,'ITab') !== false  || strpos ($arrMssNamesInstr,'NTab') !== false ) $notFTab = 1;
	if (isset($tabfixfrench) && $notFTab == 1)
	{
 			$add_tabfixfr = '-fr';
			$notFTab = 0;
	} 
		else
			$add_tabfixfr = '';
	
		
// Es wird nur $msvgType = 0 benutzt

	if  ($msvgType === 0) {
	 	$msvgFile = $IncDir1 . "/" . $CurrentMsOhneUml . $add_tabfixfr . '.msvg';

// Nur zum Testen
//		echo $msvgFile . $arrMssNamesInstr . "<br>";
	}
	else if  ($msvgType === 1)
		$msvgFile = $IncDir1 . "/" . $CurrentMsOhneUml[0] . "/" . $CurrentMsOhneUml . '.msvg';
//	if ($usesvg === 1 && $type === 'ms3') {
		if (!is_file($msvgFile) || filesize ($msvgFile) === 0 || filemtime ($msvgFile) < filemtime ("mss/" . $ms . ".csv") || 
			filemtime ($msvgFile) < filemtime ("php_inc/abctab.php") || $forceMsvg === 1)  {
			$msvgUpdate = 1;
			if ($type == 'ms3') {	
				$dateMsvg = new DateTime();
				$inz_path = $IncDir . "/" .  $dateMsvg->getTimestamp();
//				$IncDir = $inz_path;
				if (! is_dir ($inz_path)) mkdir ($inz_path);
			}
		}  else $msvgUpdate = 0;

// msvg-Datei laden
	if ($usesvg === 1 && is_file($msvgFile) && $msvgUpdate === 0) {
		$ms_svg = file_get_contents ($msvgFile);              // Datei zum Lesen &ouml;ffnen
// echo $ms_svg;
		$msPieces = extractStringBetween ('<piece>','<\/piece>',$ms_svg);
		$msSVGs = splitString ('<piece>','<\/piece>',$ms_svg);
	} else {
		$msPieces = NULL;
		$msSVGs = NULL;
	}
	$time_arr = NULL;
//
// while Beginn
// Daten werden aus der Datei  in ein Array $data gelesen
//
	while ( ($data = fgetcsv ($handle, 10000, ";")) !== FALSE) {

		$piece_bool = 0;		
//		$hidden = 1; // Nicht anzeigen, wenn nicht ein Stueck angezeigt wird!
         
		if ($current_line==-1) {
			$intQuantityOfFields = count ($data);
		     	for ($i = 0; $i < $intQuantityOfFields; $i++)
			  {
					$content[substr($data[$i],0,4)] = $i;
		          }
		}  else {

			if (array_key_exists ("Piec",$content) && isset($data[$content["Piec"]])) $set_piec = $data[$content["Piec"]];
				else $set_piec = NULL;
			if (array_key_exists ("Key",$content) && isset($data[$content["Key"]])) 
			         $set_key =  $data[$content["Key"]];
				else $set_key = NULL;
			if (array_key_exists ("Page",$content) && isset($data[$content["Page"]])) $set_page = $data[$content["Page"]];
				else $set_page = NULL;
			if (array_key_exists ("Name",$content) && isset($data[$content["Name"]])) $set_name = $data[$content["Name"]];
				else $set_name = NULL;
			if (array_key_exists ("Comp",$content) && isset($data[$content["Comp"]])) $set_comp = $data[$content["Comp"]];
				else $set_comp = NULL;
			if (array_key_exists ("Comm",$content) && isset($data[$content["Comm"]])) $set_comm = $data[$content["Comm"]];
				else $set_comm = NULL;
			if (array_key_exists ("Conc",$content) && isset($data[$content["Conc"]])) $set_conc = $data[$content["Conc"]];
				else $set_conc = NULL;
			if (isset($set_conc)) $arr_setConc = explode(",",str_replace(" ","",$set_conc));

			if (array_key_exists ("Tab",$content) && array_key_exists ("Tab",$content) && isset($data[$content["Tab"]])) 
			{
				$set_tab = $data[$content["Tab"]];
				if ($set_tab <= "") $set_tab = NULL;
			}  else $set_tab = NULL;
			if (array_key_exists ("TabN",$content) && isset($data[$content["TabN"]])) $set_tabn = $data[$content["TabN"]];
				else $set_tabn = NULL;
			if (array_key_exists ("Tuni",$content) && isset($data[$content["Tuni"]])) $set_tuni = $data[$content["Tuni"]];
				else $set_tuni = NULL;
			if (array_key_exists ("Time",$content) && isset($data[$content["Time"]])) $set_time = $data[$content["Time"]];
				else $set_time = NULL;
			if (array_key_exists ("Date",$content) && isset($data[$content["Date"]])) $set_date = $data[$content["Date"]];
				else $set_date = NULL;
			if (array_key_exists ("deuN",$content) && isset($data[$content["deuN"]])) $set_deuNotes = $data[$content["deuN"]];
				else $set_deuNotes = NULL;
			if (array_key_exists ("engN",$content) && isset($data[$content["engN"]])) $set_engNotes = $data[$content["engN"]];
				else $set_engNotes = NULL;
	
			if ($set_piec == "1" || $set_piec == "1a") {
				if ($set_time) $time_arr = explode(',',$set_time);

				if (isset($time_arr[1])) { 
					$length_ms = $time_arr[1];
				} else 
					$length_ms = $length_global;
				
				if (isset($time_arr[2])) 
				{ 
					$tabaddflags_ms = $time_arr[2];
				}  else $tabaddflags_ms = $tabaddflags_global;
			}


// Nur zum Test für Tonarten
//                if (!strstr ($all_keys, $set_key)) $all_keys .= $set_key . " ";

		if ($abcinc) 
		{

/* alte Version
		if (strstr ($abcinc,substr(preg_replace('/[0-9]\s|[0-9]\]|[0-9]\/[0-9]|[\s\\\\\/\(\)\'\#UVX\]\>\:]/', '', $set_tab),0,strlen($abcinc)))) {
*/
			if (abcinc_cmp($abcinc,$set_tab,$inc_area,$abcinc_mode)) 
			{
 				$abcinc_fits = 1;
		    	} else $abcinc_fits = NULL;
		}

		if ($page) {
			if (!strcmp ($page,substr($set_page,strpos($set_page," ",0)))
				||  in_array($page,preg_split("/[\s,]+/",$set_page)))
				$page_fits = 1;
			else $page_fits = NULL;
		}
		
		if ($set_piec AND $set_piec[0] != "_" AND $set_piec[0] != "-") $entries++;               

		if (( !$key || substr(correct_set_key($set_key),0,strlen($key)) == $key) &&
                    ( !$pieceNr || strstr($set_piec,$pieceNr)) &&
                	( !$title || strstr(strtolower($set_name),strtolower($title))) &&
                	( !$msnam || substr($CurrentMsOhneUml,0,strlen($msnam)) == UmlauteErsetzen($msnam)) &&  // 20.02.2011TimeTime
                	( !$comp || strstr($set_comp,$comp)) && 

// Zurzeit können nur 2 Konkordanznummern gesetzt werden
                	( !$conc || (isset($arr_setConc[0]) && strcmp(substr($arr_setConc[0],4),$conc) == "0") || (isset($arr_setConc[1]) && strcmp(substr($arr_setConc[1],4),$conc) == "0")) && 
                 	( !$abcinc ||  $abcinc_fits ) &&
		 	( !$page || $page_fits )   )  
		{
			$conc_bool = 0;
			$MConcDat = NULL;
			$MConcConc = NULL;
			$MConcNr = NULL;
			$MConc = NULL;
			$NotMonc = NULL;
//			$hidden = 0; // Wenn Stueck angezeigt wird, wird hidden auf false gesetzt! 

// if $set_piec 

			if ($set_piec)  // Piece ja - if
			{   
//				$piece_bool = 0;
			 
				if ($set_piec != "-") // fuer Akkorde oder aehnliches
				{
					$row_ms++;  // nur zaehlen, wenn Eintrag!
		   			$row_mss++; // nur zaehlen, wenn Eintrag!
					$piece_bool = 1;
					if ($set_piec[0] != "_") { 
						$pieces_ms++; // nur zaehlen, wenn Stueck!
						$pieces_mss++; // nur zaehlen, wenn Stueck!
					}
				} else $nm_extend++;

		 		 $strIfOccurence = "yes"; 

//				if ($type = 'ms' && $number > $numbertest) $number = $numbertest;
// if row 2
				if ($row > ($start-1  + $nm_extend) && $row < ($row1 + $start-1 + $number + $nm_extend)) 
				{

		            if ($set_conc ) 
					{	
// foreach: 2 oder theoretisch auch mehr Konkordanzen können ausgelesen werden
// arr_setConc wird weiter oben gesetzt				

						foreach ($arr_setConc as $issetConc ) 
						{						
							$conc_bool= 1;
							if (preg_match('/\bConc(_|R|M).[0-9]{0,4}/', $issetConc, $treffer))  //vorher Konk
							{
								if (substr($issetConc,4,1) == 'M') {
									$MConc = 'M';
//									$NotMConc = 0;
								}
								else { 
										$MConc = '';
										$NotMConc = 1;
								}
								$start_i = sprintf('%d',substr($treffer[0],4)) - 10;
								if ($start_i < 0) $start_i = 0;

								for ($i = $start_i; $i < $arr_MssConc_max; $i++ ) 
								{
									if ($arr_MssConc[$i]->ConcNr == $treffer[0]) 
									{
										$ConcRow = $i; // Versuch

// Falls 2 Konkordanznummern, die erste lokalisieren!
										if (!isset($Conc1Row)) $Conc1Row = $ConcRow;	

										${$MConc . 'ConcDat'}["Nr"] = $arr_MssConc[$i]->ConcNr;
										${$MConc . 'ConcDat'}["Nr"] = $treffer[0];
							  			if ($arr_MssConc[$i]->ConcComposer) ${$MConc . 'ConcDat'}["Comp"] = $arr_MssConc[$i]->ConcComposer;
										else 
											if (!$set_comp) ${$MConc . 'ConcDat'}["Comp"] = NULL;
											else ${$MConc . 'ConcDat'}["Comp"] = $set_comp;
							  			if ($arr_MssConc[$i]->ConcWorkNr) ${$MConc . 'ConcDat'}["Work"] = $arr_MssConc[$i]->ConcWorkNr;
											else ${$MConc . 'ConcDat'}["Work"] = NULL;
							  			if ($arr_MssConc[$i]->ConcModernEd) ${$MConc . 'ConcDat'}["MoEd"] = $arr_MssConc[$i]->ConcModernEd;
											else ${$MConc . 'ConcDat'}["MoEd"] = NULL;
							  			if ($arr_MssConc[$i]->ConcComment) ${$MConc . 'ConcDat'}["Comm"] = $arr_MssConc[$i]->ConcComment;
											else ${$MConc . 'ConcDat'}["Comm"] = NULL;

								  		if ($arr_MssConc[$i]->ConcConcordances) 
										{
// sort_Conc sortiert die Konkordanzen
											$arrConc_sort = sort_Conc ($arr_MssConc[$i],$treffer[0],$i);  
											${$MConc . 'ConcDat'}["Conc"] =  $arrConc_sort[0]; 
// nur zum Testen											print " KONKORDANZzahl " . $arrConc_sort[1] ;
// Konkordanzen zählen -1
											$concCount = $arrConc_sort[1]-1;											
										}   else ${$MConc . 'ConcDat'}["Conc"] = $issetConc;
								  			break;
							   		} 

								}

								${$MConc . 'ConcConc'} = ${$MConc . 'ConcDat'}["Conc"];
								${$MConc . 'ConcNr'} = ${$MConc . 'ConcDat'}["Nr"];
							} else {  // falls preg_match fehlschlaegt
									if (!$set_comp) $ConcDat["Comp"] = NULL;
										else $ConcDat["Comp"] = $set_comp;
									$ConcDat["Work"] = NULL;
									$ConcDat["MoEd"] = NULL;
									$ConcDat["Conc"] = NULL;
							}      

						} // end foreach						
					} else {
						$conc_bool=0;
						$ConcDat["Conc"] = NULL;
						if (!$set_comp) $ConcDat["Comp"] = NULL;
							else $ConcDat["Comp"] = $set_comp;
						$ConcDat["Work"]= NULL;
						$ConcDat["MoEd"]= NULL;
						$ConcDat["Conc"]= NULL;
						$ConcDat["Comm"]= NULL;
					}

// Kommentare im Ms
					if (isset($set_comm)) 
					{	
					//	$Daten .= $treffer[0]; Wenn Conc_Zahl vorhanden; aber zusaetzliche Kommentare werden nicht angezeigt!
					if (preg_match_all('/\bConc(_|R|M).[0-9]{0,4}/', $set_comm, $treffer)) 
					{  
						$comment  = $set_comm;
	
						// Beginn der Suche mit Conc_Zahl! 
						for ($i_treffer = 0; $i_treffer < 10;$i_treffer++) 
						{
							if (isset ($treffer[0][$i_treffer])) 
							$start_i = sprintf('%d',substr($treffer[0][$i_treffer],4)) - 10;
								else break;
							if ($start_i < 0) $start_i = 0;
							for ($i = $start_i; $i < $arr_MssConc_max; $i++ ) 
							{
								if ($arr_MssConc[$i]->ConcNr == $treffer[0][$i_treffer]) 
								{
									$ConcDat["Nr"] = $arr_MssConc[$i]->ConcNr;
									$arrConc_sort = sort_Conc ($arr_MssConc[$i],$treffer[0],"com");  
									$comment  =  str_replace($treffer[0][$i_treffer], "<b><a href=\"index.php?id=" 
												. $id . "&amp;type=conc&amp;lang=" . $lang . "&amp;conc=" 
												. substr($treffer[0][$i_treffer],4) . $test_expression . "\">" . $treffer[0][$i_treffer] 
												. "</a></b>:<br>" . $arrConc_sort[0] . "<br>",$comment);
				    				  	break;
								}
							}
						        if (!isset($treffer[0][$i_treffer])) break;
						}
						$MsDat["Comm"]= $comment;
					} else {
						$MsDat["Comm"]= $set_comm;
					}  
				} else {
					$MsDat["Comm"] = NULL;				
				}
// Ende Kommentare im Manuskript	
	
// Darstellung Stücke

				
				if ($set_piec[0] == "_") {
					$help_set_piec = substr ($set_piec,1);
					$set_piec = $help_set_piec;
				}

				$Daten .= "<tr valign=top><td colspan=2><div class=\"nobreak\">\n";
				$Daten .= "<div class=\"msnr\"><b>" . $set_piec  . "</b></div>\n" ;
				$Daten .= "<div class=\"conc\"><b>" . $set_name  . "</b>\n";
				if (isset($NotMConc) && $NotMConc == 1 && $ConcDat["Comp"] )  
				{
					$Daten .= "  (" . $ConcDat["Comp"];
					if ($ConcDat["Work"]) $Daten .= ", <font color=red>" . $ConcDat["Work"] . "</font>";
					$Daten .= ")";
				} else if ($set_comp) 
					$Daten .= "  (" . $set_comp . ")";

				$Daten .= "<br>";
				if (array_key_exists($set_key,$keyLang)) 
					$Daten .=  $keyLang[$set_key][$langArr] . "\n";
					else $Daten .= $set_key . "\n";

				if ($set_tuni) 
					$Daten .= "&nbsp;<i><font color=blue>(" . $set_tuni . ")</font></i>\n";
				$Daten .= "&nbsp;&nbsp;&nbsp;&ndash;&nbsp;&nbsp;\n";

				if ($type == "mss" /* || $type == "conc"*/) 
				{ 
					$Daten .= "<i>" . ms_link($CurrentMs) . " / " . $set_page  . "</i>";
				} else {
					$Daten .= "<i>" . $CurrentMs . " / " . $set_page  . "</i>";
				}	
				$Daten .= "</div><div class=\"msnr1\"></div><div class=\"mscontent\">";
				if ($set_tab && $showinc == 1 ) {  
					if ($set_tab > "") 
					{
						if ($data[$content["Piec"]] == (1 + $start)) 
						{
							  $msnr= sprintf("%03s",$set_piec);
						}
				  		if ($set_tabn) $tabnotation = $set_tabn;
				    			else  $tabnotation = "frenchtab";
						if (!$set_time || $set_time == " ") $time = "none";
							else $time = $set_time;

						if ($usesvg == 0 || $msvgUpdate === 1) {
							$Daten .= "\n<div class=\"conthidden\">";
							make_inzipit_neu ($inz_path, $CurrentMsOhneUml,$msnr,$set_piec,$set_page,$incipitNr,abc_key($set_key),$time,$set_tab,$tabnotation);
							$Daten .= "</div>";
						} 
					} 
//alt					if (is_file ($inz_path . '/' .  . ".abc")) 
					$piecePath = $inz_path . '/' . sprintf ("%03d", $incipitNr)  . "_" . $set_piec . "_" . myUrlencode ($set_page);

// Teste Variablen
//								$Daten .= 'msvgUpdate = ' . $msvgUpdate . '<br>'
//								. 'type = ' . $type . '<br>' . 'forceMsvg = ' . $forceMsvg . '<br>'
//								. 'piecePath = ' . $piecePath; 
// 

					if (isset($usesvg) && $usesvg == 1 && is_file ($msvgFile) && $msvgUpdate == 0) 
					{
//						$Daten .= "TEST1: $CurrentMsOhneUml msvgUpdate = $msvgUpdate<br>";
						if  ($msvgType == 0)
							$Daten .=  show_msvg0  ($CurrentMsOhneUml,$incipitNr,$set_piec,$set_page);
						elseif  ($msvgType == 1)
							$Daten .=  show_msvg1  ($CurrentMsOhneUml,$incipitNr,$set_piec,$set_page);
					}
					else if ( is_file ($piecePath . ".abc")) 
					{
//						$Daten .= "TEST2: $CurrentMsOhneUml msvgUpdate = $msvgUpdate<br>";
					    	if (!isset($usesvg) || $usesvg == 0)	$Daten .= "<img class=\"png\" src=\"" . $piecePath. ".png\">";
						else {
							$pieceFile = $piecePath . '001.svg';
							if ($msvgUpdate == 1 && $type == 'ms3')  {
								$lengthPath = strrpos ($piecePath,'/')+1;
								$pieceName = substr ($piecePath,$lengthPath);
// Nur zur Überprüfung
//								$Daten .= $pieceFile . '<br>' . $pieceName . '<br>';
//
								make_svg ($inz_path, $number,$pieceName);
								$Daten .= file_get_contents ($pieceFile) ;
							}	
							else 

								$Daten .= "<img class=\"svg\" src=\"" . $pieceFile . "\" width=\"100%\">";
						}
					}
//}
					$incipitNr++;
				}

// Bemerkungen im Original				
				if ($MsDat["Comm"]) 
					$Daten .= "<div><span class=\"comm\"><b>" . $MsDat["Comm"] . "</b></span></div>\n";
		
// Kommentare anzeigen
				if (${'set_' . $lang . 'Notes'}) 
					$Daten .= "<div><i><span class=\"comm\">" . ${'set_' . $lang . 'Notes'}  . "</span></i></div>\n";
				else
					if ($lang == 'eng' && $set_deuNotes) $Daten .= "<div><i><span class=\"comm\">" . $set_deuNotes . "</span></i></div>\n";

// Anzeige Konkordanzen

				if ($ConcDat["Conc"] && $type != "conc" && $NotMConc == 1) 
				{				    
					$Daten .= "<div><span class=\"conc\">";
					if (!$viewConc && $concCount != 0) $Daten .= "<details><summary>";
					$Daten .= "<b><i>";
					if ($concCount != 0) $Daten .= "<a href=\"index.php?id=1&amp;type=conc&amp;lang=deu&amp;conc=" 
							. substr($ConcNr,4) . $test_expression . "&amp;instr=" . $instr . "\">";
					$Daten .= $ConcNr;
					if ($concCount != 0) $Daten .= "</a></i></b>";
					if (!$viewConc && $concCount != 0) $Daten .= " (" . $concCount . ")</summary>";
						else if ($concCount != 0) $Daten .= "<br>";
					if ($concCount != 0) $Daten .= $ConcConc;
					if (!$viewConc && $concCount != 0) $Daten .= "</details>";
					$Daten .= "</span></div>";
				}  

// Concordances Comment auswerten und anzeigen

			foreach ($arr_setConc as $issetConc ) 
			{						
				if (substr($issetConc,4,1) == 'M') $MConc = 'M';
					else $MConc = '';
				if (${$MConc . 'ConcDat'}["Comm"] && isset(${$MConc . 'ConcDat'}["Comm"])) 
				{	
					if (preg_match_all('/\bConc(_|R|M).[0-9]{0,4}/', ${$MConc . 'ConcDat'}["Comm"], $treffer)) 
					{  
						${$MConc . 'comment'}  = ${$MConc . 'ConcDat'}["Comm"];

						// Beginn der Suche mit Conc_Zahl! 
						for ($i_treffer = 0; $i_treffer < 10; $i_treffer++) 
						{
							if (isset($treffer[0][$i_treffer])) 
							{
								$start_i = sprintf('%d',substr($treffer[0][$i_treffer],4)) - 10;
								if ($start_i < 0) 
									$start_i = 0;
								for ($i = $start_i; $i < $arr_MssConc_max; $i++ ) 
								{
									if (isset($arr_MssConc[$i]->ConcNr)) 
									{
										if ($arr_MssConc[$i]->ConcNr == $treffer[0][$i_treffer]) 
				      						{
											${$MConc . 'ConcDat'}["Nr"] = $arr_MssConc[$i]->ConcNr;
											$arrConc_sort = sort_Conc($arr_MssConc[$i],$treffer[0][$i_treffer],"com"); 
											if ($type != "conc") 
												${$MConc . 'comment'}  =  str_replace($treffer[0][$i_treffer],"<b><a href=\"index.php?id=" 
												. $id . "&amp;type=conc&amp;lang=" . $lang . "&amp;conc=" 
												. substr($treffer[0][$i_treffer],4) . $test_expression . "\">" . $treffer[0][$i_treffer] 
// mit ausgeklappten Konkordanzen
//												. "</a></b>:<br>" . $arrConc_sort[0] . "<br>",${$MConc . 'comment'});
												. "</a></b><br>",${$MConc . 'comment'});

											else
												${$MConc . 'comment'}  =  str_replace($treffer[0][$i_treffer],"<a href=\"index.php?id=" 
												. $id . "&amp;type=conc&amp;lang=" . $lang . "&amp;conc=" 
												. substr($treffer[0][$i_treffer],4) . $test_expression . "\">" . $treffer[0][$i_treffer] 
												. "</a>",${$MConc . 'comment'});

															      
											break;
										}
									}
								}
							} else break;

							${$MConc . 'ConcDat'}["Comm"] = ${$MConc . 'comment'};
// Test
//							print $arr_MssConc[$i]->ConcNr . " TEST " . ${$MConc . 'ConcDat'}["Comm"] . " test " . $arr_setConc[0] . " test1 " . $arr_setConc[1] .  "<br>";
						}
					}
					${$MConc . 'DatenConcComment'} = ${$MConc . 'ConcDat'}["Comm"] ;
					if ($type != "conc" AND $DatenConcComment) 
//						if (!strstr($DatenConcComment,$arr_setConc[1]) )  // evtl. zum Unterdrücken von Meldungen ...
							$Daten .= "\n<div><hr class=\"conc\"><span class=\"comm\">" . $DatenConcComment . "</span></div>";
				}
			}

// Ende Concordances Comment
// Concordances-> Modern Edition
	
				if (isset($ConcDat['MoEd']) && isset($NotMConc) && $NotMConc == 1 && $type != 'conc' ) 
					$Daten .= "\n<p class='l'><span class=\"moded\">" . $editions[$lang] . ": " . $ConcDat['MoEd'] . "</span>\n";

// Ende Modern Edition
				

// Anzeige Melodie-Konkordanzen

				if (isset($MConcDat["Conc"]) && $type != "conc") 
				{				    
					$Daten .= "<p class=\"mConc\"><span class=\"conc\">";
					$Daten .= "<b><i><a href=\"index.php?id=1&amp;type=conc&amp;lang=deu&amp;conc=" 
							. substr($MConcNr,4) . $test_expression . "&amp;instr=" . $instr . "\">" . $MConcNr . "</a></i></b></span>";
					if ($MConcDat['MoEd']) {
						$Daten .= "<br><span class='mconc'>" . $MConcDat['MoEd'] . "</span>";
						if ($MConcDat["Comp"]) { 
							$Daten .= " (" . $MConcDat['Comp'];
							if ($MConcDat["Work"]) $Daten .= "," . $MConcDat['Work'];
							$Daten .= ")";
						}
					}
					$Daten .= "<br><span class=\"conc\">" . $MConcConc . "</span>";
					if ($MConcDat['Comm']) 
						$Daten .= "\n<p class='l'><span class=\"comm\">" . $MConcDat['Comm'] . "</span>\n";
					else 
						$Daten .= "&nbsp;";
				}  


				$Daten .= "</div></td></tr>\n";



//
// type= Conc: Konkordanzen anzeigen, 
//

				if ($ConcRow >= 0 && $arr_MssConc) 
				{	
					if ($arr_MssConc[$ConcRow]->ConcConcordances && $type == "conc" ) 
					{	
						if ( $DatenConc_zahl == 0) 
						{			    
							$DatenConc .= "<div class=\"ml40\"><hr><span class=\"conc14b\">"; 
							if ($lang == "deu") 
								$DatenConc .= "Konkordanz Nr. "; 
							if ($lang == "eng") 
								$DatenConc .= "Concordance No. "; 
							$DatenConc .= $conc . "</span>";
							if (substr ($conc,0,1) == 'M' && $MConcDat['MoEd']) {
								$DatenConc .= "<br><span class='mconc'>" . $MConcDat['MoEd'] . "</span>";
								if ($MConcDat["Comp"]) { 
									$DatenConc .= " (" . $MConcDat['Comp'];
									if ($MConcDat["Work"]) $DatenConc .= "," . $MConcDat['Work'];
									$DatenConc .= ")";
								}
							}


//
//  Bei M-Konkordanzen! ConcNr durch Vorkommen austauschen
//
				if ($conc == substr($arr_MssConc[$ConcRow]->ConcNr,4)) {

				if (preg_match_all('/\bConc(_|R|M).[0-9]{0,4}/', $arr_MssConc[$ConcRow], $treffer) && $conc == substr($arr_MssConc[$ConcRow]->ConcNr,4)) 
					{  
					$internMConc  =  $arr_MssConc[$ConcRow]; 
	
						// Beginn der Suche mit Conc_Zahl! 
						for ($i_treffer = 0; $i_treffer < 10;$i_treffer++) 
						{
							if (isset ($treffer[0][$i_treffer])) 
							$start_i = sprintf('%d',substr($treffer[0][$i_treffer],4)) - 10;
								else break;
							if ($start_i < 0) $start_i = 0;
							for ($i = $start_i; $i < $arr_MssConc_max; $i++ ) 
							{
								if ($arr_MssConc[$i]->ConcNr == $treffer[0][$i_treffer]) 
								{
									$ConcDat["Nr"] = $arr_MssConc[$i]->ConcNr;

									$internMConc->ConcConcordances = str_replace ($arr_MssConc[$i]->ConcNr, 
										$arr_MssConc[$i]-> ConcConcordances, $internMConc->ConcConcordances);
				    				  	break;
								}
							}
						    if (!isset($treffer[0][$i_treffer])) break;
						}

					$arr_MssConc[$ConcRow]=$internMConc; 
					} 
				}

				$DatenConc .= "<br><span class=\"conc11\">";
				if (isset ($internMConc)) 
				  $DatenConc .= sort_Conc($internMConc,$treffer[0],"conc")[0];
				else
				  $DatenConc .= sort_Conc($arr_MssConc[$Conc1Row],$treffer[0],"conc")[0];

				if (isset($DatenConcComment))  
					$DatenConc .= "</span>\n<hr>" . $DatenConcComment; 
				else if (isset($MDatenConcComment))  
					$DatenConc .= "</span>\n<hr>" . $MDatenConcComment; 
					
				if ($ConcDat['MoEd'] && substr ($conc,0,1) != 'M' ) 
				$DatenConc .= "\n<p><span class=\"moded2\">" . $editions[$lang] 
						. ": " . $ConcDat['MoEd'] . "</span>\n";
				$DatenConc .=  "</span>\n<hr></div>\n";
				$DatenConc_zahl++;
			}

		}
	}

// 
// Ende type: conc - Konkordanzen anzeigen
//

	$hidden = 0;
	} 

	$row++;                 // Gesamtzahl der verarbeiteten Datens&auml;tze 
		  
} 
else 
{  // Piece no
	$strIfOccurence = "yes"; 

	// if row 2

	if ($row > ($start-1  + $nm_extend) && $row < ($row1 + $start-1 + $number + $nm_extend)) 
	{
		$Daten .= "<tr valign=bottom class=\"msfasz\">\n";
		$Daten .= "<td colspan=\"2\" class=\"msfasz\">";
		$set_br = 0;

		// Faszikel und Sonaten-/Partienbezeichnungen
		// Deutsch
		
		if (isset($data[1])) $deuTitel1 = $data[1];
				else $deuTitel1 = NULL;
		if (isset($data[3])) $deuTitel2 = $data[3];
				else $deuTitel2 = NULL;
		if (isset($data[5])) $deuTitel3 = $data[5];
				else $deuTitel3 = NULL;
		if (isset($data[2])) $engTitel1 = $data[2];
				else $engTitel1 = NULL;
		if (isset($data[4])) $engTitel2 = $data[4];
				else $deuTitel2 = NULL;
		if (isset($data[6])) $engTitel3 = $data[6];
				else $engTitel3 = NULL;

		if ($lang == "deu" & ($deuTitel1 || $deuTitel2 || $deuTitel3) ) 
		{
			if ($deuTitel1) 
			{ 
				$Daten .= "<span class=\"fasz\">" . $deuTitel1  . "</span>\n";
				$set_br = 1;
			}
			if ($deuTitel2) 
			{ 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $deuTitel2  . "</span>\n";
				$set_br = 1;
			}
			if ($deuTitel3) 
			{ 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"comm1\">" . $deuTitel3  . "</span>\n";
			}
		} 
		else // English
		{
			if ($engTitel1) 
			{ 
				$Daten .= "<span class=\"fasz\">" . $engTitel1  . "</span>\n";
				$set_br = 1;
			} else if ($deuTitel1) 
			{ 
				$Daten .= "<span class=\"fasz\">" . $deuTitel1  . "</span>\n";
				$set_br = 1;
			}
			if ($engTitel2) 
			{ 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $engTitel2  . "</span>\n";
				$set_br = 1;
			} else if ($deuTitel2) { 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $deuTitel2  . "</span>\n";
				$set_br = 1;
			}
			if ($engTitel3) 
			{ 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"comm1\">" . $engTitel3  . "</span>\n";
			} else if ($deuTitel3) { 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"comm1\">" . $deuTitel3  . "</span>\n";
			}
		} 



// alte Version
/*
		if ($lang == "deu" & ($set_key || $set_name || $set_comm) )  
		{
			if ($set_key) 
			{ 
				$Daten .= "<span class=\"fasz\">" . $set_key  . "</span>\n";
				$set_br = 1;
			}
     			if ($set_name) 
			{
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $set_name .  "</span>";
  				$set_br = 1;
			}
			if ($set_comm) 
			{ 
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"comm1\">" . $set_comm . "</span>";
			}  
				
		} 
		else // Englisch 
		{  
			if ($set_page) 
			{
				$Daten .= "<span class=\"fasz\">" . $set_page  . "</span>\n";
				$set_br = 1; 
			} 
			else if ($set_key) {
				$Daten .= "<span class=\"fasz\">" . $set_key  . "</span>\n";
				$set_br = 1;
			}
					
	     	if ($set_comp) {
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $set_comp . "</span>";
 				$set_br = 1;
			} 
			else if ($set_name) {
				if ($set_br == 1) 
					$Daten .= "<br>";
				$Daten .= "<span class=\"suite\">" . $set_name .  "</span>";
  				$set_br = 1;
			}

     		if ($set_tuni) {
				if ($set_br == 1) 
					$Daten .= "<br>";
					$Daten .= "<span class=\"comm1\">" . $set_tuni . "</span>";
			} 
			else  if ($set_comm) { 
				if ($set_br == 1) 
						$Daten .= "<br>";
					$Daten .= "<span class=\"comm1\">" . $set_comm . "</span>";
			}  
		}			  
*/			
		$Daten .= "</div></td></tr>\n";
		$set_br = 0;
	} 
} // ende if $set_piece und else

}   
		   
}  // end else 

// if (($type == 'ms' || $type == 'ms2' || $type == 'ms3') && !$data[$content["Piec"]] && !$data[$content["Name"]] && !$data[$content["Comp"]] 
//		&& !$data[$content["Comm"]] && !$data[$content["Conc"]]) break;
// if ($type == 'ms' || $type == 'ms2' || $type == 'ms3') break;

	
$current_line++;

// echo $Daten; // Versuch!
//       ob_flush();
//       flush();
// $Daten = NULL; // Versuch!

	} 	// 	while ende 


} //   // end if handle AND !feof($handle)

elseif ($type == "ms" || $type == "ms2" || $type == 'ms3') 
{
	$Name = $CurrentMs; // Test
	$Daten .= "<table>\n<tr valign=top>\n<td class=\"msnr\"></td>\n<td class=\"conc\"><b>";
	if ($lang == "deu") 
		$Daten .= $Name  . ": Datei der Quelle nicht vorhanden<br>";
	else 
		$Daten .= $Name . ": file of source doesn't exist<br>";
	$Daten .= "</b></td></tr></table>"; 
}

$Daten .=  "</div>";  // Versuch


//
// Manuskripttitel anzeigen - mit Zusatzinformationen
//
 
if ($strIfOccurence) $intMssNumberOccurence++;

if ($hidden != 1  && $Daten && $type != "conc" && $row_ms != 0) 
{
	$Daten_all .= "<table class=\"mstitle\">\n<td colspan=\"2\" class=\"mstitle\"><hr>";
	$Daten_all .= "\n<h3 class=\"mssleft\"><span class=\"mstitle\">" 
		.  UmlauteHTML ($arrMssNamesFile[$intMssNumber][$mss_RISM]) . " " 
		. UmlauteHTML ($arrMssNamesFile[$intMssNumber][$mss_Sigl_long]) ;
//	$Daten_all .= "\n<span class=\"smh4\">";

	if ($arrMssNamesFile[$intMssNumber][ $mss_Name_deu] ) 
	{
		$Daten_all .= "<br><i>";
		if ($lang == 'deu' || !$arrMssNamesFile[$intMssNumber][ $mss_Name_eng]) 
			$Daten_all .= UmlauteHTML ($arrMssNamesFile[$intMssNumber][ $mss_Name_deu]) . "</i>";
		else 
			$Daten_all .= UmlauteHTML ($arrMssNamesFile[$intMssNumber][ $mss_Name_eng]) . "</i>";
	}
	if ($arrMssNamesFile[$intMssNumber][$mss_Library]) 
	{
		if ($lang== 'deu') 
		{
			$Daten_all .= "\n<br><span class=\"size14\">Bibliothek: ";
		} 
		else 
		{ 
			$Daten_all .= "\n<br><span class=\"size14\">Library: ";
		}

		$Daten_all .= UmlauteHTML ($arrMssNamesFile[$intMssNumber][$mss_Library]) . "</span>";
	}

	if ($arrMssNamesFile[$intMssNumber][$mss_Provenienz]) {
		if ($lang== 'deu') {
			$Daten_all .= "\n<br><span class=\"size14\">Provenienz: ";
		} else { 
			$Daten_all .= "\n<br><span class=\"size14\">Provenience: "; 
		}
		$Daten_all .= UmlauteHTML ($arrMssNamesFile[$intMssNumber][$mss_Provenienz]) . "</span>";
	}
	if ($arrMssNamesFile[$intMssNumber][${'mss_Notes_' . $lang}]) 
		$Daten_all .= "\n<br><span class=\"comm\">" . $arrMssNamesFile[$intMssNumber][ ${'mss_Notes_' . $lang}] . "</span>"; 

	if ($arrMssNamesFile[$intMssNumber][$mss_URL]) { 
		$Daten_all .= "\n<br><span class=\"comm\"><a href=\"" . $arrMssNamesFile[$intMssNumber][$mss_URL] . "\" target=\"_blank\">"; 
	    if ($lang == "deu") $Daten_all .= "Quelle online</a></span>";
	      else $Daten_all .= "Source online</a></span>";
  	}

	$Daten_all .= "</span>";

	if ($arrMssNamesFile[$intMssNumber][$mss_Date]) {
		if ($lang== 'deu') {
			$Daten_all .= "\n<br><span class=\"size12\">Datierung: ";
		} else { 
			$Daten_all .= "\n<br><span class=\"size12\">Date: "; 
		}
		$Daten_all .= UmlauteHTML ($arrMssNamesFile[$intMssNumber][$mss_Date]) . "</span>";
	}
}
    
$CurrentMs = str_replace('\\', '',$CurrentMs);

if ($hidden != 1  && $row_ms != 0) {
// Statistik Manuskript
        $Daten_all .= "<span class=\"min\">";
	switch ($lang) {
     	case ("deu") : 
     		if ($type != 'conc') 
			$Daten_all .= "<br>$CurrentMs hat $entries St&uuml;cke";
     		if ($key)  
     		  $Daten_all .= ", davon $pieces_ms St&uuml;cke in $key";
       		break; 
      	case ("eng") : 
		if ($type != 'conc') 
   			$Daten_all .= "<br>$CurrentMs has $entries entries";
     		if ($key)  
     		  $Daten_all .= ", $pieces_ms pieces in $key";
      		break; 
    
     } 
    $Daten_all .= "</span>";
} // hidden
	

if ($Daten && $type != "conc" && $hidden != 1 && $row_ms != 0) 
	$Daten_all .= "</span></h4><hr></td></table>\n";


// Übersicht über Konkordanzen anzeigen
if ($type == 'ms2' || $type == 'ms3') {
	$msAllConcordances[0] = substr ($msAllConcordances[0], 0, -3);
    $msAllConc = explode(" - ",$msAllConcordances[0]);
    natsort ($msAllConc);
 	$countsConcMs = array_count_values($msAllConc);
	$msShowConc = NULL;
	$msShowConcNum = NULL;
	$msCountConc = count($msAllConc);

	
	foreach ($countsConcMs as $key => $value) 
	{ 
		if ($key != $ms) $msShowConc .=	$key . ' = ' . $value . '<br>' ;
			else $msCountIntConc = $value;
	}

 	$countsConcMs = array_count_values($msAllConc);
	arsort ($countsConcMs);
	foreach ($countsConcMs as $key => $value) 
	{ 
		if ($key != $ms) $msShowConcNum .=	$key . ' = ' . $value . '<br>' ;
			else $msCountIntConc = $value;
	}
	

	if ($msAllConcordances[1] > 0) 
	{
		$Daten_all .= '<div class=details>';
		if ($lang == 'deu') $Daten_all .= "<b>Liste der Quellen mit Konkordanzen zu ";
			else $Daten_all .= "List of sources with concordances to ";
		$Daten_all .= $ms . '</b><br>';
		$Daten_all .= '(' . $msAllConcordances[1];
		if ($msAllConcordances[1] === 1) {
			if ($lang == 'deu') $Daten_all .= ' St&uuml;ck hat ' . $msCountConc . ' Konkordanzen) ';
				else $Daten_all .= ' piece has ' . $msCountConc . ' concordances) ';
		} else {
			if ($msAllConcordances[1] > 1) $Daten_all .= ($lang == 'deu')?' St&uuml;cke haben ' . $msCountConc . ' Konkordanzen) ':
				' pieces have ' . $msCountConc . ' concordances) ';
		}
		$Daten_all .= '<details><summary>';
		if ($lang == 'deu') $Daten_all .= 'Alphabetisch</summary>';
			else $Daten_all .= 'Alphabetical</summary>';
		$Daten_all .= '<div class="text3sp">';
		if ($msCountIntConc > 0) $Daten_all .= ($lang === 'deu')?'<i>Interne Konk. = ' . $msCountIntConc . '</i><br>':
				'<i>Internal conc. = ' . $msCountIntConc . '</i><br>';
		$Daten_all .= $msShowConc . '</div></details>';

		$Daten_all .= '<details><summary>';
		if ($lang == 'deu') $Daten_all .= 'Nach Anzahl der Konkordanzen geordnet</summary>';
			else $Daten_all .= 'According to the amount of concordances</summary>';
		$Daten_all .= '<div class="text3sp">';
		if ($msCountIntConc > 0) $Daten_all .= ($lang === 'deu')? '<i>Interne Konk. = ' . $msCountIntConc . '</i><br>':
			'<i>Internal conc. = ' . $msCountIntConc . '</i><br>';
		$Daten_all .= $msShowConcNum . '</div></details></div><br>';
	}

/*
	echo '<div class="acc"><input type="radio" class="open" name="ac" id="Conc" >
      <input type="radio" class="close" name="ac" id="Conc-close" >
      <label for="Conc"><b>Liste der Quellen mit Konkordanzen zu ' . $ms . '</b><br>' . $msAllConcordancesMs 
	  . '</label><label class="close" for="Conc-close"></label>';
	echo '<div class="panel"><div class="text3sp">' . $msAllConcordances . '</div></div></div>';
*/

}




if ($Daten && $hidden !=1) 
{
	$Daten_all .= "<table>\n";
	$Daten_all .= $Daten;
	$Daten_all .= "</table>\n";
} 

$hidden = 1;     
if ($handle) 
	fclose ($handle);
$Daten = NULL;   // Ausgabe-Puffer löschen
$strIfOccurence = NULL;  // delete cash
$content = NULL;

// if ($type == 'ms') break; // Teste, ob bei nm=1000 schneller

}		// end for - manuscript

if ($showinc != 0) {
	if (!isset ($inz_path)) $inz_path = $IncDir;
	if (!isset($usesvg) || $usesvg != 1) make_png ($inz_path, $number); // abctab2ps and imagemagick werden einmal aufgerufen, um alle Bilder zu machen
		else if ($type != 'ms3')  make_svg ($inz_path, $number);
    // remove temporary files
    array_map('unlink', glob($inz_path . '/*.abc'));
    array_map('unlink', glob($inz_path . '/*.eps'));
    array_map('unlink', glob($inz_path . '/*.ps'));
}


if ($usesvg === 1 && $type === 'ms3' && $msvgUpdate === 1) {
	if  ($msvgType == 0)
		make_msvg0 ($CurrentMsOhneUml);
	elseif  ($msvgType == 1)
		make_msvg1 ($CurrentMsOhneUml);

}


// Titelzeile mit Vorwärts- und Rückwärtsfunktion oben

// darüber: Instrumentenauswahl
print show_ArrInstr (); 

$uri = str_replace('\\','',urldecode(getenv("REQUEST_URI")));


// print "<br> makeinz = " . $makeinz;

if($type != "mss" && $type != "conc") Title_above ($uri,$pagetitle[$lang]);
	else PrintTitle_all ($uri,$pagetitle[$lang]);



// nur zum Test
// echo $all_keys;
# nur zum Test: csv-Datei anzeigen
#		print "<a href=\"" . $ms . ".csv\">csv-Datei anzeigen</a><br><br>\n";


$intMssNumberShown = $intMssNumber - $intMssNumberStart;
$intMssNumberShown = $intMssNumberShown  - $intMssNumberNotShown;
$zaehler = 0;

print "<p class=\"c\">";
if (isset($test_ms)) print "<font color=red>Test-Manuscript!!!</font><br>\n";
	$startStart = $start + 1;  
	if ($number < $row_mss) {
		$startEnd = $start + $number;
		if ($startEnd > $row_mss) $startEnd = $row_mss;
        }  else $startEnd = $start + $row_mss - $startStart + 1;      

switch ($lang) {
	case "eng": 
	    if ($row_mss == 0 ) {
			print "There are not yet any entries.";
	    }
	    else { 
	  if ($number == 1 ) {
		print "Entry $startStart of $row_mss pieces in $intMssNumberOccurence of $intMssNumberShown sources is shown.<br>\n";
	  }
	  else {
		if ($type != "conc") {
			if ($type == "mss") print "Entries $startStart to $startEnd of $row_mss entries ($pieces_mss pieces) in $intMssNumberOccurence of $intMssNumberShown sources are shown.<br>\n";
			else print  "Entries $startStart to $startEnd of $row_mss entries ($pieces_mss pieces) in $intMssNumberOccurence of $intMssNumberShown sources are shown.<br>\n";
		} else {
		if ($row_mss > 1)  print "$row_mss concordances from $intMssNumberOccurence of $intMssNumberShown sources are shown.<br>\n";
			else print "$row_mss concordance from $intMssNumberOccurence of $intMssNumberShown sources is shown.<br>\n";
		}
	  }
	  if ($type == "ms" || $type == "ms2" || $type == "ms3" || $type == "mss" || $type == "conc") 
	    {	
	      $filterUsed = 1;
	      print "<br><span class=size16b>Selected Options:</span><br>";
	      if ($ArrInstr) 
	      { 
		foreach ($ArrInstr as $instrx) 
		{ 
			if ($zaehler > 0) $instrument .= ","; 
			$zaehler++;
			$instrument .= $instrx;  
		} 
		print "<b>Instruments</b>=" . $instrument . "</b>";
	      } 
	      if ($type == "mss") print ", <br><b>all sources</b>";
	      if ($type == "conc") print ", <br><b>Concordances</b>";
	      if ($type == "ms" || $type == "ms2" || $type == 'ms3') print ", <br><b>Source = </b>" . $ms ;
	      if ($page) print ", <br><b>page</b> = " . $page;
	      if ($msnam) print ", <br><b>signature</b> = " . $msnam;
	      if ($title) print ", <br><b>title</b> = " . $title;
	      if ($comp) print ", <br><b>composer</b> = " . $comp;
	      if ($key && strpos($key,'selected') !== false) print ", <br><b>key = </b>" .  $keyLang[$key][0];
	      print ".<br>";

	    }
	}
	    break;   
      case "deu":
	    if ($row_mss == 0 ) {
			print "Es gibt bisher keine Eintr&auml;ge.";
	    }
	    else { 
		if ($number == 1 ) {
			print "Eintrag $startStart von $row_mss Eintr&auml;gen ($pieces_mss St&uuml;cke) in $intMssNumberOccurence von $intMssNumberShown Quellen wird angezeigt.<br>\n";
	    	}
	    	else {
			if ($type != "conc") {
				if ($type == "mss") print "Eintr&auml;ge $startStart bis $startEnd von $row_mss Eintr&auml;gen ($pieces_mss St&uuml;cke) in $intMssNumberOccurence von $intMssNumberShown Quellen werden angezeigt.<br>\n";
			else print  "Eintr&auml;ge $startStart bis $startEnd von $row_mss Eintr&auml;gen ($pieces_mss St&uuml;cke) werden angezeigt.<br>\n";
			} else {
				if ($row_mss > 1) print "$row_mss Konkordanzen in $intMssNumberOccurence von $intMssNumberShown Quellen werden angezeigt.<br>\n";
				else print "$row_mss Konkordanz aus $intMssNumberOccurence von $intMssNumberShown Quellen wird angezeigt.<br>\n";
			}
		}
	  	if ($type == "ms" || $type == "ms2" || $type == "ms3" || $type == "mss" || $type == "conc") 
	    {	
	    	    $filterUsed = 1;
	    	    print "<br><span class=size16b>Verwendete Filter:</span><br>";
	      		if ($ArrInstr) 
	      		{ 
					foreach ($ArrInstr as $instrx) 
					{ 
						if ($zaehler > 0) $instrument1 .= ","; 
						$zaehler++;
						$instrument1 .= $instrx;  
					} 
					print "Instrumente = " . $instrument1;
	      		}		
	      		if ($type == "mss") print ", <br>alle Quellen";
	      		if ($type == "conc") print ", <br>Konkordanzen";
	      		if ($type == "ms" || $type == "ms2" || $type == "ms3" ) print ", <br>Quelle = " . $ms;
	      		if ($page) print ", Seite=" . $page;
	      		if ($msnam) print ", Signatur = " . $msnam;
	      		if ($title) print ", Titel = " . $title;
	      		if ($comp) print ", Komponist = " . $comp;
	      		if (($key) && strpos($key,'Tonart') !== false) print ",<br>Tonart = " . $keyLang[$key][1];
	      		print ".<br>";
	   	 }
           }
	   break;
}

// Filter - Suche
/*	print "<div class=details>";
	print "<details ";
	if ($filterUsed === 1) print "open ";
	print "class=ffcc99><summary><b>";
	if ($lang=='deu') print "St&uuml;cke filtern"; else print "Filter pieces";
	print "</b></summary>\n";
	// print explainFilter() . "</summary>\n";
	include ("php_inc/forms.php");
	print "</details>";
	print "</div>"; */
// Ende Filter - Suche
echo $DatenConc;


echo $Daten_all; // Puffer anzeigen

print "<hr noshade size=\"3\">\n";

if($type != "mss" && $type != "conc") Title_below ($uri,$pagetitle[$lang]);
else PrintTitle_all ($uri,$pagetitle[$lang]);
print "</div>\n";

// Falls usesvg und msvgUpdate, $IncDir löschen
if ($msvgUpdate === 1 && $type === 'ms3' && $usesvg === 1)  { exec ("rm -r " . $inz_path);  }




//----------------------------------------------------------------------
//
// Funktion: Titelzeile mit Vorwaerts- und Rueckwaertsfunktion $mss

function PrintTitle_all ($uri,$pagetitle_lang)
{
global $start, $number, $row, $lang, $row_mss, $page;
global $ms,$key_orig, $key_short;
global $type, $conc, $arr_MssConc_max;

$uri = str_replace('&key=' . $key_orig,'&key=' . $key_short,$uri);
$uri = str_replace ('$page=' . $page,'',$uri);

$uri1 = $uri;
if ($type == "mss") {
  $number1 = $number;
  $row1 = $row;
  $row_mss1 = $row_mss;
}
if ($type == "conc") {
  $number1 = 1;
  $row1 = $row;
  $start = substr($conc,1);
  $row_mss1 = $arr_MssConc_max + 1;
}

print "<h3 class=\"mss\"><center>\n"; 


if ($type == "mss") {
  if ($start > 0) {
    $start1 = $start - $number1;
  if ($start1 < 0) $start1 = 0; 
   if (isset($_GET['st'])) {
    $uri1 = str_replace('&st=' . $_GET['st'],'&st=' . $start1,$uri); 
  } else {
    $uri1 = $uri . "&st=" .  $start1;     
  }
  print "<a href=\"" .  $uri1 . "\"><<</a>&nbsp;&nbsp;";
  } else 	{ 
    print "<<&nbsp;&nbsp;";
  }
} elseif ($type == "conc") {
  if ($start > 1) {
    $start1 = $start - $number1;
  if ($start1 < 1) $start1 = 1; 
  if (isset($_GET['conc'])) {
  	$uri1 = str_replace('&conc=' . $_GET['conc'],'&conc=' . substr($conc,0,1) . $start1,$uri); 
  } else {
  	$uri1 = $uri . "&conc=" .  substr($conc,0,1) . $start1;     
  } 	
  print "<a href=\"" .  $uri1 . "\"><<</a>&nbsp;&nbsp;";
  } else 	{ 
    print "<<&nbsp;&nbsp;";
  }
}


print  "\n" . $pagetitle_lang  . "\n";
$start1 = $start + $number1;

if ($type == "mss") {
  if ($start1 >= $row1) $start1 = $row1;
  if (isset($_GET['st'])) {
    $uri1 = str_replace('&st=' . $_GET['st'],'&st=' . $start1,$uri); 
  } else {
    $uri1 = $uri . "&st=" .  $start1;     
  }
} elseif ($type == "conc") {
  if (isset($_GET['conc'])) {
    $uri1 = str_replace('&conc=' . $_GET['conc'],'&conc=' . substr($conc,0,1) . $start1,$uri); 
  } else {
    $conc1 = substr($conc,1) +1;
    $uri1 = $uri . "&conc=" .  substr($conc,0,1) . $start1;     
  } 	
}

if (!($start1 >= $row_mss1)) {
	print "&nbsp;&nbsp;<a href=\"" .  $uri1 . "\">>></a>\n";
} else 	{ 
	print ">>&nbsp;&nbsp;\n";
}
if ($type == "conc") {
	if ($lang == "deu") print "<br><span class=\"smh3\">Konkordanz-Nr. " . $conc . "</span>";
	if ($lang == "eng") print "<br><span class=\"smh3\">Concordance No. " . $conc . "</span>";
}
print "</center></h3>\n";}



// --------------------------------------------------------------
//
// Funktion: Print Title above

function Title_above ($uri,$pagetitle_lang)
{
global $ms,$key_orig, $key_short, $page;

$uri = str_replace ('&page=' . $page,'',$uri);
$uri = str_replace('&key=' . $key_orig,'&key=' . $key_short,$uri);
  print "<h3 class=\"mss\"><center>"; 
  PrintTitle_ms ($uri,$pagetitle_lang);
  print "<br>";
  PrintEntries_ms ($uri);
  print "</center></h3>\n";
}


// --------------------------------------------------------------
//
// Funktion: Print Title below

function Title_below ($uri,$pagetitle_lang)
{
global $ms,$key_orig, $key_short, $page;


$uri = str_replace ('&page=' . $page,"",$uri);
$uri = str_replace('&key=' . $key_orig,'&key=' . $key_short,$uri);
// $uri = str_replace('&key=' . substr($key,0,strpos($key," ")),'&key=' . $key_short,$uri);
  print "<h3 class=\"mss\"><center>"; 
  PrintEntries_ms ($uri);
  print "<br>";
  PrintTitle_ms ($uri,$pagetitle_lang);
  print "</center></h3>\n";
}



// --------------------------------------------------------------
//
// Funktion: Scroll Entries

function PrintEntries_ms ($uri)
{
global $ms,$arrMss,$intMsNumber,$intMsNumberLast,$intMsNumberNext,$start,$number,$row,$lang;

print "<span class=\"smh3\">";
		
if ($start > 0) {
      $start1 = $start - $number;
if ($start1 < 0) $start1 = 0;
	$uri1 = str_replace('&st=' . $start,'&st=' . $start1,$uri); 
	print "<a href=\"" .  $uri1 . "\"><<</a>&nbsp;&nbsp;";
} else 	{ 
	print "<<&nbsp;&nbsp;";
}

if ($lang == "deu") print "In den Eintr&auml;gen bl&auml;ttern\n";
elseif ($lang == "eng") print  "Browse entries\n";


$start1 = $start + $number;
	if ($start1 >= $row) $start1 = $row;
if (isset($_GET['st'])) {
	$uri1 = str_replace('&st=' . $start,'&st=' . $start1,$uri); 
} else {
	$uri1 = str_replace($uri,$uri . '&st=' . $number,$uri);
}
	if (!($start1 >= $row)) {
	print "&nbsp;&nbsp;<a href=\"" .  $uri1 . "\">>></a>\n";
} else 	{ 
	print ">>&nbsp;&nbsp;";
}

print "</span>";

}

// --------------------------------------------------------------
//
// Funktion: Scroll Titel Ms

function PrintTitle_ms ($uri,$pagetitle_lang)
{
global $ms,$arrMss,$arrMssOhneUml,$instr,$intMsNumber,$intMsNumberLast,$intMsNumberNext,$start,$number,$row,$lang,$typetype;

if (!$ms || $intMsNumber == 0) {
    $intMsNumber = 0;
    $intMsNumberLast = 0;
    $intMsNumberNext = 1;
    $uri = "index.php?id=1&amp;type=$typetype&amp;ms=$arrMssOhneUml[0]&amp;lang=" . $lang . "&amp;instr=" . $instr;
}


$ms2 = str_replace('\\', '',$ms);
$uri1 = str_replace('ms=' . UmlauteErsetzen($ms2),'ms=' . UmlauteErsetzen($arrMss[$intMsNumberLast]),$uri); // 20.02.2011
// $uri1 = str_replace('ms=' . $ms2,'ms=' . $arrMss[$intMsNumberLast],$uri); 
$uri1 = str_replace('st=' . $start,'st=0',$uri1); 
if ($arrMss[$intMsNumberLast] != $ms) 
	print "<a href=\"" .  $uri1 . "\"><<</a>&nbsp;&nbsp;\n";
else 	print "<<&nbsp;&nbsp;\n";

print  $pagetitle_lang  . "\n";

$uri1 = str_replace('ms=' . UmlauteErsetzen($ms2),'ms=' . UmlauteErsetzen($arrMss[$intMsNumberNext]),$uri); // 20.02.2011
// $uri1 = str_replace('ms=' . $ms2,'ms=' . $arrMss[$intMsNumberNext],$uri); 
$uri1 = str_replace('st=' . $start,'st=0',$uri1); 
if ($arrMss[$intMsNumberNext] != $ms) 
	print "&nbsp;&nbsp;<a href=\"" .  $uri1 . "\">>></a>\n";
else 	print "&nbsp;&nbsp;>>\n";
}

?>
