<?php
   
    //Body=[{"VMSCODE":"VMS001"} ,{"VMSCODE":"VMS002" }]
   
	include "BasicAuth.php";
	
	require('phpMQTT.php');
	function mqttendminipc_service($VMSCODE,$data){
    
	 $ret="";
		$server = '10.12.12.210';   
		//$server = 'www.networklink.co.th';   
		$port = 1883;                     
		$username = 'user';                  
		$password = '!NWLmqttuser';                  
		$client_id = 'phpMQTT-publisher'; 
		$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
		
		if ($mqtt->connect(true, NULL, $username, $password)) {
			
			$mqtt->publish('Center/Service/'.$VMSCODE.'/' , $data , 0, false);
			$mqtt->close();
			$ret="Success";
		}else{
			$ret="Fail";
		}
		return $ret; 
	} 
	$entityBody = file_get_contents('php://input');
   
    $obj= json_decode($entityBody, true);
  
    $row=count($obj);
   
    for($i=0;$i<$row;$i++){
           
        if(mqttendminipc_service($obj[$i]["VMSCODE"],'{"NewInfo":"NewInfo"}')=="Success"){
            echo '{"RETURN":"OK"}';
        }else{
            echo '{"RETURN":"FAIL"}';
        }		
    }

?>