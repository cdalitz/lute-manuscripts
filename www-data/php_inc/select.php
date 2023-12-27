<?php 
$pagetitle = array (
'deu' => "Auswahl des Manuskriptes",
'eng' => "Selection of manuscript",
'fra' => "S&eacute;lection de un manuscrit"
);


print "<h3>" . $pagetitle[$lang] . "</h3>";

print "<form action=\"index.php?\" method=\"get\">\n";
print "<select name=\"ms\" size=20>\n";

$current_row = 1;



# $handle = fopen("works/mss.csv", "r");              // Anzahl der Array            
                                               // Datei zum Lesen öffnen

$ms_long = array (
'deu' => 1, // ms_long_deu
'eng' => 2, // ms_long_eng
'fra' => 3  // ms_long_fra
);


for ($intZaehler = 0; $intZaehler < $intQuantityOfMss; $intZaehler++){ 
       print "<option value=\"" . str_replace('\\', '', ($arrMssOhneUml[$intZaehler])) . "\">" . str_replace('\\', '',$arrMss[$intZaehler]) . "</option>\n";
}

/*
$verz = dir('mss'); 
while ($datei = $verz->read()){ 
             if (strrchr($datei,'.')=='.csv') 
       print "<option value=\"" . substr($datei,0,strrpos($datei,'.')) . "\">" . substr($datei,0,strrpos($datei,'.')) . "</option>\n";
#   $current_row++;
}
*/

$send = array (
'deu' => "Absenden",
'eng' => "Send",
'fra' => "Selecter"
);

print "</select>\n";
print "<input type=\"hidden\" name=\"id\" value=\"2\">\n" ;
print "<input type=\"hidden\" name=\"type\" value=\"ms\">\n" ;
print "<input type=\"hidden\" name=\"lang\" value=\"" . $lang ."\">\n" ;
print "<input type=submit value=" . $send[$lang] . ">\n</form>";

?>