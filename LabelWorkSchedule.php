<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
include "service/privilege.php";

$menucode="008";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ

// if(checkmenu($user,'001')==0)
// {
//     session_destroy();
//     header( "location: index.php" );
//     exit(0);
// }
// if(checkmenu($user,'005')==0){
  
//     header( "location: dashboard.php" );
//     exit(0);
// }else{
//     if($_SESSION["XBDmnIsRead"]==0){
//         header( "location: dashboard.php" );
//         exit(0);
//     }
// }


$sqlCMDBrightness="SELECT * FROM TSysSCommand WHERE XVCmdCode='001'";
$queryCMDBrightness = sqlsrv_query($conn, $sqlCMDBrightness);
$resultCMDBrightness = sqlsrv_fetch_array($queryCMDBrightness, SQLSRV_FETCH_ASSOC);

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
    a.del-item:link {
        color: #595959 !important;
    }
    a.del-item:visited {
        color: #595959 !important;
    }
    a.del-item:hover {
        color: #CC0000 !important;
    }
    a.del-item:focus {
        color: #CC0000 !important;
    }
    a.del-item:active {
        color: #595959 !important;
    }
    input[type='radio']:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #d1d3d1;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    input[type='radio']:checked:after {
        width: 15px;
        height: 15px;
        border-radius: 15px;
        top: -2px;
        left: -1px;
        position: relative;
        background-color: #ffa500;
        content: '';
        display: inline-block;
        visibility: visible;
        border: 2px solid white;
    }

    body {
        background: #e1f0fa;
        }

        .container{
            background: white;
        }

    .flex-container{
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    
table td{
        transition: 0.5s;
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    *{
        box-sizing: border-box;
    }

    table th{
        font-size: 1rem;
        font-weight: 500;
    }

    .table{
        text-align: center;
    }

    table th{
        background-color: #e8f4ff!important;
    }
    
    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

table td {
    border: 1px solid #cccc;
}

table  th {
    border: 1px solid #cccc;
}
</style>

<div class="container" style="position: relative; top: 75;">



<div style="margin: .4rem; text-align: center; border-bottom: 3px double #cccc; padding: 1rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> ตารางการทำงานของป้าย
        </div>

        <?php if($pri_r != 0){ ?>
    <div class="flex-container" >

    <div class="col-12 " style="border-radius: 5px; display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> รายการVMS</a>
        </div>

    <!-- <div class="tab col-12" style="text-align: center;">
        <span  style="width: 100%;" class="tablinks2 active " onclick="openCity2(event, '416160')">รายการ VMS</span>
    </div> -->


    <div id="416160" class="col-12" style="padding:0" id="container">
        <div class="row">
           
          
                <div style="">
                <table class="table table-striped table-hover" style="">
                    <thead>
                    <tr>
                        <th width="78" scope="col">รหัสป้าย</th>
                        <th style="text-align:left;" width="80" scope="col">ชื่อป้าย</th>
                        <th width="150" scope="col"><div align="center">คำสั่งที่ส่ง</div></th>
                        <th width="50" scope="col"><div align="center">รายการ</div></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                    $query = sqlsrv_query($conn, $stmt);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                    {
                        $stmt2 = "SELECT count(*) as crow FROM TDocTCmdSchedule where XVVmsCode='".$result['XVVmsCode']."' and XBSccIsSchedule=1";
                        $query2 = sqlsrv_query($conn, $stmt2);
                        $result2 = sqlsrv_fetch_array($query2, SQLSRV_FETCH_ASSOC);
                    ?>
                    <tr>
                        <td><?php echo $result['XVVmsCode'];?></td>
                        <td style="text-align:left;" ><?php echo $result['XVVmsName'];?></td>
                        <td>

                            <?php
                               $Disable="pointer-events: none;";
                               if($_SESSION["XBDmnIsControl"]==1){
                                  $Disable="";
                               }
                            ?>
                            <div align="center" class="menu">
                                <?php if($pri_w != 0){ ?>
                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalBrightness" style=" height: 35; color: #595959;<?php echo $Disable;?>" onclick="inputBrightnessValue('<?php echo $result['XVVmsCode'];?>')" title="ความสว่างการแสดงผล"><i class="fa fa-yelp fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;

                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalElectrical" style=" height: 35; color: #595959;<?php echo $Disable;?>" onclick="inputElectricalValue('<?php echo $result['XVVmsCode'];?>')" title="ระบบไฟฟ้าป้าย"><i class="fa fa-lightbulb-o fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;

                                <a href="#" class="main-nav-item" data-toggle="modal" data-target="#myModalMornitor" style=" height: 35; color: #595959;<?php echo $Disable;?>" onclick="inputMornitorValue('<?php echo $result['XVVmsCode'];?>')" title="การแสดงผล"><i class="fa fa-object-group fa-lg" aria-hidden="true" style="margin-top:5;"></i></a>&nbsp;&nbsp;&nbsp;
                                <?php } ?>
                            </div></td>

                           
                            <td><div align="center"><a  class="main-nav-item" data-toggle="modal" data-target="#myModalShowData" href="#" onclick="ShowData('<?php echo $result['XVVmsCode'];?>','<?php echo $result['XVVmsName'];?>')" class="main-nav-item"><?php echo $result2['crow'];?></a> </div></td>
                            
                    <?php }?>

                    </tbody>
                </table>
                
            </div>
            <!-- <div class="col-sm-3">
            </div> -->

        </div>
    </div>

    <?php } else{
    echo '<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';
} ?>

    <!--
    <br >
    <div class="tab" style="margin-left: 10px;margin-right: 10px;">
        <div class="tablinks2 active" > &nbsp;<i class="fa fa-list-alt" aria-hidden="true"></i> รายการ</div>
    </div>
    <div class="tabcontent2" style="display: block; margin-left: 10px;margin-right: 10px;">
        <div class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6">


                <table class="table" style="font-size: 10pt">
                    <thead>
                    <tr>
                        <th width="100" scope="col">รหัสป้าย</th>
                        <th width="90" scope="col">ชื่อป้าย</th>
                        <th width="100" scope="col"><div align="left">คำสั่งที่ส่ง</div></th>
                        <th width="20" scope="col"><div align="center">เวลา</div></th>
                        <th width="70" scope="col"><div align="left">วัน</div></th>
                        <th width="5" scope="col"><div align="center"></div></th>

                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = "SELECT TOP 15 * FROM TDocTCmdSchedule 
                            INNER JOIN TMstMItmVMS ON TMstMItmVMS.XVVmsCode=TDocTCmdSchedule.XVVmsCode
                            INNER JOIN TSysSCommand ON TSysSCommand.XVCmdCode=TDocTCmdSchedule.XVCmdCode
                            WHERE TDocTCmdSchedule.XBSccIsSchedule=1 AND TDocTCmdSchedule.XBSccIsDone=0 ORDER BY TMstMItmVMS.XVVmsCode ASC";
                    $query = sqlsrv_query($conn, $stmt);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))  {
                        if($result['XVCmdCode']=='001'){
                            if($result['XVSccValue']==0){
                            $row_value='เซ็ตค่าความสว่าง อัตโนมัติ';
                            }else{
                            $row_value='เซ็ตค่าความสว่าง '.$result['XVSccValue'];
                            }
                        }else if($result['XVCmdCode']=='002'){
                            if($result['XVSccValue']==0){
                                $row_value='ปิดระบบไฟป้าย';
                            }else{
                                $row_value='เปิดระบบไฟป้าย';
                            }
                        }else if($result['XVCmdCode']=='003'){
                            if($result['XVSccValue']==0){
                                $row_value='ปิดระบบการแสดงผล';
                            }else{
                                $row_value='เปิดระบบการแสดงผล';
                            }
                        }

                    if($result['XBSccIsMon']=='1'){ $mon='จ. '; }else{ $mon=''; }
                    if($result['XBSccIsTue']=='1'){ $tue='อ. '; }else{ $tue=''; }
                    if($result['XBSccIsWed']=='1'){ $wen='พ. '; }else{ $wen=''; }
                    if($result['XBSccIsThu']=='1'){ $thu='พฤ. '; }else{ $thu=''; }
                    if($result['XBSccIsFri']=='1'){ $fri='ศ. '; }else{ $fri=''; }
                    if($result['XBSccIsSat']=='1'){ $sat='ส. '; }else{ $sat=''; }
                    if($result['XBSccIsSun']=='1'){ $sun='อา. '; }else{ $sun=''; }

                    ?>
                    <tr id="<?php echo $result['XVSccDocNo'];?>">
                        <td><?php echo $result['XVVmsCode'];?></td>
                        <td><?php echo $result['XVVmsName'];?></td>
                        <td><div align="left"><?php echo $row_value;?></div></td>
                        <td><div align="center"><?php echo $result['XVSccActiveTime'];?></div></td>
                        <td><?php echo $mon.$tue.$wen.$thu.$fri.$sat.$sun;?></td>
                        <td><div align="center" style="margin-top: 4"><a href="#" class="del-item" onclick="delScheule('<?php echo $result['XVSccDocNo'];?>','<?php echo $result['XVVmsCode'];?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div></td>
                    </tr>
                    <?php }?>
                    </tbody>
                </table>



            </div>
            <div class="col-sm-4">
            </div>

        </div>
    </div>
                    -->
    <br >
