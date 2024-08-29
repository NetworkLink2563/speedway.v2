<?php
    function SampleMediaSetTable($VmsCode){
        $dbm=new DatabaseManage();  
        $sql="SELECT dbo.TMstMMediaVms.XVMediaVmsCode, dbo.TMstMMediaVms.XVMediaName, dbo.TMstMMediaVms.XVMediaType, dbo.TMstMMediaSetVms.XVVmsCode, dbo.TMstMMediaSetVms.XIDelay, 
                dbo.TMstMMediaSetVms.XIID, dbo.TMstMMediaVms.XVPrjCode, dbo.TMstMMediaVms.XVFileName,dbo.TMstMMediaVms.XVSms
            FROM            dbo.TMstMMediaVms INNER JOIN
                dbo.TMstMMediaSetVms ON dbo.TMstMMediaVms.XVMediaVmsCode = dbo.TMstMMediaSetVms.XVMediaVmsCode
            WHERE        (dbo.TMstMMediaSetVms.XVVmsCode = '$VmsCode')
            ORDER BY dbo.TMstMMediaSetVms.XIID";
        
            $result=$dbm->QueryDB($sql);
            return $result;
    }
    function ReadVmsJson(){
        $data="";
        $myfile = fopen("Media.json", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $data.=fgets($myfile);
        }
        fclose($myfile);
        return $data;
     } 
     function ReadLabel(){
        $data="";
        $myfile = fopen("Label.json", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $data.=fgets($myfile);
        }
        fclose($myfile);
        return $data;
     }
     function ReadRouteXY(){
        $data="";
        $myfile = fopen("RouteXY.json", "r") or die("Unable to open file!");
        while(!feof($myfile)) {
            $data.=fgets($myfile);
        }
        fclose($myfile);
        return $data;
     }
     function  Readload(){
        $ret='{"Status":0}';
        if(file_exists("Relaod.cmd")){
            unlink("Relaod.cmd");
            $ret='{"Status":1}';
        }
        return $ret;
     }  
       
?>