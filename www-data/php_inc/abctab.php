<?php
putenv("MAGICK_THREAD_LIMIT=1");
$dvisvgmCommand = NULL;

$abctabfonts = "/home/www/abctab2ps/fonts";
if (is_dir("/home/www/abctab2ps/fonts")) putenv ('ABCTABFONTS=' . $abctabfonts);

if (is_dir('/home/www/abctab2ps')) { 
       	$abctabpath = '/home/www/abctab2ps/';
} else        	$abctabpath = '';


if (is_file("php_inc/dvisvgm"))
	{ 
		$dvisvgmCommand =  getcwd() . "/php_inc/dvisvgm";
		if (is_file("php_inc/libgs.so")) 
			$dvisvgmCommand .= " --libgs=" . getcwd() . "/php_inc/libgs.so";
	}
else if (is_file("php_inc/dvisvgm.exe")) 
	{
		$dvisvgmCommand = getcwd() . "/php_inc/dvisvgm.exe";
		if (is_file("php_inc/gsdll32.dll")) 
			$dvisvgmCommand .= " --libgs=" . getcwd() . "/php_inc/gsdll32.dll";
			// print $dvisvgmCommand;
	}
else if (is_dir('/home/www/abctab2ps')) { 
       	 $dvisvgmCommand = "dvisvgm --libgs=" . $abctabpath . "lib/libgs.so";
}  else 
{
	$dvisvgmCommand = "dvisvgm";  
}	

$dvisvgmCommand .= " -d 2 -R -a -O -Z 0.87 -E ";  

$pathImagck = "/usr/bin/";
$file_pathImagck = "php_inc/pathImagck.php";
if (is_file ($file_pathImagck))
	include_once($file_pathImagck);


/*
if (!isset($test)) print "<div class=conthidden>"; else print "<div class=content1>";

print "<br>ABCTABFONTS = " . getenv('ABCTABFONTS');

print "</div>";
*/

function test_inzipit ($ms,$nr) {
    $file_nr = $nr;
    $make_inz_new = 0;

    $inz_filename = "inzipits/" . $ms . "/" . $file_nr . ".png";

// print "TEST - ABC" . $file_nr;

    if (! is_dir ("inzipits")) mkdir ("inzipits"); 
    if (! is_dir ("inzipits/" . $ms)) mkdir ("inzipits/" . $ms); 
    if ( ! is_file ($inz_filename)) {
	$make_inz_new = 1;
    } else {
	$stat_inz = stat($inz_filename);
   	$stat_ms = stat("mss/" . $ms . ".csv");	
	$stat_abctab = stat("php_inc/abctab.php");
	if (($stat_inz[9] < $stat_ms[9]) ||  ($stat_inz[9] < $stat_abctab[9]))
	     $make_inz_new = 1; 
	else $make_inz_new = 0;
    }
	return ($make_inz_new);
    
}


function make_inzipit ($ms,$msnr,$key,$time,$inzipit,$tabnotation) {
global $pathImagck;
global $DirIndex;
$run_abctab = "abctab2ps " . $msnr . ".abc";
$run_imagck =  $pathImagck . "convert -density 90 -transparent \"#FFFFFF\" -trim -bordercolor transparent -gravity Center -border 5 +repage Out.ps " . $msnr . ".png";

$abc_header = MakeHeader ($tabnotation,$time,$key); 

chdir ("inzipits/" . $ms . "/");

$fp = fopen( $msnr . ".abc", "w+");
fputs ($fp, $abc_header . $inzipit . "\n");
fclose($fp);

// passthru ("dir"); 
// passthru ($run_abctab); 
// passthru ($run_imagck); 

exec ($run_abctab); 
// print $run_imagck;
exec ($run_imagck);

// echo "hier ist make_inzipit\n";

// exec ($run_imagck1); 
// exec ($run_imagck2); 


chdir ($DirIndex);
}


function make_inzipit2 ($name,$ms,$msnr) {
global $pathImagck;
$run_abctab = "abctab2ps -e " . $msnr . " ../../mss/" . $name;
$run_imagck = $pathImagck . "convert -density 90 -transparent \"#FFFFFF\" -trim -bordercolor transparent -gravity Center -border 5 +repage Out.ps " . $msnr . ".png";
// $run_imagck1 = "mogrify -trim -bordercolor transparent -gravity Center -border 5 " . $msnr . ".png";
// $run_imagck2 = "convert -density 90 Out.ps +render " . $msnr . ".svg";

chdir ("inzipits/" . $ms . "/");

exec ($run_abctab);
exec ($run_imagck); 
// exec ($run_imagck1); 
// exec ($run_imagck2); 
chdir ("../");
}

