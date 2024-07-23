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
 
    *{
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
        from {opacity: 0;}
        to {opacity: 1;}
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity:1 ;}
    }

    .flex-container{
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
    }

    body {
        background: #e1f0fa;
    }

    .container{
        background-color:  white;
        
    }

    table td{
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    table th{
        font-size: 1rem;
        font-weight: 500;
    }

    table th{
        background-color: #e8f4ff!important;
    }
    
    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

.btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

    #bulb5{
    filter: brightness(15%);
    transition: .5s;
}
#bulb10{
    filter: brightness(25%);
    transition: .5s;
}
#bulb20{
    filter: brightness(35%);
    transition: .5s;
}
#bulb30{
    filter: brightness(45%);
    transition: .5s;
}
#bulb40{
    filter: brightness(55%);
    transition: .5s;
}
#bulb50{
    filter: brightness(65%);
    transition: .5s;
}
#bulb60{
    filter: brightness(75%);
    transition: .5s;
}
#bulb70{
    filter: brightness(85%);
    transition: .5s;
}
#bulb80{
    filter: brightness(95%);
    transition: .5s;
}
#bulb90{
    filter: brightness(105%);
    transition: .5s;
}
#bulb100{
    filter: brightness(110%);
    transition: .5s;
}

.modal-header .close {
    margin: 0;
    padding: 0;
}

table{
    width: 100%;
    text-align: center;
}

.modal-body table td{
    font-size: 1rem;
}

.modal-body table th{
    font-size: 1.2rem;
}



.slider {
    appearance: none; /* removes browser-specific styling */
     /* width of slider */
     /* height of slider */
     /* orange background */
    outline: none; /* remove outline */
    border-radius: 50px; /* round corners */
    margin: 1rem;
    transform: rotate(360deg); /* rotate the element */
    background: rgb(74,61,0);
    background: linear-gradient(90deg, rgba(74,61,0,1) 0%, rgba(255,171,25,1) 50%, rgba(255,223,4,1) 100%);
}

.slider::-webkit-slider-thumb {
  appearance: none; /* removes browser-specific styling */
  /* handle width */
   /* handle height */
  border-radius: 50%; /* make it circular */
  background: #FFFFFF; /* white color */
  cursor: pointer; /* cursor on hover */
}

.slider span{
    font-size: 1rem;
}
</style>

<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> การควบคุมป้าย
        </div>


<div class="flex-container" style="">

        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> รายการคำสั่งในป้าย</a>
        </div>


            <div class="col-12" style="margin: 1rem 0rem;">
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
          
            <div class="col-sm-1">
            </div>

        </div>

        <br >
    </div>
</div>

<div class="modal py-5"  id="myModalList" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
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



