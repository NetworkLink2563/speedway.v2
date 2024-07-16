<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
if(checkmenu($user,'001')==0)
{
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
if(checkmenu($user,'007')==0){
 
    header( "location: dashboard.php" );
    exit(0);
}else{
    if($_SESSION["XBDmnIsRead"]==0){
        header( "location: dashboard.php" );
        exit(0);
    }
}
$XVVmsCode=base64_decode($_REQUEST["vmc"]) ;
$sql = "SELECT * FROM TMstMItmVMS where XVVmsCode='$XVVmsCode'";

$query = sqlsrv_query($conn, $sql);
$result=sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

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

.select2-container--default .select2-results>.select2-results__options {
    max-height: 400px;
}
</style>
<style>
.dropbtn {
    background-color: #04AA6D;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover,
.dropbtn:focus {
    background-color: #3e8e41;
}

#myInput {
    box-sizing: border-box;
    background-image: url('searchicon.png');
    background-position: 14px 12px;
    background-repeat: no-repeat;
    font-size: 16px;
    border: none;
    border-bottom: 1px solid #ddd;
}

#myInput:focus {
    outline: 3px solid #ddd;
}

.dropdown {
    position: relative;
    display: inline-block;
}

/*
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}
*/
.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
    height: 100%;
}

.dropdown a:hover {
    background-color: #ddd;
}

.show {
    display: block;
}

.modal-dialog {
    max-width: 1000px;
  
}

body {
        background: #e1f0fa;
    }

.container{
    background: white;
    height: 100vh;
}

.flex-search{
    display: flex;
    flex-wrap: wrap;
}

*{
    box-sizing: border-box;
    padding: 0;
    margin: 0;
}

.flex-btn{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    
}

.flex-btn-content{
    display: flex;
    justify-content: center;
    align-items: center;
}

table td{
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    table td a:hover{
        background-color: #cccc;
        transition: 0.5s;
        border-radius: 10px;
        color: black;
    }

    table td a{
        border-radius: 10px;
        text-align: center;
        transition: 0.5s;
        background-color: #edededcc;
    }

    table th{
        font-size: .8rem;
        font-weight: 500;
    }

.dt-search{
    display: none;
}

#myInput{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 24px top 12px;
 text-indent: 14px;
}

.justify-content-between{
    display: none;
}

.flex-search-content{
    display: flex;  
    justify-content: center;
}

input.btnsearch{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
}

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa!important;
}

#dt-search-0{
    opacity: 0.7;
}

table th{
        background-color: #e8f4ff!important;
    }
    
    .btn-hover:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

</style>

<div class="container" >


<div  style="position: relative; top: 75;">   

