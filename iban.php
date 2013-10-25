<?php
// Authored by j@chaotisch.org, 2013
// basierend auf http://www.iban.de/iban-pruefsumme.html
function geriban ($country, $blz, $ktnr){
	if ($country != "DE"){
		die('Only Germany supported, use "DE"');
	}
	// Example
	//$country = "DE";
	//$blz = "70090100";
	//$ktnr = "1234567890";
	// care for insufficient length
	$blz = str_pad($blz,8,'0',STR_PAD_LEFT);
	$ktnr = str_pad($ktnr,10,'0',STR_PAD_LEFT);
	//calculation starts here
	$bban = $blz . $ktnr;
	// This is numerical code for Germany D = 13 E = 14, for now hardcoded
	$numcountry = "1314";
	$numcountry = str_pad($numcountry,strlen($numcountry)+2,"0",STR_PAD_RIGHT);
	$psum = $bban . $numcountry;
	// should be 24 
	// to test: echo (strlen($psum));
	$modpsum = bcmod($psum, 97);
	$pz = abs($modpsum - 98);
	if ($pz<10){
		$pz = str_pad($pz,2,'0', STR_PAD_LEFT);
	}
	$iban = $country . $pz . $bban;
	echo($iban . "\n");
	return $iban;
}
?>
