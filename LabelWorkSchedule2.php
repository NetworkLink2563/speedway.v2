<?php
include 'header.php';
include "lib/DatabaseManage.php";
?>
<style>
    a.main-nav-item:link {
        color: #595959 !important;
    }
    a.main-nav-item:visited {
        color: #595959 !important;
    }
    a.main-nav-item:hover {
        color: #ffae00 !important;
    }
    a.main-nav-item:focus {
        color: #ffae00 !important;
    }
    a.main-nav-item:active {
        color: #595959 !important;
    }

</style>
<div class="centered" style="margin-top: 50;margin-left: 10;">

<div class="box" style="margin-top: 30;" align="left">
    <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
        <div class="row">
            <div class="col-sm-6">
                <div style="margin-top: 10;"><img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;ตารางการทำงานของป้าย</div>
            </div>
        </div>
        <div style="margin-top:-5;"><hr></div>

    </div>
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <button class="tablinks2 active" onclick="openCity2(event, '416160')">รายการ VMS</button>
    </div>
    <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;" id="container">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6" >
                <table class="table" style="font-size: 10pt">
                    <thead>
                    <tr>
                        <th width="78" scope="col">รหัสป้าย</th>
                        <th width="80" scope="col">ชื่อป้าย</th>
                        <th width="150" scope="col"><div align="center">คำสั่งที่ส่ง</div></th>
                        <th width="50" scope="col"><div align="center">รายการ</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC
";
                    $query = sqlsrv_query($conn, $stmt);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                    {
                    ?>
                    <tr>
                        <td><?php echo $result['XVVmsCode'];?></td>
                        <td><?php echo $result['XVVmsName'];?></td>
                        <td>
                            <div align="center" class="menu">
                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalOpen" style=" height: 35; color: #595959" onclick="inputBrightnessValue('<?php echo $result['XVVmsCode'];?>')" title="ความสว่างการแสดงผล"><i class="fa fa-yelp fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalOpen" style=" height: 35; color: #595959" onclick="inputSignElectricalSystemValue('69+380L')" title="ระบบไฟฟ้าป้าย"><i class="fa fa-lightbulb-o fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;
                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalOpen" style=" height: 35; color: #595959" onclick="inputDisplayValue('69+380L',3)" title="การแสดงผล"><i class="fa fa-object-group fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;
                            </div></td>
                        <td><div align="center">1</div></td>
                    </tr>
                    <?php }?>

                    </tbody>
                </table>
            </div>
            <div class="col-sm-3">
            </div>

        </div>
    </div>

    <br >
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" > &nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> รายการ</div>
    </div>
    <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-5">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">วันที่ทำงาน</th>
                        <th scope="col">ป้าย</th>
                        <th scope="col">เวลา</th>
                        <th scope="col">คำสั่ง</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380L</td>
                        <td>Mon 10:00</td>
                        <td></td>
                        <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+381L</td>
                        <td>Tue 05:00</td>
                        <td>ไฟกระพริบ</td>
                        <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    <tr>
                        <th scope="row"><input type="checkbox" name="checkbox" value="checkbox" /></th>
                        <td>69+380R</td>
                        <td>Fri 10:00</td>
                        <td></td>
                        <td><i class="fa fa-trash-o" aria-hidden="true"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-4">
            </div>

        </div>
    </div>
    <br >

    <div align="center">
        <button type="button" class="btn btn-primary">ส่งคำสั่ง</button>
    </div>
    <br >

