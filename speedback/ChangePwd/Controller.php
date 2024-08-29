<?php
session_start();
include '../lib/DatabaseManage.php';
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
   if(isset($_POST["ChamgePwd"]))
   {
       $UsrPwd=$_POST["UsrPwd"];
       echo ShangePwd($UsrPwd);
   } 
}
?>