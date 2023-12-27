<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
	<meta http-equiv="cache-control" content="no-cache">
	<meta name="author" content="Markus" >
	<meta name="Description" content="Lute music">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
<?php
if ($lang == "deu") {
?>
	<meta http-equiv="lang" CONTENT="de">
	<meta name="Classification" content="Musik">
	<meta name="KeyWords" content="Laute Barock Renaissance Musik Quellen Manuskripte Drucke">

<?php
}
if ($lang == "eng") {
?>
	<meta http-equiv="lang" CONTENT="en">
	<meta name="Classification" content="music">
	<meta name="KeyWords" content="lute baroque renaissance music sources manuscripts prints">

<?php
}
if ($lang == "fra") {
?>
	<meta http-equiv="lang" CONTENT="fr">
	<meta name="Classification" content="musique">
	<meta name="KeyWords" content="luth baroque renaissance musique manuscrites">

<?php  
}

print "<title>". $htmltitle . "</title>\n";

?>
<link rel="stylesheet" type="text/css" href="styles.css?v=1.67">
<link rel="shortcut icon" href="https://mss.slweiss.de/favicon.ico" type="image/x-icon">
</head>

<?php
if ($lang=='deu') {
?>
<body lang="de" class="index">
<?php
}
else {
?>
<body lang="en" class="index">
<?php
}
if ($id=="1") {
?>
<div class="centered">
<?php
} else { 
?>
<div class="centered750">
<?php
}
?>