</div>
</div>
<!--
<div class="modal" id="myModalBrightness" tabindex="-1" role="dialog"style="width: 1100" >
                    -->
<div class="modal py-5"  id="myModalBrightness" role="dialog">
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content">
            <div class="modal-header" style="display: flex; align-items: center; justify-content: center; background-color: #ffffff;">

            <div class="col-11">
                <h5 style="text-align: center;" class="modal-title">ความสว่างการแสดงผล</h5>
                </div>

                <div class="col">
                <button type="button" style="padding: 0;" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>


            <div class="modal-body"  style="background-color: #f5f5f5;">
       
                <input id="bannerIDBrightness" class="input" style="width: 40px;text-align: center;" type="hidden" name="bannerIDBrightness" value="">
                <div class="row" style="">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">เวลาดำเนินการ</div>
                    <div class="col-sm-3" style="margin-left: -20">
                        <input type="text" id="timeBrightness" name="timeBrightness" style="width: 80; text-align: center"  autocomplete="off" class="timeBrightness input">
                    </div>
                </div>
                <div class="row" style="margin-top: 5">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">วันที่ดำเนินการ</div>
                    <div class="col-sm-6" style="margin-top:7px;margin-left:-20px">
                        <table width="101%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><input id="checkboxBrightnessMon" type="checkbox" name="checkboxBrightnessMon" class="checkboxBrightnessMon" value="checkbox" />
                                    Mon</td>
                                <td><input id="checkboxBrightnessTue" type="checkbox" name="checkboxBrightnessTue" class="checkboxBrightnessTue" value="checkbox" />
                                    Tue</td>
                                <td><input id="checkboxBrightnessWed" type="checkbox" name="checkboxBrightnessWed" class="checkboxBrightnessWed" value="checkbox" />
                                    Wed</td>
                                <td><input id="checkboxBrightnessThu" type="checkbox" name="checkboxBrightnessThu" class="checkboxBrightnessThu" value="checkbox" />
                                    Thu</td>
                                <td><input id="checkboxBrightnessFri" type="checkbox" name="checkboxBrightnessFri" class="checkboxBrightnessFri" value="checkbox" />
                                    Fri</td>
                                <td><input id="checkboxBrightnessSat" type="checkbox" name="checkboxBrightnessSat" class="checkboxBrightnessSat" value="checkbox" />
                                    Sat</td>
                                <td><input id="checkboxBrightnessSun" type="checkbox" name="checkboxBrightnessSun" class="checkboxBrightnessSun" value="checkbox" />
                                    Sun</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row"style="margin-top: 15px;margin-bottom:  10px">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2">ดำเนินการ
                   
                    </div>
                    <div class="col-sm-6" style="margin-left: -20px"><input name="radiobuttonBrightness" type="radio" id="RadioBrightness1" value="0"  onclick="displayRadioValue(1)"/> Auto &nbsp;&nbsp;<input name="radiobuttonBrightness" type="radio"   id="RadioBrightness2" value="1" onclick="displayRadioValue(2)" /><label> &nbsp;Manual</label> </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                    </div>
                </div>
                <div class="row" >
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-4 " id="rangeBar" style="display: none;margin-left: -20px;margin-top: -10">
                        <input type="range" min="<?php echo $resultCMDBrightness['XICmdMinValue'];?>" max="<?php echo $resultCMDBrightness['XICmdMaxValue'];?>" value="<?php echo $resultCMDBrightness['XICmdMinValue'];?>" class="slider" id="myRange">
                        <p>(<span id="showRangeValue"></span>)</p>
                    </div>
                    <div class="col-sm-2">
                    </div>
                </div>
                <div align="center" >
                <?php
                       $Disable="disabled";
                       if($_SESSION["XBDmnIsControl"]==1){
                          $Disable="";
                       }
                    ?>
                    <button id="buttonSend" type="button" class="btn btn-success"  onclick="brightnessSend();" <?php echo $Disable;?>>ส่งคำสั่ง</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal py-5"  id="myModalElectrical" role="dialog">
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content" >
            <div class="modal-header" style="display: flex; align-items: center; justify-content: center; background-color: #ffffff;">

            <div class="col-11">
                <h5 style="text-align: center;" class="modal-title">ระบบไฟฟ้าป้าย</h5>
                </div>

                <div class="col">
                <button type="button" style="padding: 0;" class="close" data-dismiss="modal">&times;</button>
                </div>
                
            </div>
            <div class="modal-body" style="background-color: #f5f5f5;">
                <input id="bannerIDElectrical" class="input" style="width: 40px;text-align: center;" type="hidden" name="bannerIDElectrical" value="">
                <div class="row" style="">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">เวลาดำเนินการ</div>
                    <div class="col-sm-3" style="margin-left: -20">
                        <input type="text" id="timeElectrical" name="timeElectrical" style="width: 80; text-align: center"  autocomplete="off" class="timeElectrical input">
                    </div>
                </div>
                <div class="row" style="margin-top: 5">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">วันที่ดำเนินการ</div>
                    <div class="col-sm-6" style="margin-top:7px;margin-left:-20px">
                        <table width="101%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><input id="checkboxElectricalMon" type="checkbox" name="checkboxElectricalMon" class="checkboxElectricalMon" value="checkbox" />
                                    Mon</td>
                                <td><input id="checkboxElectricalTue" type="checkbox" name="checkboxElectricalTue" class="checkboxElectricalTue" value="checkbox" />
                                    Tue</td>
                                <td><input id="checkboxElectricalWed" type="checkbox" name="checkboxElectricalWed" class="checkboxElectricalWed" value="checkbox" />
                                    Wed</td>
                                <td><input id="checkboxElectricalThu" type="checkbox" name="checkboxElectricalThu" class="checkboxElectricalThu" value="checkbox" />
                                    Thu</td>
                                <td><input id="checkboxElectricalFri" type="checkbox" name="checkboxElectricalFri" class="checkboxElectricalFri" value="checkbox" />
                                    Fri</td>
                                <td><input id="checkboxElectricalSat" type="checkbox" name="checkboxElectricalSat" class="checkboxElectricalSat" value="checkbox" />
                                    Sat</td>
                                <td><input id="checkboxElectricalSun" type="checkbox" name="checkboxElectricalSun" class="checkboxElectricalSun" value="checkbox" />
                                    Sun</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row"style="margin-top: 15px;margin-bottom:  10px">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2">ดำเนินการ
                    </div>
                    <div class="col-sm-6" style="margin-left: -20px"><input id="radiobuttonElectricalOn" name="radiobuttonElectrical" type="radio" value="1" /> ON &nbsp;&nbsp;<input id="radiobuttonElectricalOff" name="radiobuttonElectrical" type="radio" value="0" /> OFF </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                    </div>
                </div>
                <div align="center" >
                    <button id="buttonSend" type="button" class="btn btn-success"  id="btnRefresh" onclick="ElectricalSend();">ส่งคำสั่ง</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal py-5"  id="myModalMornitor" role="dialog">
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content">
        <div class="modal-header" style="display: flex; align-items: center; justify-content: center; background-color: #ffffff;">

                <div class="col-11">
                <h5 style="text-align: center;">การแสดงผล</h5>
                </div>

                <div class="col">
                <button type="button" style="padding: 0;" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body" style="background-color: #f5f5f5;">
                <input id="bannerIDMornitor" name="bannerIDMornitor" class="input" style="width: 40px;text-align: center;" type="hidden" value="">
                <div class="row" style="">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">เวลาดำเนินการ</div>
                    <div class="col-sm-3" style="margin-left: -20">
                        <input type="text" id="timeMornitor" name="timeMornitor" style="width: 80; text-align: center"  autocomplete="off" class="timeElectrical input">
                    </div>
                </div>
                <div class="row" style="margin-top: 5">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2" style="margin-top: 5">วันที่ดำเนินการ</div>
                    <div class="col-sm-6" style="margin-top:7px;margin-left:-20px">
                        <table width="101%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                                <td><input id="checkboxMornitorMon" type="checkbox" name="checkboxMornitorMon" class="checkboxMornitorMon" value="checkbox" />
                                    Mon</td>
                                <td><input id="checkboxMornitorTue" type="checkbox" name="checkboxMornitorTue" class="checkboxMornitorTue" value="checkbox" />
                                    Tue</td>
                                <td><input id="checkboxMornitorWed" type="checkbox" name="checkboxMornitorWed" class="checkboxMornitorWed" value="checkbox" />
                                    Wed</td>
                                <td><input id="checkboxMornitorThu" type="checkbox" name="checkboxMornitorThu" class="checkboxMornitorThu" value="checkbox" />
                                    Thu</td>
                                <td><input id="checkboxMornitorFri" type="checkbox" name="checkboxMornitorFri" class="checkboxMornitorFri" value="checkbox" />
                                    Fri</td>
                                <td><input id="checkboxMornitorSat" type="checkbox" name="checkboxMornitorSat" class="checkboxMornitorSat" value="checkbox" />
                                    Sat</td>
                                <td><input id="checkboxMornitorSun" type="checkbox" name="checkboxMornitorSun" class="checkboxMornitorSun" value="checkbox" />
                                    Sun</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row"style="margin-top: 15px;margin-bottom:  10px">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-2">ดำเนินการ
                    </div>
                    <div class="col-sm-6" style="margin-left: -20px"><input id="radiobuttonMornitorOn" name="radiobuttonMornitor" type="radio" value="1" /> Offline &nbsp;&nbsp;<input id="radiobuttonMornitorOff" name="radiobuttonMornitor" type="radio" value="0" /> Online </div>
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2">
                    </div>
                </div>
                <div align="center" >
                    <button id="buttonSend" type="button" class="btn btn-success"  onclick="MornitorSend();">ส่งคำสั่ง</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal py-5"  id="myModalShowData" >
    <div class="modal-dialog modal-lg"  >
        <div class="modal-content">
            <div class="modal-header" >
                <h5 id="ShowData_Title"  class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="ShowData_Body">
               
              
             
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
<script src="dist/js/labelWork.js"></script>