function rm_incipits () {
global $IncDir, $IncDir2, $DirIndex;

if (is_dir ($IncDir)) {
	chdir ($IncDir);
	exec ('rm *.*');
	chdir ($DirIndex);	
  }
}



function make_inzipit_neu ($inz_path, $ms,$msnr,$pieceNr,$page,$incipitNr,$key,$time,$inzipit,$tabnotation) {
global $DirIndex;

$abc_header = MakeHeader ($tabnotation,$time,$key); 

chdir ($inz_path);

// $fp = fopen( $incipitNr . ".abc", "w+");

$abcDatei =  sprintf ("%03d", $incipitNr) . "_" . $pieceNr . "_" . myUrlencode($page); 
if (isset($abcDatei)) {
	$fp = fopen($abcDatei . ".abc", "w+");
	fputs ($fp, $abc_header . $inzipit . "\n");
	fclose($fp);
}
chdir ($DirIndex);
}


function make_png ($inz_path, $nmNumber) {
global $pathImagck;
global $abctabpath;
global $DirIndex;
$dirInhalt = NULL;

$dirInhalt = scandir($inz_path);
chdir ($inz_path);
// Test
// print_r ($dirInhalt);
// print $pathImagck;


$i = 0;
$i_max = count ($dirInhalt);
$run_imagck = $pathImagck . "mogrify -define png:color-type=6 -density 85x85 -format png -trim *.ps";


// echo "<table width=100%>";
for ( $i = 0; $i < $i_max ; $i++) {
//	echo $i . ": ";
//	echo $dirInhalt[$i] . "<br>\n";

	if ( strstr($dirInhalt[$i], '.abc')) {
		$Dateiname = myUrlencode(substr($dirInhalt[$i],0,-4));
//		echo $dirInhalt[$i] . $Dateiname . "<br>";

		exec ($abctabpath . "abctab2ps " . $Dateiname . ".abc -O " . $Dateiname . ".ps");

	} 
}

exec ($run_imagck); 
chdir ($DirIndex);
}



function make_svg ($inz_path, $nmNumber,$pieceName = NULL) {
global $DirIndex;
global $pathImagck;
global $abctabpath;
global $dvisvgmCommand;
$dirInhalt = NULL;

//$time_pre = microtime(true);
$run_abctab = $abctabpath . "abctab2ps -E ";
$run_ps2eps = "ps2eps -l "; 

if ($pieceName) {
	chdir ($inz_path);
	exec ($abctabpath . "abctab2ps -F " . $DirIndex . "/php_inc/mss.fmt -E " 
		. $pieceName . " -O " .  $pieceName . ".eps");
	exec ($dvisvgmCommand . $pieceName . "001.eps "); 
} else {
	$dirInhalt = scandir($inz_path);
	chdir ($inz_path);

	// print_r($dirInhalt);  echo "<br>";

		$i = 0;
		$i_max = count ($dirInhalt);

	/*
	for ($i=0; ($i*100) <= $i_max; $i++) {
		exec ($run_abctab . $i . "*.abc");
		exec ($run_ps2eps . $i . "*.ps");
		echo "<br>i = $i";
	}


	for ( $i = 0; $i < $i_max ; $i++) {
	//	if ( strstr($dirInhalt[$i], '.abc')) {
			$Dateiname =  (substr($dirInhalt[$i],0,-4));
			exec ($dvisvgmCommand . "'" . $Dateiname . ".eps' "); 
	//	} 
	}

	*/

	// echo "<table width=100%>";
	for ( $i = 0; $i < $i_max ; $i++) {
	//	echo $i . ": ";
	//	echo $dirInhalt[$i] . "<br>\n";

	//	if ( strstr($dirInhalt[$i], '.abc')) {
			$Dateiname =  (substr($dirInhalt[$i],0,-4));
	//		echo $dirInhalt[$i] . $Dateiname . "<br>";
	// neue Routine mit abctab2ps, ps2eps und dvisvgm
	//		exec ($run_abctab . $Dateiname . '.abc');
	//		exec ($run_ps2eps . $Dateiname . ".ps");
	//		exec ($dvisvgmCommand . "'" . $Dateiname . ".eps' "); 

	// alte Routine mit abctab2ps -E und dvisvgm
				exec ($abctabpath . "abctab2ps -F " . $DirIndex . "/php_inc/mss.fmt -E " . $Dateiname . " -O " .  $Dateiname . ".eps");
			exec ($dvisvgmCommand . $Dateiname . "001.eps "); 
	//	} 
	// else echo "Nein<br>";

	}

	/*		
	//    exec ($abctabpath . "abctab2ps -E " . $i . ".abc -O " . $i . ".eps");
	    exec ($abctabpath . "abctab2ps -E *.abc -O *.eps");
	} 

	for ($i = 0; $i < $nmNumber; $i++) {
	    exec ($abctabpath . $dvisvgmCommand . $i . "001.eps "); 
		} 
	}
*/
}
chdir ($DirIndex);

// $time_post = microtime(true);
// $exec_time = $time_post - $time_pre;
// echo "<br>&nbsp;<br>&nbsp;<br>&nbsp;<br>Die Routine brauchte " . $exec_time . " Sekunden";

}


