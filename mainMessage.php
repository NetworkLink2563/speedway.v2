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
if(checkmenu($user,'006')==0){
   
    header( "location: dashboard.php" );
    exit(0);
}else{
    if($_SESSION["XBDmnIsRead"]==0){
        header( "location: dashboard.php" );
        exit(0);
    }
}
?>
<style>
.modal-lg {
    max-width: 1024px;
}

.flex-container{
    display: flex; 
    justify-content: center;
}

.flex-container-btn{
    display: flex; 
    align-items: center;
    flex-direction: column;
}

.flex-table{
    display: flex;
    flex-direction: column;
    align-items: flex-end;
}

body {
        background: #e1f0fa;
    }

.container{
    background-color: white;
    
}

table td{
        transition: 0.5s;
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    *{
        box-sizing: border-box;
    }

    table th{
        font-size: 1rem;
        font-weight: 500;
    }

    .table{
        text-align: center;
    }

    .dt-search{
        display: none;
    }

    input.btnsearch{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
}

#dt-search-0{
    opacity: 0.8;
}

.flex-header{
    display: flex;
    justify-content: center;
    flex-direction: column;

}

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa!important;
}

table th{
        background-color: #e8f4ff!important;
    }
    
    .btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }
</style>


<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center;  border-bottom: 3px double #cccc; padding: 1rem; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> จัดการข้อความหลัก
        </div>




        <div class="flex-header">

        
        <div class="col-12 shadow" style="margin-bottom: 1rem; border-radius: 5px; display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> เพิ่มข้อความหลัก</a>
        </div>

        </div>
        
<div class="flex-container">


 
<div class="col-2" style=" border-right: 3px double #cccc; padding: 0rem .4rem;">

        
        <?php
                       $Disable='style="pointer-events: none"';
                       if($_SESSION["XBDmnIsAdd"]==1){
                          $Disable="";
                       }
                    ?>
        

            <div class="col-12" style="">
                <button <?php echo $Disable;?> href="#" class="btn btn-success shadow" style="width: 100%; padding: 1rem; background-color: #006eb4;"
                    data-toggle="modal" data-target="#myModal" ><i class=" fa fa-plus" aria-hidden="true"></i>
                    เพิ่มข้อความ</button>
                </div>


                    </div>
                <!-- flex-container-btn end -->



                
                <div class=""  id="message" class="tabcontent" style=""
            id="container">
            </div>

            

            <div class="flex-table container" style="padding: 0">

           
            <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px;">

<!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
<input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" aria-controls="VMSTable"></input>
</div>
            


                <div class="col-12" style="">


                    <div>
                        <table id="VMSTable" class="table table-striped table-hover" style="width:100%;">
                            <thead>
                                <tr style="font-size: 10pt">
                                    <th class="th-sm">MSG Code
                                    </th>
                                    <th class="th-sm">ชื่อข้อความ
                                    </th>
                                    <th>ตัวอย่าง
                                    </th>
                                    <th>ขนาด
                                    </th>
                                    <th>ประเภท
                                    </th>
                                    <th></th>
                                    <th>ลบ</th>
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
                                        <i style="cursor: -webkit-grab; cursor: grab;" class="fa fa-search"
                                            aria-hidden="true"
                                            onclick="examplesms('<?php echo $url;?>','<?php echo $result['XIMssHPixel'];?>','<?php echo $result['XIMssWPixel'];?>','<?php echo $XVMsgName;?>');"></i>
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
                    <?php
                       $Disable="pointer-events: none;";
                       if($_SESSION["XBDmnIsDelete"]==1){
                          $Disable="";
                       }
                    ?>
                        <div style="margin-top: 5px"><a href="#" class="del-item" style="color: #8d9499;<?php echo $Disable;?>"
                                onclick="deleteMSG('<?php echo $result['XVMsgCode']; ?>');" ><i class="fa fa-trash-o"
                                    aria-hidden="true"></i></a></div>
                    </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>


                    </div>




            <!-- <div class="col-sm-3">
            </div> -->
        </div>
    </div>
    <br>
</div>

