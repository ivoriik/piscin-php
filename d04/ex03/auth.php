<?php

function auth($login, $passwd)
{
	if (!$login || !$passwd) {
		return false;
	}
	$ac = unserialize(file_get_contents('../private/passwd'));
	if ($ac) {
		foreach ($ac as $key => $val) {
			if ($val['login'] === $login && $val['passwd'] === hash('whirlpool', $passwd)) {
				return true;
			}
		}
	}
	return false;
}
?>