</div>
</div>
<div class="modal" id="myModalOpen" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">ความสว่างการแสดงผล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <input id="bannerID" class="input" style="width: 40px;text-align: center;" type="text" name="textfield" value="">
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tablinksCommand" name="firstactive" class="tablinks active" onclick="openActivityBrightness(event, 'BrightnessValue')">ค่าความสว่าง</button>
                    <button id="tabMessage" name="firstactive" class="tablinks active" onclick="openActivityMessage(event, 'MessageValue')">แสดงข้อความ</button>
                    <button id="tablinksSignElectricalSystem" name="firstactive" class="tablinks active" onclick="openActivitySignElectrical(event, 'SignElectrical')">จัดการไฟฟ้าป้าย</button>
                    <button id="tablinksDisplay" name="firstactive" class="tablinks active" onclick="openActivitySignElectrical(event, 'Display')">จัดการการแสดงผล</button>
                    <div id="tablinksElectricalSystemNoneLink" style="display: block;"><button id="tablinksElectricalSystem" class="tablinks" >รายการข้อความ</button></div>
                    <div id="tablinksElectricalSystemLink" style="display: none;"><button id="tablinksElectricalSystem" class="tablinks" onclick="openActivityBrightness(event, 'messageListValue')">รายการข้อความ</button></div>
                    <div id="tablinksDateTimeNonLink" style="display: block;"><button id="tablinksDateTime" class="tablinks" >วันที่/เวลา</button></div>
                    <div id="tablinksDateTimeLink" style="display: none;"><button id="tablinksDateTime" class="tablinks" onclick="openActivityDateTime(event, 'dateTimeValue')">วันที่/เวลา</button></div>
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
                    <div id="MessageValueAuto" style="display: none">
                        <div class="row" >
                            <div class="col-sm-3">
                            </div>
                            <div class="col-sm-5" style="margin-top: 20px"><select id="productselection" name="cars" id="cars" style="width: 300; height: 37">
                                    <?php
                                    $stmt = "SELECT * FROM TMstMMessage ORDER BY XVMsgOrder ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                    ?>
                                        <option value="<?php echo $result['XVMsgCode']; ?>"><?php echo $result['XVMsgName']; ?></option>

<?php }?>

                                </select>
                            </div>
                            <div class="col-sm-4"></div>
                        </div>
                    </div>
                </div>
                <div id="BrightnessValue" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="brightnessAutoModalRadio" name="radiobuttonBrightness" type="radio" value="1"  onclick="displayRadioValue(1)"/> Auto
                        </div>
                        <div class="col-sm-3"><input id="brightnessManualModalRadio" name="radiobuttonBrightness" type="radio" value="2" onclick="displayRadioValue(2)"/><label> &nbsp;Manual</label>  <input  class="input" id="inputBrightnessValueModal" style="width: 40px;text-align:center;" type="text" name="textfield" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" disabled />  (0-100)
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="SignElectrical" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3"><input id="SignElectricalOnRadio" name="SignElectricalRadio" type="radio" value="1"  onclick="SignElectricalRadioValue(1)"/> On
                        </div>
                        <div class="col-sm-3"><input id="SignElectricalOffRadio" name="SignElectricalRadio" type="radio" value="1"  onclick="SignElectricalRadioValue(2)"/> Off
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="Display" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3"><input id="DisplayOnRadio" name="SignElectricalRadio" type="radio" value="1"  onclick="DisplayRadioValue(1)"/> On
                        </div>
                        <div class="col-sm-3"><input id="DisplayOffRadio" name="SignElectricalRadio" type="radio" value="1"  onclick="DisplayRadioValue(2)"/> Off
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="messageListValuess" class="tabcontent" style="margin-left: 10px;margin-right: 55px;">
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" ><input id="radioMessageListAutoRadio" name="radioMessageList" type="radio" value="1" onclick="checkMessageList(1)"/> จากรายการข้อความ
                        </div>
                        <div class="col-sm-3"><input id="radioMessageListManualRadio" name="radioMessageList" type="radio" value="2" onclick="checkMessageList(2)"/> เขียนข้อความเอง
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                    <div id="MessageListAuto" style="display: none">
                    <div class="row" >
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-5" style="margin-top: 20px">
                            <select id="productselection" name="cars" id="cars" style="width: 300; height: 37">
                                <option value="" selected="selected">ไม่เลือกข้อความ</option>
                                <option value="product_1">รถติดถนนลื่น!!</option>
                                <option value="product_2">ระวัง!! อย่าขับรถเร็ว</option>
                                <option value="product_3">ความเร็วจำกัดที่ 80 กม./ชม.</option>
                            </select>
                        </div>
                        <div class="col-sm-4"></div>
                    </div>
                    </div>
                    <div id="MessageListManual" style="display: none">
                        <div class="row">
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-8"><textarea id="editor1">
	</textarea></div>

                        </div>
                    </div>
                </div>
                <div id="dateTimeValue" class="tabcontent" style="margin-left: 10px;margin-right: 55px;">
                    <div class="row" style="margin-top: 5">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-2">เวลาดำเนินการ
                        </div><div class="col-sm-3">
                            <input type="text" id="datetimepicker" name="datetimepicker" style="width: 80; text-align: center" readonly autocomplete="off" class="datetimepicker input" onchange="checkTimeValue(1);">
                        </div>
                    </div>
                    <div id="divDateContent" style="display:none;">
                        <div   class="row" >
                            <div class="col-sm-2">
                            </div>
                            <div class="col-sm-2">วันที่ดำเนินการ
                            </div>
                            <div class="col-sm-6" style="margin-top:7px">
                                <table width="101%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td><input id="checkboxMon" type="checkbox" name="checkbox" value="checkbox" onclick="checkDateValue(2);"/>
                                            Mon</td>
                                        <td><input id="checkboxTue" type="checkbox" name="checkbox2" value="checkbox" onclick="checkDateValue(2);"/>
                                            Tue</td>
                                        <td><input id="checkboxWed" type="checkbox" name="checkbox3" value="checkbox" onclick="checkDateValue(2);"/>
                                            Wed</td>
                                        <td><input id="checkboxThu" type="checkbox" name="checkbox4" value="checkbox" onclick="checkDateValue(2);"/>
                                            Thu</td>
                                        <td><input id="checkboxFri" type="checkbox" name="checkbox5" value="checkbox" onclick="checkDateValue(2);"/>
                                            Fri</td>
                                        <td><input id="checkboxSat" type="checkbox" name="checkbox6" value="checkbox" onclick="checkDateValue(2);"/>
                                            Sat</td>
                                        <td><input id="checkboxSun" type="checkbox" name="checkbox7" value="checkbox" onclick="checkDateValue(2);"/>
                                            Sun</td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                </div>
                <br >
                <div id="buttonSend" style="display: none">
                <div align="center" >
                    <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh" onclick="checkSendButton();">ส่งคำสั่ง</button>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModalSignElectricalSystem" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">ความสว่างการแสดงผล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <input id="bannerID" class="input" style="width: 40px;text-align: center;" type="hidden" name="textfield" value="">
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tablinksCommand" name="firstactive" class="tablinks active" onclick="openCity(event, 'BrightnessValue')">ค่าความสว่าง</button>
                    <button id="tablinksElectricalSystem" class="tablinks" onclick="openCity(event, 'ElectricalSystem')">ระบบไฟฟ้า</button>
                    <button id="tablinksControlCabinetFan" class="tablinks" onclick="openCity(event, 'ControlCabinetFan')">พัดลมตู้ควบคุม</button>
                    <button id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'FlashingLights')">ไฟกระพริบ</button>
                    <button id="tablinksBrightness" class="tablinks" onclick="openCity(event, 'Brightness')">ความสว่าง</button>
                </div>
                <div id="BrightnessValue" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input name="radiobutton" type="radio" value="1"  onclick="displayRadioValue(1)"/> Auto
                        </div>
                        <div class="col-sm-3"><input id="brightnessManualModal" name="radiobutton" type="radio" value="2" onclick="displayRadioValue(2)"/><label> &nbsp;Manual</label>  <input  class="input" id="inputBrightnessValueModal" style="width: 40px;text-align:center;" type="text" name="textfield" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" disabled />  (0-100)
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <br >
                <div align="center" style="display: none">
                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh">ส่งคำสั่ง</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript"
        src="https://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
