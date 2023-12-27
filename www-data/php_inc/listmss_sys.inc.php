<?php

$arrMss;
$intZaehler=0;
$ZeileNr = 0;
$arr_MssNames = make_MssNames();  // Konkordanzendatei einlesen

/*
// Definitionen MssNames.csv
$mss_Sigl_short = Null;
$mss_RISM = Null;
$mss_Sigl_long = Null;
$mss_Library = Null;
$mss_Name_deu = Null;
$mss_Name_eng = Null;
$mss_Notes_deu = Null;
$mss_Notes_eng = Null;
$mss_Provenienz = Null;
$mss_Date = Null;
$mss_URL = Null;
$mss_Instruments = Null;
*/
$arrMssNames = NULL;

 $arrMssNamesFile = MssNamesFile();
 $arrMssNames = MssNames2($arrMssNamesFile);


If ($arrMssNames) {
  $arrMss = $arrMssNames;
  $arrMssOhneUml = UmlauteErsetzen($arrMssNames);
} else {

  $strVerz = dir('mss'); 
  while ($strDatei = $strVerz->read()){ 
	if (strrchr($strDatei,'.')=='.csv') {
    	$arrMssOhneUml[$intZaehler++] = substr($strDatei,0,strrpos($strDatei,'.'));
  /*     	$intZaehler++;    */
	}
  }
}




$intMissingMss = 0;
$intMissingMss2 = 0;
$intMssIncipits = 0;
$strExistingMss = Null;
$strListMss = Null;
$strListMss1 = Null;
$strListMss2 = Null;
if ($mssABC) $MssBuchstabe = $mssABC;
else $MssBuchstabe = 'A';
if ($mssSearch) $MssBuchstabe = Null;



/* // Datei ist bereits vorsortiert!
natsort ($arrMss);
$arrMss1 = array_values ( $arrMss );
$arrMss = array_values ( $arrMss1 );
*/
$intQuantityOfMss = count ($arrMss);

$arrMssAlpha = NULL;
$MssAlpha_local = " ";
$MssAlpha_counter = 0;
$strMssAlpha = NULL;
$counterAnzahl = 0;
$counterAnz2 = 0;
$show_mssSearch = Null;

if ($type == 'ms' || $type == 'ms2' || $type == 'ms3') $typetype = $type;
	else $typetype = 'ms';
 


$strListMss1 = "<div class=\"size16b\">";
$uri = getenv("REQUEST_URI");

