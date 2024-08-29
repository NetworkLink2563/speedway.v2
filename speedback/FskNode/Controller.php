<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $FskNodeCode=$_POST["FskNodeCode"];
        $FskNodeName=$_POST["FskNodeName"];
        $FskNodeSN=$_POST["FskNodeSN"];
        $FskNodeIsActive=$_POST["FskNodeIsActive"];
        $SupCode=$_POST["SupCode"];
        $FskCode=$_POST["FskCode"];
        if ($Mode==0){
            
            echo InsertFsk($FskCode,$FskNodeCode, $FskNodeName, $FskNodeSN, $FskNodeIsActive, $SupCode);
        }else if($Mode==1){
            echo UpdateFsk($FskCode,$FskNodeCode, $FskNodeName, $FskNodeSN, $FskNodeIsActive, $SupCode);
        }
    }
    if(isset($_POST["Edit"])){
         $FskNodeCode=$_POST["FskNodeCode"];
         echo SearchNodeFsk($FskNodeCode);
       
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
     if(isset($_POST["FskMaster"])){
        $PrjCode=$_POST["PrjCode"];
        $FskCode=$_POST["FskCode"];
        echo InPutSelect_Fsk($FskCode,$PrjCode);
     }

}
?>