</script>
<script type="text/javascript"
        src="https://tarruda.github.io/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
</script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="dist/js/ck.js"></script>
<script>
    function checkSendButton(){
        var element = document.getElementById("tablinksCommand");
        element.classList.add("active");
        document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'block';
        document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'none';
        document.getElementById( 'tablinksDateTimeNonLink' ).style.display = 'block';
        document.getElementById( 'tablinksDateTimeLink' ).style.display = 'none';
        document.getElementById( 'buttonSend' ).style.display = 'none';
        document.getElementById( 'productselection' ).style.display = 'none';
        document.getElementById("datetimepicker").value='';
        document.getElementById( 'divDateContent' ).style.display = 'none';

        var elementBrightnessValue = document.getElementById("BrightnessValue");
        elementBrightnessValue.style.display = "block";
        var elementMessageListManual = document.getElementById("MessageListManual");
        elementMessageListManual.style.display = "none";
        var elementdateTimeValue = document.getElementById("dateTimeValue");
        elementdateTimeValue.style.display = "none";

        let brightnessAutoModalRadio = document.getElementById("brightnessAutoModalRadio");
        brightnessAutoModalRadio.checked = false;
        let brightnessManualModalRadio = document.getElementById("brightnessManualModalRadio");
        brightnessManualModalRadio.checked = false;
        let radioMessageListAutoRadio = document.getElementById("radioMessageListAutoRadio");
        radioMessageListAutoRadio.checked = false;
        let radioMessageListManualRadio = document.getElementById("radioMessageListManualRadio");
        radioMessageListManualRadio.checked = false;
        let SignElectricalOnRadio = document.getElementById("SignElectricalOnRadio");
        SignElectricalOnRadio.checked = false;
        let SignElectricalOffRadio = document.getElementById("SignElectricalOffRadio");
        SignElectricalOffRadio.checked = false;
        let DisplayOnRadio = document.getElementById("DisplayOnRadio");
        DisplayOnRadio.checked = false;
        let DisplayOffRadio = document.getElementById("DisplayOffRadio");
        DisplayOffRadio.checked = false;
        CKEDITOR.instances.editor1.setData('');
        $('#productselection option').prop('selected', function() {
            return this.defaultSelected;
        });

        document.getElementById("checkboxMon").checked = false;
        document.getElementById("checkboxTue").checked = false;
        document.getElementById("checkboxWed").checked = false;
        document.getElementById("checkboxThu").checked = false;
        document.getElementById("checkboxFri").checked = false;
        document.getElementById("checkboxSat").checked = false;
        document.getElementById("checkboxSun").checked = false;


    }
    function checkTimeValue(e){
        document.getElementById( 'divDateContent' ).style.display = 'block';
        return 1;
    }
    function checkDateValue(e){
        var sumvalue=checkTimeValue()+e
        if(sumvalue==3){
            document.getElementById( 'buttonSend' ).style.display = 'block';
        }else{
            document.getElementById( 'buttonSend' ).style.display = 'none';
        }

    }
    function messageListValue(e){
        var MessageValueAuto = document.getElementById("MessageValueAuto");
        var MessageValueManual = document.getElementById("MessageValueManual");
        if(e==1){
            document.getElementById( 'tablinksDateTimeLink' ).style.display = 'block';
            document.getElementById( 'tablinksDateTimeNonLink' ).style.display = 'none';
            document.getElementById("inputBrightnessValueModal").disabled = true;
            document.getElementById("inputBrightnessValueModal").value ='';
            MessageValueAuto.style.display = "block";
            //MessageValueManual.style.display = "none";
            CKEDITOR.instances.editor1.setData('');
        }else{
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'none';
            document.getElementById("inputBrightnessValueModal").disabled = false;
            MessageValueAuto.style.display = "none";
            //MessageValueManual.style.display = "block";
            CKEDITOR.instances.editor1.setData('');
        }
    }
    function SignElectricalRadioValue(e){
        if(e==1){
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = true;
            document.getElementById("inputBrightnessValueModal").value ='';
        }else{
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = false;
        }
    }
    function DisplayRadioValue(e){
        if(e==1){
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = true;
            document.getElementById("inputBrightnessValueModal").value ='';
        }else{
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = false;
        }
    }
    function inputMessageValue(bannerID){
        document.getElementById("bannerID").value=bannerID;
        document.getElementById( 'tabMessage' ).style.display = 'block';
        document.getElementById( 'MessageValue' ).style.display = 'block';
        document.getElementById( 'tablinksCommand' ).style.display = 'none';
        document.getElementById( 'BrightnessValue' ).style.display = 'none';
        document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
        document.getElementById( 'tablinksSignElectricalSystem' ).style.display = 'none';
        document.getElementById( 'SignElectrical' ).style.display = 'none';
        document.getElementById( 'tablinksDisplay' ).style.display = 'none';
        document.getElementById( 'Display' ).style.display = 'none';


    }
    function inputBrightnessValue(bannerID){
        document.getElementById("bannerID").value=bannerID;
        document.getElementById( 'tablinksCommand' ).style.display = 'block';
        document.getElementById( 'BrightnessValue' ).style.display = 'block';
        document.getElementById( 'tabMessage' ).style.display = 'none';
        document.getElementById( 'MessageValue' ).style.display = 'none';
        document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'block';
        document.getElementById( 'tablinksSignElectricalSystem' ).style.display = 'none';
        document.getElementById( 'SignElectrical' ).style.display = 'none';
        document.getElementById( 'tablinksDisplay' ).style.display = 'none';
        document.getElementById( 'Display' ).style.display = 'none';


    }
    function inputElectricalValue(bannerID){
        document.getElementById("bannerID").value=bannerID;
        document.getElementById( 'tablinksCommand' ).style.display = 'none';
        document.getElementById( 'tablinksSignElectricalSystem' ).style.display = 'block';
        document.getElementById( 'BrightnessValue' ).style.display = 'none';
        document.getElementById( 'SignElectrical' ).style.display = 'block';
        document.getElementById( 'tablinksDisplay' ).style.display = 'none';
        document.getElementById( 'Display' ).style.display = 'none';


        var elementtablinksSignElectricalSystem = document.getElementById("tablinksSignElectricalSystem");
        elementtablinksSignElectricalSystem.classList.add("active");

    }
    function inputDisplayValue(bannerID){
        document.getElementById("bannerID").value=bannerID;
        document.getElementById( 'tablinksCommand' ).style.display = 'none';
        document.getElementById( 'tablinksSignElectricalSystem' ).style.display = 'none';
        document.getElementById( 'BrightnessValue' ).style.display = 'none';
        document.getElementById( 'SignElectrical' ).style.display = 'none';
        document.getElementById( 'tablinksDisplay' ).style.display = 'block';
        document.getElementById( 'Display' ).style.display = 'block';


        var elementtablinksDisplay = document.getElementById("tablinksDisplay");
        elementtablinksDisplay.classList.add("active");

    }

    function displayRadioValue(e) {
        if(e==1){
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = true;
            document.getElementById("inputBrightnessValueModal").value ='';
        }else{
            document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
            document.getElementById( 'tablinksElectricalSystemLink' ).style.display = 'block';
            document.getElementById("inputBrightnessValueModal").disabled = false;
        }

    }
    document.getElementById('inputBrightnessValueModal').addEventListener('input', event => {
        const input = event.target.value;
        if(input > 100){
            document.getElementById("inputBrightnessValueModal").value ='';
        }else{
            document.getElementById("brightnessManualModal").checked = true;
            document.getElementById("brightnessShow").checked = true;

            document.getElementById("brightnessManualModal").checked = true;
        }
    });

    function radioActionAuto(){
        document.getElementById("inputBrightnessManual").value ='';
        document.getElementById("brightnessShow").checked = true;

    }
    function radioActionManual(){
        document.getElementById("brightnessShow").checked = true;

    }

    function onClickradioOff(){
        document.getElementById("inputBrightnessManual").value ='';
        document.getElementById("brightnessAuto").checked = false;
        document.getElementById("brightnessManual").checked = false;

    }
    function onClickradioOn(){
        document.getElementById("inputBrightnessManual").value ='';
        document.getElementById("brightnessAuto").checked = true;

    }
    function openActivityMessage(evt, activityName) {
        document.getElementById( 'tablinksElectricalSystemNoneLink' ).style.display = 'none';
        var i, tabcontent,tabcontentmessageList, tablinks;
        //var tabcontentmessageList = document.getElementsByClassName("tabcontentmessageList");

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(activityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    function openActivityBrightness(evt, activityName) {
        var i, tabcontent,tabcontentmessageList, tablinks;
        //var tabcontentmessageList = document.getElementsByClassName("tabcontentmessageList");

        if(activityName=='messageListValue'){
            var myRadio=$("input[type='radio'][name='radiobuttonBrightness']:checked").val();
            if(myRadio==1 || myRadio==2){

            }
        }
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(activityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function openActivityDateTime(evt, activityName) {
        var i, tabcontent,tabcontentmessageList, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(activityName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    function openActivitySignElectrical(evt, activityName) {
        var i, tabcontent,tabcontentmessageList, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(activityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function openCity2(evt, cityName) {
        var i, tabcontent2, tablinks2;
        tabcontent = document.getElementsByClassName("tabcontent2");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks2");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    function toggle(source) {
        var checkboxes = document.querySelectorAll('input[type="checkbox"]');
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i] != source)
                checkboxes[i].checked = source.checked;
        }
    }
    function checkMessageList(valuer) {
        var MessageListAuto = document.getElementById("MessageListAuto");
        var MessageListManual = document.getElementById("MessageListManual");

        if(valuer==1){
            document.getElementById( 'productselection' ).style.display = 'block';
            MessageListAuto.style.display = "block";
            MessageListManual.style.display = "none";
            CKEDITOR.instances.editor1.setData('');

        }else{
            MessageListAuto.style.display = "none";
            MessageListManual.style.display = "block";
            CKEDITOR.instances.editor1.setData('');

        }

        if(valuer==1){
            document.getElementById( 'tablinksDateTimeNonLink' ).style.display = 'none';
            document.getElementById( 'tablinksDateTimeLink' ).style.display = 'block';
        }else{
            document.getElementById( 'tablinksDateTimeNonLink' ).style.display = 'none';
            document.getElementById( 'tablinksDateTimeLink' ).style.display = 'block';
        }

    }
</script>
<script type="text/javascript">
    $(function() {
        $("#datetimepicker").datetimepicker({
            dateFormat: '',
            datepicker:false,
            pickDate: false,
            format: "H:i",
            timeOnly:true
        });
    });
</script>
</body>
</html>
