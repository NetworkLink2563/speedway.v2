<?php
session_start();
include '../lib/DatabaseManage.php';
include "../Function/Function.php";
include "Model.php";
if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') {  
    
    if(isset($_POST["InsertUpdate"]))
    {
        $Mode=$_POST["Mode"];
        $CstCode=$_POST["CstCode"];
        $CstName=$_POST["CstName"];
        $CstEmail=$_POST["CstEmail"];
        $CstPhone=$_POST["CstPhone"];
        $CstIsActive=$_POST["CstIsActive"];
        InsertUpdate($Mode,$CstCode,$CstName,$CstEmail,$CstPhone,$CstIsActive);    
    }
    if(isset($_POST["Edit"]))
    {
       $CstCode=$_POST["CstCode"];
       echo SearchCustomer($CstCode);
    }   
    if(isset($_POST["Delete"]))
    {
       $CstCode=$_POST["CstCode"];
       echo DeleteCustomer($CstCode);
    }  
    if(isset($_POST["ShowBodyTable"]))
    { 
        echo ShowBodyTable(""); 
    }
       
}
?>