<?php
     require('phpMQTT.php');
    function mqttsendrpi($VMSCODE,$data){
    
	 $ret="";
		$server = '10.12.12.210';   
		//$server = 'www.networklink.co.th';   
		$port = 1883;                     
		$username = 'user';                  
		$password = '!NWLmqttuser';                  
		$client_id = 'phpMQTT-publisher'; 
		$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
		
		if ($mqtt->connect(true, NULL, $username, $password)) {
			
			$mqtt->publish('SPEEDWAY/DOWNLINKRPI/'.$VMSCODE , $data , 0, false);
			$mqtt->close();
			$ret="Success";
		}else{
			$ret="Fail";
		}
		return $ret; 
	}
	
?>