<?php
$Daten_new = NULL;
if ($lang=='deu') {
?>
<h3>Neues auf der Seite</h3>
<p>Hier werden alle wichtigen Änderungen und Ergänzungen aufgelistet.
<div class="new">
<?php
$Daten_new = Neues_einlesen();
echo $Daten_new;
?>

</div>

<?php
}
if ($lang=='eng') {
?>
<h3>Updates</h3>
<p>Here all important changes and additions are listed.
<div class="new">
<?php
$Daten_new = Neues_einlesen();
echo $Daten_new;
?>

</div>

<?php
}






?>
