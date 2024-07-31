<link rel="stylesheet" href="/speedway/dist/css/bootstrap5-toggle.css">
<link rel="stylesheet" href="/speedway/dist/css/bootstrap5-toggle.min.css">
<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "lib/function_consol.php";
include "permission.php";
if(checkmenu($user,'001')==0)
{
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
if(checkmenu($user,'004')==0){
    
    header( "location: dashboard.php" );
    exit(0);
}else{
    if($_SESSION["XBDmnIsRead"]==0){
        header( "location: dashboard.php" );
        exit(0);
    }
}
$sql = "SELECT XIMssWPixel, XIMssHPixel,XVMssCode FROM TMstMMsgSize ORDER BY XVMssCode ASC";

$query = sqlsrv_query($conn, $sql);


?>
<style>
* {
    box-sizing: border-box;
}

.slidecontainer {
    width: 100%;
}

.slider {
    -webkit-appearance: none;
    width: 100%;
    height: 25px;
    background: #d3d3d3;
    outline: none;
    opacity: 0.7;
    -webkit-transition: .2s;
    transition: opacity .2s;
}

.slider:hover {
    opacity: 1;
}

.slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 25px;
    height: 25px;
    background: #006eb4;
    cursor: pointer;
}

.slider::-moz-range-thumb {
    width: 25px;
    height: 25px;
    background: #006eb4;
    cursor: pointer;
}

/* Popup container - can be anything you want */
.popup {
    position: relative;
    display: inline-block;
    cursor: pointer;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
}

/* The actual popup */
.popup .popuptext {
    font-size: 10pt;
    visibility: hidden;
    width: 160px;
    background-color: #555;
    color: #fff;
    text-align: left;
    border-radius: 6px;
    padding-left: 5px;
    padding-right: 5px;
    padding-bottom: 5px;
    padding-top: 5px;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
    visibility: visible;
    -webkit-animation: fadeIn 1s;
    animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

.flex-container {
    display: flex;
    flex-wrap: wrap;
    flex-direction: column;
}

body {
    background: #e1f0fa;
}

.container {
    background-color: white;

}

table td {
    font-size: 0.9rem;
    transition: 0.5s;
    font-weight: 300;
}

table th {
    font-size: 1rem;
    font-weight: 500;
}

table th {
    background-color: #e8f4ff !important;
}

.shadow {
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

.btnh:hover {
    opacity: 0.8;
    transition: 0.5s;
}

#bulb5 {
    filter: brightness(15%);
    transition: .5s;
}

#bulb10 {
    filter: brightness(25%);
    transition: .5s;
}

#bulb20 {
    filter: brightness(35%);
    transition: .5s;
}

#bulb30 {
    filter: brightness(45%);
    transition: .5s;
}

#bulb40 {
    filter: brightness(55%);
    transition: .5s;
}

#bulb50 {
    filter: brightness(65%);
    transition: .5s;
}

#bulb60 {
    filter: brightness(75%);
    transition: .5s;
}

#bulb70 {
    filter: brightness(85%);
    transition: .5s;
}

#bulb80 {
    filter: brightness(95%);
    transition: .5s;
}

#bulb90 {
    filter: brightness(105%);
    transition: .5s;
}

#bulb100 {
    filter: brightness(110%);
    transition: .5s;
}

.modal-header .close {
    margin: 0;
    padding: 0;
}

table {
    width: 100%;
    text-align: center;
}

.modal-body table td {
    font-size: 1rem;
}

.modal-body table th {
    font-size: 1.2rem;
}



.slider {
    appearance: none;
    /* removes browser-specific styling */
    /* width of slider */
    /* height of slider */
    /* orange background */
    outline: none;
    /* remove outline */
    border-radius: 50px;
    /* round corners */
    margin: 1rem;
    transform: rotate(360deg);
    /* rotate the element */
    background: rgb(74, 61, 0);
    background: linear-gradient(90deg, rgba(74, 61, 0, 1) 0%, rgba(255, 171, 25, 1) 50%, rgba(255, 223, 4, 1) 100%);
}

