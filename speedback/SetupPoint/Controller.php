<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $SupCode=$_POST["SupCode"];
        $PrjCode=$_POST["PrjCode"];
        $SupName=$_POST["SupName"];
        $SupSetupPoint=$_POST["SupSetupPoint"];
        $SupKmPoint=$_POST["SupKmPoint"];
        $SupLatitude=$_POST["SupLatitude"];
        $SupLongitude=$_POST["SupLongitude"];
        $SupName=str_replace("'","''",$SupName);
        $SupSetupPoint=str_replace("'","''",$SupSetupPoint);
        if ($Mode==0){
            echo InsertSetupPoint($SupCode, $PrjCode, $SupName, $SupSetupPoint, $SupKmPoint, $SupLatitude, $SupLongitude);
        }else if($Mode==1){
            echo UpdateSetupPoint($SupCode, $PrjCode, $SupName, $SupSetupPoint, $SupKmPoint, $SupLatitude, $SupLongitude);
        }
    }
    if(isset($_POST["Edit"])){
         $SupCode=$_POST["SupCode"];
         echo SearchSetupPoint($SupCode);
     }  
     if(isset($_POST["SearchSetpoint"]))
     {
         $PrjCode=$_POST["PrjCode"];
         echo ShowBodyTable($PrjCode);
     } 
     if(isset($_POST["Delete"]))
     {
         $SupCode=$_POST["SupCode"];
         DeleteSetupPoint($SupCode);
     }
     if(isset($_POST["ShowBodyTable"]))
     {   $PrjCode=$_POST["PrjCode"];
         echo ShowBodyTable($PrjCode); 
     }
}
?>