<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image"> จัดตารางข้อความประชาสัมพันธ์
        </div>

            <!-- <div class="col-sm-6" align="right">
                <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">


                </div>
            </div>
        </div> -->


        
        <div id="VMSALL">
            <div class="flex-search col-12" style="margin-top: 1rem;">

            <div class="flex-search-content col-3">
                <div class="col-12" style="border-right: 3px double #cccc; text-align: center;">
                    <div>
                        <div id="myDropdown" class="dropdown-content" style="width: 100%;" >
                            <!-- <label for="myInput">กรอกชื่อป้ายที่ต้องการค้นหา</label> -->
                            
                            <input class="input" placeholder="กรอกชื่อป้ายที่ต้องการค้นหา" type="text"
                                style="width: 100%; font-size: 0.8rem; text-align: center; margin: 0rem 0rem .5rem 0rem;border: 1px solid #cccc;"
                                placeholder="" id="myInput" onkeyup="filterFunction()">
                             


                            <table class="table">
                                <?php
                                            $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                                            $query = sqlsrv_query($conn, $stmt);
                                            while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                            {
                                                $url="Schedulemessage.php?vmc=".base64_encode($result['XVVmsCode']);
                                                if($XVVmsCode==$result['XVVmsCode']){
                                                    echo  '<tr><td><a style="background-color: #006eb4; color: white; border-radius: 5px; box-shadow: 3px 3px 3px #aaaaaa;" href="'.$url.'">'.$result['XVVmsName'].'</a> </td></tr>';
                                                }else{
                                                    echo  '<tr><td><a href="'.$url.'">'.$result['XVVmsName'].'</a></td> </tr>';
                                                }
                                            
                                            }
                                            ?>
                            </table>

                        </div>
                    </div>

                </div>

                </div>
                <!-- end div flex search content -->



                <div class="col flex-btn">
        <div class="flex-btn-content col-12" style="padding: 1rem; border-bottom: 3px double #cccc; margin-bottom: .2rem;">


        <div class="flex-search-content"></div>

                    <div class="col-4" style="border-right: 1px solid #cccc;">
                        <input type="hidden" value="<?php echo $XVVmsCode;?>" id="vmsID">
                            <?php
                                $Disable='pointer-events: none;';
                                if($_SESSION["XBDmnIsAdd"]==1){
                                    $Disable="";
                                }
                            ?>
                                <button href="#" class="btn-hover btn btn-primary shadow " style="<?php echo $Disable;?> width: 100%; padding: 1rem; background-color: #006eb4;"
                                    onclick="processListMessage2()" title="การแสดงข้อความ"><i class="fa fa-plus"
                                        aria-hidden="true" ></i> เพิ่ม/แก้ไขรายการข้อความ</button>
                            </div>


                            <div class="col-4" style="border-right: 1px solid #cccc;">
                                <button type="button" onclick="ShowEx()" class="btn-hover btn btn-primary shadow" style="width: 100%; padding: 1rem; background-color: #006eb4;"><i class="fa fa-search"
                                        aria-hidden="true"></i>แสดงตัวอย่าง</button>
                            </div>


                            <div class="col-4" style="">
                            <?php
                                $Disable='pointer-events: none;';
                                if($_SESSION["XBDmnIsControl"]==1){
                                    $Disable="";
                                }
                            ?>
                                <button id="sendmessagevms" class="btn-hover btn btn-primary shadow" style="<?php echo $Disable;?> width: 100%; padding: 1rem; background-color: #006eb4;"
                                    onclick="sendmessageToVMS()"><i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                    ส่งข้อความขึ้นป้าย</button>
                            
                        </div>


                    </div>
               

                    <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px; margin: .5rem;">

<!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
<input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" aria-controls="VMSTable"></input>
</div>

                    <div class="col" style="">
                       <div class="table table-striped table-hover">
                        <table id="UserTable" class="table">
                            <thead>
                                <tr>
                                    <th >รหัสข้อความ</th>
                                    <th >ลำดับ</th>
                                    <th ></th>
                                    <th >ขื่อข้อความ</th>
                                    <th >ประเภท</th>
                                    <th >ขนาด</th>
                                    <th >ตั้งเวลา</th>
                                    <th >เริ่ม</th>
                                    <th >สิ้นสุด</th>
                                    <th >ระยะเวลา</th>
                                    <th >ดูข้อความ</th>
                                    <th >ลบ</th>
                                    <th >บันทึก</th>

                                </tr>
                            </thead>
                            <tbody style="font-size: 10pt">
                                <?php

                     

                        $sql_row = "SELECT        dbo.TMstMItmVMSMessage.XVVmsCode, dbo.TMstMItmVMSMessage.XIVmgSeqNo, dbo.TMstMItmVMSMessage.XIVmgOrder, dbo.TMstMItmVMSMessage.XVMsgCode, dbo.TMstMItmVMSMessage.XIVmgDuration, 
                        dbo.TMstMItmVMSMessage.XBVmgHasExpiration, dbo.TMstMItmVMSMessage.XVWhoCreate, dbo.TMstMItmVMSMessage.XVWhoEdit, dbo.TMstMItmVMSMessage.XTWhenCreate, dbo.TMstMItmVMSMessage.XTWhenEdit, 
                        dbo.TMstMMessage.XVMsgName, dbo.TMstMMessage.XVMsgHtml, dbo.TMstMMessage.XVMssCode, dbo.TMstMMessage.XVMsgType, dbo.TMstMMessage.XVMsgFileName, dbo.TMstMMessage.XVMsgStatus, 
                        dbo.TMstMMessage.XVMsgBg, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgStart, 120) AS XTVmgStart, CONVERT(varchar, dbo.TMstMItmVMSMessage.XTVmgEnd, 120) AS XTVmgEnd, 
                        dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel, dbo.TMstMItmVMSMessage.XBVmgHasExpiration AS Expr1, ISNULL(dbo.TMstMMessage.XIVdoDuration, 0) AS XIVdoDurationVdo
