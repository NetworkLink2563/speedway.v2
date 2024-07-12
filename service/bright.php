<?php
    //Body=[{"VMSCODE":"VMS001","BRIGHT":80},{"VMSCODE":"VMS002","BRIGHT":80}]
    include "BasicAuth.php";
	include "mqttsend.php";
	$entityBody = file_get_contents('php://input');
    $obj= json_decode($entityBody, true);
    $row=count($obj);

    for($i=0;$i<$row;$i++){
        $VMSCODE=$obj[$i]["VMSCODE"];
        $BRIGHT=$obj[$i]["BRIGHT"];
        if(mqttendminipc($VMSCODE,$BRIGHT)=="Success"){
            echo '{"RETURN":"OK"}';
        }else{
            echo '{"RETURN":"FAIL"}';
        }		
    }
?>