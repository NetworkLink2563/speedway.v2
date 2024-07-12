<?php
include 'header.php';
include "lib/DatabaseManage.php";

$vmsID=$_GET['vmsid'];
$vmsID=base64_decode($vmsID);
//$sql = "SELECT TMstMMsgSize.XIMssWPixel,TMstMMsgSize.XIMssHPixel,TMstMItmVMS.XVVmsSize FROM TMstMItmVMS INNER JOIN TMstMMsgSize ON TMstMMsgSize.XVMssCode=TMstMItmVMS.XVMssCode WHERE TMstMItmVMS.XVVmsCode='".$vmsID."'";
$sql = "SELECT * FROM TMstMItmVMS  WHERE XVVmsCode='".$vmsID."'";
$query = sqlsrv_query($conn, $sql);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

$XIVmsPixelW=$result['XIVmsPixelW'];
$XIVmsPixelH=$result['XIVmsPixelH'];
$source="";
$delay="";
$countsource=0;
$source="";
$delay="";
$XIVdoDurationVdo="";
$XVMsgFileName="";
$XVMsgHtml="";
$XVMsgCode="";
$XVMsgName="";
?>
<style>
.Neon {
    font-family: sans-serif;
    font-size: 14px;
    color: #494949;
    position: relative;


}

.Neon * {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}

.Neon-input-dragDrop {
    display: block;
    width: 343px;
    margin: 0 auto 25px auto;
    padding: 25px;
    color: #8d9499;
    color: #97A1A8;
    background: #fff;
    border: 2px dashed #C8CBCE;
    text-align: center;
    -webkit-transition: box-shadow 0.3s, border-color 0.3s;
    -moz-transition: box-shadow 0.3s, border-color 0.3s;
    transition: box-shadow 0.3s, border-color 0.3s;
}

.Neon-input-dragDrop .Neon-input-icon {
    font-size: 48px;
    margin-top: -10px;
    -webkit-transition: all 0.3s ease;
    -moz-transition: all 0.3s ease;
    transition: all 0.3s ease;
}

.Neon-input-text h3 {
    margin: 0;
    font-size: 18px;
}

.Neon-input-text span {
    font-size: 12px;
}

.Neon-input-choose-btn.blue {
    color: #008BFF;
    border: 1px solid #008BFF;
}

.Neon-input-choose-btn {
    display: inline-block;
    padding: 8px 14px;
    outline: none;
    cursor: pointer;
    text-decoration: none;
    text-align: center;
    white-space: nowrap;
    font-size: 12px;
    font-weight: bold;
    color: #8d9496;
    border-radius: 3px;
    border: 1px solid #c6c6c6;
    vertical-align: middle;
    background-color: #fff;
    box-shadow: 0px 1px 5px rgba(0, 0, 0, 0.05);
    -webkit-transition: all 0.2s;
    -moz-transition: all 0.2s;
    transition: all 0.2s;
}

ol.menu {
    list-style-type: none;
    display: table;
    float: none;
    margin: 0 auto;
}

.menu li {
    display: inline;
    white-space: nowrap;
}

.menu span {
    float: left;
    display: table;
    padding: 2px;
    cursor: pointer;
}

.button {
    /* ปุ่มเลือกสี ปกติ */
    margin: 1px;
}

.hover {
    /* ปุ่มเลือกสี เมื่อเมาส์อยู่บน */
    background: #D3E4F5;
    border: 1px solid #167FB2;
    margin: 0;
}

.current {
    /* ปุ่มเลือกสี เมื่อเลือก */
    background: #D3E4F5;
    border: 1px solid #167FB2;
    margin: 0;
}

.drop-container {
    position: relative;
    display: flex;
    gap: 10px;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 200px;
    padding: 20px;
    border-radius: 10px;
    border: 2px dashed #555;
    color: #444;
    cursor: pointer;
    transition: background .2s ease-in-out, border .2s ease-in-out;
}

.drop-container:hover {
    background: #eee;
    border-color: #111;
}

.drop-container:hover .drop-title {
    color: #222;
}

.drop-title {
    color: #444;
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    transition: color .2s ease-in-out;
}

::-webkit-file-upload-button {
    display: none;
}

input[type='file'] {
    font-size: 0;
}

::file-selector-button {
    font-size: initial;
}

.modal-dialog {
    max-width: 1000px;
  
}
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">
  
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่ม/แก้ไขรายการข้อความ
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <button class="tablinks active"
                onclick="openTab(event, 'TextAuto');clearContent('Text');">จากรายการข้อความหลัก</button>
            <button class="tablinks " onclick="openTab(event, 'Text');clearContent('Text');">ข้อความกำหนดเอง</button>
            <button class="tablinks" onclick="openTab(event, 'Picture');clearContent('Picture');">รูปภาพ</button>
            <button class="tablinks" onclick="openTab(event, 'Movement');clearContent('Movement');">วีดีโอ</button>
           
                               
                           
                                
                                
                                <button style=" float: right;" type="button" onclick="sendmessageToVMS()" class="btn btn-warning"><i class="fa fa-cloud-upload"
                                        aria-hidden="true"></i>ส่งข้อความขึ้นป้าย</button>
                                        <button style=" float: right;" type="button" onclick="ShowEx()" class="btn btn-warning"><i class="fa fa-search"
                                        aria-hidden="true"></i>แสดงตัวอย่าง</button>
                           
                                
                            
        </div>
        <div id="TextAuto" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;">
            <form method="post" action="" enctype="multipart/form-data" id="myformAuto">

                <div class="row" style="margin-top: 10">

                    <div class="col-sm-3 p-2">
                        <div id="tableLoadMain"
                            style="border-style: solid;border-color:F5F5F2;margin:5px;padding:5px;border-width: 2px;">
                            <table id="UserTable1" class="table" style="width:100%; font-size: 10pt">
                                <thead>
                                    <tr style="font-size: 10pt">
                                        <th class="th-sm" width="200">ชื่อข้อความ</th>
                                        <th class="th-sm" style="text-align: center">ประเภท</th>
                                        <th class="th-sm" style="text-align: center">ตัวอย่าง</th>
                                        <th class="th-sm" style="text-align: center">เลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                          
                        
                        $sqlauto2 = "SELECT        dbo.TMstMMessage.XVMsgCode, dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMssCode, dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgFileName, 
                        dbo.TMstMMessage.XVMsgStatus, dbo.TMstMMessage.XVMsgBg, dbo.TMstMMessage.XVWhoCreate, dbo.TMstMMessage.XVWhoEdit, dbo.TMstMMessage.XTWhenCreate, dbo.TMstMMessage.XTWhenEdit, 
                        dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMItmVMS.XVVmsCode
