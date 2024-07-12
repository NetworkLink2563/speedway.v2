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
    width: 90%;
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
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;width:100%">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;ข้อความป้ายประชาสัมพันธ์
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
       
        <div  id="message"  style="display: block; margin-left: 10px;margin-right: 10px;" id="container">
      
            <div class="row">
                <div class="col-sm-4" >
                    <div style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;text-align: center;">
                    <p style="maring:0px;padding:0px;">เลือกป้ายประชาสัมพันธ์</p>
                    <table id="VMSTable" class="table" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th class="th-sm">รหัสป้าย
                                    </th>
                                    <th class="th-sm">ชื่อป้าย
                                    </th>
                                  
                                    <th class="th-sm" style="text-align: center">ขนาด
                                    </th>
                                   
                                    <th class="th-sm" style="text-align: center"></th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                        $stmt = "SELECT dbo.TMstMItmVMS.XVVmsCode, dbo.TMstMItmVMS.XVVmsName, dbo.TMstMMsgSize.XVMssName, dbo.TMstMMsgSize.XIMssWPixel, dbo.TMstMMsgSize.XIMssHPixel
                                 FROM dbo.TMstMItmVMS INNER JOIN
                                     dbo.TMstMMsgSize ON dbo.TMstMItmVMS.XVMssCode = dbo.TMstMMsgSize.XVMssCode
                                 ORDER BY dbo.TMstMItmVMS.XVVmsCode";
                        $query = sqlsrv_query($conn, $stmt);
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                        {
                      
                        ?>
                                <tr  style="font-size: 10pt">
                                    <td><?php echo $result['XVVmsCode']; ?></td>
                                    <td><?php echo $result['XVVmsName']; ?></td>
                                   
                                    <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel'];?>PX</td>
                                   
                                    <td>
                                        <div style="margin-top: 0px">
                                               <button type="button" onclick="ShowPlayList('<?php echo $result['XVVmsCode'];?>','<?php echo $result['XVVmsName'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $result['XIMssHPixel'];?>')" class="btn btn-primary btn-sm">แสดงข้อความป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;color:white" class="fa fa-arrow-circle-o-right"></i></button>
                                        </div>
                                    </td>
                
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                    </div>
                </div>
                <div class="col-sm-8" style="">
                    <div id="smsdetail" style="border-style: solid;border-color:#DCDCDC;margin:5px;padding:5px;border-width: 2px;">
                           <input type="hidden" id="XVVmsCode">
                           <div id="vmsdetail" class="text-center"></div>
                           <div class="row">
                              <div class="col-sm-6" >
                                <button type="button" onclick="ShowSms()" style=" float: left;" class="btn btn-primary btn-sm">เปลี่ยนข้อความป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;color:white" class="fa fa-file-text"></i></button>
                              </div>
                              <div class="col-sm-6 text-right" >
                                  <button type="button" onclick="sendmessageToVMS()"  class="btn btn-primary btn-sm">ส่งข้อความขึ้นป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;float: ritht;color:white" class="fa fa-cloud-upload"></i></button>
                              </div>
                           </div>
                           <div id="ShowPlayList"></div>
                       
                </div>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
    <br>
</div>











<div class="modal " id="modal-ShowSms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">เลือกข้อความป้าย</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
         
               <div id="ShowSms"></div>
      
         
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/dataTables.js"></script>
<script src="dist/js/dataTables.bootstrap4.js"></script>
<script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>
<script>
 $('#smsdetail').hide();  
function deleteMSG(XVPltCode){
    const obj = JSON.parse(result); 
            $Return=obj.Return;
            if($Return=='DeleteSuccess'){
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
                                 
                            }
                        });
               
            }else{
                Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
            }
}
function ShowPlayList(XVVmsCode,XVMssName,XIMssWPixel,XIMssHPixel){
    
    
     var dt=XVVmsCode+' '+XVMssName+' ขนาด '+XIMssWPixel+'x'+XIMssHPixel+'px';
     $('#XVVmsCode').val(XVVmsCode);
     $('#vmsdetail').html(dt);
     $('#smsdetail').show(); 
     ShowPlayListDetail(XVVmsCode);
   
    
}
function ShowSms(){
    $('#ShowSms').empty();
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsplayfunction.php",
        data: {
            'showsms': 'showsms'
        },
        success: function(result) {    
            $('#ShowSms').html(result);
            $('#modal-ShowSms').modal('show');
        }
    });
   
} 
function SelectSms(XVPltCode){
    var XVVmsCode=$('#XVVmsCode').val();
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsplayfunction.php",
        data: {
            'Insert': 'Insert',
            'XVVmsCode':XVVmsCode,
            'XVPltCode':XVPltCode
        },
        success: function(result) { 
           
            const obj = JSON.parse(result); 
            
            $Return=obj.Return;
            if($Return=='InsertSuccess'){
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
                                ShowPlayListDetail(XVVmsCode);
                                $('#modal-ShowSms').modal('hide');
                            }
                        });
               
            }else{
                Swal.fire("ไม่สามรถบันทึกได้", "", "warning");
            }
        }
    });
}
function ShowPlayListDetail(XVVmsCode){
    $('#ShowPlayList').empty();
    $.ajax({
        type: "POST",
        url: "messagepublicrelationsplayfunction.php",
        data: {
            'ShowPlayList': 'ShowPlayList',
            'XVVmsCode':XVVmsCode
        },
        success: function(result) { 
            $('#ShowPlayList').html(result);
        }
    });
}

function sendmessageToVMS() {
       var vmsID =  $('#XVVmsCode').val();

  
        Swal.showLoading();
        $.ajax({
            type: "POST",
            url: "messagepublicrelationsplayfunction.php",
            data: {
                'vmsID': vmsID,
                'SendMqtt':'SendMqtt'
            },
            success: function(result) {
             
                if (result == "Success") {
                    Swal.fire({
                        title: "",
                        text: "ส่งคำสั่ง ส่งข้อความขึ้นป้ายสำเร็จ",
                        icon: "success"
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
    
}


</script>
</body>

</html>