.slider::-webkit-slider-thumb {
    appearance: none;
    /* removes browser-specific styling */
    /* handle width */
    /* handle height */
    border-radius: 50%;
    /* make it circular */
    background: #FFFFFF;
    /* white color */
    cursor: pointer;
    /* cursor on hover */
}

.slider span {
    font-size: 1rem;
}

.toggle {
    box-shadow: 3px 3px 3px #aaaaaa
}

</style>

<div class="container" style="position: relative; top: 75;">


    <div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
        <img src="img/icon/setting.png" height="25" alt="Responsive image"> การควบคุมป้าย
    </div>

    <div class="modal py-5" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <span class="" style="text-align: center; font-size: 1.3rem;">
                        <div id="nameVMS">
                        </div>
                    </span>
                    <button type="button" onclick="CloseModal()" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input id="bannerID" class="input" style="width: 40px;text-align: center;" type="hidden" value="">


                    <div class="tab" style="text-align: center;display: flex;">

                        <div class="col-3 " style="padding: 0;">
                            <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksCommand"
                                class="tablinks" onclick="openCity(event, 'Command')">ตู้ควบคุม</button>
                        </div>
                        <div class="col-2 " style="padding: 0;">
                            <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksElectricalSystem"
                                class="tablinks" onclick="openCity(event, 'ElectricalSystem')">เซ็ตระบบไฟป้าย</button>
                        </div>
                        <div class="col-2 " style="padding: 0;">
                            <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksFlashingLights"
                                class="tablinks" onclick="openCity(event, 'DisplaySystem')">เซ็ตการแสดงผล</button>
                        </div>
                        <div class="col-3 " style="padding: 0;">
                            <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksFlashingLights"
                                class="tablinks" onclick="openCity(event, 'FlashingLights')">เซ็ตระบบไฟกระพริบ</button>
                        </div>
                        <div class="col-2 " style="padding: 0;">
                            <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksBrightness"
                                class="tablinks" onclick="openCity(event, 'Brightness')">เซ็ตค่าความสว่าง</button>
                        </div>
                    </div>


                    <div id="Command" class="tabcontent" style="padding: 2rem; background-color: #f8f8f8; ">
                        <div class="row"
                            style="justify-content: center; align-items: center; flex-wrap: wrap; gap: 10px;">

                            <div class="col-5" style="text-align: center; border-right: 5px double #cccc; ">
                                <button
                                    style="padding: 1rem; width: 100%; background-color: #4976BA; color: white; border: none;"
                                    class="btn btn-info shadow fs-5"
                                    id="btn_settimepc">ปรับเวลาเครื่องคอมพิวเตอร์</button>
                            </div>

                            <div class="col-5" style="text-align: center; padding-left: 0;">
                                <button style="padding: 1rem; width: 100%; background-color: #4976BA; border: none;"
                                    class="btn btn-success shadow fs-5"
                                    id="btn_pcrestartpc">รีสตาร์ทเครื่องคอมพิวเตอร์</button>
                            </div>


                            <div class="col-5 " style="text-align: center; margin-top: .5rem;">
                                <h5>ปิด-เปิด คอมพิวเตอร์</h5>
                                <div onclick="toggleCheckboxpc()" style="display: inline-block;">
                                    <input type="checkbox" id="Checkboxpc" data-toggle="toggle" data-onlabel="เปิด"
                                        data-offlabel="ปิด" data-onstyle="success" data-offstyle="danger"
                                        data-width="120" data-height="40" style="text-align: center">
                                </div>
                            </div>
                            <div class="col-5" style="text-align: center; margin-top: .5rem;">
                                <h5>ปิด-เปิด พัดลมตู้ควคุม</h5>
                                <div onclick="toggleCheckboxfan()" style="display: inline-block;">
                                    <input type="checkbox" id="Checkboxfan" data-toggle="toggle" data-onlabel="เปิด"
                                        data-offlabel="ปิด" data-onstyle="success" data-offstyle="danger"
                                        data-width="120" data-height="40">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- เซ็ตระบบป้ายไฟ -->
                    <div id="ElectricalSystem" class="tabcontent" style="display: flex; background-color: #f8f8f8;">
                        <div class="row" style="justify-content: center; align-items: center; gap: 10px;">
                            <div class="col-5" style="text-align: center; margin: 1rem;">
                                <h5>ปิด-เปิด ไฟป้าย</h5>
                                <div onclick="toggleCheckboxPowervms()" style="display: inline-block;">
                                    <input type="checkbox" id="CheckboxPowervms" data-toggle="toggle"
                                        data-onlabel="เปิด" data-offlabel="ปิด" data-onstyle="success"
                                        data-offstyle="danger" data-width="120" data-height="40">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- เซ็ตระบบป้ายไฟ -->
                    <div id="DisplaySystem" class="tabcontent" style="display: none;">
                        <div class="row" style="justify-content: center; align-items: center; margin: 1rem;">


                            <div class="col-5" style="text-align: center; margin: 1rem;">
                                <h5>ออฟไลน์-ออนไลน์ ป้าย</h5>
                                <div onclick="toggleCheckboxOnlineOfflinevms()" style="display: inline-block;">
                                    <input type="checkbox" id="CheckboxOnlineOfflinevms" data-toggle="toggle"
                                        data-onlabel="ออนไลน์" data-offlabel="ออฟไลน์" data-onstyle="success"
                                        data-offstyle="danger" data-width="120" data-height="40">
                                </div>
                            </div>

                        </div>
                    </div>
                    <div id="FlashingLights" class="tabcontent"
                        style="display: none; background-color: rgb(248, 248, 248);">
                        <div class="row" style="justify-content: center; align-items: center; margin: 1rem; ">


                            <div class="col-5 form-check form-switch"
                                style="display: flex; align-items: center; justify-content: end; flex-direction: column;">

                                <div class="col-12" style="text-align: center; margin: 1rem;">
                                    <h5> เปิด-ปิด ระบบไฟกระพริบ</h5>
                                    <div onclick="toggleCheckboxOnOffFlashvms()" style="display: inline-block;">
                                        <input type="checkbox" id="CheckboxOnOffFlashvms" data-toggle="toggle"
                                            data-onlabel="เปิด" data-offlabel="ปิด" data-onstyle="success"
                                            data-offstyle="danger" data-width="120" data-height="40">
                                    </div>
                                    <!-- <input class="form-check-input" type="checkbox" id="flashingOnRadio" name="radiobutton" value="9" > -->

                                    <!-- <label class="form-check-label" for="flexSwitchCheckDefault">เปิด</label> -->
                                </div>
                            </div>

                            <div class="gif-img col-4" style="text-align: center; padding: 0;">
                                <img id="gifimg" style="display: none; width: 100%;" src="img/traffic-light2_.gif"
                                    width="150">
                                <img id="gifimg-close" style=" width: 100%;" src="img/traffic-light-close.png"
                                    width="150">
                            </div>


                        </div>
                    </div>



                    <div id="Brightness" class="tabcontent"
                        style="display: none; background-color: rgb(248, 248, 248);">
                        <div class="row" style="justify-content: center; align-items: center; margin: 1.5rem; ">

                        <div class="col-12" style="text-align: center; margin: 1rem;">
                        <div id="btnhideM" style="display: inline-block;">
                                        <input type="checkbox" id="hideManaul" data-toggle="toggle"
                                            data-onlabel="Auto" data-offlabel="Manual" data-onstyle="success"
                                            data-offstyle="warning" data-width="120" data-height="40">
                                    </div>
                                    </div>
                            <!-- <div class="col-3" style="text-align: center;">
                                <button id="btnbrightnessAuto" class="btn btn-success fs-5 shadow"
                                    style="padding: .5rem; width: 80%;">Auto</button>
                            </div> -->



                            <div class="col-10" id="closeManaul" style="border-top: 2px double #cccc;">   <!-- ** -->
                                    
                            <div style="display: flex; align-items: center; justify-content: center; flex-direction: column;">
                                <div style="text-align: center; display:flex; flex-direction: column; align-items: center; justify-content: center; flex: 1">

                                    

                                <div class="col-3" style="margin-top: 1rem;">
                                    <div style="display: flex;">

                                        <div>
                                        <h5>Manual</h5>
                                        </div>

                                        <div>
                                        <img style="width: 64%;" class="bulb" id="bulb5"
                                        src="img/brightness_ico.png" width="30" alt="">
                                        </div>

                                        </div>
                                </div>



                                <input style="width: 100%;" id="levels2" class="slider" type="range" min="1" max="12"
                                    value="1" step="1" oninput="this.nextElementSibling.value = this.value">
                                <output ><span id="rangeout">1</span></output>
                                <h6>ระดับความสว่าง</h6>

                                <div class="col-4" style="text-align: center;">
                                    <button id="btnbrightnessManual" class="btn btn-success shadow"
                                        style="margin: 1rem 0rem;width: 100%;">บันทีก</button>
                                </div>

                                </div>





                            </div>

                        </div>
                    </div>

                </div>

            </div>

            <div align="center">
                <?php
                       $Disable="disabled";
                       if($_SESSION["XBDmnIsControl"]==1){
                          $Disable="";
                       }
                    ?>
                <!-- <button type="button" class="btn btn-success"  id="btnRefresh" <?php echo $Disable;?>>ส่งคำสั่ง</button> -->
            </div>
        </div>
    </div>
