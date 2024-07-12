<?php
include 'header.php';
?>

<div class="centered" style="margin-top: 60;margin-left: 10;">

<div class="box" style="margin-top: 30;" align="left">
    <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
        <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;การควบคุมป้าย
        <div style="margin-top:-5;"><hr></div>
    </div>
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <button class="tablinks2 active" onclick="openCity2(event, '416160')">สีจริง 416x160</button>
    </div>
    <div id="416160" class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;" id="container">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6" >
                <table class="table">
                    <thead>
                    <tr>
                        <th width="78" scope="col">รหัสป้าย</th>
                        <th width="96" scope="col">ชื่อป้าย</th>
                        <th width="50" scope="col"><div align="center">Op</div></th>
                        <th width="250" scope="col">คำสั่งที่ส่ง</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>69+380L</td>
                        <td>VMS กม.1</td>
                        <td><div align="center" style="margin-top: 5">
                                <a href="#" data-toggle="modal" data-target="#myModal" style="height: 35; color: #333" onclick="inputValueId(1)" ><i class="fa fa-cog" aria-hidden="true"></i></a>
                            </div></td>
                        <td><div id="valueSetting1"></div></td>
                    </tr>
                    <tr>
                        <td>69+381L</td>
                        <td>VMS ทดสอบ </td>
                        <td><div align="center" style="margin-top: 5">
                                <a href="#" data-toggle="modal" data-target="#myModal" style="height: 35; color: #333" onclick="inputValueId(2)"><i class="fa fa-cog" aria-hidden="true"></i></a>

                            </div></td>
                        <td><div id="valueSetting2"></div></td>
                    </tr>
                    <tr>
                        <td>69+380R</td>
                        <td>ป้ายไฟพัทยา</td>
                        <td><div align="center" style="margin-top: 5">
                                <a href="#" data-toggle="modal" data-target="#myModal" style="height: 35; color: #333" onclick="inputValueId(3)"><i class="fa fa-cog" aria-hidden="true"></i></a>

                            </div></td>
                        <td><div id="valueSetting3"></div></td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-sm-3">
            </div>

        </div>
    </div>
    <br >
