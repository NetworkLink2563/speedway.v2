<?php
include "../header.php";
include "lib/DatabaseManage.php";
include "lib/function_user.php";
include "lib/function_VMS.php";
?>
<style>
.modal-lg{
    max-width: 1024px;
}
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="../img/icon/setting.png" height="25" alt="Responsive image">&nbsp;จัดการข้อความหลัก
            <div style="margin-top:-5;">
                <hr>
            </div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">

            <button class="tablinks active" onclick="openCity(event, 'message')">เพิ่มข้อความหลัก</button>

        </div>
        <div id="message" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;"
            id="container">
            <div style="text-align: right;font-size: 10pt;"><a href="#" style="color: #8d9499" data-toggle="modal"
                    data-target="#myModal"><i class=" fa fa-plus" aria-hidden="true"></i> เพิ่มข้อความ</a></div>
            <div class="row">
                <div class="col-sm-3">
                </div>
                <div class="col-sm-6" style="">
                    <table id="VMSTable" class="table" style="width:100%;">
                        <thead>
                            <tr style="font-size: 10pt">
                                <th class="th-sm">MSG Code
                                </th>
                                <th class="th-sm">ชื่อข้อความ
                                </th>
                                <th class="th-sm" style="text-align: center">ตัวอย่าง
                                </th>
                                <th class="th-sm" style="text-align: center">ขนาด
                                </th>
                                <th class="th-sm" style="text-align: center">ประเภท
                                </th>
                                <th class="th-sm" style="text-align: center"></th>
                                <th class="th-sm" style="text-align: center"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $stmt = "SELECT TMstMMessage.XVMsgCode,TMstMMessage.XVMsgName,TMstMMessage.XVWhoCreate,TMstMMsgSize.XIMssWPixel,TMstMMsgSize.XIMssHPixel,TMstMMessage.XVMsgType FROM TMstMMessage 
                                 INNER JOIN TMstMMsgSize ON TMstMMsgSize.XVMssCode=TMstMMessage.XVMssCode
                                     ORDER BY TMstMMessage.XTWhenCreate DESC";
                        $query = sqlsrv_query($conn, $stmt);
                        while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                        {
                        if($result['XVMsgType']==1){
                            $XVMsgType='<i class="fa fa-text-width" aria-hidden="true" title="ข้อความ"></i>';
                        }elseif($result['XVMsgType']==2){
                            $XVMsgType='<i class="fa fa-picture-o" aria-hidden="true" title="รูปภาพ"></i>';
                        }elseif($result['XVMsgType']==3){
                            $XVMsgType='<i class="fa fa-video-camera" aria-hidden="true" title="ภาพเคลื่อนไหว"></i>';
                        }
                        ?>
                            <tr id="MSGcode<?php echo $result['XVMsgCode']; ?>" style="font-size: 10pt">
                                <td><?php echo $result['XVMsgCode']; ?></td>
                                <td><?php echo $result['XVMsgName']; ?></td>
                                <td style="text-align: center;">
                                    <?php
                                      $XIMssWPixel=$result['XIMssWPixel'];
                                      $XIMssHPixel=$result['XIMssHPixel'];
                                      $url="ifarme.php?msg=".base64_encode($result['XVMsgCode']);
                                      $url."&wp=".base64_encode($result['XIMssWPixel']);
                                      $url."&hp=".base64_encode($result['XIMssHPixel']);
                                      $XVMsgName=$result['XVMsgName'];

                                     
                                    ?>
                                    <i class="fa fa-file-word-o" aria-hidden="true"  onclick="examplesms('<?php echo $url;?>','<?php echo $result['XIMssHPixel'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $XVMsgName;?>');"></i>
                                    <!--
                                    <div style=" margin-top: 5px"><a
                                            href="ifarme.php?msg=<?php //echo base64_encode($result['XVMsgCode']);?>"
                                            target="_blank" style="color: #0a0a0a"><i class="fa fa-file-word-o"
                                                aria-hidden="true"></i></a></div>
                    -->
                                    
                                </td>
                                <td style="text-align: center">
                                    <?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                <td style="text-align: center;">
                                    <div style=" margin-top: 5px"><?php echo $XVMsgType; ?></div>
                                </td>
                                <td>
                </div>
                <td>
                    <div style="margin-top: 5px"><a href="#" class="del-item" style="color: #8d9499"
                            onclick="deleteMSG('<?php echo $result['XVMsgCode']; ?>');"><i class="fa fa-trash-o"
                                aria-hidden="true"></i></a></div>
                </td>
                </tr>
                <?php } ?>
                </tbody>
                </table>
            </div>
            <div class="col-sm-3">
            </div>
        </div>
    </div>
    <br>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">เลือกขนาดป้าย/ประเภทข้อความ</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <div class="row">
                    <div class="col-sm-6">
                        <select name="MssCode" id="MssCode" class="input" ">
                        <option value="" selected>เลือกขนาด</option>
                        <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel,XVMssName FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                        $querySQL = sqlsrv_query($conn, $sql);
                        while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                            ?>
                            <option value="
                            <?php echo $result_row['XVMssCode'];?>"><?php echo $result_row['XVMssName'];?>
                            </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-sm-6">
                        <select name="MssType" id="MssType" class="input" ">
                        <option value="" selected>ประเภทข้อความ</option>
                        <option value=" 1">ข้อความ</option>
                            <option value="2">รูปภาพ</option>
                            <option value="3">วีดีโอ</option>

                        </select>
                    </div>

                </div>
                <div class=" row py-3">

                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"
                            id="btnRefresh" onclick="goToAddMessage()">เพิ่มข้อความ</button>

                    </div>

                </div>
               
               
            </div>
        </div>
    </div>
