<?php
include "lib/DatabaseManage.php";
$msgcode=$_GET['msgcode'];
$sql = "SELECT *FROM TMstMMessage WHERE XVMsgCode='".$msgcode."'";
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
?>
<div align="center">
    <img src="media/VMS2403-0001/<?php echo $result_row['XVMsgFileName'];?>">

</div>
