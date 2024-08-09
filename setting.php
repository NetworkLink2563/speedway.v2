<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
include "service/privilege.php";


$menucode="006";
$pri=pri_($_SESSION['user'],$menucode);  
$pri_w=$pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r=$pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del=$pri[0]['pri_del'];  // สิทธิ์การลบ
$pri_contr=$pri[0]['pri_del'];  // สิทธิ์การควบคุม

// if(checkmenu($user,'001')==0)
// {
//     session_destroy();
//     header( "location: index.php" );
//     exit(0);
// }
// if(checkmenu($user,'002')==0){
  
//     header( "location: dashboard.php" );
//     exit(0);
// }

?>

<style>
    table td{
        transition: 0.5s;
    }

    body {
    background: #e1f0fa;
  width: 100%;
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  box-sizing: border-box;
}

.container{
    background-color: white;
}

.flex-container-btn{

display: flex;
justify-content: center;
flex-wrap: wrap;

}

.flex-container-table{
display: flex;
flex-wrap: wrap;
justify-content: right;
}

.flex-head{
display: flex;
justify-content: center;


}

.dt-search{
    display: none;
}

#dt-search-0{
    opacity: 0.7;
}


table td{
    font-size: 0.9rem;
    transition: 0.5s;
    font-weight: 300;
}

table th{
    font-size: 1rem;
    font-weight: 500;
}

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

table th{
        background-color: #e8f4ff!important;
    }
    
    .btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }

input .btnsearch{
 background-image: url('https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s');
 background-repeat: no-repeat;
 background-size: 15px;
 background-position: left 12px top 10px;
 text-indent: 20px;
}
</style>

<div class="container" style="position: relative; top: 80; ">

<div style=" text-align: center; margin-bottom: 1rem; border-bottom: 3px double #cccc; padding: 1rem; font-size: 1.3rem;">
            <img src="/speedway/img/icon/cog.png" height="25" alt="Responsive image" style=""> ตั้งค่า
        </div>

        
        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; margin: 0rem 0rem 1rem 0rem;">
            <a class="tablinks2 active " style="cursor: context-menu;"><img style="margin-right: .4rem;" src="img/person.png" width="20" alt=""> ผู้ใช้งาน</a>
        </div>


        <?php if($pri_r != 0){ ?>
    <div class="flex-head">

    
       
<div class="col-2 flex-container-btn container" style=" border-right: 3px double #cccc;">

        <div class="col-12" id="User container" style="">
            <?php if($pri_w != 0){ ?>
                <button style="padding: 1rem; width: 100%; background-color: #006eb4;" class="btn btn-primary shadow" onclick="location.href='adduser.php'"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</button>
            <?php } ?>
           </div>


           

            

                </div>   
                <!-- end div flex-container-btn -->
                
                

                <div class="flex-container-table container">
         
                    

                    <div  class="search"  style="width: 255px; padding: 0; float: right; padding-right: 15px;padding-left: 15px;">

<!-- <img style="margin: 0 0.5rem; " src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSyi_CVTmoL1ITHFxQkfLwvj93hcsgA1Olkhg&s" width="15" alt=""> -->
<input type="text" class="form-control btnsearch" name="" style="width: 100%; font-size: 0.9rem;" placeholder="กรอกข้อความที่ต้องการค้นหา..." id="dt-search-0" aria-controls="VMSTable"></input>
</div>



<div class="col-12" >
                        <table id="UserTable" class="table table-striped table-hover" style="width:100%">
                            <thead>
                            <tr style="font-size: 10pt">
                                <th class="th-sm">ผู้ใช้
                                </th>
                                <th class="th-sm" >กะเวลาทำงาน
                                </th>
                              
                                <th class="th-sm" style="text-align: center">สถานะ
                                </th>
                                <th class="th-sm text-center">สิทธิ์การใช้งาน
                                </th>
                                <th class="th-sm text-center">เครื่องมือ
                                </th>
                              
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $stmt = "SELECT  dbo.TMstMCustomer.XVCstCode, dbo.TMstMCustomer.XVCstName, dbo.TMstMCustomer.XVCstPhone, dbo.TMstMUser.XVUsrName, dbo.TMstMUser.XBUsrIsActive, dbo.TMstMUser.XVUsrCode, dbo.TMstMShift.XVShfName, 
                                     dbo.TMstMShift.XIShfStartHour, dbo.TMstMShift.XIShfStartMin, dbo.TMstMShift.XIShfEndHour, dbo.TMstMShift.XIShfEndMin
                                     FROM dbo.TMstMCustomer INNER JOIN
                                     dbo.TMstMUser ON dbo.TMstMCustomer.XVCstCode = dbo.TMstMUser.XVCstCode INNER JOIN
                                     dbo.TMstMShift ON dbo.TMstMUser.XVShfCode = dbo.TMstMShift.XVShfCode
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
                                $shift= $result['XVShfName'].' '.$result['XIShfStartHour'].':'.$result['XIShfStartMin'].'-'.$result['XIShfEndHour'].':'.$result['XIShfEndMin'].' น.'; 
                                
                            ?>
                            
                            <tr id="usercode<?php echo $result['XVUsrCode']; ?>" style="font-size: 10pt">
                                <td><?php echo $result['XVUsrName']; ?></td>
                           
                                <td ><?php echo  $shift; ?></td>
                                <td class="text-center"><?php echo $status; ?></td>
                                
                                
                                <td><div style="margin-top: 5px;text-align: center"><a href="usermenu.php?p=<?php echo base64_encode($result['XVUsrCode']);?>&user=<?php echo $result['XVUsrCode']; ?>" ><i class="fa fa-folder" aria-hidden="true" title="กำหนดสิทธิ์"></i></a></div>
                                <td><div style="margin-top: 5px;text-align: center;"><a href="#" onclick="isactive('<?php echo $result['XVUsrCode']; ?>')"><i class="<?php echo $icon;?>" aria-hidden="true" title="เปลี่ยนสถานะ"></i></a></div>
                            </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                    

                        </div>
                        <!-- end div container-table -->

                        </div>
                        <!-- end div flex-head -->





                    <div class="col3">
                    </div>
                </div>
            </div>
        <div id="message" class="tabcontent" style="margin-left: 10px;margin-right: 10px;" id="container">
            <div style="text-align: right;font-size: 10pt;" ><a href="#" style="color: #8d9499" data-toggle="modal" data-target="#myModal""><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มข้อความ</a></div>
            <div class="row">
                <div class="col3">
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
                <!-- <div class="col-sm-3"> -->
                </div>
            </div>
        </div>
        <br >
    </div>

    <?php }else{echo'<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';} ?>


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