</div>

<div class="flex-container" style="">




    <div class="col-12" style="margin: 1rem 0rem;">
        <div class="shadow"
            style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i>
                รายการคำสั่งในป้าย</a>
        </div>
        <table class="table table-striped table-hover" style="text-align: center;">
            <thead>
                <tr>
                    <th width="100" scope="col">รหัสป้าย</th>
                    <th width="120" scope="col">ชื่อป้าย</th>
                    <th width="320" scope="col">จุดติดตั้ง</th>
                    <th width="50" scope="col">Option</th>
                    <th width="250" scope="col">คำสั่งที่ส่ง</th>
                </tr>
            </thead>
            <tbody>
    </div>





</div>
<!-- end div container -->




<?php
                    $sql3 = "SELECT XVVmsCode,XVVmsName,XVSdtName,XVDstName,XVPvnName FROM TMstMItmVMS as vms
INNER JOIN TMstMSetupPoint ON TMstMSetupPoint.XVSupCode=vms.XVSupCode
INNER JOIN TMstMSubDistrict ON TMstMSubDistrict.XVSdtCode=TMstMSetupPoint.XVSdtCode
INNER JOIN TMstMDistrict ON TMstMDistrict.XVDstCode=TMstMSubDistrict.XVDstCode
INNER JOIN TMstMProvince ON TMstMProvince.XVPvnCode=TMstMDistrict.XVPvnCode";
                    $query3 = sqlsrv_query($conn, $sql3);
                    while($result_banner = sqlsrv_fetch_array($query3, SQLSRV_FETCH_ASSOC)){
                        $sql4 = "SELECT  TOP 1 XVVmsCode  FROM TMstMItmVMS_Status 
                                 WHERE XVVmsCode='".$result_banner['XVVmsCode']."' AND XIVmsBrightness>0 ORDER BY XTWhenEdit desc ";

                        $sql4 = "SELECT TOP 1  CONVERT(varchar, [XVLctTime], 120)  as XVLctTime,XVLctValue2,XVLctValue3  FROM TLogLVmsAction 
                        WHERE XVVmsCode='".$result_banner['XVVmsCode']."' AND XVLctValue1='COMMAND' ORDER BY XVLctTime DESC ";
                        $query4 = sqlsrv_query($conn, $sql4);
                        $result4 = sqlsrv_fetch_array($query4, SQLSRV_FETCH_ASSOC);
                        /*
                        $showStatus=$result4['XVVmsCode'];
                        if($showStatus!=''){
                            $showStatus='ความสว่างตั้งค่าเป็น '.$showStatus;
                        }
                        */
                        ?>
<tr>
    <td>
        <div style="font-size: 10p"><?php echo $result_banner['XVVmsCode'];?></div>
    </td>
    <td><?php echo $result_banner['XVVmsName'];?></td>
    <td><?php echo $result_banner['XVSdtName'];?> <?php echo $result_banner['XVDstName'];?>
        <?php echo $result_banner['XVPvnName'];?></td>
    <td>
        <div align="center" style="margin-top: 0">
            <a href="#" style="height: 35; color: #333"
                onclick="inputValueId('<?php echo $result_banner['XVVmsCode'];?>','<?php echo $result_banner['XVVmsName'];?>','<?php echo $result_banner['XVSdtName'];?> <?php echo $result_banner['XVDstName'];?> <?php echo $result_banner['XVPvnName'];?>')"><i
                    class="fa fa-cog" aria-hidden="true"></i></a>&nbsp;&nbsp;
            <a href="#" data-toggle="modal" data-target="#MyModalList" style="height: 35; color: #333"
                onclick="ShowList('<?php echo $result_banner['XVVmsCode'];?>','<?php echo $result_banner['XVVmsName'];?>')"><i
                    class="fa fa-list" aria-hidden="true"></i></a>&nbsp;

        </div>
    </td>
    <td><?php echo $result4["XVLctTime"]." ".$result4["XVLctValue2"];?></td>
</tr>
<?php } ?>
</tbody>
</table>

