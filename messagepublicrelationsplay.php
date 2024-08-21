<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "service/privilege.php";

$menucode="013";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ
$pri_contr=$pri[0]['pri_del'];  // สิทธิ์การควบคุม

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

body {
        background: #e1f0fa;
    }

.flex-content{
     display: flex;
     flex-direction: column;

}

.container{
    background-color: white;
}

table {
    text-align: center;
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
        background-color: #e8f4ff!important;
    }

.flex-header{
    display: flex;
}
.shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

#ShowPlayList p{
font-size: 1rem;
text-align: center;
}

.dt-search input{
background-image: url('img/icon/mag.png');
 background-repeat: no-repeat;
 background-size: 18px;
 background-position: left 12px top 5px;
 text-indent: 30px;
 opacity: 0.7;
 margin: 0rem 0.1rem 0.3rem 0rem;
    }




    #dt-search-0{
        width: 255px;
        font-size: .9rem;
    }
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> origin/main

    table tr th {
        border: 1px solid #cccc;
    }

    table tr td {
        border: 1px solid #cccc;
    }
<<<<<<< HEAD
=======
=======
>>>>>>> origin/main
>>>>>>> origin/main
</style>



<div class="container" style="position: relative; top: 75; padding-bottom: 3rem;">

<div style=" text-align: center;  border-bottom: 3px double #cccc; padding: 1rem; margin: .4rem; display: flex;">


            <div class="next-btn col-4"  style="text-align: left; padding: 0; ">
<<<<<<< HEAD
            <a href="./messagepublicrelationsframegroup.php" class="btn btn-primary btn-hover shadow" style="background-color: #006eb4;">กลับ Step3 ชุดข้อความ <<</a>
=======
<<<<<<< HEAD
            <a href="./messagepublicrelationsframegroup.php" class="btn btn-primary btn-hover shadow" style="background-color: #006eb4;">กลับ Step3 ชุดข้อความ <<</a>
=======
            <a href="http://192.168.55.11/speedway.v2/messagepublicrelationsframegroup.php" class="btn btn-primary btn-hover shadow" style="background-color: #006eb4;">กลับ Step3 ชุดข้อความ <<</a>
>>>>>>> origin/main
>>>>>>> origin/main
            </div>

            <div class="col-4" style="text-align: center;">
            <img src="img/icon/edit.png" height="25" alt="Responsive image"> step4 ข้อความป้ายประชาสัมพันธ์
            </div>

            <div class="next-btn col-4"  style="text-align: right; padding: 0; ">
            <!-- <button onclick="location.href='/speedway/messagepublicrelationsplay.php'" class="btn btn-primary btn-hover shadow" style="background-color: #006eb4;">>> Step4 ข้อความป้ายประชาสัมพันธ์</button> -->
            </div>


        <!-- <div class="shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; margin-bottom: .5rem;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> เลือกป้ายประชาสัมพันธ์</a>
        </div> -->

        </div>

        <?php if($pri_r != 0){ ?>
        <div class="flex-header">
       
        <div class="flex-content col-5" style="padding: 0;">


        <div  id="message"  style="" id="container">
      
            <div class="col-12" style=" padding: 0; border-right: 3px double #cccc; padding-right: .5rem;" >
                    <table id="VMSTable" class="table table-striped table-hover">
                            <thead>
                                <tr >
                                    <th class="th-sm">รหัสป้าย
                                    </th>
                                    <th style="text-align:left;"  class="th-sm">ชื่อป้าย</th>
                                  
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
                                <tr>
                                    <td><?php echo $result['XVVmsCode']; ?></td>
                                    <td style="text-align: left;" ><?php echo $result['XVVmsName']; ?></td>
                                   
                                    <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel'];?>PX</td>
                                   
                                    <td>
                                        <div>
                                               <button type="button" onclick="ShowPlayList('<?php echo $result['XVVmsCode'];?>','<?php echo $result['XVVmsName'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $result['XIMssHPixel'];?>')" class="btn btn-primary btn-sm">แสดงข้อความป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;color:white" class="fa fa-arrow-circle-o-right"></i></button>
                                        </div>
                                    </td>
                
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                    </div>



                   
                    </div>
                    <!-- end div flex content -->


                </div>
                <div class="col-7" style="padding: 0;">
                    <div id="smsdetail">
                           <input type="hidden" id="XVVmsCode">
                           
                           <div class="row" style="margin: .5rem;">
                            <h5 style="text-align: center;">รหัสป้าย</h5>
                           <div id="vmsdetail" class="text-center" style="padding: .5rem; background-color: #efefefcc; font-size: 1.2rem; border-bottom: 1px solid #cccc; margin-bottom: .5rem; font-weight: 300;"></div>
                           

                              <div class="col-4" style="text-align: center;" >
                                <?php if($pri_w != 0){?>
                                <button type="button" onclick="ShowSms()" style=" " class="btn btn-warning shadow">เปลี่ยนข้อความป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;color:white" class="fa fa-file-text"></i></button>
                                <?php } ?>
                              </div>
                              <div class="col-4" style="text-align:center;">
                                <?php if($pri_w != 0){ ?>
                                <button type="button" onclick="CancelSms()" style=" margin-right: 10px" class="btn btn-danger shadow">ยกเลิกข้อความป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;color:white" class="fa fa-file-text"></i></button>
                                <?php } ?>
                                </div>
                              <div class="col-4 " style="text-align: center;">
                              <?php if($pri_w != 0){?>
                                  <button type="button" onclick="sendmessageToVMS()"  class="btn btn-success shadow">ส่งข้อความขึ้นป้าย<i style="margin-left: 10px;color:#09C703;font-size: 18px;float: ritht;color:white" class="fa fa-cloud-upload"></i></button>
                                  <?php } ?>
                              </div>
                           </div>

                           <div id="ShowPlayList" style="padding: 1rem; margin-top: .5rem;"></div>
                       
                </div>
         




                </div>
<!-- end div flex-header -->

 <?php }else{ echo '<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';} ?>
