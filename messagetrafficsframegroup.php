<?php
include 'header.php';
include "lib/DatabaseManage.php";
/*
include "permission.php";

if(checkmenu($user,'001')==0)
{
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
if(checkmenu($user,'006')==0){
   
    header( "location: dashboard.php" );
    exit(0);
}else{
    if($_SESSION["XBDmnIsRead"]==0){
        header( "location: dashboard.php" );
        exit(0);
    }
}
    */
?>
<style>
@mixin modal-fullscreen() {
  padding: 0 !important; // override inline padding-right added from js
  
  .modal-dialog {
    width: 100%;
    max-width: none;
    height: 100%;
    margin: 0;
  }
  
  .modal-content {
    height: 100%;
    border: 0;
    border-radius: 0;
  }
  
  .modal-body {
    overflow-y: auto;
  }
 
}

@each $breakpoint in map-keys($grid-breakpoints) {
  @include media-breakpoint-down($breakpoint) {
    $infix: breakpoint-infix($breakpoint, $grid-breakpoints);
    
    .modal-fullscreen#{$infix} {
      @include modal-fullscreen();
    }
  
  }
}


// Styles for codepen
html {
  display: flex;
  height: 100%;
}

body {
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
}

.btn-open-modal {
  margin-bottom: 0.5em;
}
</style>
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
        box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
    ol.menu {
        list-style-type:none;
        display:table;
        float:none;
        margin:0 auto;
    }
    .menu li {
        display:inline;
        white-space:nowrap;
    }
    .menu span {
        float:left;
        display:table;
        padding:2px;
        cursor:pointer;
    }
    .button { /* ปุ่มเลือกสี ปกติ */
        margin:1px;
    }
    .hover { /* ปุ่มเลือกสี เมื่อเมาส์อยู่บน */
        background:#D3E4F5;
        border:1px solid #167FB2;
        margin:0;
    }
    .current { /* ปุ่มเลือกสี เมื่อเลือก */
        background:#D3E4F5;
        border:1px solid #167FB2;
        margin:0;
    }
    @font-face {
        font-family: SarunThangLuang;
        src: url(fonts/SarunThangLuang.ttf);
    }
</style>
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
input[type='file'] { font-size: 0; }
::file-selector-button { font-size: initial; }

*{
    box-sizing: border-box;
}

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa!important;
}

table th{
        background-color: #e8f4ff!important;
    }
    
    .btn-hover:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

    .container{
    background-color: white;
    
}

body {
        background: #e1f0fa;
    }

.flex-head{
    display: flex;
    margin: 1rem;
}

.flex-table{
    display: flex;
}

