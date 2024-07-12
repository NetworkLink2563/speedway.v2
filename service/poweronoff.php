<?php
    //Body=[{"VMSCODE":"VMS001", "POWERONOFF":"ON"}, {"VMSCODE":"VMS002", "POWERONOFF":"ON"}]
    include "BasicAuth.php";
	include "mqttsend.php";
	$entityBody = file_get_contents('php://input');
    $obj= json_decode($entityBody, true);
    $row=count($obj);
    
    for($i=0;$i<$row;$i++){
        $VMSCODE=$obj[$i]["VMSCODE"];
        $POWERONOFF=$obj[$i]["POWERONOFF"];
        if(mqttendminipc($VMSCODE,$POWERONOFF)=="Success"){
            echo '{"RETURN":"OK"}';
        }else{
            echo '{"RETURN":"FAIL"}';
        }		
    }
    
?>