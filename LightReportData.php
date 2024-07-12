<?php
ob_start();
session_start();

include "lib/DatabaseManage.php";
$de=$_REQUEST['de'];
$ds=$_REQUEST['ds'];
$vms=$_REQUEST['vms'];
$html = '<div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">


    <table id="Table" class="table table-bordered">
        <thead>
         <tr>
            <th style="width: 200px;text-align: left;">วันที่</th>
            <th style="width: 400px;text-align: left;">ป้าย</th>
            <th style="width: 200px;text-align: center;">ความสว่าง</th>
         </tr>
     
        </thead>
        <tbody>
    ';
       
    
    if($vms==0){
        $sql = "SELECT   dbo.TDocTCmdSchedule.XVSccDocNo, dbo.TDocTCmdSchedule.XDSccDocDate, CONVERT(varchar, dbo.TDocTCmdSchedule.XTSccDocTime, 120) AS XTSccDocTime, dbo.TDocTCmdSchedule.XVVmsCode, 
        dbo.TMstMItmVMS.XVVmsName, dbo.TDocTCmdSchedule.XVCmdCode, dbo.TDocTCmdSchedule.XBSccIsDone, dbo.TDocTCmdSchedule.XBSccIsSchedule, dbo.TDocTCmdSchedule.XVSccValue
    FROM            dbo.TDocTCmdSchedule INNER JOIN
        dbo.TMstMItmVMS ON dbo.TDocTCmdSchedule.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode
    WHERE        (dbo.TDocTCmdSchedule.XVCmdCode = N'001') AND (dbo.TDocTCmdSchedule.XBSccIsDone = 1) AND (XTSccDocTime>='$ds' and XTSccDocTime<='$de') 
    ORDER BY XTSccDocTime DESC";
}else{
    $sql = "SELECT   dbo.TDocTCmdSchedule.XVSccDocNo, dbo.TDocTCmdSchedule.XDSccDocDate, CONVERT(varchar, dbo.TDocTCmdSchedule.XTSccDocTime, 120) AS XTSccDocTime, dbo.TDocTCmdSchedule.XVVmsCode, 
    dbo.TMstMItmVMS.XVVmsName, dbo.TDocTCmdSchedule.XVCmdCode, dbo.TDocTCmdSchedule.XBSccIsDone, dbo.TDocTCmdSchedule.XBSccIsSchedule, dbo.TDocTCmdSchedule.XVSccValue
    FROM            dbo.TDocTCmdSchedule INNER JOIN
        dbo.TMstMItmVMS ON dbo.TDocTCmdSchedule.XVVmsCode = dbo.TMstMItmVMS.XVVmsCode
    WHERE        (dbo.TDocTCmdSchedule.XVCmdCode = N'001') AND (dbo.TDocTCmdSchedule.XBSccIsDone = 1) AND (XTSccDocTime>='$ds' and XTSccDocTime<='$de') and  (dbo.TDocTCmdSchedule.XVVmsCode = '$vms')
    ORDER BY XTSccDocTime DESC";
}
    
 
    $query = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
      
        $html .='<tr>
            <td style="text-align: left;">'.$row['XTSccDocTime'].'</td>
            <td style="text-align: left;">'.$row['XVVmsName'].'</td>
            <td style="text-align: center;">'.$row['XVSccValue'].'</td>
        </tr>';
    }
$html .='
</tbody>
</table></div>
';                              
echo $html;

?>