<?php
session_start();

include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
   
   
     if(isset($_POST["ShowCamera"]))
      { 
         $VmsCode=$_POST['VmsCode'];
      
         echo ShowCamera($VmsCode);
      }

    if(isset($_POST['VmsMenu'])){
      $PrjCode=$_POST['PrjCode'];
      echo Menu_Vms($PrjCode);
    }

   
    if(isset($_POST['MediaProject'])){
      
       $PrjCode=$_POST['PrjCode'];
       echo MediaProject($PrjCode);  
    }

   if(isset($_POST['MediaSetTable'])){
      
      $VmsCode=$_POST['VmsCode'];
    
      echo  MediaSetTable($VmsCode); 
   }
   
   if(isset($_POST['SetMediaDelay'])){
      $ID=$_POST['ID'];
      $Delay=$_POST['Delay'];
     
      echo SetMediaDelay($ID,$Delay);
   }
   
   if(isset($_POST['InsertMediaSet'])){
       $MediaVmsCode=$_POST['MediaVmsCode'];
       $VmsCode=$_POST['VmsCode'];
       $Delay=$_POST['Delay'];
       InsertMediaSet($MediaVmsCode,$VmsCode,$Delay);
   }
   
   if(isset($_POST['DeleteMediaSet'])){
      $ID=$_POST['ID'];
      echo DeleteMediaSet($ID);
   }
   if(isset($_POST['SampleMediaSetTable'])){
     
      $VmsCode=$_POST['VmsCode'];
      echo SampleMediaSetTable($VmsCode);
   }
   if(isset($_POST["MqttPublish"])){
       $VmsCode=$_POST["VmsCode"];
       MqttPublish($VmsCode,$VmsCode);
   }
}
?>