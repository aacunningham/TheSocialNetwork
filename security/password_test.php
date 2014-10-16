<?php
	echo "pass word hash",PHP_EOL;
	$hashpass = password_hash("password", PASSWORD_BCRYPT);
	echo "\r\n".$hashpass;
	
	$pass_test = password_verify("password","\$2y\$10\$TJg/q1brX1bGopQE/6CyheLN8Pjj/W1rSPOuFUDMzJLtYIi4BEwD2");
	
	if ($pass_test){
		echo PHP_EOL;
		echo ".have a good day";
	}
?>
