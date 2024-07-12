<?php
    
    include "BasicAuth.php";
	include "mqttrpisend.php";
	$entityBody = file_get_contents('php://input');
    //$entityBody ='[{"VMSCODE":"VMS001","CMD":1,"BRINK":1},{"VMSCODE":"VMS002","CMD":1,"BRINK":1}]';
    $obj= json_decode($entityBody, true);
    $row=count($obj);
	$ret="";
    for($i=0;$i<$row;$i++){
        $VMSCODE=$obj[$i]["VMSCODE"];
		$CMD=$obj[$i]["CMD"];
		if($CMD==7){
			$POWERONOFF=$obj[$i]["POWERONOFF"];
			$body='{"CMD":'.$CMD.',"POWERONOFF":'.$POWERONOFF.'}';
			 
		}
        if(mqttsendrpi($VMSCODE,$body)=="Success"){
            $ret= '{"RETURN":"OK"}';
        }else{
            $ret= '{"RETURN":"FAIL"}';
        }		
    }
	echo $ret;
?>