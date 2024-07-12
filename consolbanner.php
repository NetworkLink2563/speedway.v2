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
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;การควบคุมป้าย
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <div class="tablinks2 active" > &nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> รายการคำสั่งในป้าย</div>
        </div>

        <div class="row">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-9" >
                <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">
                <table class="table" style="font-size: 10pt">
                    <thead>
                    <tr>
                        <th width="100" scope="col">รหัสป้าย</th>
                        <th width="120" scope="col">ชื่อป้าย</th>
                        <th width="320" scope="col">จุดติดตั้ง</th>
                        <th width="50" scope="col"><div align="center">Op</div></th>
                        <th width="250" scope="col">คำสั่งที่ส่ง</th>
                    </tr>
                    </thead>
                    <tbody>
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
                            <td><div style="font-size: 10p"><?php echo $result_banner['XVVmsCode'];?></div></td>
                            <td><?php echo $result_banner['XVVmsName'];?></td>
                            <td><?php echo $result_banner['XVSdtName'];?> <?php echo $result_banner['XVDstName'];?> <?php echo $result_banner['XVPvnName'];?></td>
                            <td><div align="center" style="margin-top: 0">
                                    <a href="#" data-toggle="modal" data-target="#myModal" style="height: 35; color: #333" onclick="inputValueId('<?php echo $result_banner['XVVmsCode'];?>','<?php echo $result_banner['XVVmsName'];?>','<?php echo $result_banner['XVSdtName'];?> <?php echo $result_banner['XVDstName'];?> <?php echo $result_banner['XVPvnName'];?>')" ><i class="fa fa-cog" aria-hidden="true"></i></a>&nbsp;&nbsp;
                                    <a href="#" data-toggle="modal" data-target="#MyModalList" style="height: 35; color: #333" onclick="ShowList('<?php echo $result_banner['XVVmsCode'];?>','<?php echo $result_banner['XVVmsName'];?>')"><i class="fa fa-list" aria-hidden="true"></i></a>&nbsp;
                                 
                                </div></td>
                            <td><?php echo $result4["XVLctTime"]." ".$result4["XVLctValue2"];?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
            <div class="col-sm-1">
            </div>

        </div>

        <br >
    </div>
</div>

<div class="modal py-5"  id="myModalList" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 id="ShowList_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" id="ShowList">
               
              
                        
            </div>
        </div>
    </div>
</div>



