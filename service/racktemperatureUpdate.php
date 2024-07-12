<?php

    include "BasicAuth.php";
    include "mqttsend.php";
    include "DatabaseManage.php";
	$entityBody = file_get_contents('php://input');
    $XISensorType=4;
    //$entityBody='{"VMSCODE":"VMS001","RackTemperature":30}';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    if($row>0){   
        $dbm=new DatabaseManage();
        $VMSCODE=$obj["VMSCODE"];
        $RackTemperature=$obj["RackTemperature"];
      
        $sql="SELECT XISensorType
              FROM dbo.TMstMItmVMS_Status
              WHERE  (XISensorType = $XISensorType)";
       
        $Array=$dbm->QueryDBArr($sql);
        if(count($Array)>0){
            $sql="UPDATE TMstMItmVMS_Status
                SET XIVmsRackTemperature =  $RackTemperature
                WHERE XVVmsCode = '$VMSCODE' and XISensorType=$XISensorType";
           
            if($result1=$dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
        }else{
            $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode,XIVmsRackTemperature, XISensorType,XTWhenEdit) 
            VALUES ('$VMSCODE',$RackTemperature,$XISensorType,GETDATE())";
           
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