// ********************* make msvg0 (eine Datei) *******************************
function make_msvg0 ($ms)
{
	global $msvgFile, $inz_path, $DirIndex;
//	$msvgPath= "incipits/";
//	$DateiTyp = "msvg";
// = $msvgPath . $ms . "." . $DateiTyp;
	$incPath = $inz_path . "/";
//	print $incPath;
	$pieceNummer = 0;

//	if (!is_file($msvgFile) || filemtime ($msvgFile) < filemtime ("mss/" . $ms . ".csv"))
//	{
		$handle = fopen ($msvgFile,"w");
		$dirInhalt = scandir($incPath);

		chdir ($incPath);

		// print_r($dirInhalt);  echo "<br>";

		$i = 0;
		$i_max = count ($dirInhalt);

		// echo "count = " . count ($dirInhalt) . "<br>incPath = $incPath <br>";
		// if ($intDec) $svgDecimals = "--svg-decimals " . $intDec . " ";
		//	else $svgDecimals =  "--svg-decimals -1 ";

//		if (exec ("svgo") != 0) { 
//			exec ("svgo *.svg" ); 
//			exec( "touch svgo_was_here"); 
//		}

		for ( $i = 0; $i < $i_max ; $i++) {
		//	echo $i . ": ";
		//	echo $dirInhalt[$i] . "<br>\n";

			if ( strstr($dirInhalt[$i], '.svg')) {
//				$Dateiname = substr($dirInhalt[$i],0,-7);
				$Dateiname = substr($dirInhalt[$i],0,-4);
				$DatInhalt = explode ("_",$Dateiname);
				$DatInhalt1 = $DatInhalt[0] . " - " . $DatInhalt[1] . " - " . $DatInhalt[2];
		//		echo $DatInhalt[0] . " - " . $DatInhalt[1] . " - " . $DatInhalt[2] . "<br>";
				$puffer = "<piece>" . $DatInhalt1 . "</piece>\n";
		//		exec ("minify " . $Dateiname . "001.svg -o " . $Dateiname . "001a.svg" );
		//		$puffer .= file_get_contents ($Dateiname . "001a.svg");
		//		$puffer .= file_get_contents ($Dateiname . "001.svg");
				$puffer .= file_get_contents ($Dateiname . ".svg");
				$puffer .= "\n";
				fwrite ($handle, $puffer); 
				$pieceNummer++;
			}

		} // for 


		chdir ($DirIndex);
		fclose ($handle);

		if ($pieceNummer == 0) exec ("rm " . $msvgFile); 
		//	echo "<br>" . $pieceNummer . " St&uuml;cke in Datei " . $ms . "." . $DateiTyp . " angelegt";
//	}
}



