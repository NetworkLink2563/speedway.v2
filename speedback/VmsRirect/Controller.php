<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $VmsCode=$_POST["VmsCode"];
        $VmsName=$_POST["VmsName"];
        $VmsSN=$_POST["VmsSN"];
        $VmsURL=$_POST["VmsURL"];
        $VmsIsActive=$_POST["VmsIsActive"];
        $VmsPixelWidth=$_POST["VmsPixelWidth"];
        $VmsPixelHeight=$_POST["VmsPixelHeight"];
        $VmsSizeWidth=$_POST["VmsSizeWidth"];
        $VmsSizeHeight=$_POST["VmsSizeHeight"];
        $VmsSize=$_POST["VmsSize"];
        $SupCode=$_POST["SupCode"];
        $IsActiveGoogleMap=$_POST["IsActiveGoogleMap"];
        $IsActiveWeatherSensor=$_POST["IsActiveWeatherSensor"];
        $VmsType=$_POST["VmsType"];
        $VmsName=str_replace("'","''",$VmsName);
        $VmsSN=str_replace("'","''",$VmsSN);
        $VmsURL=str_replace("'","''",$VmsURL);
        $VmsSize=str_replace("'","''",$VmsSize);
        if ($Mode==0){
            echo InsertVms($VmsType,$VmsCode, $VmsName, $VmsSN, $VmsURL, $VmsIsActive, $VmsPixelWidth, $VmsPixelHeight, $VmsSizeWidth, $VmsSizeHeight, $VmsSize, $SupCode, $IsActiveGoogleMap, $IsActiveWeatherSensor);
        }else if($Mode==1){
            echo UpdateVms($VmsType,$VmsCode, $VmsName, $VmsSN, $VmsURL, $VmsIsActive, $VmsPixelWidth, $VmsPixelHeight, $VmsSizeWidth, $VmsSizeHeight, $VmsSize, $SupCode, $IsActiveGoogleMap, $IsActiveWeatherSensor);
        }
    }
    if(isset($_POST["Edit"])){
        $VmsCode=$_POST["VmsCode"];
         echo SearchVms($VmsCode);
     }  
     if(isset($_POST["SearchVms"]))
     {
         $PrjCode=$_POST["PrjCode"];
         echo ShowBodyTable($PrjCode);
     } 
     if(isset($_POST["Delete"]))
     {
        $VmsCode=$_POST["VmsCode"];
        DeleteVms($VmsCode);
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