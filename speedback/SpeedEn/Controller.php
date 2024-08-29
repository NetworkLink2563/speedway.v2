<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   
    if(isset($_POST["InsertUpdate"])){
        $Mode=$_POST["Mode"];
        $SpeCode=$_POST["SpeCode"];
        $SpeName=$_POST["SpeName"];
        $SpeSN=$_POST["SpeSN"];
        $SpeURL=$_POST["SpeURL"];
        $SpeIsActive=$_POST["SpeIsActive"];
        $SupCode=$_POST["SupCode"];
        $SpeName=str_replace("'","''",$SpeName);
        $SpeSN=str_replace("'","''",$SpeSN);
        $SpeURL=str_replace("'","''",$SpeURL);
        if ($Mode==0){
            echo InsertSpeedEnforce($SpeCode, $SpeName, $SpeSN, $SpeURL, $SpeIsActive, $SupCode);
        }else if($Mode==1){
            echo UpdateSpeedEnforce($SpeCode, $SpeName, $SpeSN, $SpeURL, $SpeIsActive, $SupCode);
        }
    }
    if(isset($_POST["Edit"])){
        $SpeCode=$_POST["SpeCode"];
        echo SearchSpeedEnforce($SpeCode);
    }  
    if(isset($_POST["SearchSpeedEn"]))
    {
        $PrjCode=$_POST["PrjCode"];

        echo ShowBodyTable($PrjCode);
    } 
    if(isset($_POST["Delete"]))
    {
       $SpeCode=$_POST["SpeCode"];
       DeleteSpeedEnforce($SpeCode);
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