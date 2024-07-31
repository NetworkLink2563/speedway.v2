<?php
include 'header.php';
include "permission.php";

if(checkmenu($user,'002')==0){
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
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

    .container{
        background-color:  white;
        
    }

</style>

<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/setting.png" height="25" alt="Responsive image"> 
        </div>


<div class="flex-container" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">

        <div class="col-12 shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> เพิ่มผู้ใช้งาน</a>
        </div>

        <div class="row col-12" style="margin-top: 2rem;">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>ชื่อผู้ใช้</span>
            </div>
            <div class="col-6"><input type="email" id="emailaddress" name="emailaddress" class="form-control input"
                    style="width: 100%;" placeholder=" Username" autocomplete="off" required autofocus>
            </div>
        </div>

        <div class="row col-12" style="padding-top:10px">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>รหัสผ่าน</span>
            </div>
            <div class="col-6">
                     <input placeholder="Password" class="input" style="width: 100%;" name="passwordInput" id="passwordInput" type="password" onkeyup='check();' /><i style="display_: none; text-align: right; cursor: pointer; position: absolute; top: 12px; left: 203px;" class="far fa-eye fa-eye-slash" id="togglePassword"></i>
            </div>
        </div>

        <div class="row col-12" style="padding-top:10px">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>รหัสผ่านอีกครั้ง</span>
            </div>
            <div class="col-6">
                     <input placeholder="Confirm Password" class="input" style="width: 100%;" name="confirm_password" id="confirm_password" type="password" onkeyup='check();' /><i style="display_: none; text-align: right; cursor: pointer; position: absolute; top: 12px; left: 203px;" class="far fa-eye fa-eye-slash" id="togglePassword2"></i> <span id="message"></span>
            </div>
        </div>


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
</script>


        <div class="row col-12" style="padding-top:10px; justify-content: center; align-items: center;">
            <div class="col-6" style="margin-top: 5px; text-align: right;">
                <span>เวลาเข้าทำงาน</span>
            </div>
            <div class="col-6">
                <select  id="SelXVShfCode" class="input" style="width: 100%;">
                <?php include "lib/DatabaseManage.php";?>
                <?php
                        $sql="SELECT  XVShfCode, XVShfName, XIShfStartHour, XIShfStartMin, XIShfEndHour, XIShfEndMin
                              FROM dbo.TMstMShift
                              ORDER BY XVShfCode";
                        $query= sqlsrv_query($conn, $sql);
                        while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
                            $timeshift='[&nbsp;'.str_pad($row['XIShfStartHour'],2,"0",STR_PAD_LEFT).':'
                            .str_pad($row['XIShfStartMin'],2,"0",STR_PAD_LEFT).'&nbsp;-&nbsp;'.str_pad($row['XIShfEndHour'],2,"0",STR_PAD_LEFT)
                            .':'.Str_pad($row['XIShfEndMin'],2,"0",STR_PAD_LEFT).'&nbsp;]';

                           //$t=$row["XIShfStartHour"].':'.$row["XIShfStartMin"].'-'.$row["XIShfEndHour"].':'.$row["XIShfEndMin"].' น';
                           echo '<option value="'.$row["XVShfCode"].'">'.$row["XVShfName"].' '. $timeshift.'</option>';
                           
                        }
                        sqlsrv_close( $conn );
                ?>
                </select>
            </div>
        </div>

        <div class="row col-12" style="padding-top:10px; justify-content: center; align-items: center;">
            <div class="col-2" style="margin: 2rem; display: flex; justify-content: center; align-items: center;">
                <button style="width: 70%; box-shadow: 3px 3px 3px #aaaaaa !important;" type="button" class="btn btn-success" onclick="addUser();">บันทึก</button>
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
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

<script type="text/javascript">
function addUser() {
    var emailer = document.getElementById("emailaddress").value;
    var password = document.getElementById("passwordInput").value;
    var XVShfCode = document.getElementById("SelXVShfCode").value;
   
    $.ajax({
        type: "POST",
        url: "processUser.php",
        data: {
            'Type': 1,
            'emailer': emailer,
            'password': password,
            'XVShfCode':XVShfCode
        },
        success: function(result) {
         
           window.location.href = "setting.php";

        }
    });
    
}
</script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#passwordInput');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash'); 
});
</script>

<script>
    const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#confirm_password');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash'); 
});
</script>

</body>

</html>