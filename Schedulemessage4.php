<?php
include 'header.php';
include "lib/DatabaseManage.php";
$sql = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";

$query = sqlsrv_query($conn, $sql);

?>
<style>
    a.del-item:link {
        color: #595959 !important;
    }
    a.del-item:visited {
        color: #595959 !important;
    }
    a.del-item:hover {
        color: #FF0000 !important;
    }
    a.del-item:focus {
        color: #FF0000 !important;
    }
    a.del-item:active {
        color: #595959 !important;
    }
    a.del-VMS:link {
        color: #595959 !important;
    }
    a.del-VMS:visited {
        color: #595959 !important;
    }
    a.del-VMS:hover {
        color: #FF0000 !important;
    }
    a.del-VMS:focus {
        color: #FF0000 !important;
    }
    a.del-VMS:active {
        color: #595959 !important;
    }
    a.activeUser-item:link {
        color: #595959 !important;
    }
    a.activeUser-item:visited {
        color: #595959 !important;
    }
    a.activeUser-item:hover {
        color: #66CC00 !important;
    }
    a.activeUser-item:focus {
        color: #66CC00 !important;
    }
    a.activeUser-item:active {
        color: #595959 !important;
    }

</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div class="row">
            <div class="col-sm-6">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;จัดตารางข้อความประชาสัมพันธ์
                    <div style="margin-top:-5;"><hr></div>
                </div>
            </div>
            <div class="col-sm-6" align="right">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                    <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalOpen" style=" height: 35; color: #595959; font-size: 10pt" onclick="processListMessage()" title="การแสดงข้อความ"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มรายการข้อความ</a>&nbsp;&nbsp;&nbsp;
                </div>
            </div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <?php
            $i=1;
            while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
            $sqlnum_row = "SELECT COUNT(*) as 'count' FROM TMstMItmVMSMessage WHERE XVVmsCode = '".$result["XVVmsCode"]."'";
            $queryrow = sqlsrv_query($conn, $sqlnum_row);
            $row_count = sqlsrv_fetch_array($queryrow);

            if($i==1){
                $tabActive=' active';
            }else{
                $tabActive='';
            }

            ?>
                <button class="tablinks<?php echo $tabActive;?>" id="<?php echo $i; ?>" onclick="openTab(event, '<?php echo $result["XVVmsCode"]; ?>')"><?php echo $result['XVVmsName']; ?><span style="font-size: 10pt">(<?php echo $row_count['count'];?>)</span></button>
                <?php
                $i++;
            }?>
        </div>
        <?php
        $j=1;
        $sql2 = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
        $query2 = sqlsrv_query($conn, $sql2);
        while($result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC)){
            if($j==1){
                $contentDisplay='display: block;';
            }else{
                $contentDisplay='';
            }
        ?>
             <div id="<?php echo $result2["XVVmsCode"]; ?>" class="tabcontent" style="<?php echo  $contentDisplay;?> margin-left: 10px;margin-right: 10px;" id="container">
                 <div class="row">
                     <div class="col-sm-3">
                     </div>
                     <div class="col-sm-5" >
                         <table class="table">
                             <thead>
                             <tr>
                                 <th width="70 " scope="col">รหัสข้อความ</th>
                                 <th width="50" scope="col"><div style="text-align: center">ลำดับ</div></th>
                                 <th width="100" scope="col"><div align="center">ดูข้อความ</div></th>
                                 <th width="50" scope="col"><div align="center">Op</div></th>
                             </tr>
                             </thead>
                             <tbody style="font-size: 10pt">
                             <?php
                             $sql3 = "SELECT TOP 1 * FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $result2['XVVmsCode'] . "' ORDER BY XIVmgOrder DESC ";
                             $query3 = sqlsrv_query($conn, $sql3);
                             $result3 = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC);
                             $value1=$result3['XVMsgCode'];


                             $sql4 = "SELECT TOP 1 * FROM TMstMItmVMSMessage WHERE XVVmsCode='" . $result2['XVVmsCode'] . "' ORDER BY XIVmgOrder ASC ";
                             $query4 = sqlsrv_query($conn, $sql4);
                             $result4 = sqlsrv_fetch_array($query4, SQLSRV_FETCH_ASSOC);
                             $value3=$result4['XVMsgCode'];
                             $sql_row = "SELECT * FROM TMstMItmVMSMessage INNER JOIN TMstMMessage ON TMstMMessage.XVMsgCode=TMstMItmVMSMessage.XVMsgCode WHERE TMstMItmVMSMessage.XVVmsCode='".$result2['XVVmsCode']."' AND TMstMMessage.XVMsgStatus=4 ORDER BY TMstMItmVMSMessage.XIVmgOrder ASC";
                             $query_row = sqlsrv_query($conn, $sql_row);
                             while($result_row = sqlsrv_fetch_array($query_row, SQLSRV_FETCH_ASSOC)){
                                 $value2=$result_row['XVMsgCode'];

                             ?>
                             <tr id="myDiv<?php echo $result_row['XVMsgCode'];?><?php echo $result_row['XVVmsCode'];?>">
                                 <td><?php echo $result_row['XVMsgCode'];?></td>
                                 <td><div style="text-align: center">
                                         <?php
                                         if($value1==$value2){
                                             ?>
                                           <i class="fa fa-caret-down" aria-hidden="true" style="color: red"></i>
                                         <?php
                                         }else{?>
                                            <a href="#" onclick="processSeqNo('<?php echo $result_row['XVMsgCode'];?>','DOWN','<?php echo $result_row['XVVmsCode'];?>');"><i class="fa fa-caret-down" aria-hidden="true" style="color: red"></i></a>
                                         <?php }?>
                                         <?php
                                         if($value3==$value2){
                                         ?>
                                             <i class="fa fa-caret-up" aria-hidden="true" style="color: green"></i>
                                         <?php }else{?>
                                             <a href="#" onclick="processSeqNo('<?php echo $result_row['XVMsgCode'];?>','UP','<?php echo $result_row['XVVmsCode'];?>');"><i class="fa fa-caret-up" aria-hidden="true" style="color: green"></i></a>
                                         <?php }?>
                                         </div></td>
                                     <td><div align="center"><a href="<?php echo 'textview2.php?msgcode='.$result_row['XVMsgCode'];?>" onclick="return show_modal(this);" style="color: #0a0a0a"><i class="fa fa-search" aria-hidden="true"></i></a>
                                     </div></td>
                                 <td><div align="center"><a href="#" class="del-item" style="color: #8d9499" onclick="deleteMSG('<?php echo $result_row['XVMsgCode']; ?>','<?php echo $result_row['XVVmsCode']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></td>
                             </tr>
                             <?php }?>

                             </tbody>
                         </table>
                     </div>
                     <div class="col-sm-3">
                     </div>

                 </div>
             </div>
            <?php
            $j++;
        }?>
    </div>
    <br >
