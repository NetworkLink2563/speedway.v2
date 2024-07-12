<?php
ob_start();
session_start();
include "DatabaseManage.php";
$msgcode=$_POST['msgcode'];
$vmsID=$_POST['vmsID'];
$msgcode=str_replace('msgcode%5B%5D=','',$msgcode);
$msgcode=explode('&',$msgcode);
$msgCount=count($msgcode);
for ($x = 0; $x < $msgCount; $x++) {
    $codeMSG.="'".$msgcode[$x]."',";
}
$sqlCodeMSG=substr($codeMSG, 0, -1);
$sql = "SELECT * FROM TMstMItmVMS  WHERE XVVmsCode='$vmsID'";
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
?>
<table id="UserTable1" class="table " style="width:100%; font-size: 10pt">
    <thead>
    <tr style="font-size: 10pt">
        <th class="th-sm">ชื่อป้าย</th>
        <th class="th-sm" style="text-align: center">ประเภท</th>
        <th class="th-sm" style="text-align: center">ตัวอย่าง</th>
        <th class="th-sm" style="text-align: center"></th>
    </tr>
    </thead>
    <tbody> <?php

    //$sql = "SELECT * FROM TMstMMessage WHERE XVMsgCode NOT IN (select XVMsgCode FROM TMstMItmVMSMessage) and XVMsgCode not in($sqlCodeMSG)
    //     ORDER BY XVMsgCode ASC";

    $XVMssCode=$result['XVMssCode'];
            $sql = "SELECT   dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMssCode, dbo.TMstMMessage.XVMsgType, 
            dbo.TMstMMessage.XVMsgFileName, dbo.TMstMMessage.XVMsgStatus, dbo.TMstMMessage.XVMsgBg, dbo.TMstMMessage.XVWhoCreate, dbo.TMstMMessage.XVWhoEdit, dbo.TMstMMessage.XTWhenCreate, 
            dbo.TMstMMessage.XTWhenEdit, dbo.TMstMMsgSize.XVMssName, dbo.TMstMMsgSize.XIMssWPixel
        FROM            dbo.TMstMMessage INNER JOIN
            dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
        WHERE        (dbo.TMstMMessage.XVMssCode = '$XVMssCode')
        ORDER BY dbo.TMstMMessage.XVMsgCode DESC";
    $query = sqlsrv_query($conn, $sql);
    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
        if( $result['XVMsgType']==1){
            $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
        }elseif( $result['XVMsgType']==2){
            $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
        }elseif( $result['XVMsgType']==3){
            $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
        }
        ?>
        <tr>
           <td style="text-align: center"> <?php echo $result['XVMsgName'];?></td>
           <td style="text-align: center"> <?php echo $XVMsgType;?></td>
           <td><div align="center"><a href="<?php echo 'ifarme.php?msg='.base64_encode($resultauto1['XVMsgCode']);?>" onclick="return show_modal(this,'<?php echo $resultauto1['XVMsgName'];?>','<?php echo $resultauto1['XIMssWPixel'];?>','<?php echo $resultauto1['XIMssHPixel'];?>');" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                    </div></td>
            <td align="right"> <input type="checkbox" class="msgcode" id="msgcode[]" name="msgcode[]" value="<?php echo $result['XVMsgCode'];?>"></td>
        </tr>
    <?php }?>
    </tbody>
</table>