FROM            dbo.TMstMItmVMS INNER JOIN
                        dbo.TMstMMsgSize ON dbo.TMstMItmVMS.XVMssCode = dbo.TMstMMsgSize.XVMssCode INNER JOIN
                        dbo.TMstMMessage ON dbo.TMstMMsgSize.XVMssCode = dbo.TMstMMessage.XVMssCode
WHERE        (dbo.TMstMItmVMS.XVVmsCode = '$vmsID')";

                            $queryauto2 = sqlsrv_query($conn, $sqlauto2);
                            while($resultauto2 = sqlsrv_fetch_array($queryauto2, SQLSRV_FETCH_ASSOC)){
                                    if( $resultauto2['XVMsgType']==1){
                                        $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                                    }elseif( $resultauto2['XVMsgType']==2){
                                        $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                                    }elseif( $resultauto2['XVMsgType']==3){
                                        $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                                    }

                             
                                 ?>
                                    <tr>
                                        <td style="text-align: left;vertical-align: middle;word-wrap: break-word;"><?php echo $resultauto2['XVMsgName'];?></td>
                                        <td style="text-align: center;vertical-align: middle;"> <?php echo $XVMsgType;?></td>

                                        <td style="text-align: center;vertical-align: middle;">
                                            <div align="center"><a
                                                    href="<?php echo 'ifarme.php?msg='.base64_encode($resultauto2['XVMsgCode']);?>"
                                                    onclick="return show_modal(this,'<?php echo $resultauto2['XVMsgName'];?>','<?php echo $resultauto2['XIMssWPixel'];?>','<?php echo $resultauto2['XIMssHPixel'];?>');"
                                                    style="color: #0a0a0a"><i class="fa fa-search"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" class="msgcode" id="msgcode[]"
                                                name="msgcode[]" value="<?php echo $resultauto2['XVMsgCode'];?>"></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="col-sm-1  d-flex w-100 justify-content-center align-self-center" ><label class="contentB center"><span onclick="ModalloadData()"><img
                                    src="img/icon/arrow_right.png" width="50" height="50" style="cursor:pointer"></span><br><span
                                onclick="loadData('<?php echo $vmsID;?>','restore');"><img src="img/icon/arrow_left.png"
                                width="50" height="50" style="cursor:pointer"></span></label>
                    </div>
                    <div class="col-sm-8">

                        <div id="tableLoad"
                            style="border-style: solid;border-color:F5F5F2;margin:5px;padding:5px;border-width: 2px;">
                            <div class="table-responsive">
                            <table id="UserTable2" class="table " style="width:100%; font-size: 10pt">
                                <thead>
                                    <tr style="font-size: 10pt">
                                        <th class="th-sm" style="text-align: left" width="200">ชื่อข้อความ</th>
                                        <th class="th-sm" style="text-align: center">ประเภท</th>
                                        <th class="th-sm" style="text-align: center">ลำดับ</th>
                                        <th class="th-sm" style="text-align: center"></th>
                                        <th class="th-sm" style="text-align: center">ตัวอย่าง</th>
                                        <th class="th-sm" style="text-align: center">ตั้งเวลา</th>
                                        <th class="th-sm" style="text-align: left">เริ่ม</th>
                                        <th class="th-sm" style="text-align: left">สิ้นสุด</th>
                                        <th class="th-sm" style="text-align: center">เวลา</th>
                                        <th class="th-sm" style="text-align: center">เลือก</th>
                                        <th class="th-sm" style="text-align: center">บันทึก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                            $sqlauto1 = "SELECT        dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgCode, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgStart, 120) AS XTVmgStart, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgEnd, 120) 
                            AS XTVmgEnd, dbo.TMstMItmVMSMessage.XIVmgDuration, dbo.TMstMItmVMSMessage.XBVmgHasExpiration, dbo.TMstMMessage.XVMsgType, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, 
                            dbo.TMstMItmVMSMessage.XIVmgOrder, dbo.TMstMMessage.XVMsgFileName
   FROM            dbo.TMstMItmVMSMessage INNER JOIN
                            dbo.TMstMMessage ON dbo.TMstMMessage.XVMsgCode = dbo.TMstMItmVMSMessage.XVMsgCode INNER JOIN
                            dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode

                                         WHERE TMstMItmVMSMessage.XVVmsCode='".$vmsID."' order by XIVmgOrder";
                            $queryauto1 = sqlsrv_query($conn, $sqlauto1);
                            while($resultauto1 = sqlsrv_fetch_array($queryauto1, SQLSRV_FETCH_ASSOC)){
                                     $countsource++;
                                     $disabled="";
                                    if($resultauto1['XBVmgHasExpiration']!=0){
                                       $dateS=$resultauto1['XTVmgEnd'];
                                       $dateE=$resultauto1['XTVmgEnd'];
                                       $XBVmgHasExpirationCheck="checked";
                                       $disabled="";
                                    }else{
                                        $dateS="";
                                        $dateE="";
                                        $XBVmgHasExpirationCheck="";
                                        $disabled="disabled";
                                    }
                                    if( $resultauto1['XVMsgType']==1){
                                        $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                                    }elseif( $resultauto1['XVMsgType']==2){
                                        $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                                    }elseif( $resultauto1['XVMsgType']==3){
                                        $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                                    }
                                    $id1='1'.$resultauto1['XVMsgCode'].$resultauto1['XIVmgOrder'];
                                    $id2='2'.$resultauto1['XVMsgCode'].$resultauto1['XIVmgOrder'];
                                    $id3='3'.$resultauto1['XVMsgCode'].$resultauto1['XIVmgOrder'];
                                    $id4='4'.$resultauto1['XVMsgCode'].$resultauto1['XIVmgOrder'];

                                    $XVMsgCode.=$resultauto1['XVMsgCode'].',';
                                    $source.=$resultauto1['XVMsgFileName'].',';
                                    $delay.=$resultauto1['XIVmgDuration'].',';
                                    $XVMsgName.=$resultauto1['XVMsgName'].',';
                                   // $XIVdoDurationVdo.=$result_row['XIVdoDurationVdo'].',';
                                    //$XVMsgFileName=$result_row['XVMsgFileName'];
                                    
                                ?>
                                    <tr>
                                        <td style="text-align: left;vertical-align: middle;word-wrap: break-word;"><?php echo $resultauto1['XVMsgName'];?></td>
                                        <td style="text-align: center;vertical-align: middle;"> <?php echo $XVMsgType;?></td>
                                        <td style="text-align: center;vertical-align: middle;"> <?php echo $resultauto1['XIVmgOrder'];?></td>
                                        <td>
                                        <a href="#"
                                                onclick="processSeqNo('<?php echo $resultauto1['XVMsgCode'];?>','DOWN','<?php echo $vmsID;?>');"><i
                                                    class="fa fa-caret-down" aria-hidden="true"
                                                    style="color: red; font-size: 24px;"></i></a>
                                                    <a href="#"
                                                onclick="processSeqNo('<?php echo $resultauto1['XVMsgCode'];?>','UP','<?php echo $vmsID;?>');"><i
                                                    class="fa fa-caret-up" aria-hidden="true"
                                                    style="color: green; font-size: 24px;"></i></a>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <div align="center"><a
                                                    href="<?php echo 'ifarme.php?msg='.base64_encode($resultauto1['XVMsgCode']);?>"
                                                    onclick="return show_modal(this,'<?php echo $resultauto1['XVMsgName'];?>','<?php echo $resultauto1['XIMssWPixel'];?>','<?php echo $resultauto1['XIMssHPixel'];?>');"
                                                    style="color: #0a0a0a"><i class="fa fa-search"
                                                        aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;"><div style="text-left: center"><input onclick="CheckBox('<?php echo $id1;?>','<?php echo $id2;?>','<?php echo $id3;?>')" type="checkbox" id="<?php echo $id1;?>" <?php echo $XBVmgHasExpirationCheck;?>></div></td>
                                        <td style="text-align: center;vertical-align: middle;"><div class="input-group">
                                       
                                        <div class="input-group-append">
                                        <input class="datetimepicker" type="text" <?php echo $disabled;?> style="min-width: 50px;" id="<?php echo $id2;?>"  value="<?php echo $dateS;?>">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div></td>
                                        <td style="text-align: center;vertical-align: middle;"><div class="input-group">
                                      
                                        <div class="input-group-append">
                                        <input class="datetimepicker " style="min-width: 50px;" type="text" <?php echo $disabled;?> id="<?php echo $id3;?>"  value="<?php echo $dateE;?>">
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>        </td>
                                        <td style="text-align: center;vertical-align: middle;">
                                            <input type="number"  id="<?php echo $id4;?>" style="width: 50px;" class="XIVmgDuration " value="<?php echo $resultauto1['XIVmgDuration'];?>"/>
                                        </td>
                                        <td style="text-align: center;vertical-align: middle;"> <input type="checkbox" class="msgcodeRestore"
                                                id="msgcodeRestore[]" name="msgcodeRestore[]"
                                                value="<?php echo $resultauto1['XVMsgCode'];?>"></td>
                                        <td style="text-align: center;vertical-align: middle;">
                                        <div align="center"><a href="#"  
                                                onclick="SaveMSG('<?php echo $resultauto1['XVMsgCode']; ?>','<?php echo $vmsID; ?>','<?php echo $resultauto1['XIVmgOrder']; ?>');"><i
                                                    style="font-size:24px;color: #8d9499" class="fa fa-save" aria-hidden="true"></i></a></div>
                                        </td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                          </div>
                        </div>

                    </div>
                </div>
                <div class="row" style="margin-top: 10">
                    <div class="col-sm-12" style="margin-left: -10;">
                        <div style="text-align: center">
                            <a href="Schedulemessage.php?vmc=<?php echo  $_REQUEST["vmsid"];?>"
                                class="btn btn-primary">กลับ</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <div id="Text" class="tabcontent" style=" margin-left: 10px;margin-right: 10px;">

            <input id="msgBG" type="hidden" value="">
            <input id="bgcolor" type="hidden" value="">
            <input id="usercolor" type="hidden" value="">
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-1">
                    <div style="margin-top: 5px"><label>ป้าย VMS</label></div>
                </div>
                <div class="col-sm-3"><input style="border-style: none;" id="vmsCode" class="input"
                        value='<?php echo $vmsID;?>' autocomplete="off" readonly> <label
                        style="font-size: 10pt"><?php echo $result['XIVmsPixelW']; ?>x<?php echo $result['XIVmsPixelH']; ?>
                        px</label>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-1">
                    <div style="margin-top: 5px"><label>ชื่อข้อความ</label></div>
                </div>
                <div class="col-sm-3"><input id="nameMSG" class="input" value="" autocomplete="off">
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-1">
                    <div style="margin-top: 5px"><label>การทำงาน</label></div>
                </div>
                <div class="col-sm-4" style="margin-left: -0;">
                    <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox"
                            class="messageCheckboxManual" id="messageCheckboxManual" name="messageCheckboxManual"
                            value="1" onclick="activityWorkManual(1)"> กำหนดช่วงสิ้นสุด
                    </div>
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-1">
                    <div style="margin-top: 5px"><label>ระยะเวลา</label></div>
                </div>
                <div class="col-sm-7" style="margin-left: -0;">
                    <input id="inputTimerManual" class="input" style="width: 40px;text-align: center;" type="text"
                        name="inputTimer" autocomplete="off"
                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                    วินาที
                </div>
            </div>
            <div id="showDateManual" style="display: none">
                <div class="row" style="margin-top: 10">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1" style="margin-top: 5px">วันที่เริ่ม
                    </div>
                    <div class="col-sm-7" style="margin-left: 0;">
                        <div class="col-sm-" style="margin-top: 0px;margin-left: 0px"><input type="text"
                                id="datetimepicker3" style="width: 145" autocomplete="off" class="input datetimepicker form-control">
                            &nbsp;&nbsp;วันที่สิ้นสุด <input   type="text" id="datetimepickerend3" style="width: 145"
                                autocomplete="off" class="input datetimepicker form-control">
                        </div>
                    </div>
                </div>
            </div><br>
            <div class="row" style="margin-top: -10">
                <div class="col-sm-4">
                    <input id="vms" type="hidden" value="<?php echo $vmsID;?>">
                    <input id="vmsSize" type="hidden" value="<?php echo $result['XVMssCode'];?>">
                    <input id="msgBG" type="hidden" value="">
                    <input id="bgcolor" type="hidden" value="">
                    <input id="usercolor" type="hidden" value="">
                </div>
                <div class="col-sm-1" style="margin-top: 5px">สีพื้นหลัง
                </div>
                <div class="col-sm-3" style="margin-left: -80;">

                    <ol class="menu">
                        <?php
                        //กำหนดโค้ดสีที่ต้องการลงใน array
                        $color= array("#0a0a0a", "maroon", "#F60310", "#E76E14", "#E7C514", "#1DDC12", "#148CE7", "#6C1CEA");
                        for ($i = 0; $i < count($color); $i++) {
                            echo "<li><span id=\"color$i\" title=\"$color[$i]\" class=\"button\"><font class=\"btncolor\" style=\"background-color:$color[$i];color:$color[$i]; \" >Yy</font></span></li>";
                        }
                        ?>
                    </ol>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-7"><textarea id="detailck" style="overflow: hidden;">
	</textarea></div>
            </div>
            <div class="row" style="margin-top: 10">
                <div class="col-sm-12" style="margin-left: -10;">
                    <div style="text-align: center">
                        <button type="submit" class="btn btn-primary" onclick="previewNextStep();">เพิ่มข้อความ</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="Picture" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <form method="post" action="" enctype="multipart/form-data" id="myformImg">
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1">
                        <div style="margin-top: 5px"><label>ป้าย VMS</label></div>
                    </div>
                    <div class="col-sm-3"><input id="vmsCodeImg" name="vmsCodeImg" class="input"
                            value='<?php echo $vmsID;?>' autocomplete="off" readonly> <label
                            style="font-size: 10pt"><?php echo $result['XIVmsPixelW']; ?>x<?php echo $result['XIVmsPixelH']; ?>
                            px</label>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1">
                        <div style="margin-top: 5px"><label>ชื่อข้อความ</label></div>
                    </div>
                    <div class="col-sm-3"><input id="nameMSGImg" name="nameMSGImg" class="input" value=""
                            autocomplete="off">
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1">
                        <div style="margin-top: 5px"><label>การทำงาน</label></div>
                    </div>
                    <div class="col-sm-4" style="margin-left: -0;">
                        <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox"
                                class="messageCheckboxManualImg" id="messageCheckboxManualImg"
                                name="messageCheckboxManualImg" value="1" onclick="activityWorkManualImg(1)">
                            กำหนดช่วงสิ้นสุด
                        </div>
                    </div>
                </div>
                <div class="row" style="margin-top: 10px">
                    <div class="col-sm-4">
                    </div>
                    <div class="col-sm-1">
                        <div style="margin-top: 5px"><label>ระยะเวลา</label></div>
                    </div>
                    <div class="col-sm-7" style="margin-left: -0;">
                        <input id="inputTimerImg" class="input" style="width: 40px;text-align: center;" type="text"
                            name="inputTimerImg" autocomplete="off"
                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                        วินาที
                    </div>
                </div>
                <div id="showDateImg" style="display: none">
                    <div class="row" style="margin-top: 10">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1" style="margin-top: 5px">วันที่เริ่ม
                        </div>
                        <div class="col-sm-7" style="margin-left: 0;">
                            <div class="col-sm-" style="margin-top: 0px;margin-left: 0px"><input type="text"
                                    id="datetimepicker2" name="datetimepicker2" style="width: 145" autocomplete="off"
                                    class="input datetimepicker form-control"> &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerend2"
                                    name="datetimepickerend2" style="width: 145" autocomplete="off" class="input datetimepicker form-control">
                            </div>
                        </div>
                    </div>
                </div>

                <br>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" style="margin-top: 5px">
                        <div class="container">
                            <div class="card">
                                <label for="filer_input2" class="drop-container" id="dropcontainer">
                                    <i class="fa fa-arrow-circle-o-up" style="font-size:48px;color:#212529;"></i>
                                    <span class="drop-title">คลิกเลือกไฟล์</span>
                                    <h6 id="h4fname"></h6>

                                    <input type="file" id="filer_input2" name="filer_input2" accept="image/*"
                                        required>';


                                    <button type="submit" id="btnsubmitimg" class="btn btn-primary">บันทึก</button>
                                </label>

                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
        <div id="Movement" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
            <div style="border-style: solid;border-color:F5F5F2;margin:5px;padding:5px;border-width: 2px;">
                <form method="post" action="" enctype="multipart/form-data" id="myformANI">
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                            <div style="margin-top: 5px"><label>ป้าย VMS</label></div>
                        </div>
                        <div class="col-sm-3"><input style="border-style: none;" id="vmsCodeANI" name="vmsCodeANI"
                                class="input" value='<?php echo $vmsID;?>' autocomplete="off" readonly> <label
                                style="font-size: 10pt"><?php echo $result['XIVmsPixelW']; ?>x<?php echo $result['XIVmsPixelH']; ?>
                                px</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                            <div style="margin-top: 5px"><label>ชื่อข้อความ</label></div>
                        </div>
                        <div class="col-sm-3"><input id="nameMSGANI" name="nameMSGANI" class="input" value=""
                                autocomplete="off">
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                            <div style="margin-top: 5px"><label>การทำงาน</label></div>
                        </div>
                        <div class="col-sm-4" style="margin-left: -0;">
                            <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox"
                                    class="messageCheckboxManualANI" id="messageCheckboxManualANI"
                                    name="messageCheckboxManualANI" value="1" onclick="activityWorkManualANI(1)">
                                กำหนดช่วงสิ้นสุด
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;padding:10px">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-1">
                            <div style="margin-top: 5px"><label>ระยะเวลา</label></div>
                        </div>
                        <div class="col-sm-7" style="margin-left: -0;">
                            <input id="inputTimerANI" class="input" style="width: 40px;text-align: center;" type="text"
                                name="inputTimerANI" autocomplete="off"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                            วินาที
                        </div>
                    </div>
                    <div id="showDateANI" style="display: none">
                        <div class="row" style="margin-top: 10">
                            <div class="col-sm-4">
                            </div>
                            <div class="col-sm-1" style="margin-top: 5px">วันที่เริ่ม
                            </div>
                            <div class="col-sm-7" style="margin-left: 0;">
                                <div class="col-sm-" style="margin-top: 0px;margin-left: 0px"><input type="text"
                                        id="datetimepicker4" name="datetimepicker4" style="width: 145"
                                        autocomplete="off" class="input datetimepicker"> &nbsp;&nbsp;วันที่สิ้นสุด <input type="text"
                                        id="datetimepickerend4" name="datetimepickerend4" style="width: 145"
                                        autocomplete="off" class="input datetimepicker">
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-6" style="margin: 10px">
                            <div class="container">
                                <div class="card">
                                   
                                    <label for="filer_inputANI" class="drop-container" id="dropcontainer">
                                    <br>
                                        <i class="fa fa-arrow-circle-o-up" style="font-size:48px;color:#212529;"></i>
                                        <span class="drop-title">คลิกเลือกไฟล์</span>
                                        <h6 id="h5fname"></h6>
                                        <input type="file" name="filer_inputANI" id="filer_inputANI" accept="video/*"
                                            required>';
                                        <button type="submit" id="btnsubmitvdo" class="btn btn-primary">บันทึก</button>
                                        <br>
                                    </label>

                                </div>
                            </div>
                        </div>

                    </div>
                    
                </form>
            </div>
        </div>
        <br>
    </div>
</div>

<div class="modal py-5" id="myModalSave" role="dialog">
    <div class="modal-dialog modal-lg" >
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <div style="border-style: solid;border-color:F5F5F2;margin:5px;padding:5px;border-width: 2px;">
                    <div class="row" style="margin-top: 10px">

                        <div class="col-sm-4">
                            <div style="margin-top: 5px"><label>ป้าย VMS</label></div>
                        </div>
                        <div class="col-sm-8 text-left"><input style="border-style: none;" id="vmsCodeAuto"
                                name="vmsCodeAuto" class="input" value='<?php echo $vmsID;?>' autocomplete="off"
                                readonly> <label
                                style="font-size: 10pt"><?php echo  $result['XVVmsName']." ขนาด ".$result['XIVmsPixelW']; ?>x<?php echo $result['XIVmsPixelH']; ?>
                                px</label>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">

                        <div class="col-sm-4">
                            <div style="margin-top: 5px"><label>การทำงาน</label></div>
                        </div>
                        <div class="col-sm-8 text-left" style="margin-left: -0;">
                            <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input type="checkbox"
                                    class="messageCheckboxAuto" id="messageCheckboxAuto" name="messageCheckboxAuto"
                                    value="1" onclick="activityWorkAuto(1)"> กำหนดช่วงสิ้นสุด
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px">

                        <div class="col-sm-4">
                            <div style="margin-top: 5px"><label>ระยะเวลา</label></div>
                        </div>
                        <div class="col-sm-8 text-left" style="margin-left: -0;">
                            <input id="inputTimerAuto" class="input" style="width: 40px;text-align: center;" type="text"
                                name="inputTimerAuto" autocomplete="off"
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0');" />
                            วินาที
                        </div>
                    </div>
                    <div id="showDateAuto" style="display: none">
                        <div class="row" style="margin-top: 10">

                            <div class="col-sm-4" style="margin-top: 5px">วันที่เริ่ม
                            </div>
                            <div class="col-sm-8 text-left" style="margin-left: 0;">
                                <div class="col-sm-" style="margin-top: 0px;margin-left: 0px"><input type="text"
                                        id="datetimepickerauto" style="width: 145" autocomplete="off" class="input datetimepicker">
                                    &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerendauto"
                                        style="width: 145" autocomplete="off" class="input datetimepicker">
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <button type="button" onclick="loadData('<?php echo $vmsID;?>','load');"
                        class="btn btn-success">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal py-5" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

                <iframe id="iframe_modal" style="border: 0;" src=""></iframe>

            </div>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->

<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>

<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/dataTables.js"></script>
<script src="dist/js/dataTables.bootstrap4.js"></script>
<script>
function show_modal(e, name, w, h) {

    $("#iframe_modal").attr("src", e.href);
    document.getElementById("Example_Title").innerText = name + " ขนาด กว้าง=" + w + " สูง=" + h;
    document.getElementById("iframe_modal").width = w;
    document.getElementById("iframe_modal").height = h;
    $('#myModal').modal('show');
    return false;
}

function loadData(e, b) {
    var vmsID = document.getElementById('vmsCodeAuto').value;
    var inputTimerAuto = document.getElementById('inputTimerAuto').value;
    var messageCheckboxAuto = document.getElementById('messageCheckboxAuto').checked;
    var datestart = document.getElementById('datetimepickerauto').value;
    var dateend = document.getElementById('datetimepickerendauto').value;








    if (b == 'load') {
        var msgcode = $('.msgcode:checked').serialize();
        if (messageCheckboxAuto == true) {
            var messageCheckboxManualImg = 1;
        } else {
            var messageCheckboxManualImg = 0;
        }
        if (inputTimerAuto == "") {
            Swal.fire("กรุณากรอกระยะเวลา", "", "warning");
            return false;
        }
        if (messageCheckboxManualImg == 1) {

            if (datestart == "") {
                Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
                return false;
            }
            if (dateend == "") {
                Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
                return false;
            }
            var tmp = datestart.split(" ");
            var dt1 = tmp[0] + "," + tmp[1] + ":00";
            var d1 = new Date(dt1);
            var tmp = dateend.split(" ");
            var dt2 = tmp[0] + "," + tmp[1] + ":00";
            var d2 = new Date(dt2);
            if (d2 < d1) {
                Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
                return false;
            }

        }

        Swal.showLoading();
        $.ajax({
            type: 'POST',
            url: 'lib/sqlMSGupdate.php',
            data: {
                'vmsID': vmsID,
                'msgcode': msgcode,
                'inputTimerAuto': inputTimerAuto,
                'messageCheckboxAuto': messageCheckboxAuto,
                'datestart': datestart,
                'dateend': dateend
            },
            success: function(msg) {
                window.location.href = "addMessagerID.php?vmsid=" + btoa(vmsID);
                /*

                $("#tableLoad").html(msg);
                
                $.ajax({
                    type: 'POST',
                    url: 'lib/sqlMSGupdate2.php',
                    data: {'vmsID':vmsID,'msgcode':msgcode},
                    success: function(result) {
                        $("#tableLoadMain").html(result);
                        new DataTable('#UserTable1');
                        new DataTable('#UserTable2');
                    },
                });
                */
            },
        });


    } else if (b == 'restore') {
        Swal.showLoading();
        var msgcodeRestore = $('.msgcodeRestore:checked').serialize();
        $.ajax({
            type: 'POST',
            url: 'lib/sqlMSGrestore.php',
            data: {
                'vmsID': vmsID,
                'msgcodeRestore': msgcodeRestore,
                'inputTimerAuto': inputTimerAuto,
                'messageCheckboxAuto': messageCheckboxAuto,
                'datestart': datestart,
                'dateend': dateend
            },
            success: function(msg) {
                window.location.href = "addMessagerID.php?vmsid=" + btoa(vmsID);
                /*
                    $("#tableLoad").html(msg);
                 
                    $.ajax({
                        type: 'POST',
                        url: 'lib/sqlMSGrestore2.php',
                        data: {'vmsID':vmsID,'msgcode':msgcodeRestore},
                        success: function(result) {
                            $("#tableLoadMain").html(result);
                            new DataTable('#UserTable1');
                            new DataTable('#UserTable2');
                        },
                    });
                    */
            },
        });

    }

}

jQuery('#datetimepickerauto').datetimepicker({
    format:'Y-m-d H:i'
});
jQuery('#datetimepickerendauto').datetimepicker({
    format:'Y-m-d H:i'
});
jQuery('#datetimepicker4').datetimepicker({
    format:'Y-m-d H:i'
});
jQuery('#datetimepickerend4').datetimepicker({
    format:'Y-m-d H:i'
});
$("form#myformANI").submit(function(e) {
    e.preventDefault();
    var nameMSGANI = document.getElementById('nameMSGANI').value;
    var checkbox = document.getElementById('messageCheckboxManualANI');
    var datestart = document.getElementById('datetimepicker4').value;
    var dateend = document.getElementById('datetimepickerend4').value;
    var inputTimerANI = document.getElementById('inputTimerANI').value;
    if (checkbox.checked == true) {
        var messageCheckboxManualANI = 1;
    } else {
        var messageCheckboxManualANI = 0;
    }
    if (nameMSGANI == "") {
        Swal.fire("กรุณากรอกชื่อข้อความ", "", "warning");
        return false;
    }
    if (messageCheckboxManualANI == 1) {

        if (datestart == "") {
            Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
            return false;
        }
        if (dateend == "") {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
            return false;
        }
        var tmp = datestart.split(" ");
        var dt1 = tmp[0] + "," + tmp[1] + ":00";
        var d1 = new Date(dt1);
        var tmp = dateend.split(" ");
        var dt2 = tmp[0] + "," + tmp[1] + ":00";
        var d2 = new Date(dt2);
        if (d2 < d1) {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
            return false;
        }
    }

    if (document.getElementById("filer_inputANI").files.length == 0) {
        Swal.fire("กรุณาแนบไฟล์", "", "warning");
        return false;
    }
    if (inputTimerANI == "") {
        Swal.fire("กรุณากรอกระยะเวลา", "", "warning");
        return false;
    }
    var formData = new FormData(this);
    var vmsid = '<?php echo $_REQUEST['vmsid']?>';
    Swal.showLoading();
    $.ajax({
        url: 'uploadANI.php',
        type: 'POST',
        data: formData,
        success: function(data) {
           
          
            if (data == 1) {
                window.location.href = 'Schedulemessage.php?vmc=' + vmsid;
            } else {
                alert('ไม่สามารถอัพโหลดรูปภาพได้');
            }
        },
        cache: false,
        contentType: false,
        processData: false
    });
});


$("#myformImg").submit(function(e) {
            e.preventDefault();
    
    var nameMSGImg = document.getElementById('nameMSGImg').value;
    var checkbox = document.getElementById('messageCheckboxManualImg');
    var datestart = document.getElementById('datetimepicker2').value;
    var dateend = document.getElementById('datetimepickerend2').value;
    var inputTimerImg = document.getElementById('inputTimerImg').value;
    if (checkbox.checked == true) {
        var messageCheckboxManualImg = 1;
    } else {
        var messageCheckboxManualImg = 0;
    }
    if (nameMSGImg == "") {
        Swal.fire("กรุณากรอกชื่อข้อความ", "", "warning");
        return false;
    }
    if (messageCheckboxManualImg == 1) {

        if (datestart == "") {
            Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
            return false;
        }
        if (dateend == "") {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
            return false;
        }
        var tmp = datestart.split(" ");
        var dt1 = tmp[0] + "," + tmp[1] + ":00";
        var d1 = new Date(dt1);
        var tmp = dateend.split(" ");
        var dt2 = tmp[0] + "," + tmp[1] + ":00";
        var d2 = new Date(dt2);
        if (d2 < d1) {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
            return false;
        }
    }

    if (document.getElementById("filer_input2").files.length == 0) {
        Swal.fire("กรุณาแนบไฟล์", "", "warning");
        return false;
    }
    if (inputTimerImg == "") {
        Swal.fire("กรุณากรอกระยะเวลา", "", "warning");
        return false;
    }
    var formData = new FormData(this);
    var vmsid = '<?php echo $_REQUEST['vmsid']?>';
    Swal.showLoading();
    $.ajax({
        url: 'uploadImg.php',
        type: 'POST',
        data: formData,
        success: function(data) {
          
            if (data == 1) {
                window.location.href = 'Schedulemessage.php?vmc=' + vmsid;
            } else {
                alert('ไม่สามารถอัพโหลดรูปภาพได้');
            }
            
        },
        cache: false,
        contentType: false,
        processData: false
    });
});

function postMSG() {
    var vmsCode = document.getElementById('vmsCodeAuto').value;
    var MSGcode = 'MSG2403-0019';
    Swal.showLoading();
    $.ajax({
        type: "POST",
        url: "lib/prmocessPostMSG.php",
        data: {
            'vmsCode': vmsCode,
            'MSGcode': MSGcode
        },
        success: function(result) {

            window.location.href = 'ifarmeManual.php?vmsSize=' + vmsSize + '&vms=' + vms +
                '&messageCheckboxManual=' + messageCheckboxManual + '&inputTimerManual=' +
                inputTimerManual + '&datestart=' + datestart + '&dateend=' + dateend + '&msgBG=' + msgBG +
                '&user=<?php echo $_SESSION['userName'];?>&status=3';
        }
    });
}

function previewNextStep() {
    var data = CKEDITOR.instances.detailck.getData();
    var nameMSG = document.getElementById('nameMSG').value;
    var vms = document.getElementById('vms').value;
    var vmsSize = document.getElementById('vmsSize').value;
    var checkbox = document.getElementById('messageCheckboxManual');
    if (checkbox.checked == true) {
        var messageCheckboxManual = 1;
    } else {
        var messageCheckboxManual = 0;
    }
    var inputTimerManual = document.getElementById('inputTimerManual').value;
    var datestart = document.getElementById('datetimepicker3').value;
    var dateend = document.getElementById('datetimepickerend3').value;
    var msgBG = document.getElementById('msgBG').value;
    var bgcolor = document.getElementById('bgcolor').value;
    var usercolor = document.getElementById('usercolor').value;
    if (nameMSG == "") {
        Swal.fire("กรุณากรอกชื่อข้อความ", "", "warning");
        return false;
    }
    if (messageCheckboxManual == 1) {

        if (datestart == "") {
            Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
            return false;
        }
        if (dateend == "") {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
            return false;
        }
        var tmp = datestart.split(" ");
        var dt1 = tmp[0] + "," + tmp[1] + ":00";
        var d1 = new Date(dt1);
        var tmp = dateend.split(" ");
        var dt2 = tmp[0] + "," + tmp[1] + ":00";
        var d2 = new Date(dt2);
        if (d2 < d1) {
            Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
            return false;
        }
    }
    if (data == "") {
        Swal.fire("กรุณากรอกข้อความ", "", "warning");
        return false;
    }
    if (inputTimerManual == "") {
        Swal.fire("กรุณากรอกระยะเวลา", "", "warning");
        return false;
    }
    Swal.showLoading();
    $.ajax({
        type: "POST",
        url: "addMessage_lib.php",
        data: {
            'nameMSG': nameMSG,
            'data': data,
            'vms': vms,
            'vmsSize': vmsSize,
            'messageCheckboxManual': messageCheckboxManual,
            'inputTimerManual': inputTimerManual,
            'datestart': datestart,
            'dateend': dateend,
            'msgBG': msgBG
        },
        success: function(result) {
            window.location.href = 'addMessagerID.php?vmsid=' + '<?php echo $_GET['vmsid'];?>';
            //window.location.href = 'ifarmeManual.php?vmsSize='+vmsSize+'&vms='+vms+'&messageCheckboxManual='+messageCheckboxManual+'&inputTimerManual='+inputTimerManual+'&datestart='+datestart+'&dateend='+dateend+'&msgBG='+msgBG+'&user=<?php echo $_SESSION['userName'];?>&status=3';
        }
    });
}


CKEDITOR.replace('detailck', {
    font_names: 'SarunThangLuang'+
                 
                 'Arial/Arial, Helvetica/sans-serif;' +
                 'THSarabun;' +
                 'Comic Sans MS/Comic Sans MS, cursive;' +
                 'Courier New/Courier New, Courier, monospace;' +
                 'Georgia/Georgia, serif;' +
                 'Lucida Sans Unicode/Lucida Sans Unicode, Lucida Grande, sans-serif;' +
                 'Tahoma/Tahoma, Geneva, sans-serif;' +
                 'Times New Roman/Times New Roman, Times, serif;' +
                 'Trebuchet MS/Trebuchet MS, Helvetica, sans-serif;' +
                 'Verdana/Verdana, Geneva, sans-serif',
    toolbar : [
                ['Font', 'FontSize'], ['TextColor', 'BGColor'], ['Bold', 'Italic', 'Underline', 'Strike'], ['Subscript', 'Superscript'],
                ['JustifyLeft', 'JustifyRight', 'JustifyCenter', 'JustifyBlock'] 
               
                ],
    width: "<?php echo $result['XIVmsPixelW'];?>px",
    height: "<?php echo $result['XIVmsPixelH']; ?>px"
});
//ปุ่มเลือกสี
for (i = 0; i < <?=count($color)?>; i++) {
    var obj = document.getElementById("color" + i);
    obj.onmouseover = function() {
        this.className = "hover"
    };
    obj.onmouseout = function() {
        if (this.id == document.getElementById("usercolor").value) this.className = "current";
        else this.className = "button";
    };
    obj.onclick = function() {
        selectcolor(this.id)
    };
}

//เมื่อคลิกปุ่ม
function selectcolor(id) {
    for (i = 0; i < <?=count($color)?>; i++) {
        document.getElementById("color" + i).className = "button";
    };
    if (!document.getElementById(id)) id = "color0";
    document.getElementById("bgcolor").value = document.getElementById(id).title;
    document.getElementById("usercolor").value = document.getElementById(id).title;
    document.getElementById(id).className = "current";
    $('#usercolor').css('background', document.getElementById(id).title);
    var bgrealcolor = document.getElementById(id).title;
    $(".cke_wysiwyg_frame").contents().find(".cke_editable").css("background-color", bgrealcolor);
    document.getElementById('msgBG').value = bgrealcolor;
}

function activityWorkAuto(e) {
    var messageCheckboxAuto = $('.messageCheckboxAuto:checked').val();
    if (messageCheckboxAuto == 1) {
        document.getElementById('showDateAuto').style.display = "block";
    } else {
        document.getElementById('showDateAuto').style.display = "none";
        document.getElementById('datetimepickerauto').value = '';
        document.getElementById('datetimepickerendauto').value = '';
    }
}

function activityWorkManual(e) {
    var messageCheckboxManual = $('.messageCheckboxManual:checked').val();
    if (messageCheckboxManual == 1) {
        document.getElementById('showDateManual').style.display = "block";
    } else {
        document.getElementById('showDateManual').style.display = "none";
        document.getElementById('datetimepicker3').value = '';
        document.getElementById('datetimepickerend3').value = '';
    }
}

function activityWorkManualImg(e) {
    var messageCheckboxManualImg = $('.messageCheckboxManualImg:checked').val();
    if (messageCheckboxManualImg == 1) {
        document.getElementById('showDateImg').style.display = "block";
    } else {
        document.getElementById('showDateImg').style.display = "none";
        document.getElementById('datetimepicker2').value = '';
        document.getElementById('datetimepickerend2').value = '';
    }
}

function activityWorkManualANI(e) {
    var messageCheckboxManualANI = $('.messageCheckboxManualANI:checked').val();
    if (messageCheckboxManualANI == 1) {
        document.getElementById('showDateANI').style.display = "block";
    } else {
        document.getElementById('showDateANI').style.display = "none";
        document.getElementById('datetimepicker3').value = '';
        document.getElementById('datetimepickerend3').value = '';
    }
}

function returnTextTimer(e) {
    if (e == 1) {
        document.getElementById("inputTimer").disabled = false;
        document.getElementById("datetimepicker").disabled = false;
        document.getElementById("datetimepickerend").disabled = false;
        let textManualRadio = document.getElementById("textManualRadio");
        textManualRadio.checked = false;
    } else if (e == 2) {
        document.getElementById("inputTimer").disabled = true;
        document.getElementById("datetimepicker").disabled = false;
        document.getElementById("datetimepickerend").disabled = false;
        let textAutoRadio = document.getElementById("textAutoRadio");
        textAutoRadio.checked = false;
    } else if (e == 3) {
        document.getElementById("imginputTimer").disabled = false;
        document.getElementById("datetimepicker2").disabled = false;
        document.getElementById("datetimepickerend2").disabled = false;

    } else if (e == 4) {
        document.getElementById("imginputTimer").disabled = true;
        document.getElementById("datetimepicker2").disabled = false;
        document.getElementById("datetimepickerend2").disabled = false;
        let imgAutoRadio = document.getElementById("imgAutoRadio");
        imgAutoRadio.checked = false;
    } else if (e == 5) {
        document.getElementById("aniinputTimer").disabled = false;
        document.getElementById("datetimepicker3").disabled = false;
        document.getElementById("datetimepickerend3").disabled = false;

    } else if (e == 6) {
        document.getElementById("aniinputTimer").disabled = true;
        document.getElementById("datetimepicker3").disabled = false;
        document.getElementById("datetimepickerend3").disabled = false;
    }
}

function clearContent(e) {
    let textManualRadio = document.getElementById("textManualRadio");
    textManualRadio.checked = false;
    let textAutoRadio = document.getElementById("textAutoRadio");
    textAutoRadio.checked = false;

    document.getElementById("inputTimer").disabled = true;

}

function ModalloadData() {
    $('#myModalSave').modal('show');
}
$(document).ready(function() {


    new DataTable('#UserTable1', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });

    new DataTable('#UserTable2', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });
});

