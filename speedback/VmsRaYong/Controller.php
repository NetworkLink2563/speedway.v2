<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    if(isset($_POST["GETIP"])){
           $VmsCode=$_POST["VmsCode"];
           
            echo GetIP($VmsCode);
        
    }             
}
?>