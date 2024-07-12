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
        padding: 0 1rem;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .navbar h4{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50%;
        padding: 0.5rem;
        font-size: 1.5rem;
    }

    .msg-right{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 20%;
        text-align: center;
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
    margin-top: 127px;
    background: #034672 !important;
    color: white;
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

</style>

    <!-- navbar  start-->
<div class="navbar fixed-top">

        <div class="logo"><img src="dist/img/logo.png" alt="">
        <p>กองการทางพิเศษระหว่างเมือง กรมทางหลวง<br>
    City Motorway Division
    Department of Hightways</p>
</div>
        
        <h4>VMS : Variable Message Sign : PC1</h4>
        <div class="msg-right">
        <p>(test3@test.com)<br>
        วันพฤหัส ที่ 11 เดือน กรกฏาคม พ.ศ. 2567<br>
        08:12:14</p>
        </div>
</div>

<nav class="navbar navbar-menu navbar-expand-lg navbar-dark bg-dark fixed-top">
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
            <li><a class="dropdown-item" href="#">การตั้งค่า</a></li>
            <li><a class="dropdown-item" href="#">ออกจากโปรแกรม</a></li>
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
            <li><a class="dropdown-item" href="#">การควบคุมป้าย</a></li>
            <li><a class="dropdown-item" href="#">ตารางการทำงานของป้าย</a></li>
          </ul>
        </li>
      </ul>

      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความ
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">จัดการข้อความหลัก</a></li>
            <li><a class="dropdown-item" href="#">จัดตารางข้อความประชาสัมพันธ์</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความประชาสัมพันธ์
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">สร้างข้อความประชาสัมพันธ์พื้นฐาน</a></li>
            <li><a class="dropdown-item" href="/motorway/messagepublicrelationsframe.php">สร้างข้อความประชาสัมพันธ์แสดงบนป้าย</a></li>
            <li><a class="dropdown-item" href="#">สร้างชุดการแสดงป้ายประชาสัมพันธ์</a></li>
            <li><a class="dropdown-item" href="#">ข้อความป้ายประชาสัมพันธ์</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
          การแสดงข้อความสภาพจราจร
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">สร้างข้อความสภาพการจราจรพื้นฐาน</a></li>
            <li><a class="dropdown-item" href="#">สร้างข้อความสภาพการจราจรแสดงบนป้าย</a></li>
            <li><a class="dropdown-item" href="#">สร้างชุดการแสดงป้ายจราจร</a></li>
            <li><a class="dropdown-item" href="#">ข้อความป้ายจราจร</a></li>
          </ul>
        </li>
      </ul>
      
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <button class="btn dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            รายงาน
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item" href="#">รายงานการปฏิบัติงาน</a></li>
            <li><a class="dropdown-item" href="#">รายงานข้อความป้าย</a></li>
            <li><a class="dropdown-item" href="#">รายงานสถานะป้าย</a></li>
            <li><a class="dropdown-item" href="#">รายงานระดับความสว่าง</a></li>
          </ul>
        </li>
      </ul>
      
    </div>
  </div>
</nav>

</nav>
     <!-- navbar end-->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>