<div class="modal py-5"  id="myModal" role="dialog">
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title"></h5> <span style="font-size: 10pt; margin-top: 8;margin-left: 5px"><div id="nameVMS"></div></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <input id="bannerID" class="input" style="width: 40px;text-align: center;" type="hidden"  value="">
                <?php
                $sqlCMDBrightness="SELECT * FROM TSysSCommand WHERE XVCmdCode='001'";
                $queryCMDBrightness = sqlsrv_query($conn, $sqlCMDBrightness);
                $resultCMDBrightness = sqlsrv_fetch_array($queryCMDBrightness, SQLSRV_FETCH_ASSOC);

                $sqlCMDElectrical="SELECT * FROM TSysSCommand WHERE XVCmdCode='002'";
                $queryCMDElectrical = sqlsrv_query($conn, $sqlCMDElectrical);
                $resultCMDElectrical = sqlsrv_fetch_array($queryCMDElectrical, SQLSRV_FETCH_ASSOC);

                $sqlCMDDisplay="SELECT * FROM TSysSCommand WHERE XVCmdCode='003'";
                $queryCMDDisplay = sqlsrv_query($conn, $sqlCMDDisplay);
                $resultCMDDisplay = sqlsrv_fetch_array($queryCMDDisplay, SQLSRV_FETCH_ASSOC);

                $sqlCMDFlashing="SELECT * FROM TSysSCommand WHERE XVCmdCode='004'";
                $queryCMDFlashing = sqlsrv_query($conn, $sqlCMDFlashing);
                $resultCMDFlashing = sqlsrv_fetch_array($queryCMDFlashing, SQLSRV_FETCH_ASSOC);

                $sqlCMDTimeSet="SELECT * FROM TSysSCommand WHERE XVCmdCode='005'";
                $queryCMDTimeSet = sqlsrv_query($conn, $sqlCMDTimeSet);
                $resultCMDTimeSet = sqlsrv_fetch_array($queryCMDTimeSet, SQLSRV_FETCH_ASSOC);

                $sqlCMDReset="SELECT * FROM TSysSCommand WHERE XVCmdCode='006'";
                $queryCMDReset = sqlsrv_query($conn, $sqlCMDReset);
                $resultCMDReset = sqlsrv_fetch_array($queryCMDReset, SQLSRV_FETCH_ASSOC);
                ?>
                <div class="tab" style="margin-left: 10px;margin-right: 55px;"> 
                 
                    <button id="tablinksCommand" name="firstactive" class=" active" onclick="openCity(event, 'Command')">คำสั่ง</button>
                  
                    <button id="tablinksElectricalSystem" class="tablinks active" onclick="openCity(event, 'ElectricalSystem')"><?php echo $resultCMDElectrical['XVCmdName'];?></button>
                    <button id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'DisplaySystem')"><?php echo $resultCMDDisplay['XVCmdName'];?></button>
                    <button id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'FlashingLights')"><?php echo $resultCMDFlashing['XVCmdName'];?></button>
                    <button id="tablinksBrightness" class="tablinks" onclick="openCity(event, 'Brightness')"><?php echo $resultCMDBrightness['XVCmdName'];?></button>
                </div>
                <div id="Command" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row"style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-2">
                        </div>
                     <!--   <div class="col-sm-4"><input id="testConnectRadio" name="radiobutton" type="radio" value="1"/> ทดสอบการติดต่อป้าย
                        </div>-->
                        <div class="col-sm-4"><input id="changeTimeRadio" name="radiobutton" type="radio" value="2" /> <?php echo $resultCMDTimeSet['XVCmdName'];?>
                        </div>  <div class="col-sm-4"><input id="resetRadio" name="radiobutton" type="radio" value="3" /> <?php echo $resultCMDReset['XVCmdName'];?>
                        </div>
                        <div class="col-sm-2">
                        </div>
                    </div>
                    <div class="row" >
                        <div class="col-sm-2">
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-2">
                        </div>
                    </div>
                </div>

                <div id="ElectricalSystem" class="tabcontent" style="display: none; margin-left: 10px;margin-right: 55px;">
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
                <div id="DisplaySystem" class="tabcontent" style="display: none; margin-left: 10px;margin-right: 55px;">
                    <div class="row" style="margin-top: 10px;margin-bottom:  10px">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3"><input id="displayOnlineRadio" name="radiobutton" type="radio" value="7" /> Online
                        </div>
                        <div class="col-sm-3"><input id="displayOfflineRadio" name="radiobutton" type="radio" value="8" /> Offline
                        </div>
                        <div class="col-sm-3">
                        </div>
                    </div>
                </div>
                <div id="FlashingLights" class="tabcontent" style="display: none; margin-left: 10px;margin-right: 55px;">
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
                <div id="Brightness" class="tabcontent" style="display: none; margin-left: 10px;margin-right: 55px;">
                    <div class="row"style="margin-top: 10px;margin-bottom:  10px">
                        
                        <div class="col-sm-5 text-center"></div>
                        <div class="col-sm-4 text-center">
                            <div style="text-align: left;">
                            <input id="brightnessAutoRadio"  name="radiobutton" type="radio" value="11"/> Auto<br>
                            <input id="brightnessLevel1Radio"  name="radiobutton" type="radio" value="12"/>ระดับ 1<br>
                            <input id="brightnessLevel2Radio"  name="radiobutton" type="radio" value="13"/>ระดับ 2<br>
                            <input id="brightnessLevel3Radio"  name="radiobutton" type="radio" value="14"/>ระดับ 3<br>
                            <input id="brightnessLevel4Radio"  name="radiobutton" type="radio" value="15"/>ระดับ 4<br>
                            <input id="brightnessLevel5Radio"  name="radiobutton" type="radio" value="16"/>ระดับ 5<br>
                            <input id="brightnessLevel6Radio"  name="radiobutton" type="radio" value="17"/>ระดับ 6<br>
                            <input id="brightnessLevel7Radio"  name="radiobutton" type="radio" value="18"/>ระดับ 7<br>
                            <input id="brightnessLevel8Radio"  name="radiobutton" type="radio" value="19"/>ระดับ 8<br>
                            <input id="brightnessLevel9Radio"  name="radiobutton" type="radio" value="20"/>ระดับ 9<br>
                            <input id="brightnessLevel10Radio"  name="radiobutton" type="radio" value="21"/>ระดับ 10<br>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
                <br >
                <div align="center" >
                    <?php
                       $Disable="disabled";
                       if($_SESSION["XBDmnIsControl"]==1){
                          $Disable="";
                       }
                    ?>
                    <button type="button" class="btn btn-success"  id="btnRefresh" <?php echo $Disable;?>>ส่งคำสั่ง</button>
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
/*
    var slider = document.getElementById("myRange");
    var output = document.getElementById("showRangeValue");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }
    */
