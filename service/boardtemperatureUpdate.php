<?php
   // include "BasicAuth.php";
    include "mqttsend.php";
    include "DatabaseManage.php";
    $entityBody = file_get_contents('php://input');
    $XISensorType=5;
    //$entityBody='{"VMSCODE":"VMS001","BoardTemperature":32}';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    if($row>0){   
        $dbm=new DatabaseManage();
        $VMSCODE=$obj["VMSCODE"];
        $BoardTemperature=$obj["BoardTemperature"];
      
        $sql="SELECT XISensorType
              FROM dbo.TMstMItmVMS_Status
              WHERE  (XISensorType = $XISensorType)";
       
        $Array=$dbm->QueryDBArr($sql);
        if(count($Array)>0){
            $sql="UPDATE TMstMItmVMS_Status
                SET XIVmsBoardTemperature =  $BoardTemperature
                WHERE XVVmsCode = '$VMSCODE' and XISensorType=$XISensorType";
            echo $sql;
            if($result1=$dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
        }else{
            $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode,XIVmsBoardTemperature, XISensorType,XTWhenEdit) 
            VALUES ('$VMSCODE',$BoardTemperature,$XISensorType,GETDATE())";
            echo $sql;
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