<script src="dist/js/main_speed.js"></script>

<script src="dist/js/dataTables.js"></script>
<script src="dist/js/dataTables.bootstrap4.js"></script>
<script>
    var slider = document.getElementById("myRange");
    var output = document.getElementById("showRangeValue");
    output.innerHTML = slider.value;

    slider.oninput = function() {
        output.innerHTML = this.value;
    }
    function delScheule(e,b){
        Swal.fire({
        title: "",
        text: "ต้องการลบใช่หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่",
        cancelButtonText: "ยกเลิก",
       
        }).then((result) => {
        if (result.isConfirmed) {
            $.post("lib/processScheduleDel.php", {'XVSccDocNo':e,'vmsID':b}, function(result){
            
               window.location.href = 'LabelWorkSchedule.php';
            });
           
        }
        });
       
        
    }
    function displayRadioValue() {
      
        var radioButtonGroup = document.getElementsByName("radiobuttonBrightness");
        
        var checkedRadio = Array.from(radioButtonGroup).find(
            (radio) => radio.checked
        );
       
        if(checkedRadio.value==0){
            document.getElementById("myRange").value =<?php echo $resultCMDBrightness['XICmdMinValue'];?>;
            document.getElementById("rangeBar").style.display = "none";
            var output = document.getElementById("showRangeValue");
            output.innerHTML = <?php echo $resultCMDBrightness['XICmdMinValue'];?>;
        }else if(checkedRadio.value==1){
            document.getElementById("rangeBar").style.display = "block";
        }
    }
