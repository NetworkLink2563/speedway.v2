<?php

function RunNumberVmsCode(){
    $dbm=new DatabaseManage();
    $sql="select  max(XVVmsCode) as XVVmsCode from TMstMVmsDirect";
    $result=$dbm->QueryDB($sql);  
    $JsonObj = json_decode($result);
    $XVVmsCode='';
    foreach ($JsonObj as $result){
        $XVVmsCode =$result->XVVmsCode;               
    }
    if($XVVmsCode==''){
        return 'VMS'.date("y")."-00001";
    }else{
        $DocNo=explode("-",$XVVmsCode);
        $RunDocNum=intval($DocNo[1])+1;
        $XVVmsCode=sprintf("%05d", $RunDocNum);
        return 'VMS'.date("y")."-".$XVVmsCode; 
    }   
}


function SearchVms($VmsCode)
{  
    $dbm=new DatabaseManage();
    $sql="SELECT [XVVmsCode]
        ,[XVVmsName]
        ,[XVVmsSN]
        ,[XVVmsURL]
        ,[XBVmsIsActive]
        ,[XIVmsPixelWidth]
        ,[XIVmsPixelHeight]
        ,[XIVmsSizeWidth]
        ,[XIVmsSizeHeight]
        ,[XVVmsSize]
        ,[XVSupCode]
        ,[XBGoogleMap]
        ,[XBWeatherSensor]
        ,[XVTYPE]
    FROM [NWL_VMSControl].[dbo].[TMstMVmsDirect] WHERE XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    return $result;
} 
function ShowBodyTable($PrjCode){
    $Permis=Permission('MNU22-00009');
    $CstCode=$_SESSION["CstCode"];
    $UsrCode=$_SESSION["UsrCode"];
    $dbm=new DatabaseManage();
    
       
            $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMVmsDirect.XVVmsSN, dbo.TMstMVmsDirect.XVVmsURL, dbo.TMstMVmsDirect.XBVmsIsActive, dbo.TMstMVmsDirect.XIVmsPixelWidth, dbo.TMstMVmsDirect.XIVmsPixelHeight, 
                    dbo.TMstMVmsDirect.XIVmsSizeWidth, dbo.TMstMVmsDirect.XVVmsSize, dbo.TMstMVmsDirect.XVSupCode, dbo.TMstMSetupPoint.XVSupName, dbo.TMstMProject.XVCstCode, dbo.TMstMProject.XVPrjCode
            FROM     dbo.TMstMSetupPoint INNER JOIN
                    dbo.TMstMProject ON dbo.TMstMSetupPoint.XVPrjCode = dbo.TMstMProject.XVPrjCode INNER JOIN
                    dbo.TMstMVmsDirect ON dbo.TMstMSetupPoint.XVSupCode = dbo.TMstMVmsDirect.XVSupCode
            WHERE  (dbo.TMstMProject.XVPrjCode = '$PrjCode') 
            ORDER BY dbo.TMstMVmsDirect.XVSupCode, dbo.TMstMVmsDirect.XVVmsCode" ;
       
    
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVVmsCode."'";
        $VmsIsActive='ยกเลิก';
        if($result->XBVmsIsActive==1){
            $VmsIsActive='ใช้งาน';
        }
        $E='<i '.$Permis[2].' style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $F='<i style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        if($_SESSION["CstCode"]!="CUS22-00001"){
            $E="";
        } 
        
            $data.='
            {
                "A":"'.$result->XVVmsCode.'",
                "B":"'.$result->XVVmsName.'",
                "C":"'.$result->XVSupName.'",
                "D":"'.$VmsIsActive.'",
                "E":"'. $E.'",
                "F":"'. $F.'"
            },';
            
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;
}

function InsertVms($VmsType,$VmsCode, $VmsName, $VmsSN, $VmsURL, $VmsIsActive, $VmsPixelWidth, $VmsPixelHeight, $VmsSizeWidth, $VmsSizeHeight, $VmsSize, $SupCode, $IsActiveGoogleMap, $IsActiveWeatherSensor){
    $UsrCode=$_SESSION["UsrCode"];  
    $VmsCode=RunNumberVmsCode();
    $dbm=new DatabaseManage();
    $sql="INSERT INTO TMstMVmsDirect (XVTYPE,XVVmsCode, XVVmsName, XVVmsSN, XVVmsURL, XBVmsIsActive, XIVmsPixelWidth, XIVmsPixelHeight, XIVmsSizeWidth, XIVmsSizeHeight, XVSupCode, XVVmsSize, XBGoogleMap, XBWeatherSensor, XVWhoCreate, XTWhenCreate) 
                         VALUES('$VmsType','$VmsCode', '$VmsName', '$VmsSN', '$VmsURL', '$VmsIsActive', '$VmsPixelWidth', '$VmsPixelHeight', '$VmsSizeWidth', '$VmsSizeWidth', '$SupCode', '$VmsSize', $IsActiveGoogleMap, $IsActiveWeatherSensor, '$UsrCode',GETDATE())";
    
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}

function UpdateVms($VmsType,$VmsCode, $VmsName, $VmsSN, $VmsURL, $VmsIsActive, $VmsPixelWidth, $VmsPixelHeight, $VmsSizeWidth, $VmsSizeHeight, $VmsSize, $SupCode, $IsActiveGoogleMap, $IsActiveWeatherSensor){
    $UsrCode=$_SESSION["UsrCode"];  
    $dbm=new DatabaseManage();
    $sql="UPDATE TMstMVmsDirect set   
                 XVVmsName='$VmsName'
                ,XVVmsSN='$VmsSN'
                ,XVVmsURL='$VmsURL'
                ,XBVmsIsActive='$VmsIsActive'
                ,XIVmsPixelWidth='$VmsPixelWidth'
                ,XIVmsPixelHeight='$VmsPixelHeight'
                ,XIVmsSizeWidth='$VmsSizeWidth'
                ,XIVmsSizeHeight='$VmsSizeHeight'
                ,XVVmsSize='$VmsSize'
                ,XVTYPE='$VmsType'
                ,XVSupCode='$SupCode'
                ,XBGoogleMap=$IsActiveGoogleMap
                ,XBWeatherSensor=$IsActiveWeatherSensor
                ,XVWhoEdit='$UsrCode'
                ,XTWhenEdit=GETDATE()
            WHERE XVVmsCode='$VmsCode'";
      
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
function  DeleteVms($VmsCode){
    $dbm=new DatabaseManage();
    $sql="DELETE TMstMVmsDirect WHERE XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    if($result){
        echo ShowBodyTable("");
    }else{
        echo "Err1";
    } 
}
?>