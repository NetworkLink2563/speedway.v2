<?php
ob_start();
session_start();


include "lib/DatabaseManage.php";
$vmscode=$_POST['vmscode'];
$XIMssWPixel=0;
$XIMssHPixel=0;
$XVVmsName="";
$sql="SELECT        dbo.TMstMItmVMS.XVVmsCode, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMItmVMS.XVVmsName
FROM            dbo.TMstMItmVMS INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMItmVMS.XVMssCode = dbo.TMstMMsgSize.XVMssCode";
$query= sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $XIMssWPixel=$row['XIMssWPixel'];
    $XIMssHPixel=$row['XIMssHPixel'];
    $XVVmsName=$row['XVVmsName'];
}

$sql="SELECT  dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TLogTItmVMSMessage.XTWhenEdit, DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, 
GETDATE()) AS XiSecDiff
FROM            dbo.TLogTItmVMSMessage INNER JOIN
dbo.TMstMMessage ON dbo.TLogTItmVMSMessage.XVMsgCode = dbo.TMstMMessage.XVMsgCode
WHERE        (dbo.TLogTItmVMSMessage.XVVmsCode = '$vmscode')";
//echo $sql;
$XVVmsCode="";
$XVMsgCode="";
$XVMsgName="";
$XiSecDiff=0;

$CountRecord=0;
$query= sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    $XVVmsCode=$row['XVVmsCode'];      
    $XVMsgCode=$row['XVMsgCode'];
    $XVMsgName=$row['XVMsgName'];  
    $XiSecDiff=$row['XiSecDiff'];  
    $CountRecord++; 
}
if($CountRecord==0){
    $XiSecDiff=10000;
}
$sqlModule = "SELECT XIVdtModuleNo FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode='".$resultSQL['XVVmsCode']."' AND XBVdtIsGood='False'";
$queryModule = sqlsrv_query($conn, $sqlModule);
$XVVdtModuleNo = '';
while($resultModule = sqlsrv_fetch_array($queryModule, SQLSRV_FETCH_ASSOC))
{
    $XVVdtModuleNo.=$resultModule['XIVdtModuleNo'].', ';
}
$XVVdtModuleNo = substr($XVVdtModuleNo, 0, -2);

$sql="SELECT  XVVmsCode, XISensorType, XBVmsIsOn, XBVmsIsDisplay, XIVmsBrightness, XIVmsRackTemperature, XIVmsBoardTemperature, XBVmsFanIsActive, XBVmsFlashIsActive, XBVmsComIsActive
FROM            dbo.TMstMItmVMS_Status
WHERE        (XVVmsCode = '$vmscode')
ORDER BY XISensorType";

$XIVmsBrightness="";
$XIVmsRackTemperature="";
$XIVmsBoardTemperature="";
$XBVmsFanIsActive="";
$query= sqlsrv_query($conn, $sql);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    if($row['XISensorType']==1){
      if($XBVmsIsOn=1){
        $XBVmsIsOn="On";
      }else{
        $XBVmsIsOn="Off";
      }
    }elseif($row['XISensorType']==2){
      if($XBVmsIsDisplay=1){
        $XBVmsIsDisplay="On";
      }else{
        $XBVmsIsDisplay="Off";
      }  
    }elseif($row['XISensorType']==3){
        $XIVmsBrightness=$row['XIVmsBrightness'];
    }elseif($row['XISensorType']==4){
        $XIVmsRackTemperature=$row['XIVmsRackTemperature'];
    }elseif($row['XISensorType']==5){
        $XIVmsBoardTemperature=$row['XIVmsBoardTemperature'];
    }elseif($row['XISensorType']==6){
      
      if($row['XBVmsFanIsActive']==1){
        $XBVmsFanIsActive="On";
      }else{
        $XBVmsFanIsActive="Off";
      }
    }elseif($row['XBVmsFlashIsActive']==7){
        if($row['XBVmsFlashIsActive']==1){
            $XBVmsFlashIsActive="On";
          }else{
            $XBVmsFlashIsActive="Off";
          }
    }elseif($row['XISensorType']==8){        
    }
}
sqlsrv_close( $conn );
$dataj='{';
$dataj.='"XVVmsCode":"'.$vmscode.'",';
$dataj.='"XVVmsName":"'.$XVVmsName.'",';
$dataj.='"XIMssWPixel":"'.$XIMssWPixel.'",';
$dataj.='"XIMssHPixel":"'.$XIMssHPixel.'",';
$dataj.='"XVMsgCode":"'.$XVMsgCode.'",';
$dataj.='"XBVmsIsOn":"'.$XBVmsIsOn.'",';
$dataj.='"XBVmsIsDisplay":"'.$XBVmsIsDisplay.'",';
$dataj.='"XiSecDiff":'.$XiSecDiff.',';
$dataj.='"XIVmsBrightness":"'.$XIVmsBrightness.'",';
$dataj.='"XIVmsRackTemperature":"'.$XIVmsRackTemperature.'",';
$dataj.='"XIVmsBoardTemperature":"'.$XIVmsBoardTemperature.'",';
$dataj.='"XBVmsFlashIsActive":"'.$XBVmsFlashIsActive.'",';
$dataj.='"XVVdtModuleNo":"'.$XVVdtModuleNo.'",';
$dataj.='"XBVmsFanIsActive":"'.$XBVmsFanIsActive.'",';
$dataj.='"XVMsgName":"'.$XVMsgName.'"';
$dataj.='}';
echo $dataj;
?>