<?php


include 'header.php';
include 'function_dashboard.php';
$firstSQL="SELECT vms.XVVmsCode
FROM TMstMItmVMS as vms
GROUP BY vms.XVVmsCode";
$querySQL = sqlsrv_query($conn, $firstSQL);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

$sql = "SELECT vms.XVVmsCode,
       vms.XVVmsName,
       vms.XVSupCode,
       vms.XBVmsIsActive,
       vms.XIVmsPixelW,
       vms.XIVmsPixelH,
       vms.XIVmsSizeW,
       vms.XIVmsSizeH,
       vms.XVVmsSta,
       vms.XVVmsType,
       TMstMCustomer.XVCstCode,
       TMstMUser.XVUsrCode,
       TMstMItmVMS_Status.XBVmsIsOn,
       TMstMItmVMS_Status.XBVmsIsDisplay,
       TMstMItmVMS_Status.XIVmsBrightness,
       TMstMItmVMS_Status.XIVmsRackTemperature,
       TMstMItmVMS_Status.XIVmsBoardTemperature,
       TMstMItmVMS_Status.XBVmsFanIsActive,
       TMstMItmVMS_Status.XBVmsFlashIsActive
FROM TMstMItmVMS as vms
INNER JOIN TMstMSetupPoint ON TMstMSetupPoint.XVSupCode = vms.XVSupCode
INNER JOIN TMstMProject ON TMstMProject.XVPrjCode = TMstMSetupPoint.XVPrjCode
INNER JOIN TMstMSubDistrict ON TMstMSubDistrict.XVSdtCode = TMstMSetupPoint.XVSdtCode
INNER JOIN TMstMCustomer ON TMstMCustomer.XVCstCode = TMstMProject.XVCstCode
INNER JOIN TMstMUser ON TMstMUser.XVCstCode = TMstMCustomer.XVCstCode
INNER JOIN TMstMItmVMS_Status ON TMstMItmVMS_Status.XVVmsCode = vms.XVVmsCode
WHERE TMstMUser.XVCstCode='".$_SESSION['user']."'
GROUP BY vms.XVVmsCode
";
$query = sqlsrv_query($conn, $sql);

?>
<div class="centered" style="margin-top: 60;margin-left: 10;">