</div>
<!-- end div container -->





<div class="modal " id="modal-ShowSms" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog  modal-lg" role="document">
    <div class="modal-content">
    <div class="modal-header" style="display: flex;">
        <div class="col-11" style="text-align: center;">
        <h4 class="modal-title">เลือกข้อความป้าย</h4>
        </div>
        <div class="col-1">
        <button type="button" id="close-sms" class="btn-close" data-dismiss="modal"></button>
        </div>
      </div>
      <div class="modal-body text-center">
         
               <div id="ShowSms"></div>
      
         
      </div>
      <div class="modal-footer">
        <button type="button" id="hide-sms" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
      
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>
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
 function CancelSms(){
    Swal.fire({
        title: "",
        text: "ยกเลิกข้อความป้ายใช่หรือไม่?",
        icon: "question",
        confirmButtonText: "ใช่",
        showCancelButton: false,
        showDenyButton: true,
        denyButtonText: 'ไม่'

    }).then((result) => {
        
        if (result.isConfirmed) {
  
            var XVVmsCode=$('#XVVmsCode').val();
            $.ajax({
                type: "POST",
                url: "messagepublicrelationsplayfunction.php",
                data: {
                    'cancelsms': 'cancelsms',
                    XVVmsCode:XVVmsCode
                },
                success: function(result) {   
                    
                    const obj = JSON.parse(result); 
                    $Return=obj.Return;
                
                    if($Return=='CancelSuccess'){
                    
                        
                        $('#ShowPlayList').empty();
                    }
                    
                }
            });
        }
    });
 
} 
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
    Swal.fire({
        title: "",
        text: "ต้องการส่งข้อความขึ้นป้ายใช่หรือไม่?",
        icon: "question",
        confirmButtonText: "ใช่",
        showCancelButton: false,
        showDenyButton: true,
        denyButtonText: 'ไม่'

    }).then((result) => {
        
        if (result.isConfirmed) {
        
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
                        
                        const obj = JSON.parse(result);
                        if (obj.Return == "Success") {
                            Swal.fire({
                                title: "",
                                text: "ส่งคำสั่ง ส่งข้อความขึ้นป้ายสำเร็จ",
                                icon: "success"
                            });
                        }

                        if (obj.Return == "Nodata") {
                            Swal.fire({
                                title: "",
                                text: "ส่งคำสั่งไม่ได้ กรุณาเลือกข้อความป้าย",
                                icon: "warning"
                            });
                        }
                        if (obj.Return == "Fail") {
                            Swal.fire({
                                title: "",
                                text: "ส่งคำสั่งไม่ได้ ลองใหม่อีกครั้ง",
                                icon: "warning"
                            });
                        }
                         
                    }
                });
                
        }
    });
}


</script>

<script>
 
    $("#close-sms").click(function(){
    $("#modal-ShowSms").modal("hide")
    })
    $("#hide-sms").click(function(){
    $("#modal-ShowSms").modal("hide")
    })

</script>

<script>

$(document).ready(function() {
new DataTable('#VMSTable', {
    order: [[0, 'desc']],
    
    layout: {
         topEnd: {
             search: {
                 placeholder: 'กรอกข้อความที่ต้องการค้นหา...'
             }
         }
     },
     language: {
        zeroRecords: '" ไม่พบข้อมูลที่ค้นหา "',
        info: 'แสดง _END_ รายการ จากทั้งหมด _MAX_ รายการ',
        infoFiltered: '',
        infoEmpty: 'ไม่พบรายการ'
    }
             
});
});
    </script>

</body>

</html>