<?php
session_start();
include '../lib/DatabaseManage.php';
//include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["Mode"])){
        $Mode=$_POST["Mode"];
        $Name=$_POST["Name"];
      
        $EmaEmail=$_POST["EmaEmail"];
        $PasPwd=$_POST["PasPwd"];
        $Status=$_POST["Status"];
        $CstCode=$_POST["CstCode"];
       
        if ($Mode==0){
            RegisterAccount($CstCode,$EmaEmail, $PasPwd, $Name,  $Status);
        }else if($Mode==1){
            EditAccount($CstCode,$EmaEmail,$Status);
        }
    } 
    if(isset($_POST["Permission"]))
    {
        $s1=$_POST["s1"];
        $s2=$_POST["s2"];
        $s3=$_POST["s3"];
        $UsrCode=$_POST["UsrCode"];
        echo Permissions($UsrCode,$s1,$s2,$s3);
    } 
    if(isset($_POST["PermisPrj"]))
    {
        $s1=$_POST["s1"];
        $UsrCode=$_POST["UsrCode"];
        PermisPrj($UsrCode,$s1);
    }
    if(isset($_POST["UsrPrj"]))
    {
        $UsrCode=$_POST["UsrCode"];
        echo  UsrPrj($UsrCode);
    }
    if(isset($_POST["Delete"]))
    {
       
        $UsrCode=$_POST["UsrCode"];
        DeleteAccount($UsrCode);
        
    }
    if(isset($_POST["Search"]))
    { 
        $CustCode=$_POST["CustCode"];
        echo ShowBodyTable($CustCode); 
    }

   
}
?>