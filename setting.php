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
if(checkmenu($user,'002')==0){
  
    header( "location: dashboard.php" );
    exit(0);
}

?>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;ตั้งค่า
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">

                <button class="tablinks active" onclick="openCity(event, 'User')">ผู้ใช้งาน</button>
                <!--
                <button class="tablinks " onclick="openCity(event, 'message')">เพิ่มข้อความหลัก</button>
-->

        </div>

            <div id="User" class="tabcontent" style="display:block; margin-left: 10px;margin-right: 10px;" id="container">
                <div style="text-align: right;font-size: 10pt;"><a href="adduser.php" class="btn btn-primary"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</a></div>
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-6" >
                        <table id="UserTable" class="table table-striped" style="width:100%">
                            <thead>
                            <tr style="font-size: 10pt">
                                <th class="th-sm">Username
                                </th>
                                <th class="th-sm">ชื่อ-สกุล
                                </th>
                                <th class="th-sm" style="text-align: center">เบอร์ติดต่อ
                                </th>
                                <th class="th-sm" style="text-align: center">สถานะ
                                </th>
                                <th class="th-sm text-center">สิทธิ์
                                </th>
                                <th class="th-sm text-center">เปลี่ยนสถานะ
                                </th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $stmt = "SELECT        dbo.TMstMCustomer.XVCstCode, dbo.TMstMCustomer.XVCstName, dbo.TMstMCustomer.XVCstPhone, dbo.TMstMUser.XVUsrName, dbo.TMstMUser.XBUsrIsActive, dbo.TMstMUser.XVUsrCode, dbo.TMstMUser.XVName
                            FROM            dbo.TMstMCustomer INNER JOIN
                                                     dbo.TMstMUser ON dbo.TMstMCustomer.XVCstCode = dbo.TMstMUser.XVCstCode
