<?php
ob_start();
session_start();
include "DatabaseManage.php";
$msgcode=$_POST['msgcode'];
$msgcode=str_replace('msgcodeRestore%5B%5D=','',$msgcode);
$msgcode=explode('&',$msgcode);
$msgCount=count($msgcode);
for ($x = 0; $x < $msgCount; $x++) {
    $codeMSG.="'".$msgcode[$x]."',";
}
$sqlCodeMSG=substr($codeMSG, 0, -1)

?>
<table id="UserTable" class="table " style="width:100%; font-size: 10pt">
    <thead>
    <tr style="font-size: 10pt">
        <th class="th-sm">ชื่อป้าย</th>
        <th class="th-sm" style="text-align: center"></th>
        <th class="th-sm" style="text-align: center"></th>
        <th class="th-sm" style="text-align: center"></th>
    </tr>
    </thead>
    <tbody> <?php
    $sql = "SELECT * FROM TMstMMessage WHERE XVMsgCode NOT IN (select XVMsgCode FROM TMstMItmVMSMessage) and XVMsgCode not in($sqlCodeMSG)
         ORDER BY XVMsgCode ASC";

    $query = sqlsrv_query($conn, $sql);
    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){?>
        <tr>
            <td><?php echo $result['XVMsgName'];?></td>
            <td></td>
            <td></td>
            <td align="right"> <input type="checkbox" class="msgcode" id="msgcode[]" name="msgcode[]" value="<?php echo $result['XVMsgCode'];?>"></td>
        </tr>
    <?php }?>
    </tbody>
</table>
