<?php

function Menu_Vms($PrjCode){
    $dbm=new DatabaseManage();
        $sql="SELECT  dbo.TMstMVmsDirect.XVVmsCode, dbo.TMstMVmsDirect.XVVmsName, dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMVmsDirect.XBVmsIsActive
        FROM     dbo.TMstMVmsDirect INNER JOIN
                          dbo.TMstMSetupPoint ON dbo.TMstMVmsDirect.XVSupCode = dbo.TMstMSetupPoint.XVSupCode
        WHERE  (dbo.TMstMVmsDirect.XBVmsIsActive = 1) AND (dbo.TMstMSetupPoint.XVPrjCode = '$PrjCode')
        ORDER BY dbo.TMstMVmsDirect.XVVmsCode";    
      $result=$dbm->QueryDB($sql);
      return $result;
}
      
function SearchVms($VmsCode){
 $dbm=new DatabaseManage();
  $sql="SELECT * From TMstMVmsDirect Where XVVmsCode='$VmsCode'";
  
  $result=$dbm->QueryDB($sql);
  return $result;
  
}


function UpdateSms1($VmsCode,$TxtSms1){
    $dbm=new DatabaseManage();
    $sql="Update TMstMVmsDirect set XVSms1='$TxtSms1' where XVVmsCode='$VmsCode'";    
    $result=$dbm->InserDelUpdatetDB($sql);
    return $result;
}
function UpdateSms2($VmsCode,$TxtSms2){
    $dbm=new DatabaseManage();
    $sql="Update TMstMVmsDirect set XVSms2='$TxtSms2' where XVVmsCode='$VmsCode'";    
    $result=$dbm->InserDelUpdatetDB($sql);
    return $result;
}

function UpdateSms3($VmsCode,$TxtSms3){
    $dbm=new DatabaseManage();
    $sql="Update TMstMVmsDirect set XVSms3='$TxtSms3' where XVVmsCode='$VmsCode'";    
    $result=$dbm->InserDelUpdatetDB($sql);
    return $result;
}
function UpdateStream($VmsCode,  $XVLinkStream){
    $dbm=new DatabaseManage();
    $sql="Update TMstMVmsDirect set XVLinkStream='$XVLinkStream' where XVVmsCode='$VmsCode'";    
    $result=$dbm->InserDelUpdatetDB($sql);
    return $result;
}


function UploadLogo($VmsCode){
    $ret=0;
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($VmsCode)) {
        mkdir($VmsCode); 
    }
    $sql="select XVFileLogo from TMstMVmsDirect where XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){     
        $XVFileLogo=$result->XVFileLogo;
        $location = $VmsCode."/".$XVFileLogo;
        unlink($location);
    }
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;
    $location = $VmsCode."/".$filename;
  
    
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
    
        $sql="Update TMstMVmsDirect set XVFileLogo='$filename' where XVVmsCode='$VmsCode'";
       
        $ret=$dbm->InserDelUpdatetDB($sql);
        
    }
    
    return  $ret;
}

function UploadMap($VmsCode){
    $ret=0;
    $dbm=new DatabaseManage();
    $UsrCode=$_SESSION["UsrCode"]; 
    if(!is_dir($VmsCode)) {
        mkdir($VmsCode); 
    }
  
    $sql="select XVFileMap from TMstMVmsDirect where XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    foreach ($JsonObj as $result){     
        $XVFileMap=$result->XVFileMap;
        $location = $VmsCode."/".$XVFileMap;
        unlink($location);
    }
    $filename = $_FILES['file']['name'];
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    $filename=date("YmdHis").".".$extension;
    $location = $VmsCode."/".$filename;
    if(move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $sql="Update TMstMVmsDirect set XVFileMap='$filename' where XVVmsCode='$VmsCode'";
        
        $ret=$dbm->InserDelUpdatetDB($sql);
        
    }
    return  $ret;
}

function UpdatePoint($VmsCode,$X1,$Y1,$X2,$Y2,$PointNumber,$Remark){
    $dbm=new DatabaseManage();
    $sql="select * from TMstRoutePoint where XVVmsCode='$VmsCode' and XVPointNumber=$PointNumber";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    if($JsonObj==0){
        $sql="Insert into TMstRoutePoint(
                XVVmsCode,
                XVPointNumber,
                XVRemark,
                XIX1,
                XIY1,
                XIX2,
                XIY2)Values(
                    '$VmsCode',
                    '$PointNumber',
                    '$Remark',
                    '$X1',
                    '$Y1',
                    '$X2',
                    '$Y2'
                )
        ";
    }else{
        $sql="Update TMstRoutePoint set 
            XVRemark='$Remark',
            XIX1='$X1',
            XIY1='$X1',
            XIX2='$X2',
            XIY2='$Y2' 
            where XVVmsCode='$VmsCode' and XVPointNumber=$PointNumber
        ";
    }
    
    $ret=$dbm->InserDelUpdatetDB($sql);
    return $ret; 
}
function ShowData($VmsCode){
    $dbm=new DatabaseManage();
    $sql="select * from TMstMVmsDirect where XVVmsCode='$VmsCode'";
    $result=$dbm->QueryDB($sql);
    return  $result; 
} 
function ShowPoint($VmsCode){
    $dbm=new DatabaseManage();
    $sql="
            SELECT  [XVVmsCode]
            ,[XVPointNumber]
            ,[XVRemark]
            ,[XIX1]
            ,[XIY1]
            ,[XIX2]
            ,[XIY2]
        FROM [NWL_VMSControl].[dbo].[TMstRoutePoint] where XVVmsCode='$VmsCode' 
    ";
    $result=$dbm->QueryDB($sql);
    $JsonObj = json_decode($result);
    $data="[";
    foreach ($JsonObj as $result){ 
        $para="'".$result->XVVmsCode."','".$result->XVPointNumber."'";
        $D='<i  style=\"cursor: pointer;\" class=\"fa-solid fa-pen-to-square\" aria-hidden=\"true\" title=\"แก้ไข\" onclick=\"FuEdit('.$para.')\"></i>';
        $E='<i  style=\"cursor: pointer;\" class=\"fa-solid fa-trash\" aria-hidden=\"true\" title=\"ลบ\" onclick=\"FuDelete('.$para.')\"></i>';
        $data.='
        {
            "A":"'.$result->XVPointNumber."/".$result->XVRemark.'",
            "B":"'.$result->XIX1.','.$result->XIY1.'",
            "C":"'.$result->XIX2.','.$result->XIY2.'",
            "D":"'.$D.'",
            "E":"'.$E.'"
            
        },'; 
    }
    $data=substr($data,0,strlen($data)-1)."]";
    return $data;

}
function DeletePoint($VmsCode,$XVPointNumber){
    $dbm=new DatabaseManage();
    $sql="DELETE FROM [NWL_VMSControl].[dbo].[TMstRoutePoint] where XVVmsCode='$VmsCode' and XVPointNumber='$XVPointNumber'";
    $ret=$dbm->InserDelUpdatetDB($sql);
}
function SerchPoint($VmsCode,$XVPointNumber){
    $dbm=new DatabaseManage();
    $sql="select * from TMstRoutePoint where XVVmsCode='$VmsCode' and XVPointNumber=$XVPointNumber";

    $result=$dbm->QueryDB($sql);
    echo   $result;
}
?>