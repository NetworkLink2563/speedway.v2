<?php
session_start();
include "../Database/DBConnect.php";
include "Model.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if( isset($_POST["ShowData"]) ){     
        $Date=$_POST["Date"];
        $starttime=strtotime($_REQUEST["starttime"]);
        $endtime=strtotime($_REQUEST["endtime"]);
        $io=$_POST["io"];
        echo ShowData($io,$starttime,$endtime);
    }
}
?>