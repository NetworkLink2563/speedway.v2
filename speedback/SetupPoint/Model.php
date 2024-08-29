<?php

function RunNumberSupCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVSupCode) as XVSupCode   from TMstMSetupPoint";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVSupCode='';
    foreach ($JsonObj as $result){
        $XVSupCode =$result->XVSupCode;               
    }
    if($XVSupCode==''){
        return 'SUP'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVSupCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVSupCode=sprintf("%05d", $RunDocNum);
        return 'SUP'.date("y")."-".$XVSupCode; 
    }   
}


function SearchSetupPoint($SupCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT  [XVSupCode]
    ,[XVSupName]
    ,[XVSupSetupPoint]
    ,[XFSupKmPoint]
    ,[XFSupLatitude]
    ,[XFSupLongitude]
    ,[XVPrjCode]
    ,[XVWhoCreate]
    ,[XVWhoEdit]
    ,[XTWhenCreate]
    ,[XTWhenEdit]
    FROM [TMstMSetupPoint]";
    $result=$dbm->QueryDB($sql);
    return $result;
} 

function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00005');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
      
            $sql="SELECT  dbo.TMstMSetupPoint.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMSetupPoint.XVSupSetupPoint, dbo.TMstMSetupPoint.XFSupKmPoint, dbo.TMstMSetupPoint.XFSupLatitude, 
            dbo.TMstMSetupPoint.XFSupLongitude, dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMProject.XVPrjName, dbo.TMstMProject.XVCstCode
            FROM     dbo.TMstMSetupPoint INNER JOIN
                        dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode
         
            ORDER BY dbo.TMstMSetupPoint.XVSupCode";
      
    
     
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVSupCode."'";
     
        $D='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $E='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $D="";
        }
            $data.='
            {
                "A":"'.$result->XVSupCode.'",
                "B":"'.$result->XVSupName.'",
                "C":"'.$result->XFSupLatitude.'",
                "D":"'.$result->XFSupLongitude.'",
                "E":"'.$result->XVPrjName.'",
                "F":"'.$D.'",
                "G":"'.$E.'"
            },';
        
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

      

function InsertSetupPoint($SupCode, $PrjCode, $SupName, $SupSetupPoint, $SupKmPoint, $SupLatitude, $SupLongitude){
    $UsrCode=$_SESSION["UsrCode"];  
    $SupCode=RunNumberSupCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMSetupPoint (XVSupCode, XVPrjCode, XVSupName, XVSupSetupPoint, XFSupKmPoint, XFSupLatitude, XFSupLongitude, XVWhoCreate, XTWhenCreate) 
                         VALUES('$SupCode', '$PrjCode', '$SupName', '$SupSetupPoint', '$SupKmPoint', '$SupLatitude', '$SupLongitude', '$UsrCode', GETDATE())";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
    
}
function UpdateSetupPoint($SupCode, $PrjCode, $SupName, $SupSetupPoint, $SupKmPoint, $SupLatitude, $SupLongitude){
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    $UsrCode=$_SESSION["UsrCode"];  
    
    $dbm=new DatabaseManage();
    
    $sql="UPDATE TMstMSetupPoint set  
                    XVPrjCode='$PrjCode', 
                    XVSupName='$SupName', 
                    XVSupSetupPoint='$SupSetupPoint', 
                    XFSupKmPoint='$SupKmPoint', 
                    XFSupLatitude='$SupLatitude', 
                    XFSupLongitude='$SupLongitude', 
                    XVWhoEdit='$UsrCode', 
                    XTWhenEdit=GETDATE() 
                    WHERE XVSupCode='$SupCode'";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
    
}
function DeleteSetupPoint($SupCode){
    $dbm=new DatabaseManage();
    $countCam=0;
    $sql="SELECT [XVCamCode] FROM [NWL_VMSControl].[dbo].[TMstMCamera] WHERE XVSupCode='$SupCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        $JsonObj = json_decode($result);
        $countCam=count($JsonObj);
    }else{
        echo "Err1";
        exit();
    }
    $countWss=0;
    $sql="SELECT  [XVWssCode] FROM [NWL_VMSControl].[dbo].[TMstMWeatherSensor] WHERE XVSupCode='$SupCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        $JsonObj = json_decode($result);
        $countWss=count($JsonObj);
    }else{
        echo "Err1";
        exit();
    }
    $countSpe=0;
    $sql="SELECT  [XVSpeCode] FROM [NWL_VMSControl].[dbo].[TMstMSpeedEnforce] WHERE XVSupCode='$SupCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        $JsonObj = json_decode($result);
        $countSpe=count($JsonObj);
    }else{
        echo "Err1";
        exit();
    }
    $countVms=0;
    $sql="SELECT [XVVmsCode] FROM [NWL_VMSControl].[dbo].[TMstMVms] WHERE XVSupCode='$SupCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        $JsonObj = json_decode($result);
        $countVms=count($JsonObj);
    }else{
        echo "Err1";
        exit();
    }

    if($countCam>0){
        echo "Err0_1";
        exit();
    }
    if($countWss>0){
        echo "Err0_2";
        exit();
    }
    if($countSpe>0){
        echo "Err0_3";
        exit();
    }
    if($countVms>0){
        echo "Err0_4";
        exit();
    }
    $sql="DELETE FROM TMstMSetupPoint WHERE XVSupCode='$SupCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    }    
}
?>