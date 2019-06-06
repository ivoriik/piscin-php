#!/usr/bin/php
<?php

function if_match($matches)
{
$matches[0] = preg_replace_callback('/(title=)(\"|\')(.*)(\"|\')(>)/Ui', function ($matches) {
	return ($matches[1].$matches[2].strtoupper($matches[3].$matches[4].$matches[5]));
}, $matches[0]);
$matches[0] = preg_replace_callback('/(>)(.*)(<)/Ui', function ($matches) {
	return ($matches[1].strtoupper($matches[2]).$matches[3]);
}, $matches[0]);
return ($matches[0]);
}

if ($argc < 2 || !is_readable($argv[1]) || is_dir($argv[1]))
	exit ;
if (!($s = file_get_contents($argv[1])))
	exit ;
$rexp = '/(?:<a)(?:.*?>)(?:.*?<)(?:\/a>)/';
$s = preg_replace_callback($rexp, if_match, $s);
echo $s;
?>