<?php
include 'header.php';
include "lib/DatabaseManage.php";
include "permission.php";
if(checkmenu($user,'001')==0)
{
    session_destroy();
    header( "location: index.php" );
    exit(0);
}
if(checkmenu($user,'011')==0){
   
    header( "location: dashboard.php" );
    exit(0);
}



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
        
        a.del-VMS:link {
            color: #595959 !important;
        }
        
        a.del-VMS:visited {
            color: #595959 !important;
        }
        
        a.del-VMS:hover {
            color: #FF0000 !important;
        }
        
        a.del-VMS:focus {
            color: #FF0000 !important;
        }
        
        a.del-VMS:active {
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
        
        .select2-container--default .select2-results>.select2-results__options {
            max-height: 400px;
        }
    </style>
    <style>
        .dropbtn {
            background-color: #04AA6D;
            color: white;
            padding: 16px;
            font-size: 16px;
            border: none;
            cursor: pointer;
        }
        
        .dropbtn:hover,
        .dropbtn:focus {
            background-color: #3e8e41;
        }
        
        #myInput {
            box-sizing: border-box;
            background-image: url('searchicon.png');
            background-position: 14px 12px;
            background-repeat: no-repeat;
            font-size: 16px;
            padding: 14px 20px 12px 45px;
            border: none;
            border-bottom: 1px solid #ddd;
        }
        
        #myInput:focus {
            outline: 3px solid #ddd;
        }
        
        .dropdown {
            position: relative;
            display: inline-block;
        }
        /*
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f6f6f6;
  min-width: 230px;
  overflow: auto;
  border: 1px solid #ddd;
  z-index: 1;
}
*/
        
        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
            height: 100%;
        }
        
        .dropdown a:hover {
            background-color: #ddd;
        }
        
        .show {
            display: block;
        }
        
        .modal-fullscreen {
            height: 400px;
        }
        
        .iframe-container {
            position: relative;
            height: 100%;
            min-height: 100vh;
            iframe {
                height: 100%;
                width: 100%;
                left: 0;
                top: 0;
                position: absolute;
                body,
                html {
                    height: 100%;
                    overflow: hidden;
                    background: transparent;
                }
            }
        }
    </style>


    <div class="centered" style="margin-top: 60;margin-left: 10;">

        <div class="box" style="margin-top: 30;" align="left">
            <div class="row">
                <div class="col-sm-12">
                    <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                        <img src="img/icon/computer.png" height="25" alt="Responsive image">&nbsp;รายงานระดับความสว่าง
                        <div style="margin-top:-5;">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12 " >
                    <div style="margin-top:10; margin-bottom: 10; margin-left: 30;  margin-right: 10;">
                            <form class="form-inline" action=""> 
                                <label for="">วันที่เริ่ม:</label>
                                <input type="text" id="ds" class="datetimepicker form-control" style=" width: 180px"/><i style="font-size:26px;margin-right:10px" class="fa">&#xf073;</i>
                                <label for="">วันที่สิ้นสุด:</label>
                                <input type="text" id="de" class="datetimepicker form-control" style=" width: 180px;"/><i style="font-size:26px;margin-right:10px" class="fa">&#xf073;</i>
                                <label for="">ป้าย:</label>
                                <select  id="vms" class="form-control" style="padding:5px;">
                                <?php
                                    $sql='SELECT XVVmsCode, XVVmsName FROM TMstMItmVMS order by XVVmsCode';
                                    $query = sqlsrv_query($conn, $sql);
                                    echo '<option value="0" selected>ทั้งหมด</option>';
                                    while($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)){
                                        echo '<option value="'.$row['XVVmsCode'].'">'.$row['XVVmsName'].'</option>';
                                    }
                                ?>
                                
                                
                                </select>
                                <button type="button"  onclick="ShowData()" class="btn btn-primary btn-sm" style="margin:5px;"><i class="fa fa-search" aria-hidden="true"></i>ค้นหา</button>
                                <a  class="btn btn-success btn-sm" style="font-size: 12pt; color: #FFFFFF; margin:5px;"
                                onclick="PrintReport()"><i class="fa fa-print" aria-hidden="true"></i>พิมพ์รายงาน</a>
                            
                            </form>
                    </div>
                </div>
              
            </div>
            <div class="col-sm-12 " >
                 <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;"">
                    <div id="ShowData" style="padding-top:5px;">
                    </div>
                 </div>
            </div>
        </div>
    </div>

    <div id="myModalOpen" class="modal" id="myModal" role="dialog" >
        <div class="modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="Example_Title" class="modal-title">รายงานระดับความสว่าง</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center">
                    <div class="iframe-container">
                        <iframe id="iframe_modal" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
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
    <script src="dist/js/jquery.datetimepicker.full.min.js"></script>
    <script src="dist/js/dataTables.js"></script>
    <script src="dist/js/dataTables.bootstrap4.js"></script>
    <script src="Select2/js/select2.js"></script>


    <script>
        function PrintReport() {
                var datestart=document.getElementById('ds').value;
                var dateend=document.getElementById('de').value;
                if(datestart==""){
                    Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
                    return false;
                }
                if(dateend==""){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
                    return false;
                }
                var tmp=datestart.split(" ");
                var dt1=tmp[0]+","+tmp[1]+":00";
                var d1=new Date(dt1);
                var tmp=dateend.split(" ");
                var dt2=tmp[0]+","+tmp[1]+":00";
                var d2=new Date(dt2);
                if(d2<d1){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
                    return false;
                }
            $.ajax({
                type: 'POST',
                url: 'LigthReportPdf.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value,'vms': document.getElementById("vms").value
                },
                success: function(msg) {
                 
                    $("#iframe_modal").attr("src", msg);
                    $('#myModalOpen').modal('show');
                },
            });
        }
        function ShowData() {
            var datestart=document.getElementById('ds').value;
            var dateend=document.getElementById('de').value;
            if(datestart==""){
                    Swal.fire("กรุณากรอกวันที่เริ่ม", "", "warning");
                    return false;
            }
            if(dateend==""){
                    Swal.fire("กรุณากรอกวันที่สิ้นสุด", "", "warning");
                    return false;
            }
            var tmp=datestart.split(" ");
            var dt1=tmp[0]+","+tmp[1]+":00";
            var d1=new Date(dt1);
            var tmp=dateend.split(" ");
            var dt2=tmp[0]+","+tmp[1]+":00";
            var d2=new Date(dt2);
            if(d2<d1){
                Swal.fire("กรุณากรอกวันที่สิ้นสุด มากกว่าหรือเท่ากับวันที่เริ่มต้น", "", "warning");
                return false;
            }
            $('#ShowData').empty();
            $.ajax({
                type: 'POST',
                url: 'LightReportData.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value,'vms': document.getElementById("vms").value
                },
                success: function(msg) {
                
                    $('#ShowData').html(msg);
                    new DataTable('#Table', {
                        ordering: false,
                        "oLanguage": {
                            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                        }
                    });
                },
            });
            
           
        }

        function filterFunction() {
            const input = document.getElementById("myInput");
            const filter = input.value.toUpperCase();
            const div = document.getElementById("myDropdown");
            const a = div.getElementsByTagName("a");
            for (let i = 0; i < a.length; i++) {
                txtValue = a[i].textContent || a[i].innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    a[i].style.display = "";
                } else {
                    a[i].style.display = "none";
                }
            }
        }
        
        $(document).ready(function() {
            jQuery('.datetimepicker').datetimepicker({
   
               format:'Y-m-d H:i'
            });
            $('#vms').select2()
        });
    </script>

    </body>

    </html>