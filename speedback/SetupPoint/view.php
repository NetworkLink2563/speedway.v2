<style>
.bg-success {
    --bs-bg-rgb-color: var(--bs-success-rgb);
    background-color: #f6f2f0 !important;
}
</style>
<?php
   include '../lib/DatabaseManage.php';   
  // $Permis=Permission('MNU22-00005');
?>
<!--begin::Main-->
<div class="app-main flex-column flex-row-fluid" id="kt_app_main">
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar pt-6 pb-2">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex align-items-stretch">
                <!--begin::Toolbar wrapper-->
                <div class="app-toolbar-wrapper d-flex flex-stack flex-wrap gap-4 w-100">
                    <!--begin::Page title-->
                    <div class="page-title d-flex flex-column justify-content-center gap-1 me-3">

                    </div>
                    <!--end::Page title-->
                    <!--begin::Actions-->
                    <div class="d-flex align-items-center gap-2 gap-lg-3">

                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Toolbar wrapper-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

                <div class="row g-5 g-xl-10 mb-xl-10">

                    <div class="card pt-3">
                        <div class="text-center">
                           <h3>จุดติดตั้ง</h3>
                        </div>
                        <div>
                        <button style="position: absolute; top: 5%; z-index: 10;" type="button" id="BtnAdd" class="btn btn-dark ms-4 py-1 fs-8"> <i
                                        class="" <?php echo $Permis[1];?>></i>
                                    เพิ่มจุดติดตั้ง</button>

                        </div>
                        <span class="label label-default" id="LabelSearch">ค้นหา</span>
                        <br>
                        <div class="row mb-1">
                            <div class="col-sm-12 mb-3 mb-sm-0 m-0">

                                <label class="m-0">โครงการ:</label>
                                <select id="Sel_PrjCode" class="form-control " required>
                                    <?php
                                        echo InPutSelect_Project();
                                    ?>
                                </select>

                            </div>
                        </div>
                       
                        <table class="table table-striped" id="table">
                            <thead>
                                <tr>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">รหัสจุดติดตั้ง</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อจุดติดตั้ง</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ละติจูด</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ลองจิจูด</th>
                                    <th class="p-1" style="color: black;font-size: 14px;font-weight: bold;">ชื่อโครงการ</th>
                                    <th class="p-1"></th>
                                    <th class="p-1"></th>
                                </tr>
                            </thead>
                            <tbody id="TableBody">
                                <?php //echo ShowBodyTable("");?>
                            </tbody>
                        </table>
                    </div>
                    <!--end::Body-->

                </div>

            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
    <!--end::Content wrapper-->

</div>
<!--end:::Main-->

</div>

<!-- The Modal -->
<div class="modal fade" id="myModal">
    <div class="modal-dialog  modal-lg card shadow">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 id="HeaderTitle" class="modal-title">
                    </h4>
                    <!--
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
-->
            </div>
            <!-- Modal body -->
            <div class="modal-body card shadow">
                <form id="FormSetupPoint" class="user" method="POST" action="Controller.php">
                <?php echo InPutSelect_Project("");?>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">รหัสจุดติดตั้ง:</label>
                            <input type="text" class="form-control w-25" value="SUPYY-XXXXX" placeholder=""
                                id="TxtSupCode" autocomplete="off" disabled>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                  
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">โครงการ:</label>
                            <select id="SelPrjCode" <?php echo $Permis[1];?> class=" form-control w-75" required>
                                <?php echo InPutSelect_Project();?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 ">
                            <label class="m-0">ชื่อจุดติดตั้ง:</label>
                            <input type="text" class=" form-control w-50" placeholder="" id="TxtSupName"
                                autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-12 mb-3 mb-sm-0 m-0">
                            <label class="m-0">คำบรรยาย:</label>
                            <input type="text" class=" form-control w-50" placeholder="" id="TxtSupSetupPoint"
                                autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                    </div>


                    <div class="form-group row m-1">
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <label class="m-0">กม ที่ติดตั้ง:</label>
                            <input type="number" class=" form-control w-25" step="0.001" placeholder=""
                                id="NumSupKmPoint" autocomplete="off" <?php echo $Permis[1];?> required>
                        </div>
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">

                        </div>
                    </div>
                    <div class="form-group row m-1">
                        <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                            <div class="row">
                                <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                                    <label class="m-0">ละติจูด:</label>
                                    <input type="text" class=" form-control " id="NumSupLatitude" autocomplete="off"
                                        <?php echo $Permis[1];?> required>
                                </div>
                                <div class="col-sm-6 mb-3 mb-sm-0 m-0">
                                    <label class="m-0">ลองติจูด:</label>
                                    <input type="text" class=" form-control " id="NumSupLongitude" autocomplete="off"
                                        <?php echo $Permis[1];?> required>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="form-group row m-1 pt-3">
                        <div class="col-sm-12 mb-3 mb-sm-0 text-center">
                            <input type="hidden" id="txtmode">
                            <button class=" btn btn-success" type="submit" id="BtnSave" name="BtnSave"
                                <?php echo $Permis[1];?>>บันทึก</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>
