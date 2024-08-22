<link rel="stylesheet" href="dist/css/all.min.css">

<?php
session_start();
if($_SESSION['userName']!=''){
    header("Location: dashboard.php");
    die();
}
include "lib/DatabaseManage.php";

$stmt = "SELECT XVUsrCode,XVUsrPwd,XVUsrPwdDef,XVUsrName
FROM TMstMUser
WHERE TMstMUser.XVUsrCode='Test'";

$query = sqlsrv_query($conn, $stmt);
$result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);

    echo $result["XVUsrCode"];

echo "<meta charset='utf-8'>";
function ThDate()
{
//วันภาษาไทย
    $ThDay = array ( "อาทิตย์", "จันทร์", "อังคาร", "พุธ", "พฤหัส", "ศุกร์", "เสาร์" );
//เดือนภาษาไทย
    $ThMonth = array ( "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน","พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม","กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม" );

//กำหนดคุณสมบัติ
    $week = date( "w" ); // ค่าวันในสัปดาห์ (0-6)
    $months = date( "m" )-1; // ค่าเดือน (1-12)
    $day = date( "d" ); // ค่าวันที่(1-31)
    $years = date( "Y" )+543; // ค่า ค.ศ.บวก 543 ทำให้เป็น ค.ศ.

    return "วัน$ThDay[$week] 
		ที่ $day  
		เดือน $ThMonth[$months] 
		พ.ศ. $years";
}

//echo ThDate(); // แสดงวันที่

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="img/favicon.ico">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>City Motorway Division</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="./dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="./dist/js/jquery-3.7.1.js"></script>
    <script src="./dist/js/popper.min.js"></script>
    <script src="./dist/js/main_speed.js"></script>
    <script src="./dist/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="./dist/css/starter-template.css" rel="stylesheet">


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="./dist/js/jquery-3.2.1.slim.min.js"></script>
<script src="./dist/js/jquery-3.7.1.min.js"></script>


<script type="text/javascript">
    
    $(document).ready(function() {
       $('#inputPassword').change(function() {
           var val = $(this).val();
           var optionx = document.getElementById("XVShfCode").value;
           var userName = document.getElementById("username").value; //alert(userName);
           var datastring='load=0001'+ '&userName=' +userName;
           $.ajax({type:"POST", url:"service/login.php",
            data: datastring,cache:false,
            success:function(html){
               // alert(html);
                 var lcode=html.trim()
                document.getElementById("XVShfCode").value = lcode;
            }
           })      
           })
        });

    $("#inputPassword").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#myButton").click();
        }
    });
    $("#username").keyup(function(event) {
        if (event.keyCode === 13) {
            $("#myButton").click();
        }
    });

    function loginSystem() {
        var userName = document.getElementById("username").value;
        var passWord = document.getElementById("inputPassword").value;
        var hashEncode= 'd56b699830e77ba53855679cb1d252da';
        var XVShfCode=document.getElementById("XVShfCode").value;
        $.ajax({
            type: "POST",
            url: "lib/processLogin.php",
            data: {'XVShfCode':XVShfCode,'username': userName,'password':passWord,'encode':hashEncode},
            success: function(result) {
                var chklogin =JSON.parse(result);
             //   console.log(chklogin.result);
                if(chklogin.result=='True'){
                if(chklogin.chgPwd=='1'){
                window.location.href = 'change_pwd.php'; 
                }else if(chklogin.chgPwd=='0'){
                 window.location.href = 'dashboard.php'; 
                }
                }else if(chklogin.result=='False'){
                    document.getElementById('resultDiv').style.display = 'none';
                    document.getElementById("username").value='';
                    document.getElementById("inputPassword").value='';
                    
                }
                   
            }
        });
    }


    const validateEmail = (email) => {
        return email.match(
            /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };

    const validate = () => {
        const $result = $('#result');
        const email = $('#username').val();
        $result.text('');

        if(validateEmail(email)){
            $result.text(email + ' is valid.');
            $result.css('color', 'green');
        } else{
            $result.text(email + ' is invalid.');
            $result.css('color', 'red');
        }
        return false;
    }

    $('#username').on('input', validate);
</script>

<!-- <script>
    togglePassword.addEventListener('click', function (e) {
    toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    toggle the eye slash icon
    this.classList.toggle('fa-eye-slash'); 
});


</script> -->





    <style>
        body {
            background: #e1f0fa;
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }
        .bg-03548a{background-color:#03548a !important}
        .bg-hightway {
            background-color: #006eb4 !important;
        }
        .center {
            height: 115px;
            line-height: 115px; /* same as height! */
        }
        .center_ho {
            margin-top: 35;
            font-size: 10pt;
        }
        .kanit-thin {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: normal;
        }

        .kanit-extralight {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: normal;
        }

        .kanit-light {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: normal;
        }

        .kanit-regular {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: normal;
        }

        .kanit-medium {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: normal;
        }

        .kanit-semibold {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: normal;
        }

        .kanit-bold {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: normal;
        }

        .kanit-extrabold {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: normal;
        }

        .kanit-black {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: normal;
        }

        .kanit-thin-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 100;
            font-style: italic;
        }

        .kanit-extralight-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 200;
            font-style: italic;
        }

        .kanit-light-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 300;
            font-style: italic;
        }

        .kanit-regular-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 400;
            font-style: italic;
        }

        .kanit-medium-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 500;
            font-style: italic;
        }

        .kanit-semibold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 600;
            font-style: italic;
        }

        .kanit-bold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 700;
            font-style: italic;
        }

        .kanit-extrabold-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 800;
            font-style: italic;
        }

        .kanit-black-italic {
            font-family: "Kanit", sans-serif;
            font-weight: 900;
            font-style: italic;
        }
        .f10pt{
            font-size: 10pt;
        }
        .centered {
            position: fixed; /* or absolute */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -40%);
        }
        .box {
            width: 400px;
            float: left;
            border-radius: 8px;
            background-color: white;
        }

        .btn:hover{
        opacity: 1!important;
        transition: 0.5s;
    }

    .button span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
}

