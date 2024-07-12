<?php
include 'header.php';
include "lib/DatabaseManage.php";
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
<?php if($_GET['op']!='add') {

?>
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่มรายการข้อควา่ม
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ชื่อข้อความ
            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <input type="text" id="msgName" name="msgName" class="input" value="">
            </div>

        </div>
        <div class="row" style="margin-top: 10">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ขนาดป้าย
            </div>
            <div class="col-sm-4" style="margin-left: -30;">
                <select name="MssCode" id="MssCode" class="input" onchange="selectMssCode();">
                    <option value="" selected>เลือกขนาด</option>
                    <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                    $querySQL = sqlsrv_query($conn, $sql);
                    while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                    ?>
                    <option value="MssCode-<?php echo $result_row['XVMssCode'];?>">ขนาด <?php echo $result_row['XIMssWPixel'].'x'.$result_row['XIMssHPixel'];?> Pixel</option>
                    <?php }?>
                </select>
            </div>

        </div>
        <div id="colorBGSelect" style="display: none;">
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
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">
            </div>
            <div class="col-sm-1" style="margin-left: -30">
            </div>
        </div>
        <div id="textMessage" style="display: none">
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ข้อความ
            </div>
            <div class="col-sm-1">
            </div>
        </div>
            <?php $stmt = "SELECT TOP 1 XVMsgOrder FROM TMstMMessage ORDER BY XVMsgOrder DESC";
$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
$XVMsgCode=$result['XVMsgOrder']+1;
$msgCODE="MSGYYMM-".$XVMsgCode;?>
            <input type="hidden" id="XVMsgCode" value="<?php echo $msgCODE;?>">
            <input type="type" id="iddetail" value="">
        <div class="row" style="margin-top: -30">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-8" style="margin-top: 5px">
<?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                    $querySQL = sqlsrv_query($conn, $sql);
                    while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                    ?>
                            <div id="MssCode-<?php echo $result_row['XVMssCode'] ;?>">
                <textarea style="width:<?php echo $result_row['XIMssWPixel'];?>px; height: <?php echo $result_row['XIMssHPixel'];?>px; " name="detail<?php echo $result_row['XIMssWPixel'];?><?php echo $result_row['XIMssHPixel'];?>" id="detail<?php echo $result_row['XIMssWPixel'];?><?php echo $result_row['XIMssHPixel'];?>" ></textarea>
                            </div>
                                <?php }?>
            </div>
        </div>
        </div>
        <br>
            <div class="row">
                <div class="col-sm-4">
                </div>
                <div class="col-sm-8" >
                    <button type="submit" class="btn btn-primary" onclick="preViewsMsg('<?php echo $msgCODE;?>',1);">เพิ่มข้อความ</button>
                </div>
            </div>
        <div align="center">
        </div>
        <br>
    </div>
</div>
<?php }else{ ?>
    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;ตัวอย่างข้อความ
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px"><?php $XVMsgCode = base64_decode($_GET[ 'msg' ]);
                $sql = "SELECT XVMsgCode,XVMssCode,XVMsgHtml FROM TMstMMessage WHERE XVMsgCode='".$XVMsgCode."' ORDER BY XVMssCode ASC";
        $querySQL = sqlsrv_query($conn, $sql);
        $result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC);
            echo $result_row['XVMsgHtml'];?>
            </div>
            <div class="col-sm-1">
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px" ><button type="submit" class="btn btn-info" onclick="blackMSG('<?php echo $XVMsgCode;?>');">ย้อนหลับ</button>
            </div>
            <div class="col-sm-1" style="margin-top: 5px" ><button type="submit" class="btn btn-success" onclick="selectMSG('<?php echo $XVMsgCode;?>');">เพิ่มข้อความ</button>
            </div>
        </div>
        <br>
    </div>
    </div>

<?php }?>
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
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.

</script>
<script>

    function blackMSG(e){
        $.ajax({
            type: "POST",
            url: "lib/delMessage.php",
            data: {'msgCODE':e},
            success: function(result) {
                window.location.href = 'addMessage.php';
            }
        });
    }
    function selectMssCode(){
        var e = document.getElementById("MssCode");
        var value = e.value;
        var text = e.options[e.selectedIndex].text;
        document.getElementById( 'colorBGSelect' ).style.display = 'block';
        if(value!=''){
            document.getElementById( 'textMessage' ).style.display = 'block';

        }
        <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize ORDER BY XVMssCode ASC";
        $querySQL = sqlsrv_query($conn, $sql);
        while($result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
        ?>
        document.getElementById( 'MssCode-<?php echo $result['XVMssCode']; ?>' ).style.display = 'none';
        if(value=='MssCode-<?php echo $result['XVMssCode']; ?>'){
            document.getElementById( 'MssCode-<?php echo $result['XVMssCode']; ?>' ).style.display = 'block';
            CKEDITOR.replace('detail<?php echo $result['XIMssWPixel']; ?><?php echo $result['XIMssHPixel']; ?>',{
                toolbar :
                    [
                        { name: 'insert', items : [ 'Image','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'] },
                        '/',
                        { name: 'colors', items : [ 'TextColor', 'BGColor'  ] },
                        { name: 'colors', items : [ 'JustifyLeft', 'JustifyCenter','JustifyRight'  ] },
                        { name: 'basicstyles', items : [ 'Bold','Italic','Strike','-','RemoveFormat' ] },
                        { name: 'styles', items : [ 'Styles','Format','Color','FontSize' ] },

                    ],
                width: "<?php echo $result['XIMssWPixel']; ?>px",
                height: "<?php echo $result['XIMssHPixel']; ?>px"});
            document.getElementById('iddetail').value='detail<?php echo $result['XIMssWPixel'].$result['XIMssHPixel'];?>';
        }else{
            document.getElementById( 'MssCode-<?php echo $result['XVMssCode']; ?>' ).style.display = 'none';
        }

        <?php } ?>
    }
    function preViewsMsg(e,b){
        var iddetail=document.getElementById('iddetail').value;


        <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel FROM TMstMMsgSize ORDER BY XVMssCode ASC";
        $querySQL = sqlsrv_query($conn, $sql);
        while($result = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
        ?>
            if(iddetail=='detail<?php echo $result['XIMssWPixel'].$result['XIMssHPixel'];?>'){
                if (b==1) {
                    var data = CKEDITOR.instances.detail<?php echo $result['XIMssWPixel'].$result['XIMssHPixel'];?>.getData();
                }

            }
        <?php }?>
console.log(iddetail);
        var msgCODE=e;
        var bgcolor=document.getElementById('msgName').value;
        var XVMsgName=document.getElementById('msgName').value;
        var XVMsgStatus="2";
        $.ajax({
            type: "POST",
            url: "lib/addMessage.php",
            data: {'msgCODE':msgCODE,'data': data,'XVMsgName':XVMsgName,'XVMsgStatus':XVMsgStatus},
            success: function(result) {
                //window.location.href = 'addMessage.php?op=add&msg='+btoa(msgCODE);
            }
        });
    }

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
    }
</script>
</body>
</html>