</div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">Setting</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <input id="bannerID" class="input" style="width: 40px;text-align: center;" type="text" name="textfield" value="">
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tablinksCommand" name="firstactive" class="tablinks active" onclick="openCity(event, 'Command')">คำสั่ง</button>
                    <button id="tablinksElectricalSystem" class="tablinks" onclick="openCity(event, 'ElectricalSystem')">ระบบไฟฟ้า</button>
                    <button id="tablinksControlCabinetFan" class="tablinks" onclick="openCity(event, 'ControlCabinetFan')">พัดลมตู้ควบคุม</button>
                    <button id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'FlashingLights')">ไฟกระพริบ</button>
                    <button id="tablinksBrightness" class="tablinks" onclick="openCity(event, 'Brightness')">ความสว่าง</button>
                </div>
                <div id="Command" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row"style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4"><input id="testConnectRadio" name="radiobutton" type="radio" value="1"/> ทดสอบการติดต่อป้าย
                        </div>
                        <div class="col-sm-4"><input id="changeTimeRadio" name="radiobutton" type="radio" value="2" /> ปรับเวลาจากศูนย์ควบคุม
                        </div>
                        <div class="col-sm-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4"><input id="resetRadio" name="radiobutton" type="radio" value="3" /> Restart เครื่องควบคุมป้าย
                        </div>
                        <div class="col-sm-4"><input id="hddRadio" name="radiobutton" type="radio" value="4" /> สอบถามพื้นที่ของฮาร์ดดีส
                        </div>
                        <div class="col-sm-2">
                        </div>
                    </div>
                </div>
                <div id="ElectricalSystem" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
                    <div class="row" style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3"><input id="electricalOnRadio" name="radiobutton" type="radio" value="5" /> เปิด
                        </div>
                        <div class="col-sm-3"><input id="electricalOffRadio" name="radiobutton" type="radio" value="6" /> ปิด
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="ControlCabinetFan" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
                    <div class="row" style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3"><input id="controlcabinetFanOnRadio" name="radiobutton" type="radio" value="7" /> เปิด
                        </div>
                        <div class="col-sm-3"><input id="controlcabinetFanOffRadio" name="radiobutton" type="radio" value="8" /> ปิด
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="FlashingLights" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
                    <div class="row" style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" ><input id="flashingOnRadio" name="radiobutton" type="radio" value="9" /> เปิด
                        </div>
                        <div class="col-sm-3"><input id="flashingOffRadio" name="radiobutton" type="radio" value="10" /> ปิด
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="Brightness" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="brightnessAutoRadio" name="radiobutton" type="radio" value="11"  onclick="displayRadioValue()"/> Auto
                        </div>
                        <div class="col-sm-3"><input id="brightnessManual" name="radiobutton" type="radio" value="12" onclick="displayRadioValue()"/><label> &nbsp;Manual</label>  <input  class="input" id="inputBrightnessManual" style="width: 40px;text-align:center;" type="text" name="textfield" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" disabled />  (0-100)
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <br >
                <div align="center" >
                    <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh">ส่งคำสั่ง</button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.min.js" ></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<script>

    function inputValueId(b){
        document.getElementById("bannerID").value=b;
        $('#tablinksElectricalSystem').removeClass('active');
        $('#tablinksControlCabinetFan').removeClass('active');
        $('#tablinksFlashingLights').removeClass('active');
        $('#tablinksBrightness').removeClass('active');

        var element = document.getElementById("tablinksCommand");
        element.classList.add("active");
        var elementContentCommand = document.getElementById("Command");
        var elementContentElectricalSystem = document.getElementById("ElectricalSystem");
        var elementContentControlCabinetFan = document.getElementById("ControlCabinetFan");
        var elementContentControlFlashingLights = document.getElementById("FlashingLights");
        var elementContentControlBrightness = document.getElementById("Brightness");


        elementContentElectricalSystem.style.display = "none";
        elementContentControlCabinetFan.style.display = "none";
        elementContentControlFlashingLights.style.display = "none";
        elementContentControlBrightness.style.display = "none";

        let testConnectRadio = document.getElementById("testConnectRadio");
        testConnectRadio.checked = false;
        let changeTimeRadio = document.getElementById("changeTimeRadio");
        changeTimeRadio.checked = false;
        let resetRadio = document.getElementById("resetRadio");
        resetRadio.checked = false;
        let hddRadio = document.getElementById("hddRadio");
        hddRadio.checked = false;
        let electricalOnRadio = document.getElementById("electricalOnRadio");
        electricalOnRadio.checked = false;
        let electricalOffRadio = document.getElementById("electricalOffRadio");
        electricalOffRadio.checked = false;
        let controlcabinetFanOnRadio = document.getElementById("controlcabinetFanOnRadio");
        controlcabinetFanOnRadio.checked = false;
        let controlcabinetFanOffRadio = document.getElementById("controlcabinetFanOffRadio");
        controlcabinetFanOffRadio.checked = false;
        let flashingOnRadio = document.getElementById("flashingOnRadio");
        flashingOnRadio.checked = false;
        let flashingOffRadio = document.getElementById("flashingOffRadio");
        flashingOffRadio.checked = false;
        let brightnessAutoRadio = document.getElementById("brightnessAutoRadio");
        brightnessAutoRadio.checked = false;
        let brightnessManual = document.getElementById("brightnessManual");
        brightnessManual.checked = false;

        document.getElementById("inputBrightnessManual").value ='';
        document.getElementById("inputBrightnessManual").disabled = true;

    }
    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModal').modal('show');
        return false;
    }

    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            $('#tablinksElectricalSystem').removeClass('active');
            $('#tablinksControlCabinetFan').removeClass('active');
            $('#tablinksFlashingLights').removeClass('active');
            $('#tablinksBrightness').removeClass('active');
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
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
    function displayRadioValue() {
        var radioButtonGroup = document.getElementsByName("radiobutton");
        var checkedRadio = Array.from(radioButtonGroup).find(
            (radio) => radio.checked
        );
        if(checkedRadio.value==11){
            document.getElementById("inputBrightnessManual").value ='';
            document.getElementById("inputBrightnessManual").disabled = true;

        }else if(checkedRadio.value==12){
            document.getElementById("inputBrightnessManual").disabled = false;

        }

    }
    document.getElementById('inputBrightnessManual').addEventListener('input', event => {
        const input = event.target.value;
        if(input > 100){
            document.getElementById("inputBrightnessManual").value ='';
        }else{
        }
    });


    $("#btnRefresh").click(function() {

        var mybannerID = document.getElementById("bannerID").value;
        var myRadio=$("input[type='radio'][name='radiobutton']:checked").val();
        if(myRadio>=1 && myRadio <=4){
            if(myRadio==1){
                var myRadioTextChild = ' ทดสอบการติดต่อป้าย';
            }
            if(myRadio==2){
                var myRadioTextChild = ' ปรับเวลาจากศูนย์ควบคุม';
            }if(myRadio==3){
                var myRadioTextChild = '  Restart เครื่องควบคุมป้าย';
            }if(myRadio==4){
                var myRadioTextChild = ' สอบถามพื้นที่ของฮาร์ดดีส';
            }
            var myRadioText = 'ส่งคำสั่ง';
        }else if(myRadio==5){
            var myRadioText = 'เปิดระบบไฟฟ้า';
            var myRadioTextChild = '';
        }else if(myRadio==6){
            var myRadioText = 'ปิดระบบไฟฟ้า';
            var myRadioTextChild = '';
        }else if(myRadio==7){
            var myRadioText = 'เปิดพัดลมตู้ควบคุม';
            var myRadioTextChild = '';
        }else if(myRadio==8){
            var myRadioText = 'ปิดพัดลมตู้ควบคุม';
            var myRadioTextChild = '';
        }else if(myRadio==9){
            var myRadioText = 'เปิดไฟกระพริบ';
            var myRadioTextChild = '';
        }else if(myRadio==10){
            var myRadioText = 'ปิดไฟกระพริบ';
            var myRadioTextChild = '';
        }else if(myRadio==11){
            var myRadioText = 'ความสว่างอัตโนมัติ';
            var myRadioTextChild = '';
        }else if(myRadio==12){
            var myRadioText = 'ความสว่างตั้งค่าเป็น '+document.getElementById("inputBrightnessManual").value;
            var myRadioTextChild = '';
            document.getElementById("inputBrightnessManual").value ='';
            document.getElementById("inputBrightnessManual").disabled = true;
        }else{
            var myRadioText = '';
            var myRadioTextChild = '';
        }
        document.getElementById('valueSetting'+mybannerID).innerHTML = myRadioText+myRadioTextChild;
        $("input[type=radio][name=radiobutton]").prop('checked', false);
        document.getElementById("tablinksCommand").className = "tablinks active";
        $('#tablinksElectricalSystem').removeClass('tablinks active');
        $('#tablinksControlCabinetFan').removeClass('tablinks active');
        $('#tablinksFlashingLights').removeClass('tablinks active');
        $('#tablinksBrightness').removeClass('tablinks active');
    });

</script>
</body>
</html>