$("#btnsubmitimg").hide();
$('#filer_input2').change(function(e) {
    const fname = e.target.files[0].name;
    $("#h4fname").text(fname);
    $("#btnsubmitimg").show();
});

$("#btnsubmitvdo").hide();
$('#filer_inputANI').change(function(e) {
    const fname = e.target.files[0].name;
    $("#h5fname").text(fname);
    $("#btnsubmitvdo").show();
});

function processSeqNo(a, b, c) {
    Swal.showLoading();
    $.ajax({
        type: "POST",
        url: "lib/processSeqNo.php",
        data: {
            'XVVmsCode': c,
            'typeSeqNo': b,
            'XVMsgCode': a
        },
        success: function(result) {

            window.location.href = 'addMessagerID.php?vmsid=' + btoa('<?php echo $vmsID;?>');
        }
    });
}
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function sendmessageToVMS() {
    var vmsID = '<?php echo $vmsID;?>';

    if (vmsID != '' && vmsID != 'VMSALL') {
        Swal.showLoading();
        $.ajax({
            type: "POST",
            url: "lib/commandSendMessageVMS.php",
            data: {
                'vmsID': vmsID
            },
            success: function(result) {

                if (result == "Success") {
                    Swal.fire({
                        title: "",
                        text: "ส่งคำสั่ง ส่งข้อความขึ้นป้ายสำเร็จ",
                        icon: "success"
                    });
                }

                if (result == "nodata") {
                    Swal.fire({
                        title: "",
                        text: "ไม่พบข้อมูลข้อความที่จะส่งขึ้นป้าย",
                        icon: "warning"
                    });
                }
                if (result == "Fail") {
                    Swal.fire({
                        title: "",
                        text: "ส่งคำสั่งไม่ได้ ลองใหม่อีกครั้ง",
                        icon: "warning"
                    });
                }


            }
        });
    } else {
        Swal.fire({
            title: "",
            text: "กรุณาเลือกป้าย",
            icon: "warning"
        });
    }
}
async function ShowEx() {

    var vmsID = '<?php echo $vmsID;?>';

    
    var source = '<?php echo $source;?>';
    var delay = '<?php echo $delay;?>';
    var countsource = '<?php echo $countsource;?>';
    var XIVmsPixelW = '<?php echo $XIVmsPixelW;?>';
    var XIVmsPixelH = '<?php echo $XIVmsPixelH;?>';
    var XVMsgCode = '<?php echo $XVMsgCode;?>';
    var XVMsgName='<?php echo $XVMsgName;?>';
    document.getElementById("iframe_modal").width = XIVmsPixelW;
    document.getElementById("iframe_modal").height = XIVmsPixelH;


    $('#myModal').modal('show');

    if (countsource > 0) {
        sourceArray = source.split(",");
        delayArray = delay.split(",");
        XVMsgCodeArray = XVMsgCode.split(",");
        XVMsgName=XVMsgName.split(",");
        for (let i = 0; i < countsource; i++) {
            
            
            document.getElementById("Example_Title").innerHTML = XVMsgName[i];
            $("#iframe_modal").attr("src", 'ifarme.php?msg=' + btoa(XVMsgCodeArray[i]));

            


            await sleep(delayArray[i] * 1000);

        }

    }

}
function SaveMSG(XVMsgCode,XVVmsCode,XIVmgOrder){
  
  var id1='1'+XVMsgCode+XIVmgOrder;
  var id2='2'+XVMsgCode+XIVmgOrder;
  var id3='3'+XVMsgCode+XIVmgOrder;
  var id4='4'+XVMsgCode+XIVmgOrder;
  var checkBox = document.getElementById(id1);
  var XBVmgHasExpiration=0;
  if(checkBox.checked==true){
     XBVmgHasExpiration=1;
  }
  
   var st=$('#'+id2).val();
   var et=$('#'+id3).val();
   var XIVmgDuration=$('#'+id4).val();
   if(XBVmgHasExpiration==1){
       if (st == "") {
               Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
               return false;
       }
       if (et == "") {
               Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
               return false;
       }
       var tmp = st.split(" ");
       var dt1 = tmp[0] + "," + tmp[1];
       var d1 = new Date(dt1);
       var tmp = et.split(" ");
       var dt2 = tmp[0] + "," + tmp[1];
       var d2 = new Date(dt2);
       if (d2 < d1) {
           Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
           return false;
       }
  }
   if(XIVmgDuration==""){
          Swal.fire("กรุณากรอกเวลา", "", "warning");
           return false;
   }
  
  $.ajax({
       type: "POST",
       url: "ScheduleUpdate.php",
       data: {
                       'XVVmsCode': XVVmsCode,
                       'XVMsgCode': XVMsgCode,
                       'XIVmgOrder': XIVmgOrder,
                       'XBVmgHasExpiration': XBVmgHasExpiration,
                       'XIVmgDuration': XIVmgDuration,
                       'XTVmgStart': st,
                       'XTVmgEnd': et
       },
       success: function(result) {
          
           if(result==1){
               if(XBVmgHasExpiration==0){
                $('#'+id2).val('');
                $('#'+id3).val('');
               }
               Swal.fire({
                   title: "",
                   text: "บันทึกสำเร็จ",
                   icon: "success"
               });
           }
         
       }
   });
   
 
}
jQuery('.datetimepicker').datetimepicker({
   
   format:'Y-m-d H:i'
 });
 function CheckBox(id1,id2,id3){
   
    var checkBox = document.getElementById(id1);
    if (checkBox.checked == true){
        document.getElementById(id2).disabled = false;
        document.getElementById(id3).disabled = false;
    } else {
        document.getElementById(id2).disabled = true;
        document.getElementById(id3).disabled = true;
    }
 }
</script>
</body>

</html>