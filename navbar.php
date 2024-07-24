        <link rel="icon" type="image/png" href="http://www.centrecities.com/speedway/img/favicon.png" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
        <title>City Motorway Division</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="dist/css/css.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet">



<style>

    .navbar{
        display: flex;
        background-color: #006eb4;
        align-items: center;
        justify-content: center;
        color: #fff;
        padding: 1rem 0.5rem;       
    }

    .navbar .logo{
        display: flex;
        width: 30%;
        padding: 0 1rem;
        align-items: center;
        justify-content: center; 
    }

    .navbar .logo p{
        padding: 0;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .navbar h4{
        display: flex;
        position: relative;
        left: 120px;
        align-items: center;
        flex: 1;
        padding: 0.5rem;
        font-size: 1.5rem;
    }

    .msg-right{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 20%;
        text-align: right;
    }

    .msg-right p{
        margin: 0 0.5rem;
        font-size: 0.9rem;
    }

    .fixed-top {
    position: fixed;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1030;
}

.navbar-menu{
    margin-top: 140px;
    background: #034672 !important;
    color: white;
}

.collapse ul li button{
  font-weight: 300;
  transition: 0.5s;
}

.dropdown-item{
  font-weight: 200;
  transition: 0.5s;
}

.dropdown-menu{
  transition: 0.5s;
}

.navbar-menu{
        padding: 0.3rem 0.5rem;
    }

.container-fluid a{
        font-size: 0.8rem;
    }

.dropdown button{
    font-size: 0.8rem;
}

.dropdown button{
    font-size: 0.89rem;
    color: white;
    opacity: 0.7;
    transition: 0.3s;
    margin: 0 0.5rem;
}

.dropdown button:hover{
    opacity: 1;
}

.dropdown-menu{
    background-color: #003b60;
}

.navbar-nav{
    margin: 0 0.5rem;
    border-right: 1px solid #cccc;
}

.form-control{
    display: inline-block;
}

.form-control-sm{
    padding: 0 0.5rem;
    font-size: 0.8rem;
}

p {
  font-size: .8rem;
}
</style>
</style>

    <!-- navbar  start-->
<div class="navbar fixed-top">

        <div class="logo"><img src="img/logo.png" alt="">
        <p>กองการทางพิเศษระหว่างเมือง กรมทางหลวง<br>
    City Motorway Division
    Department of Hightways</p>
</div>
        
        <h4></h4>
        <div class="msg-right">
        <!-- <p>(test3@test.com)<br>
        วันพฤหัส ที่ 11 เดือน กรกฏาคม พ.ศ. 2567<br>
        08:12:14</p> -->
        <p><?php echo "ผู้ใช้งาน: ".$result['XVCstName'].$user."<br>".ThDate()." "."<br>"."เวลา: ".date("H:i:s"); ?></p>
        </div>
</div>

<nav class="navbar navbar-menu navbar-expand-lg navbar-dark bg-dark fixed-top" style="width: 100vw;">
  <div class="container-fluid">
    <!-- <a class="navbar-brand" href="#">Navbar</a> -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDarkDropdown" aria-controls="navbarNavDarkDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center align-item-center" id="navbarNavDarkDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            หน้าหลัก
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="dashboard.php">หน้าแรก</a></li>
            <!-- <li><a class="dropdown-item" href="setting.php">การตั้งค่า</a></li> -->
            <li><a class="dropdown-item" href="logout.php">ออกจากโปรแกรม</a></li>
            <!-- <li><a class="dropdown-item" href="#">Something else here</a></li> -->
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การควบคุม
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="consolbanner.php">การควบคุมป้าย</a></li>
            <li><a class="dropdown-item" href="LabelWorkSchedule.php">ตารางการทำงานของป้าย</a></li>
          </ul>
        </li>
      </ul>

      <!-- <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความ
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="mainMessage.php">จัดการข้อความหลัก</a></li>
            <li><a class="dropdown-item" href="Schedulemessage.php">จัดตารางข้อความประชาสัมพันธ์</a></li>
          </ul>
        </li>
      </ul> -->
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความประชาสัมพันธ์
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="message_wizard.php" style="text-decoration: underline;">>> คลิกดูตัวช่วยสร้างข้อความ <<</a></li>
            <li><a class="dropdown-item" href="messagepublicrelations.php">1.สร้างข้อความประชาสัมพันธ์พื้นฐาน</a></li>
            <li><a class="dropdown-item" href="messagepublicrelationsframe.php">2.สร้างข้อความประชาสัมพันธ์แสดงบนป้าย</a></li>
            <li><a class="dropdown-item" href="messagepublicrelationsframegroup.php">3.สร้างชุดการแสดงป้ายประชาสัมพันธ์</a></li>
            <li><a class="dropdown-item" href="messagepublicrelationsplay.php">4.ข้อความป้ายประชาสัมพันธ์</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความสภาพจราจร
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
          <li><a class="dropdown-item" href="traffic_wizard.php" style="text-decoration: underline;">>> คลิกดูตัวช่วยสร้างข้อความจราจร <<</a></li>
            <li><a class="dropdown-item" href="messagetraffics.php">1.สร้างข้อความสภาพการจราจรพื้นฐาน</a></li>
            <li><a class="dropdown-item" href="messagetrafficsframe.php">2.สร้างข้อความสภาพการจราจรแสดงบนป้าย</a></li>
            <li><a class="dropdown-item" href="messagetrafficsframegroup.php">3.สร้างชุดการแสดงป้ายจราจร</a></li>
            <li><a class="dropdown-item" href="messagetrafficsplay.php">4.ข้อความป้ายจราจร</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            รายงาน
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="WorkReport.php">รายงานการปฏิบัติงาน</a></li>
            <li><a class="dropdown-item" href="SchedulemessageReport.php">รายงานข้อความป้าย</a></li>
            <li><a class="dropdown-item" href="VmsStatusReport.php">รายงานสถานะป้าย</a></li>
            <li><a class="dropdown-item" href="LigthReport.php">รายงานระดับความสว่าง</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav" style="margin: 0;">
        <li class="nav-item dropdown">
          <button onclick="location.href='setting.php'" class="btn"  aria-expanded="false">การตั้งค่า</button>
          <!-- <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="setting.php">การตั้งค่า</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul> -->
        </li>
      </ul>

      <div class="time-duration navbar-nav" style="border: none; text-align: center;  margin-left: .5rem; opacity: .8;font-size: 14px;">
        <span>เวลาเลิกงาน : </span>
      <span id="time" style="display: inline-block;padding: 0rem .5rem;width: 155px; text-align: left;font-size: 14px;"></span>
      </div>


    </div>
  </div>
</nav>
</nav>
     <!-- navbar end-->

<script>
  var endtime = '<?php echo $_SESSION['XIShfEndHour'].':'.$_SESSION['XIShfEndMin'].':00';?>';
  const date = new Date();
  const formattedDate = date.toISOString().split('T')[0].replace(/-/g, '-') + ' '+endtime;

  var countDownDate = new Date(formattedDate).getTime();
  var x = setInterval(function() {
  var now = new Date().getTime();
    
  // Find the distance between now and the count down date
  var distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="demo"
  document.getElementById("time").innerHTML =  hours + "ชั่วโมง "
  + minutes + "นาที " + seconds + "วินาที ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);

      document.getElementById("time").innerHTML = "EXPIRED";
      window.location.href = "logout.php";
  }
}, 1000);
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>