</div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe_modal" src="" style="width: 100%; height: 40%;"></iframe>

            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModalOpen" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">เลือกประเภทข้อความ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tabMessage" name="firstactive" class="tablinks active" onclick="openActivityMessage(event, 'MessageValue')">แสดงข้อความ</button>
                </div>
                <div id="MessageValue" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="messageListModalRadio" name="radiobuttonBrightness" type="radio" value="1"  onclick="messageListValue(1)"/> จากรายการข้อความ
                        </div>
                        <div class="col-sm-3"  style="margin-top: 10px"><input id="messageManualModalRadio" name="radiobuttonBrightness" type="radio" value="2" onclick="messageListValue(2)"/>&nbsp;เขียนข้อความ
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                    <div id="vmsBanner" style="display: none; margin-top: 10">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">ป้าย VMS
                            </div>
                            <div class="col-sm-4" style="margin-left: -30;">
                                <select id="vms" name="vms" style="width: 300; height: 37" class="input" onchange="vmsListNextstep()">
                                    <option value="" selected="selected">เลือกป้าย VMS</option>

                                    <?php
                                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVVmsCode']; ?>"><?php echo $result['XVVmsName']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div id="listMessageDiv" style="display: none">
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">รายการ
                            </div>
                            <div class="col-sm-4" style="margin-left: -30;">
                                <select id="vmsMSG" name="vmsMSG" style="width: 300; height: 37" class="input" onchange="vmsMSGNextStep();">
                                    <option value="" selected="selected">เลือกรายการข้อความ</option>
                                    <?php
                                    $stmt = "SELECT * FROM TMstMMessage WHERE XVMsgStatus = 1 ORDER BY XVMsgCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVMsgCode']; ?>"><?php echo $result['XVMsgName']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div id="actionListlDiv" style="display: none">
                        <div class="row" style="margin-top: 0">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">การทำงาน
                            </div>
                            <div class="col-sm-7" style="margin-left: -30;">
                                <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox" class="messageCheckbox" id="messageAutoRadio" name="messageAutoRadio" value="1" onclick="activityWork(1)"> กำหนดช่วงสิ้นสุด
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="timer" style="display: none">
                            <div class="row" style="margin-top: 0">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-2" style="margin-top: 5px">ระยะเวลา
                                </div>
                                <div class="col-sm-7" style="margin-left: -30;">
                                    <div class="col-sm-3" style="margin-top: 10px;margin-left: -10px"><input id="inputTimer" class="input" style="width: 40px;text-align: center;" type="text" name="inputTimer" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); timerListNextStep();"/> วินาที</div>
                                    </div>
                                </div>
                            </div>
                        <div id="showDate" style="display: none">
                        <div class="row" style="margin-top: 10">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">วันที่เริ่ม
                            </div>
                            <div class="col-sm-7" style="margin-left: -20;">
                                <div class="col-sm-" style="margin-top: 0px;margin-left: -10px"><input type="text" id="datetimepicker" style="width: 145"  autocomplete="off" class="input"> &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerend2" style="width: 145"  autocomplete="off" class="input">
                                </div>
                            </div>
                        </div>
                        </div><br>
                        <div id="buttonSend" style="display: none">
                            <div align="center" >
                                <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh" onclick="sendSubmitListMSG();">ส่งคำสั่ง</button>
                            </div>
                        </div>
                        </div>
                    <div id="vmsBannerManual" style="display: none; margin-top: 10">
                        <div class="row">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">ป้าย VMS
                            </div>
                            <div class="col-sm-4" style="margin-left: -30;">
                                <select id="vmsManual" name="vmsManual" style="width: 300; height: 37" class="input" onchange="vmsManuralNextstep()">
                                    <option value="" selected="selected">เลือกป้าย VMS</option>

                                    <?php
                                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVVmsCode']; ?>"><?php echo $result['XVVmsName']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        <div id="vmsSizeManualDiv" style="display: none">
                        <div class="row" style="margin-top: 10px">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">ขนาดป้าย
                            </div>
                            <div class="col-sm-4" style="margin-left: -30;">
                                <select id="vmsSize" name="vmsSize" style="width: 300; height: 37" class="input" onchange="vmsSizeManuralNextstep()">
                                    <option value="" selected="selected">เลือกขนาดป้าย VMS</option>

                                    <?php
                                    $stmt = "SELECT * FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVMssCode']; ?>"><?php echo $result['XVMssName']; ?></option>
                                    <?php }?>
                                </select>
                            </div>
                        </div>
                        </div>
                        <div id="actionManualDiv" style="display: none">
                        <div class="row" style="margin-top: 0">
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-2" style="margin-top: 5px">การทำงาน
                            </div>
                            <div class="col-sm-7" style="margin-left: -30;">
                                <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox" class="messageCheckboxManual" id="messageCheckboxManual" name="messageCheckboxManual" value="1" onclick="activityWorkManual(1)"> กำหนดช่วงสิ้นสุด
                                </div>
                            </div>
                        </div>
                        </div>
                        <div id="timerManual" style="display: none">
                            <div class="row" style="margin-top: 0">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-2" style="margin-top: 5px">ระยะเวลา
                                </div>
                                <div class="col-sm-7" style="margin-left: -30;">
                                    <div class="col-sm-3" style="margin-top: 10px;margin-left: -10px"><input id="inputTimerManual" class="input" style="width: 40px;text-align: center;" type="text" name="inputTimer" autocomplete="off" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); timerManualNextStep();" /> วินาที</div>
                                </div>
                            </div>
                        </div>
                        <div id="showDateManual" style="display: none">
                            <div class="row" style="margin-top: 10">
                                <div class="col-sm-3">
                                </div>
                                <div class="col-sm-2" style="margin-top: 5px">วันที่เริ่ม
                                </div>
                                <div class="col-sm-7" style="margin-left: -20;">
                                    <div class="col-sm-" style="margin-top: 0px;margin-left: -10px"><input type="text" id="datetimepicker3" style="width: 145"  autocomplete="off" class="input"> &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerend3" style="width: 145"  autocomplete="off" class="input">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div id="buttonManualSend" style="display: none">
                            <div align="center" >
                                <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh" onclick="sendSubmitNextStep();">ส่งคำสั่ง</button>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
                <div>
                </div>
                <br >
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables.js"></script>
<script src="dist/js/dataTables.bootstrap4.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script>
    function deleteMSG(MSGCode,XVVmsCode){
        $.ajax({
            type: "POST",
            url: "lib/delMSG.php",
            data: {'msgCODE': MSGCode,'XVVmsCode':XVVmsCode},
            success: function(result) {
               document.getElementById( 'myDiv'+MSGCode+XVVmsCode ).style.display = 'none';
            }
        });
    }
    // Basic example
    $(document).ready(function () {

        new DataTable('#UserTable');
        new DataTable('#VMSTable');
    });
    function processSeqNo(a,b,c){
        console.log(a);

        $.ajax({
            type: "POST",
            url: "lib/processSeqNo.php",
            data: {'XVVmsCode':c,'typeSeqNo':b,'XVMsgCode':a},
            success: function(result) {

                window.location.href = 'Schedulemessage.php';
            }
        });
    }
    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModal').modal('show');
        return false;
    }
    function vmsListNextstep(){
        document.getElementById('listMessageDiv').style.display = "block";
    }
    function vmsMSGNextStep(){
        document.getElementById('actionListlDiv').style.display = "block";
        document.getElementById('timer').style.display = "block";
    }
    function timerListNextStep(){
        document.getElementById('buttonSend').style.display = "block";
    }
    function vmsManuralNextstep(){
        document.getElementById('vmsSizeManualDiv').style.display = "block";
    }
    function vmsSizeManuralNextstep(){
        document.getElementById('actionManualDiv').style.display = "block";
        document.getElementById('timerManual').style.display = "block";
    }
    function timerManualNextStep(){
        document.getElementById('buttonManualSend').style.display = "block";
    }
    function processListMessage(){
        let messageListModalRadio = document.getElementById("messageListModalRadio");
        messageListModalRadio.checked = false;
        document.getElementById('vmsBanner').style.display = "none";
       document.getElementById("messageAutoRadio").checked = false;
       document.getElementById('inputTimer').value='';
       document.getElementById('datetimepicker').value='';
       $("#vmsMSG").val($("#vmsMSG").data("default-value"));
       $("#vms").val($("#vms").data("default-value"));
        document.getElementById('showDate').style.display = "none";

        document.getElementById("messageListModalRadio").checked = false;
        document.getElementById("messageManualModalRadio").checked = false;
        $("#vmsManual").val($("#vmsManual").data("default-value"));
        $("#vmsSize").val($("#vmsSize").data("default-value"));
        document.getElementById("messageCheckboxManual").checked = false;
        document.getElementById('inputTimerManual').value='';
        document.getElementById('vmsBannerManual').style.display = "none";


    }
  function messageListValue(e){
      if(e==1){
          document.getElementById('vmsBanner').style.display = "block";
          document.getElementById('vmsBannerManual').style.display = "none";
          document.getElementById('showDateManual').style.display = "none";
          $("#vmsManual").val($("#vmsManual").data("default-value"));
          $("#vmsSize").val($("#vmsSize").data("default-value"));
          document.getElementById("messageCheckboxManual").checked = false;
          document.getElementById('inputTimerManual').value='';
          document.getElementById('datetimepicker3').value='';
          document.getElementById('datetimepickerend3').value='';

          document.getElementById('vmsSizeManualDiv').style.display = "none";
          document.getElementById('actionManualDiv').style.display = "none";
          document.getElementById('timerManual').style.display = "none";
          document.getElementById('buttonManualSend').style.display = "none";
      }else{
          document.getElementById('vmsBannerManual').style.display = "block";
          document.getElementById('vmsBanner').style.display = "none";
          document.getElementById("messageAutoRadio").checked = false;
          document.getElementById('inputTimer').value='';
          document.getElementById('datetimepicker').value='';
          document.getElementById('datetimepickerend2').value='';
          $("#vmsMSG").val($("#vmsMSG").data("default-value"));
          $("#vms").val($("#vms").data("default-value"));
          document.getElementById('showDate').style.display = "none";

          document.getElementById('listMessageDiv').style.display = "none";
          document.getElementById('actionListlDiv').style.display = "none";
          document.getElementById('timer').style.display = "none";

      }
  }

  function activityWorkManual(e){
     var messageCheckboxManual = $('.messageCheckboxManual:checked').val();
      if(messageCheckboxManual==1){
          document.getElementById('showDateManual').style.display = "block";
      }else{
          document.getElementById('showDateManual').style.display = "none";
          document.getElementById('datetimepicker3').value='';
          document.getElementById('datetimepickerend3').value='';
      }
  }
  function activityWork(e){
     var checkedValue = $('.messageCheckbox:checked').val();
      if(checkedValue==1){
          document.getElementById('showDate').style.display = "block";
      }else{
          document.getElementById('showDate').style.display = "none";
          document.getElementById('datetimepicker').value='';
          document.getElementById('datetimepickerend2').value='';
      }
  }
    function sendSubmitNextStep(){
        var vmsManual=document.getElementById('vmsManual').value;
        var vmsSize=document.getElementById('vmsSize').value;
        var messageCheckboxManual = $('.messageCheckboxManual:checked').val();
        var inputTimerManual=document.getElementById('inputTimerManual').value;
        var datetimepicker3=document.getElementById('datetimepicker3').value;
        var datetimepickerend3=document.getElementById('datetimepickerend3').value;
        window.location.href = 'addMessager.php?vms='+vmsManual+'&vmsSize='+vmsSize+'&messageCheckboxManual='+messageCheckboxManual+'&inputTimerManual='+inputTimerManual+'&datestart='+datetimepicker3+'&dateend='+datetimepickerend3;
    }
  function sendSubmitListMSG(){
      var vms=document.getElementById('vms').value;
      var vmsMSG=document.getElementById('vmsMSG').value;
      var checkedValue = $('.messageCheckbox:checked').val();
      var inputTimer=document.getElementById('inputTimer').value;
      if(inputTimer!=''){

      if(checkedValue==1){
          var datetimepicker=document.getElementById('datetimepicker').value;
          var datetimepickerend2=document.getElementById('datetimepickerend2').value;
          if(datetimepicker !='' && datetimepickerend2 != ''){
              $.ajax({
                  type: "POST",
                  url: "lib/processScheduleMSG.php",
                  data: {'vms':vms,'vmsMSG':vmsMSG,'checkedValue':checkedValue,'inputTimer':inputTimer,'datetimepicker':datetimepicker,'datetimepickerend2':datetimepickerend2 },
                  success: function(result) {
                      window.location.href = 'Schedulemessage.php';
                  }
              });
          }else if(datetimepicker =='' && datetimepickerend2 != ''){
              alert("กรุณาวันที่เริ่มต้น");
          }else if(datetimepicker !='' && datetimepickerend2 == ''){
              alert("กรุณาวันที่สิ้นสุด");
          }else if(datetimepicker =='' && datetimepickerend2 == ''){
              alert("กรุณาวันที่เริ่มต้นและสิ้นสุด");
          }

      }else{
          $.ajax({
              type: "POST",
              url: "lib/processScheduleMSG.php",
              data: {'vms':vms,'vmsMSG':vmsMSG,'checkedValue':checkedValue,'inputTimer':inputTimer },
              success: function(result) {
                  window.location.href = 'Schedulemessage.php';
              }
          });
      }
      }else{
          alert("กรุณาใส่ระยะเวลา");
      }
  }
</script>
</body>
</html>
