<?php
error_reporting(E_All);
ini_set('display_errors',1);
$username="wwwquakb";
$password="_0!g0e]voYwV";
$url ="https://quakbox.com:2083/cpsess4708774835/execute/Email/add_pop?quota=20&email=naresh421&password=nare#@422&domain=quakbox.com&skip_update_db=1";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_TIMEOUT, 30); //timeout after 30 seconds
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");
$result=curl_exec ($ch);
$status_code = curl_getinfo($ch);   //get status code
curl_close ($ch);

echo "<pre>info details are mentioned below:";
print_r($status_code);

/*

//hostname.example.com:2083/cpsess##########/execute/Email/passwd_pop?email=user&password=12345luggage&domain=example.com
https://hostname.example.com:2083/cpsess##########/execute/Email/add_pop?email=user&password=12345luggage&quota=0&domain=example.com&skip_update_db=1

uapi --user=wwwquakb Email add_pop email=naresh421 password=nare#@422 domain=quakbox.com quota=20 skip_update_db=1


Note:

Th
uapi --user=username Email passwd_pop email=n password=12345luggage domain=example.com
uapi --user=wwwquakb Email add_pop email=naresh980 password=Ls1@as45$Luggage domain=example.com
uapi --user=wwwquakb Email add_pop email=naresh980 password=Ls1@as45$Luggage domain=quakbox.com


require_once "/usr/local/cpanel/php/cpanel.php";
echo "<br> Going to call Cpanel";
$cpanel = new CPANEL(); // Connect to cPanel - only do this once.
echo "<pre><br> connecting cpanel";
print_r($cpanel);
  
// Create the user@example.com email address.
$new_email = $cpanel->uapi(
    'Email', 'add_pop',
    array(
        'email'           => 'naresh123@quakbox.com',
        'password'        => 'nare$#1234',
        'quota'           => '0',
        'domain'          => 'quakbox.com',
        'skip_update_db'  => '1',
        )
);
echo "<pre><br>created";
print_r($new_email);

//https://hquakbox.com:2083/cpsess4708774835/execute/Email/add_pop?email=naresh123&password=12345luggage&quota=0&domain=quakbox.com&skip_update_db=1

*/
//https://quakbox.com:2083/cpsess4708774835/passwd_pop?email=naresh345&password=nare#1234&domain=quakbox.com
//"curl -u wwwquakb:_0!g0e]voYwV https://quakbox.com:2083/cpsess4708774835/passwd_pop?email=naresh345&password=nare#1234&domain=quakbox.com"

//"/usr/local/cpanel/bin/uapi --user=username Email passwd_pop email=user password=12345luggage domain=example.com"
//"/usr/local/cpanel/bin/uapi --user=wwwquakb Email passwd_pop passwd_pop email=naresh345 password=DAMIT&@!89#$ domain=quakbox.com"
//"https://hostname.example.com:2083/cpsess##########/execute/Email/passwd_pop?email=user&password=12345luggage&domain=example.com"
//https://quakbox.com:2083/cpsess4708774835/Email/passwd_pop?email=naresh123&password=nare#1234&domain=quakbox.com
?>