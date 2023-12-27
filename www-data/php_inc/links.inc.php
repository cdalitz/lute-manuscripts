<?php
$lang1 = 0; # help variable for detecting correct comments 
$linetype = 0;
$endline = 0;

if ($type != "links") $linktype = $type;
	else $linktype = "lute";

$pagetitle = array (
'deu' => "Kontakt / Impressum",
'eng' => "Kontakt / Impressum"
);

switch ($linktype) {
	case "publish":
		$pagetitle = array (
		'deu' => "Verweise<br>Verlage",
		'eng' => "Links<br>Publishers"
		);
		break;
	case "lute":
		$pagetitle = array (
		'deu' => "Verweise<br>Lautenseiten",
		'eng' => "Links<br>Lute sites"
		);
}

print "<h3>" . $pagetitle[$lang] . "</h3>";


// Reads file in array and works line after line
if ($lines = @file ("links/". $linktype . ".inc.php")) { 
  foreach (@$lines as $line_num => $line) {
    $line = trim ($line);
    if (substr ($line,0,4) == "http")   $linetype = "0"; // link
    if (substr ($line,0,1) == "<") {
            if (substr ($line,1,3) == $lang) { 
              $linetype = "1"; // lang1
            } else {
              $linetype = "2"; // other lang
            } 
    }
    if ($line == "")                       $linetype = "3"; // Leerzeile
    
    switch ($linetype) {
	case "0":
        print "<a href=\"" . $line . "\" target=\"_blank\">\n";
        break;

      case "1": 
        $line = str_replace ("<" . $lang. ">","",$line);
        print $line;
	if ($endline != "1") {
		print "</a>";
		$endline = "1";
	}
	print "<br>\n";
        $lang1 = "1";
        break;

      case "2": 
        $lang1 = "0";
        break;

      case "3": 
        print "&nbsp;<br>\n";
		$endline = "0";
        break;

      default:
	  if ($lang1 == "1") {
	    print $line . "<br>\n";
        } 
        break;
     }
  }
} else {
	print "under construction";
}

?>
