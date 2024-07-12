<?php

function showLastCommand($vmsCode){
        include "DatabaseManage.php";
        $sql = "SELECT  TOP 1 *  FROM TMstMItmVMS_Status 
                                 WHERE XVVmsCode='".$vmsCode."' ORDER BY XTWhenEdit desc ";
        $query= sqlsrv_query($conn, $sql);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$textsend=$result['XBVmsIsOn'].'|'.'VMS'.'@'.$result['XBVmsFanIsActive'].'|'.'fan'.'@'.$result['XBVmsFlashIsActive'].'|'.'Flash'.'@'.$result['XIVmsBrightness'].'|'.'Brightness';
    //VMS CHECK
    $vmssend=explode('@',$textsend);
    $vmsExplode=explode('|',$vmssend[0]);
    if($vmsExplode[0]==''){
        echo "";
    }elseif ($vmsExplode[0]==0){
        echo "ปิดระบบไฟฟ้า";
    }elseif ($vmsExplode[0]==1){
        echo "เปิดระบบไฟฟ้า";
    }

    //fan CHECK
    $fansend=explode('@',$textsend);
    $fanExplode=explode('|',$fansend[1]);
    if($fanExplode[0]==''){
        echo "";
    }elseif ($fanExplode[0]==0){
        echo "ปิดพัดลมตู้ควบคุม";
    }elseif ($fanExplode[0]==1){
        echo "เปิดพัดลมตู้ควบคุม";
    }

    //Flash CHECK
    $flashsend=explode('@',$textsend);
    $flashExplode=explode('|',$flashsend[2]);
    if($flashExplode[0]==''){
        echo "";
    }elseif ($flashExplode[0]==0){
        echo "ปิดไฟกระพริบ";
    }elseif ($flashExplode[0]==1){
        echo "เปิดไฟกระพริบ";
    }

    //Brightness CHECK
    $brightnesssend=explode('@',$textsend);
    $brightnessExplode=explode('|',$brightnesssend[3]);
    if($brightnessExplode[0]==''){
        echo "";
    }elseif ($brightnessExplode[0]>=0 & $brightnessExplode[0]<=100){
        echo "ความสว่างตั้งค่าเป็น ".$brightnessExplode[0];
    }elseif ($brightnessExplode[0]==200){
        echo "ความสว่างอัตโนมัติ";
    }
}