<?php
ob_start();
session_start();
include 'header.php';
include "lib/DatabaseManage.php";
$XVMsgCode = base64_decode($_GET[ 'msg' ]);
$sql = "SELECT XVMsgCode,XVMssCode,XVMsgFileName FROM TMstMMessage WHERE XVWhoCreate='".$_SESSION['userName']."' AND XVMsgStatus=3";
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

?>

<div class="centered" style="margin-top: 60;margin-left: 10;">
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;Preview
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="row">
            <div class="col-sm-12" style="text-align: center">
                <div align="center"><button type="submit" class="btn btn-primary" onclick="backStep();">ย้อนกลับ</button> <button type="submit" class="btn btn-success" onclick="confirmMSG();">เพิ่มข้อความ</button>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 10px;padding-bottom: 20">
            <div class="col-sm-12" style="text-align: center">
                <img src="media/VMS2403-0001/<?php echo $result_row['XVMsgFileName'];?>"
            </div>

        </div>
    </div>
</div>

<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>

<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script>
    function backStep(){
        var XVMsgCode='<?php echo $result_row['XVMsgCode'];?>';
        var vms='<?php echo $_GET['vms'];?>';
        var vmsSize='<?php echo $_GET['vmsSize'];?>';
        var messageCheckboxManual='<?php echo $_GET['messageCheckboxManual'];?>';
        var inputTimerManual='<?php echo $_GET['inputTimerManual'];?>';
        var datestart='<?php echo $_GET['datestart'];?>';
        var dateend='<?php echo $_GET['dateend'];?>';
        var msgBG='<?php echo $_GET['msgBG'];?>';
        $.ajax({
            type: "POST",
            url: "lib/processCancleMSG.php",
            data: {'XVMsgCode':XVMsgCode,'vms':vms,'vmsSize':vmsSize,'messageCheckboxManual':messageCheckboxManual,'inputTimerManual':inputTimerManual,'datestart':datestart,'dateend':dateend,'msgBG':msgBG },
            success: function(result) {
               window.location.href = 'Schedulemessage.php?vmsSize='+vmsSize+'&vms='+vms+'&messageCheckboxManual='+messageCheckboxManual+'&inputTimerManual='+inputTimerManual+'&datestart='+datestart+'&dateend='+dateend+'&msgBG='+msgBG+'&user=<?php echo $_SESSION['userName'];?>&status=3';
            }
        });
    }
    function confirmMSG(){
        var XVMsgCode='<?php echo $result_row['XVMsgCode'];?>';
        var vms='<?php echo $_GET['vms'];?>';
        var vmsSize='<?php echo $_GET['vmsSize'];?>';
        var messageCheckboxManual='<?php echo $_GET['messageCheckboxManual'];?>';
        var inputTimerManual='<?php echo $_GET['inputTimerManual'];?>';
        var datestart='<?php echo $_GET['datestart'];?>';
        var dateend='<?php echo $_GET['dateend'];?>';
        var msgBG='<?php echo $_GET['msgBG'];?>';
        $.ajax({
            type: "POST",
            url: "lib/processConfirmMSG.php",
            data: {'XVMsgCode':XVMsgCode,'vms':vms,'vmsSize':vmsSize,'messageCheckboxManual':messageCheckboxManual,'inputTimerManual':inputTimerManual,'datestart':datestart,'dateend':dateend,'msgBG':msgBG },
            success: function(result) {
                //console.log(result);
                window.location.href = 'Schedulemessage.php';
            }
        });
    }
</script>