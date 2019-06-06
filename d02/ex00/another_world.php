#!/usr/bin/php
<?php

if ($argc >= 2 && array_filter($tab = preg_split('/(\s+|\t+)/', trim($argv[1])))) {
	foreach ($tab as $key => $value) 
		$str .= $value." ";
	echo rtrim($str, " ")."\n";
}
?>