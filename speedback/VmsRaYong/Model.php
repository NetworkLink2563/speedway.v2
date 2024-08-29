<?php
  function GetIP($VmsCode){
    $dbm=new DatabaseManage();
    $sql="SELECT dbo.TMstMSetupPoint.XVPrjCode, dbo.TMstMVms.XVVmsCode, dbo.TMstMIP.XVIP
            FROM dbo.TMstMVms INNER JOIN
                dbo.TMstMSetupPoint ON dbo.TMstMVms.XVSupCode = dbo.TMstMSetupPoint.XVSupCode INNER JOIN
                dbo.TMstMIP ON dbo.TMstMVms.XVVmsCode = dbo.TMstMIP.XVPrjCode
            WHERE  (dbo.TMstMSetupPoint.XVPrjCode = '$VmsCode')";
     $result=$dbm->QueryDB($sql);
     echo $result;
  }
?>