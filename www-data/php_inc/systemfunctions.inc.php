<?php
// error_reporting(E_Warning);
set_error_handler ("getErrorHandler"); 

// --------------------- function getErrorHandler ----------------------------
function getErrorHandler($errno,$errmsg,$filename,$linenum) {
    if (!(error_reporting() & $errno)) {
        return false;
	} else {

	  $error = "Zeit: " . date("Y-m-d, H:i:s") . "\n";
	  $error .= "Meldung: " .$errmsg. "\n";
	  $error .= "URL: " . getenv("REQUEST_URI") . "\n";
	  $error .= "Datei: " .$filename. "\n";
	  $error .= "Zeile: " .$linenum. "\n";
	// mail("markus@gmlutz.de", "Skript-Fehler aufgetreten", $error, "From: Webmaster Mss-Seite <markus@gmlutz.de>");  
	  $handle = @fopen ("phperror_log.txt", 'a'd);
	  @fwrite($handle, $error);
	  @fclose($handle);
	}
}

?>
