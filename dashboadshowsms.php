<?php
ob_start();
session_start();


include "lib/DatabaseManage.php";
$vmscode=$_POST['vmscode'];
$XIMssWPixel=0;
$XIMssHPixel=0;
$XVVmsName="";
$sqld="SELECT        dbo.TMstMItmVMS.XVVmsCode, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMItmVMS.XVVmsName
FROM            dbo.TMstMItmVMS INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMItmVMS.XVMssCode = dbo.TMstMMsgSize.XVMssCode";
$queryd= sqlsrv_query($conn, $sqld);
while($rowd = sqlsrv_fetch_array($queryd, SQLSRV_FETCH_ASSOC)){
    $XIMssWPixel=$rowd['XIMssWPixel'];
    $XIMssHPixel=$rowd['XIMssHPixel'];
    $XVVmsName=$rowd['XVVmsName'];
}
$sqlx ="SELECT        dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XTWhenEdit, DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, GETDATE()) AS XiSecDiff, dbo.TLogTItmVMSMessage.XVMsfCode, 
                         dbo.TMstMMessageFrame.XVMsfFormat, dbo.TMstMMessageFrame.XVMsgCodeF1, dbo.TMstMMessageFrame.XVMsgCodeF2, dbo.TMstMMessageFrame.XVMsgCodeF3, dbo.TMstMMessageFrame.XVMsgCodeF4, 
                         dbo.TMstMMessageFrame.XVMsgCodeF5
FROM            dbo.TLogTItmVMSMessage INNER JOIN
                         dbo.TMstMMessageFrame ON dbo.TLogTItmVMSMessage.XVMsfCode = dbo.TMstMMessageFrame.XVMsfCode WHERE (dbo.TLogTItmVMSMessage.XVVmsCode = '$vmscode')";
     
//$sql="SELECT  dbo.TLogTItmVMSMessage.XVVmsCode, dbo.TLogTItmVMSMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TLogTItmVMSMessage.XTWhenEdit, DATEDIFF(Second, dbo.TLogTItmVMSMessage.XTWhenEdit, 
//GETDATE()) AS XiSecDiff
//FROM            dbo.TLogTItmVMSMessage INNER JOIN
//dbo.TMstMMessage ON dbo.TLogTItmVMSMessage.XVMsgCode = dbo.TMstMMessage.XVMsgCode
//WHERE        (dbo.TLogTItmVMSMessage.XVVmsCode = '$vmscode')";
//echo $sql;
$XVVmsCode="";
$XVMsgCode="";
$XVMsgName="";
$XiSecDiff="";
$XVMsfCode="";
$msq_txt="";
$queryi= sqlsrv_query($conn, $sqlx);
$rowk = sqlsrv_fetch_array($queryi, SQLSRV_FETCH_ASSOC);
    $XVVmsCode=$rowk['XVVmsCode'];      
    $XVMsgCode=$rowk['XVMsgCode'];
    $XVMsgName.=$rowk['XVMsgName'];  
    $XiSecDiff=$rowk['XiSecDiff'];  
    $XVMsfCode=$rowk['XVMsfCode'];  

$msqcode="SELECT * FROM [NWL_SpeedWayTest2].[dbo].[TMstMMessageFrame] where XVMsfCode='".$XVMsfCode."'";
$qcode=sqlsrv_query($conn,$msqcode);   
$rowcode = sqlsrv_fetch_array($qcode, SQLSRV_FETCH_ASSOC);
$msq_txt=$rowcode['XVMsfName'];


$sqlModule = "SELECT XIVdtModuleNo FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode='".$vmscode."' AND XBVdtIsGood='False'";
//echo $sqlModule;
$queryModule = sqlsrv_query($conn, $sqlModule);
$XVVdtModuleNo = '';
while($resultModule = sqlsrv_fetch_array($queryModule, SQLSRV_FETCH_ASSOC))
{
    $XVVdtModuleNo.=$resultModule['XIVdtModuleNo'].', ';
}
$XVVdtModuleNo = substr($XVVdtModuleNo, 0, -2);

$sqlt="SELECT  *  FROM   dbo.TMstMItmVMS_Status
WHERE   (XVVmsCode = '$vmscode')
ORDER BY XISensorType";

$XIVmsBrightness="";
$XIVmsRackTemperature="";
$XIVmsBoardTemperature="";
$XBVmsFanIsActive="";
$query= sqlsrv_query($conn, $sqlt);
while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
    if($row['XISensorType']==1){
      if($row['XIValue']==1){
        $XBVmsIsOn="On";
      }else{
        $XBVmsIsOn="Off";
      }
    }elseif($row['XISensorType']==2){
      if($row['XIValue']==1){
        $XBVmsIsDisplay="On";
      }else{
        $XBVmsIsDisplay="Off";
      }  
    }elseif($row['XISensorType']==3){
        $XIVmsBrightness=$row['XIValue'];
    }elseif($row['XISensorType']==4){
        $XIVmsRackTemperature=$row['XIValue'];
    }elseif($row['XISensorType']==5){
        $XIVmsBoardTemperature=$row['XIValue'];
    }elseif($row['XISensorType']==6){
      
      if($row['XIValue']==1){
        $XBVmsFanIsActive="On";
      }else{
        $XBVmsFanIsActive="Off";
      }
    }elseif($row['XISensorType']==7){
        if($row['XIValue']==1){
            $XBVmsFlashIsActive="On";
          }else{
            $XBVmsFlashIsActive="Off";
          }
    }elseif($row['XISensorType']==8){      
      if($row['XIValue']==1){
        $XBVmscompsActive="On";
      }else{
        $XBVmscompsActive="Off";
      }
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
$dataj.='"XiSecDiff":"'.$XiSecDiff.'",';
$dataj.='"XIVmsBrightness":"'.$XIVmsBrightness.'",';
$dataj.='"XIVmsRackTemperature":"'.$XIVmsRackTemperature.'",';
$dataj.='"XIVmsBoardTemperature":"'.$XIVmsBoardTemperature.'",';
$dataj.='"XBVmsFlashIsActive":"'.$XBVmsFlashIsActive.'",';
$dataj.='"XVVdtModuleNo":"'.$XVVdtModuleNo.'",';
$dataj.='"XBVmsFanIsActive":"'.$XBVmsFanIsActive.'",';
$dataj.='"XBVmscompIsActive":"'.$XBVmscompsActive.'",';
$dataj.='"XVMsgName":"'.$msq_txt.'"';
$dataj.='}';
echo $dataj;
?>