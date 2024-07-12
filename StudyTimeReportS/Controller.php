<?php
session_start();
include "Model.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["ShowData"])){
        $XITermID=$_POST["XITermID"];
        $XISubjectID=$_POST["XISubjectID"];
        echo ShowData($XISubjectID,$XITermID);
    }
    if(isset($_POST["ShowSubject"])){
        $XITermID=$_POST["XITermID"];

        echo ShowSubject($XITermID);
    }
   
}
?>