<div class="col-sm-1">
</div>

</div>

<br>
</div>
</div>

<div class="modal py-5" id="myModalList" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header" style="justify-content: center; align-items: center;">
                <div class="col" style="text-align: center;">
                    <h5 id="ShowList_Title" class="modal-title"></h5>
                </div>
                <div class="col2">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body text-center" id="ShowList">



            </div>
        </div>
    </div>
</div>



<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.min.js"></script>
<script>
window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>

<script src="bootstrap4-toggle/js/bootstrap4-toggle.min.js"> </script>

<link href="bootstrap4-toggle/css/bootstrap4-toggle.min.css" rel="stylesheet" />




<script>
  

function CloseModal() {
    $('#myModal').modal('hide');
}

function GetSensorStatus(vmscode) {

    $.ajax({
        type: "POST",
        url: "consolbannerfunction.php",
        data: {
            'vmscode': vmscode,
            'GetSensorStatus': 'GetSensorStatus'
        },
        success: function(result) {
          
            const obj = JSON.parse(result);
          
            if (obj.ST1 == 1) {
                $('#CheckboxPowervms').bootstrapToggle('on');
            }else{
                $('#CheckboxPowervms').bootstrapToggle('off');
            }
            if (obj.ST2 == 1) {
                $('#CheckboxOnlineOfflinevms').bootstrapToggle('on');
            }else{
                $('#CheckboxOnlineOfflinevms').bootstrapToggle('off');
            }
            if (obj.ST3 == 0) {
            
                $('#hideManaul').bootstrapToggle('on');
                $("#closeManaul").hide();
            } else {
            
                $('#hideManaul').bootstrapToggle('off');
            
                $('#levels2').val(obj.ST3);
                $('#rangeout').text(obj.ST3);
            
                $("#closeManaul").show();
            }
            if (obj.ST7 == 1) {
                $('#CheckboxOnOffFlashvms').bootstrapToggle('on');
            }else{
                $('#CheckboxOnOffFlashvms').bootstrapToggle('off');
            }
            if (obj.ST8 == 1) {
                $('#Checkboxpc').bootstrapToggle('on');
            } else {
                $('#Checkboxpc').bootstrapToggle('off');
            }
            if (obj.ST9 == 1) {
                $('#Checkboxfan').bootstrapToggle('on');
            } else {
                $('#Checkboxfan').bootstrapToggle('off');
            }
        
         
           
            $('#myModal').modal('show');
        }

    });
}
//$('#hideManaul').bootstrapToggle('off');
function inputValueId(b, VMSName, setPoint) {


    var nameVMS = 'ชื่อป้าย: ';
    var nameSetPoint = '  จุดติดตั้ง: ';
    document.getElementById("nameVMS").innerHTML = nameVMS.bold() + VMSName + nameSetPoint.bold() + setPoint;


    document.getElementById("Command").style.display = "block";
    document.getElementById("bannerID").value = b;

    $('#tablinksElectricalSystem').removeClass('active');
    $('#tablinksFlashingLights').removeClass('active');
    $('#tablinksBrightness').removeClass('active');

    var element = document.getElementById("tablinksCommand");
    element.classList.add("active");
    var elementContentCommand = document.getElementById("Command");
    var elementContentElectricalSystem = document.getElementById("ElectricalSystem");
    var elementContentControlFlashingLights = document.getElementById("FlashingLights");
    var elementContentControlBrightness = document.getElementById("Brightness");
    var elementContentControlDisplay = document.getElementById("DisplaySystem");


    elementContentElectricalSystem.style.display = "none";
    elementContentControlFlashingLights.style.display = "none";
    elementContentControlBrightness.style.display = "none";
    elementContentControlDisplay.style.display = "none";

    GetSensorStatus(b);


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
        $('#tablinksFlashingLights').removeClass('active');
        $('#tablinksBrightness').removeClass('active');

        tablinks[i].className = tablinks[i].className.replace(" active", "");

    }

    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";




}

