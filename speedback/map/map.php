<html>
<head>
  <title>Map Example</title>
</head>
<body>
<div class="title_left" style="padding-left: 2%;" >
<h3>Maps Manager   <small>(Map control)</small></h3>
</div>
<div style="text-align: right;">
<a href="#newshifttime" class="btn btn btn-info" role="button" data-toggle="modal" data-target="#newshifttime" > <i class="fa fa-sun-o"></i> ตั้งค่ากะการทำงาน</a>
<a href="#newDepartment" class="btn btn-success" role="button" data-toggle="modal" data-target="#newDepartment" > <i class="fa fa-sun-o"></i> ตั้งค่าแผนก</a>
<a href="#newuser" class="btn btn-primary" role="button" data-toggle="modal" data-target="#newuser" > <i class="fa fa-users"></i> เพิ่มผู้ใช้งาน</a>
</div>
<div class="x_panel">
    
<div class="x_title">
   
    <ul class="nav navbar-right panel_toolbox">
        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
        </li>
        <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                aria-expanded="false"><i class="fa fa-wrench"></i></a>
            <ul class="dropdown-menu" role="menu">
                <li><a class="dropdown-item" href="#">สิทธิ์การใช้งาน</a>
                </li>
                <li><a class="dropdown-item" href="#">คู่มือการใช้งานระบบ</a>
                </li>
            </ul>
        </li>
        <li><a class="close-link"><i class="fa fa-close"></i></a>
        </li>
    </ul>
    <div class="clearfix"></div>
</div>

<div class="x_content">
    <form class="form-inline" id="form1" name="form1" method="get" action="" enctype="multipart/form-data">
        <input type="hidden" value="<?php echo $m; ?>" id="m" name="m" />
        <input type="hidden" value="<?php echo $c; ?>" id="c" name="c" />
        <div class="row">

            <div class="input-group col-md-2 col-sm-2 col-xs-2">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" disabled=""><i class="fa fa-filter"></i> ตัวกรอง |
                        Customer : </button>
                </span>

                <select name="nameschoolchk" id="nameschoolchk" class="form-control" style="width:auto;">

                </select>
            </div>
            <div class="input-group col-md-2 col-sm-2 col-xs-2">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-default" disabled=""> <i
                            class="glyphicon glyphicon-calendar fa fa-calendar"></i> Range Date </button> </span>
                <input type="text" style="width: 180px" name="reservation" id="reservation" class="form-control"
                    value="<?php echo $DBS . " - " . $DBF; ?>" data-toggle="tooltip"
                    data-original-title="ดด/วว/ปปปป - ดด/วว/ปปปป">
            </div>

            <div class="input-group col-md-1 col-sm-1 col-xs-1">
                <span class="input-group-btn" style="width: 200px;">
                    <button type="submit" name="submit" class="form-control btn btn-success">Search</button>
                </span>
            </div>
        </div>
    </form>
  
    <div class="table-responsive">
  <h1>Maps Manager </h1>
  <iframe
    width="1400"
    height="800"
    frameborder="0" style="border:0"
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3152.9243560609215!2d144.9630573152587!3d-37.81797707975275!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad6429a3bfaa6bf%3A0x50458eeb3d4d160!2sFlinders%20Street%20Railway%20Station!5e0!3m2!1sen!2sau!4v1624882624177!5m2!1sen!2sau"
    allowfullscreen=""
    aria-hidden="false"
    tabindex="0">
  </iframe>
  </div>
  </div>
  </div>
</body>
</html>