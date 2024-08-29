<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    
    
     if(isset($_POST["ShowTable"]))
     {
         $PrjCode=$_POST["PrjCode"];
         $XVFskCode=$_POST["XVFskCode"];
         echo ShowBodyTable($PrjCode, $XVFskCode);
     } 
   
    
  
     if(isset($_POST["SelGate"])){
        $PrjCode=$_POST["PrjCode"]; 
     
        echo SelGate($PrjCode);
     }

}
?>