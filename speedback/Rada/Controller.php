<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $RadaCode=$_POST["RadaCode"];
        $RadaName=$_POST["RadaName"];
        $RadaSN=$_POST["RadaSN"];
        $RadaIp=$_POST["RadaIp"];
        $RadaPort=$_POST["RadaPort"];
        $RadaIsActive=$_POST["RadaIsActive"];
        $SupCode=$_POST["SupCode"];
        $RadaName=str_replace("'","''",$RadaName);
        $RadaSN=str_replace("'","''",$RadaSN);
        $Ip=str_replace("'","''",$Ip);
        if ($Mode==0){
            echo InsertRada($RadaCode, $RadaName, $RadaSN, $RadaIp, $RadaPort, $RadaIsActive, $SupCode);
        }else if($Mode==1){
            echo UpdateRada($RadaCode, $RadaName, $RadaSN, $RadaIp, $RadaPort, $RadaIsActive, $SupCode);
        }
     }
     if(isset($_POST["Edit"])){
         $CamCode=$_POST["CamCode"];
         echo SearchCamera($CamCode);
     }  
     if(isset($_POST["SearchCamera"]))
     {
         $PrjCode=$_POST["PrjCode"];
        
         echo ShowBodyTable($PrjCode);
     } 
     if(isset($_POST["Delete"]))
     {
        $RadaCode=$_POST["RadaCode"];
        DeleteRada($RadaCode);
     }
     if(isset($_POST["SetPoint"]))
     {  $PrjCode=$_POST["PrjCode"];
        $SupCode=$_POST["SupCode"];
        echo  InPutSelect_SetupPoint($SupCode,$PrjCode);
     }
     if(isset($_POST["ShowBodyTable"]))
    {   $PrjCode=$_POST["PrjCode"];
        echo ShowBodyTable($PrjCode); 
    }
}
?>