<div class="box" style="margin-top: 30" align="center">
    <div style="margin-top:10;margin-bottom: 10;">
        <table width="99%" border="1" cellpadding="3" cellspacing="0" style="font-size: 9pt;">
            <tr style="background: #eaeaea">
                <td width="1%"><div align="center">สถานะ</div></td>
                <td width="1%"><div align="center">STA</div></td>
                <td width="7%"><div align="center">แบบป้าย</div></td>
                <td width="3%"><div align="center">ป้าย</div></td>
                <td width="1%"><div align="center">ไฟ</div></td>
                <td width="1%"><div align="center">แสดง<br>ผล</div></td>
                <td width="2%"><div align="center">ความสว่าง</div></td>
                <td width="1%"><div align="center">อุณหภูมิตู้</div></td>
                <td width="1%"><div align="center">อุณหภูมิป้าย</div></td>
                <td width="2%"><div align="center">พัดลม<br>ตู้</div></td>
                <td width="2%"><div align="center">ไฟกระพริบ</div></td>
                <td width="4%"><div align="center">โมดูลเสีย</div></td>
                <td width="1%"><div align="center">ประเภท</div></td>
                <td width="13%"><div align="center">ข้อความ</div></td>
                <td width="1%"><div align="center">Live</div></td>
            </tr>
            <?php
            while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
            {
                $sqlModule = "SELECT XIVdtModuleNo FROM TMstMItmVMS_ModuleStatus WHERE XVVmsCode='".$result['XVVmsCode']."' AND XBVdtIsGood='False'";
                $queryModule = sqlsrv_query($conn, $sqlModule);
                $falseModule = '';
                    while($resultModule = sqlsrv_fetch_array($queryModule, SQLSRV_FETCH_ASSOC))
                    {
                        $falseModule.=$resultModule['XIVdtModuleNo'].', ';
                    }
                $falseModule = substr($falseModule, 0, -2);

                $sqlLive = "SELECT XBLiveIsActive FROM TMstMItmVMS_LiveViews WHERE XVVmsCode='".$result['XVVmsCode']."'";
                $queryLive = sqlsrv_query($conn, $sqlLive);
                $resultLive = sqlsrv_fetch_array($queryLive, SQLSRV_FETCH_ASSOC);
                if($resultLive['XBLiveIsActive']==1){
                    $urlLive=$resultLive['XBLiveIsActive'];
                    $tdTable='<td><div align="center" style="margin-left: 2;margin-right: 2"><a href="http://127.0.0.1/speedway/liveviews.php?livecode='.$urlLive.'" onclick="return show_modal(this);" style="color: #0a0a0a"><span style="color: #00CC00;"><i class="fa fa-video-camera" aria-hidden="true"></i></div></td>';
                }else{
                    $urlLive='';
                    $tdTable='<td><div align="center" style="margin-left: 2;margin-right: 2"><span style="color:#CCCCCC;"><i class="fa fa-video-camera" aria-hidden="true" ></i></span></div></td>';
                }
                    if($result['XBVmsIsOn']==True){ $XBVmsIsOn="ON"; }else{ $XBVmsIsOn="OFF"; }
                    if($result['XBVmsIsDisplay']==True){ $XBVmsIsDisplay="ON"; }else{ $XBVmsIsDisplay="OFF"; }
                    if($result['XBVmsFanIsActive']==True){ $XBVmsFanIsActive="ON"; }else{ $XBVmsFanIsActive="OFF"; }
                    if($result['XBVmsFlashIsActive']==True){ $XBVmsFlashIsActive="ON"; }else{ $XBVmsFlashIsActive="OFF"; }
                    if($result['XIVmsRackTemperature']==0){ $XIVmsRackTemperature=""; }else{ $XIVmsRackTemperature=$result['XIVmsRackTemperature']."° C"; }
                    if($result['XIVmsBoardTemperature']==0){ $XIVmsBoardTemperature=""; }else{ $XIVmsBoardTemperature=$result['XIVmsBoardTemperature']."° C"; }
                if($result['XBVmsIsActive']==True){
                    $colorBannerBG='#eef8e5';
                    $colorBannerStatus='#00CC00';
                    $colorFont='#CCCCCC';
                }else{
                    $colorBannerBG='#ffe6e6';
                    $colorBannerStatus='red';
                    $colorFont='#CCCCCC';
                }
            ?>
            <tr style="background: <?php echo $colorBannerBG;?>; color: <?php echo $colorFont;?>">
                <td ><div align="center" style="margin-left: 2;margin-right: 2"><span style="color: <?php echo $colorBannerStatus;?>;"><i class="fa fa-cloud" aria-hidden="true"></i></span></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $result['XVVmsSta'];?></div></td>
                <td><div style="margin-left: 2;margin-right: 2">ป้าย <?php echo $result['XIVmsPixelW'];?>x<?php echo $result['XIVmsPixelH'];?> (<?php echo $result['XIVmsSizeW'];?>x<?php echo $result['XIVmsSizeH'];?> เมตร)
                    </div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $result['XVVmsName'];?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $XBVmsIsOn;?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $XBVmsIsDisplay;?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $result['XIVmsBrightness'];?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $XIVmsRackTemperature;?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $XIVmsBoardTemperature;?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2; "><?php echo $XBVmsFanIsActive;?></div></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2; "><?php echo $XBVmsFlashIsActive;?></div></td>
                <td><div style="margin-left: 2;margin-right: 2"></div><?php echo $falseModule;?></td>
                <td><div align="center" style="margin-left: 2;margin-right: 2"><?php echo $result['XVVmsType'];?></div></td>
                <td><div style="margin-left: 2;margin-right: 2"></div></td>
                <?php echo $tdTable;?>
            </tr>
            <?php }?>
        </table>
    </div>
</div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog"style="width: 1600" >
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width: 370">
            <div class="modal-header">
                <span class="modal-title">CCTV - ปากเกร็ด</span>
            </div>
            <div class="modal-body" style="text-align: center">
                <iframe id="iframe_modal" src="" style="width: 340; height: 265"></iframe>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script>
    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModal').modal('show');
        return false;
    }
</script>

</body>
</html>