FROM            dbo.TMstMItmVMSMessage INNER JOIN
                        dbo.TMstMMessage ON dbo.TMstMMessage.XVMsgCode = dbo.TMstMItmVMSMessage.XVMsgCode INNER JOIN
                        dbo.TMstMMsgSize ON dbo.TMstMMessage.XVMssCode = dbo.TMstMMsgSize.XVMssCode
                        WHERE        (dbo.TMstMItmVMSMessage.XVVmsCode = '$XVVmsCode')
                        ORDER BY dbo.TMstMItmVMSMessage.XIVmgOrder";
                        
                        $query_row = sqlsrv_query($conn, $sql_row);
                        while($result_row = sqlsrv_fetch_array($query_row, SQLSRV_FETCH_ASSOC)){
                            $countsource++;
                            $value2=$result_row['XVMsgCode'];
                            if($result_row['XVMsgType']==1){
                                $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                            }elseif($result_row['XVMsgType']==2){
                                $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                            }elseif($result_row['XVMsgType']==3){
                                $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                            }
                            $XBVmgHasExpirationCheck="";
                            $disabled="";
                            if($result_row['XBVmgHasExpiration']!=0)
                            {
                               $sdate=$result_row['XTVmgStart'];
                               $edate=$result_row['XTVmgEnd'];
                               $XBVmgHasExpirationCheck="checked";
                               $disabled="";
                            }else{
                                $XBVmgHasExpirationCheck="";
                                $sdate="";
                                $edate="";
                                $disabled="disabled";
                               
                            }
                            $XVMsgCode.=$result_row['XVMsgCode'].',';
                            $source.=$result_row['XVMsgFileName'].',';
                            $delay.=$result_row['XIVmgDuration'].',';
                            $XIVdoDurationVdo.=$result_row['XIVdoDurationVdo'].',';
                            $XVMsgFileName=$result_row['XVMsgFileName'];
                            $Html=str_replace($XVMsgFileName,"media/tmp/".$XVMsgFileName,$result_row['XVMsgHtml']);
                            $XVMsgHtml.=$Html.',';
                            $id1='1'.$result_row['XVMsgCode'].$result_row['XIVmgOrder'];
                            $id2='2'.$result_row['XVMsgCode'].$result_row['XIVmgOrder'];
                            $id3='3'.$result_row['XVMsgCode'].$result_row['XIVmgOrder'];
                            $id4='4'.$result_row['XVMsgCode'].$result_row['XIVmgOrder'];
                            
                            ?>
                                <tr
                                    id="myDiv<?php echo $result_row['XVMsgCode'];?><?php echo $result_row['XVVmsCode'];?>">
                                    <td style="text-align: left;vertical-align: middle;"><?php echo $result_row['XVMsgCode'];?></td>
                                    <td style="text-align: center;vertical-align: middle;"><?php echo $result_row['XIVmgOrder'];?></td>
                                    <td>
                                        <div style="text-align: center">
                                            <?php
                                       
                                        if($value1==$value2){
                                            ?>
                                            <i class="fa fa-caret-down" aria-hidden="true" style="color: red"></i>
                                            <?php
                                        }else{?>
                                            <a href="#"
                                                onclick="processSeqNo('<?php echo $result_row['XVMsgCode'];?>','DOWN','<?php echo $result_row['XVVmsCode'];?>');"><i
                                                    class="fa fa-caret-down" aria-hidden="true"
                                                    style="color: red; font-size: 24px;"></i></a>
                                            <?php }?>
                                            <?php
                                        if($value3==$value2){
                                            ?>
                                            <i class="fa fa-caret-up" aria-hidden="true" style="color: green"></i>
                                            <?php }else{?>
                                            <a href="#"
                                                onclick="processSeqNo('<?php echo $result_row['XVMsgCode'];?>','UP','<?php echo $result_row['XVVmsCode'];?>');"><i
                                                    class="fa fa-caret-up" aria-hidden="true"
                                                    style="color: green; font-size: 24px;"></i></a>
                                            <?php }?>
                                        </div>
                                    </td>
                                    <td style="text-align: left;vertical-align: middle;"><?php echo $result_row['XVMsgName'];?></td>
                                    <td style="text-align: center;vertical-align: middle;"><?php echo $XVMsgType; ?></td>
                                    <td style="text-align: center;vertical-align: middle;"><?php echo 'กว้าง='.$result_row['XIMssWPixel']."px".' สูง='.$result_row['XIMssHPixel']."px";?>
                                    </td>
                                    <td style="text-align: center;vertical-align: middle;"><div style="text-left: center"><input  type="checkbox" onclick="CheckBox('<?php echo $id1;?>','<?php echo $id2;?>','<?php echo $id3;?>')" id="<?php echo $id1;?>" <?php echo $XBVmgHasExpirationCheck;?>></div></td>
                                    <td style="text-align: center;vertical-align: middle;"> 
                                        <div class=" input-group">
                                            <div class="input-group-append">
                                               <input class="datetimepicker " style="width:180px" <?php echo $disabled;?> type="text" id="<?php echo $id2;?>" class="form-control" value="<?php echo $sdate;?>">
                                       
                                               <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                            </div>
                                        </div>        
                                    </td>  
                                    <td style="text-align: center;vertical-align: middle;"> <div class=" input-group">
                                    <div class="input-group-append">
                                  
                                        <input class="datetimepicker " style="width:180px" type="text" <?php echo $disabled;?> id="<?php echo $id3;?>" class="form-control" value="<?php echo $edate;?>">
                                       
                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>        
                                    </td>  
                                  

                                    <td style="text-align: center;vertical-align: middle;"><input type="number" class="" id="<?php echo $id4;?>" style="width: 50px;" class="XIVmgDuration" value="<?php echo $result_row['XIVmgDuration'];?>"/>
                                       
                                    </td>

                                    <td style="text-align: center;vertical-align: middle;">
                                        <div align="center"><a
                                                href="<?php echo 'ifarme.php?msg='.base64_encode($result_row['XVMsgCode']);?>"
                                                onclick="return show_modal(this,'<?php echo $result_row['XVMsgName'];?>','<?php echo $result_row['XIMssWPixel'];?>','<?php echo $result_row['XIMssHPixel'];?>');"
                                                style="font-size:24px;color: #8d9499" ><i class="fa fa-search"
                                                    aria-hidden="true"></i></a>
                                        </div>
                                    </td>

                                    <td style="text-align: center;vertical-align: middle;">
                                    <?php
                                        $Disable="pointer-events: none;";
                                        if($_SESSION["XBDmnIsDelete"]==1){
                                            $Disable="";
                                        }
                                        ?>
                                        <div align="center"><a href="#" style="<?php echo $Disable;?>" class="del-item"
                                                onclick="deleteMSG('<?php echo $result_row['XVMsgCode'];?>','<?php echo $result_row['XVVmsCode']; ?>');"><i
                                                style="font-size:24px;color: #8d9499;" class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                                    </td>

                                    <td style="text-align: center;vertical-align: middle;">
                                        <div align="center"><a href="#"  
                                                onclick="SaveMSG('<?php echo $result_row['XVMsgCode']; ?>','<?php echo $result_row['XVVmsCode']; ?>','<?php echo $result_row['XIVmgOrder']; ?>');"><i
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
        </div>

    </div>


    </div>
                    </div>
                    <!-- end div flex-btn -->
    
       


</div>
</div>


                                    </div>
                                    </div>
                                       






<div class="modal py-5" id="myModal" role="dialog">
    <div class="modal-dialog modal-dialog" >
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="width:100%">

                <iframe id="iframe_modal" style="border: 0;" src=""></iframe>

            </div>

        </div>
    </div>
</div>



<div class="modal" id="myModalOpen" tabindex="-1" role="dialog" style="width: 1200">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 class="modal-title">เลือกประเภทข้อความ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab" style="margin-left: 10px;margin-right: 55px;">
                    <button id="tabMessage" name="firstactive" class="tablinks active"
                        onclick="openActivityMessage(event, 'MessageValue')">แสดงข้อความ</button>
                </div>
                <div id="MessageValue" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 55px;">
                    <div class="row">
                        <div class="col-sm-3">
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="messageListModalRadio"
                                name="radiobuttonBrightness" type="radio" value="1" onclick="messageListValue(1)" />
                            จากรายการข้อความ
                        </div>
                        <div class="col-sm-3" style="margin-top: 10px"><input id="messageManualModalRadio"
                                name="radiobuttonBrightness" type="radio" value="2"
                                onclick="messageListValue(2)" />&nbsp;เขียนข้อความ
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
                                <select id="vms" name="vms" style="width: 300; height: 37" size="100" class="input"
                                    onchange="vmsListNextstep()">
                                    <option value="" selected="selected">เลือกป้าย VMS</option>

                                    <?php
                                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                    <option value="<?php echo $result['XVVmsCode']; ?>">
                                        <?php echo $result['XVVmsName']; ?></option>
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
                                    <select id="vmsMSG" name="vmsMSG" style="width: 300; height: 37" class="input"
                                        onchange="vmsMSGNextStep();">
                                        <option value="" selected="selected">เลือกรายการข้อความ</option>
                                        <?php
                                    $stmt = "SELECT * FROM TMstMMessage WHERE XVMsgStatus = 1 ORDER BY XVMsgCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVMsgCode']; ?>">
                                            <?php echo $result['XVMsgName']; ?></option>
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
                                    <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input
                                            type="checkbox" class="messageCheckbox" id="messageAutoRadio"
                                            name="messageAutoRadio" value="1" onclick="activityWork(1)">
                                        กำหนดช่วงสิ้นสุด
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
                                    <div class="col-sm-3" style="margin-top: 10px;margin-left: -10px"><input
                                            id="inputTimer" class="input" style="width: 40px;text-align: center;"
                                            type="text" name="inputTimer" autocomplete="off"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); timerListNextStep();" />
                                        วินาที</div>
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
                                    <div class="col-sm-" style="margin-top: 0px;margin-left: -10px"><input type="text"
                                            id="datetimepicker" style="width: 145" autocomplete="off" class="input">
                                        &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerend2"
                                            style="width: 145" autocomplete="off" class="input">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div id="buttonSend" style="display: none">
                            <div align="center">
                                <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal"
                                    aria-label="Close" id="btnRefresh" onclick="sendSubmitListMSG();">ส่งคำสั่ง</button>
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
                                <select id="vmsManual" name="vmsManual" style="width: 300; height: 37" class="input"
                                    onchange="vmsManuralNextstep()">
                                    <option value="" selected="selected">เลือกป้าย VMS</option>

                                    <?php
                                    $stmt = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                    <option value="<?php echo $result['XVVmsCode']; ?>">
                                        <?php echo $result['XVVmsName']; ?></option>
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
                                    <select id="vmsSize" name="vmsSize" style="width: 300; height: 37" class="input"
                                        onchange="vmsSizeManuralNextstep()">
                                        <option value="" selected="selected">เลือกขนาดป้าย VMS</option>

                                        <?php
                                    $stmt = "SELECT * FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                                    $query = sqlsrv_query($conn, $stmt);
                                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                    {
                                        ?>
                                        <option value="<?php echo $result['XVMssCode']; ?>">
                                            <?php echo $result['XVMssName']; ?></option>
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
                                    <div class="col-sm-5" style="margin-top: 10px;margin-left: -10px"><input
                                            type="checkbox" class="messageCheckboxManual" id="messageCheckboxManual"
                                            name="messageCheckboxManual" value="1" onclick="activityWorkManual(1)">
                                        กำหนดช่วงสิ้นสุด
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
                                    <div class="col-sm-3" style="margin-top: 10px;margin-left: -10px"><input
                                            id="inputTimerManual" class="input" style="width: 40px;text-align: center;"
                                            type="text" name="inputTimer" autocomplete="off"
                                            oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/^0[^.]/, '0'); timerManualNextStep();" />
                                        วินาที</div>
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
                                    <div class="col-sm-" style="margin-top: 0px;margin-left: -10px"><input type="text"
                                            id="datetimepicker3" style="width: 145" autocomplete="off" class="input">
                                        &nbsp;&nbsp;วันที่สิ้นสุด <input type="text" id="datetimepickerend3"
                                            style="width: 145" autocomplete="off" class="input">
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <div id="buttonManualSend" style="display: none">
                            <div align="center">
                                <button id="buttonSend" type="button" class="btn btn-success" data-dismiss="modal"
                                    aria-label="Close" id="btnRefresh"
                                    onclick="sendSubmitNextStep();">ส่งคำสั่ง</button>
                            </div>
                        </div>



                    </div>
                </div>





