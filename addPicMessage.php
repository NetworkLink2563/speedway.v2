<?php
include 'header.php';
include "lib/DatabaseManage.php";
$msgsize= $_REQUEST["msgsize"];
$mmstype= $_REQUEST["mmstype"];
$msgsize=base64_decode($msgsize);
$mmstype=base64_decode($mmstype);

$sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$msgsize."' ORDER BY XVMssCode ASC";

$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";


$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);



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
input[type='file'] { font-size: 0; }
::file-selector-button { font-size: initial; }
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">
    <?php if($_GET['op']!='add'  ) {?>
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;
                      <?php 
                              if($mmstype==2){
                                 echo "เพิ่มรายการรูปภาพ";
                               }
                               if($mmstype==3){
                                echo "เพิ่มรายการวีดีโอ";
                              }
                      ?>
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        <input type="hidden" id="idmsgSize" value="<?php echo $result_row['XVMssCode'];?>">
        <input type="hidden" id="mmstype" value="<?php echo   $mmstype;?>">
      
  

        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
            <?php
                              if($mmstype==2){
                                 echo "ชื่อรูปภาพ";
                               }
                               if($mmstype==3){
                                echo "ชื่อวีดีโอ";
                              }
            ?>                  
            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="msgName" name="msgName" class="input" value="">
            </div>
        </div>

        <div class="row" style="margin-top: 10;">
            <div class="col-sm-2">
            </div>
            <div class="col-sm-8" style="margin-top: 5px">
                <div class="container">
                    <div class="card">
                        <label for="images" class="drop-container" id="dropcontainer">
                        <i class="fa fa-arrow-circle-o-up" style="font-size:48px;color:#212529;"></i>
                            <span class="drop-title">คลิกเลือกไฟล์</span>
                            <h6 id="h4fname"></h6>
                            <?php
                               if($mmstype==2){
                                 echo '<input type="file" id="images" accept="image/*" required>';
                               }
                               if($mmstype==3){
                                 echo '<input type="file" id="images" accept="video/*" required>';
                              }
                              ?>
                           
                            <button type="button"  id= "btnpreViewsMsg" class="btn btn-primary" onclick="preViewsMsg('<?php echo $resultProcedSQL['ptCode'];?>',1);">เพิ่มข้อความ</button>
                        </label>

                    </div>
                </div>
            </div>
        </div><br>
       
        <br>
    </div>
    <?php }else{
        $msgid=base64_decode($_GET['msg']);
        $stmt = "SELECT TMstMMessage.XVMsgCode,TMstMMsgSize.XIMssWPixel,TMstMMsgSize.XIMssHPixel,TMstMMessage.XVMssCode FROM TMstMMessage 
                INNER JOIN TMstMMsgSize ON TMstMMsgSize.XVMssCode=TMstMMessage.XVMssCode WHERE TMstMMessage.XVMsgCode='".$msgid."'";
       
        $query = sqlsrv_query($conn, $stmt);
        $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        ?>
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;ตัวอย่างข้อความ
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4"><iframe src="ifarme.php?msg=<?php echo $_GET['msg'];?>" title="description"
                    width="<?php echo $result['XIMssWPixel'];?>" height="<?php echo $result['XIMssHPixel'];?>"
                    scrolling="no"></iframe></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px"><button type="submit" class="btn btn-info"
                    onclick="blackMSG('<?php echo $result['XVMsgCode'];?>','<?php echo base64_encode($result['XVMssCode']);?>');">ย้อนหลับ</button>
            </div>
            <div class="col-sm-1" style="margin-top: 5px"><button type="submit" class="btn btn-success"
                    onclick="selectMSG('<?php echo $result['XVMsgCode'];?>');">เพิ่มข้อความ</button>
            </div>
        </div>
        <br>
    </div>
    <?php }?>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
</script>
<script>
window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')
</script>


<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script>
function selectMSG(e) {
    $.ajax({
        type: "POST",
        url: "lib/confirmMessage.php",
        data: {
            'msgCODE': e
        },
        success: function(result) {
            window.location.href = 'mainMessage.php';

        }
    });
}

function blackMSG(e, b) {
    $.ajax({
        type: "POST",
        url: "lib/delMessage.php",
        data: {
            'msgCODE': e
        },
        success: function(result) {
            window.location.href = 'addMessage.php?msgsize=' + b;
        }
    });
}

$("#btnpreViewsMsg").hide();
function preViewsMsg(e, b) {
    
                var idmsgSize = document.getElementById('idmsgSize').value;
                var XVMsgName = document.getElementById('msgName').value;
           
                if (XVMsgName == '') {
                    
                    Swal.fire("กรุณาใส่ชื่อรูปภาพ", "", "info");
                    return false;
                }
                
                var XVMsgStatus = "2";
                var XVMsgType=document.getElementById('mmstype').value;
                var fd = new FormData(); 
                var files = $('#images')[0].files[0]; 
                fd.append('file', files); 
                fd.append('XVMsgName', XVMsgName); 
                fd.append('XVMsgStatus', XVMsgStatus); 
                fd.append('XVMssCode', idmsgSize); 
                fd.append('XVMsgType', XVMsgType); 
                swal.showLoading();
                $.ajax({ 
                    url: 'addPicMessage_libery.php', 
                    type: 'post', 
                    data: fd, 
                    contentType: false, 
                    processData: false, 
                    success: function(response){
                      
                     
                        const RetArr = JSON.parse(response);
                        if (RetArr.Return=="True"){
                            
                            Swal.fire({
                                title: "",
                                icon: "success",
                                text: "บันทึกสำเร็จ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                    window.location.href = 'mainMessage.php';
                                }
                            });
                            
                           
                          
                        }else{
                            Swal.fire({
                                title: "",
                                icon: "warning",
                                text: "ไม่สามรถบันทึกได้ โปรดติดต่อผู้ดูแลระบบ",
                                confirmButtonText: "ตกลง",
                          
                            }).then((result) => {
                          
                                if (result.isConfirmed) {
                                    window.location.href = 'mainMessage.php';
                                }
                            });
                           
                        }
                       
                    }, 
                }); 
    

}



$('input[type="file"]').change(function (e) {
    const fname = e.target.files[0].name;
    $("#h4fname").text(fname);
    $("#btnpreViewsMsg").show();
});
</script>