<!--
<script src="view.js"></script>
-->
<script>
    function ShowDataTable(){
    $( "#TableBody" ).empty();
    $.post("Controller.php",
    {
        PrjCode: $("#Sel_PrjCode").val(),
        ShowBodyTable: "ShowBodyTable"

    })
    .done(async function (data) {
        console.log(data);
        obj=JSON.parse(data);
        $('#table').DataTable( {
            data: obj,
            columns: [
                { data: 'A' },
                { data: 'B' },
                { data: 'C' },
                { data: 'D' },
                { data: 'E' }
            ],
            "columnDefs": [
                { "width": "10%", "targets": 0 },
                { "width": "60%", "targets": 1 },
                { "width": "10%", "targets": 2 },
                { "width": "10%", "targets": 3 },
                { "width": "10%", "targets": 4 }
               
              ],
            lengthChange: false,
            "bDestroy": true

        } );
    });
}
function FuDelete(p) {
    Swal.fire({
        title: 'ต้องการลบ ' + p + ' ใช่หรือไม่?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        customClass: {
            actions: 'my-actions',
            confirmButton: 'order-2',
            denyButton: 'order-3',
        }
    }).then((result) => {
        if (result.isConfirmed) {
            $.post( "Controller.php", 
            {
                Delete:'Delete',
                SupCode:p
            })
            .done(async function( data ) 
            {   
                ShowDataTable();
            });
        }
    })
}

$("#Sel_PrjCode").change(function(){
    
    
        ShowDataTable();
    

});

$("#BtnAdd").click(function(){
    $( "#HeaderTitle" ).text('เพิ่มจุดติดตั้งใหม่');
    $( "#txtmode" ).val('0');
    $( "#TxtSupCode" ).val('SUPYY-XXXXX');
    $( "#SelPrjCode" ).val('').change();
    $( "#TxtSupName" ).val('');
    $( "#TxtSupSetupPoint" ).val('');
    $( "#NumSupKmPoint" ).val('');
    $( "#NumSupLatitude" ).val('');
    $( "#NumSupLongitude" ).val('');
    $("#myModal").modal('toggle');
 });

 function FuEdit(SupCode){
    $.post( "Controller.php", 
    {
        Edit:"Edit",
        SupCode:SupCode
    })
    .done(async function( data ) 
    { 
        position = data.search("Err1");
        if(position>-1){
            SmsBoxShow("ไม่สามรถค้นข้อมูลได้");
            return false;
        }
        const obj = JSON.parse(data); 
        $( "#HeaderTitle" ).text('แก้ไขข้อมูลจุดติดตั้ง');
        $( "#txtmode" ).val('1');
        $( "#TxtSupCode" ).val(obj[0].XVSupCode);
        $( "#SelPrjCode" ).val(obj[0].XVPrjCode).change();
        $( "#TxtSupName" ).val(obj[0].XVSupName);
        $( "#TxtSupSetupPoint" ).val(obj[0].XVSupSetupPoint);
        $( "#NumSupKmPoint" ).val(obj[0].XFSupKmPoint);
        $( "#NumSupLatitude" ).val(obj[0].XFSupLatitude);
        $( "#NumSupLongitude" ).val(obj[0].XFSupLongitude);
        $("#myModal").modal('toggle');
    });
    
}
 function InsertUpdate(){
  
    $.post( "Controller.php", 
    {
        Mode:$( "#txtmode" ).val(),
        SupCode:$( "#TxtSupCode" ).val(),
        PrjCode:$( "#SelPrjCode" ).val(),
        SupName:$( "#TxtSupName" ).val(),
        SupSetupPoint:$( "#TxtSupSetupPoint" ).val(),
        SupKmPoint:$( "#NumSupKmPoint" ).val(),
        SupLatitude:$( "#NumSupLatitude" ).val(),
        SupLongitude:$( "#NumSupLongitude" ).val(),
        InsertUpdate:'InsertUpdate'
    })
    .done(async function( data ) 
    {   console.log(data);
        alert(data);
        //ShowDataTable();
        //$("#myModal").modal('toggle');
    });
}
$( "#FormSetupPoint" ).submit(function( event ) {
    event.preventDefault();
    InsertUpdate();
});


$(function() {
    ShowDataTable();
    $.extend(true, $.fn.dataTable.defaults, {
        "language": {
                  "sProcessing": "กำลังดำเนินการ...",
                  "sLengthMenu": "แสดง_MENU_ แถว",
                  "sZeroRecords": "ไม่พบข้อมูล",
                  "sInfo": "แสดง _START_ ถึง _END_ จาก _TOTAL_ แถว",
                  "sInfoEmpty": "แสดง 0 ถึง 0 จาก 0 แถว",
                  "sInfoFiltered": "(กรองข้อมูล _MAX_ ทุกแถว)",
                  "sInfoPostFix": "",
                  "sSearch": "",
                  "sUrl": "",
                  "oPaginate": {
                                "sFirst": "เิริ่มต้น",
                                "sPrevious": "ก่อนหน้า",
                                "sNext": "ถัดไป",
                                "sLast": "สุดท้าย"
                  }
         }
    });

    $('#table').dataTable( {
        "searching": true,
        "bLengthChange": false
      } );
});
</script>