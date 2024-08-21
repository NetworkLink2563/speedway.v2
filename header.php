<?php
ob_start();
session_start();
include "lib/DatabaseManage.php";
$user=$_SESSION['user'];
if($user==''){
    session_destroy();
    header( "location: index.php" );
    exit(0);
}else{
    $stmt = "SELECT TMstMCustomer.XVCstCode, TMstMCustomer.XVCstName
FROM TMstMCustomer
INNER JOIN TMstMUser ON TMstMCustomer.XVCstCode = TMstMUser.XVCstCode
WHERE TMstMUser.XVCstCode='".$user."'";

    $query = sqlsrv_query($conn, $stmt);
    $result = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
}

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

echo ThDate(); // แสดงวันที่

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="/img/favicon.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>City Motorway Division</title>
    <link rel="stylesheet" href="/dist/css/all.min.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">
    <link rel="canonical" href="/dist/css/dataTables.bootstrap4.css">

    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/starter-template.css" rel="stylesheet">

    <link href="Select2/css/select2.css" rel="stylesheet">
    <link rel="stylesheet" href="./dist/css/bootstrap5-toggle.min.css">
    <style>
        body {
            background: #e1f0fa;
            margin-left: 0px;
            margin-top: 0px;
            margin-right: 0px;
            margin-bottom: 0px;
        }
        .input {
            width: 100%;
            max-width: 220px;
            height: 40px;
            padding: 5px;
            border-radius: 12px;
            border: 1.5px solid lightgrey;
            outline: none;
            transition: all 0.3s cubic-bezier(0.19, 1, 0.22, 1);
            box-shadow: 0px 0px 20px -18px;
        }

        .input:hover {
            border: 2px solid lightgrey;
            box-shadow: 0px 0px 20px -17px;
        }

        .input:active {
            transform: scale(0.95);
        }

        .input:focus {
            border: 2px solid grey;
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

        .box {
            width: 99%;
            float: left;
            border-radius: 8px;
            background-color: white;
        }
        .tab {
            overflow: hidden;
            border: 1px solid #ccc;
            background-color: #f1f1f1;
        }

        /* Style the buttons inside the tab */
        .tab button {
            background-color: inherit;
            float: left;
            border: none;
            outline: none;
            cursor: pointer;
            padding: 14px 16px;
            transition: 0.3s;
            font-size: 17px;
        }

        /* Change background color of buttons on hover */
        .tab button:hover {
            background-color: #ddd;
        }

        /* Create an active/current tablink class */
        .tab button.active {
            background-color: #ccc;
        }

        /* Style the tab content */
        .tabcontent {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        .tabcontent2 {
            display: none;
            padding: 6px 12px;
            border: 1px solid #ccc;
            border-top: none;
        }
        @font-face {
            font-family: SarunThangLuang;
            src: url('fonts/SarunThangLuang.ttf');
        }
        @font-face {
            font-family: THSarabun;
            src: url('fonts/THSarabun.ttf');
        }
        
    </style>
    <link rel="stylesheet" href="dist/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/jquery.datetimepicker.css">
    <script src="sweetalert2/dist/sweetalert2.min.js"></script>
    <link href="sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
    <script src="Jquery/jquery-3.6.0.js"></script>
    <link href="b4modalfullscreen/bootstrap4-modal-fullscreen.min.css" rel="stylesheet">
</head>
<body class="kanit-light">

<?php include('navbar.php'); ?>


<!-- <nav class="navbar navbar-expand-md navbar-dark bg-hightway fixed-top" style="margin-top: -10px">
    <div class="row">
        <div class="col-sm-4">
            <table width="100%" border="0">
                <tr>
                    <td width="100"><a class="navbar-brand" href="#"><img src="img/logo.png" alt="Responsive image"></a></td>
                    <td width="1179" style="color: #fff"><div align="left"><span style="font-size: 15px;">กองการทางพิเศษระหว่างเมือง กรมทางหลวง</span><br>City Motorway Division<br>Department of Hightways</div></td>
                </tr>
            </table>
        </div>
        <div class="col-sm-5 hide575 center" ><div align="center"><span style="font-size: 25px; color: #FFF;  #position: relative; #top: -50%;">VMS : Variable Message Sign : PC1</span></div></div>
        <div class="col-sm-3 hide575 center_ho">
            <div align="right" style="color: #fff"><//?php// echo $result['XVCstName'];?> (<//?php //echo $user;?>)<br><//?php// echo ThDate()." "; echo date("H:i:s"); ?></div>
        </div>
    </div>
</nav>
<div class="navbar navbar-expand-md navbar-dark bg-03548a fixed-top" style="margin-top: 120px">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto f10pt">
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="dashboard.php" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">หน้าหลัก</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                    <a class="dropdown-item f10pt"  href="dashboard.php">หน้าแรก</a>
                    <a class="dropdown-item f10pt"  href="setting.php">การตั้งค่า</a>
                    <a class="dropdown-item f10pt"  href="logout.php">ออกจากโปรแกรม</a>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การควบคุม</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                    <a class="dropdown-item f10pt"  href="consolbanner.php">การควบคุมป้าย</a>
                    <a class="dropdown-item f10pt"  href="LabelWorkSchedule.php">ตารางการทำงานของป้าย</a>
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การแสดงข้อความ</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                    <a class="dropdown-item f10pt"  href="mainMessage.php">จัดการข้อความหลัก</a>
                    <a class="dropdown-item f10pt"  href="Schedulemessage.php">จัดตารางข้อความประชาสัมพันธ์</a>
                    
                    <a class="dropdown-item f10pt"  href="Trafficmessage.php">ข้อความสภาพจราจร</a>
   
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การแสดงข้อความประชาสัมพันธ์</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                    <a class="dropdown-item f10pt"  href="messagepublicrelations.php">สร้างข้อความประชาสัมพันธ์พื้นฐาน</a>
                    <a class="dropdown-item f10pt"  href="messagepublicrelationsframe.php">สร้างข้อความประชาสัมพันธ์แสดงบนป้าย</a>
                    <a class="dropdown-item f10pt"  href="messagepublicrelationsframegroup.php">สร้างชุดการแสดงป้ายประชาสัมพันธ์</a>
                    <a class="dropdown-item f10pt"  href="messagepublicrelationsplay.php">ข้อความป้ายประชาสัมพันธ์</a>
                   
                    
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">การแสดงข้อความสภาพจราจร</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                   
                    <a class="dropdown-item f10pt"  href="messagetraffics.php">สร้างข้อความสภาพการจราจรพื้นฐาน</a>
                    <a class="dropdown-item f10pt"  href="messagetrafficsframe.php">สร้างข้อความสภาพการจราจรแสดงบนป้าย</a>
                    <a class="dropdown-item f10pt"  href="messagetrafficsframegroup.php">สร้างชุดการแสดงป้ายจราจร</a>
                    <a class="dropdown-item f10pt"  href="messagetrafficsplay.php">ข้อความป้ายจราจร</a>
                    
                </div>
            </li>
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="" id="dropdown01" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">รายงาน</a>
                <div class="dropdown-menu"  style="background: #FFFFFF"aria-labelledby="dropdown01">
                    <a class="dropdown-item f10pt"  href="WorkReport.php">รายงานการปฏิบัติงาน</a>
                    <a class="dropdown-item f10pt"  href="SchedulemessageReport.php">รายงานข้อความป้าย</a>
                    <a class="dropdown-item f10pt"  href="VmsStatusReport.php">รายงานสถานะป้าย</a>
                    <a class="dropdown-item f10pt"  href="LigthReport.php">รายงานระดับความสว่าง</a>
                </div>
            </li>
        </ul>

    </div> -->
</div>