<div class="modal" id="myModal">
    <div class="modal-dialog " role="document">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
        <div class="modal-header" style="display: flex; align-items: center; justify-content: center; background-color: #ffffff;">

                       <div class="col-11">
                <h5 style="text-align: center; color: black;">เลือกขนาดป้าย/ประเภทข้อความ</h5>
                </div>

                <div class="col">
                <button type="button" style="padding: 0;" class="close" data-dismiss="modal">&times;</button>
                </div>
            </div>
            <div class="modal-body text-center"style="background-color: #f5f5f5;">
                <div class="row">
                    <div class="col-sm-12">
                        <select name="MssCode" id="MssCode" class="input">
                            <option value="" selected>เลือกขนาด</option>
                            <?php $sql = "SELECT XVMssCode,XIMssWPixel,XIMssHPixel,XVMssName FROM TMstMMsgSize ORDER BY XVMssCode ASC";
                        $querySQL = sqlsrv_query($conn, $sql);
                        while($result_row = sqlsrv_fetch_array($querySQL, SQLSRV_FETCH_ASSOC)){
                            ?>
                            <option value="<?php echo $result_row['XVMssCode'];?>">
                                <?php echo $result_row['XVMssName'];?></option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="row py-3">
                    <div class="col-sm-12">
                        <select name="MssType" id="MssType" class="input">
                            <option value="" selected>ประเภทข้อความ</option>
                            <option value="1">ข้อความ</option>
                            <option value="2">รูปภาพ</option>
                            <option value="3">วีดีโอ</option>
                        </select>
                    </div>

                </div>
                <div class=" row py-3">

                    <div class="col-sm-12 text-center">
                        <button type="button" class="btn btn-success" data-dismiss="modal" aria-label="Close"
                            id="btnRefresh" onclick="goToAddMessage()">ตกลง</button>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<div class="modal py-5" id="ModalExample" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center">

                <iframe id="iframe" style="border: 0;" src=""></iframe>

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

function examplesms(url, h, w, vmsmame) {

    document.getElementById("Example_Title").innerText = vmsmame + " ขนาด กว้าง=" + w + " สูง=" + h;

    document.getElementById("iframe").width = parseInt(w);
    document.getElementById("iframe").height = parseInt(h);
    document.getElementById("iframe").src = url;


    $('#ModalExample').modal('show');
}

function goToAddMessage() {
    var e = document.getElementById("MssCode").value;
    var t = document.getElementById("MssType").value;

    if (e == "") {
        Swal.fire({
            title: "",
            text: "โปรดเลือกขนาดป้าย",
            icon: "warning",
            confirmButtonText: "ตกลง",

        }).then((result) => {

            if (result.isConfirmed) {
                $('#myModal').modal('show');
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });
        return false;
    }
    if (t == "") {
        Swal.fire({
            title: "",
            text: "โปรดเลือกประเภทข้อความ",
            icon: "warning",
            confirmButtonText: "ตกลง",

        }).then((result) => {

            if (result.isConfirmed) {
                $('#myModal').modal('show');
            } else if (result.isDenied) {
                Swal.fire("Changes are not saved", "", "info");
            }
        });


        return false;
    }
    if (t == 1) {
        window.location.href = 'addMessage.php?msgsize=' + btoa(e) + "&mmstype=" + btoa(t);
    } else {
        window.location.href = 'addPicMessage.php?msgsize=' + btoa(e) + "&mmstype=" + btoa(t);

    }
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

    //  new DataTable('#UserTable');
    // new DataTable('#VMSTable');

    new DataTable('#VMSTable', {
        ordering: false,
        "oLanguage": {
            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
        }
    });
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
            $.ajax({
                type: "POST",
                url: "lib/delMessage.php",
                data: {
                    'msgCODE': MSGCode
                },
                success: function(result) {
                 
                    const obj = JSON.parse(result);
                   
                    if (obj.RETURN != "True") {
                        Swal.fire("ไม่สามรถลบได้ มีการใช้ข้อความนี้อยู่ที่ป้าย"+obj.XVVmsName, "", "warnning");
                        
                        //window.location.href = 'mainMessage.php';
                    } else {

                        window.location.href = 'mainMessage.php';
                    }

                }
            });
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