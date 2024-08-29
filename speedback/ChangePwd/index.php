<?php
     session_start();
    if(isset($_SESSION["CstCode"])){
        if($_SESSION["CstCode"]!="CUS22-00001"){
            if($_SESSION["R"][15]==0){
                session_destroy();
                header( "location: ../Login" );
                exit(0);
            }   
        }
    }else{
        header( "location: ../Login" );
        exit(0);
    }
    include "../HtmlHeaderFooter/HtmlHeader.php";
    include "../Function/Function.php";
  
    include "view.php";
    include "../HtmlHeaderFooter/HtmlFooter.php";
?>                                 