// ********************* make msvg1 (aufgeteilt per 100) *******************************
// noch nicht auf ps2eps umgestellt (ohne 001)
function make_msvg1 ($ms)
{
	global $inz_path, $DirIndex;
	$msvgPath= "incipits/" . $ms[0] . "/" ;
	$DateiTyp = "msvg";
	$msvgFile = $msvgPath . $ms . "." . $DateiTyp;
	$incPath = $inz_path . "/";
	$pieceNummer = 0;

	if (!is_dir("incipits/" . $ms[0] )) mkdir ("incipits/" . $ms[0]);

		$handle = fopen ($msvgFile,"w");
		$dirInhalt = scandir($incPath);

		chdir ($incPath);

		// print_r($dirInhalt);  echo "<br>";

		$i = 0;
		$i_max = count ($dirInhalt);

		// echo "count = " . count ($dirInhalt) . "<br>incPath = $incPath <br>";
		// if ($intDec) $svgDecimals = "--svg-decimals " . $intDec . " ";
		//	else $svgDecimals =  "--svg-decimals -1 ";

//		if (exec ("svgo") != 0) { 
			exec ("svgo *.svg" ); 
//			exec( "touch svgo_was_here"); 
//		}

		$zaehler = 0;
		$hundert = 0;

		for ( $i = 0; $i < $i_max ; $i++) {
		//	echo $i . ": ";
		//	echo $dirInhalt[$i] . "<br>\n";

			if ( strstr($dirInhalt[$i], '.svg')) {
				$Dateiname = substr($dirInhalt[$i],0,-7);
				$DatInhalt = explode ("_",$Dateiname);
				$DatInhalt1 = $DatInhalt[0] . " - " . $DatInhalt[1] . " - " . $DatInhalt[2];
		//		echo $DatInhalt[0] . " - " . $DatInhalt[1] . " - " . $DatInhalt[2] . "<br>";
				$puffer = "<piece>" . $DatInhalt1 . "</piece>\n";
		//		exec ("minify " . $Dateiname . "001.svg -o " . $Dateiname . "001a.svg" );
		//		$puffer .= file_get_contents ($Dateiname . "001a.svg");
				$puffer .= file_get_contents ($Dateiname . "001.svg");
				$puffer .= "\n";
				fwrite ($handle, $puffer); 
				$pieceNummer++;
				$zaehler++;
				if ($zaehler === 100) { 
					$zaehler = 0;
					$hundert++;
					fclose ($handle);
					$msvgFile = $DirIndex . $msvgPath . $ms . "-" . $hundert . "." . $DateiTyp;		
					$handle = fopen ($msvgFile,"w");
				}
			}

		} // for 


		chdir ($DirIndex);
		fclose ($handle);

		if ($pieceNummer == 0) exec ("rm " . $msvgPath . $ms . "." . $DateiTyp); 
		//	echo "<br>" . $pieceNummer . " St&uuml;cke in Datei " . $ms . "." . $DateiTyp . " angelegt";
	
}

// ************************ abc - keys ***************************
function abc_key ($key) {
switch ($key) {
                case "cis moll": $key = "C# MIN"; break;
                case "Cis dur" : $key = "C#"; break;
                case "gis moll": $key = "G# MIN"; break;
                case "Gis dur" : $key = "G#"; break;
                case "dis moll": $key = "D# MIN"; break;
                case "Dis dur" : $key = "D#"; break;
                case "fis moll": $key = "F# MIN"; break;
                case "Fis dur" : $key = "F#"; break;
                case "c moll" : $key = "C MIN"; break;
                case "C dur" : $key = "C"; break;
                case "g moll" : $key = "G MIN"; break;
                case "G dur" : $key = "G"; break;
                case "d moll" : $key = "D MIN"; break;
                case "D dur" : $key = "D"; break;
                case "a moll" : $key = "A MIN"; break;
                case "A dur" : $key = "A"; break;
                case "e moll" : $key = "E MIN"; break;
                case "E dur" : $key = "E"; break;
                case "f moll" : $key = "F MIN"; break;
                case "F dur" : $key = "F"; break;
                
                case "b moll" : $key = "Bb MIN"; break;
                case "h moll" : $key = "B MIN"; break;
                case "B dur" : $key = "Bb"; break;
                case "Bb dur" : $key = "Bb"; break;
                case "eb moll" : $key = "Eb MIN"; break;
                case "Eb dur" : $key = "Eb"; break;
}
return ($key);
}

// ***************************** Make abc-header *****************************

