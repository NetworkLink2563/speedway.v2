<?php
require('phpMQTT.php');
function mqttsend($topic,$data){
  
  
    $ret="";
     //  $server = '10.12.12.205';   
       $server = '10.140.12.11:1883';   

       $port = 1883;                     
       $username = 'user';                  
       $password = '!NWLmqttuser';                  
       $client_id = 'phpMQTT-publisher'; 
       $mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);
       
       if ($mqtt->connect(true, NULL, $username, $password)) {
           
           $mqtt->publish($topic , $data , 0, false);
           $mqtt->close();
           $ret='{"Return":"Success"}';
       }else{
           $ret='{"Return":"Fail"}';
       }
      
       return $ret; 
}
?>