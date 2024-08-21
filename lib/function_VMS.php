<?php

function insertLogVMS($VMScode,$user,$cmd,$option,$docid){
    include "DatabaseManage.php";
    if($cmd=='SETTIME'){
        $XVLctType='01';
    }else if($cmd=='RESTART'){
        $XVLctType='02';
    }else if($cmd=='POWERONOFF'){
        $XVLctType='03';
    }else if($cmd=='BRINK'){
        $XVLctType='04';
    }else if($cmd=='BRIGHT'){
        $XVLctType='05';
    }

    $stmt = "SELECT TOP 1 XVLctValue3 FROM TLogLVmsAction WHERE XVVmsCode='".$VMScode."' AND XVLctValue1='COMMAND' ORDER BY XVLctValue3 DESC";
    $query = sqlsrv_query($conn, $stmt);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
    $countItem=$result['XVLctValue3']+1;

    $sqlInsert = "INSERT INTO [dbo].[TLogLVmsAction]
           ([XVLctType],[XVLctUserCode],[XVLctValue1],[XVLctValue2],[XVLctValue3],[XVVmsCode],[XVSccDocNo])
     VALUES
           ('".$XVLctType."','".$user."','COMMAND','".$option."','".$countItem."','".$VMScode."','".$docid."')";
    sqlsrv_query($conn, $sqlInsert);

    sqlsrv_close( $conn );
}
function callAPICOM($vmscode){
    $data_string = '[{"VMSCODE":"'.$vmscode.'"}]';
    $api_key = "kOK24RIo625gOSCzPFK5cg==";
    $password = "ymfqgoZg6BmJatEcSO7bNw==";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "/service/centerservice.php");
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
    return $response;
}

function callAPIDisplay($vmscode){
    $data_string = '[{"VMSCODE":"'.$vmscode.'"}]';
    $api_key = "kOK24RIo625gOSCzPFK5cg==";
    $password = "ymfqgoZg6BmJatEcSO7bNw==";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "/service/centerdisplay.php");
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
    return $response;
}