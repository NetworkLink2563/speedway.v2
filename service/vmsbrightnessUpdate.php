<?php
    include "BasicAuth.php";
    include "mqttsend.php";
    include "DatabaseManage.php";
	$entityBody = file_get_contents('php://input');
    $XISensorType=3;
    //$entityBody='{"VMSCODE":"VMS001","BRIGHTNESS":10}';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    if($row>0){   
        $dbm=new DatabaseManage();
        $VMSCODE=$obj["VMSCODE"];
        $BRIGHTNESS=$obj["BRIGHTNESS"];
        $sql="SELECT XISensorType
              FROM dbo.TMstMItmVMS_Status
              WHERE  (XISensorType = $XISensorType)";
       
        $Array=$dbm->QueryDBArr($sql);
        if(count($Array)>0){
            $sql="UPDATE TMstMItmVMS_Status
                SET XIVmsBrightness =  $BRIGHTNESS
                WHERE XVVmsCode = '$VMSCODE' and XISensorType=$XISensorType";
            if($result1=$dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
        }else{
            $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode,XIVmsBrightness, XISensorType,XTWhenEdit) 
            VALUES ('$VMSCODE',$BRIGHTNESS,$XISensorType,GETDATE())";
            if($dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
        }
    }else{
        echo "Success";
    }
   
?>