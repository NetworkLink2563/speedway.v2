<?php

$data_string = '{
    "VmsCode":"VMS001",
    "PdfFileName":"C:\\inetpub\\wwwroot\\VMS\\TMPPDF\\Presentation1.pdf",
    "PngFileName":"001.png",
    "DestinationPath":"C:\\inetpub\\wwwroot\\VMS\\VMSIMG",
     "Width":482,
     "Height":320
}';
$api_key = "kOK24RIo625gOSCzPFK5cg==";
$password = "ymfqgoZg6BmJatEcSO7bNw==";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "http://127.0.0.1:5001");
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERPWD, $api_key.':'.$password);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json')
);

if(curl_exec($ch) === false)
{
    echo 'Curl error: ' . curl_error($ch);
}
$errors = curl_error($ch);
$result = curl_exec($ch);
$returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);
$response =  json_decode($result,true);

