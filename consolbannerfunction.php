<?php
include "lib/DatabaseManage.php";
include "lib/MqttSend.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
       if(isset($_POST["settimepc"])){
              $vmscode=$_POST["vmscode"];
              echo settimepc($vmscode);
       }
}
sqlsrv_close( $conn );

function settimepc($vmscode){
       $topic=$vmscode.'_Display';
       $datetime=date("Y-m-d H:i:s");
       $data='{"cmd":"02","DateTime":"'.$datetime.'"}';
      
       return mqttsend($topic,$data);
     
}
     
?>

