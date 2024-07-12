<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "lib/function_user.php";
?>
<style>
    a.del-item:link {
        color: #595959 !important;
    }
    a.del-item:visited {
        color: #595959 !important;
    }
    a.del-item:hover {
        color: #FF0000 !important;
    }
    a.del-item:focus {
        color: #FF0000 !important;
    }
    a.del-item:active {
        color: #595959 !important;
    }
    a.activeUser-item:link {
        color: #595959 !important;
    }
    a.activeUser-item:visited {
        color: #595959 !important;
    }
    a.activeUser-item:hover {
        color: #66CC00 !important;
    }
    a.activeUser-item:focus {
        color: #66CC00 !important;
    }
    a.activeUser-item:active {
        color: #595959 !important;
    }

</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;" >
            <img src="img/icon/setting.png" height="25" alt="Responsive image">&nbsp;ตั้งค่า
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="tab" style="margin-left: 10px;margin-right: 10px;">
            <button class="tablinks active" onclick="openCity(event, 'User')">ผู้ใช้งาน</button>

        </div>
        <div id="User" class="tabcontent" style="display: block; margin-left: 10px;margin-right: 10px;">
            <div style="text-align: right;"><a href="adduser.php" style="color: #8d9499"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</a></div>
            <span class="row">
            <div class="col-sm-3">
            </div>
            <div class="col-sm-6" style=" margin-top: -20px"">

                <table id="example" class="table table-striped" style="width:100%">
                    <thead>
                    <tr style="font-size: 10pt">
                        <th class="th-sm">Username
                        </th>
                        <th class="th-sm">ชื่อ-สกุล
                        </th>
                        <th class="th-sm" style="text-align: center">เบอร์ติดต่อ
                        </th>
                        <th class="th-sm">สิทธิ์
                        </th>
                        <th class="th-sm" style="text-align: center">สถานะ
                        </th>
                        <th class="th-sm" style="text-align: center">
                        </th>
                        <th class="th-sm" style="text-align: center"></th>
                        <th class="th-sm" style="text-align: center"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $stmt = "SELECT TMstMCustomer.XVCstCode, TMstMCustomer.XVCstName,TMstMCustomer.XVCstPhone,TMstMUser.XVUsrName,TMstMUser.XBUsrIsActive,TMstMUser.XVUsrCode
FROM TMstMCustomer
INNER JOIN TMstMUser ON TMstMCustomer.XVCstCode = TMstMUser.XVCstCode
";
                    $query = sqlsrv_query($conn, $stmt);
                    while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                    {
                    ?>
                    <tr id="usercode<?php echo $result['XVUsrCode']; ?>" style="font-size: 10pt">
                        <td><?php echo $result['XVUsrName']; ?></td>
                        <td><?php echo $result['XVCstName']; ?></td>
                        <td><div style="margin-top: 5px;text-align: center"><?php echo $result['XVCstPhone']; ?></div></td>
                        <td>-</td>
                        <td><div id="statusUser<?php echo $result['XVUsrCode']; ?>" style="text-align: center;"><?php echo statusUser($result['XBUsrIsActive']); ?></div></td>
                        <td><div style="margin-top: 5px;text-align: center">
                                <span>&nbsp;&nbsp;</span>
                                </div> </td>

                        <td><div style="margin-top: 5px"><a href="#" class="del-item" style="color: #8d9499" onclick="deleteUser('<?php echo $result['XVUsrCode']; ?>');"><i class="fa fa-trash-o" aria-hidden="true"></i></a></div>
                            </td>
    <td>
        <?php $statusUser=changeIconUserActive($result['XVUsrCode']);
        if($statusUser==1){
            $statsUserDisable='block';
            $statsUserActive='none';
        }else{
            $statsUserDisable='none';
            $statsUserActive='block';
        }?>
        <div style="margin-top: 5px"><a href="#"  id="statusUserNonActive<?php echo $result['XVUsrCode']; ?>" class="del-item" style="display: <?php echo $statsUserDisable;?>; color: #8d9499" onclick="disableUser('<?php echo $result['XVUsrCode']; ?>');"><i class="fa fa-ban" aria-hidden="true"></i></a>
            <a href="#"  id="statusUserBlockActive<?php echo $result['XVUsrCode']; ?>" class="activeUser-item" style="display:<?php echo $statsUserActive;?>; color: #8d9499" onclick="activeUser('<?php echo $result['XVUsrCode']; ?>');"><i class="fa fa-check" aria-hidden="true"></i></a></span>
        </div>
        </td>

        </tr>
        <?php }?>
        </tbody>
        </table>
    </div>
    <div class="col-sm-4">
    </div>

</div>

</div>
<div id="Banner" class="tabcontent" style="margin-left: 10px;margin-right: 10px;">
    <div style="text-align: right; "><a href="addBanner.php" style="color: #8d9499"><i class="fa fa-plus" aria-hidden="true"></i> เพิ่มป้าย</a></div>
    <div class="row">
        <div class="col-sm-3">
        </div>
        <div class="col-sm-5">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">รหัสป้าย</th>
                    <th scope="col">ชื่อป้าย</th>
                    <th scope="col">ขนาด</th>
                    <th scope="col"><div style="text-align: center">Option</div></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td scope="row">69+380L</td>
                    <td>VMS กม.1</td>
                    <td>416x160</td>
                    <td><div style="text-align: center"><i class="fa fa-trash" aria-hidden="true"></i></div></td>
                </tr>
                <tr>
                    <td scope="row">69+381L</td>
                    <td>VMS ทดสอบ</td>
                    <td>416x160</td>
                    <td><div style="text-align: center"><i class="fa fa-trash" aria-hidden="true"></i></div></td>
                </tr>
                <tr>
                    <td scope="row">69+380R</td>
                    <td>ป้ายไฟพัทยา</td>
                    <td>416x160</td>
                    <td><div style="text-align: center"><i class="fa fa-trash" aria-hidden="true"></i></div></td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-sm-4">
        </div>

    </div>

</div>
<br>
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

        new DataTable('#example');
    });

    function disableUser(userCodeInput){
        var hashEncode='76605981da8c7170dd309c591438288b';
        $.ajax({
            type: "POST",
            url: "lib/processUser.php",
            data: {'usercode': userCodeInput,'encode':hashEncode},
            success: function(result) {
                if(result==1) {
                    document.getElementById('statusUserNonActive' + userCodeInput).style.display = 'none';
                    document.getElementById('statusUserBlockActive' + userCodeInput).style.display = 'block';
                    document.getElementById('statusUser' + userCodeInput).innerHTML = 'Unactive';
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
</script>
</body>
</html>
