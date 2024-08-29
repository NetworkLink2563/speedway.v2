<?php
    include "Model.php";
    if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
        if(isset($_POST["GetMediaSetTable"])){
            echo ReadVmsJson();
        }
        if(isset($_POST["GetLabel"])){
            echo ReadLabel();
        }
        if(isset($_POST["GetRouteXY"])){
            echo  ReadRouteXY();
        }
       
        if(isset($_POST["Reload"])){
            echo Readload();  
        }
      
    }
?>