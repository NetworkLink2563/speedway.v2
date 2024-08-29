<?php
include '../lib/DatabaseManage.php';
function UpdateIP($Code,$Password,$IP){
    $dbm=new DatabaseManage();   

    $sql="SELECT [XVPassword] FROM [NWL_VMSControl].[dbo].[TMstMIP] WHERE XVPassword='$Password' ";
    $result2=$dbm->QueryDB($sql);
    $JsonObj2 = json_decode($result2);
    $CountRec=count($JsonObj2);
    if($CountRec>0){
        $sql="Update TMstMIP set 
                    [XVIP]='$IP' 
                    ,[XTLastUpdate]=GETDATE()
            WHERE XVPrjCode='$Code'";
        
        $result=$dbm->QueryDB($sql);
        $ret='{"Status":"CanotUpdate"}';
        if($result){
            $ret='{"Status":"Sucess"}';
        }
    }else{
        $ret='{"Status":"BadUpdate"}';
    }
    return $ret;
 }
 if(strtoupper($_SERVER['REQUEST_METHOD']) === 'POST') { 
    if(isset($_POST["UpdateIp"])){ 
        $Code=$_POST["Code"];
        $Password=$_POST["Password"];
        $IP=$_POST["IP"];
        echo UpdateIP($Code,$Password,$IP);
     }
 }
?>