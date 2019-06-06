<?php
	if ($_POST['login'] && $_POST['oldpw'] && $_POST['newpw'] && $_POST['submit'] && $_POST['submit'] === 'OK') {
		$ac = unserialize(file_get_contents('../private/passwd'));
		if ($ac) {
			$exist = 0;
			foreach ($ac as $key => $val) {
				if ($val['login'] === $_POST['login'] && $val['passwd'] === hash('whirlpool', $_POST['oldpw'])) {
					$ac[$key]['passwd'] = hash('whirlpool', $_POST['newpw']);
					$exist = 1;
				}
			}
			if ($exist) {
				file_put_contents('../private/passwd', serialize($ac));
				echo "OK\n";
			}
			else
				echo "ERROR\n";
		} 
		else 
			echo "ERROR\n";
	}
	else
		echo "ERROR\n";
?>