</script>

<script>

    function inputValueId(b,VMSName,setPoint){
        
       
        var nameVMS='ชื่อป้าย: ';
        var nameSetPoint='  จุดติดตั้ง: ';
        document.getElementById("nameVMS").innerHTML = nameVMS.bold()+VMSName+nameSetPoint.bold()+setPoint;
        document.getElementById("Command").style.display = "block";
        document.getElementById("bannerID").value=b;
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

        let changeTimeRadio = document.getElementById("changeTimeRadio");
        changeTimeRadio.checked = false;
        let resetRadio = document.getElementById("resetRadio");
        resetRadio.checked = false;
        let electricalOnRadio = document.getElementById("electricalOnRadio");
        electricalOnRadio.checked = false;
        let electricalOffRadio = document.getElementById("electricalOffRadio");
        electricalOffRadio.checked = false;
        let flashingOnRadio = document.getElementById("flashingOnRadio");
        flashingOnRadio.checked = false;
        let flashingOffRadio = document.getElementById("flashingOffRadio");
        flashingOffRadio.checked = false;
        let brightnessAutoRadio = document.getElementById("brightnessAutoRadio");
        brightnessAutoRadio.checked = false;
        let brightnessManual = document.getElementById("brightnessManual");
        brightnessManual.checked = false;

        //document.getElementById("myRange").value =0;
        //document.getElementById("myRange").disabled = true;
        //var output = document.getElementById("showRangeValue");
        //output.innerHTML = 0;

    }
    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModal').modal('show');
        return false;
    }

    function openCity(evt, cityName) {
        //document.getElementById("rangeBar").style.display = "none";

        //var output = document.getElementById("showRangeValue");
        //output.innerHTML = 0;
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

        let changeTimeRadio = document.getElementById("changeTimeRadio");
        changeTimeRadio.checked = false;
        let resetRadio = document.getElementById("resetRadio");
        resetRadio.checked = false;
        let electricalOnRadio = document.getElementById("electricalOnRadio");
        electricalOnRadio.checked = false;
        let electricalOffRadio = document.getElementById("electricalOffRadio");
        electricalOffRadio.checked = false;
        let flashingOnRadio = document.getElementById("flashingOnRadio");
        flashingOnRadio.checked = false;
        let flashingOffRadio = document.getElementById("flashingOffRadio");
        flashingOffRadio.checked = false;
        let brightnessAutoRadio = document.getElementById("brightnessAutoRadio");
        brightnessAutoRadio.checked = false;
        let brightnessManual = document.getElementById("brightnessManual");
        brightnessManual.checked = false;

        //document.getElementById("myRange").value =0;
        //document.getElementById("myRange").disabled = true;
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
        /*
        document.getElementById("rangeBar").style.display = "none";
        var radioButtonGroup = document.getElementsByName("radiobutton");
        var checkedRadio = Array.from(radioButtonGroup).find(
            (radio) => radio.checked
        );
        if(checkedRadio.value==11){
            document.getElementById("myRange").value =<?php //echo $resultCMDBrightness['XICmdMinValue'];?>;
            document.getElementById("myRange").disabled = true;
            document.getElementById("rangeBar").style.display = "none";
            var output = document.getElementById("showRangeValue");
            output.innerHTML = <?php //echo $resultCMDBrightness['XICmdMinValue'];?>;
        }else if(checkedRadio.value==12){
            document.getElementById("myRange").disabled = false;
            document.getElementById("rangeBar").style.display = "block";

        }
            
*/
    }

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
        }else if(myRadio==11||myRadio==12||myRadio==13||myRadio==14||myRadio==15||myRadio==16||myRadio==17||myRadio==18||myRadio==19||myRadio==20||myRadio==21){
            if(myRadio==11){
                var myRadioText = 'ความสว่างอัตโนมัติ';
            }else{
                var myRadioText = myRadio;
            }
            var myRadioTextChild = '';
      
        }else{
            var myRadioText = '';
            var myRadioTextChild = '';
        }
       
       // document.getElementById('valueSetting'+mybannerID).innerHTML = myRadioText+myRadioTextChild;
        
        $("input[type=radio][name=radiobutton]").prop('checked', false);
        document.getElementById("tablinksCommand").className = "tablinks active";
        document.getElementById("Command").style.display = "block";
        $('#tablinksElectricalSystem').removeClass('tablinks active');
        $('#tablinksFlashingLights').removeClass('tablinks active');
        $('#tablinksBrightness').removeClass('tablinks active');
        Swal.showLoading();
        if(myRadio==2) {
          
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'value': myRadio},
                success: function (result) {
                  
                    if(result=="Success"){
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
                    }else{
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

        if(myRadio==3) {
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'value': myRadio},
                success: function (result) {
                    if(result=="Success"){
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
                    }else{
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


        if(myRadio==5 || myRadio==6) {//เซ็ตระบบไฟป้าย
           
            //alert(myRadio);
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'value': myRadio},
                success: function (result) {
                    
                 
                    if(result=="Success"){
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
                    }else{
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

        if(myRadio==7 || myRadio==8) {
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'value': myRadio},
                success: function (result) {
                    if(result=="Success"){
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
                    }else{
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


        if(myRadio==9 || myRadio==10) {
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'value': myRadio},
                success: function (result) {
                    if(result=="Success"){
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
                    }else{
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
        if(myRadio>=11 && myRadio<=21) {
        
            var valueBrightness=0;
            if(myRadio==11){
                valueBrightness=0;
            }else if(myRadio==12){
                valueBrightness=10; 
            }else if(myRadio==13){
                valueBrightness=20; 
            }else if(myRadio==14){
                valueBrightness=30; 
            }else if(myRadio==15){
                valueBrightness=40;
            }else if(myRadio==16){
                valueBrightness=50;
            }else if(myRadio==17){
                valueBrightness=60;
            }else if(myRadio==18){
                valueBrightness=70;
            }else if(myRadio==19){
                valueBrightness=80;  
            }else if(myRadio==20){
                valueBrightness=90;        
            }else if(myRadio==21){
                valueBrightness=100;   
            }
           
            var vmscode = mybannerID;
            var option = myRadio;
            $.ajax({
                type: "POST",
                url: "lib/commandVMS.php",
                data: {'vmscode': vmscode, 'option':option ,'valueBrightness': valueBrightness},
                success: function (result) {
                    console.log(result);
                  
                    if(result=="Success"){
                        
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
                    }else{
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
    function showCommandList(mybannerID) {
         alert(mybannerID);
        //var popup = document.getElementById("commandList"+mybannerID);
        //popup.classList.toggle("show");
        //return false;
    }

    function ShowList(VmsCode,VmsName){
           
            $('#ShowList').empty();
         
            $('#ShowList_Title').text(VmsName);
            $.ajax({
                type: "POST",
                url: "consolbannerlist.php",
                data: {'vmscode': VmsCode},
                success: function (result) {
                 
                    $('#ShowList').html(result);
                }
            });
            $('#MyModalList').modal('show');
    }
</script>
</body>
</html>