</div>
</div>
<!-- end div container -->

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
function sendmessageToVMS() {
    var vmsID = document.getElementById("vmsID").value;

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

function processListMessage2() {
    var vmsID = document.getElementById("vmsID").value;
    if (vmsID != '' && vmsID != 'VMSALL') {
        Swal.showLoading();
        $.ajax({
            type: "POST",
            url: "addMessagerID.php",
            data: {
                'vmsID': vmsID
            },
            success: function(result) {
                window.location.href = 'addMessagerID.php?vmsid=' + btoa(vmsID);
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

$(function() {

    $('.content').hide();
    $('#selectField').change(function() {
        var e = document.getElementById("selectField");
        var value = e.value;
        document.getElementById("vmsID").value = value;
        $('#VMSALL').hide();
        $('.content').hide();
        $('#' + $(this).val()).show();
    });
});

function deleteMSG(MSGCode, XVVmsCode) {
    Swal.fire({
        title: "",
        text: "ต้องการลบ " + MSGCode + " ใช่หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ใช่",
        cancelButtonText: "ไม่",
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.showLoading();
            $.ajax({
                type: "POST",
                url: "lib/delMSG.php",
                data: {
                    'msgCODE': MSGCode,
                    'XVVmsCode': XVVmsCode
                },
                success: function(result) {

                    window.location.href = "Schedulemessage.php?vmc=" + btoa(XVVmsCode);

                }
            });
        }
    });
}
// Basic example
$(document).ready(function() {

    //new DataTable('#UserTable');
    //new DataTable('#VMSTable');

    new DataTable('#UserTable', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });

    /*
    new DataTable('#VMSTable'', {
        ordering: false
    });
    */

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

            window.location.href = 'Schedulemessage.php?vmc=' + btoa('<?php echo $XVVmsCode;?>');
        }
    });
}

function show_modal(e, name, w, h) {

    $("#iframe_modal").attr("src", e.href);
    document.getElementById("Example_Title").innerText = name + " ขนาด กว้าง=" + w + " สูง=" + h;
    document.getElementById("iframe_modal").width = w;
    document.getElementById("iframe_modal").height = h;
    $('#myModal').modal('show');
    return false;
}

function vmsListNextstep() {
    document.getElementById('listMessageDiv').style.display = "block";
    document.getElementById('sendmessagevms').style.display = "block";
}

function vmsMSGNextStep() {
    document.getElementById('actionListlDiv').style.display = "block";
    document.getElementById('timer').style.display = "block";
}

function timerListNextStep() {
    document.getElementById('buttonSend').style.display = "block";
}

function vmsManuralNextstep() {
    document.getElementById('vmsSizeManualDiv').style.display = "block";
}

function vmsSizeManuralNextstep() {
    document.getElementById('actionManualDiv').style.display = "block";
    document.getElementById('timerManual').style.display = "block";
}

function timerManualNextStep() {
    document.getElementById('buttonManualSend').style.display = "block";
}

function processListMessage() {
    let messageListModalRadio = document.getElementById("messageListModalRadio");
    messageListModalRadio.checked = false;
    document.getElementById('vmsBanner').style.display = "none";
    document.getElementById("messageAutoRadio").checked = false;
    document.getElementById('inputTimer').value = '';
    document.getElementById('datetimepicker').value = '';
    $("#vmsMSG").val($("#vmsMSG").data("default-value"));
    $("#vms").val($("#vms").data("default-value"));
    document.getElementById('showDate').style.display = "none";

    document.getElementById("messageListModalRadio").checked = false;
    document.getElementById("messageManualModalRadio").checked = false;
    $("#vmsManual").val($("#vmsManual").data("default-value"));
    $("#vmsSize").val($("#vmsSize").data("default-value"));
    document.getElementById("messageCheckboxManual").checked = false;
    document.getElementById('inputTimerManual').value = '';
    document.getElementById('vmsBannerManual').style.display = "none";


}

function messageListValue(e) {
    if (e == 1) {
        document.getElementById('vmsBanner').style.display = "block";
        document.getElementById('vmsBannerManual').style.display = "none";
        document.getElementById('showDateManual').style.display = "none";
        $("#vmsManual").val($("#vmsManual").data("default-value"));
        $("#vmsSize").val($("#vmsSize").data("default-value"));
        document.getElementById("messageCheckboxManual").checked = false;
        document.getElementById('inputTimerManual').value = '';
        document.getElementById('datetimepicker3').value = '';
        document.getElementById('datetimepickerend3').value = '';

        document.getElementById('vmsSizeManualDiv').style.display = "none";
        document.getElementById('actionManualDiv').style.display = "none";
        document.getElementById('timerManual').style.display = "none";
        document.getElementById('buttonManualSend').style.display = "none";
    } else {
        document.getElementById('vmsBannerManual').style.display = "block";
        document.getElementById('vmsBanner').style.display = "none";
        document.getElementById("messageAutoRadio").checked = false;
        document.getElementById('inputTimer').value = '';
        document.getElementById('datetimepicker').value = '';
        document.getElementById('datetimepickerend2').value = '';
        $("#vmsMSG").val($("#vmsMSG").data("default-value"));
        $("#vms").val($("#vms").data("default-value"));
        document.getElementById('showDate').style.display = "none";

        document.getElementById('listMessageDiv').style.display = "none";
        document.getElementById('actionListlDiv').style.display = "none";
        document.getElementById('timer').style.display = "none";

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

function activityWork(e) {
    var checkedValue = $('.messageCheckbox:checked').val();
    if (checkedValue == 1) {
        document.getElementById('showDate').style.display = "block";
    } else {
        document.getElementById('showDate').style.display = "none";
        document.getElementById('datetimepicker').value = '';
        document.getElementById('datetimepickerend2').value = '';
    }
}

function sendSubmitNextStep() {
    var vmsManual = document.getElementById('vmsManual').value;
    var vmsSize = document.getElementById('vmsSize').value;
    var messageCheckboxManual = $('.messageCheckboxManual:checked').val();
    var inputTimerManual = document.getElementById('inputTimerManual').value;
    var datetimepicker3 = document.getElementById('datetimepicker3').value;
    var datetimepickerend3 = document.getElementById('datetimepickerend3').value;
    window.location.href = 'addMessager.php?vms=' + vmsManual + '&vmsSize=' + vmsSize + '&messageCheckboxManual=' +
        messageCheckboxManual + '&inputTimerManual=' + inputTimerManual + '&datestart=' + datetimepicker3 +
        '&dateend=' + datetimepickerend3;
}

function sendSubmitListMSG() {
    var vms = document.getElementById('vms').value;
    var vmsMSG = document.getElementById('vmsMSG').value;
    var checkedValue = $('.messageCheckbox:checked').val();
    var inputTimer = document.getElementById('inputTimer').value;
    if (inputTimer != '') {

        if (checkedValue == 1) {
            var datetimepicker = document.getElementById('datetimepicker').value;
            var datetimepickerend2 = document.getElementById('datetimepickerend2').value;
            if (datetimepicker != '' && datetimepickerend2 != '') {
                $.ajax({
                    type: "POST",
                    url: "lib/processScheduleMSG.php",
                    data: {
                        'vms': vms,
                        'vmsMSG': vmsMSG,
                        'checkedValue': checkedValue,
                        'inputTimer': inputTimer,
                        'datetimepicker': datetimepicker,
                        'datetimepickerend2': datetimepickerend2
                    },
                    success: function(result) {
                        window.location.href = 'Schedulemessage.php';
                    }
                });
            } else if (datetimepicker == '' && datetimepickerend2 != '') {
                alert("กรุณาวันที่เริ่มต้น");
            } else if (datetimepicker != '' && datetimepickerend2 == '') {
                alert("กรุณาวันที่สิ้นสุด");
            } else if (datetimepicker == '' && datetimepickerend2 == '') {
                alert("กรุณาวันที่เริ่มต้นและสิ้นสุด");
            }

        } else {
            $.ajax({
                type: "POST",
                url: "lib/processScheduleMSG.php",
                data: {
                    'vms': vms,
                    'vmsMSG': vmsMSG,
                    'checkedValue': checkedValue,
                    'inputTimer': inputTimer
                },
                success: function(result) {
                    window.location.href = 'Schedulemessage.php';
                }
            });
        }
    } else {
        alert("กรุณาใส่ระยะเวลา");
    }
}
$(document).ready(function() {
    $('.select2').select2({
        closeOnSelect: false
    });
});
</script>
<script>
/* When the user clicks on the button,
    toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

function filterFunction() {
    const input = document.getElementById("myInput");
    const filter = input.value.toUpperCase();
    const div = document.getElementById("myDropdown");
    const a = div.getElementsByTagName("a");
    for (let i = 0; i < a.length; i++) {
        txtValue = a[i].textContent || a[i].innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            a[i].style.display = "";
        } else {
            a[i].style.display = "none";
        }
    }
}
myFunction()

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}


async function ShowEx() {

    var vmsID = document.getElementById("vmsID").value;

    if (vmsID == '') {
        Swal.fire({
            title: "",
            text: "กรุณาเลือกป้าย",
            icon: "warning"
        });
        return false;
    }
    var source = '<?php echo $source;?>';
    var delay = '<?php echo $delay;?>';
    var countsource = '<?php echo $countsource;?>';
    var XIVmsPixelW = '<?php echo $XIVmsPixelW;?>';
    var XIVmsPixelH = '<?php echo $XIVmsPixelH;?>';
    var XVMsgCode = '<?php echo $XVMsgCode;?>';
    document.getElementById("iframe_modal").width = XIVmsPixelW;
    document.getElementById("iframe_modal").height = XIVmsPixelH;
  
   
    $('#myModal').modal('show');

    if (countsource > 0) {
        sourceArray = source.split(",");
        delayArray = delay.split(",");
        XVMsgCodeArray = XVMsgCode.split(",");
        for (let i = 0; i < countsource; i++) {

            $("#iframe_modal").attr("src", 'ifarme.php?msg=' + btoa(XVMsgCodeArray[i]));




            await sleep(delayArray[i] * 1000);

        }

    }

}

function SetDuration() {
    Swal.fire({
        title: 'pick a date:',
        type: 'question',
        html: '<input id="datepicker" readonly class="swal2-input datetimepicker">',
        customClass: 'swal2-overflow',
       
    }).then(function(result) {
        if (result.value) {
            alert($('#datepicker').val());
        }
    });
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