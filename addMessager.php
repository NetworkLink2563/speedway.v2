<?php
ob_start();
session_start();
include 'header.php';
include "lib/DatabaseManage.php";
$msgsize=base64_decode($_GET['msgsize']);
$sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$msgsize."' ORDER BY XVMssCode ASC";
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$ProcedSQL = "DECLARE @tCode nvarchar(100)
EXEC dbo. STP_NWLtGetMaxCode 'TMstMMessage', @tCode OUTPUT
PRINT 'TMstMMessage' + '-->' + @tCode
";
$queryProcedSQL = sqlsrv_query($conn, $ProcedSQL);
$resultProcedSQL = sqlsrv_fetch_array($queryProcedSQL, SQLSRV_FETCH_ASSOC);

$sql_size = "SELECT TOP 1 XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode = '".$_GET['vmsSize']."'";
$query_size = sqlsrv_query($conn, $sql_size);
$result_size = sqlsrv_fetch_array($query_size, SQLSRV_FETCH_ASSOC);

$sqlUpdate = "DELETE FROM TMstMMessage WHERE XVMssCode='".$_GET['vmsSize']."' AND XVWhoCreate='".$_SESSION['userName']."' AND XVMsgStatus=3";
$queryUpdate = sqlsrv_query($conn, $sqlUpdate);

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
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;สร้างข้อความ
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="row">
            <div class="col-sm-3">
                <input id="vms" type="hidden" value="<?php echo $_GET['vms'];?>">
                <input id="vmsSize" type="hidden" value="<?php echo $_GET['vmsSize'];?>">
                <input id="messageCheckboxManual" type="hidden" value="<?php echo $_GET['messageCheckboxManual'];?>">
                <input id="inputTimerManual" type="hidden" value="<?php echo $_GET['inputTimerManual'];?>">
                <input id="datestart" type="hidden" value="<?php echo $_GET['datestart'];?>">
                <input id="dateend" type="hidden" value="<?php echo $_GET['dateend'];?>">
                <input id="msgBG" type="hidden" value="">
                <input id="bgcolor" type="hidden" value="">
                <input id="usercolor" type="hidden" value="">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">สีพื้นหลัง
            </div>
            <div class="col-sm-4" style="margin-left: -170;">

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
        <div class="row" style="margin-top: 10">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ข้อความ
            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <textarea name="detailck" id="detailck" ></textarea>
            </div>
        </div>
        <div class="row" style="margin-top: 10">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
            </div>
            <div class="col-sm-4" style="margin-left: -10;">
                <div style="text-align: left" >
                    <button type="submit" class="btn btn-primary" onclick="previewNextStep();">บันทึก</button>
                </div>
            </div>
        </div>
        <br>
    </div>
</div>


<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script type="text/javascript" src="Ckeditor/ckeditor/ckeditor.js"></script>

<script src="dist/js/jquery.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script>

    function previewNextStep(){
        var data = CKEDITOR.instances.detailck.getData();
        var vms=document.getElementById('vms').value;
        var vmsSize=document.getElementById('vmsSize').value;
        var messageCheckboxManual=document.getElementById('messageCheckboxManual').value;
        var inputTimerManual=document.getElementById('inputTimerManual').value;
        var datestart=document.getElementById('datestart').value;
        var dateend=document.getElementById('dateend').value;
        var msgBG=document.getElementById('msgBG').value;
        var bgcolor=document.getElementById('bgcolor').value;
        var usercolor=document.getElementById('usercolor').value;

        $.ajax({
            type: "POST",
            url: "addMessage_lib.php",
            data: {'data':data,'vms':vms,'vmsSize':vmsSize,'messageCheckboxManual':messageCheckboxManual,'inputTimerManual':inputTimerManual,'datestart':datestart,'dateend':dateend,'msgBG':msgBG },
            success: function(result) {
                window.location.href = 'ifarmeManual.php?vmsSize='+vmsSize+'&vms='+vms+'&messageCheckboxManual='+messageCheckboxManual+'&inputTimerManual='+inputTimerManual+'&datestart='+datestart+'&dateend='+dateend+'&msgBG='+msgBG+'&user=<?php echo $_SESSION['userName'];?>&status=3';
            }
        });
    }
    CKEDITOR.replace('detailck',{
        toolbar :
            [
                
                { name: 'colors', items : [ 'TextColor', 'BGColor'  ] },
                { name: 'colors', items : [ 'JustifyLeft', 'JustifyCenter','JustifyRight'  ] },
                { name: 'styles', items : [ 'Styles','Format','Color','FontSize' ] },

            ],
        width: "<?php echo $result_size['XIMssWPixel']+((3/100)*$result_size['XIMssWPixel']); ?>px",
        height: "<?php echo $result_size['XIMssHPixel']+((3/100)*$result_size['XIMssHPixel']); ?>px"});

    //ปุ่มเลือกสี
    for (i = 0; i < <?=count($color)?>; i++) {
        var obj = document.getElementById("color" + i);
        obj.onmouseover = function(){this.className = "hover"};
        obj.onmouseout = function(){
            if (this.id == document.getElementById("usercolor").value) this.className = "current";
            else this.className = "button";
        };
        obj.onclick = function(){selectcolor(this.id)};
    }

    //เมื่อคลิกปุ่ม
    function selectcolor (id) {
        for (i = 0; i < <?=count($color)?>; i++) {
            document.getElementById("color" + i).className = "button";
        };
        if (!document.getElementById(id)) id = "color0";
        document.getElementById("bgcolor").value = document.getElementById(id).title;
        document.getElementById("usercolor").value = document.getElementById(id).title;
        document.getElementById(id).className = "current";
        $('#usercolor').css('background', document.getElementById(id).title);
        var bgrealcolor=document.getElementById(id).title;
        $(".cke_wysiwyg_frame").contents().find(".cke_editable").css("background-color",bgrealcolor);
        document.getElementById('msgBG').value=bgrealcolor;
    }
</script>