table th{
        background-color: #e8f4ff!important;
    }
    
    .btn-hover:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

    table td{
        transition: 0.5s;
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    table th{
        font-size: 1rem;
        font-weight: 500;
    }

    .table{
        text-align: center;
    }

    .flex-btn{
    display: flex;
    flex-direction: column;
    
}
</style>


<div class="container" style="position: relative; top: 75;">

<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem; display: flex;">

<div class="next-btn col-4"  style="text-align: left; padding: 0; ">
            <button onclick="location.href='/speedway/messagetrafficsframe.php'" class="btn btn-warning btn-hover shadow" style=""> กลับ Step2 สร้างข้อความจราจรแสดงบนป้าย <<</button>
            </div>

<div class="col-4" style="text-align: center;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> Step 3 สร้างชุดการแสดงป้ายจราจร
        </div>


        <div class="next-btn col-4"  style="text-align: right; padding: 0; ">
            <button onclick="location.href='/speedway/messagetrafficsplay.php'" class="btn btn-success btn-hover shadow" style="">>> Step4 ข้อความป้ายประชาสัมพันธ์</button>
            </div>



        </div>


    <div class="flex-head">

    <div class="col-2"  id="message" id="container" style="padding: 0; border-right: 3px double #cccc;">
            <div class="flex-btn" style="background-color: #f8f7f7cc;">
                            <div class="col-12" style="padding: .5rem .5rem;">
                               <button style="width: 100%; padding: 1rem 0rem; background-color: #006eb4;" type="button" id="btn_add"  class=" btn-hover btn btn-primary shadow" ><i style="width: 15%;" class="fa fa-file-text"></i>สร้างชุดการแสดงป้าย</button>
                            </div>
            </div>
            </div>




            <div class="col-10">

            <div class="flex-table">
                <div class="col-12" style="padding: 0;">
                        <table id="VMSTable" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th >รหัสชุดดป้าย
                                    </th>
                                    <th >ชื่อชุดป้าย
                                    </th>
                                   
                                    <th>ขนาด
                                    </th>
                                   
                                    <th ></th>
                                    <th >ลบ</th>
                                    <th >แก้ไข</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = "SELECT  dbo.TMstMPlaylist.XVPltCode, dbo.TMstMPlaylist.XVPltName, dbo.TMstMPlaylist.XVMssCode, dbo.TMstMPlaylist.XVPltType, dbo.TMstMMsgSize.XVMssName, dbo.TMstMMsgSize.XIMssWPixel, 
                         dbo.TMstMMsgSize.XIMssHPixel
FROM            dbo.TMstMPlaylist INNER JOIN
                         dbo.TMstMMsgSize ON dbo.TMstMPlaylist.XVMssCode = dbo.TMstMMsgSize.XVMssCode
WHERE        (dbo.TMstMPlaylist.XVPltType = N'2')
ORDER BY dbo.TMstMPlaylist.XVPltCode DESC";
                        $query = sqlsrv_query($conn, $stmt);
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                        {
                            $XIMssWPixel=$result['XIMssWPixel'];
                            $XIMssHPixel=$result['XIMssHPixel'];
                        ?>
                                <tr>
                                    <td><?php echo $result['XVPltCode']; ?></td>
                                    <td><?php echo $result['XVPltName']; ?></td>
                                   
                                    <td style="text-align: left">
                                        <?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                    
                                    <td>
                    <td>
                    <?php
                       $Disable="pointer-events: none;";
                       if($_SESSION["XBDmnIsDelete"]==1){
                          $Disable="";
                       }
                    ?>
                                <a href="#" class="del-item" style="color: #8d9499;<?php echo $Disable;?>"
                                onclick="deleteMSG('<?php echo $result['XVPltCode']; ?>');" ><i class="fa fa-trash-o"
                                    aria-hidden="true"></i></a>
                    </td>
                    <td>
                                <i title="แก้ไข" style="cursor: -webkit-grab; cursor: grab;" class="fa fa-pencil-square-o" aria-hidden="true"
                                onclick="SearchEdit('<?php echo $result['XVPltCode'];?>','<?php echo $result['XVPltName'];?>','<?php echo $result['XVMssCode'];?>');"></i>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
            </div>


</div>

</div>
</div>

</div>
<!-- end div flex container -->

<div class="modal modal-fullscreen" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="display: flex; background-color: #c6e9ff;">

      <div class="col-11" style="text-align: center; padding: 0;">
                    <img src="img/icon/computer.png" height="25" alt="Responsive image"><span style="font-size: 1.2rem;"> ชุดการแสดงป้าย/สร้างชุดการแสดงป้าย</span>
                    </div>

                    <div class="col-1" style="">
                    <button type="button" id="close-add" class="close" id="close-add" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
      
      </div>
      <div class="modal-body" style="">
          
           <input type="hidden" id="XVMssCode" >
     
           <div class="row" style="text-align: center; ">
                
               
                    <div class="form-group form-inline col-5" style="justify-content: end;">
                        <label style="margin-right: 5px;" for="XVPltCode">รหัสชุดแสดงป้าย:</label>
                        <input type="text" class="form-control" id="XVPltCode" readonly value="PLTYYMM-####">
                    </div>

                    <div class="form-group form-inline col-5" style="justify-content: start;">
                        <label style="margin-right: 15px;" for="XVPltName">ชื่อชุดแสดงป้าย:</label>
                        <input style="width:50%" type="text" class="form-control" id="XVPltName">
                    </div>

                    <div class="col-2 text-center" >
                        <button type="button" id="btn_save" class="btn" style="background-color:#009933;color:white">บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>  
                    </div>

                </div>
                <div class="row">
                    <div class="" style="padding: 0; width: 32.3333%;">
                       
                       <div  style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;text-align: right;">
                       <div class="table-responsive">
                          <table id="VMSTable" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th>รหัสข้อความประชาสัมพันธ์
                                    </th>
                                    <th>ชื่อข้อความประชาสัมพันธ์
                                    </th>
                                   
                                    <th >ขนาด
                                    </th>
                                   
                                 
                                    <th ></th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $stmt = "SELECT   dbo.TMstMMessageFrame.XVMsfCode, dbo.TMstMMessageFrame.XVMsfName, dbo.TMstMMessageFrame.XVMssCode, dbo.TMstMMessageFrame.XVMsfFormat, dbo.TMstMMessageFrame.XVMsgCodeF1, 
                                                                dbo.TMstMMessageFrame.XVMsgCodeF2, dbo.TMstMMessageFrame.XVMsgCodeF3, dbo.TMstMMessageFrame.XVMsgCodeF4, dbo.TMstMMessageFrame.XVMsgCodeF5, dbo.TMstMMessageFrame.XVMsfType, 
                                                                dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
                                        FROM            dbo.TMstMMessageFrame INNER JOIN
                                                                dbo.TMstMMsgSize ON dbo.TMstMMessageFrame.XVMssCode = dbo.TMstMMsgSize.XVMssCode
                                        WHERE        (dbo.TMstMMessageFrame.XVMsfType = N'2') 
                                        ORDER BY dbo.TMstMMessageFrame.XVMsfCode DESC";
                                $query = sqlsrv_query($conn, $stmt);
                                while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                {
                               
                                ?>
                                        <tr style="font-size: 10pt">
                                            <td><?php echo $result['XVMsfCode']; ?></td>
                                            <td><?php echo $result['XVMsfName']; ?></td>
                                           
                                            <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                           
                                            <td>
                                                <div style="margin-top: 0px">
                                                        <i title="เลือกไปทางขวา" style="cursor: -webkit-grab; cursor: grab; font-size: 24px;" class="fa fa-arrow-circle-right"
                                                        aria-hidden="true"
                                                        onclick="AddRight('<?php echo $result['XVMsfCode'];?>','<?php echo $result['XVMsfName'];?>')"></i>
                                                        
                                            </td>
                                            
                        
                            </tr>
                            <?php } ?>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                    <div class="col-8" style="padding: 0;">
                       
                       <div  style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;text-align: right;">
                       <div class="table-responsive">
                           <table id="myTable" class="table" >
                           <thead>
                                <tr style="font-size: 10pt">
                                    <th>ลำดับที่
                                    </th>
                                    <th>รหัสชุดแสดงป้าย
                                    </th>
                                    <th>ชื่อชุดแสดงป้าย
                                    </th>
                                    <th>ตั้งเวลา
                                    </th>
                                    <th>เริ่ม
                                    </th>
                                    <th>สิ้นสุด
                                    </th>
                                    <th>ระยะเวลา
                                    </th>
                                    <th>เปลี่ยนลำดับ
                                    </th>
                                    <th>ลบ
                                    </th>
                                  
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">
                    <!-- <div class="col-sm-12 text-center" >
                        <button type="button" id="btn_save" class="btn" style="background-color:#009933;color:white">บันทึก<i style="margin-left: 10px;color:white;font-size: 30px;" class="fa fa-save"></i></button>
                        
                    </div> -->
                </div>
                <br>
            </div>
           

      </div>
      <div class="modal-footer">
        <button type="button" id="hide-add" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
   
      </div>
    </div>
  </div>
</div>


<div class="modal " id="modal-MsgSize" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เลือกขนาดป้าย</h5>
        <button type="button" id="closemodal" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
     
               
                <select  id="SelMsgSize" class="input">
                        <?php
                               include "lib/DatabaseManage.php";
                               $stmt = "SELECT  [XVMssCode]
                                               ,[XVMssName]
                                               ,[XIMssWPixel]
                                               ,[XIMssHPixel]
                                               ,[XVWhoCreate]
                                               ,[XVWhoEdit]
                                               ,[XTWhenCreate]
                                               ,[XTWhenEdit]
                               FROM [NWL_SpeedWayTest2].[dbo].[TMstMMsgSize]";
                               $query = sqlsrv_query($conn, $stmt);
                              // echo '<option value="0">เลือกขนาดป้าย</option>';
                               while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                               {
                                  echo '<option value="'.$result["XVMssCode"].','.$result["XIMssWPixel"].','.$result["XIMssHPixel"].'">'.$result["XIMssWPixel"].'x'.$result["XIMssHPixel"].' PX</option>';
                               }
                               sqlsrv_close( $conn );
                        ?>
                       
                        
                </select>
                <div style="margin-top:10px;">
                    <button type="button"  id= "btn_next" class="btn btn-primary" >ถัดไป<i style="margin-left: 10px;color:#ffff00;font-size: 30px;" class="fa fa-forward"></i></button>
                  
                </div>
      
         
      </div>
      <div class="modal-footer">
        <button type="button" id="hidemodal" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
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

<script type="text/javascript">
function deleteMSG(XVPltCode) {
  
 
            $.ajax({
                type: "POST",
                url: "messagepublicrelationsframegroupfunction.php",
                data: {
                    'deletesms':'deletesms',
                    'XVPltCode': XVPltCode
                },
                success: function(result) {
                   
                    const obj = JSON.parse(result);
                    var Return=obj.Return;
                    if(Return=='DeleteSuccess'){
                        
                        Swal.fire({
                            icon: "success",
                            title: "",

                            text: "ลบสำเร็จ",
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: "Save",
                            denyButtonText: `Don't save`
                            }).then((result) => {
                        
                                if (result.isConfirmed) {
                                
                                    window.location.href = 'messagepublicrelationsframegroup.php';
                                }
                            });
                    }else{
                             Swal.fire("ไม่สามรถลบได้มีการใช้อยู่ที่ป้าย "+Return, "", "warning");
                    }
                    
                }
            });
       
    
}
function AutoId(){
        let input = document.getElementsByName('idarray[]');
        let inputbtnup= document.getElementsByName('btnup[]');
        let inputbtndown=document.getElementsByName('btndown[]');
        for (let i = 1; i < input.length+1; i++) {
            let a = input[i-1];
            let b= inputbtnup[i-1];
            let c= inputbtndown[i-1];
            a.value=i;
            b.value=i;
            c.value=i;
            
        }
}    

$(document).ready(function(){
    $("#myTable").delegate('button.up','click', function(e) {
        if($(this).val()==1){
             return false;
        }
        var it = $(this).closest('tr');
        var prev = $(this).closest('tr').prev('tr');
        if(it.attr("id") != $("tr:first").attr("id")){
            it.remove();
            it.insertBefore(prev);
        }   
        AutoId();
    });
    $("#myTable").delegate('button.down','click', function(e) {      
        let input = document.getElementsByName('idarray[]');
      
        if($(this).val()==input.length){
             return false;
        } 
        var it = $(this).closest('tr');
        var next = $(this).closest('tr').next('tr');
        if(it.attr("id") != $("tr:last").attr("id")){
            it.remove();
            it.insertAfter(next);
        } 
        AutoId();          
    });
});
</script>
<script>

function SearchEdit(XVPltCode,XVPltName,XVMssCode){
    $("#XVPltCode").val(XVPltCode);
    $("#XVPltName").val(XVPltName);
    $("#XVMssCode").val(XVMssCode);
    for(var i=0;i<tablerow;i++){
         document.getElementById("myTable").deleteRow(1);
    } 
    $.ajax({
                type: "POST",
                url: "messagepublicrelationsframegroupfunction.php",
                data: {
                    'SearchEdit': 'SearchEdit',
                    'XVPltCode':XVPltCode
            },
            success: function(result) {
              
                    tablerow=0;
                    const obj = JSON.parse(result);
                    for(var i=0;i<obj.length;i++){
                        var XIPltSeqNo=obj[i].XIPltSeqNo;
                        var XVMsfCode=obj[i].XVMsfCode;
                        var XVMsfName=obj[i].XVMsfName;
                        var XIPltDuration=obj[i].XIPltDuration;
                        var XBPltHasExpiration=obj[i].XBPltHasExpiration;
                        var XTPltStart=obj[i].XTPltStart;
                        var XTPltEnd=obj[i].XTPltEnd;
                        AddEdit(XIPltSeqNo,XVMsfCode,XVMsfName,XIPltDuration,XBPltHasExpiration,XTPltStart,XTPltEnd);
                    }
                    $("#modal-add").modal("show");
                    
            }
    });
    
   
}
var tablerow=0;   
function AddRight(XVMsfCode,XVMsfName){
  tablerow++;
  var table = document.getElementById("myTable");
  var row = table.insertRow(1);
  row.id = tablerow;
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);   
  var cell8 = row.insertCell(7);
  var cell9 = row.insertCell(8);
  var DS='DS'+tablerow;
  var DE='DE'+tablerow;
  var CK='CK'+tablerow;
  var incheckarray="incheckarray"+tablerow;
  cell1.innerHTML='<div> <input   type="text"  name="idarray[]" size="4" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" readonly></div>'; 
  cell2.innerHTML='<div> <input type="text"  name="codearray[]" size="14" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" value="'+XVMsfCode+'" readonly></div>';
  cell3.innerHTML='<div> <input type="text"  name="ckarray"style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" value="'+XVMsfName+'" title="'+XVMsfName+'" readonly></div>';
  cell4.innerHTML='<div style="padding-left:12px;padding-top:8px;"><input type="checkbox" id="'+CK+'" onclick="CheckBox('+tablerow+')"><input type="text" id="'+incheckarray+'" name="incheckarray[]" value="0" hidden></div>';
  cell5.innerHTML='<div> <input type="text" id="'+DS+'" class="datetimepicker" size="18" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" name="sdatearray[]"></div>';
  cell6.innerHTML='<div> <input type="text" id="'+DE+'"class="datetimepicker"  size="18" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" name="edatearray[]"></div>';
  cell7.innerHTML='<div><input type="number"  id="playtime" min="1" max="1000" value="5" style="border-radius: 5px;border-color:#DCDCDC;" name="durationarray[]"></div>';
  cell8.innerHTML='<button type="button" class="up"  name="btnup[]">ขึ้น</button><button type="button" class="down" name="btndown[]">ลง</button>';
   cell9.innerHTML='<button type="button" onclick="deleletablerow('+tablerow+',\''+XVMsfCode+'\')" >ลบ</button>';
  AutoId();
  jQuery('.datetimepicker').datetimepicker({
         format:'Y-m-d H:i'
  });
}    
function AddEdit(XIPltSeqNo,XVMsfCode,XVMsfName,XIPltDuration,XBPltHasExpiration,XTPltStart,XTPltEnd){
  tablerow++;
  var table = document.getElementById("myTable");
  var row = table.insertRow(1);
  row.id = tablerow;
  var cell1 = row.insertCell(0);
  var cell2 = row.insertCell(1);
  var cell3 = row.insertCell(2);
  var cell4 = row.insertCell(3);
  var cell5 = row.insertCell(4);
  var cell6 = row.insertCell(5);
  var cell7 = row.insertCell(6);   
  var cell8 = row.insertCell(7);
  var cell9 = row.insertCell(8);
  var DS='DS'+tablerow;
  var DE='DE'+tablerow;
  var CK='CK'+tablerow;
  var checked="";
  if(XBPltHasExpiration==1){
    checked='checked';
  }else{
    XTPltStart='';
    XTPltEnd='';
  }
  var incheckarray="incheckarray"+tablerow;
  cell1.innerHTML='<div> <input   type="text"  name="idarray[]" size="4" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" readonly></div>'; 
  cell2.innerHTML='<div> <input type="text"  name="codearray[]" size="14" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" value="'+XVMsfCode+'" readonly></div>';
  cell3.innerHTML='<div> <input type="text"  name="ckarray"style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" value="'+XVMsfName+'" title="'+XVMsfName+'" readonly></div>';
  cell4.innerHTML='<div style="padding-left:12px;padding-top:8px;"><input type="checkbox" id="'+CK+'" onclick="CheckBox('+tablerow+')" '+checked+'><input type="text" id="'+incheckarray+'" name="incheckarray[]" value="'+XBPltHasExpiration+'" hidden></div>';
  cell5.innerHTML='<div> <input type="text" id="'+DS+'" class="datetimepicker" size="18" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" name="sdatearray[]" value="'+XTPltStart+'"></div>';
  cell6.innerHTML='<div> <input type="text" id="'+DE+'"class="datetimepicker"  size="18" style="border-radius: 5px;border-color:#DCDCDC;background-color:rgb(220, 220, 220);" name="edatearray[]" value="'+XTPltEnd+'"></div>';
  cell7.innerHTML='<div><input type="number"  id="playtime" min="1" max="1000" value="5" style="border-radius: 5px;border-color:#DCDCDC;" name="durationarray[]"></div>';
  cell8.innerHTML='<button type="button" class="up"  name="btnup[]">ขึ้น</button><button type="button" class="down" name="btndown[]">ลง</button>';
  cell9.innerHTML='<button type="button" onclick="deleletablerow('+tablerow+',\''+XVMsfCode+'\')" >ลบ</button>';
  AutoId();
  jQuery('.datetimepicker').datetimepicker({
         format:'Y-m-d H:i'
  }); 
}
function deleletablerow(row,XVMsfCode){
    Swal.fire({
                        icon: "info",
                        title: "",

                        text: "ต้องการลบ"+XVMsfCode+" ใช่หรือไม่",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "ใช่",
                        denyButtonText: 'ไม่'
    }).then((result) => {
                    
        if (result.isConfirmed) {
                            
            document.getElementById(row).remove();            
        }
    });
   
}
function CheckBox(id){
   
   var DS='DS'+id;
   var DE='DE'+id;
   var CK='CK'+id;
   var INCK='#incheckarray'+id;
   var checkBox = document.getElementById(CK);
  
   if (checkBox.checked == true){
    
       $(INCK).val(1);
       document.getElementById(DS).disabled = false;
       document.getElementById(DE).disabled = false;
       document.getElementById(DS).style.backgroundColor = "white";
       document.getElementById(DE).style.backgroundColor = "white";
   } else {
       $(INCK).val(0);
       document.getElementById(DS).disabled = true;
       document.getElementById(DE).disabled = true;
       document.getElementById(DS).style.backgroundColor = "rgb(220, 220, 220)";
       document.getElementById(DE).style.backgroundColor = "rgb(220, 220, 220)";
   }
       
}
$("#btn_save").click(function(){
    let id = document.getElementsByName('idarray[]');
    let code = document.getElementsByName('codearray[]');
    let ck= document.getElementsByName('incheckarray[]');
    var duration=document.getElementsByName('durationarray[]');
    var sdate=document.getElementsByName('sdatearray[]');
    var edate=document.getElementsByName('edatearray[]');
    var data='[';
    for (let i = 1; i < id.length+1; i++) {
            let a = id[i-1];
            let b = code[i-1];  
            let c = ck[i-1];
            let d= duration[i-1];
            let e= sdate[i-1];
            let f= edate[i-1];
            data=data+'{';
            data=data+'"XVMsfCode":"'+b.value+'",';
            data=data+'"XIPltSeqNo":"'+a.value+'",';
            data=data+'"XIPltDuration":"'+d.value+'",';
            data=data+'"XBPltHasExpiration":"'+c.value+'",';
            data=data+'"XTPltStart":"'+e.value+'",';
            data=data+'"XTPltEnd":"'+f.value+'"';
            data=data+'},';
    }
    data = data.substring(0, data.length-1);
    data=data+']';
    var XVPltCode=$("#XVPltCode").val();
    var XVPltName=$("#XVPltName").val();
    var XVMssCode=$("#XVMssCode").val();
   
    if(XVPltName==''){
            Swal.fire("กรุณาใส่ชื่อชุดแสดงป้าย", "", "warning");
            return false;
    } 
    $.ajax({
                type: "POST",
                url: "messagetrafficsframegroupfunction.php",
                data: {
                    'InsertUpdate': 'InsertUpdate',
                    'XVPltCode':XVPltCode,
                    'XVPltName':XVPltName,
                    'XVMssCode':XVMssCode,
                    'data':data
            },
            success: function(result) {
              
                    const obj = JSON.parse(result);
                    var Return=obj.Return;
                    if(Return!='InsertError'){
                        $("#XVPltCode").val(XVPltCode); 
                        Swal.fire({
                            icon: "success",
                            title: "",

                            text: "บันทึกสำเร็จ",
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: "Save",
                            denyButtonText: `Don't save`
                            }).then((result) => {
                        
                                if (result.isConfirmed) {
                                
                                    window.location.href = 'messagetrafficsframegroup.php';
                                }
                            });
                    }else{
                             Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
                    }
            }
    });
      
});
$("#btn_add").click(function(){
    for(var i=0;i<tablerow;i++){
         document.getElementById("myTable").deleteRow(1);
    } 
    $("#modal-MsgSize").modal("show");
});
$("#btn_next").click(function(){
     
      tablerow=0;
      var optionSelected = $("#SelMsgSize").val();
      const SizeArray =optionSelected.split(",");
      var XVMssCode=SizeArray[0];
      var w=SizeArray[1];
      var h=SizeArray[2];
     $("#XVMssCode").val(XVMssCode);
      $("#modal-MsgSize").modal("hide");
      $("#modal-add").modal("show");
  });
   
$(document).ready(function() {
    jQuery('.datetimepicker').datetimepicker({
         format:'Y-m-d H:i'
    });
});

</script>

<script>
    $("#closemodal").click(function(){
    $("#modal-MsgSize").modal("hide")
    })
    $("#hidemodal").click(function(){
    $("#modal-MsgSize").modal("hide")
    })
    $("#close-add").click(function(){
    $("#modal-add").modal("hide")
    })
    $("#hide-add").click(function(){
    $("#modal-add").modal("hide")
    })
</script>


</body>

</html>