</div>

<div class="modal py-5"  id="ModalExample" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">
                <iframe id="iframe" style=" overflow-y: hidden;overflow-x: hidden;" src="" title=""></iframe>
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

<script>
function show_modal(e) {
    console.log(e.href);
    $("#iframe_modal").attr("src", e.href);
    $('#myModalIfame').modal('show');
    return false;
}
function examplesms(url,h,w,vmsmame){
    
    document.getElementById("Example_Title").innerText = vmsmame+ " ขนาด กว้าง="+w+" สูง="+h;
    document.getElementById("iframe").width = parseInt(w)+10;
    document.getElementById("iframe").height = parseInt(h)+10;
    document.getElementById("iframe").src = url;
    
    $('#ModalExample').modal('show');
}
function goToAddMessage() {
    var e = document.getElementById("MssCode").value;
     
    var t = document.getElementById("MssType").value;
    
    window.location.href = 'addMessage.php?msgsize=' + btoa(e) +"&mmstype="+btoa(t);
}
$(document).ready(function() {
    var productselection = document.getElementById("productselection");
    <?php
        for ($x = 1; $x <= 4; $x++) {
        ?>
    var product<?php echo $x;?> = document.getElementById("product<?php echo $x;?>");
    <?php } ?>
    productselection.addEventListener("change", function() {
        var text = productselection.value;
        const myArray = text.split("_");
        var productselections = document.getElementById("productselection");
        var valuer = productselections.value;
        var textr = productselections.options[productselections.selectedIndex].text;
        <?php for ($x = 1; $x <= 4; $x++) { ?>
        if (myArray[1] == <?php echo $x;?>) {
            product<?php echo $x;?>.style.display = 'block';
            productlist<?php echo $x;?>.style.display = 'block';
        } else {
            product<?php echo $x;?>.style.display = 'none';
            productlist<?php echo $x;?>.style.display = 'none';
        }
        <?php } ?>


    });
});

function onlyNumbers(e) {
    var c = e.which ? e.which : e.keyCode;
    if (c < 48 || c > 57) {
        return false;
    }
}

function numberValidation(e) {
    e.target.value = e.target.value.replace(/[^\d]/g, '');
    return false;
}

function getValue(radio) {
    if ((radio.value) == 1) {
        document.getElementById("multiCam").style.display = "none";
    } else {
        document.getElementById("multiCam").style.display = "block";
    }
}

function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
// Basic example
$(document).ready(function() {

    new DataTable('#UserTable');
    new DataTable('#VMSTable');
});

function disableUser(userCodeInput) {
    var hashEncode = '76605981da8c7170dd309c591438288b';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode,
            'VMScode': VMSCodeInput
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'none';
                document.getElementById('statusUserBlockActive' + userCodeInput).style.display =
                    'block';
                document.getElementById('statusUser' + userCodeInput).innerHTML = 'Unactive';
            }
        }
    });
}

function disableVMS(VMSCodeInput) {
    var hashEncode = '76605981da8c7170dd309c591438288b';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {
            'VMScode': VMSCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'none';
                document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'block';
                document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Offlice';
            }
        }
    });
}

function activeUser(userCodeInput) {
    var hashEncode = '7c08aa10ab8b543cf5f3ebab19c55587';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'block';
                document.getElementById('statusUserBlockActive' + userCodeInput).style.display = 'none';
                document.getElementById('statusUser' + userCodeInput).innerHTML = 'Active';
            }
        }
    });
}

function activeVMS(VMSCodeInput) {
    var hashEncode = '7c08aa10ab8b543cf5f3ebab19c55587';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {
            'VMScode': VMSCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'block';
                document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'none';
                document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Online';
            }
        }
    });
}

function deleteUser(userCodeInput) {
    var hashEncode = '9aa1fca65b77dd8b8b7a88dfe547d35c';
    $.ajax({
        type: "POST",
        url: "lib/processUser.php",
        data: {
            'usercode': userCodeInput,
            'encode': hashEncode
        },
        success: function(result) {
            if (result == 1) {
                document.getElementById('usercode' + userCodeInput).style.display = 'none';
            }
        }
    });
}

function deleteMSG(MSGCode) {
    $.ajax({
        type: "POST",
        url: "lib/delMessage.php",
        data: {
            'msgCODE': MSGCode
        },
        success: function(result) {
            console.log(result);
            document.getElementById('MSGcode' + MSGCode).style.display = 'none';
        }
    });
}
/*function deleteVMS(VMSCodeInput){
    var hashEncode='9aa1fca65b77dd8b8b7a88dfe547d35c';
    $.ajax({
        type: "POST",
        url: "lib/processVMS.php",
        data: {'VMScode': VMSCodeInput,'encode':hashEncode},
        success: function(result) {
            if(result==1){
                document.getElementById( 'VMScode'+VMSCodeInput ).style.display = 'none';
            }
        }
    });
}*/
</script>
</body>

</html>