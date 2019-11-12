<?php
//echo ini_get('SMTP') . ":" . ini_get('smtp_port'); 
//echo phpinfo();
$headers = 'From: noreply@quakbox.com';
//$ret = mail('dmitry@htmlin.com', 'Test email using PHP', 'This is a test email message', $headers);
$ret = mail('naresh.shaw@gmail.com', 'Test email from quakbox server', 'This is a test email message, WOW mailing is working now from server', $headers);
//$ret = mail('gatien41@gmail.com', 'Test email from quakbox server', 'This is a test email message, WOW mailing is working now from server', $headers);
