<?php
      $neu_lang = array (
      'deu' => "<td><a href=\"index.php?id=0&type=new&lang=" . $lang . "\">Neues!</td>",
      'eng' => "<td><a href=\"index.php?id=0&type=new&lang=" . $lang . "\">New!</td>"
      );

$numberPieces = 55000;
$numberSources = 810;
$text_index = array (
			'deu' => array ("Musik f&uuml;r Lauteninstrumente",
					"Eine Datenbank der historischen<br>Manuskripte und Drucke",
					"Mehr als " . $numberPieces . " St&uuml;cke<br>mit Konkordanzen und Incipits<br>von ungefähr " . $numberSources . " Manuskripten/Drucken",
					"Von Peter Steur, Moncalieri/Italien<br>und Markus Lutz, Bad Buchau/Deutschland",
					"Unter Mitwirkung von:"),
			'eng' => array ("Music for Lute Instruments",
					"A Database of the historical<br>Manuscripts and Prints",
					"More than " . $numberPieces . " pieces<br>with concordances and incipits<br>from about " . $numberSources . " manuscripts/prints",
					"By Peter Steur, Moncalieri/Italy<br>and Markus Lutz, Bad Buchau/Germany",
					"With the help of :")
			);


print "<br><h2>";
print $text_index[$lang][0];
print "<span class=smh2><br>";
print $text_index[$lang][1];
print "</span><span class=smh4><br>&nbsp;<br>";
print $text_index[$lang][2];
print "<br></span></h2>";
print "<p class=c>";
print $text_index[$lang][3];
print "<br><br><p class=c><span class=font10>";
print $text_index[$lang][4];
print "</span><br>";


print "<table><tr><td width=15%></td><td width=70%><p class=c><span class=font10ic>";
include "php_inc/persons.php";
print "</span></td><td width=15%></td></tr></table><br>";

print "<p class=\"c\"><a href=index.php?id=2&amp;type=acknow&amp;lang=$lang>";
if ($lang=='deu') {
	print "Danksagungen";
} elseif ($lang=='eng') {
	print "Acknowledgements";
}
print "</a></i></p>";
print "&nbsp; <p class=\"c\"><a href=\"index.php?lang=$lang&amp;id=0&amp;type=about\">";
if ($lang=='deu') {
	print "Informationen über die Seite";
} elseif ($lang=='eng') {
	print "About the site"; 
}
print "</a></p>";
print "<br>&nbsp;";
print "<table class=cpvd1><tr>" . $neu_lang[$lang];
print "<td><marquee hspace=\"10px\">" . Neues_einlesen(3) . "</marquee></span></td>\n";
print  $neu_lang[$lang] . "</tr></table><br>&nbsp;";
?>
