<?php 
$pagetitle = array (
'deu' => "Kontakt / Impressum",
'eng' => "Kontakt / Impressum"
);


print "<h3>" . $pagetitle[$lang] . "</h3>";
?>

<table width="80%">
<tr>
<td >

<?php
if ($lang=='deu') {
	print "<b>Kontaktdaten/Impressum:</b><br>";
} else {
	print "<b>Adress/Impressum:</b><br>";
}

?>
Peter P.M. Steur<br>
Strada Loreto 12 bis<br>
I-10024 Moncalieri (TO)<br>
Italia<br>
<br>
tel + 39 011 6810486<br>
<br>
<img src="images/psteur.gif"></img><br>
<br>
</td>
<td>
<?php
if ($lang=='deu') {
	print "<b>Webseitenprogrammierung:</b><br>";
} else {
	print "<b>Website programming:</b><br>";
}

?>
Markus Lutz &dagger;<br>
<br>
</td>
</tr>
</table>
<br>&nbsp;

<?php
/*
if (strpos (getenv("REQUEST_URI"),"&disclaimer")) {
	if (@readfile ("http://www.disclaimer.de/disclaimer.htm?farbe=FFFFFF/000000/000000/000000")) {
		print "<br><a href=\"" . str_replace ("&disclaimer","",getenv("REQUEST_URI")) . "\">Haftungsausschluss schlieﬂen</a></span><br>&nbsp;\n";
		print "</H2>\n";
	} else {
*/
if ($lang == "deu") {
	print "<br><a href=\"http://www.disclaimer.de/disclaimer.htm?farbe=FFFFCC/000000/000000/000000#1\" 	
	target=\"_new\">Haftungsausschluss</a>\n"; 
} else {
	print "<br><a href=\"http://www.disclaimer.de/disclaimer.htm?farbe=FFFFCC/000000/000000/000000#2\" 	
	target=\"_new\">Disclaimer</a>\n"; 
}                                                                 
/*
	} 
} else {
print "<br><a href=\"" . getenv("REQUEST_URI") . "&disclaimer\">Haftungsausschluss</a></span></H2>\n"; 
} 
*/
?>