for ($i = 0; $i < $intQuantityOfMss; $i++){ 
		if (substr($arrMssOhneUml[$i],0,1) != $MssAlpha_local) {
			$arrMssAlpha[$MssAlpha_counter] = substr($arrMssOhneUml[$i],0,1);
			$MssAlpha_local = substr($arrMssOhneUml[$i],0,1);
			if ($MssAlpha_counter != 0) $strExistingMss .= "</div></div>\n";
			if ($MssAlpha_counter != 0) $strListMss .= "<br></div></div>\n";
//			if ($MssAlpha_counter != 0) $strListMss1 .= "</div>\n";

// Darstellung Buchstaben mit Links
//alt			$strExistingMss .= "<div id=\"LinksVerbergen\"><a class=\"showLinks\" href=\"#LinksVerbergen\">"
			$strExistingMss .= "<div id=\"LinksVerbergen\"><a class=\"showLinks\" href=\"index.php?id=1&amp;type=listmss&amp;mssABC="
			                . $arrMssAlpha[$MssAlpha_counter] . "&amp;lang=" . $lang 
							. "&amp;instr=" . $instr
							. "\">"
			               . $arrMssAlpha[$MssAlpha_counter] . "</a>\n<div class=\"inhaltLinks\">&nbsp;&nbsp;";
			$strListMss .= "<div id=\"LinksVerbergen1\"><a class=\"showLinks1\" href=\"#LinksVerbergen1\">"
			               . $arrMssAlpha[$MssAlpha_counter] . "</a>&nbsp;<br>\n<div class=\"inhaltLinks1\">";
			$strListMss1 .= "<a class=\"size16b\" href=\"index.php?id=1&amp;type=listmss&amp;mssABC="
			                . $arrMssAlpha[$MssAlpha_counter]; 
			if ($lang) $strListMss1 .= "&amp;lang=" . $lang;
			if ($instr) $strListMss1 .= "&amp;instr=" . $instr;
// print $mssDetails . "XX";
			if (isset( $mssDetails)) 
				$strListMss1 .= "&amp;mssDetails=yes";
			$strListMss1 .=  "\">" . $arrMssAlpha[$MssAlpha_counter] . "</a>&nbsp;\n";
// Darstellung Ende

			$MssAlpha_counter++;
		}
     	if (file_exists ("mss/" . $arrMssOhneUml[$i] . ".csv")) {

			$strExistingMss .= "<a class=\"mss1\" href=\"index.php?id=1&amp;type=$typetype&amp;ms=". $arrMssOhneUml[$i] ; 
			if ($lang) $strExistingMss .= "&amp;lang=" . $lang;
			if ($instr) $strExistingMss .= "&amp;instr=" . $instr;
			if ($test && $test == 1) $strExistingMss .= "&amp;test=1";


			$strExistingMss .= "\">". $arrMss[$i] . "</a>&nbsp;&nbsp;\n";

			$strListMss = $strExistingMss;

	
		if ((isset($MssBuchstabe) && substr($arrMssOhneUml[$i],0,1) == $MssBuchstabe)
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Sigl_short']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['RISM']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Sigl_long']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Library']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Name_deu']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Notes_deu']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Name_eng']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Notes_eng']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['Provenienz']),strtolower($mssSearch)))	
			|| (isset($mssSearch) && strstr(strtolower($arr_MssNames[$i]['URL']),strtolower($mssSearch)))	
			) {

			if ( isset($mssDetails) || isset($mssSearch )) {
				$ZeileNr = 0;
				$show_mssSearch = 0;
				if (isset ($instr) && $instr != 'all') 
				{
					if ( isset($mssSearch) ) {
						foreach ( $arrMssOhneUml as $value) {
							if (!strcmp($value, UmlauteErsetzen($arr_MssNames[$i]['Sigl_short']) )) {
								break; 
							}
							$ZeileNr++;
						}						
						if (isset($mssSearch) && $ZeileNr != $intQuantityOfMss ) {
							$ZeileNr2=$i;
							$show_mssSearch = 1;
						}
					}
					else
				 	{
						foreach ( $arr_MssNames as $value) {
							if (!strcmp(UmlauteErsetzen($value['Sigl_short']),$arrMssOhneUml[$i] )) {
								break; 
							}
							$ZeileNr++;
						}						
						if ( $ZeileNr != $intQuantityOfMss ) {
							$ZeileNr2 = $ZeileNr;
							$ZeileNr  = $i;
							$show_mssSearch = 1;
						}
					}
				}
				else { $ZeileNr = $i; $ZeileNr2 = $i; $show_mssSearch=1; } 

				if (isset ($show_mssSearch) && $show_mssSearch == 1) 
				{
					$strListMss2 .= "<div class=\"sources\"><a class=\"size14\" href=\"index.php?id=1&amp;type=$typetype&amp;ms=";
					$strListMss2 .= $arrMssOhneUml[$ZeileNr];  
					$strListMss2 .= "&amp;lang=" . $lang;
					if ($instr) $strListMss2 .= "&amp;instr=" . $instr;
					if ($test && $test == 1) $strListMss2 .= "&amp;test=1";
					$strListMss2 .= "\">". $arrMss[$ZeileNr] . "</a>&nbsp;&nbsp;\n";

// nur zum Testen
// $strListMss2 .= " test i=" . $i ." - ZeileNr=" . $ZeileNr . " ZeileNr2=" . $ZeileNr2 . " " . $arrMss[$ZeileNr2] . "<br>";

// Darstellung mssSearch OR mssDetails

					$strListMss2 .= "<br><span class=\"mss12wrap\"> ";


	 				if ($arr_MssNames[$ZeileNr2]['RISM']) $strListMss2 .= $arr_MssNames[$ZeileNr2]['RISM']; 
					if ($arr_MssNames[$ZeileNr2]['Sigl_long']) $strListMss2 .= " " . $arr_MssNames[$ZeileNr2]['Sigl_long'];
					if ($arr_MssNames[$ZeileNr2]['URL']) $strListMss2 .= " (<a href=\"" . $arr_MssNames[$ZeileNr2]['URL'] . "\">online</a>)";
					if ($arr_MssNames[$ZeileNr2]['Name_deu']) {
						if ($lang == "deu" || !$arr_MssNames[$ZeileNr2]['Name_eng']) 
							$strListMss2 .=  "<br><span class=\"size14\">" . $arr_MssNames[$ZeileNr2]['Name_deu'] . "</span>\n";
						else
							$strListMss2 .=  "<br><span class=\"size14\">" . $arr_MssNames[$ZeileNr2]['Name_eng'] . "</span>\n";
					}
					$strListMss2 .= "<div class=\"sources2\">\n";

					if ($arr_MssNames[$ZeileNr2]['Library']) {
						if ($lang == "deu")
							$strListMss2 .= "<b>Bibliothek:</b> " . $arr_MssNames[$ZeileNr2]['Library'] . "<br>\n";
						else 
							$strListMss2 .= "<b>Library:</b> " . $arr_MssNames[$ZeileNr2]['Library'] . "<br>\n";
					}
					if ($arr_MssNames[$ZeileNr2]['Provenienz']) 
						if ($lang == "deu")
							$strListMss2 .=  "<b>Provenienz:</b> " .  $arr_MssNames[$ZeileNr2]['Provenienz'] . "<br>\n";
						else
							$strListMss2 .=  "<b>Provenience:</b> " .  $arr_MssNames[$ZeileNr2]['Provenienz'] . "<br>\n"; 
					if ($arr_MssNames[$ZeileNr2]['Notes_deu']) 
						if ($arr_MssNames[$ZeileNr2]['Notes_eng'] && $lang== "eng")
							$strListMss2 .=  "<i>" . $arr_MssNames[$ZeileNr2]['Notes_eng'] . "</i>";
						else
							$strListMss2 .=  "<i>" . $arr_MssNames[$ZeileNr2]['Notes_deu'] . "</i>";

					$strListMss2 .= "</span></div></div><div>\n";
// Darstellung Ende
					$counterAnzahl++;
				}
			} else {
				$strListMss2 .= " <a class=\"size14\" href=\"index.php?id=1&amp;type=$typetype&amp;ms=". $arrMssOhneUml[$i]  
				. "&amp;mssABC=" . $MssBuchstabe;

				if ($lang) $strListMss2 .= "&amp;lang=" . $lang;
				if ($instr) $strListMss2 .= "&amp;instr=" . $instr;
				if ($test && $test == 1) $strListMss2 .= "&amp;test=1";

				$strListMss2 .= "\">". $arrMss[$i] . "</a>&nbsp;&nbsp;\n";
				$counterAnzahl++;
			}
		} 
	} else {
			$strExistingMss .= "<span class=\"mss1\">" . $arrMss[$i] . "&nbsp;&nbsp;</span>\n";
			$strListMss .= "<span class=\"mss1\">" . $arrMss[$i] . "&nbsp;&nbsp;</span>\n";
			if (substr($arrMss[$i],0,1) == $MssBuchstabe) {
				$intMissingMss2++;
				if ($mssDetails) { 
					$strListMss2 .= "<div class=\"sources\"><span class=\"size14\"><i>$arrMss[$i]</i>&nbsp;&nbsp;</span>";
					$strListMss2 .= "<br><span class=\"mss12wrap\"> ";
					$ZeileNr2 = $i;


	 				if ($arr_MssNames[$ZeileNr2]['RISM']) $strListMss2 .= $arr_MssNames[$ZeileNr2]['RISM']; 
					if ($arr_MssNames[$ZeileNr2]['Sigl_long']) $strListMss2 .= " " . $arr_MssNames[$ZeileNr2]['Sigl_long'];
					if ($arr_MssNames[$ZeileNr2]['URL']) $strListMss2 .= " (<a href=\"" . $arr_MssNames[$ZeileNr2]['URL'] . "\">online</a>)";
					if ($arr_MssNames[$ZeileNr2]['Name_deu']) {
						if ($lang == "deu" || !$arr_MssNames[$ZeileNr2]['Name_eng']) 
							$strListMss2 .=  "<br><span class=\"size12\">" . $arr_MssNames[$ZeileNr2]['Name_deu'] . "</span>\n";
						else
							$strListMss2 .=  "<br><span class=\"size12\">" . $arr_MssNames[$ZeileNr2]['Name_eng'] . "</span>\n";
					}
					$strListMss2 .= "<div class=\"sources2\">\n";

					if ($arr_MssNames[$ZeileNr2]['Library']) {
						if ($lang == "deu")
							$strListMss2 .= "<b>Bibliothek:</b> " . $arr_MssNames[$ZeileNr2]['Library'] . "<br>\n";
						else 
							$strListMss2 .= "<b>Library:</b> " . $arr_MssNames[$ZeileNr2]['Library'] . "<br>\n";
					}
					if ($arr_MssNames[$ZeileNr2]['Provenienz']) 
						if ($lang == "deu")
							$strListMss2 .=  "<b>Provenienz:</b> " .  $arr_MssNames[$ZeileNr2]['Provenienz'] . "<br>\n";
						else
							$strListMss2 .=  "<b>Provenience:</b> " .  $arr_MssNames[$ZeileNr2]['Provenienz'] . "<br>\n"; 
					if ($arr_MssNames[$ZeileNr2]['Notes_deu']) 
						if ($arr_MssNames[$ZeileNr2]['Notes_eng'] && $lang== "eng")
							$strListMss2 .=  "<i>" . $arr_MssNames[$ZeileNr2]['Notes_eng'] . "</i>";
						else
							$strListMss2 .=  "<i>" . $arr_MssNames[$ZeileNr2]['Notes_deu'] . "</i>";

					$strListMss2 .= "</span></div><div>\n";

				} else $strListMss2 .=  $arrMss[$i] . "&nbsp;&nbsp;\n";
			}
			$intMissingMss++;
		}
}


$strExistingMss .= "</id></id>";
$strListMss .= "</id></id>";

$strListMss1 .= "</span></div>&nbsp;<br><div>" . $strListMss2 . "</div>";

?>
