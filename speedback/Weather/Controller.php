<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $WssCode=$_POST["WssCode"];
        $WssName=$_POST["WssName"];
        $SN=$_POST["SN"];
        $IsActive=$_POST["IsActive"];
        $SupCode=$_POST["SupCode"];
        $VmsCode=$_POST["VmsCode"];
        $WssName=str_replace("'","''",$WssName);
        $SN=str_replace("'","''", $SN);
        if ($Mode==0){
            echo InsertWeatherSensor($WssCode, $WssName, $SN, $IsActive, $SupCode, $VmsCode);
        }else if($Mode==1){
            echo UpdateWeatherSensor($WssCode, $WssName, $SN, $IsActive, $SupCode, $VmsCode);
        }
    }
    if(isset($_POST["Edit"])){
         $WssCode=$_POST["WssCode"];
         echo SearchWeatherSensor($WssCode);
    }  
    if(isset($_POST["SearchWss"]))
    {
        $PrjCode=$_POST["PrjCode"];
        echo ShowBodyTable($PrjCode);
    } 
    if(isset($_POST["Delete"]))
    {
       $WssCode=$_POST["WssCode"];
       DeleteWeatherSensor($WssCode);
    }
    if(isset($_POST["ShowBodyTable"]))
    {  $PrjCode=$_POST["PrjCode"];
        echo ShowBodyTable($PrjCode); 
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