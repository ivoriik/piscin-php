#!/usr/bin/php
<?php

function mk_dir($name)
{
	if (!(file_exists($name)))
		mkdir($name);
	else if (!is_dir($name))
		return (0);
	return (1);
}

if ($argc < 2)
	exit ;
$page = preg_replace('/^https?:\/\//', '', $argv[1]);
$file = preg_replace_callback('/[a-z]\.)([[:alnum:]]*)(\..*)/i', function ($matches) {
	return ("logo".$matches[2]."-site.gif");
}, $page);
if (!(mk_dir($page)))
	exit ;
$ch = curl_init($argv[1]);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
$fp = fopen($page."/".$file, "w");
fclose($fp);
$img_data = array("image"=>"@".$page."/".$file);
curl_setopt($ch, CURLOPT_POSTFIELDS, $img_data);
curl_exec($ch);
curl_close($ch);
?>