$("#btn_settimepc").click(function() {
    Swal.fire({
        title: "",
        text: "ต้องการปรับเวลาเครื่องคอมพิวเตอร์ใช่หรือไม่?",
        icon: "question",
        confirmButtonText: "ใช่",
        showCancelButton: true,
        CancelButtonText: "ไม่",


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'settimepc': 'settimepc'
                },
                success: function(result) {

                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        }
    });

});
$("#btn_pcrestartpc").click(function() {
    Swal.fire({
        title: "",
        text: "ต้องการรีสตาร์ทเครื่องคอมพิวเตอร์ใช่หรือไม่?",
        icon: "question",
        confirmButtonText: "ใช่",
        showCancelButton: true,
        CancelButtonText: "ไม่",


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'restartpc': 'restartpc'
                },
                success: function(result) {

                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        }
    });
});

function toggleCheckboxpc() {
    var sms = "";
    var value = 0;


    var checkBox = document.getElementById("Checkboxpc");
    if (checkBox.checked == false) {
        sms = "ต้องการเปิดเครื่องคอมพิวเตอร์ใช่หรือไม่?";
        value = 1;
    } else {
        sms = "ต้องการปิดเครื่องคอมพิวเตอร์ใช่หรือไม่?";
        value = 0;
    }

    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',

    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'onoffpc': 'onoffpc',
                    'value': value
                },
                success: function(result) {

                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });


}

