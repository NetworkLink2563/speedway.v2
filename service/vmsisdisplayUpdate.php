<?php
    include "BasicAuth.php";
    include "mqttsend.php";
    include "DatabaseManage.php";
	$entityBody = file_get_contents('php://input');
    $XISensorType=2;
    //$entityBody='{"VMSCODE":"VMS001","VMSISDISPLAY":1}';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    if($row>0){   
        $dbm=new DatabaseManage();
        $VMSCODE=$obj["VMSCODE"];
        $VMSISDISPLAY=$obj["VMSISDISPLAY"];
        $sql="SELECT XISensorType
              FROM dbo.TMstMItmVMS_Status
              WHERE  (XISensorType = $XISensorType)";
       
        $Array=$dbm->QueryDBArr($sql);
        if(count($Array)>0){
            $sql="UPDATE TMstMItmVMS_Status
                SET XBVmsIsDisplay =  $VMSISDISPLAY
                WHERE XVVmsCode = '$VMSCODE' and XISensorType=$XISensorType";
            if($result1=$dbm->InserDelUpdatetDB($sql)){
                echo "Success";
            }else{
                echo "Fail";
            }
        }else{
            $sql="INSERT INTO TMstMItmVMS_Status (XVVmsCode,XBVmsIsDisplay, XISensorType,XTWhenEdit) 
            VALUES ('$VMSCODE',$VMSISDISPLAY,$XISensorType,GETDATE())";
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