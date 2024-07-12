<?php
ob_start();
session_start();

include "lib/DatabaseManage.php";
$de=$_REQUEST['de'];
$ds=$_REQUEST['ds'];
$html = '<div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">


   
    <table id="Table" class="table table-bordered">
        <thead>
         <tr>
            <th style="width: 200px;text-align: center;">วันที่</th>
            <th style="width: 400px;text-align: center;">ผู้ใช้</th>
         </tr>
        </thead>
        <tbody>
    ';
       
    
    $sql = "SELECT   CONVERT(varchar,dbo.TLogLogIn.XTLogInTime,120) as XTLogInTime, dbo.TLogLogIn.XVUsrCode, dbo.TMstMUser.XVUsrName
    FROM            dbo.TLogLogIn INNER JOIN
                             dbo.TMstMUser ON dbo.TLogLogIn.XVUsrCode = dbo.TMstMUser.XVUsrCode where dbo.TLogLogIn.XTLogInTime>='$ds' and dbo.TLogLogIn.XTLogInTime<='$de' 
    ORDER BY dbo.TLogLogIn.XTLogInTime";
    $query = sqlsrv_query($conn, $sql);

    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
      
        $html .='<tr>
            <td style="text-align: left;">'.$row['XTLogInTime'].'</td>
            <td style="text-align: left;">'.$row['XVUsrName'].'</td>
        </tr>';
    }
$html .='
</tbody>
</table>
</div>
';                        
                 
echo $html;

?>