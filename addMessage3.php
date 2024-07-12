<?php
include 'header.php';
include "lib/DatabaseManage.php";
$msgsize=base64_decode($_GET['msgsize']);
$sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize WHERE XVMssCode='".$msgsize."' ORDER BY XVMssCode ASC";
$querySQL = sqlsrv_query($conn, $sql);
$result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);

$stmt = "SELECT TOP 1 XVMsgOrder FROM TMstMMessage ORDER BY XVMsgOrder DESC";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$XVMsgCode=$result['XVMsgOrder']+1;
$msgCODE="MSGYYMM-".$XVMsgCode;?>
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
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่มรายการข้อความ
            <div style="margin-top:-5;"><hr></div>
        </div>
        <input type="text" id="XVMsgCode" value="<?php echo $msgCODE;?>">
        <input type="hidden" id="idmsgSize" value="<?php echo $result_row['XVMssCode'];?>">

        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ชื่อข้อความ
            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="msgName" name="msgName" class="input" value="">
            </div>
        </div>
        <div class="row" style="margin-top: 10" >
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">สีพื้นหลัง
            </div>
            <div class="col-sm-4" style="margin-left: -100"><ol class="menu">
                    <?php
                    //กำหนดโค้ดสีที่ต้องการลงใน array
                    $color= array("black", "maroon", "#F60310", "#E76E14", "#E7C514", "#1DDC12", "olive", "#148CE7", "navy", "#6C1CEA", "fuchsia", "teal", "purple", "gray", "silver", "white");
                    for ($i = 0; $i < count($color); $i++) {
                        echo "<li><span id=\"color$i\" title=\"$color[$i]\" class=\"button\"><font class=\"btncolor\" style=\"background-color:$color[$i];color:$color[$i]; \" >Yy</font></span></li>";
                    }
                    ?>
                </ol>
                <!--input รับค่าสีที่เลือกสำหรับการส่งต่อผ่านฟอร์ม-->
                <input type="hidden" id="bgcolor" name="bgcolor" />
            </div><div class="col-sm-1" style="margin-left: -75px;margin-top: px"><input type="hidden" class="input"  id="usercolor" name="usercolor" style="height:30;color: #fff;text-align: center; font-weight: 50; background: " disabled/>
            </div>

        </div>
        <div class="row" style="margin-top: 10;">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8" style="margin-top: 5px">
              <textarea style="width:<?php echo $result_row['XIMssWPixel'];?>px; height: <?php echo $result_row['XIMssHPixel'];?>px; " name="detail" id="detail" ></textarea>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8" >
                <button type="submit" class="btn btn-primary" onclick="preViewsMsg('<?php echo $msgCODE;?>',1);">เพิ่มข้อความ</button>
            </div>
        </div>
<br>
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
<script>
    CKEDITOR.replace('detail',{
        toolbar :
            [
                { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] },
                '/',
                { name: 'colors', items : [ 'TextColor', 'BGColor'  ] },
                { name: 'colors', items : [ 'JustifyLeft', 'JustifyCenter','JustifyRight'  ] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                { name: 'styles', items : [ 'Styles','Format','Color','FontSize' ] },

            ],
        width: "<?php echo $result_row['XIMssWPixel']; ?>px",
        height: "<?php echo $result_row['XIMssHPixel']; ?>px"});

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

    function preViewsMsg(e,b){
        var idmsgSize=document.getElementById('idmsgSize').value;
        var msgName=document.getElementById('msgName').value;
        if(msgName==''){
            alert("กรุณาใส่ชื่อข้อความ");
        }
        var data = CKEDITOR.instances.detail.getData();

        var msgCODE=e;
        var bgcolor=document.getElementById('usercolor').value;
        var bgcolor=document.getElementById('usercolor').value;
        var XVMsgName=document.getElementById('msgName').value;
        var XVMsgStatus="2";
        $.ajax({
            type: "POST",
            url: "lib/addMessage.php",
            data: {'msgCODE':msgCODE,'data': data,'XVMsgName':XVMsgName,'XVMsgStatus':XVMsgStatus,'idmsgSize':idmsgSize,'msgBG':bgcolor},
            success: function(result) {
                window.location.href = 'addMessage.php?op=add&msg='+btoa(msgCODE);
            }
        });
    }

</script>