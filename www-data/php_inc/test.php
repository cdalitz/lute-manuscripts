<?php echo '<html><body>';
$pagetitle = array (
deu => "Auswahl der Quelle",
eng => "Selection of source",
fra => "S&eacute;lection de un manuscrit"
);

$lang='deu';

print "<h3>" . $pagetitle[$lang] . "</h3>";

print "<form action=\"index.php?\" method=\"get\">\n";
print "<select name=\"ms\" size=20>\n";

$current_row = 1;



# $handle = fopen("works/mss.csv", "r");              // Anzahl der Array            
                                               // Datei zum Lesen öffnen
$ms_long = array (
deu => 1, // ms_long_deu
eng => 2, // ms_long_eng
fra => 3  // ms_long_fra
);

$verz = dir('.'); 
while ($datei = $verz->read()){ 
             if (strrchr($datei,'.')=='.csv') 
       print "<option value=\"" . substr($datei,0,strrpos($datei,'.')) . "\">" . substr($datei,0,strrpos($datei,'.')) . "</option>\n";
   $current_row++;


}


$send = array (
deu => "Absenden",
eng => "Send",
fra => "Selecter"
);

print "</select>\n";
print "<input type=\"hidden\" name=\"lang\" value=\"" . $lang ."\">\n" ;
print "<input type=submit value=" . $send[$lang] . ">\n</form>";

?>
