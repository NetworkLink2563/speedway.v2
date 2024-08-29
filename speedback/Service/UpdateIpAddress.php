<?php
include '../lib/DatabaseManage.php';
function UpdateIP($VmsCode){
    $dbm=new DatabaseManage();   
    $IP=$_SERVER['REMOTE_ADDR'];
    
    $sql="Update TMstMIP set 
                    [XVIP]='$IP' 
                    ,[XTLastUpdate]=GETDATE()
            WHERE XVVmsCode='$VmsCode'";
        
    $result=$dbm->QueryDB($sql);
    $ret='{"Status":"CanotUpdate"}';
    if($result){
        $ret='{"Status":"Sucess"}';
    }
    return $ret;
 }
 if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
    if(isset($_POST["VmsCode"])){ 
        $VmsCode=$_POST["VmsCode"];
        
        echo UpdateIP($VmsCode);
     }
 }
?>