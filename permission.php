<?php
function checkmenu($user,$menu){
    $countrecord=0;
    include "lib/DatabaseManage.php";
    $sql="SELECT XVUsrCode, XVMnuCode, XBDmnIsRead, XBDmnIsAdd, XBDmnIsDelete, XBDmnIsControl
    FROM   dbo.TMnyMUserMenu
    WHERE  (XVMnuCode = '$menu') AND (XVUsrCode = '$user')";
    $querySQL = sqlsrv_query($conn, $sql);  
    while($resultSQL = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC))
    {
       $countrecord++;
       $_SESSION["XBDmnIsRead"]=$resultSQL['XBDmnIsRead'];
       $_SESSION["XBDmnIsAdd"]=$resultSQL['XBDmnIsAdd'];
       $_SESSION["XBDmnIsDelete"]=$resultSQL['XBDmnIsDelete'];
       $_SESSION["XBDmnIsControl"]=$resultSQL['XBDmnIsControl'];  
    }
    sqlsrv_close( $conn );
    return $countrecord;
}
?>