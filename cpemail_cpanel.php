<?php
error_reporting(E_All);
ini_set('display_errors',1);

//require_once "/usr/local/cpanel/php/cpanel.php";
//https://quakbox.com/cpemail_cpanel.php
require_once "/usr/local/cpanel/base/3rdparty/roundcube/plugins/password/drivers/cpanel.php";
echo "<br> Going to call Cpanel";

$cpanel = new CPANEL(); 
// Connect to cPanel - only do this once.
  
// Create the user@example.com email address.
$new_email = $cpanel->uapi(
    'Email', 'add_pop',
    array(
        'email'           => 'naresh789',
        'password'        => 'nare$#1234',
        'quota'           => '20',
        'domain'          => 'equakbox.com',
        'skip_update_db'  => '1',
        )
);
echo "<pre><br>created";
print_r($cpanel);
?>