function MakeHeader ($tabnotation,$time1,$key) {
global $length_ms, $tabaddflags_ms, $header_nr, $testsvg, $tabfixfrench;


$titlespace = "0";
$tabrhstyle = "modern";
$tabfontsize = "12"; // wird unten nochmals für unterschiedliche Tabs gesetzt
$tabfontscale = "1.2";
$tabflagspace = "3pt";
$scale = "0.8";
$width = "19.5cm";
$Voice = "L";
$tabbrummer = "ABC";
$length= "1/4";

$tabTypes = array (
	'french4tab',
	'french5tab',
	'frenchtab',
	'germantab',
	'italian4tab',
	'italian5tab',
	'italiantab',
	'italian7tab',
	'italian8tab',
	'spanish4tab',
	'spanish5tab',
	'spanishtab',
	'banjo4tab',
	'banjo5tab',
	'ukuleletab',
	'neapoltab'
);

if (!in_array($tabnotation, $tabTypes)) $tabnotation = 'frenchtab';

if (substr($tabnotation,0,6) == "german") {
    switch ($tabnotation) {
		case "germantab1AB": 
			$tabbrummer = "1AB";
			break;
		case "germantab123": 
			$tabbrummer = "123";
			break;
		case "germantabABC":
			$tabbrummer = "ABC";
			break;
		case "default":
			break;
	}
	$tabnotation = "germantab";
    $tabfontscale = 1.0;
}

if (substr($tabnotation,0,7) == "italian") {
    $tabfontscale = 1.0;
}

if (!$testsvg || $testsvg != 1)	 $titlespace = "0";
    else  $titlespace = "-1";

$time_arr = explode(',',$time1);

if (isset($time_arr[0])) $time = $time_arr[0];
	else $time = "-";

	if (isset($time_arr[1]))	{ 
	   $length = $time_arr[1];
 } else {
 	 if ($length_ms) $length = $length_ms;
		else $length = "1/4";
 }	 

 if (isset($time_arr[2])) {
   	$tabaddflags = $time_arr[2];	
 } else {
		 $tabaddflags = $tabaddflags_ms;
	}	  

$tabnotation = strtolower ($tabnotation);

$abc_test= "tabaddflags_ms = " . $tabaddflags_ms . " tabaddflag = " . $tabaddflags . " length = " . $length .  " header_nr = " . $header_nr .  "\n"; 

if (!$time || $time == '-') $time = "none";

if (isset($tabfixfrench)) {
	switch ($tabnotation) {
	  case "italian4tab" :
				$tabnotation="french4tab";
	  case "italian5tab" :
				$tabnotation="french5tab";
	  case "italiantab" :
				$tabnotation="frenchtab";
	  case "italian7tab" :
				$tabnotation="frenchtab";
	  case "italian8tab" :
				$tabnotation="frenchtab";
	  case "spanishtab" :
	  case "guitartab" :
				$tabnotation="frenchtab";
	  case "spanish5tab" :
	  case "banjo5tab" :
				$tabnotation="french5tab";
	  case "spanish4tab" :
	  case "banjo4tab" :
	  case "ukuleletab" :
				$tabnotation="french4tab";
	  case "germantab" :
				$tabnotation="frenchtab";
	  default :
		  break;
	}
}


switch ($tabnotation) {
  case "italian4tab" :
  case "italian5tab" :
  case "italiantab" :
  case "italian7tab" :
  case "italian8tab" :
  case "spanishtab" :
  case "guitartab" :
  case "spanish5tab" :
  case "banjo5tab" :
  case "spanish4tab" :
  case "banjo4tab" :
  case "ukuleletab" :
	  		$tabfontsize = "11";
  	  break;
  case "frenchtab" :
  case "french4tab" :
  case "french5tab" :
	  $tabfontsize = "12";
	  break;
  case "germantab" :
	  $tabfontsize = "15";
	  break;
  default :
	  break;
}

$abc_header = "X:1
%%%" . $abc_test . 
"L:" . $length . "
M:" . $time ."
%
%%tabrhstyle " . $tabrhstyle . "
%%tabfontsize " . $tabfontsize . "
%%tabfontscale " . $tabfontscale . "
%%tabflagspace " . $tabflagspace . "
%%tabaddflags ". $tabaddflags . "
%%%tabfirstflag
%%tabfontfrench frFrancisque
%%tabfontitalian    itBorrono
%%tabfontgerman   deFraktur
%%tabbrummer " . $tabbrummer . "
%
%%scale " . $scale . "
%%staffwidth " . $width . "
K:" . $key . "
%
V:S clef=treble
V:A clef=treble
V:T clef=bass
V:B clef=bass
V:S8u clef=treble8up
V:S8 clef=treble8
V:FV clef=frenchviolin
V:SC clef=soprano
V:MC clef=mezzosoprano
V:AC clef=alto
V:TC clef=tenor
V:BC clef=baritone
V:L clef=" . $tabnotation . " 
V:L2 clef=" . $tabnotation . " 
V:L3 clef=" . $tabnotation . " 
V:L4 clef=" . $tabnotation . " 
V:L4c clef=french4tab
V:L5c clef=french5tab
V:G clef=guitartab
V:G4 clef=spanish4tab
V:G5 clef=spanish5tab
V:IT clef=italiantab
V:IT2 clef=italiantab
V:IT4 clef=italian4tab
V:IT5 clef=italian5tab
V:IT7 clef=italian7tab
V:IT8	clef=italian8tab
V:LG    clef=germantab
%
[V:" . $Voice . "]
";

$header_nr++;

return ($abc_header);

}

?>
