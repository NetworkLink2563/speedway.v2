<?php
ob_start();
session_start();
include 'header.php';
include "permission.php";
include "service/privilege.php";
$menucode = "001";
$pri = pri_($_SESSION['user'], $menucode);
$pri_w = $pri[0]['pri_w'];  // สิทธิ์การเขียน
$pri_r = $pri[0]['pri_r'];  // สิทธิ์การอ่าน
$pri_del = $pri[0]['pri_del'];  // สิทธิ์การลบ

function row($idrow, $user)
{
    include "lib/DatabaseManage.php";
    $q = "SELECT XVUsrCode,XIShowColumn FROM [NWL_SpeedWayTest2].[dbo].[TMstMUserDashboard] WHERE XVUsrCode='$user' AND XIShowColumn='" . $idrow . "'";
    $qr = sqlsrv_query($conn, $q);
    $val1 = sqlsrv_fetch_array($qr, SQLSRV_FETCH_ASSOC);
    return $val1['XIShowColumn'];
    // return $val1;
}
?>

<style>
    .modal-dialog {
        max-width: 1000px;

    }

    body {
        background: #e1f0fa;
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .container {
        background-color: white;
    }

    table thead th {
        font-size: 1rem;
        font-weight: 450;
    }

    table th {
        background-color: #e8f4ff !important;
        /* border: 1px solid #cccc; */
    }

    table td {
        font-size: 0.9rem;
        padding: 0.3rem;
        transition: 0.5s;
        /* border: 1px solid #cccc; */
    }

    .table>:not(caption)>*>* {
        padding: 0.7rem;
    }

    table {
        border: 1px solid #cccc;
    }

    table td {
        font-size: 0.9rem;
        transition: 0.5s;
        font-weight: 300;
    }

    table th {
        font-size: 1rem;
        font-weight: 500;
    }

    .input-config {
        background-color: #f2fff0 !important;
        font-weight: 300;
        font-size: .8rem;
    }

    .config {
        transform: 5sec;
    }

    .modal-title {
        text-align: center;
        font-size: 1.5rem;
    }

    @media (min-width: 768px) {
        .modal-xl {
            width: 90%;
            max-width: 1200px;
        }
    }

    table td {
        border: 1px solid #cccc;
    }

    table th {
        border: 1px solid #cccc;
    }
</style>

<script src="dist/js/jquery-3.7.1.js"></script>
<script src="dist/js/popper.min.js"></script>
<script src="dist/js/main_speed.js"></script>
<script src="dist/js/bootstrap.min.js"></script>



<script>
    $(document).ready(function() {
        $('input[type="checkbox"]').click(function() {
            var check = $(this).is(':checked');
            var val = $(this).val();
            //  alert(check);
            if (check == true) {
                if (val == 1) {
                    showCellsById(['th_status1', 'chk1', 'chk2', 'chk3', 'chk4', 'chk5']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 2) {
                    showCellsById(['th_status2', 'C1VMS2403-0001', 'C1VMS2403-0002', 'C1VMS2403-0003', 'C1VMS2403-0004', 'C1VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 3) {
                    showCellsById(['th_status3', 'C2VMS2403-0001', 'C2VMS2403-0002', 'C2VMS2403-0003', 'C2VMS2403-0004', 'C2VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 4) {
                    showCellsById(['th_status4', 'C3VMS2403-0001', 'C3VMS2403-0002', 'C3VMS2403-0003', 'C3VMS2403-0004', 'C3VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 5) {
                    showCellsById(['th_status5', 'C4VMS2403-0001', 'C4VMS2403-0002', 'C4VMS2403-0003', 'C4VMS2403-0004', 'C4VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 6) {
                    showCellsById(['th_status6', 'C5VMS2403-0001', 'C5VMS2403-0002', 'C5VMS2403-0003', 'C5VMS2403-0004', 'C5VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 7) {
                    showCellsById(['th_status7', 'C6VMS2403-0001', 'C6VMS2403-0002', 'C6VMS2403-0003', 'C6VMS2403-0004', 'C6VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 8) {
                    showCellsById(['th_status8', 'C7VMS2403-0001', 'C7VMS2403-0002', 'C7VMS2403-0003', 'C7VMS2403-0004', 'C7VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 9) {
                    showCellsById(['th_status9', 'C8VMS2403-0001', 'C8VMS2403-0002', 'C8VMS2403-0003', 'C8VMS2403-0004', 'C8VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 10) {
                    showCellsById(['th_status10', 'C9VMS2403-0001', 'C9VMS2403-0002', 'C9VMS2403-0003', 'C9VMS2403-0004', 'C9VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 11) {
                    showCellsById(['th_status11', 'C10VMS2403-0001', 'C10VMS2403-0002', 'C10VMS2403-0003', 'C10VMS2403-0004', 'C10VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 12) {
                    showCellsById(['th_status12', 'C11VMS2403-0001', 'C11VMS2403-0002', 'C11VMS2403-0003', 'C11VMS2403-0004', 'C11VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 13) {
                    showCellsById(['th_status13', 'C12VMS2403-0001', 'C12VMS2403-0002', 'C12VMS2403-0003', 'C12VMS2403-0004', 'C12VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 14) {
                    showCellsById(['th_status14', 'chkl1', 'chkl2', 'chkl3', 'chkl4', 'chkl5']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 15) {
                    showCellsById(['th_status15', 'C15VMS2403-0001', 'C15VMS2403-0002', 'C15VMS2403-0003', 'C15VMS2403-0004', 'C15VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                }

            } else {
                if (val == 1) {
                    hideCellsById(['th_status1', 'chk1', 'chk2', 'chk3', 'chk4', 'chk5']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 2) {
                    hideCellsById(['th_status2', 'C1VMS2403-0001', 'C1VMS2403-0002', 'C1VMS2403-0003', 'C1VMS2403-0004', 'C1VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 3) {
                    hideCellsById(['th_status3', 'C2VMS2403-0001', 'C2VMS2403-0002', 'C2VMS2403-0003', 'C2VMS2403-0004', 'C2VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 4) {
                    hideCellsById(['th_status4', 'C3VMS2403-0001', 'C3VMS2403-0002', 'C3VMS2403-0003', 'C3VMS2403-0004', 'C3VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 5) {
                    hideCellsById(['th_status5', 'C4VMS2403-0001', 'C4VMS2403-0002', 'C4VMS2403-0003', 'C4VMS2403-0004', 'C4VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 6) {
                    hideCellsById(['th_status6', 'C5VMS2403-0001', 'C5VMS2403-0002', 'C5VMS2403-0003', 'C5VMS2403-0004', 'C5VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 7) {
                    hideCellsById(['th_status7', 'C6VMS2403-0001', 'C6VMS2403-0002', 'C6VMS2403-0003', 'C6VMS2403-0004', 'C6VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 8) {
                    hideCellsById(['th_status8', 'C7VMS2403-0001', 'C7VMS2403-0002', 'C7VMS2403-0003', 'C7VMS2403-0004', 'C7VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 9) {
                    hideCellsById(['th_status9', 'C8VMS2403-0001', 'C8VMS2403-0002', 'C8VMS2403-0003', 'C8VMS2403-0004', 'C8VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 10) {
                    hideCellsById(['th_status10', 'C9VMS2403-0001', 'C9VMS2403-0002', 'C9VMS2403-0003', 'C9VMS2403-0004', 'C9VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 11) {
                    hideCellsById(['th_status11', 'C10VMS2403-0001', 'C10VMS2403-0002', 'C10VMS2403-0003', 'C10VMS2403-0004', 'C10VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 12) {
                    hideCellsById(['th_status12', 'C11VMS2403-0001', 'C11VMS2403-0002', 'C11VMS2403-0003', 'C11VMS2403-0004', 'C11VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 13) {
                    hideCellsById(['th_status13', 'C12VMS2403-0001', 'C12VMS2403-0002', 'C12VMS2403-0003', 'C12VMS2403-0004', 'C12VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 14) {
                    hideCellsById(['th_status14', 'chkl1', 'chkl2', 'chkl3', 'chkl4', 'chkl5']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                } else if (val == 15) {
                    hideCellsById(['th_status15', 'C15VMS2403-0001', 'C15VMS2403-0002', 'C15VMS2403-0003', 'C15VMS2403-0004', 'C15VMS2403-0005']);
                    var datastring = 'load=0001' + '&val=' + val + '&check=' + check;
                    $.ajax({
                        type: "POST",
                        url: "lib/insert_dashboard.php",
                        data: datastring,
                        cache: false,
                        success: function(html) {}
                    })
                }



            }

            // alert(check);
        });

    });


    function hideCellsById(cellIds) {
        cellIds.forEach(function(id) {
            var cell = document.getElementById(id);
            if (cell) {
                //cell.style.display = 'hidden';
                cell.style.display = 'none'
            }


        });
    }

    function showCellsById(cellIds) {
        cellIds.forEach(function(id) {
            var cell = document.getElementById(id);
            if (cell) {
                cell.style.display = '';
            }


        });
    }
</script>
<div class="container" style="position: relative; top: 70;">
    <?php if ($pri_r != 0) { ?>
        <div style="margin: 1rem; text-align: center; margin-bottom: 1rem; border-bottom: 3px double #cccc; padding: 1rem;">
            <img src="./img/icon/setting.png" height="25" alt="Responsive image">หน้าแดชบอร์ด
        </div>


        <div class="col-12 " style="display: flex; flex-direction: row; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px; justify-content: center;">


            <div class="col-4">

            </div>

            <div class="col-4" style="text-align: center;">
                <h5 class="tablinks2 active " style="cursor: context-menu; padding: .5rem; margin: 0;"><i class="fa fa-list-alt" aria-hidden="true"></i> การแสดงผล</h5>
            </div>

            <div class="col-4 fs-6 form-check form-switch" style="padding: .5rem; text-align: center; text-align: right;"><input onclick="hideConfig()" class="form-check-input" id="hideconfig" name="radiobutton" type="checkbox" value="0" style="position: absolute;"/> ปิด-เปิด การตั้งค่าการแสดงผล
            </div>

        </div>

        <?php
        if ($pri_w != 0) {


        ?>
            <div class="config" style="text-align: center; ">
                <table class="table hover" id="config" style="margin-bottom: .5rem;">
                    <tr style="text-align: center;">
                        <th class="input-config">
                            <div><input class="chkbox" value="1" type="checkbox" <?php $val =  row('1', $_SESSION['user']);
                                                                                    if ($val == 1) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>สถานะ
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="2" type="checkbox" <?php $val2 = row('2', $_SESSION['user']);
                                                                                    if ($val2 == 2) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>แบบป้าย
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="3" type="checkbox" <?php $val3 = row('3', $_SESSION['user']);
                                                                                    if ($val3 == 3) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ป้าย
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="4" type="checkbox" <?php $val4 = row('4', $_SESSION['user']);
                                                                                    if ($val4 == 4) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ไฟฟ้า
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="5" type="checkbox" <?php $val5 = row('5', $_SESSION['user']);
                                                                                    if ($val5 == 5) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>แสดงผล
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="6" type="checkbox" <?php $val6 = row('6', $_SESSION['user']);
                                                                                    if ($val6 == 6) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ความสว่าง
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="7" type="checkbox" <?php $val7 = row('7', $_SESSION['user']);
                                                                                    if ($val7 == 7) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>อุณหภูมิตู้
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="8" type="checkbox" <?php $val8 = row('8', $_SESSION['user']);
                                                                                    if ($val8 == 8) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>อุณหภูมิป้าย
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="9" type="checkbox" <?php $val9 = row('9', $_SESSION['user']);
                                                                                    if ($val9 == 9) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>พัดลมตู้
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="10" type="checkbox" <?php $val10 = row('10', $_SESSION['user']);
                                                                                    if ($val10 == 10) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ไฟกระพริบ
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="11" type="checkbox" <?php $val11 = row('11', $_SESSION['user']);
                                                                                    if ($val11 == 11) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>โมดูลเสีย
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="15" type="checkbox" <?php $val11 = row('15', $_SESSION['user']);
                                                                                    if ($val11 == 15) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ไฟฟ้าคอมพิวเตอร์
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="12" type="checkbox" <?php $val12 = row('12', $_SESSION['user']);
                                                                                    if ($val12 == 12) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ประเภท
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox" value="13" type="checkbox" <?php $val13 = row('13', $_SESSION['user']);
                                                                                    if ($val13 == 13) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>ข้อความ
                        </th>
                        <th class="input-config">
                            <div><input class="chkbox " value="14" type="checkbox" <?php $val14 = row('14', $_SESSION['user']);
                                                                                    if ($val14 == 14) {
                                                                                        echo 'checked';
                                                                                    } ?> aria-label="Checkbox for following text input"></div>Live
                        </th>
                    </tr>
                </table>
                <div id="btnconfig">
                    <button hidden style="  margin: 0rem 0rem 0rem 0rem; box-shadow: 3px 3px 3px #aaaaaa !important;" type="button" class="btn btn-success btn-md">กดบันทึก</button>
                    <hr>
                </div>
            </div>
        <?php } ?>
        <div style="" id="ShowData">

            <?php



            include "dashboardshow.php";

            ?>

        </div>


    <?php } else {
        echo '<div style="text-align:center;padding: 10%;"">ไม่มีสิทธิ์การเข้าถึงข้อมูล หรือติดต่อเจ้าหน้าที่เพื่อขอสิทธิ์</div>';
    } ?>
</div>


            <?php include "footer.php"; ?>



<!-- Modal -->
<!--<div class="modal fade " id="modaliframe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="display: flex; background-color: #f7f7f7;">
                <div class="col-11">
                    <h5 class="modal-title" id="exampleModalLabel">Live view</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" style="padding: 1rem 0rem 1rem 0rem;">




                <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center ; background-color: white;">


                    <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">


                        <div class="row">
                            <div class="col-md-12" style="padding: 0;">
                                <div id="frame3_section1" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px; width: 960px; height: 100px;">

                                   <button onclick="addsms(1)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                  <!--   <iframe id="frame1_section1_show" src="" style="border: none; width: 956px; height: 100px;"></iframe>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div id="frame3_section3" class="float-left" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px;  height: 249px;">

                                   <button onclick="addsms(3)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                   <!--  <iframe id="frame3_section3_show" src="" ></iframe>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="frame3_section4" class="float-left col-12" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px;  height: 249px;">

                                  <button onclick="addsms(4)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                    <!--<iframe id="frame4_section4_show" src="" ></iframe>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div id="frame3_section4" class="float-left col-12" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px; height: 249px;">

                                    <button onclick="addsms(4)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                 <!--   <iframe id="frame5_section5_show" src="" ></iframe>

                                </div>
                            </div>
                        </div>

                        <div class="col-12" style="padding: 0;">
                            <div id="frame3_section1" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px; width: 960px; height: 100px;">

                               <button onclick="addsms(1)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                               <!-- <iframe id="frame2_section2_show" src="" style="border: none; width: 956px; height: 100px;"></iframe>

                            </div>
                        </div>

                        <video src="http://192.168.55.13/vdo1/"></video>
                        
                    </div>



                    <div class="col-8 text-center" style="margin: 1rem;">
                        <button type="button" id="btn_saveframe3" class="btn" style="background-color:#009933;color:white">บันทึก<i style="margin-left: 5px;color:white;font-size: 15px;" class="fa fa-save"></i></button> -->
                        <!-- <button type="button"  id="btn_saveframe3" class="btn btn-danger" style="color:white" >ล้าง<i style="margin-left: 5px;color:white;font-size: 15px;" class="fa fa-delete"></i></button> -->
                    <!--</div>


                </div>
            </div>
             frame 3 end -->

           <!--  <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> 
            </div>
        </div>
    </div>
</div> -->

<div class="modal fade " id="modaliframe" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="display: flex; background-color: #f7f7f7;">
                <div class="col-11">
                    <h5 class="modal-title" style="padding-left: 13%;" id="exampleModalLabel">Live view</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" style="padding: 1rem 0rem 1rem 0rem;">




                <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center ; background-color: white;">


                    <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">


                        <div class="row" style="text-align:center;">
                            <div class="col-md-12" style="padding: 0;">
                                <div id="frame3_section1" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px; width: 960px; height: 415px;">

                                    <!--<button onclick="addsms(1)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                  <iframe id="live" src="http://192.168.55.11/stream/Vdo1/" style="border: none; width:1200px; height:400px;"></iframe>

                                </div>
                            </div>
                        </div> 
                        </div>
                        </div>
                        </div>
                        </div>
          </div>
       </div>


<div class="modal fade " id="modaliframe2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header" style="display: flex; background-color: #f7f7f7;">
                <div class="col-11">
                    <h5 class="modal-title" style="padding-left: 13%;" id="exampleModalLabel">Live view</h5>
                </div>
                <div class="col-1">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            <div class="modal-body" style="padding: 1rem 0rem 1rem 0rem;">




                <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center ; background-color: white;">


                    <div class="" style="display: flex; flex-direction: column; justify-content: center; align-items: center;">


                        <div class="row" style="text-align:center;">
                            <div class="col-md-12" style="padding: 0;">
                                <div id="frame3_section1" style="border-style: solid; border-color: rgb(220, 220, 220); margin: 0px; padding: 0px; border-width: 2px; width: 960px; height: 415px;">

                                    <!--<button onclick="addsms(1)" style="position: absolute;left: 20px;top:5px;z-index:1000;" type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-frame1-add">เลือกข้อความ</button> -->
                                  <iframe id="live" src="http://192.168.55.11/stream/Vdo2/" style="border: none; width:1200px; height:400px;"></iframe>

                                </div>
                            </div>
                        </div> 
                        </div>
                        </div>
                        </div>
                        </div>
          </div>
       </div>



<div class="modal py-5" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="background-color: rgb(3, 84, 138);color:white;">
            <div class="modal-header">
                <h5 id="Example_Title" class="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body text-center" style="">

                <iframe id="iframe_modal" style="border: 0;text-align: center;" src=""></iframe>

            </div>

        </div>
    </div>
</div>


<div class="modal py-5" id="modalmo" role="dialog">
    <div class="modal-dialog modal-sm" style="max-width: 36%;">
        <div class="modal-content" >
            <div class="modal-header">
                <h5 style="font-size: 14px;" id="moduletitel" class="modal-title"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" ></button>
            </div>
            <div class="modal-body text-center">

                <iframe id="iframed"style="border: 0;width: 100%;" src="">

                </iframe>

            </div>
        </div>

</div>
</div>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->





<script>
    var hidebtn = document.getElementById("hideconfig");
    $("#config").hide()
    $("#btnconfig").hide()

    function hideConfig() {
        if (hidebtn.checked == true) {
            $("#config").show()
            $("#btnconfig").show()
        } else {
            $("#config").hide()
            $("#btnconfig").hide()
        }
    }
</script>


<script>
    function ShowData() {
        $('#ShowData').empty();
        $.post("dashboardshow.php", function(data, status) {
            $('#ShowData').html(data);
        });
    }

    function waitforme(millisec) {
        return new Promise(resolve => {
            setTimeout(() => {
                resolve('')
            }, millisec);
        })
    }
    var XVVmsCode = "";
    var TMPXVMsgCode = "";
    async function ShowSms() {
        let text = $('#vmscode').val();
        const myArray = text.split(",");
        for (let i = 0; i < myArray.length - 1; i++) {


            $.post("dashboadshowsms.php", {
                vmscode: myArray[i]
            }, function(result) {
                const obj = JSON.parse(result);
             //   console.log(result);
                $('#C12' + myArray[i]).text(obj.XVMsgName);
                
                if(obj.statusXiSecDiff == 1){  // off
                    $('#C0' + obj.XVVmsCode).css("color", "red");
                }else if(obj.statusXiSecDiff == 2){  // on
                    $('#C0' + obj.XVVmsCode).css("color", "green");
                }

                if(obj.XVVdtModuleNo==0){
                    document.getElementById('link'+obj.XVVmsCode).style.display='none';
                }


      

                  if(obj.XBVmsIsDisplay=='On'){
                     $('#C4' + obj.XVVmsCode).css("color", "green");
                  }else if(obj.XBVmsIsDisplay=='Off'){
                  $('#C4' + obj.XVVmsCode).css("color", "red");
                  }

                  if(obj.XBVmsIsOn=='On'){
                     $('#C3' + obj.XVVmsCode).css("color", "green");
                  }else if(obj.XBVmsIsOn=='Off'){
                  $('#C3' + obj.XVVmsCode).css("color", "red");
                  }
                  if(obj.XBVmsFanIsActive=='On'){
                     $('#C9' + obj.XVVmsCode).css("color", "green");
                  }else if(obj.XBVmsFanIsActive=='Off'){
                  $('#C9' + obj.XVVmsCode).css("color", "red");
                  }
                 if(obj.XBVmsFlashIsActive=='On'){
                     $('#C8' + obj.XVVmsCode).css("color", "green");
                  }else if(obj.XBVmsFlashIsActive=='Off'){
                  $('#C8' + obj.XVVmsCode).css("color", "red");
                  }

                $('#C3' + obj.XVVmsCode).text(obj.XBVmsIsOn);
                $('#C4' + obj.XVVmsCode).text(obj.XBVmsIsDisplay);
                $('#C5' + obj.XVVmsCode).text(obj.XIVmsBrightness);
                $('#C6' + obj.XVVmsCode).text(obj.XIVmsRackTemperature);
                $('#C7' + obj.XVVmsCode).text(obj.XIVmsBoardTemperature);
                $('#C8' + obj.XVVmsCode).text(obj.XBVmsFlashIsActive);
                $('#C9' + obj.XVVmsCode).text(obj.XBVmsFanIsActive);
                $('#C15' + obj.XVVmsCode).text(obj.XBVmscompIsActive);
                $('#C10' + obj.XVVmsCode).text();
                $('#C12' + obj.XVVmsCode).text(obj.XVMsgName);
                $('#C11' + obj.XVVmsCode).text(obj.XVMsfType);
                if (obj.XVVmsCode == $("#XVVmsCode").val()) {
                    if (obj.XVMsgCode != "" && obj.XVMsgCode != $("#XVMsgCode").val()) {
                        $("#XVMsgCode").val(obj.XVMsgCode);
                       
                        $("#iframe_modal").attr("src", 'ifarme.php?msg=' + btoa(obj.XVMsgCode));
                    }
                }

            });
           // console.log("Hello world!");
            await waitforme(1000);
        }
        ShowSms();

    }
<<<<<<< HEAD

    function newSrc(val){
        document.getElementById("moduletitel").innerText = 'รายการโมดูลเสีย';
        document.getElementById("iframed").src = 'iframemodule.php?XVVmsCode='+val;
        $('#modalmo').modal('show');
     }
=======
>>>>>>> origin/main
   function ShowSample(XVVmsCode, XVVmsName, w, h) {
        var id = XVVmsCode;
        if(id=='VMS2403-0001'){
        $('#modaliframe').modal('show');
        }else if(id=='VMS2403-0002'){
            $('#modaliframe2').modal('show');   
        }
    }
    $(document).ready(async function() {
        ShowSms();
    });
</script>

<script>
    /* $("#chkl1").click(function(){
    $("#modaliframe").modal("show")
    })
    $("#chkl2").click(function(){
    $("#modaliframe").modal("show")
    })
    $("#chkl3").click(function(){
    $("#modaliframe").modal("show")
    })
    $("#chkl4").click(function(){
    $("#modaliframe").modal("show")
    })
    $("#chkl5").click(function(){
    $("#modaliframe").modal("show")
    })*/
</script>
</body>

</html>