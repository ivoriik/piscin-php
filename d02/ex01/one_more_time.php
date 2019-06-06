#!/usr/bin/php
<?php

function is_format($s)
{
$mo = array("janvier", "fevrier", "février", "mars", "avril", "mai", "juin", "juillet", "aout", "août", "septembre", "octobre", "novembre", "decembre", "décembre");
$dy = array("lunde", "mardi", "mercredi", "jeudi", "vendredi", "samedi", "dimanche");
for ($i = 0; $i < 7; $i++) { 
	for ($j=0; $j < 15; $j++) { 
		$exp = "/^".$dy[$i]."\s\d{1,2}\s".$mo[$j]."\s\d\d\d\d\s\d\d:\d\d:\d\d$/";
		if (preg_match($exp, $s)) {
			return (1);
		}
	}
}
return (0);
}

function month($s)
{
	if ($s == "janvier")
		return ("01");
	if ($s == "fevrier" || $s == "février")
		return ("02");
	if ($s == "mars")
		return ("03");
	if ($s == "avril")
		return ("04");
	if ($s == "mai")
		return ("05");
	if ($s == "juin")
		return ("06");
	if ($s == "juillet")
		return ("07");
	if ($s == "aout" || $s == "août")
		return ("08");
	if ($s == "septembre")
		return ("09");
	if ($s == "octobre")
		return ("10");
	if ($s == "novembre")
		return ("11");
	if ($s == "decembre" || $s == "décembre")
		return ("12");
}

if ($argc < 2)
	return ;
if (!($tab = is_format($s = strtolower($argv[1])))) {
	echo "Wrong Format\n";
	return ;
}
$tab = preg_split("/\s/", $s);
$tab[2] = month($tab[2]);
$tab[4] = explode(":", $tab[4]);
date_default_timezone_set("Europe/Paris");
echo mktime($tab[4][0], $tab[4][1], $tab[4][2], $tab[2], $tab[1], $tab[3])."\n";
?>