<div class="modal py-5"  id="myModal" role="dialog">
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content">
            <div class="modal-header" >
                <h5 class="modal-title"></h5> 
                <span class="" style="text-align: center; font-size: 1.3rem;">
                    <div id="nameVMS">
                    </div></span>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span  aria-hidden="true">&times;</span>
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
                <div class="tab" style="text-align: center;display: flex;"> 
                 
                    <div class="col-3 " style="padding: 0;">
                    <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksCommand" name="firstactive" class=" active" onclick="openCity(event, 'Command')">คำสั่ง</button>
                    </div>
                    <div class="col-2 "  style="padding: 0;">
                    <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksElectricalSystem" class="tablinks active" onclick="openCity(event, 'ElectricalSystem')"><?php echo $resultCMDElectrical['XVCmdName'];?></button>
                    </div>
                    <div class="col-2 "  style="padding: 0;">
                    <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'DisplaySystem')"><?php echo $resultCMDDisplay['XVCmdName'];?></button>
                    </div>
                    <div class="col-3 "  style="padding: 0;">
                    <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksFlashingLights" class="tablinks" onclick="openCity(event, 'FlashingLights')"><?php echo $resultCMDFlashing['XVCmdName'];?></button>
                    </div>
                    <div class="col-2 "  style="padding: 0;">
                    <button style="width: 100%; padding: .5rem; font-size: .9rem;" id="tablinksBrightness" class="tablinks" onclick="openCity(event, 'Brightness')"><?php echo $resultCMDBrightness['XVCmdName'];?></button>
                    </div>
                </div>


                <div id="Command" class="tabcontent" style="padding: 2rem; background-color: #f8f8f8; ">
                    <div class="row"style="justify-content: center; align-items: center; flex-wrap: wrap; gap: 10px;">
                        <!-- <div class="col-sm-2">
                        </div> -->
                     <!--   <div class="col-sm-4"><input id="testConnectRadio" name="radiobutton" type="radio" value="1"/> ทดสอบการติดต่อป้าย
                        </div>-->

                        <div class="col-5" style="text-align: center; border-right: 5px double #cccc; ">
                            <button style="padding: 1rem; width: 100%; background-color: #4976BA; color: white; border: none;" class="btn btn-info shadow fs-5" id="changeTimeRadio" name="radiobutton" type="radio" value="2"> <?php echo $resultCMDTimeSet['XVCmdName'];?></button>
                        </div>  
                        
                        <div class="col-5"style="text-align: center; padding-left: 0;">
                            <button style="padding: 1rem; width: 100%; background-color: #4976BA; border: none;" class="btn btn-success shadow fs-5" id="resetRadio" name="radiobutton" type="radio" value=""> <?php echo $resultCMDReset['XVCmdName'];?> </button>
                        </div>

                        <div class="col-5" style="text-align: center;border-right: 5px double #cccc;   ">
                            <button style="padding: 1rem; width: 100%; color: white;" class="btn btn-success shadow fs-5" id="btn_pcon" > เปิดคอมพิวเตอร์</button>
                        </div>
                        
                        <div class="col-5"style="text-align: center;   padding-left: 0;">
                            <button style="padding: 1rem; width: 100%; background-color: #C40C0C;" class="btn btn-danger shadow fs-5" id="btn_pcoff">ปิดคอมพิวเตอร์ </button>
                        </div>  
                        
                        <div class="col-5" style="text-align: center;border-right: 5px double #cccc;   ">
                            <button style="padding: 1rem; width: 100%; color: white; " class="btn btn-success shadow fs-5" id="btn_fanon" > เปิดพัดลมตู้ควบคุม</button>
                        </div>
                        
                        <div class="col-5"style="text-align: center;   padding-left: 0;">
                            <button style="padding: 1rem; width: 100%; background-color: #C40C0C;" class="btn btn-danger shadow fs-5" id="btn_fanoff" > ปิดพัดลมตู้ควบคุม </button>
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



                    <!-- เซ็ตระบบป้ายไฟ -->
                <div id="ElectricalSystem" class="tabcontent" style="display: flex; background-color: #f8f8f8;">
                    <div class="row" style="justify-content: center; align-items: center; gap: 10px;">

                        <div class="col-3" style="margin: 1rem 0rem;">
                            <button class="btn btn-success shadow fs-5" style="width: 100%; padding: 1rem;" id="electricalOnRadio" name="radiobutton" type="radio" value="5">เปิดไฟป้าย</button>
                        </div>

                        <div class="col-3" style="margin: 1rem 0rem;">
                            <button class="btn btn-danger shadow fs-5" style="width: 100%; padding: 1rem; background-color: #C40C0C;" id="electricalOffRadio" name="radiobutton" type="radio" value="6" >ปิดไฟป้าย</button>
                        </div>

                    </div>
                </div>
            <!-- เซ็ตระบบป้ายไฟ -->


                <div id="DisplaySystem" class="tabcontent" style="display: none;">
                    <div class="row" style="justify-content: center; align-items: center; margin: 1rem;">
                        
                        <div class="col fs-5 form-check form-switch" style="padding: 1rem; text-align: center; border-right: 5px double #cccc;"><input class="form-check-input" id="displayOnlineRadio" name="radiobutton" type="radio" value="7" /> Online
                        </div>
                        <div class="col fs-5 form-check form-switch" style="padding: 1rem; text-align: center;"><input class="form-check-input" id="displayOfflineRadio" name="radiobutton" type="radio" value="8" /> Offline
                        </div>
                        
                    </div>
                </div>
                <div id="FlashingLights" class="tabcontent" style="display: none; background-color: rgb(248, 248, 248);">
                    <div class="row" style="justify-content: center; align-items: center; margin: 1rem; ">
                        

                        <div class="col-5 fs-5 form-check form-switch" style="display: flex; align-items: center; justify-content: end;">
                           <div class="col-5 fs-5" style="display: inline-block; text-align: center; margin-right: .7rem;">ปิด</div> 
                           <div class="col-5">
                        <input class="form-check-input" type="checkbox" id="flashingOnRadio" name="radiobutton" value="9" onclick="showimg()">
                        <label class="form-check-label" for="flexSwitchCheckDefault">เปิด</label>
                        </div>
                        </div>

                        <div class="gif-img col-4" style="text-align: center; padding: 0;">
                        <img id="gifimg" style="display: none; width: 100%;" src="img/traffic-light2_.gif" width="150">
                        <img id="gifimg-close" style="display: ; width: 100%;" src="img/traffic-light-close.png" width="150">
                        </div>

                        <!-- <div class="col-2 fs-5 form-check form-switch" style="padding: 1rem; text-align: center;"><input class="form-check-input" id="flashingOnRadio" name="radiobutton" type="radio" value="9" /> เปิด
                        </div> -->
                        <!-- <div class="col-2 fs-5 form-check form-switch" style="padding: 1rem; text-align: center;"><input class="form-check-input" id="flashingOffRadio" name="radiobutton" type="radio" value="10" /> ปิด
                        
                    </div> -->
                </div>
                </div>



                <div id="Brightness" class="tabcontent" style="display: none; background-color: rgb(248, 248, 248);">
                    <div class="row" style="justify-content: center; align-items: center; margin: 1rem; ">
                        
                        <div class="col-3" style="text-align: center;">
                        <button id="brightnessAutoRadio" class="btn btn-success fs-5 shadow" style="padding: .5rem; width: 80%;">Auto</button>
                        </div>


                        
                        <div class="col-6" style="text-align: center; display:flex; flex-direction: column; align-items: center; justify-content: center; flex: 1; border-left: 3px double #cccc;">
                            
                        <div style="display: flex; justify-content:center; align-items: center;">

                        <div class="col-2">
                        <h5>Manual</h5>
                        </div>

                        <div class="col-1" style="text-align: center; padding: 0;">
                            <img style="width: 61%; position: relative; top: -3px;" class="bulb" id="bulb5" src="img/brightness_ico.png" width="30" alt="">
                        </div>

                        </div>
                        <!-- <select id="levels" class="form-select fs-6" aria-label="Default select example" style="text-align: ; ">
                        <option selected>เลือกระดับความสว่าง</option>
                        <option id="brightnessLevel1Radio" value="12">ระดับ 1</option>
                        <option id="brightnessLevel2Radio" value="13">ระดับ 2</option>
                        <option id="brightnessLevel3Radio" value="14">ระดับ 3</option>
                        <option id="brightnessLevel4Radio" value="15">ระดับ 4</option>
                        <option id="brightnessLevel5Radio" value="16">ระดับ 5</option>
                        <option id="brightnessLevel6Radio" value="17">ระดับ 6</option>
                        <option id="brightnessLevel7Radio" value="18">ระดับ 7</option>
                        <option id="brightnessLevel8Radio" value="19">ระดับ 8</option>
                        <option id="brightnessLevel9Radio" value="20">ระดับ 9</option>
                        <option id="brightnessLevel10Radio" value="21">ระดับ 10</option>
                        </select> -->
                            
                            <input style="width: 100%;" id="levels2" class="slider" type="range" min="0" max="100" value="0" step="10" oninput="this.nextElementSibling.value = this.value">
                            <output><span>0</span></output>
                            <h6>ระดับไฟ</h6>

                            <div class="col-4" style="text-align: center;">
                            <button class="btn btn-primary shadow" style="margin: 1rem 0rem;width: 100%;">บันทีก</button>
                        </div>

                        </div>

                        
                        
                        <!-- <div class="lamp col-2" style="text-align: center;">
                            <img style="width: 80%; position: relative; top: -13px;" class="bulb" id="bulb5" src="img/brightness_ico.png" width="30" alt="">
                        </div>
                         -->
                        </div>

                        


                        

                    

                            <!-- <div style="text-align: left;">
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
                            </div> -->

                        </div>
                        
                    </div>
                    
                </div>
             
                <div align="center" >
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
    
    
    $("#btn_pcon").click(function() {
        alert("On");
    });   
    $("#btn_pcoff").click(function() {
        alert("Off");
    }); 
    $("#btn_fanon").click(function() {
        alert("FanOn");
    });   
    $("#btn_fanoff").click(function() {
        alert("FanOff");
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

<script>
function showimg() {
  var checkBox = document.getElementById("flashingOnRadio");

  if (checkBox.checked == true){
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
}
</script>


<!-- bulb function -->
<script>
    $("#levels").change(function(){
    if($(this).val() == "12") {
      $(".bulb").attr('id', 'bulb10'); 
    } else if($(this).val() == "13") {
        $(".bulb").attr('id', 'bulb20');
    }else if($(this).val() == "14") {
        $(".bulb").attr('id', 'bulb30');
    }else if($(this).val() == "15") {
        $(".bulb").attr('id', 'bulb40');
    }else if($(this).val() == "16") {
        $(".bulb").attr('id', 'bulb50');
    }else if($(this).val() == "17") {
        $(".bulb").attr('id', 'bulb60');
    }else if($(this).val() == "18") {
        $(".bulb").attr('id', 'bulb70');
    }else if($(this).val() == "19") {
        $(".bulb").attr('id', 'bulb80');
    }else if($(this).val() == "20") {
        $(".bulb").attr('id', 'bulb90');
    }else if($(this).val() == "21") {
        $(".bulb").attr('id', 'bulb100');
    }else{
        $(".bulb").attr('id', 'bulb5');
    }
    });
    </script>


<script>
    $(document).on('input change', '#levels2', function() {
    if($(this).val() == "10") {
      $(".bulb").attr('id', 'bulb10'); 
    } else if($(this).val() == "20") {
        $(".bulb").attr('id', 'bulb20');
    }else if($(this).val() == "30") {
        $(".bulb").attr('id', 'bulb30');
    }else if($(this).val() == "40") {
        $(".bulb").attr('id', 'bulb40');
    }else if($(this).val() == "50") {
        $(".bulb").attr('id', 'bulb50');
    }else if($(this).val() == "60") {
        $(".bulb").attr('id', 'bulb60');
    }else if($(this).val() == "70") {
        $(".bulb").attr('id', 'bulb70');
    }else if($(this).val() == "80") {
        $(".bulb").attr('id', 'bulb80');
    }else if($(this).val() == "90") {
        $(".bulb").attr('id', 'bulb90');
    }else if($(this).val() == "100") {
        $(".bulb").attr('id', 'bulb100');
    }else{
        $(".bulb").attr('id', 'bulb5');
    }
    });
    </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>
</html>
