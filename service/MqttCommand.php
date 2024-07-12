<?php
    
    include "BasicAuth.php";
	include "mqttsend.php";
	$entityBody = file_get_contents('php://input');

    $obj= json_decode($entityBody, true);
    $row=count($obj);
	$ret="";
    for($i=0;$i<$row;$i++){
        $VMSCODE=$obj[$i]["VMSCODE"];
		$CMD=$obj[$i]["CMD"];
		if($CMD==1){
			$BRINK=$obj[$i]["BRINK"];
			$body='{"CMD":'.$CMD.',"BRINK":'.$POWERONOFF.'}';
	    }elseif($CMD==2){
			$BRIGHT=$obj[$i]["BRIGHT"];
			$body='{"CMD":'.$CMD.',"BRIGHT":'.$BRIGHT.'}'; 
		}elseif($CMD==3){
			$SETTIME=$obj[$i]["SETTIME"];
			$body='{"CMD":'.$CMD.',"SETTIME":'.$SETTIME.'}';
		}elseif($CMD==4){
			$RESTART=$obj[$i]["RESTART"];
			$body='{"CMD":'.$CMD.',"RESTART":'.$RESTART.'}';
			
        }elseif($CMD==5){
			$TESTCOMVMS=$obj[$i]["TESTCOMVMS"];
			$body='{"CMD":'.$CMD.',"TESTCOMVMS":'.$TESTCOMVMS.'}';
        }elseif($CMD==6){
			$NEWINFO=$obj[$i]["NEWINFO"];
			$body='{"CMD":'.$CMD.',"NEWINFO":'.$NEWINFO.'}';
        }			
        if(mqttendminipc($VMSCODE,$body)=="Success"){
            $ret= '{"RETURN":"OK"}';
        }else{
            $ret='{"RETURN":"FAIL"}';
        }		
    }
	echo $ret;
?>