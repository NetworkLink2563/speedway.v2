<?php
session_start();
include 'header.php';
include "permission.php";
include "lib/DatabaseManage.php";
include "service/privilege.php";


// if(checkmenu($user,'002')==0){
//     session_destroy();
//     header( "location: index.php" );
//     exit(0);
// }
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

    body {
        background: #e1f0fa;
    }

    .container {
        background-color: white;

    }
</style>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="./dist/css/all.min.css">




<!-- <script>
    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#confirm_password');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash'); 
});
</script> -->

<script>
    var check = function() {
        if (document.getElementById('passwordInput').value ==
            document.getElementById('confirm_password').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = 'รหัสตรงกัน';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = 'รหัสไม่ตรงกัน';
        }
    }

    function chgpwd() {
        var conf = confirm('คุณต้องการเปลี่ยนรหัสผ่านหรือไม่');
        if(conf==true) {
        var password = document.getElementById("passwordInput").value;
        var userchk = '<?php echo $_SESSION['userName']; ?>';
        $.ajax({
            type: "POST",
            url: "processUser.php",
            data: {'Type': 2,'password': password, 'uname' : userchk},
            success: function(result) {
               if(result==1){
               alert('เปลี่ยนรหัสผ่านสำเร็จ');
               window.location.href = "dashboard.php";
               }else if(result==2){
                alert('รหัสผ่านซ้ำกับรหัสผ่านเดิม');
               }else{
                alert('กรุณาติดต่อเจ้าหน้าที่ดูแลระบบ');
               }
            }
        });
        }
    }

</script>

<div class="container" style="position: relative; top: 75;">
    <div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
        <img src="./img/icon/setting.png" height="25" alt="Responsive image">
    </div>
    <div class="flex-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu; color: white;"><i class="fa fa-list-alt" aria-hidden="true"></i> เปลี่ยรหัสผ่าน</a>
        </div>
        <h style="text-align: left;width:100%; padding-top: 1%;">
            
            <b id="css-files" style=" padding-left: 1%;">โปรดตั้งรหัสผ่านใหม่ เพื่อความปลอดภัย</b><br>
            <br><h id="css-files" style="font-size:14px; padding-left: 1%;">เพื่อความปลอดภัยของระบบโดยรวม ทางด้านผู้ดูแลลระบบได้ตั้งค่ารหัสผ่านของท่านเป็นมาตรฐานของผู้เข้าใช้ระบบ 
              ดังนั้นเพื่อประโยนช์ของท่าน โปรดดำเนินการ ตั้งรหัสผ่านใหม่ ตามขั้นตอนดังนี้<h/><br><br>
            <h id="css-files" style="font-size:14px; padding-left: 2%;"><r style="text-decoration: underline">ข้อเสนอแนะเกี่ยวกับตั้งค่ารหัสผ่าน</r><h/><br>
            <h id="css-files" style="font-size:14px; padding-left: 2%;">1. รหัสผ่านใหม่ต้องไม่ซ้ำกับรหัสเดิม</h><br>
            <h id="css-files" style="font-size:14px; padding-left: 2%;">2. รหัสผ่าน ควรประกอบไปด้วย ตัวอักษร หรือตัวเลข</h><br>
            <h id="css-files" style="font-size:14px; padding-left: 2%;">3. ไม่ควรตั้งค่ารหัสผ่านเดียวกับอีเมล หรือ facebook</h><br>
            <h id="css-files" style="font-size:14px; padding-left: 2%;">4. ควรเปลี่ยนรหัสผ่าน เพื่อใช้งานระบบต่อไป</h>
        </div>
        <div  class="row col-12" style="padding-top:10px">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>รหัสผ่านใหม่</span>
            </div>
            <div class="col-6">
                <input placeholder="NewPassword" value="" class="form-control input" style="width: 100%;" name="passwordInput" id="passwordInput" type="password" onkeyup='check();' /><i style="display_: none; text-align: right; cursor: pointer; position: relative; left: -26px;" class="fa-regular fa-eye-slash" id="togglePassword"></i>
            </div>
        </div>
        <div  class="row col-12" style="padding-top:10px">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>ยืนยันรหัสผ่านใหม่อีกครั้ง</span>
            </div>
            <div class="col-6">
                <input placeholder="Confirm NewPassword" class="form-control input" style="width: 100%;" value="" name="confirm_password" id="confirm_password" type="password" onkeyup='check();' />
                <!-- <i style="display_: none; text-align: right; cursor: pointer; position: absolute; top: 12px; left: 203px;" class="far fa-eye fa-eye-slash" id="togglePassword2"></i>  -->
                <span id="message" style="margin-left: 5px;"></span>
            </div>
        </div>
        <div class="row col-12" style="padding-top:10px; justify-content: center; align-items: center;">
            <div class="col-2" style="margin: 2rem; display: flex; justify-content: center; align-items: center;">
                <button style="width: 70%; box-shadow: 3px 3px 3px #aaaaaa !important;" type="button" class="btn btn-success" onclick="chgpwd();">เปลี่ยนรหัสผ่าน</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Text</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe_modal" src="" style="width: 100%; height: 190;"></iframe>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModalImg" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modal Image</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <iframe id="iframe_modalImg" src="" style="width: 435; height: 190;"></iframe>
            </div>
        </div>
    </div>
</div>
</body>

<?php include("footer.php"); ?>
</html>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#passwordInput');
    const password2 = document.querySelector('#confirm_password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        password2.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye');
    });
</script>