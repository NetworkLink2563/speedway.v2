<?php
function publish($json){
	$ret="";
	$server = '10.12.12.217';     
	$port = 13883;                     
	$username = 'user';                  
	$password = '!NWLmqttuser';                  
	$client_id = 'phpMQTT-publisher'; 
	$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
	if ($mqtt->connect(true, NULL, $username, $password)) {
		$mqtt->publish('NWL_Weather/S22001', $json , 0, false);
		$mqtt->close();
		$ret="Success";
	}else{
        $ret="Fail";
	}
	return $ret;
}

function MqttPublish($ClientId,$Publish){
	$myfile = fopen("../Webconfig/WebConfig.cfg", "r") or die("Unable to open file!");
    $jsonobj= fread($myfile,filesize("../Webconfig/WebConfig.cfg"));
    fclose($myfile);
    $obj = json_decode($jsonobj);
    $Sms='{"MqttCommand":1}';
    $Publish="NWL_VMS/".$Publish;
	$MqttServerIp = $obj->MqttServerIp;
    $MqttServerPort = $obj->MqttServerPort;
    $MqttUsereName =  $obj->MqttUsereName;
    $MqttPassword = $obj->MqttPassword;
    $MqttPublisher = $obj->MqttPublisher;  
	$mqtt = new Bluerhinos\phpMQTT($MqttServerIp, $MqttServerPort, $ClientId);
	if ($mqtt->connect(true, NULL, $MqttUsereName, $MqttPassword)) {
		$mqtt->publish($Publish, $Sms , 0, false);
		$mqtt->close();
		$ret="Success";
	}else{
        $ret="Fail";
	}
	return $ret;
}
function MqttPublish($ClientId,$Publish){
	$myfile = fopen("../Webconfig/WebConfig.cfg", "r") or die("Unable to open file!");
    $jsonobj= fread($myfile,filesize("../Webconfig/WebConfig.cfg"));
    fclose($myfile);
    $obj = json_decode($jsonobj);
    $Sms='{"MqttCommand":1}';
    $Publish="NWL_VMS/".$Publish;
	$MqttServerIp = $obj->MqttServerIp;
    $MqttServerPort = $obj->MqttServerPort;
    $MqttUsereName =  $obj->MqttUsereName;
    $MqttPassword = $obj->MqttPassword;
    $MqttPublisher = $obj->MqttPublisher;  
	$mqtt = new Bluerhinos\phpMQTT($MqttServerIp, $MqttServerPort, $ClientId);
	if ($mqtt->connect(true, NULL, $MqttUsereName, $MqttPassword)) {
		$mqtt->publish($Publish, $Sms , 0, false);
		$mqtt->close();
		$ret="Success";
	}else{
        $ret="Fail";
	}
	return $ret;
}
?>