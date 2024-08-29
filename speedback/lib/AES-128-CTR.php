<?php
function encrypt($plaintext){
    $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
    $PasswordKey = 'Nwl2022!';
    $key = substr(hash('sha256', $PasswordKey, true), 0, 32);
    $encrypted = base64_encode(openssl_encrypt($plaintext, "aes-256-cbc", $key, OPENSSL_RAW_DATA, $iv));
    return $encrypted;
}
function decrypt($encrypted){
   $iv = chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0) . chr(0x0);
   $PasswordKey = 'Nwl2022!';
   $key = substr(hash('sha256', $PasswordKey, true), 0, 32);
   $decrypted = openssl_decrypt(base64_decode($encrypted), "aes-256-cbc",  $key, OPENSSL_RAW_DATA, $iv);
   return $decrypted;
}
//echo decrypt("kOK24RIo625gOSCzPFK5cg==");
?>