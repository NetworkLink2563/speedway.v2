<?php
    include "BasicAuth.php";
    include "mqttsend.php";
    include "DatabaseManage.php";
	$entityBody = file_get_contents('php://input');
    $XISensorType=1;
    //$entityBody='{"VMSCODE":"VMS001","VMSISON":0}';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    if($row>0){   
        $dbm=new DatabaseManage();
        $VMSCODE=$obj["VMSCODE"];
        $VMSISON=$obj["VMSISON"];
        $sql="SELECT XISensorType
              FROM dbo.TMstMItmVMS_Status
              WHERE  (XISensorType = $XISensorType)";
       
        $Array=$dbm->QueryDBArr($sql);
        if(count($Array)>0){
            /*
            $sql="UPDATE TMstMItmVMS_Status
                SET XBVmsIsOn =  $VMSISON
                WHERE XVVmsCode = '$VMSCODE' and XISensorType=$XISensorType";
            if($result1=$dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }*/
        }else{
            /*
            $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode,XBVmsIsOn, XISensorType,XTWhenEdit) 
            VALUES ('$VMSCODE',$VMSISON,$XISensorType,GETDATE())";
            if($dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
            */
        }
    }else{
        echo "Success";
    }
   
?>