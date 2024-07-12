<?php
   
    //Body=[{"VMSCODE":"VMS001"} , {"VMSCODE":"VMS002" }]
   
	include "BasicAuth.php";
	include "mqttsend.php";
	$entityBody = file_get_contents('php://input');
    $obj= json_decode($entityBody, true);
    $row=count($obj);

    for($i=0;$i<$row;$i++){
        
        if(mqttendminipc($obj[$i]["VMSCODE"],'{"BRINK":"BRINK"}')=="Success"){
            echo '{"RETURN":"OK"}';
        }else{
            echo '{"RETURN":"FAIL"}';
        }		
    }

?>