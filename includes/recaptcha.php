<?php
$rCode = $_POST['g-recaptcha-response'];
$rUrl = 'https://www.google.com/recaptcha/api/siteverify';
$rSecret = '6LeFKrsUAAAAACDos9htAzQlMMst7q8DY3zkOHXu';
$ip = $_SERVER['REMOTE_ADDR'];


$curl = curl_init($rUrl);

curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
curl_setopt($curl, CURLOPT_POSTFIELDS, 'secret='.$rSecret.'&response='.$rCode.'&remoteip='.$ip);
curl_setopt($curl, CURLINFO_HEADER_OUT, false);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$res = curl_exec($curl);
curl_close($curl);
$res = json_decode($res);

if ($res->success) {
    //Капча введена верно
    ....
} else {
    //Это бот или человек который не умеет пользоваться капчой
    ....
}

?>