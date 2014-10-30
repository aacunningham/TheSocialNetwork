<?php
$to			= 'csci150tsn@gmail.com';
$subject	= 'Password Recovery Test';
$message	= 'hello world';
$headers	= 'From: csci150tsn@gmail.com'	.	"\r\n"	.
				'Reply-To: csci150tsn@gmail.com'	.	"\r\n"	.
				'X-Mailer: PHP/'	.	phpversion();
				
mail($to, $subject, $message);

echo "Email sent2";
?>