.button span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
}

.button:hover span {
  padding-right: 25px;
}

.button:hover span:after {
  opacity: 1;
  right: 0;
}

.shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

#forgetpass{
    float: right;
}

.passdiv a{
    text-decoration: none;
}

.passdiv a:hover{
    text-decoration: underline;
}

    </style>
</head>

<body class="kanit-light">

<nav class="navbar navbar-expand-md navbar-dark bg-hightway fixed-top" style="margin-top: -10px">
    <div class="row">
        <div class="col-sm-4">
            <table width="100%" border="0">
                <tr>
                    <td width="100"><a class="navbar-brand" href="#"><img src="img/logo.png" alt="Responsive image"></a></td>
                    <td width="1179" style="color: #fff"><div align="left"><span style="font-size: 15px;">กองการทางพิเศษระหว่างเมือง กรมทางหลวง</span><br>City Motorway Division<br>Department of Hightways</div></td>
                </tr>
            </table>
        </div>
        <!-- <div class="col-sm-5 hide575 center" ><div align="center"><span style="font-size: 25px; color: #FFF;  #position: relative; #top: -50%;">VMS : Variable Message Sign : PC1</span></div></div> -->
        <div class="col-sm-3 hide575 center_ho">
        </div>
    </div>
</nav>
<div class="navbar navbar-expand-md navbar-dark bg-03548a fixed-top" style="margin-top: 120px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

</div>