";
                            $query = sqlsrv_query($conn, $stmt);
                            while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                            {
                                $status="ใช้งาน";
                                if($result['XBUsrIsActive']==1){
                                    $icon="fa fa-close";
                                    $status="ใช้งาน";
                                }else{
                                    $icon="fa fa-check";
                                    $status="ยกเลิก";
                                }
                                
                            ?>
                            <tr id="usercode<?php echo $result['XVUsrCode']; ?>" style="font-size: 10pt">
                                <td><?php echo $result['XVUsrName']; ?></td>
                                <td><?php echo $result['XVName']; ?></td>
                                <td><div style="margin-top: 5px;text-align: center"><?php echo $result['XVCstPhone']; ?></div></td>
                                <td><div style="margin-top: 5px;text-align: center"><?php echo $status; ?></div></td>
                                
                                
                                <td><div style="margin-top: 5px;text-align: center"><a href="usermenu.php?p=<?php echo base64_encode($result['XVUsrCode']);?>" ><i class="fa fa-folder" aria-hidden="true" title="กำหนดสิทธิ์"></i></a></div>
                                <td><div style="margin-top: 5px;text-align: center;"><a href="#" onclick="isactive('<?php echo $result['XVUsrCode']; ?>')"><i class="<?php echo $icon;?>" aria-hidden="true" title="เปลี่ยนสถานะ"></i></a></div>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-3">
                    </div>
                </div>
            </div>
        <div id="message" class="tabcontent" style="margin-left: 10px;margin-right: 10px;" id="container">
            <div style="text-align: right;font-size: 10pt;" ><a href="#" style="color: #8d9499" data-toggle="modal" data-target="#myModal""><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อความ</a></div>
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
                                 WHERE TMstMMessage.XVMsgStatus='1'
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
                                <td style="text-align: center;"><div style=" margin-top: 5px"><a href="ifarme.php?msg=<?php echo base64_encode($result['XVMsgCode']);?>" target="_blank" style="color: #0a0a0a"><i class="fa fa-file-word-o" aria-hidden="true"></i></a></div></td>
                                <td style="text-align: center"><?php echo $result['XIMssWPixel']; ?>x<?php echo $result['XIMssHPixel']; ?></td>
                                <td style="text-align: center;"><div style=" margin-top: 5px"><?php echo $XVMsgType; ?></div></td>
                                <td></div>
                <td><div style="margin-top: 5px"><a href="#" class="del-item" style="color: #8d9499" onclick="deleteMSG('<?php echo $result['XVMsgCode']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
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
        <br >
    </div>
</div>
<div class="modal" id="myModal" tabindex="-1" role="dialog"style="width: 1200" >
    <div class="modal-dialog" role="document" >
        <div class="modal-content"style="width: 900">
            <div class="modal-header" >
                <h5 class="modal-title">เลือกขนาดป้าย</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" >
                <div class="row">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-1" style="margin-top: 5px">
                    </div>
                    <div class="col-sm-4" style="margin-left: -30;">
                        <select name="MssCode" id="MssCode" class="input" ">
                            <option value="" selected>เลือกขนาด</option>
                            <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel,XVMssName FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                            $querySQL = sqlsrv_query($conn, $sql);
                            while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                                ?>
                                <option value="<?php echo $result_row['XVMssCode'];?>"><?php echo $result_row['XVMssName'];?>
                                </option>
                            <?php }?>
                        </select>
                    </div>

                </div>
                <div class="row" style="margin-top: 25px">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-1" >
                    </div>
                    <div class="col-sm-4" style="margin-left: 30;">
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close" id="btnRefresh" onclick="goToAddMessage()">เพิ่มข้อความ</button>

                    </div>

                </div>

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
    function show_modal(e)
    {
        console.log (e.href);
        $("#iframe_modal").attr("src", e.href);
        $('#myModalIfame').modal('show');
        return false;
    }
    function goToAddMessage(){
        var e = document.getElementById("MssCode");
        var value = e.value;
        window.location.href = 'addMessage.php?msgsize='+btoa(value);
    }
    $(document).ready(function (){
        var productselection = document.getElementById("productselection");
        <?php
        for ($x = 1; $x <= 4; $x++) {
        ?>
        var product<?php echo $x;?> = document.getElementById("product<?php echo $x;?>");
        <?php } ?>
        productselection.addEventListener("change", function(){
            var text = productselection.value;
            const myArray = text.split("_");
            var productselections = document.getElementById("productselection");
            var valuer = productselections.value;
            var textr = productselections.options[productselections.selectedIndex].text;
            <?php for ($x = 1; $x <= 4; $x++) { ?>
            if(myArray[1] == <?php echo $x;?>){
                product<?php echo $x;?>.style.display = 'block';
                productlist<?php echo $x;?>.style.display = 'block';
            }else{
                product<?php echo $x;?>.style.display = 'none';
                productlist<?php echo $x;?>.style.display = 'none';
            }
            <?php } ?>


        });
    });

    function onlyNumbers(e)
    {
        var c=e.which?e.which:e.keyCode;
        if(c<48||c>57)
        {
            return false;
        }
    }
    function numberValidation(e){
        e.target.value = e.target.value.replace(/[^\d]/g,'');
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
    $(document).ready(function () {

        new DataTable('#UserTable');
        new DataTable('#VMSTable');
    });

    function disableUser(userCodeInput){
        var hashEncode='76605981da8c7170dd309c591438288b';
        $.ajax({
            type: "POST",
            url: "lib/processUser.php",
            data: {'usercode': userCodeInput,'encode':hashEncode,'VMScode': VMSCodeInput},
            success: function(result) {
                if(result==1) {
                    document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'none';
                    document.getElementById('statusUserBlockActive' + userCodeInput).style.display = 'block';
                    document.getElementById('statusUser' + userCodeInput).innerHTML = 'Unactive';
                }
            }
        });
    }
    function disableVMS(VMSCodeInput){
        var hashEncode='76605981da8c7170dd309c591438288b';
        $.ajax({
            type: "POST",
            url: "lib/processVMS.php",
            data: {'VMScode': VMSCodeInput,'encode':hashEncode},
            success: function(result) {
                if(result==1) {
                    document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'none';
                    document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'block';
                    document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Offlice';
                }
            }
        });
    }
    function activeUser(userCodeInput){
        var hashEncode='7c08aa10ab8b543cf5f3ebab19c55587';
        $.ajax({
            type: "POST",
            url: "lib/processUser.php",
            data: {'usercode': userCodeInput,'encode':hashEncode},
            success: function(result) {
                if(result==1) {
                    document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'block';
                    document.getElementById('statusUserBlockActive' + userCodeInput).style.display = 'none';
                    document.getElementById('statusUser' + userCodeInput).innerHTML = 'Active';
                }
            }
        });
    }
    function activeVMS(VMSCodeInput){
        var hashEncode='7c08aa10ab8b543cf5f3ebab19c55587';
        $.ajax({
            type: "POST",
            url: "lib/processVMS.php",
            data: {'VMScode': VMSCodeInput,'encode':hashEncode},
            success: function(result) {
                if(result==1) {
                    document.getElementById('statusVMSNonActive' + VMSCodeInput).style.display = 'block';
                    document.getElementById('statusVMSBlockActive' + VMSCodeInput).style.display = 'none';
                    document.getElementById('statusVMS' + VMSCodeInput).innerHTML = 'Online';
                }
            }
        });
    }

    function deleteUser(userCodeInput){
        var hashEncode='9aa1fca65b77dd8b8b7a88dfe547d35c';
        $.ajax({
            type: "POST",
            url: "lib/processUser.php",
            data: {'usercode': userCodeInput,'encode':hashEncode},
            success: function(result) {
                if(result==1){
                    document.getElementById( 'usercode'+userCodeInput ).style.display = 'none';
                }
            }
        });
    }
    function deleteMSG(MSGCode){
        $.ajax({
            type: "POST",
            url: "lib/delMessage.php",
            data: {'msgCODE': MSGCode},
            success: function(result) {
                    document.getElementById( 'MSGcode'+MSGCode ).style.display = 'none';
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
function isactive(XVUsrCode){
        Swal.fire({
            title: "",
            showDenyButton: true,
            showCancelButton: true,
            confirmButtonText: 'ใช้งาน',
            denyButtonText: 'หยุดใช้งาน',
            cancelButtonText: 'X',
          
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "lib/processUser.php",
                    data: {'Type':2,'XVUsrCode': XVUsrCode},
                    success: function(result) {
                      
                        window.location.href = "setting.php";
                        
                    }
                });
            } else if (result.isDenied) {
                $.ajax({
                    type: "POST",
                    url: "lib/processUser.php",
                    data: {'Type':3,'XVUsrCode': XVUsrCode},
                    success: function(result) {
                    
                        window.location.href = "setting.php";
                    }
                });
            }
            window.location.href = "setting.php";
        });
}
</script>
</body>
</html>