function toggleCheckboxfan() {
    var sms = "";
    var value = 0;
    var checkBox = document.getElementById("Checkboxfan");
    if (checkBox.checked == false) {
        sms = "ต้องการเปิดพัดลมตู้ควบคุมใช่หรือไม่?";
        value = 1;
    } else {
        sms = "ต้องการปิดพัดลมตู้ควบคุมใช่หรือไม่?";
        value = 0;
    }

    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'onofffan': 'onofffan',
                    'value': value
                },
                success: function(result) {

                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });


}


function toggleCheckboxPowervms() {
    var sms = "";
    var value = 0;
    var checkBox = document.getElementById("CheckboxPowervms");
    if (checkBox.checked == false) {
        sms = "ต้องการเปิดไฟฟ้าป้ายใช่หรือไม่?";
        value = 1;
    } else {
        sms = "ต้องการปิดไฟฟ้าป้ายใช่หรือไม่?";
        value = 0;
    }

    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'onoffpowervms': 'onoffpowervms',
                    'value': value
                },
                success: function(result) {


                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });


}


function toggleCheckboxOnlineOfflinevms() {
    var sms = "";
    var value = 0;
    var checkBox = document.getElementById("CheckboxOnlineOfflinevms");
    if (checkBox.checked == false) {
        sms = "ต้องการเปลี่ยนใช้โหมดออนไลน์ใช่หรือไม่?";

        value = 1;
    } else {
        sms = "ต้องการเปลี่ยนใช้โหมดออฟไลน์ใช่หรือไม่?";
        value = 0;
    }

    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'onoffpowervms': 'onoffpowervms',
                    'value': value
                },
                success: function(result) {


                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });


}

function toggleCheckboxOnOffFlashvms() {
    var sms = "";
    var value = 0;
    var checkBox = document.getElementById("CheckboxOnOffFlashvms");
    if (checkBox.checked == false) {
        sms = "ต้องการเปิดไฟกระพริบใช่หรือไม่?";

        value = 1;
    } else {
        sms = "ต้องการปิดไฟกระพริบใช่หรือไม่?";
        value = 0;
    }

    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',


    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'onoffflashvms': 'onoffflashvms',
                    'value': value
                },
                success: function(result) {


                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });


}
$('#hideManaul').bootstrapToggle({
      on: 'Auto',
      off: 'Manual'
});

