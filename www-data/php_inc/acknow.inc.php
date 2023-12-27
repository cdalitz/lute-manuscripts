<?php 
$pagetitle = array (
'deu' => "Autoren und Danksagungen",
'eng' => "Authors and Acknowledgements"
);


print "<h3>" . $pagetitle[$lang] . "</h3>";
?>


<?php
if ($lang=='deu') {
?>
<p><b>Die Seite wurde 2009 ins Leben gerufen und wird seither gepflegt von:</b>
<ul>
  <li>Peter Steur (Datenbank aller zugänglichen Lautenquellen mit Konkordanzen)</li>
  <li>Markus Lutz (Online-Präsentation, Konkordanzen und Inzipit-Generierung, bis 2023)</li>
  <li>Christoph Dalitz (Pflege der Webseite seit 2023)</li>
</ul>
<p>
<b>Unser Dank gilt den unten genannten Personen, <br>die Quellen, Konkordanzen, Inzipits, Ideen etc. beigetragen haben</b> (in alphabetischer Reihenfolge, hoffentlich haben wir keinen vergessen):
<?php
} else {
?>
<p><b>The page was started 2009 and since this time maintained by</b>:
<ul>
  <li>Peter Steur (data base of all available lute sources and concordances)</li>
  <li>Markus Lutz (web presentation, concordances and incipit generation, until 2023)</li>
  <li>Christoph Dalitz (website maintenance, since 2023)</li>
</ul>
<p>
<b>Thanks to the following people, who have contributed sources, concordances, incipits, ideas etc.</b>
<br>(in alphabetical order, hopefully we haven't forgotten noone):
<?php }
?>
<p>
<?php
include "php_inc/persons.php";
?>
<br>&nbsp;<p>
<?php
if ($lang=='deu') {
?>
Die Incipits werden mit abctab2ps und dvisvgm in SVG-Grafiken gewandelt.
Wir danken den Programmautoren Christoph Dalitz (abctab2ps) und Martin Gieseking (dvisvgm) für Ihre Unterstützung.
<?php
} else {
?>
The incipits are transformed to svg with abctab2ps and dvisvgm.
We thank the the authors Christoph Dalitz (abctab2ps) and Martin Gieseking (dvisvgm) for their support.
<?php
} 
?>
<p>

</p>
