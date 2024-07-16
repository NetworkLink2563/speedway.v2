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
if(checkmenu($user,'008')==0){
   
    header( "location: dashboard.php" );
    exit(0);
}

$sql = "SELECT * FROM TMstMItmVMS ORDER BY XVVmsCode ASC";

$query = sqlsrv_query($conn, $sql);
$XVVmsCode=base64_decode($_REQUEST["vmc"]) ;
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

        body {
        background: #e1f0fa;
    }

    .container{
        background-color:  white;
        
    }

    .shadow{
    box-shadow: 3px 3px 3px #aaaaaa !important;
}

.flex-head{
    display: flex;
    align-items: center;
    justify-content:center;
}

*{
    box-sizing: border-box;
}

.form-inline{
    align-items: center;
    justify-content: center;
    flex-direction: column;
}


.flex-btn{
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem;
}

.btn:hover{
        opacity: 0.8;
        transition: 0.5s;
    }
    </style>


<div class="container" style="position: relative; top: 75;">


<div style=" text-align: center; padding: 1rem; border-bottom: 3px double #cccc; margin: .4rem;">
            <img src="http://43.229.151.103/speedway/img/icon/computer.png" height="25" alt="Responsive image"> รายงานการปฏิบัติงาน
        </div>


<div class=" shadow" style="display: flex; flex-direction: column; align-items: center; padding: 0.5rem; background-color: #034672; color: white; font-size: 1.2rem; border-radius: 5px;">
            <a class="tablinks2 active " style="cursor: context-menu;"><i class="fa fa-list-alt" aria-hidden="true"></i> รายงาน</a>
        </div>


            <div class="flex-head" style="margin: 1rem;">

                        <div class="col">
                        
                        <form class="form-inline " action=""> 
                        
                                <div class="col-2" style="text-align: center; margin: 1rem;">
                                <label style="display: inline-block; font-size: 1.2rem;"  for="ds">วันที่เริ่ม:</label><i style="width: 25%; text-align: left; margin-left: .3rem;" class="fa">&#xf073;</i>
                                <input type="text" id="ds" class="datetimepicker form-control" placeholder="" style="width: 100%; text-align: center;"/>
                                </div>

                                <div class="col-2" style="text-align: center;">
                                <label style="display: inline-block; font-size: 1.2rem;" for="de">วันที่สิ้นสุด:</label><i style="width: 25%; text-align: left; margin-left: .3rem;" class="fa">&#xf073;</i>
                                <input type="text" id="de" class="datetimepicker form-control" placeholder="" style="width: 100%; text-align: center;"/>
                                </div>


                                    <div class="col-12">
                                <div class="flex-btn">

                                <div class="col-2">
                                <button type="button"  onclick="ShowData()" class="btn btn-primary shadow" style="padding: .5rem; width: 100%; background-color: #006eb4;"><i style="width: 13%;" class="fa fa-search" aria-hidden="true"></i> ค้นหา</button>
                                </div>

                                <div class="col-2">
                                <button  class="btn btn-success shadow" style="padding: .5rem;  width: 100%;"
                                onclick="PrintReport()"><i style="width: 17%;" class="fa fa-print" aria-hidden="true"></i>พิมพ์รายงาน</button>
                                </div>

                                </div>

                                </div>
                        </form>
                    </div>
                
                </div>


                </div>


                </div>

            <!-- end div container -->

                <!-- <div class="col-sm-4"></div> -->
                <!-- <div class="col-sm-4 ">
                    <div style="margin-top:10; margin-bottom: 10; margin-left: 10;  margin-right: 10;">
                        <div id="ShowData" style="margin-top: 10;">
                        </div>
                    </div>
               </div>
               <div class="col-sm-4"></div>
            </div>
        </div>
    </div> -->

    <div id="myModalOpen" class="modal" id="myModal" role="dialog" a>
        <div class="modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 id="Example_Title" class="modal-title">รายงานข้อความป้าย</h5>
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
                url: 'WorkReportPdf.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value
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
                url: 'WorkReportData.php',
                data: {
                    'ds': document.getElementById("ds").value,'de': document.getElementById("de").value
                },
                success: function(msg) {
                    console.log(msg);
                    $('#ShowData').html(msg);
                    new DataTable('#Table', {
                        ordering: false,
                        "oLanguage": {
                            "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                        }
                    });
                },
            });
            
            new DataTable('#UserTable', {
                ordering: false,
                "oLanguage": {
                    "sSearch": "กรอกข้อความที่ต้องการค้นหา"
                }
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
          
        });

    </script>

    </body>

    </html>