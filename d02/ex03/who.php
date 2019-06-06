#!/usr/bin/php
<?php

if (!($fd = fopen("/var/run/utmpx", r)))
	exit ;
date_default_timezone_set('Europe/Kiev');
while ($s = fread($fd, 628)){
	$who = unpack("A256usr/A4id/A32tty/ipid/ityp/Itim", $s);
	if ($who["typ"] !== 7)
		continue ;
	echo $who["usr"]." ".$who["tty"]."  ".date("M  j G:i", $who["tim"])." \n";
}
fclose($fd);
?>