<main role="main" class="container" style="margin-top: 30;">

    <div class="centered">
        <div class="box" align="center" style="padding: 2rem ; ">

            <!-- login start -->
            
            <div  class="row" style="width: 350px;">


            <div id="logindiv" class="">
                <div class="col-sm-12" style="font-size: 1rem; font-weight: 500;">
                    <span >CITY MOTORWAY DIVISION</span><br>
                    <span >กองการทางพิเศษระหว่างเมือง กรมทางหลวง</span>
                </div>
                <div class="col-sm-12" style="margin-top: 20px">
                    <div class="row">
                        <div class="col-sm-12" style="margin-bottom: .5rem;">
                            <input type="email" id="username" name="username" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
                        </div>
                        <!-- <div id="resultDiv" style="margin-left: 14px;"><p id="result" ></p></div> -->
                        <div class="col-sm-12 passdiv" style="margin-bottom: .5rem;">
                            <label for="inputPassword" class="sr-only">Password</label>
                            <input type="password" id="inputPassword" name="inputPassword" class="form-control" autocomplete="off" placeholder="Password" required>
                            <i style="clear: right; text-align: right; cursor: pointer; position: relative; top: -28px; left: 178px;" class="fa-regular fa-eye-slash" id="togglePassword"></i>
                            <a id="forgetpass" href="#" onclick="forgetpass()">ลืมรหัสผ่าน</a>
                        </div>
                        <div class="col-sm-12" style="margin-bottom: .5rem;">
                          
                            <select id="XVShfCode" class="form-control ">
                                <option value="">เลือกกะทำงาน</option>
                                <?php
                                        function twodigit($number){
            
                                            if($number<10){
                                            $ret='0'.$number;
                                            }else{
                                            $ret=$number;
                                            }
                                        return $ret;
                                    }
                                     include "lib/DatabaseManage.php";
                                     $sql="SELECT XVShfCode, XVShfName, XIShfStartHour, XIShfStartMin, XIShfEndHour, XIShfEndMin
                                     FROM   dbo.TMstMShift order by XVShfCode";
                                   
                                     $query = sqlsrv_query($conn, $sql);
                                     while($result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC))
                                     {
                                        $s=twodigit($result["XIShfStartHour"]).':'.twodigit($result["XIShfStartMin"]).'-'.twodigit($result["XIShfEndHour"]).':'.twodigit($result["XIShfEndMin"]);
                                        echo  '<option value="'.$result["XVShfCode"].'" >'.$result["XVShfName"].' เวลา '.$s.' น.</option>';
                                     }
                                ?>
                           
                            </select>
                        </div>
                        
                        <div class="col-sm-12" style="margin-top: 20px;">
                            <button id="myButton" class="btn btn-primary btn button shadow" style="font-size: 1rem; background-color: #4976BA; opacity: .8; width: 100%;" type="submit" onclick="loginSystem()"><span>เข้าสู่ระบบ  </span></button>
                        </div>


                        </div>
                    </div>
                    </div>
                    </div>

                   
                    <!-- login end -->

                    <!-- forgetpass start -->
                    
                    
                    
                    <div  class="row" style="width: 350px;">
                    <div id="forgetpassdiv" class="">
                <div class="col-sm-12" style="font-size: 1rem; font-weight: 500; padding-top: 20px;">
                    <span >CITY MOTORWAY DIVISION</span><br>
                    <span >กองการทางพิเศษระหว่างเมือง กรมทางหลวง</span>
                </div>
                <div class="col-sm-12" style="margin-top: 20px">
                    
                        <div class="col-sm-12" style="margin-bottom: .5rem;">
                            <input type="email" id="username2" name="username2" class="form-control" placeholder="Username" autocomplete="off" required autofocus>
                        </div>
                        
                        <!-- <div id="resultDiv" style="margin-left: 14px;"><p id="result" ></p></div> -->
                        <div class="col-sm-12 passdiv" style="margin-bottom: .5rem;">
                            <div>
                            <label for="inputPassword2" class="sr-only">Password</label>
                            <input onkeyup='check();' type="password" id="inputPassword2" name="inputPassword2" class="form-control" autocomplete="off" placeholder="Password" required>
                            <i style="clear: right; text-align: right; cursor: pointer; position: relative; top: -30px; left: 151px;" class="fa-regular fa-eye-slash" id="togglePassword2"></i>
                            <span id="message" style="position: relative; top: 31px; left: 165px;"></span>
                            </div>
                            <div>
                            <input onkeyup='check();' style="position: relative; top: -8px;" type="password" id="confirmpass" name="inputPassword" class="form-control" autocomplete="off" placeholder="Confirm Password" required>
                            </div>
                            <div>
                            <a style="margin-bottom: 1rem;" id="forgetpass" href="#" onclick="forgetpass()">กลับหน้าหลัก</a>
                            </div>
                        </div>
                        
                        <div class="col-sm-12" style="margin-top: 20px;">
                            <button id="forgetpass" class="btn btn-success btn button shadow" style="font-size: 1rem;  opacity: .8; width: 100%;" type="button" onclick="chgpwd()"><span>เปลี่ยนรหัสผ่าน  </span></button>
                        </div>



                        </div>
                    
                    
 
                    <!-- forgetpass end -->
                    <div align="center">

                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- /.container -->
<?php include "footer.php"; ?>
<div class="modal" id="myModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="text-align: center; color: Red">
                    <p>ไม่สามรถเข้าสู่ระบบได้ กรุณาติดต่อผู้ดูแลระบบ</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#inputPassword');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye'); 
});


const togglePassword2 = document.querySelector('#togglePassword2');
    const password2 = document.querySelector('#inputPassword2');
    const password3 = document.querySelector('#confirmpass');

  togglePassword2.addEventListener('click', function (e) {
    // toggle the type attribute
    const type2 = password2.getAttribute('type') === 'password' ? 'text' : 'password';
    password2.setAttribute('type', type2);
    password3.setAttribute('type', type2);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye'); 
});


$("#forgetpassdiv").hide();
function forgetpass(){

    $("#logindiv").toggle(
    function(){$("#forgetpassdiv").toggle("slow");}
    );

}

function chgpwd() {
        var conf = confirm('คุณต้องการเปลี่ยนรหัสผ่านหรือไม่');
        if(conf==true) {
        var password = document.getElementById("inputPassword2").value;
        var userchk = document.getElementById("username2").value;;
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


    var check = function() {
        if (document.getElementById('inputPassword2').value ==
            document.getElementById('confirmpass').value) {
            document.getElementById('message').style.color = 'green';
            document.getElementById('message').innerHTML = '<i class="fa-solid fa-check"></i>';
        } else {
            document.getElementById('message').style.color = 'red';
            document.getElementById('message').innerHTML = '<i class="fa-solid fa-xmark"></i>';
        }
    }


</script>

</body>
</html>
