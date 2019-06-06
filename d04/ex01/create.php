<?php
	if ($_POST['login'] && $_POST['passwd'] && $_POST['submit'] && $_POST['submit'] === 'OK') {
		if (!(file_exists('../private'))) {
			mkdir('../private');
		}
		if (!(file_exists('../private/passwd'))) {
			file_put_contents('../private/passwd', 0);
		}
		$ac = unserialize(file_get_contents('../private/passwd'));
		if ($ac) {
			$exist = 0;
			foreach ($ac as $key => $val) {
				if ($val['login'] === $_POST['login'])
					$exist = 1;
			}
		}
		if ($exist) {
			echo "ERROR\n";
		}
		else {
			$new['login'] = $_POST['login'];
			$new['passwd'] = hash('whirlpool', $_POST['passwd']);
			$ac[] = $new;
			file_put_contents('../private/passwd', serialize($ac));
			echo "OK\n";
		}
	}
	else {
		echo "ERROR\n";
    }
?>