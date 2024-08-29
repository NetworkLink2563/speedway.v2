
<?php
session_start();
/*
if(!isset($_SESSION["XIM12"]) || $_SESSION["XIM12"]!=1){
    header( "location: ../SignIn" );
    exit(0);
}
*/
//include "../Header/CheckHead.php";
//CheckMenu($_SESSION["XVUsrCode"],'MNU22-00002');
include "../Html/htmlhead.php";
include "View.php";
include "../Html/htmlfoot.php";

?>