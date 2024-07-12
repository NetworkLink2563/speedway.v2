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
        box-shadow: 0px 1px 5px rgba(0,0,0,0.05);
        -webkit-transition: all 0.2s;
        -moz-transition: all 0.2s;
        transition: all 0.2s;
    }
</style>
<div class="centered" style="margin-top: 60;margin-left: 10;">

    <div class="box" style="margin-top: 30;" align="left">
        <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
            <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;เพิ่มผู้ใช้งาน
            <div style="margin-top:-5;"><hr></div>
        </div>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">Email
            </div>
            <div class="col-sm-1"><input type="email" id="emailaddress" name="emailaddress" class="form-control input" style="width: 200px; placeholder="Username" autocomplete="off" required autofocus>

            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">Password
            </div>
            <div class="col-sm-1"><input id="passwordInput" name="passwordInput" style="width: 200px;" type="password" name="textfield" class="input"/>
            </div>
        </div><br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">ชื่อ-สกุล
            </div>
            <div class="col-sm-1"><input id="nameThaiInput" name="nameThaiInput" style="width: 200px;" type="text" name="textfield" class="input"/>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
            </div>
            <div class="col-sm-1" style="margin-top: 5px">เบอร์โทรศัพท์
            </div>
            <div class="col-sm-1"><input id="phoneInput" name="phoneInput" style="width: 200px;" type="text" name="textfield" class="input"/>
            </div>
        </div>
        
        
        <br>
        <div align="center">
            <button type="submit" class="btn btn-success" value="validate" onclick="addUser();">บันทึก</button>
        </div>
        <br>
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
<script src="dist/js/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
<script src="https://cdn.ckeditor.com/4.8.0/full-all/ckeditor.js"></script>
<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/jquery.datetimepicker.full.min.js"></script>

<script src="dist/js/popper.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script type="text/javascript">
        function addUser(){
            window.setTimeout(function(){
                // Move to a new location or you can do something else
                window.location.href = "setting.php";
            }, 1500);
            var hashEncode='d15866ec75f5cedd2c0865041b9b1a6b';
            var emailer = document.getElementById("emailaddress").value;
            var password = document.getElementById("passwordInput").value;
            var phone = document.getElementById("phoneInput").value;
            var userActive = '1';
            var nameThai = document.getElementById("nameThaiInput").value;

            $.ajax({
                type: "POST",
                url: "processUser.php",
                data: {'Tyep':1,'encode':hashEncode,'emailer': emailer,'password':password,'phone':phone,'userActive':userActive,'nameThai':nameThai},
                success: function(result) {
                   alert(result)
                }
            });
        }
</script>

</body>
</html>