function brightnessSend(){
        var time=document.getElementById('timeBrightness').value;
        if(time==""){
            Swal.fire({
                title: "",
                text: "กรุณาเลือกเวลาดำเนินการ",
                icon: "warning"
            });
            return false;
        }
        var myRange=document.getElementById('myRange').value;
        var vmsID=document.getElementById('bannerIDBrightness').value;
        var mon=document.querySelector('.checkboxBrightnessMon').checked;
        var tue=document.querySelector('.checkboxBrightnessTue').checked;
        var wed=document.querySelector('.checkboxBrightnessWed').checked;
        var thu=document.querySelector('.checkboxBrightnessThu').checked;
        var fri=document.querySelector('.checkboxBrightnessFri').checked;
        var sat=document.querySelector('.checkboxBrightnessSat').checked;
        var sun=document.querySelector('.checkboxBrightnessSun').checked;
        
        if((mon==true)||(tue==true)||(wed==true)||(thu==true)||(fri==true)||(sat==true)||(sun==true)){
          
            var ck=0;
            if ($('#RadioBrightness1').is(":checked"))
            {
               ck=1;
                
            }
            if ($('#RadioBrightness2').is(":checked"))
            {
               ck=2; 
            }
            if(ck==0){
                Swal.fire({
                    title: "",
                    text: "กรุณาเลือกดำเนินการ",
                    icon: "warning"
                });
                return false; 
            }
            var radiobutton=document.querySelector('input[name="radiobuttonBrightness"]:checked').value;

        }else{
            Swal.fire({
                title: "",
                text: "กรุณาเลือกวันที่ดำเนินการ",
                icon: "warning"
            });
            return false;
        }
     
    $.ajax({
        type: 'POST',
        url: 'lib/processScheduleBrightness.php',
        data: {'vmsID':vmsID,'radiobutton':radiobutton,'time':time,'myRange':myRange,'mon':mon,'tue':tue,'wed':wed,'thu':thu,'fri':fri,'sat':sat,'sun':sun},
        success: function(result) {
            if(result=="Success"){
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        
                            }).then((result) => {
                        
                            if (result.isConfirmed) {
                            
                                window.location.href = 'LabelWorkSchedule.php';
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
                            
                                window.location.href = 'LabelWorkSchedule.php';
                            }
                        });
                    }
           
        },
    });
    
}

    function ElectricalSend(){
     
        var vmsID=document.getElementById('bannerIDElectrical').value;
        var time=document.getElementById('timeElectrical').value;
        if(time==""){
            Swal.fire({
                title: "",
                text: "กรุณาเลือกเวลาดำเนินการ",
                icon: "warning"
            });
            return false;
        }
        var mon=document.querySelector('.checkboxElectricalMon').checked;
        var tue=document.querySelector('.checkboxElectricalTue').checked;
        var wed=document.querySelector('.checkboxElectricalWed').checked;
        var thu=document.querySelector('.checkboxElectricalThu').checked;
        var fri=document.querySelector('.checkboxElectricalFri').checked;
        var sat=document.querySelector('.checkboxElectricalSat').checked;
        var sun=document.querySelector('.checkboxElectricalSun').checked;
        if((mon==true)||(tue==true)||(wed==true)||(thu==true)||(fri==true)||(sat==true)||(sun==true)){
            var ck=0;
            if ($('#radiobuttonElectricalOn').is(":checked"))
            {
               ck=1;
                
            }
            if ($('#radiobuttonElectricalOff').is(":checked"))
            {
               ck=2; 
            }
            if(ck==0){
                Swal.fire({
                    title: "",
                    text: "กรุณาเลือกดำเนินการ",
                    icon: "warning"
                });
                return false; 
            }
          
            var radiobutton=document.querySelector('input[name="radiobuttonElectrical"]:checked').value;
          
        }else{
            Swal.fire({
                title: "",
                text: "กรุณาเลือกวันที่ดำเนินการ",
                icon: "warning"
            });
            return false;
        }
  
        $.ajax({
            type: 'POST',
            url: 'lib/processScheduleElectrical.php',
            data: {'vmsID':vmsID,'radiobutton':radiobutton,'time':time,'mon':mon,'tue':tue,'wed':wed,'thu':thu,'fri':fri,'sat':sat,'sun':sun},
            success: function(result) {
                if(result=="Success"){
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        
                            }).then((result) => {
                        
                            if (result.isConfirmed) {
                            
                                window.location.href = 'LabelWorkSchedule.php';
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
                            
                                window.location.href = 'LabelWorkSchedule.php';
                            }
                        });
                    }
            },
        });
       
    }

    function MornitorSend(){
        var vmsID=document.getElementById('bannerIDMornitor').value;
        var time=document.getElementById('timeMornitor').value;
        if(time==""){
            Swal.fire({
                title: "",
                text: "กรุณาเลือกเวลาดำเนินการ",
                icon: "warning"
            });
            return false;
        }
        var mon=document.querySelector('.checkboxMornitorMon').checked;
        var tue=document.querySelector('.checkboxMornitorTue').checked;
        var wed=document.querySelector('.checkboxMornitorWed').checked;
        var thu=document.querySelector('.checkboxMornitorThu').checked;
        var fri=document.querySelector('.checkboxMornitorFri').checked;
        var sat=document.querySelector('.checkboxMornitorSat').checked;
        var sun=document.querySelector('.checkboxMornitorSun').checked;
        if((mon==true)||(tue==true)||(wed==true)||(thu==true)||(fri==true)||(sat==true)||(sun==true)){
            var ck=0;
            if ($('#radiobuttonMornitorOn').is(":checked"))
            {
               ck=1;
                
            }
            if ($('#radiobuttonMornitorOff').is(":checked"))
            {
               ck=2; 
            }
            if(ck==0){
                Swal.fire({
                    title: "",
                    text: "กรุณาเลือกดำเนินการ",
                    icon: "warning"
                });
                return false; 
            }
            var radiobutton=document.querySelector('input[name="radiobuttonMornitor"]:checked').value;
        }else{
            Swal.fire({
                title: "",
                text: "กรุณาเลือกวันที่ดำเนินการ",
                icon: "warning"
            });
            return false;
        }
        $.ajax({
            type: 'POST',
            url: 'lib/processScheduleMornitor.php',
            data: {'vmsID':vmsID,'radiobutton':radiobutton,'time':time,'mon':mon,'tue':tue,'wed':wed,'thu':thu,'fri':fri,'sat':sat,'sun':sun},
            success: function(result) {
                   if(result=="Success"){
                        Swal.fire({
                            title: "",
                            text: "ส่งคำสั่งสำเร็จ",
                            icon: "success",
                            confirmButtonText: "ตกลง",
                        
                            }).then((result) => {
                        
                            if (result.isConfirmed) {
                            
                                window.location.href = 'LabelWorkSchedule.php';
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
                            
                                window.location.href = 'LabelWorkSchedule.php';
                            }
                        });
                    }
               
            },
        });
    }
   function ShowData(VmsCode,VmsName){
    
      $.ajax({
            type: 'POST',
            url: 'LabelWorkScheduleList.php',
            data: {'code':VmsCode},
            success: function(msg) {
                
                $( "#ShowData_Body" ).html(msg);
                $( "#ShowData_Title" ).text(VmsName);
               
                new DataTable('#TableShowList', {
                        ordering: false,
                        "oLanguage": {
                            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                        }
                });
            
              
            },
        });

   }
 
</script>
</body>
</html>
