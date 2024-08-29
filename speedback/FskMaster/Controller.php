<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $FskCode=$_POST["FskCode"];
        $FskName=$_POST["FskName"];
        $FskSN=$_POST["FskSN"];
        $FskIsActive=$_POST["FskIsActive"];
        $SupCode=$_POST["SupCode"];
        if ($Mode==0){
            echo InsertFsk($FskCode, $FskName, $FskSN, $FskIsActive, $SupCode);
        }else if($Mode==1){
            echo UpdateFsk($FskCode, $FskName, $FskSN, $FskIsActive, $SupCode);
        }
    }
    if(isset($_POST["Edit"])){
         $FskCode=$_POST["FskCode"];
         echo SearchFsk($FskCode);
     }  
     if(isset($_POST["Search"]))
     {  
         $PrjCode=$_POST["PrjCode"];
        
         echo ShowBodyTable($PrjCode);
     } 
     if(isset($_POST["Delete"]))
     {
        $FskCode=$_POST["FskCode"];
        DeleteFsk($FskCode);
     }
     if(isset($_POST["SetPoint"]))
     {  $PrjCode=$_POST["PrjCode"];
        $SupCode=$_POST["SupCode"];
        echo  InPutSelect_SetupPoint($SupCode,$PrjCode);
     }
}
?>