function bright(value) {
    var sms = "";
    var checkBox = document.getElementById("CheckboxOnlineOfflinevms");
    if (value == 0) {
        sms = "ต้องการตั้งค่าวามสว่างแบบอัตโนมัติหรือไม่?";
    } else {
        sms = "ต้องการตั้งค่าวามสว่างแบบกำหนดเองระดับ " + value + " หรือไม่?";
    }
    Swal.fire({
        title: "",
        text: sms,
        icon: "question",
        confirmButtonText: "ใช่",
        showDenyButton: true,
        denyButtonText: 'ไม่',
    }).then((result) => {

        if (result.isConfirmed) {

            var vmscode = document.getElementById("bannerID").value;

            $.ajax({
                type: "POST",
                url: "consolbannerfunction.php",
                data: {
                    'vmscode': vmscode,
                    'brightvms': 'brightvms',
                    'value': value
                },
                success: function(result) {

                    console.log(result);
                    const obj = JSON.parse(result);

                    if (obj.Return == "Success") {
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    } else {
                        Swal.fire({
                            title: "",
                            icon: "warning",
                            text: "ไม่สามารถส่งคำสั่งได้",
                            confirmButtonText: "ตกลง",

                        }).then((result) => {

                            if (result.isConfirmed) {

                                window.location.href = 'consolbanner.php';
                            }
                        });
                    }

                }
            });


        } else {
            window.location.href = 'consolbanner.php';
        }
    });
}

$("#btnbrightnessManual").click(function() {
    var level = document.getElementById("levels2").value;
    bright(level);
});





function ShowList(VmsCode, VmsName) {

    $('#ShowList').empty();

    $('#ShowList_Title').text(VmsName);
    $.ajax({
        type: "POST",
        url: "consolbannerlist.php",
        data: {
            'vmscode': VmsCode
        },
        success: function(result) {

            $('#ShowList').html(result);
        }
    });
    $('#MyModalList').modal('show');
}
</script>



<script>
$("#CheckboxOnOffFlashvms").change(function() {

    if ($(this).prop('checked') == true) {
        // $("#div1").fadeIn();
        $("#gifimg-close").hide();
        $("#gifimg").show();
        // $("#div3").fadeIn(3000);
    } else {

        // $("#div1").fadeIn();
        $("#gifimg").hide();
        $("#gifimg-close").show();
        // $("#div3").fadeIn(3000);
    }
})
</script>




<script>
$("#btnhideM").click(function(){
    if($("#hideManaul").prop('checked') == true){
    //$('#hideManaul').bootstrapToggle('Auto')
 
    $("#closeManaul").show()
    }else{
        //$('#hideManaul').bootstrapToggle('Manual')
        bright(0);
        $("#closeManaul").hide()
    }
})
</script>

<script>
    $(document).on('input change', '#levels2', function() {
    if($(this).val() == "1") {
      $(".bulb").attr('id', 'bulb10'); 
    } else if($(this).val() == "2") {
        $(".bulb").attr('id', 'bulb20');
    }else if($(this).val() == "3") {
        $(".bulb").attr('id', 'bulb30');
    }else if($(this).val() == "4") {
        $(".bulb").attr('id', 'bulb40');
    }else if($(this).val() == "5") {
        $(".bulb").attr('id', 'bulb50');
    }else if($(this).val() == "6") {
        $(".bulb").attr('id', 'bulb60');
    }else if($(this).val() == "7") {
        $(".bulb").attr('id', 'bulb70');
    }else if($(this).val() == "8") {
        $(".bulb").attr('id', 'bulb80');
    }else if($(this).val() == "9") {
        $(".bulb").attr('id', 'bulb90');
    }else if($(this).val() == "10") {
        $(".bulb").attr('id', 'bulb100');
    }else if($(this).val() == "11") {
        $(".bulb").attr('id', 'bulb100');
    }else if($(this).val() == "12") {
        $(".bulb").attr('id', 'bulb100');
    }else{
        $(".bulb").attr('id', 'bulb5');
    }
    });
    </script>

</body>

</html>