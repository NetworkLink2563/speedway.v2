<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $CamCode=$_POST["CamCode"];
        $CamName=$_POST["CamName"];
        $CamSN=$_POST["CamSN"];
        $CamURL=$_POST["CamURL"];
        $CamIsActive=$_POST["CamIsActive"];
        $SupCode=$_POST["SupCode"];
      
        $VmsDirectCode=$_POST["VmsDirectCode"];
        $CamName=str_replace("'","''",$CamName);
        $CamSN=str_replace("'","''",$CamSN);
        $CamURL=str_replace("'","''",$CamURL);
        if ($Mode==0){
            echo InsertCamera($CamCode, $CamName, $CamSN, $CamURL, $CamIsActive, $SupCode, $VmsDirectCode);
        }else if($Mode==1){
            echo UpdateCamera($CamCode, $CamName, $CamSN, $CamURL, $CamIsActive, $SupCode, $VmsDirectCode);
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
        $CamCode=$_POST["CamCode"];
        DeleteCamera($CamCode);
     }
     if(isset($_POST["ShowBodyTable"]))
     { 
         echo ShowBodyTable(""); 
     }
     if(isset($_POST["SetPoint"]))
     {  $PrjCode=$_POST["PrjCode"];
        $SupCode=$_POST["SupCode"];
        echo  InPutSelect_SetupPoint($SupCode,$PrjCode);
     }
     if(isset($_POST["VmsDirect"]))
     {  $PrjCode=$_POST["PrjCode"];
        $VmsCode=$_POST["VmsCode"];
        echo  InPutSelect_VmsDirect($VmsCode,$PrjCode);
     }

    
}
?>